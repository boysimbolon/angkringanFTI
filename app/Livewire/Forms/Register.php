<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Register extends Component
{
    public $nim;
    public $pin;
    public $login_as;

    public function register()
    {
        // Validate input data
        $validatedData = $this->validate([
            'nim' => ['required', 'string', 'unique:users,nim'],
            'pin' => ['required', 'string', 'min:6'],
            'login_as' => ['required', 'in:1,2'],
        ],
        [
            'nim.required' => 'NIM harus diisi',
            'nim.unique' => 'NIM sudah terdaftar',
            'pin.required' => 'PIN harus diisi',
            'pin.min' => 'PIN minimal 6 karakter',
            'login_as.required' => 'Pilih login sebagai',
            'login_as.in' => 'Pilih login sebagai yang tersedia',
        ]);
        // Create a new user
        User::create([
            'nim' => $validatedData['nim'],
            'password' => Hash::make($validatedData['pin']),
            'login_as' => $validatedData['login_as'],
        ]);

        // Flash success message
        session()->flash('message', 'Akun berhasil dibuat');

        // Optionally reset form fields
        $this->reset(['nim', 'pin', 'login_as']);
    }

    public function render()
    {
        return view('livewire.forms.register');
    }
}
