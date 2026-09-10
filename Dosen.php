<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dosen extends Model
{
    protected $table = 'dosen';
    protected $primaryKey = 'id_dosen';

    protected $fillable = [
        'nidn',
        'nama_dosen',
        'gelar_depan',
        'gelar_belakang',
        'jabatan',
        'status_kaprodi',
        'bidang_keahlian',
        'email',
        'no_telepon',
        'foto',
        'deskripsi',
        'status',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id_dosen', 'id_dosen');
    }

    public function pengajaran(): HasMany
    {
        return $this->hasMany(Pengajaran::class, 'id_dosen', 'id_dosen');
    }

    public function penelitian(): HasMany
    {
        return $this->hasMany(Penelitian::class, 'id_dosen', 'id_dosen');
    }

    public function pengabdian(): HasMany
    {
        return $this->hasMany(Pengabdian::class, 'id_dosen', 'id_dosen');
    }

    public function publikasi(): HasMany
    {
        return $this->hasMany(Publikasi::class, 'id_dosen', 'id_dosen');
    }

    public function sinta(): HasOne
    {
        return $this->hasOne(Sinta::class, 'id_dosen', 'id_dosen');
    }

    public function scholar(): HasOne
    {
        return $this->hasOne(Scholar::class, 'id_dosen', 'id_dosen');
    }

    public function orcid(): HasOne
    {
        return $this->hasOne(Orcid::class, 'id_dosen', 'id_dosen');
    }
}