<?php

namespace App\Livewire;

use App\Models\Menu;
use App\Models\Stock;
use Livewire\Component;

class Menus extends Component
{
    public $menus;
    public function mount(){
        $menu = Menu::all();
        $stock = Stock::all();
        $this->menus = $menu->map(function($item) use ($stock){
            $stok = $stock->where('menu_id', $item->id)->first();
            return [
                'id' => $item->id,
                'menu' => $item->nama_menu,
                'harga' => $item->harga,
                'stok' => $stok->jumlah,
            ];
        })->toArray();
    }
    public function render()
    {
        return view('livewire.menus')->layout('layouts.app');
    }
}
