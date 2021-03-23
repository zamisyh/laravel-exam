<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\siswa;
use App\Models\guru;
use Illuminate\Support\Facades\DB;

class Users extends Component
{
    public $userRole;
    public $userId, $editId;
    public $editForm, $openCreateForm;
    public $name, $email, $role, $password, $confirm_password;

    protected $listeners = [
        'confirmed',

    ];

    public function render()
    {
        $data['data']['users'] = User::orderBy('created_at', 'DESC')->get();

        return view('livewire.admin.users', $data)->extends('layouts.app')->section('content');
    }



    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }



    public function delete($id)
    {
        $this->triggerConfirm();
        $user = User::where('id', $id)->first();
        $this->userId = $user->id;
    }

    public function triggerConfirm()
    {
        $this->confirm('Are you sure delete this data?', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'cancelButtonText' => 'Cancel',
            'onConfirmed' => 'confirmed',
            'onCancelled' => 'cancelled'
        ]);
    }

    public function confirmed()
    {

        $user = User::where('id', $this->userId)->first();
        $user->delete();

        $this->alert('success', 'Succesfully Delete', [
            'position' =>  'center',
            'timer' =>  1000,
            'toast' =>  false,
            'text' =>  '',
            'confirmButtonText' =>  'Ok',
            'cancelButtonText' =>  'Cancel',
            'showCancelButton' =>  false,
            'showConfirmButton' =>  false,
        ]);
    }

    public function createForm()
    {
        $this->userRole = Role::orderBy('created_at', 'DESC')->get();
        $this->openCreateForm = true;
    }

    public function createUser()
    {
        $this->validate([
            'name' => 'required|min:4',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|exists:roles,name',
            'password' => 'required|min:6',
            'confirm_password' => 'required|min:6|same:password'
        ]);

        $user =  User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);

        $user->assignRole($this->role);

        $this->alert('success', 'Succesfully created new User', [
            'position' =>  'top-end',
            'timer' =>  3000,
            'toast' =>  true,
            'text' =>  '',
            'confirmButtonText' =>  'Ok',
            'cancelButtonText' =>  'Cancel',
            'showCancelButton' =>  false,
            'showConfirmButton' =>  false,
        ]);

        $this->openCreateForm = false;
    }


    public function edit($id)
    {
        $user = User::find($id);
        $this->userRole = Role::orderBy('created_at', 'DESC')->get();
        $this->name = $user->name;
        $this->email = $user->email;

        $this->editId = $user->id;
        $this->openCreateForm = true;
        $this->editForm = true;
    }

    public function updateUser($id)
    {
        $this->validate([
            'name' => 'required|min:4',
            'email' => 'required|email',
            'role' => 'required|exists:roles,name',
        ]);

        $user = User::where('id', $id)->first();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->update();

        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $user->assignRole($this->role);

        $this->alert('success', 'Succesfully created new User', [
            'position' =>  'top-end',
            'timer' =>  3000,
            'toast' =>  true,
            'text' =>  '',
            'confirmButtonText' =>  'Ok',
            'cancelButtonText' =>  'Cancel',
            'showCancelButton' =>  false,
            'showConfirmButton' =>  false,
        ]);

        $this->openCreateForm = false;
        $this->editForm = false;
        $this->resetForm();
    }
}
