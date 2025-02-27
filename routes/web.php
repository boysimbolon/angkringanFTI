<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \App\Livewire\StokList::class)
    ->name('stok');

Route::prefix('bendahara')->middleware('bendahara')->group(function () {
    Route::get('pesan', \App\Livewire\FormPesanan::class)
        ->name('form-pesanan');
    Route::get('menu', \App\Livewire\Menus::class)
        ->name('menu');
    Route::get('menu/create', \App\Livewire\CreateMenus::class)
        ->name('create-menu');
    Route::get('menu/Edit/{id}', \App\Livewire\UpdateMenus::class)
        ->name('edit-menu');
    Route::get('menu/tambah/{id}', \App\Livewire\UpdateMenus::class)
        ->name('tambah');
    Route::get('/', \App\Livewire\StokList::class)
        ->name('stok-bendahara');
    Route::get('histori', \App\Livewire\HistoryList::class)
        ->name('histori');
});
Route::prefix('serving')->middleware('serving')->group(function ()
{
    Route::get('histori', \App\Livewire\HistoryList::class)
        ->name('histori');
    Route::get('/', \App\Livewire\StokList::class)
        ->name('stok-serving');
});
Route::get('logout',\App\Livewire\Actions\Logout::class)->name('logout');
Route::get('register', \App\Livewire\Forms\Register::class)->name('register');
Route::get('login', \App\Livewire\Forms\Login::class)->name('login');
require __DIR__.'/auth.php';
