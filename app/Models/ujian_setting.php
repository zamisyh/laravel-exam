<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ujian_setting extends Model
{
    use HasFactory;
    protected $table = 'ujian_setting';
    protected $fillable = ['ujian_id', 'jumlah_soal', 'waktu', 'urutan_soal', 'urutan_pilihan', 'tampil_nilai'];

    public function ujian()
    {
        return $this->belongsTo(ujian::class);
    }
}
