<?php

namespace App\Http\Livewire\Admin\Components;

use Livewire\Component;
use App\Models\siswa;
use App\Models\jurusan;
use App\Models\kelas;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RegisterSiswa extends Component
{

    public $name, $nis, $majors, $religion, $class, $gender;
    public $redirect;

    public function render()
    {
        $data['data']['majors'] = jurusan::orderBy('created_at', 'DESC')->get();
        $data['data']['class'] = kelas::with('jurusan')->orderBy('created_at', 'DESC')->get();
        return view('livewire.admin.components.register-siswa', $data);
    }

    public function createSiswa()
    {
        $data = $this->validate([
            'name' => 'required|min:4',
            'nis' => 'required|numeric',
            'majors' => 'required|exists:jurusan,id',
            'gender' => 'required',
            'religion' => 'required',
            'class' => 'required'
        ]);

        try {

            siswa::create([
                'nama' => ucwords(strtolower($this->name)),
                'nis' => $this->nis,
                'jenis_kelamin' => $this->gender,
                'agama' => $this->religion,
                'jurusan_id' => $this->majors,
                'kelas_id' => $this->class,
                'user_id' => Auth::user()->id,
            ]);




            $data = User::find(Auth::user()->id);
            $data->is_active = true;
            $data->update();


            $this->alert('success', 'Succesfully Register', [
                'position' =>  'center',
                'timer' =>  3000,
                'toast' =>  false,
                'text' =>  'Hooray, now your account is active, redirecting...',
                'confirmButtonText' =>  'Ok',
                'cancelButtonText' =>  'Close',
                'showCancelButton' =>  true,
                'showConfirmButton' =>  false,
            ]);

            $this->redirect = true;
        } catch (\Exception $e) {

            $this->alert('error', 'Errors', [
                'position' =>  'center',
                'timer' =>  2000,
                'toast' =>  false,
                'text' =>  'Something went wrong, please try again later.',
                'confirmButtonText' =>  'Ok',
                'cancelButtonText' =>  'Close',
                'showCancelButton' =>  true,
                'showConfirmButton' =>  false,
            ]);
        }
    }
}
