<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DosenPengajaranController extends Controller
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

        $pengajaran = $dosen->pengajaran()
            ->orderByDesc('tahun_ajaran')
            ->get();

        return view('dosen.pengajaran.index', compact(
            'dosen',
            'pengajaran'
        ));
    }

    public function create()
    {
        $dosen = $this->getDosen();

        return view('dosen.pengajaran.create', compact('dosen'));
    }

    public function store(Request $request)
    {
        $dosen = $this->getDosen();

        $validated = $request->validate([
            'mata_kuliah' => ['required', 'string', 'max:255'],
            'semester' => ['nullable', 'string', 'max:255'],
            'tahun_ajaran' => ['nullable', 'string', 'max:255'],
            'kelas' => ['nullable', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
        ]);

        $dosen->pengajaran()->create($validated);

        return redirect()
            ->route('dosen.pengajaran.index')
            ->with('success', 'Data pengajaran berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $dosen = $this->getDosen();

        $pengajaran = $dosen->pengajaran()->findOrFail($id);

        return view('dosen.pengajaran.edit', compact(
            'dosen',
            'pengajaran'
        ));
    }

    public function update(Request $request, $id)
    {
        $dosen = $this->getDosen();

        $pengajaran = $dosen->pengajaran()->findOrFail($id);

        $validated = $request->validate([
            'mata_kuliah' => ['required', 'string', 'max:255'],
            'semester' => ['nullable', 'string', 'max:255'],
            'tahun_ajaran' => ['nullable', 'string', 'max:255'],
            'kelas' => ['nullable', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
        ]);

        $pengajaran->update($validated);

        return redirect()
            ->route('dosen.pengajaran.index')
            ->with('success', 'Data pengajaran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $dosen = $this->getDosen();

        $pengajaran = $dosen->pengajaran()->findOrFail($id);

        $pengajaran->delete();

        return redirect()
            ->route('dosen.pengajaran.index')
            ->with('success', 'Data pengajaran berhasil dihapus.');
    }
}