<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kelas extends Model
{
    use HasFactory;
    protected $fillable = ['nama', 'jurusan_id', 'no'];


    public function jurusan()
    {
        return $this->belongsTo(jurusan::class);
    }

    public function mapel()
    {
        return $this->belongsToMany(mapel::class);
    }
}
