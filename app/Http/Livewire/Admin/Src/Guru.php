<?php

namespace App\Http\Livewire\Admin\Src;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\guru as Teacher;
use App\Models\jurusan;
use App\Models\kelas;
use App\Models\mapel;

class Guru extends Component
{

    public $editForm, $viewForm, $dataTeacher, $dataJurusan, $dataId;
    public $name, $nip, $gender, $religion, $address;
    public $mapel, $class;

    public function render()
    {
        $data['data']['guru'] = Teacher::orderBy('created_at', 'DESC')->get();
        $data['data']['mapels'] = mapel::orderBy('created_at', 'DESC')->get();
        $data['data']['class'] = kelas::with('jurusan')->orderBy('nama', 'DESC')->get();
        return view('livewire.admin.src.guru', $data)->extends('layouts.app')->section('content');
    }

    public function viewForm($id)
    {
        $data = Teacher::find($id);
        $this->dataJurusan = jurusan::where('id', $data->id)->first();
        $this->name = $data->nama;
        $this->dataId = $data->id;


        // $this->name = $data->nama;
        // $this->nip = $data->nip;
        // $this->gender = $data->jenis_kelamin;
        // $this->religion = $data->agama;
        // $this->address = $data->alamat;

        $this->dataTeacher = Teacher::where('id', $id)->get();

        $this->viewForm = true;
    }

    public function editForm($id)
    {
        $data = Teacher::find($id);
        $this->name = $data->nama;
        $this->nip = $data->nip;
        $this->gender = $data->jenis_kelamin;
        $this->religion = $data->agama;
        $this->address = $data->alamat;

        $this->editForm = true;
        $this->viewForm = false;
    }
}
