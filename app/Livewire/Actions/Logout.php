<?php

namespace App\Livewire\Actions;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Logout
{
    /**
     * Log the current user out of the application.
     */
    public function __invoke(): \Illuminate\Http\RedirectResponse
    {
        if (session('login_as') == 'bendahara') {
            Session::flush();
        } else {
            Session::flush();
        }
        Session::invalidate();
        Session::regenerateToken();
        \session()->flash('message', 'Berhasil logout');
        return redirect()->route('login');
    }
}
