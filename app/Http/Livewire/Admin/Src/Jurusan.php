<?php

namespace App\Http\Livewire\Admin\Src;

use Livewire\Component;
use App\Models\jurusan as Majors;

class Jurusan extends Component
{

    public $openFormMajor;
    public $name, $alias, $majorId;


    protected $listeners = [
        'confirmed',
    ];


    public function render()
    {
        $majors = Majors::orderBy('created_at', 'DESC')->get();
        return view('livewire.admin.src.jurusan', compact('majors'))->extends('layouts.app')->section('content');
    }


    public function createForm()
    {
        $this->openFormMajor = true;
    }


    public function createMajor()
    {
        $this->validate([
            'name' => 'required|unique:jurusan,nama',
            'alias' => 'required|unique:jurusan,alias',
        ]);


        Majors::create([
            'nama' => $this->name,
            'alias' => $this->alias
        ]);

        $this->alert('success', 'Succesfully create Major', [
            'position' =>  'top-end',
            'timer' =>  3000,
            'toast' =>  true,
            'text' =>  '',
            'confirmButtonText' =>  'Ok',
            'cancelButtonText' =>  'Cancel',
            'showCancelButton' =>  false,
            'showConfirmButton' =>  false,
        ]);

        $this->resetForm();
        $this->openFormMajor = false;
    }




    public function deleteMajor($id)
    {
        $this->triggerConfirm();
        $major = Majors::find($id);
        $this->majorId = $major->id;
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

        $major = Majors::where('id', $this->majorId)->first();
        $major->delete();

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

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }
}
