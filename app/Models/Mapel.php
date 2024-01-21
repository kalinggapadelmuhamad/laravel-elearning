<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code'
    ];

    public function materi()
    {
        return $this->hasMany(Materi::class);
    }
}
