<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mapel extends Model
{
    use HasFactory;
    protected $table = 'mapel';
    protected $fillable = ['nama'];


    public function kelas()
    {
        return $this->belongsToMany(kelas::class);
    }
}
