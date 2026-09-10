<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Pengajaran;
use App\Models\Penelitian;
use App\Models\Pengabdian;
use App\Models\Publikasi;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalDosen = Dosen::where('status', 'aktif')->count();
        $totalPengajaran = Pengajaran::count();
        $totalPenelitian = Penelitian::count();
        $totalPengabdian = Pengabdian::count();
        $totalPublikasi = Publikasi::count();

        $totalKaprodi = Dosen::where('status_kaprodi', 'ya')->count();

        $dosen = Dosen::where('status', 'aktif')
            ->orderBy('nama_dosen')
            ->get();

        return view('admin.dashboard', compact(
            'totalDosen',
            'totalPengajaran',
            'totalPenelitian',
            'totalPengabdian',
            'totalPublikasi',
            'totalKaprodi',
            'dosen'
        ));
    }
}