<?php

namespace App\Livewire;

use App\Models\Menu;
use App\Models\Pesanan;
use App\Models\Stock;
use Livewire\Component;

class StokList extends Component
{
    public $menus;
    public function datas()
    {
        $pesanans = Pesanan::all();
        $menus = Menu::all();
        $stok = Stock::all();
        $this->menus = $menus->map(function ($menus) use ($pesanans, $stok) {
            $jumlahDipesan = $pesanans->where('menu1', $menus->id)->sum('jumlah1') +
                $pesanans->where('menu2', $menus->id)->sum('jumlah2');
            $data = [
                'menu' => $menus->nama_menu,
                'jumlah' => $stok->where('menu_id', $menus->id)->first()->jumlah - $jumlahDipesan,
            ];
            return $data;
        });
    }
    public function mount()
    {
        $this->datas();
    }

    public function render()
        {
            return view('livewire.stok-list')->layout('layouts.app');
    }
}
