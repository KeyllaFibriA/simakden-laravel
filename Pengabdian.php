<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengabdian extends Model
{
    protected $table = 'pengabdian';

    protected $fillable = [
        'id_dosen',
        'judul_pengabdian',
        'tahun',
        'lokasi',
        'peran',
        'deskripsi',
    ];

    public function dosen(): BelongsTo
    {
        return $this->belongsTo(Dosen::class, 'id_dosen', 'id_dosen');
    }
}