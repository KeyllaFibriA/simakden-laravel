<?php

namespace App\Http\Controllers;

use App\Models\Dosen;

class AdminAktivitasController extends Controller
{
    private function checkAdmin()
    {
        abort_unless(
            auth()->check() && auth()->user()->isAdmin(),
            403,
            'Anda tidak memiliki akses sebagai admin.'
        );
    }

    public function create($dosenId)
    {
        $this->checkAdmin();

        $dosen = Dosen::findOrFail($dosenId);

        return view('admin.aktivitas.create', compact('dosen'));
    }
}