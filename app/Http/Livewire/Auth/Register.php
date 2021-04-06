<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use App\Models\Siswa;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;



class Register extends Component
{

    public $email, $username, $password, $confirm_password;
    public $redirect;


    public function render()
    {
        return view('livewire.auth.register')->extends('layouts.client')->section('content');
    }


    public function signup()
    {
        $this->validate([
            'email' => 'required|email|unique:users,email',
            'username' => 'required|min:4',
            'password' => 'required|string|min:6',
            'confirm_password' => 'required|min:6|same:password'
        ]);


        try {


            $user = User::create([
                'email' => $this->email,
                'name' => $this->username,
                'password' => bcrypt($this->password)
            ]);

            $user->assignRole('siswa');



            $this->alert('success', 'Succesfully signup, redirecting..', [
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
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
