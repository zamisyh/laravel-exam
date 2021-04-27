<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ujian extends Model
{
    use HasFactory;

    protected $table = 'ujian';
    protected $fillable = ['judul', 'mapel_id', 'kelas_id', 'guru_id', 'tanggal_mulai', 'tanggal_akhir', 'token', 'status', 'created_at', 'updated_at'];

    public $timestamps = false;

    public function ujian_setting()
    {
        return $this->hasOne(ujian_setting::class);
    }

    public function guru()
    {
        return $this->belongsTo(guru::class);
    }


    public function kelas()
    {
        return $this->belongsTo(kelas::class);
    }

    public function mapel()
    {
        return $this->belongsTo(mapel::class);
    }

    public function jurusan()
    {
        return $this->belongsTo(jurusan::class);
    }


    public function soal()
    {
        return $this->belongsTo(soal::class);
    }
}
