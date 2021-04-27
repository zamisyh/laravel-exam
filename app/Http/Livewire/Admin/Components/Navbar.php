<?php

namespace App\Http\Livewire\Admin\Components;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class Navbar extends Component
{

    public $roleUser;

    public function mount()
    {
        $user = User::where('id', Auth::user()->id)->first();
        $this->roleUser = $user->getRoleNames()[0];
    }

    public function render()
    {
        return view('livewire.admin.components.navbar');
    }


    public function logout()
    {
        redirect()->route('client.signin');
        Session::forget('data');
        Auth::logout();
    }
}
