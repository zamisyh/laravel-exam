<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pivot\GuruMapel;

class mapel extends Model
{
    use HasFactory;
    protected $table = 'mapel';
    protected $fillable = ['nama'];
}
