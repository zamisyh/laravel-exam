<?php

namespace App\Http\Livewire\Admin\Guru;

use Livewire\Component;
use App\Models\guru;
use App\Models\ujian;
use App\Models\ujian_setting;
use App\Models\soal;
use Illuminate\Support\Facades\Auth;


class BankSoal extends Component
{

    public $viewMoreSetting;
    public $openCreateForm;
    public $openFormCreateClick;

    public $judul, $mapel, $kelas, $jumlah_soal, $tanggal_mulai,
        $tanggal_selesai, $waktu, $token, $acak_soal, $acak_pilihan, $tampil_nilai;

    public function render()
    {

        $data['data']['mapelkelas'] = guru::where('user_id', Auth::user()->id)->get();
        return view('livewire.admin.guru.bank-soal', $data)->extends('layouts.app')->section('content');
    }

    public function activateLoadMore()
    {
        $this->viewMoreSetting = true;
    }
    public function openFormCreateClick()
    {
        $this->openCreateForm = true;
    }


    public function saveUjian()
    {
        $data = $this->validate([
            'judul' => 'required',
            'mapel' => 'required',
            'kelas' => 'required',
            'jumlah_soal' => 'required|numeric',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
            'waktu' => 'required|numeric',
            'token' => 'required',
            'acak_soal' => 'required',
            'acak_pilihan' => 'required',
            'tampil_nilai' => 'required',

        ]);

        dd($data);
    }
}
