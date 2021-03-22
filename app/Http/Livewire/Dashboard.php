<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.dashboard')->extends('layouts.app')->section('content');
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('client.signin');
    }
}
