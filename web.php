<?php

use App\Http\Controllers\DosenPublikasiController;
use App\Http\Controllers\DosenPengabdianController;
use App\Http\Controllers\AdminPublikasiController;
use App\Http\Controllers\AdminAktivitasController;
use App\Http\Controllers\AdminPengabdianController;
use App\Http\Controllers\AdminPenelitianController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminDosenController;
use App\Http\Controllers\AdminPengajaranController;

use App\Http\Controllers\DosenPengajaranController;
use App\Http\Controllers\DosenPenelitianController;

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


// ======================================================
// HALAMAN UTAMA
// ======================================================

Route::get('/', function () {
    return view('welcome');
});


// ======================================================
// DASHBOARD UMUM
// ======================================================

Route::get('/dashboard', function () {

    if (auth()->user()->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }

    if (auth()->user()->isDosen()) {
        return redirect()->route('dosen.dashboard');
    }

    abort(403, 'Role pengguna tidak dikenali.');

})->middleware(['auth', 'verified'])->name('dashboard');


// ======================================================
// ADMIN - AKTIVITAS
// ======================================================

Route::get(
    '/admin/dosen/{dosenId}/aktivitas/create',
    [AdminAktivitasController::class, 'create']
)->middleware(['auth', 'verified'])
 ->name('admin.dosen.aktivitas.create');


// ======================================================
// ADMIN - PENGAJARAN
// ======================================================

Route::prefix('admin/dosen/{dosenId}/pengajaran')
    ->middleware(['auth', 'verified'])
    ->group(function () {

        Route::get('/', [AdminPengajaranController::class, 'index'])
            ->name('admin.dosen.pengajaran.index');

        Route::get('/create', [AdminPengajaranController::class, 'create'])
            ->name('admin.dosen.pengajaran.create');

        Route::post('/', [AdminPengajaranController::class, 'store'])
            ->name('admin.dosen.pengajaran.store');

        Route::get('/{id}/edit', [AdminPengajaranController::class, 'edit'])
            ->name('admin.dosen.pengajaran.edit');

        Route::put('/{id}', [AdminPengajaranController::class, 'update'])
            ->name('admin.dosen.pengajaran.update');

        Route::delete('/{id}', [AdminPengajaranController::class, 'destroy'])
            ->name('admin.dosen.pengajaran.destroy');
    });


// ======================================================
// ADMIN - PENELITIAN
// ======================================================

Route::prefix('admin/dosen/{dosenId}/penelitian')
    ->middleware(['auth', 'verified'])
    ->group(function () {

        Route::get('/', [AdminPenelitianController::class, 'index'])
            ->name('admin.dosen.penelitian.index');

        Route::get('/create', [AdminPenelitianController::class, 'create'])
            ->name('admin.dosen.penelitian.create');

        Route::post('/', [AdminPenelitianController::class, 'store'])
            ->name('admin.dosen.penelitian.store');

        Route::get('/{id}/edit', [AdminPenelitianController::class, 'edit'])
            ->name('admin.dosen.penelitian.edit');

        Route::put('/{id}', [AdminPenelitianController::class, 'update'])
            ->name('admin.dosen.penelitian.update');

        Route::delete('/{id}', [AdminPenelitianController::class, 'destroy'])
            ->name('admin.dosen.penelitian.destroy');
    });


// ======================================================
// ADMIN - PENGABDIAN
// ======================================================

Route::prefix('admin/dosen/{dosenId}/pengabdian')
    ->middleware(['auth', 'verified'])
    ->group(function () {

        Route::get('/', [AdminPengabdianController::class, 'index'])
            ->name('admin.dosen.pengabdian.index');

        Route::get('/create', [AdminPengabdianController::class, 'create'])
            ->name('admin.dosen.pengabdian.create');

        Route::post('/', [AdminPengabdianController::class, 'store'])
            ->name('admin.dosen.pengabdian.store');

        Route::get('/{id}/edit', [AdminPengabdianController::class, 'edit'])
            ->name('admin.dosen.pengabdian.edit');

        Route::put('/{id}', [AdminPengabdianController::class, 'update'])
            ->name('admin.dosen.pengabdian.update');

        Route::delete('/{id}', [AdminPengabdianController::class, 'destroy'])
            ->name('admin.dosen.pengabdian.destroy');
    });


// ======================================================
// ADMIN - PUBLIKASI
// ======================================================

Route::prefix('admin/dosen/{dosenId}/publikasi')
    ->middleware(['auth', 'verified'])
    ->group(function () {

        Route::get('/', [AdminPublikasiController::class, 'index'])
            ->name('admin.dosen.publikasi.index');

        Route::get('/create', [AdminPublikasiController::class, 'create'])
            ->name('admin.dosen.publikasi.create');

        Route::post('/', [AdminPublikasiController::class, 'store'])
            ->name('admin.dosen.publikasi.store');

        Route::get('/{id}/edit', [AdminPublikasiController::class, 'edit'])
            ->name('admin.dosen.publikasi.edit');

        Route::put('/{id}', [AdminPublikasiController::class, 'update'])
            ->name('admin.dosen.publikasi.update');

        Route::delete('/{id}', [AdminPublikasiController::class, 'destroy'])
            ->name('admin.dosen.publikasi.destroy');
    });


// ======================================================
// ADMIN - DASHBOARD
// ======================================================

Route::get(
    '/admin/dashboard',
    [AdminDashboardController::class, 'index']
)->middleware(['auth', 'verified'])
 ->name('admin.dashboard');


// ======================================================
// ADMIN - DETAIL DOSEN
// ======================================================

Route::get(
    '/admin/dosen/{id}',
    [AdminDosenController::class, 'show']
)->middleware(['auth', 'verified'])
 ->name('admin.dosen.show');


// ======================================================
// DOSEN - DASHBOARD
// ======================================================

Route::get('/dosen/dashboard', function () {

    $user = auth()->user();

    $dosen = $user->dosen;

    if (!$dosen) {
        abort(403, 'Data dosen tidak ditemukan.');
    }

    $totalPengajaran = $dosen->pengajaran()->count();
    $totalPenelitian = $dosen->penelitian()->count();
    $totalPengabdian = $dosen->pengabdian()->count();
    $totalPublikasi = $dosen->publikasi()->count();

    return view('dosen.dashboard', compact(
        'dosen',
        'totalPengajaran',
        'totalPenelitian',
        'totalPengabdian',
        'totalPublikasi'
    ));

})->middleware(['auth', 'verified'])->name('dosen.dashboard');
Route::prefix('dosen/pengabdian')
    ->middleware(['auth', 'verified'])
    ->group(function () {

        Route::get('/', [DosenPengabdianController::class, 'index'])
            ->name('dosen.pengabdian.index');

        Route::get('/create', [DosenPengabdianController::class, 'create'])
            ->name('dosen.pengabdian.create');

        Route::post('/', [DosenPengabdianController::class, 'store'])
            ->name('dosen.pengabdian.store');

        Route::get('/{id}/edit', [DosenPengabdianController::class, 'edit'])
            ->name('dosen.pengabdian.edit');

        Route::put('/{id}', [DosenPengabdianController::class, 'update'])
            ->name('dosen.pengabdian.update');

        Route::delete('/{id}', [DosenPengabdianController::class, 'destroy'])
            ->name('dosen.pengabdian.destroy');
    });


// ======================================================
// DOSEN - PENGAJARAN
// ======================================================

Route::prefix('dosen/pengajaran')
    ->middleware(['auth', 'verified'])
    ->group(function () {

        Route::get('/', [DosenPengajaranController::class, 'index'])
            ->name('dosen.pengajaran.index');

        Route::get('/create', [DosenPengajaranController::class, 'create'])
            ->name('dosen.pengajaran.create');

        Route::post('/', [DosenPengajaranController::class, 'store'])
            ->name('dosen.pengajaran.store');

        Route::get('/{id}/edit', [DosenPengajaranController::class, 'edit'])
            ->name('dosen.pengajaran.edit');

        Route::put('/{id}', [DosenPengajaranController::class, 'update'])
            ->name('dosen.pengajaran.update');

        Route::delete('/{id}', [DosenPengajaranController::class, 'destroy'])
            ->name('dosen.pengajaran.destroy');
    });


// ======================================================
// DOSEN - PENELITIAN
// ======================================================

Route::prefix('dosen/penelitian')
    ->middleware(['auth', 'verified'])
    ->group(function () {

        Route::get('/', [DosenPenelitianController::class, 'index'])
            ->name('dosen.penelitian.index');

        Route::get('/create', [DosenPenelitianController::class, 'create'])
            ->name('dosen.penelitian.create');

        Route::post('/', [DosenPenelitianController::class, 'store'])
            ->name('dosen.penelitian.store');

        Route::get('/{id}/edit', [DosenPenelitianController::class, 'edit'])
            ->name('dosen.penelitian.edit');

        Route::put('/{id}', [DosenPenelitianController::class, 'update'])
            ->name('dosen.penelitian.update');

        Route::delete('/{id}', [DosenPenelitianController::class, 'destroy'])
            ->name('dosen.penelitian.destroy');
    });
// ======================================================
// DOSEN - PENGABDIAN
// ======================================================

Route::prefix('dosen/pengabdian')
    ->middleware(['auth', 'verified'])
    ->group(function () {

        Route::get('/', [DosenPengabdianController::class, 'index'])
            ->name('dosen.pengabdian.index');

        Route::get('/create', [DosenPengabdianController::class, 'create'])
            ->name('dosen.pengabdian.create');

        Route::post('/', [DosenPengabdianController::class, 'store'])
            ->name('dosen.pengabdian.store');

        Route::get('/{id}/edit', [DosenPengabdianController::class, 'edit'])
            ->name('dosen.pengabdian.edit');

        Route::put('/{id}', [DosenPengabdianController::class, 'update'])
            ->name('dosen.pengabdian.update');

        Route::delete('/{id}', [DosenPengabdianController::class, 'destroy'])
            ->name('dosen.pengabdian.destroy');
    });
// ======================================================
// DOSEN - PUBLIKASI
// ======================================================

Route::prefix('dosen/publikasi')
    ->middleware(['auth', 'verified'])
    ->group(function () {

        Route::get('/', [DosenPublikasiController::class, 'index'])
            ->name('dosen.publikasi.index');

        Route::get('/create', [DosenPublikasiController::class, 'create'])
            ->name('dosen.publikasi.create');

        Route::post('/', [DosenPublikasiController::class, 'store'])
            ->name('dosen.publikasi.store');

        Route::get('/{id}/edit', [DosenPublikasiController::class, 'edit'])
            ->name('dosen.publikasi.edit');

        Route::put('/{id}', [DosenPublikasiController::class, 'update'])
            ->name('dosen.publikasi.update');

        Route::delete('/{id}', [DosenPublikasiController::class, 'destroy'])
            ->name('dosen.publikasi.destroy');
    });

// ======================================================
// PROFILE
// ======================================================

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});


// ======================================================
// AUTH
// ======================================================

require __DIR__.'/auth.php';