<?php

namespace App\Http\Controllers;

use App\Models\Publikasi;
use Illuminate\Http\Request;

class DosenPublikasiController extends Controller
{
    public function index()
    {
        $dosen = auth()->user()->dosen;

        if (!$dosen) {
            abort(403, 'Data dosen tidak ditemukan.');
        }

        $publikasi = $dosen->publikasi()
            ->orderByDesc('tahun')
            ->get();

        return view('dosen.publikasi.index', compact(
            'dosen',
            'publikasi'
        ));
    }

    public function create()
    {
        $dosen = auth()->user()->dosen;

        if (!$dosen) {
            abort(403, 'Data dosen tidak ditemukan.');
        }

        return view('dosen.publikasi.create', compact('dosen'));
    }

    public function store(Request $request)
    {
        $dosen = auth()->user()->dosen;

        if (!$dosen) {
            abort(403, 'Data dosen tidak ditemukan.');
        }

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'jenis' => 'nullable|string|max:255',
            'tahun' => 'nullable|integer',
            'jurnal' => 'nullable|string|max:255',
            'url' => 'nullable|string|max:255',
            'doi' => 'nullable|string|max:255',
        ]);

        $dosen->publikasi()->create($validated);

        return redirect()
            ->route('dosen.publikasi.index')
            ->with('success', 'Data publikasi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $dosen = auth()->user()->dosen;

        if (!$dosen) {
            abort(403, 'Data dosen tidak ditemukan.');
        }

        $publikasi = $dosen->publikasi()->findOrFail($id);

        return view('dosen.publikasi.edit', compact(
            'dosen',
            'publikasi'
        ));
    }

    public function update(Request $request, $id)
    {
        $dosen = auth()->user()->dosen;

        if (!$dosen) {
            abort(403, 'Data dosen tidak ditemukan.');
        }

        $publikasi = $dosen->publikasi()->findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'jenis' => 'nullable|string|max:255',
            'tahun' => 'nullable|integer',
            'jurnal' => 'nullable|string|max:255',
            'url' => 'nullable|string|max:255',
            'doi' => 'nullable|string|max:255',
        ]);

        $publikasi->update($validated);

        return redirect()
            ->route('dosen.publikasi.index')
            ->with('success', 'Data publikasi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $dosen = auth()->user()->dosen;

        if (!$dosen) {
            abort(403, 'Data dosen tidak ditemukan.');
        }

        $publikasi = $dosen->publikasi()->findOrFail($id);

        $publikasi->delete();

        return redirect()
            ->route('dosen.publikasi.index')
            ->with('success', 'Data publikasi berhasil dihapus.');
    }
}