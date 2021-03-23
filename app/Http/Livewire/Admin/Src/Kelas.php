<?php

namespace App\Http\Livewire\Admin\Src;

use Livewire\Component;
use App\Models\kelas as Cl;
use App\Models\jurusan;

class Kelas extends Component
{

    public $openFormClass;
    public $class, $classId, $dataJurusan, $major, $number;


    protected $listeners = [
        'confirmed',
    ];


    public function render()
    {
        $dataClass = Cl::with('jurusan')->orderBy('created_at', 'DESC')->get();
        return view('livewire.admin.src.kelas', compact('dataClass'))->extends('layouts.app')->section('content');
    }

    public function createForm()
    {
        $this->dataJurusan = jurusan::orderBy('created_at', 'DESC')->get();
        $this->openFormClass = true;
    }


    public function createClass()
    {
        $this->validate([
            'class' => 'required|numeric',
            'major' => 'required',
            'number' => 'required|numeric'
        ]);


        Cl::create([
            'nama' => $this->class,
            'jurusan_id' => $this->major,
            'no' => $this->number
        ]);

        $this->alert('success', 'Succesfully create class', [
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
        $this->openFormClass = false;
    }




    public function deleteClass($id)
    {
        $this->triggerConfirm();
        $class = Cl::find($id);
        $this->classId = $class->id;
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

        $class = Cl::where('id', $this->classId)->first();
        $class->delete();

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
