<?php

namespace App\Livewire;

use App\Exports\DataExport;
use App\Models\Menu;
use App\Models\Pesanan;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class HistoryList extends Component
{
    public $pesanans;
    public function datas(){
        $pesanans = Pesanan::orderBy('status', 'asc') // Urutkan berdasarkan status, 0 akan muncul di atas
        ->orderBy('created_at', 'asc') // Kemudian urutkan berdasarkan tanggal
        ->get();

        $menu = Menu::all();
        $this->pesanans = $pesanans->map(function ($pesanan) use ($menu) {
            $menu1 = $menu->where('id', $pesanan->menu1)->first();
            $menu2 = $menu->where('id', $pesanan->menu2)->first();
            return [
                'id'=>$pesanan->id,
                'nama_pemesan' => $pesanan->nama_pemesan,
                'menu1' => $menu1 ? $menu1->nama_menu : null,
                'jumlah1' => $pesanan->jumlah1,
                'menu2' => $menu2 ? $menu2->nama_menu : null,
                'jumlah2' => $pesanan->jumlah2,
                'total_harga' => $pesanan->total_harga,
                'status' => $pesanan->status,
                'catatan'=>$pesanan->catatan,
            ];
        });
    }

    public function mount() {
        $this->datas();
    }
    public function export(){
        return Excel::download(new DataExport, 'JualanFTI.xlsx');
    }

    public function render()
    {
        return view('livewire.history-list')->layout('layouts.app');
    }

    public function update($id)
    {
        $pesanan = Pesanan::find($id);
        $pesanan->status = true;
        $pesanan->save();
        session()->flash('message', 'Pesanan berhasil diupdate!');
        $this->datas();
    }
}
