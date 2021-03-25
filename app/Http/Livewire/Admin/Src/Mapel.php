<?php

namespace App\Http\Livewire\Admin\Src;

use Livewire\Component;
use App\Models\mapel as Mpl;

class Mapel extends Component
{

    public $openFormMapel;
    public $name, $mapelId;


    protected $listeners = [
        'confirmed',
    ];

    public function render()
    {
        $mapels = Mpl::orderBy('created_at', 'DESC')->get();
        return view('livewire.admin.src.mapel', compact('mapels'))->extends('layouts.app')->section('content');
    }

    public function createForm()
    {
        $this->openFormMapel = true;
    }


    public function createMapel()
    {
        $this->validate([
            'name' => 'required|unique:mapel,nama',

        ]);


        Mpl::create([
            'nama' => $this->name,

        ]);

        $this->alert('success', 'Succesfully create mapel', [
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
        $this->openFormMapel = false;
    }




    public function deleteMapel($id)
    {
        $this->triggerConfirm();
        $mapel = Mpl::find($id);
        $this->mapelId = $mapel->id;
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

        $mapel = Mpl::where('id', $this->mapelId)->first();
        $mapel->delete();

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
