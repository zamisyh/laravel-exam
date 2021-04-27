<?php

namespace App\Http\Livewire\Admin\Guru;


use Livewire\Component;
use Livewire\WithPagination;

use App\Models\guru;
use App\Models\hasil;
use App\Models\ujian;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\HasilExport;
use Illuminate\Support\Str;
use PDF;

class Report extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $perPage = 5;
    public $sort;
    public $sortKelas, $sortMapel, $boxKelas, $boxMapel;


    public function render()
    {
        $data = null;

        $data['data']['guru'] = guru::where('user_id', Auth::user()->id)->first();





        if ($this->sort == 'kelas') {
            $data['data']['ujian'] = ujian::where('guru_id', $data['data']['guru']['id'])->where('kelas_id', $this->sortKelas)->with('kelas', 'mapel', 'kelas.jurusan')->paginate($this->perPage);
            $this->boxKelas = true;
            $this->boxMapel = false;
        } elseif ($this->sort == 'mapel') {
            $data['data']['ujian'] = ujian::where('guru_id', $data['data']['guru']['id'])->where('mapel_id', $this->sortMapel)->with('kelas', 'mapel', 'kelas.jurusan')->paginate($this->perPage);
            $this->boxKelas = false;
            $this->boxMapel = true;
        } else {
            $data['data']['ujian'] = ujian::where('guru_id', $data['data']['guru']['id'])->with('kelas', 'mapel', 'kelas.jurusan')->paginate($this->perPage);
            $this->boxKelas = false;
            $this->boxMapel = false;
        }

        return view('livewire.admin.guru.report', $data)->extends('layouts.app')->section('content');
    }


    public function export($id)
    {
        try {

            $ujian = ujian::find($id);
            $nameFile = Str::slug(strtolower($ujian->judul)) . '-' . rand(1000, 10000);

            return Excel::download(new HasilExport($id), $nameFile . '.xlsx');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function exportPdf($id)
    {
        $hasil =  hasil::where('ujian_id', $id)->with('ujian.kelas.jurusan', 'siswa', 'ujian.mapel')->get();
        $ujian = ujian::where('id', $id)->with('kelas', 'mapel')->first();

        $nameFile = Str::slug(strtolower($ujian->judul)) . '-' . rand(1000, 10000);



        $pdfContent = PDF::loadView('exports.hasil-pdf', compact('hasil', 'ujian'))->output();
        return response()->streamDownload(
            fn () => print($pdfContent),
            $nameFile . ".pdf"
        );
    }
}
