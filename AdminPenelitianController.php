<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Penelitian;
use Illuminate\Http\Request;

class AdminPenelitianController extends Controller
{
    private function checkAdmin()
    {
        abort_unless(
            auth()->check() && auth()->user()->isAdmin(),
            403,
            'Anda tidak memiliki akses sebagai admin.'
        );
    }

    public function index($dosenId)
    {
        $this->checkAdmin();

        $dosen = Dosen::findOrFail($dosenId);

        $penelitian = $dosen->penelitian()
            ->orderByDesc('tahun')
            ->get();

        return view('admin.penelitian.index', compact(
            'dosen',
            'penelitian'
        ));
    }

    public function create($dosenId)
    {
        $this->checkAdmin();

        $dosen = Dosen::findOrFail($dosenId);

        return view('admin.penelitian.create', compact('dosen'));
    }

    public function store(Request $request, $dosenId)
    {
        $this->checkAdmin();

        $dosen = Dosen::findOrFail($dosenId);

        $validated = $request->validate([
            'judul_penelitian' => ['required', 'string', 'max:255'],
            'tahun' => ['nullable', 'string', 'max:255'],
            'sumber_dana' => ['nullable', 'string', 'max:255'],
            'peran' => ['nullable', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
        ]);

        $dosen->penelitian()->create($validated);

        return redirect()
            ->route('admin.dosen.penelitian.index', $dosen->id_dosen)
            ->with('success', 'Data penelitian berhasil ditambahkan.');
    }

    public function edit($dosenId, $id)
    {
        $this->checkAdmin();

        $dosen = Dosen::findOrFail($dosenId);

        $penelitian = $dosen->penelitian()->findOrFail($id);

        return view('admin.penelitian.edit', compact(
            'dosen',
            'penelitian'
        ));
    }

    public function update(Request $request, $dosenId, $id)
    {
        $this->checkAdmin();

        $dosen = Dosen::findOrFail($dosenId);

        $penelitian = $dosen->penelitian()->findOrFail($id);

        $validated = $request->validate([
            'judul_penelitian' => ['required', 'string', 'max:255'],
            'tahun' => ['nullable', 'string', 'max:255'],
            'sumber_dana' => ['nullable', 'string', 'max:255'],
            'peran' => ['nullable', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
        ]);

        $penelitian->update($validated);

        return redirect()
            ->route('admin.dosen.penelitian.index', $dosen->id_dosen)
            ->with('success', 'Data penelitian berhasil diperbarui.');
    }

    public function destroy($dosenId, $id)
    {
        $this->checkAdmin();

        $dosen = Dosen::findOrFail($dosenId);

        $penelitian = $dosen->penelitian()->findOrFail($id);

        $penelitian->delete();

        return redirect()
            ->route('admin.dosen.penelitian.index', $dosen->id_dosen)
            ->with('success', 'Data penelitian berhasil dihapus.');
    }
}