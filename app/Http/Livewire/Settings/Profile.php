<?php

namespace App\Http\Livewire\Settings;

use Livewire\Component;
use App\Models\guru;
use App\Models\siswa;
use App\Models\User;
use App\Models\jurusan;
use App\Models\kelas;
use App\Models\mapel;
use Illuminate\Support\Facades\Auth;

class Profile extends Component
{

    public $pageSiswa, $pageAdmin, $pageGuru;
    public $editPageGuru, $editPageSiswa;
    public $guruId, $siswaId;

    //for guru
    public $name, $nip, $gender, $religion, $address, $mapel, $class;

    //for siswa

    public $nameSiswa, $nisSiswa, $genderSiswa, $religionSiswa, $classSiswa, $majorSiswa;

    public function render()
    {

        $data = null;
        $user = User::where('id', Auth::user()->id)->first();

        if ($user->getRoleNames()[0] == 'siswa') {

            $data['data']['student'] = siswa::where('user_id', Auth::user()->id)->with('jurusan', 'kelas')->first();
            $data['data']['majors'] = jurusan::orderBy('created_at', 'DESC')->get();
            $data['data']['class'] = kelas::with('jurusan')->orderBy('created_at', 'DESC')->get();
            $this->pageSiswa = true;
        } else if ($user->getRoleNames()[0] == 'guru') {

            $data['data']['teacher'] = guru::where('user_id', Auth::user()->id)->with('kelas.jurusan', 'kelas', 'mapel')->first();
            $data['data']['mapels'] = mapel::orderBy('created_at', 'DESC')->get();
            $data['data']['class'] = kelas::orderBy('nama', 'DESC')->get();
            $this->pageGuru = true;
            $this->guruId = $data['data']['teacher']['id'];
        } else if ($user->getRoleNames()[0] == 'admin') {
            dd('You Admin');
        }


        return view('livewire.settings.profile', $data)->extends('layouts.app')->section('content');
    }


    //Action For Guru

    public function editGuru($id)
    {
        $data = guru::find($id);

        $this->dataMapelId = $data->mapel()->pluck('mapel_id');


        $this->name = $data->nama;
        $this->nip = $data->nip;
        $this->gender = $data->jenis_kelamin;
        $this->religion = $data->agama;
        $this->address = $data->alamat;
        $this->guruId = $data->id;



        $this->editPageGuru = true;
    }


    public function updateGuru($id)
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
            $data = guru::find($id);

            $data->nama = $this->name;
            $data->nip = $this->nip;
            $data->jenis_kelamin = $this->gender;
            $data->agama = $this->religion;
            $data->alamat = $this->address;

            $data->kelas()->sync($this->class);
            $data->mapel()->sync($this->mapel);
            $data->update();

            $this->resetForm();
            $this->editPageGuru = false;



            $this->alert('success', 'Succesfully update', [
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

    //End Action For Guru



    //Action for siswa

    public function editSiswa($id)
    {
        $siswa = siswa::find($id);

        $this->nameSiswa = $siswa->nama;
        $this->nisSiswa = $siswa->nis;
        $this->genderSiswa = $siswa->jenis_kelamin;
        $this->religionSiswa = $siswa->agama;
        $this->majorSiswa = $siswa->jurusan_id;
        $this->classSiswa = $siswa->kelas_id;
        $this->siswaId = $siswa->id;

        $this->editPageSiswa = true;
    }

    public function updateSiswa($id)
    {

        $this->validate([
            'nameSiswa' => 'required|min:4',
            'nisSiswa' => 'required|numeric',
            'genderSiswa' => 'required',
            'religionSiswa' => 'required',
            'majorSiswa' => 'required',
            'classSiswa' => 'required'
        ]);

        $siswa = siswa::find($id);

        try {
            $siswa->nama = $this->nameSiswa;
            $siswa->nis = $this->nisSiswa;
            $siswa->jenis_kelamin = $this->genderSiswa;
            $siswa->agama = $this->religionSiswa;
            $siswa->jurusan_id = $this->majorSiswa;
            $siswa->kelas_id =  $this->classSiswa;

            $siswa->update();
            $this->editPageSiswa = false;

            $this->alert('success', 'Succesfully update', [
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
            dd($e->getMessage());
        }
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }
}
