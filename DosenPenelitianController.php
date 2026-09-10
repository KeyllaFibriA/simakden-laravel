<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;

class DosenPenelitianController extends Controller
{
    private function getDosen()
    {
        $user = auth()->user();

        $dosen = $user->dosen;

        if (!$dosen) {
            abort(403, 'Data dosen tidak ditemukan.');
        }

        return $dosen;
    }

    public function index()
    {
        $dosen = $this->getDosen();

        $penelitian = $dosen->penelitian()
            ->orderByDesc('tahun')
            ->get();

        return view('dosen.penelitian.index', compact(
            'dosen',
            'penelitian'
        ));
    }

    public function create()
    {
        $dosen = $this->getDosen();

        return view('dosen.penelitian.create', compact('dosen'));
    }

    public function store(Request $request)
    {
        $dosen = $this->getDosen();

        $validated = $request->validate([
            'judul_penelitian' => ['required', 'string', 'max:255'],
            'tahun' => ['nullable', 'string', 'max:255'],
            'sumber_dana' => ['nullable', 'string', 'max:255'],
            'peran' => ['nullable', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
        ]);

        $dosen->penelitian()->create($validated);

        return redirect()
            ->route('dosen.penelitian.index')
            ->with('success', 'Data penelitian berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $dosen = $this->getDosen();

        $penelitian = $dosen->penelitian()->findOrFail($id);

        return view('dosen.penelitian.edit', compact(
            'dosen',
            'penelitian'
        ));
    }

    public function update(Request $request, $id)
    {
        $dosen = $this->getDosen();

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
            ->route('dosen.penelitian.index')
            ->with('success', 'Data penelitian berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $dosen = $this->getDosen();

        $penelitian = $dosen->penelitian()->findOrFail($id);

        $penelitian->delete();

        return redirect()
            ->route('dosen.penelitian.index')
            ->with('success', 'Data penelitian berhasil dihapus.');
    }
}