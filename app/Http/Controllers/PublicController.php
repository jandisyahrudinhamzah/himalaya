<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Galeri;
use App\Models\Kegiatan;
use App\Models\Anggota;
use App\Models\Struktur;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function home()
{
    $stats = [
        'total_artikel' => Artikel::count(),
        'total_galeri' => Galeri::count(),
        'total_anggota' => Anggota::count(),
        'total_kegiatans' => Kegiatan::count(),
    ];

    $struktur = Struktur::all();

    return view('public.home', compact('stats', 'struktur'));
}
    

    public function articles()
    {
        $artikels = Artikel::latest()->paginate(9);
        return view('public.articles', compact('artikels'));
    }

    public function articleShow($id)
    {
        $artikel = Artikel::findOrFail($id);
        return view('public.article-show', compact('artikel'));
    }

   public function gallery()
{
    $galeris = Galeri::latest()->paginate(16);
    return view('public.gallery', compact('galeris'));
}

    public function activities()
    {
        $kegiatans = Kegiatan::latest()->paginate(9);
        return view('public.activities', compact('kegiatans'));
    }

    public function activityShow($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        return view('public.activity-show', compact('kegiatan'));
    }

    public function members()
    {
        $anggotas = Anggota::latest()->paginate(20);
        return view('public.members', compact('anggotas'));
    }
}