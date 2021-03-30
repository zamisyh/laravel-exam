<?php

namespace App\Http\Livewire\Admin\Src;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\siswa as Student;
use App\Models\jurusan;
use App\Models\kelas;


class Siswa extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['confirmed'];


    public $search;
    public $row_page = 10;
    public $openEdit;

    public $name, $nis, $majors, $religion, $class, $gender, $siswa_id;

    public function render()
    {
        $student = Student::with('kelas', 'jurusan', 'user')->orderBy('created_at', 'DESC')->paginate($this->row_page);
        $data['data']['majors'] = jurusan::orderBy('created_at', 'DESC')->get();
        $data['data']['class'] = kelas::with('jurusan')->orderBy('created_at', 'DESC')->get();
        return view('livewire.admin.src.siswa', $data, compact('student'))->extends('layouts.app')->section('content');
    }


    public function editSiswa($id)
    {
        $data = Student::with('kelas', 'jurusan', 'user')->find($id);

        $this->name = $data->nama;
        $this->nis =  $data->nis;
        $this->religion = $data->agama;
        $this->gender = $data->jenis_kelamin;
        $this->majors = $data->jurusan_id;
        $this->class = $data->kelas_id;
        $this->siswa_id = $data->id;

        $this->openEdit = true;
    }

    public function updateSiswa($id)
    {
        $data = Student::find($id);
        $data->nama = $this->name;
        $data->nis = $this->nis;
        $data->agama = $this->religion;
        $data->jenis_kelamin = $this->gender;
        $data->jurusan_id = $this->majors;
        $data->kelas_id = $this->class;

        $data->update();

        $this->openEdit = false;

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
    }

    public function deleteSiswa($id)
    {
        $data = Student::find($id);
        $this->siswa_id = $data->id;
        $this->triggerConfirm();
    }

    /**
     * Sweet alert delete
     */

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

        $student = Student::where('id', $this->siswa_id)->first();
        $student->delete();

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
