<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\guru;
use App\Models\mapel;
use App\Models\siswa;
use App\Models\ujian;

class Dashboard extends Component
{


    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $openRegisterSiswa, $openRegisterGuru;

    public $perPage = 3;

    public function mount()
    {
        $user = User::where('id', Auth::user()->id)->first();

        if ($user->is_active == 0 && $user->getRoleNames()[0] == 'siswa') {
            $this->openRegisterSiswa = true;
        } else if ($user->is_active == 0 && $user->getRoleNames()[0] == 'guru') {
            $this->openRegisterGuru = true;
        } else {
            //
        }
    }


    public function render()
    {
        $user = User::where('id', Auth::user()->id)->first();
        $data = null;

        if ($user->getRoleNames()[0] == 'guru') {
            $data['data']['countSiswa'] = siswa::count();
            $guru = guru::where('user_id', Auth::user()->id)->first();
            $data['data']['countUjian'] = ujian::where('guru_id', $guru->id)->count();
            $data['data']['ujian'] = ujian::with('ujian_setting', 'guru', 'mapel', 'kelas.jurusan')->orderBy('created_at', 'DESC')->paginate($this->perPage);

        } else {
            $data['data']['null'] = null;
        }

        return view('livewire.dashboard', $data)->extends('layouts.app')->section('content');
    }
}
