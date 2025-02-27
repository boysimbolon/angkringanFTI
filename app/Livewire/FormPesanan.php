<?php

namespace App\Livewire;

use App\Models\Menu;
use App\Models\Pesanan;
use App\Models\Stock;
use Livewire\Component;

class FormPesanan extends Component
{
    public $namaPemesan, $mode_pembayaran, $menus1='0', $jp1, $menus2 = '0', $jp2 = '0', $menus,
        $methods = [
        'Transfer',
        'Cash'
    ];
    public $stok1, $stok2, $catatan;

    public function mount()
    {
        $this->datas();
    }

    public function datas()
    {
        $menus = Menu::all();
        $stok = Stock::all();
        $pesanan = Pesanan::all();

        $this->menus = $menus->map(function ($menu) use ($stok, $pesanan) {
            $stokMenu = $stok->where('menu_id', $menu->id)->first();
            $jumlahDipesan = $pesanan->where('menu1', $menu->id)->sum('jumlah1') +
                $pesanan->where('menu2', $menu->id)->sum('jumlah2');
            return [
                'id' => $menu->id,
                'nama_menu' => $menu->nama_menu,
                'harga' => $menu->harga,
                'stock' => $stokMenu ? $stokMenu->jumlah - $jumlahDipesan : 0, // Pastikan stok ada
            ];
        });
    }

    public function render()
    {
        return view('livewire.form-pesanan')->layout('layouts.app');
    }

    public function Pesan()
    {
        if ($this->menus1 == $this->menus2) {
            session()->flash('error', 'Menu 1 dan Menu 2 tidak boleh sama.');
            return;
        }
        // Validasi input
        $this->validate([
            'mode_pembayaran' => 'required|in:Transfer,Cash',
            'namaPemesan' => 'required|string|max:255',
            'menus1' => 'required|exists:menus,id',
            'jp1' => 'required|integer|min:1|max:' . $this->stok1, // Batasan maksimum sesuai stok
        ],
            [
            'mode_pembayaran.required' => 'Pilih metode pembayaran',
            'namaPemesan.required' => 'Nama pemesan tidak boleh kosong',
            'menus1.required' => 'Pilih menu 1',
            'jp1.required' => 'Jumlah pesanan menu 1 tidak boleh kosong',
            'jp1.integer' => 'Jumlah pesanan menu 1 harus berupa angka',
            'jp1.min' => 'Jumlah pesanan menu 1 minimal 1',
            'jp1.max' => 'Jumlah pesanan menu 1 melebihi stok yang ada',
            ]
        );

        if ($this->menus2 != '0' && $this->jp2 != '0') {
            $this->validate([
                'menus2' => 'required|exists:menus,id',
                'jp2' => 'required|integer|min:1|max:' . $this->stok2, // Batasan maksimum sesuai stok
            ],
            [
                'menus2.required' => 'Pilih menu 2',
                'jp2.required' => 'Jumlah pesanan menu 2 tidak boleh kosong',
                'jp2.integer' => 'Jumlah pesanan menu 2 harus berupa angka',
                'jp2.min' => 'Jumlah pesanan menu 2 minimal 1',
                'jp2.max' => 'Jumlah pesanan menu 2 melebihi stok yang ada',
            ]);
        }
        // Menyimpan pesanan
        Pesanan::create([
            'menu1' => $this->menus1,
            'menu2' => $this->menus2 != '0' ? $this->menus2 : null,
            'jumlah1' => $this->jp1,
            'jumlah2' => $this->menus2 != '0' ? $this->jp2 : null,
            'total_harga' => $this->calculateTotal(),
            'status' => false,
            'nama_pemesan' => $this->namaPemesan,
            'mode_pembayaran' => $this->mode_pembayaran,
            'catatan' => $this->catatan,
        ]);

        // Mengirim pesan sukses
        session()->flash('message', 'Pesanan berhasil dilakukan!');
        return redirect()->route('form-pesanan');
    }

    public function batas($menu)
    {
        if($this->menus1=='0' ){
            $this->stok1 = 0;
        }
        if($this->menus2=='0' ){
            $this->stok2 = 0;
        }
        if ($menu == '1' && $this->menus1 != '0') {
            $this->stok1 = 0;
            $menuData = $this->menus->firstWhere('id', $this->menus1);
            $this->stok1 = $menuData ? $menuData['stock'] : 0;
        }
        if ($menu == '2' && $this->menus2 != '0') {
            $this->stok2 = 0;
            $menuData = $this->menus->firstWhere('id', $this->menus2);
            $this->stok2 = $menuData ? $menuData['stock'] : 0;
        }
    }

    public function getMenuPrice($menuId, $menu)
    {
        if ($menuId == '0') {
            if($menu == '1'){
                $this->stok1 = 0;}
            if($menu == '2'){
                $this->stok2 = 0;
            }
            return;
        }

        $menu = $this->menus->firstWhere('id', $menuId);
        return $menu ? $menu['harga'] : 0;
    }

    public function calculateTotal()
    {
        $total = 0;

        if ($this->menus1 != '0' && $this->jp1 != '0') {
            $total += $this->getMenuPrice($this->menus1,'1') * $this->jp1;
        }
        if ($this->menus2 != '0' && $this->jp2 != '0') {
            $total += $this->getMenuPrice($this->menus2,'2') * $this->jp2;
        }
        return $total;
    }
}
