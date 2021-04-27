<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\guru;
use App\Models\siswa;
use App\Models\ujian;
use App\Models\hasil;
use Illuminate\Support\Facades\Session;

class Dashboard extends Component
{


    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $openRegisterSiswa, $openRegisterGuru;

    public $perPage = 3;
    public $amount = 2;

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
            $guru = guru::where('user_id', Auth::user()->id)->first();
            $data['data']['null'] = null;
            if ($user->is_active == 1 && $user->getRoleNames()[0] == 'guru') {
                $kelas = [];
                for ($i = 0; $i < count($guru->kelas); $i++) {
                    $kelas[] = $guru->kelas[$i]->id;
                }

                $data['data']['activity'] = hasil::with('siswa', 'ujian', 'ujian.mapel', 'kelas')
                    ->orderBy('created_at', 'DESC')->take($this->amount)->get();


                $data['data']['countSiswa'] = siswa::where('kelas_id', $kelas)->count();
                $data['data']['countUjian'] = ujian::where('guru_id', $guru->id)->count();
                $data['data']['ujian'] = ujian::where('guru_id', $guru->id)->with('ujian_setting', 'guru', 'mapel', 'kelas.jurusan')->orderBy('created_at', 'DESC')->paginate($this->perPage);
            }
        } elseif ($user->getRoleNames()[0] == 'siswa') {
            $data['data']['siswa'] = siswa::where('user_id', $user->id)->first();
            $data['data']['null'] = null;
            if ($user->is_active == 1 && $user->getRoleNames()[0] == 'siswa') {
                $data['data']['ujian'] = ujian::where('status', 1)
                    ->where('kelas_id', $data['data']['siswa']['kelas_id'])
                    ->with('ujian_setting', 'soal', 'guru', 'mapel')
                    ->orderBy('created_at', 'DESC')
                    ->get();
                $data['data']['hasil'] = hasil::where('siswa_id', $data['data']['siswa']['id'])
                    ->with('ujian.ujian_setting', 'ujian.mapel')->get();
            }
        } else {
            $data['data']['null'] = null;
        }

        return view('livewire.dashboard', $data)->extends('layouts.app')->section('content');
    }


    public function viewMore()
    {
        $this->amount += 2;
    }
}
