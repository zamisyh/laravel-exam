<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hasil extends Model
{

    use HasFactory;
    protected $table = 'hasil';
    protected $fillable = ['siswa_id', 'ujian_id', 'score', 'status'];


    public function ujian()
    {
        return $this->belongsTo(ujian::class);
    }

    public function mapel()
    {
        return $this->belongsTo(mapel::class);
    }

    public function siswa()
    {
        return $this->belongsTo(siswa::class);
    }

    public function jurusan()
    {
        return $this->belongsTo(jurusan::class);
    }

    public function kelas()
    {
        return $this->belongsTo(kelas::class);
    }


    public function ujian_setting()
    {
        return $this->hasMany(ujian_setting::class);
    }
}
