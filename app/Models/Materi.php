<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;

    protected $fillable = [
        'mapel_id',
        'materi',
        'semester',
        'pertemuan',
        'link_youtube',
        'file_materi'
    ];

    public function mapel()
    {
        return $this->belongsTo(Mapel::class);
    }
}
