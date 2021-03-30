<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class siswa extends Model
{
    use HasFactory;
    protected $table = 'siswa';
    protected $fillable = ['nama', 'agama', 'jenis_kelamin', 'nis', 'jurusan_id', 'kelas_id', 'user_id'];

    public function jurusan()
    {
        return $this->belongsTo(jurusan::class);
    }

    public function kelas()
    {
        return $this->belongsTo(kelas::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
