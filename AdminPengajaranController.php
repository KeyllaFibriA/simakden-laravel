<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Pengajaran;
use Illuminate\Http\Request;

class AdminPengajaranController extends Controller
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

        $pengajaran = $dosen->pengajaran()
            ->orderByDesc('tahun_ajaran')
            ->get();

        return view('admin.pengajaran.index', compact(
            'dosen',
            'pengajaran'
        ));
    }

    public function create($dosenId)
    {
        $this->checkAdmin();

        $dosen = Dosen::findOrFail($dosenId);

        return view('admin.pengajaran.create', compact('dosen'));
    }

    public function store(Request $request, $dosenId)
    {
        $this->checkAdmin();

        $dosen = Dosen::findOrFail($dosenId);

        $validated = $request->validate([
            'mata_kuliah' => ['required', 'string', 'max:255'],
            'semester' => ['nullable', 'string', 'max:255'],
            'tahun_ajaran' => ['nullable', 'string', 'max:255'],
            'kelas' => ['nullable', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
        ]);

        $dosen->pengajaran()->create($validated);

        return redirect()
            ->route('admin.dosen.pengajaran.index', $dosen->id_dosen)
            ->with('success', 'Data pengajaran berhasil ditambahkan.');
    }

    public function edit($dosenId, $id)
    {
        $this->checkAdmin();

        $dosen = Dosen::findOrFail($dosenId);

        $pengajaran = $dosen->pengajaran()->findOrFail($id);

        return view('admin.pengajaran.edit', compact(
            'dosen',
            'pengajaran'
        ));
    }

    public function update(Request $request, $dosenId, $id)
    {
        $this->checkAdmin();

        $dosen = Dosen::findOrFail($dosenId);

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
            ->route('admin.dosen.pengajaran.index', $dosen->id_dosen)
            ->with('success', 'Data pengajaran berhasil diperbarui.');
    }

    public function destroy($dosenId, $id)
    {
        $this->checkAdmin();

        $dosen = Dosen::findOrFail($dosenId);

        $pengajaran = $dosen->pengajaran()->findOrFail($id);

        $pengajaran->delete();

        return redirect()
            ->route('admin.dosen.pengajaran.index', $dosen->id_dosen)
            ->with('success', 'Data pengajaran berhasil dihapus.');
    }
}