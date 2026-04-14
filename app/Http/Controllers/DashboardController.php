<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Galeri;
use App\Models\Anggota;
use App\Models\Kegiatan;
use App\Models\Struktur;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_artikel'      => Artikel::count(),
            'total_galeri'       => Galeri::count(),
            'total_anggota'      => Anggota::count(),
            'anggota_aktif'      => Anggota::where('status', 'aktif')->count(),
            'total_kegiatans'    => Kegiatan::count(),
            'kegiatans_upcoming' => Kegiatan::where('status', 'Upcoming')->count(),
            'total_struktur'     => Struktur::count(),
        ];

        $chartData = $this->getMonthlyKegiatanData();

        return view('admin.dashboard', compact('stats', 'chartData'));
    }

    private function getMonthlyKegiatanData()
    {
        $currentYear = date('Y');
        $data = [];

        for ($month = 1; $month <= 12; $month++) {
            $count = Kegiatan::whereYear('tanggal', $currentYear)
                ->whereMonth('tanggal', $month)
                ->count();

            $data[] = $count;
        }

        return $data;
    }
}