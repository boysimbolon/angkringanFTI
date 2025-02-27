<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Login extends Component
{
    public $nim;
    public $pin;
    public function verify()
    {
        $validated = $this->validate([
            'nim' => 'required',
            'pin' => 'required',
        ]);

        $user = User::where('nim', $this->nim)->first();

        if (!$user) {
            $this->addError('nim', 'NIM tidak ditemukan');
            return;
        }

        if (!Hash::check($this->pin, $user->password)) {
            $this->addError('pin', 'Password salah');
            return;
        }

        // Jika login berhasil
        if ($user->login_as == 1) {
            session()->put('login_as', 'bendahara');
            return redirect()->route('stok-bendahara');
        } else {
            session()->put('login_as', 'serving');
            return redirect()->route('stok-serving');
        }
    }
    public function render()
    {
        return view('livewire.forms.login');
    }
}
