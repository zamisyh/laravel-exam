<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jawaban extends Model
{

    use HasFactory;
    protected $table = 'jawaban';
    protected $fillable = ['ujian_id', 'siswa_id', 'soal_id', 'uraian', 'given_answer', 'true_answer'];


    public function soal()
    {
        return $this->belongsTo(soal::class);
    }
}
