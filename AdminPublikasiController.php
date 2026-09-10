<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Publikasi;
use Illuminate\Http\Request;

class AdminPublikasiController extends Controller
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

        $publikasi = $dosen->publikasi()
            ->orderByDesc('tahun')
            ->get();

        return view('admin.publikasi.index', compact(
            'dosen',
            'publikasi'
        ));
    }

    public function create($dosenId)
    {
        $this->checkAdmin();

        $dosen = Dosen::findOrFail($dosenId);

        return view('admin.publikasi.create', compact('dosen'));
    }

    public function store(Request $request, $dosenId)
{
    $this->checkAdmin();

    $dosen = Dosen::findOrFail($dosenId);

    $validated = $request->validate([
        'judul' => ['required', 'string', 'max:255'],
        'jenis' => ['nullable', 'string', 'max:255'],
        'tahun' => ['nullable', 'string', 'max:255'],
        'jurnal' => ['nullable', 'string', 'max:255'],
        'url' => ['nullable', 'string'],
        'doi' => ['nullable', 'string'],
        'file' => ['nullable', 'file', 'mimes:pdf', 'max:10240'],
    ]);

    // Upload file PDF jika ada
    if ($request->hasFile('file')) {
        $validated['file'] = $request->file('file')->store('publikasi', 'public');
    }

    $dosen->publikasi()->create($validated);

    return redirect()
        ->route('admin.dosen.show', $dosen->id_dosen)
        ->with('success', 'Data publikasi berhasil ditambahkan.');
}

    public function edit($dosenId, $id)
    {
        $this->checkAdmin();

        $dosen = Dosen::findOrFail($dosenId);

        $publikasi = $dosen->publikasi()->findOrFail($id);

        return view('admin.publikasi.edit', compact(
            'dosen',
            'publikasi'
        ));
    }

    public function update(Request $request, $dosenId, $id)
{
    $this->checkAdmin();

    $dosen = Dosen::findOrFail($dosenId);

    $publikasi = $dosen->publikasi()->findOrFail($id);

    $validated = $request->validate([
        'judul' => ['required', 'string', 'max:255'],
        'jenis' => ['nullable', 'string', 'max:255'],
        'tahun' => ['nullable', 'string', 'max:255'],
        'jurnal' => ['nullable', 'string', 'max:255'],
        'url' => ['nullable', 'string'],
        'doi' => ['nullable', 'string'],
        'file' => ['nullable', 'file', 'mimes:pdf', 'max:10240'],
    ]);

    // Upload PDF baru jika ada
    if ($request->hasFile('file')) {
        $validated['file'] = $request->file('file')->store('publikasi', 'public');
    }

    $publikasi->update($validated);
     return redirect()
            ->route('admin.dosen.show', $dosen->id_dosen)
            ->with('success', 'Data publikasi berhasil diperbarui.');
    }

    public function destroy($dosenId, $id)
    {
        $this->checkAdmin();

        $dosen = Dosen::findOrFail($dosenId);

        $publikasi = $dosen->publikasi()->findOrFail($id);

        $publikasi->delete();

        return redirect()
            ->route('admin.dosen.show', $dosen->id_dosen)
            ->with('success', 'Data publikasi berhasil dihapus.');
    }
}