<?php

namespace App\Http\Controllers;

use App\Models\Dosen;

class AdminDosenController extends Controller
{
    public function show($id)
    {
        $dosen = Dosen::with([
            'pengajaran',
            'penelitian',
            'pengabdian',
            'publikasi',
            'sinta',
            'scholar',
            'orcid',
        ])->findOrFail($id);

        return view('admin.dosen.show', compact('dosen'));
    }
}