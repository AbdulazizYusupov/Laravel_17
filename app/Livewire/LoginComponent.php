<?php

namespace App\Livewire;

use App\Models\Jurnal;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LoginComponent extends Component
{
    public $email;
    public $password;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:8',
    ];
    public function render()
    {
        return view('livewire.login-component')->layout('components.layouts.sign');
    }
    public function check()
    {
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            $user = Auth::user();
            if ($user->role == 'admin') {
                return redirect('/category');
            }
        }
    }
}
