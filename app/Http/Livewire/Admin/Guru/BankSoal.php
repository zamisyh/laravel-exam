<?php

namespace App\Http\Livewire\Admin\Guru;


use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\guru;
use App\Models\ujian;
use App\Models\ujian_setting;
use App\Models\soal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SoalImport;

class BankSoal extends Component
{

    use WithFileUploads, WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'updateSoal' => '$refresh',
        'deleteSoal' => '$refresh',
        'confirmed',
    ];

    public $viewMoreSetting;
    public $openCreateForm, $openCreateSoalForm, $openGambarForn, $openCreateExcelForm;
    public $openFormCreateClick, $closeFormCreateClick, $openGambarClick;

    public $judul, $mapel, $kelas, $jumlah_soal, $tanggal_mulai,
        $tanggal_selesai, $waktu, $token, $acak_soal, $acak_pilihan, $tampil_nilai;

    public $uraian, $kunci, $gambar, $a, $b, $c, $d, $e, $file_excel;

    public $ujianId;
    public $pageSize = 5;




    public function render()
    {
        $data['data']['mapelkelas'] = guru::where('user_id', Auth::user()->id)->get();
        $getIdGuru = guru::where('user_id', Auth::user()->id)->first();
        $data['data']['ujian'] = ujian::where('guru_id', $getIdGuru->id)->with('ujian_setting', 'mapel', 'kelas.jurusan')->orderBy('created_at', 'DESC')->get();

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
    public function closeFormCreateClick()
    {
        $this->openCreateForm = false;
    }

    public function openGambarClick()
    {
        $this->openGambarForn = true;
    }


    public function saveUjian()
    {
        $this->validate([
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

        try {

            $getGuru = guru::where('user_id', Auth::user()->id)->first();

            $ujian = ujian::create([
                'judul' => $this->judul,
                'mapel_id' => $this->mapel,
                'kelas_id' => $this->kelas,
                'guru_id' => $getGuru->id,
                'created_at' => $this->tanggal_mulai,
                'updated_at' => $this->tanggal_mulai,
                'tanggal_mulai' => $this->tanggal_mulai,
                'tanggal_akhir' => $this->tanggal_selesai,
                'token' => $this->token,
            ]);

            $ujian->ujian_setting()->create([
                'jumlah_soal' => $this->jumlah_soal,
                'waktu' => $this->waktu,
                'urutan_soal' => $this->acak_soal,
                'urutan_pilihan' => $this->acak_pilihan,
                'tampil_nilai' => $this->tampil_nilai,
            ]);

            $this->alert('success', 'Succesfully create data', [
                'position' =>  'top-end',
                'timer' =>  3000,
                'toast' =>  true,
                'text' =>  '',
                'confirmButtonText' =>  'Ok',
                'cancelButtonText' =>  'Cancel',
                'showCancelButton' =>  false,
                'showConfirmButton' =>  false,
            ]);

            $this->openCreateForm = false;
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }


    public function openFormSoal($id)
    {
        $this->openCreateSoalForm = true;
        $this->ujianId = $id;
    }

    public function openFormExcel()
    {
        $this->openCreateExcelForm = true;
    }

    public function upload_excel()
    {
        $this->validate([
            'file_excel' => 'required|mimes:xlsx, xls'
        ]);

        Excel::import(new SoalImport($this->ujianId), $this->file_excel);

        $this->alert('success', 'Succesfully import soal', [
            'position' =>  'top-end',
            'timer' =>  3000,
            'toast' =>  true,
            'text' =>  '',
            'confirmButtonText' =>  'Ok',
            'cancelButtonText' =>  'Cancel',
            'showCancelButton' =>  false,
            'showConfirmButton' =>  false,
        ]);

        $this->openCreateExcelForm = false;
    }

    public function saveSoal()
    {
        $data = $this->validate([
            'uraian' => 'required',
            'kunci' => 'required',
            'gambar' => $this->openGambarForn == true ? 'required|file|image|mimes:png,jpg,jpeg,webp' : '',
            'a' => 'required',
            'b' => 'required',
            'c' => 'required',
            'd' => 'required',
            'e' => 'required'
        ]);




        try {

            $nameFile = null;

            if ($this->openGambarForn == true) {
                $nameFile = strtolower(Str::slug(rand(100, 10000))) . '-' . time() . '.' . $this->gambar->getClientOriginalExtension();
                $this->gambar->storeAs('public/images/soal', $nameFile);
            }

            soal::create([
                'ujian_id' => $this->ujianId,
                'uraian' => $this->uraian,
                'kunci' => $this->kunci,
                'image' => $this->openGambarForn == true ? $nameFile : null,
                'opsi_a' => $this->a,
                'opsi_b' => $this->b,
                'opsi_c' => $this->c,
                'opsi_d' => $this->d,
                'opsi_e' => $this->e,

            ]);


            $this->alert('success', 'Succesfully create soal', [
                'position' =>  'top-end',
                'timer' =>  3000,
                'toast' =>  true,
                'text' =>  '',
                'confirmButtonText' =>  'Ok',
                'cancelButtonText' =>  'Cancel',
                'showCancelButton' =>  false,
                'showConfirmButton' =>  false,
            ]);

            $this->emit('updateSoal');
            $this->resetForm();
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function deleteSoal($id)
    {
        $data = soal::findOrFail($id);
        $data->delete();

        if (!empty($data->image)) {
            File::delete(public_path('storage/images/soal/' . $data->image));
        }

        $this->emit('deleteSoal');

        $this->alert('success', 'Succesfully delete soal', [
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

    public function deleteUjian($id)
    {
        $this->triggerConfirm();
        $data = ujian::find($id);
        $this->ujianId = $data->id;
    }

    /**
     * function for update status
     */

    public function updateStatusDraft($id)
    {
        $data = ujian::findOrFail($id);
        $data->status = true;
        $data->update();
    }

    public function updateStatusActive($id)
    {
        $data = ujian::findOrFail($id);
        $data->status = false;
        $data->update();
    }


    /**
     * child function
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
        $data = ujian::where('id', $this->ujianId)->first();
        $data->delete();

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

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->resetFields();
    }

    public function resetFields()
    {
        $this->uraian = '';
        $this->kunci = '';
        $this->gambar = '';
        $this->a = '';
        $this->b = '';
        $this->c = '';
        $this->d = '';
        $this->e = '';
    }
}
