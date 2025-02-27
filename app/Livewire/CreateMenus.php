<?php

namespace App\Livewire;

use App\Models\Menu;
use App\Models\Stock;
use Livewire\Component;

class CreateMenus extends Component
{
    public $menu,$harga,$stok;
    public function render()
    {
        return view('livewire.create-menus')->layout('layouts.app');
    }
    public function create(){
        $this->validate([
            'menu' => 'required',
            'harga' => 'required',
            'stok' => 'required',
        ]);
        $id_menu=Menu::create ([
            'nama_menu' => $this->menu,
            'harga' => $this->harga,
        ]);
        Stock::create([
            'menu_id' => $id_menu->id,
            'jumlah' => $this->stok,
        ]);
        session()->flash('message', 'Menu berhasil ditambahkan!');
        return redirect()->route('menu');
    }
}
