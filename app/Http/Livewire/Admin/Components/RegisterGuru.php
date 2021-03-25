<?php

namespace App\Http\Livewire\Admin\Components;

use Livewire\Component;
use App\Models\guru;
use App\Models\kelas;
use App\Models\mapel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisterGuru extends Component
{

    public $redirect;
    public $name, $nip, $gender, $religion, $address, $checkbox;
    public $mapel;
    public $class;

    public function render()
    {
        $data['data']['mapels'] = mapel::orderBy('created_at', 'DESC')->get();
        $data['data']['class'] = kelas::with('jurusan')->orderBy('nama', 'DESC')->get();
        return view('livewire.admin.components.register-guru', $data);
    }

    public function createGuru()
    {
        $this->validate([
            'name' => 'required|min:4',
            'nip' => 'required|numeric',
            'gender' => 'required',
            'religion' => 'required',
            'address' => 'required',
            'checkbox' => 'required',
            'mapel' => 'required',
            // 'class' => 'required'
        ]);

        try {



            $guru = guru::create([
                'nama' => $this->name,
                'nip' => $this->nip,
                'jenis_kelamin' => $this->gender,
                'agama' => $this->religion,
                'alamat' => $this->address,
                'user_id' => Auth::user()->id,
            ]);

            $guru->kelas()->attach($this->class);
            $guru->mapel()->attach($this->mapel);




            // $guru->mapel()->attach($this->mapel);
            // $guru->kelas()->attach($this->class);

            $user = User::find(Auth::user()->id);
            $user->is_active = true;
            $user->update();

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

            dd($e->getMessage());
            // $this->alert('error', 'Errors', [
            //     'position' =>  'center',
            //     'timer' =>  2000,
            //     'toast' =>  false,
            //     'text' =>  'Something went wrong, please try again later.',
            //     'confirmButtonText' =>  'Ok',
            //     'cancelButtonText' =>  'Close',
            //     'showCancelButton' =>  true,
            //     'showConfirmButton' =>  false,
            // ]);
        }
    }
}
