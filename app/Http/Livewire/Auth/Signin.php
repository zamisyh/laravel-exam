<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Signin extends Component
{

    public $email, $password;
    public $redirect;

    public function render()
    {

        return view('livewire.auth.signin')->extends('layouts.client')->section('content');
    }


    protected $messages = [
        'email.exists' => 'Email is not registered in the database',
    ];


    public function signin()
    {
        $this->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6'
        ]);


        try {

            if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
                $this->alert('success', 'Succesfully login, redirecting..', [
                    'position' =>  'top-end',
                    'timer' =>  3000,
                    'toast' =>  true,
                    'text' =>  '',
                    'confirmButtonText' =>  'Ok',
                    'cancelButtonText' =>  'Cancel',
                    'showCancelButton' =>  false,
                    'showConfirmButton' =>  false,
                ]);


                $this->redirect = true;
            } else {
                $this->alert('error', 'Oppss, invalid data', [
                    'position' =>  'top-end',
                    'timer' =>  3000,
                    'toast' =>  true,
                    'text' =>  '',
                    'confirmButtonText' =>  'Ok',
                    'cancelButtonText' =>  'Cancel',
                    'showCancelButton' =>  false,
                    'showConfirmButton' =>  false,
                ]);
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
