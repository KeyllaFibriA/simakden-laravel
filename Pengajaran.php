<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengajaran extends Model
{
    protected $table = 'pengajaran';

    protected $fillable = [
        'id_dosen',
        'mata_kuliah',
        'semester',
        'tahun_ajaran',
        'kelas',
        'deskripsi',
    ];

    public function dosen(): BelongsTo
    {
        return $this->belongsTo(Dosen::class, 'id_dosen', 'id_dosen');
    }
}