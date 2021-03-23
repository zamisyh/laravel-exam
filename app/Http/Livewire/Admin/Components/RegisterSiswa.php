<?php

namespace App\Http\Livewire\Admin\Components;

use Livewire\Component;

class RegisterSiswa extends Component
{

    public $password;

    public function render()
    {
        return view('livewire.admin.components.register-siswa');
    }
}
