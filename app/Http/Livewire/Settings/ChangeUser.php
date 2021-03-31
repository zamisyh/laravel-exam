<?php

namespace App\Http\Livewire\Settings;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ChangeUser extends Component
{

    public $changePass, $uid;
    public $name, $email, $password, $confirm_password;

    protected $listeners = ['update' => '$refresh'];


    public function mount()
    {
        $user = User::where('id', Auth::user()->id)->first();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->uid = $user->id;
    }

    public function render()
    {
       
        return view('livewire.settings.change-user')->extends('layouts.app')->section('content');
    }

    public function changePassword() {$this->changePass = true;}
    public function closePassword() {$this->changePass = false;}


    public function updateUser($id)
    {
        $this->validate([
            'name' => 'required|min:4',
            'email' => 'required|email',
            'password' => $this->changePass == true ? 'required' : '',
            'confirm_password' => $this->changePass == true ? 'required|same:password' : '',
          
           
        ]);

        try {
            $user = User::find($id);
            $user->name = $this->name;
            $user->email = $this->email;
            $user->update();

            $this->changePass == true ? $user->password = bcrypt($this->password) : $this->password = $user->password;

            $user->update();

            $this->alert('success', 'Succesfully update data', [
                'position' =>  'top-end',
                'timer' =>  3000,
                'toast' =>  true,
                'text' =>  '',
                'confirmButtonText' =>  'Ok',
                'cancelButtonText' =>  'Cancel',
                'showCancelButton' =>  false,
                'showConfirmButton' =>  false,
            ]);
           
            
            $this->emit('update');

        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        
    }
}

