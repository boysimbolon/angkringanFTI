<?php

namespace App\Livewire;

use App\Models\Stock;
use Livewire\Component;
use App\Models\Menu; // Pastikan untuk mengimpor model Menu

class UpdateMenus extends Component
{
    public $menuId,$tambahan=0; // Properti untuk menyimpan ID menu
    public $menus, $stok, $harga, $menu; // Properti untuk menyimpan data menu

    public function mount($id)
    {
        // Ambil data menu dan stok berdasarkan ID yang diberikan
        $this->menuId = $id;
        $this->menus = Menu::findOrFail($this->menuId);
        $this->stok = Stock::where('menu_id', $this->menuId)->firstOrFail(); // Mengambil stok berdasarkan menu_id
        $this->menu = $this->menus->nama_menu;
        $this->harga = $this->menus->harga;
        $this->stok = $this->stok->jumlah; // Mengambil jumlah dari stok
    }

    public function render()
    {
        return view('livewire.update-menus')->layout('layouts.app');
    }

    public function updateMenu()
    {
        $this->validate([
            'menu' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'stok' => 'required|integer|min:0',
        ]);

        // Update data menu
        $menu = Menu::findOrFail($this->menuId);
        $menu->update([
            'nama_menu' => $this->menu, // Pastikan ini sesuai dengan nama kolom di tabel
            'harga' => $this->harga
        ]);

        // Temukan stok berdasarkan menuId dan update jumlahnya
        $stock = Stock::where('menu_id', $this->menuId)->firstOrFail(); // Ambil stok yang sesuai
        $stock->update([
            'jumlah' => $this->stok + $this->tambahan
        ]);

        // Kirim pesan sukses ke sesi
        session()->flash('message', 'Menu berhasil diperbarui!');
        return redirect()->route('menu');
    }
}
