<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Penelitian extends Model
{
    protected $table = 'penelitian';

    protected $fillable = [
        'id_dosen',
        'judul_penelitian',
        'tahun',
        'sumber_dana',
        'peran',
        'deskripsi',
    ];

    public function dosen(): BelongsTo
    {
        return $this->belongsTo(Dosen::class, 'id_dosen', 'id_dosen');
    }
}