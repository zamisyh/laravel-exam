<?php

namespace App\Http\Livewire\Admin\Roles;

use Livewire\Component;

class Permission extends Component
{
    public function render()
    {
        return view('livewire.admin.roles.permission')->extends('layouts.app')->section('content');
    }
}
