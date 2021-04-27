<?php

namespace App\Http\Livewire\Admin\Siswa;


use Livewire\Component;
use Livewire\WithPagination;

use App\Models\jawaban;
use App\Models\hasil;
use App\Models\siswa;
use App\Models\soal;
use App\Models\ujian as ModelsUjian;
use Carbon\Carbon;
use Error;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Symfony\Component\VarDumper\Cloner\Data;

class Ujian extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'saveAnswer', 'saveSoalPerPage',
        'timerDone', 'saveSoal',
        'confirmed',

    ];

    public $ujian, $hasilSiswa, $user, $getUjianSoalId, $soal, $getIdUjian;
    public $token, $tokenError, $openUjianForm;
    public $answer = [];
    public $time, $refresh, $date, $startDate, $endDate, $getDate, $getJawaban;

    public function mount($mapel, $id)
    {
        $this->ujian = ModelsUjian::where('id', $id)
            ->where('status', 1)
            ->with('ujian_setting')
            ->first();


        $this->user = siswa::where('user_id', Auth::user()->id)->first();
        $this->getIdUjian = $id;


        $this->date = date('Y-m-d');
        $this->startDate = $this->ujian->tanggal_mulai;
        $this->endDate = $this->ujian->tanggal_akhir;

        $this->getDate = ModelsUjian::where('id', $id)->whereBetween('tanggal_mulai', [$this->startDate, $this->endDate])->first();
        $this->hasilSiswa = hasil::where('ujian_id', $id)
            ->where('siswa_id', $this->user->id)
            ->with('ujian.ujian_setting', 'siswa')->first();
    }

    public function render()
    {

        $session = Session::get('data');

        $soals = null;
        $jawaban = null;

        $this->date = date('Y-m-d');
        $this->startDate = $this->ujian->tanggal_mulai;
        $this->endDate = $this->ujian->tanggal_akhir;




        if ($session != null) {
            $this->openUjianForm = true;
            $this->time = $session[0]['time'];
            if ($this->ujian->ujian_setting->urutan_soal == true) {
                $soals = soal::where('ujian_id', $this->getIdUjian)->inRandomOrder()->get();
                $jawaban = jawaban::where('ujian_id', $session['0']['ujian_id'])->get();
            } else {
                $soals = soal::where('ujian_id', $this->getIdUjian)->get();
                $jawaban = jawaban::where('ujian_id', $session['0']['ujian_id'])->get();
            }
        }



        return view('livewire.admin.siswa.ujian', compact('soals', 'jawaban'))->extends('layouts.app')->section('content');
    }

    public function ujianNow()
    {
        $getTokenFromDb = $this->ujian->token;
        //Compare token

        $data = null;

        if ($this->token === $getTokenFromDb) {
            $data = [
                'id_siswa' => $this->user->id,
                'token' => $this->token,
                'ujian_id' => $this->ujian->id,
                'time' => $this->ujian->ujian_setting->waktu,
                'ujianForm' => true
            ];

            Session::push('data', $data);

            $this->tokenError = false;
        } else {
            $this->tokenError = true;
        }
    }

    public function saveSoal($id)
    {

        $this->triggerConfirm();

        // dd(array_values($this->answer));

        // $this->triggerConfirm();
        // $key = collect(soal::where('ujian_id', $session[0]['ujian_id'])->pluck('id'));
        // $value = $key->combine(soal::where('ujian_id', $session[0]['ujian_id'])->pluck('kunci'));
        // $intersect = $value->intersect($this->answer);

    }


    public function triggerConfirm()
    {
        $this->confirm('Apakah anda yakin sudah menyelesaikan ujian ini?', [
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

        $session = Session::get('data');

        $siswa_id = $session[0]['id_siswa'];
        $ujian_id =  $session[0]['ujian_id'];

        $getSoalId = soal::where('ujian_id', $ujian_id)->pluck('id');
        $getSoalUraian = soal::where('ujian_id', $ujian_id)->pluck('uraian');
        $true_answer_jawaban = soal::where('ujian_id', $ujian_id)->pluck('kunci');
        $given_answer_jawaban = array_values($this->answer);

        $data_answer = [];

        for ($i = 0; $i < count($getSoalId); $i++) {
            $data_answer[] = [
                'siswa_id' => $siswa_id,
                'ujian_id' => $ujian_id,
                'soal_id' => $getSoalId[$i],
                'uraian' => $getSoalUraian[$i],
                'given_answer' => $given_answer_jawaban[$i],
                'true_answer' => $true_answer_jawaban[$i],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
        }




        DB::table('jawaban')->insert($data_answer);



        $this->getJawaban = jawaban::where('siswa_id', $siswa_id)->where('ujian_id', $ujian_id)->get();

        $given_answer = [];
        $true_answer = [];
        $getScore = [];

        for ($i = 0; $i < count($this->getJawaban); $i++) {
            $given_answer[] = $this->getJawaban[$i]['given_answer'];
            $true_answer[] = $this->getJawaban[$i]['true_answer'];
            if ($given_answer[$i] == $true_answer[$i]) {
                $getScore[] = $this->getJawaban[$i];
            }
        }


        hasil::create([
            'siswa_id' => $siswa_id,
            'ujian_id' => $ujian_id,
            'score' => count($getScore),
            'status' => 1
        ]);


        Session::forget('data');
        $this->openUjianForm = false;


        $this->alert('success', 'Ujian berhasil disimpan', [
            'position' =>  'center',
            'timer' =>  3000,
            'toast' =>  false,
            'text' =>  '',
            'confirmButtonText' =>  'Ok',
            'cancelButtonText' =>  'Cancel',
            'showCancelButton' =>  false,
            'showConfirmButton' =>  false,
        ]);

        $this->refresh = true;
    }
}
