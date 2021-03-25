<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\guru;
use App\Models\mapel;
use App\Models\siswa;

class Dashboard extends Component
{

    public $openRegisterSiswa, $openRegisterGuru;

    public function mount()
    {
        $user = User::where('id', Auth::user()->id)->first();

        if ($user->is_active == 0 && $user->getRoleNames()[0] == 'siswa') {
            $this->openRegisterSiswa = true;
        } else if ($user->is_active == 0 && $user->getRoleNames()[0] == 'guru') {
            $this->openRegisterGuru = true;
        } else {
            //
        }
    }


    public function render()
    {
        $data = guru::where('user_id', Auth::user()->id)->get();

        return view('livewire.dashboard', compact('data'))->extends('layouts.app')->section('content');
    }



    public function logout()
    {
        Auth::logout();
        return redirect()->route('client.signin');
    }
}
