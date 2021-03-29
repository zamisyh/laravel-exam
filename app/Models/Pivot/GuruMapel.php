<?php

namespace App\Models\Pivot;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuruMapel extends Model
{
    use HasFactory;
    protected $fillable = ['guru_id', 'mapel_id'];

    public function mpl()
    {
        return $this->belongsTo(mapel::class);
    }
}
