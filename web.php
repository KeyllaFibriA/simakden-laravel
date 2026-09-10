<?php

use App\Http\Controllers\AdminPublikasiController;
use App\Http\Controllers\AdminAktivitasController;
use App\Http\Controllers\AdminPengabdianController;
use App\Http\Controllers\AdminPenelitianController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminDosenController;
use App\Http\Controllers\AdminPengajaranController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/admin/dosen/{dosenId}/aktivitas/create', [AdminAktivitasController::class, 'create'])
    ->middleware(['auth', 'verified'])
    ->name('admin.dosen.aktivitas.create');

Route::get('/', function () {
    return view('welcome');
});
        Route::get('/dashboard', function () {

    if (auth()->user()->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }

    if (auth()->user()->isDosen()) {
        return redirect()->route('dosen.dashboard');
    }

    abort(403, 'Role pengguna tidak dikenali.');

})->middleware(['auth', 'verified'])->name('dashboard');

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {

    if (auth()->user()->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }

    if (auth()->user()->isDosen()) {
        return redirect()->route('dosen.dashboard');
    }

    abort(403, 'Role pengguna tidak dikenali.');

})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('admin.dashboard');
Route::get('/admin/dosen/{id}', [AdminDosenController::class, 'show'])
    ->middleware(['auth', 'verified'])
    ->name('admin.dosen.show');

Route::get('/dosen/dashboard', function () {
    return view('dosen.dashboard');
})->middleware(['auth', 'verified'])->name('dosen.dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__.'/auth.php';