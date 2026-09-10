<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Pengabdian;
use Illuminate\Http\Request;

class AdminPengabdianController extends Controller
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

        $pengabdian = $dosen->pengabdian()
            ->orderByDesc('tahun')
            ->get();

        return view('admin.pengabdian.index', compact(
            'dosen',
            'pengabdian'
        ));
    }

    public function create($dosenId)
    {
        $this->checkAdmin();

        $dosen = Dosen::findOrFail($dosenId);

        return view('admin.pengabdian.create', compact('dosen'));
    }

    public function store(Request $request, $dosenId)
    {
        $this->checkAdmin();

        $dosen = Dosen::findOrFail($dosenId);

        $validated = $request->validate([
            'judul_pengabdian' => ['required', 'string', 'max:255'],
            'tahun' => ['nullable', 'string', 'max:255'],
            'lokasi' => ['nullable', 'string', 'max:255'],
            'peran' => ['nullable', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
        ]);

        $dosen->pengabdian()->create($validated);

        return redirect()
            ->route('admin.dosen.pengabdian.index', $dosen->id_dosen)
            ->with('success', 'Data pengabdian berhasil ditambahkan.');
    }

    public function edit($dosenId, $id)
    {
        $this->checkAdmin();

        $dosen = Dosen::findOrFail($dosenId);

        $pengabdian = $dosen->pengabdian()->findOrFail($id);

        return view('admin.pengabdian.edit', compact(
            'dosen',
            'pengabdian'
        ));
    }

    public function update(Request $request, $dosenId, $id)
    {
        $this->checkAdmin();

        $dosen = Dosen::findOrFail($dosenId);

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
            ->route('admin.dosen.pengabdian.index', $dosen->id_dosen)
            ->with('success', 'Data pengabdian berhasil diperbarui.');
    }

    public function destroy($dosenId, $id)
    {
        $this->checkAdmin();

        $dosen = Dosen::findOrFail($dosenId);

        $pengabdian = $dosen->pengabdian()->findOrFail($id);

        $pengabdian->delete();

        return redirect()
            ->route('admin.dosen.pengabdian.index', $dosen->id_dosen)
            ->with('success', 'Data pengabdian berhasil dihapus.');
    }
}