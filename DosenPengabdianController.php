<?php

namespace App\Http\Controllers;

use App\Models\Pengabdian;
use Illuminate\Http\Request;

class DosenPengabdianController extends Controller
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

    // Menampilkan daftar pengabdian
    public function index()
    {
        $dosen = $this->getDosen();

        $pengabdian = $dosen->pengabdian()
            ->orderByDesc('tahun')
            ->get();

        return view('dosen.pengabdian.index', compact(
            'dosen',
            'pengabdian'
        ));
    }

    // Menampilkan form tambah
    public function create()
    {
        $dosen = $this->getDosen();

        return view('dosen.pengabdian.create', compact('dosen'));
    }

    // Menyimpan data
    public function store(Request $request)
    {
        $dosen = $this->getDosen();

        $validated = $request->validate([
            'judul_pengabdian' => ['required', 'string', 'max:255'],
            'tahun' => ['nullable', 'string', 'max:255'],
            'lokasi' => ['nullable', 'string', 'max:255'],
            'peran' => ['nullable', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
        ]);

        $dosen->pengabdian()->create($validated);

        return redirect()
            ->route('dosen.pengabdian.index')
            ->with('success', 'Data pengabdian berhasil ditambahkan.');
    }

    // Menampilkan form edit
    public function edit($id)
    {
        $dosen = $this->getDosen();

        $pengabdian = $dosen->pengabdian()->findOrFail($id);

        return view('dosen.pengabdian.edit', compact(
            'dosen',
            'pengabdian'
        ));
    }

    // Memperbarui data
    public function update(Request $request, $id)
    {
        $dosen = $this->getDosen();

        $pengabdian = $dosen->pengabdian()->findOrFail($id);

        $validated = $request->validate([
            'judul_pengabdian' => ['required', 'string', 'max:255'],
            'tahun' => ['nullable', 'string', 'max:255'],
            'lokasi' => ['nullable', 'string', 'max:255'],
            'peran' => ['nullable', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
        ]);

        $pengabdian->update($validated);

        return redirect()
            ->route('dosen.pengabdian.index')
            ->with('success', 'Data pengabdian berhasil diperbarui.');
    }

    // Menghapus data
    public function destroy($id)
    {
        $dosen = $this->getDosen();

        $pengabdian = $dosen->pengabdian()->findOrFail($id);

        $pengabdian->delete();

        return redirect()
            ->route('dosen.pengabdian.index')
            ->with('success', 'Data pengabdian berhasil dihapus.');
    }
}