<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class soal extends Model
{
    use HasFactory;
    protected $table = 'soal';
    protected $fillable = ['ujian_id', 'uraian', 'image', 'kunci', 'opsi_a', 'opsi_b', 'opsi_c', 'opsi_d', 'opsi_e'];

    public function ujian()
    {
        return $this->belongsTo(ujian::class);
    }
}
