<?php

namespace App\Http\Livewire\Admin\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Role as Roles;

class Role extends Component
{

    public $role;

    public function render()
    {
        $listRole = Roles::orderBy('created_at', 'DESC')->get();
        return view('livewire.admin.roles.role', compact('listRole'))->extends('layouts.app')->section('content');
    }

    public function createRole()
    {
        $this->validate([
            'role' => 'required|unique:roles,name'
        ]);

        Roles::firstOrCreate([
            'name' => $this->role
        ]);

        redirect()->back();

        $this->alert('success', 'Succesfully create new Role..', [
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

    public function deleteRole($id)
    {
        $role = Roles::find($id);
        $role->delete();

        $this->alert('success', 'Succesfully delete Role..', [
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
}
