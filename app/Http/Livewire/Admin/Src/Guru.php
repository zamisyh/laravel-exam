<?php

namespace App\Http\Livewire\Admin\Src;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\guru as Teacher;
use App\Models\jurusan;
use App\Models\kelas;
use App\Models\mapel;
use App\Models\Pivot\GuruMapel;

class Guru extends Component
{

    public $editForm, $viewForm, $dataTeacher, $dataJurusan, $dataId;
    public $name, $nip, $gender, $religion, $address;
    public $mapel, $class;
    public $dataMapelId, $guruId;

    protected $listeners = [
        'confirmed',
    ];

    public function render()
    {
        $data['data']['guru'] = Teacher::orderBy('created_at', 'DESC')->get();
        $data['data']['mapels'] = mapel::orderBy('created_at', 'DESC')->get();
        $data['data']['class'] = kelas::orderBy('nama', 'DESC')->get();

        return view('livewire.admin.src.guru', $data)->extends('layouts.app')->section('content');
    }

    public function viewForm($id)
    {
        $data = Teacher::find($id);
       
        $this->name = $data->nama;
        $this->dataId = $data->id;


        // $this->name = $data->nama;
        // $this->nip = $data->nip;
        // $this->gender = $data->jenis_kelamin;
        // $this->religion = $data->agama;
        // $this->address = $data->alamat;

        $this->dataTeacher = Teacher::where('id', $id)->with('kelas.jurusan')->get();


        $this->viewForm = true;
    }

    public function editForm($id)
    {
        $data = Teacher::find($id);

        $this->dataMapelId = $data->mapel()->pluck('mapel_id');


        $this->name = $data->nama;
        $this->nip = $data->nip;
        $this->gender = $data->jenis_kelamin;
        $this->religion = $data->agama;
        $this->address = $data->alamat;
        $this->guruId = $data->id;


        $this->editForm = true;
        $this->viewForm = false;
    }


    public function update($id)
    {
        $this->validate([
            'name' => 'required|min:4',
            'nip' => 'required|numeric',
            'gender' => 'required',
            'religion' => 'required',
            'address' => 'required',
            'mapel' => 'required',
            'class' => 'required'
        ]);

        try {
            $data = Teacher::find($id);

            $data->nama = $this->name;
            $data->nip = $this->nip;
            $data->jenis_kelamin = $this->gender;
            $data->agama = $this->religion;
            $data->alamat = $this->address;

            $data->kelas()->sync($this->class);
            $data->mapel()->sync($this->mapel);
            $data->update();

            $this->resetForm();
            $this->editForm = false;
            $this->viewForm = false;


            $this->alert('success', 'Succesfully update Teacher', [
                'position' =>  'top-end',
                'timer' =>  3000,
                'toast' =>  true,
                'text' =>  '',
                'confirmButtonText' =>  'Ok',
                'cancelButtonText' =>  'Cancel',
                'showCancelButton' =>  false,
                'showConfirmButton' =>  false,
            ]);
        } catch (\Exception $e) {
            dd($e);
        }
    }


    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }

    public function deleteForm($id)
    {
        $data = Teacher::find($id);
        $this->triggerConfirm();
        $this->guruId = $data->id;
    }



    //Sweetalert

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

        $data = Teacher::where('id', $this->guruId)->first();
        $user = User::find($data->user_id);
        $user->delete();
        $data->delete();


        $data->kelas()->detach($this->class);
        $data->mapel()->detach($this->mapel);

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
}
