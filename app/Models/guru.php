<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class guru extends Model
{
    use HasFactory;
    protected $table = 'guru';


    protected $fillable = ['nama', 'nip', 'jenis_kelamin', 'agama', 'alamat',  'user_id'];


    public function kelas()
    {
        return $this->belongsToMany(kelas::class)->withTimestamps();
    }

    public function mapel()
    {
        return $this->belongsToMany(mapel::class)->withTimestamps();
    }
}
