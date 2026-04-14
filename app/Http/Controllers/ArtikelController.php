<?php

// app/Http/Controllers/ArtikelController.php
namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArtikelController extends Controller
{
    public function index()
    {
        $artikels = Artikel::latest()->paginate(10);
        return view('admin.artikel.index', compact('artikels'));
    }

    // Di ArtikelController.php

public function create()
{
    $page_title = "Tambah Artikel";
    $action_url = route('admin.artikel.store');
    return view('admin.artikel.form', compact('page_title', 'action_url'));
}

public function edit(Artikel $artikel)
{
    $page_title = "Edit Artikel";
    $action_url = route('admin.artikel.update', $artikel->id);
    return view('admin.artikel.form', compact('page_title', 'action_url', 'artikel'));
}
    // app/Http/Controllers/ArtikelController.php - method store()

public function store(Request $request)
{
    $request->validate([
        'judul' => 'required',
        'konten' => 'required',
        'gambar' => 'image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $data = $request->all();
    $data['slug'] = Str::slug($request->judul);
    
    if ($request->hasFile('gambar')) {
        $data['gambar'] = $request->file('gambar')->store('artikel', 'public');
    }
    
    // Tambahkan pengecekan ini
    if (!auth()->check()) {
        return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu!');
    }
    
    $data['user_id'] = auth()->id();
    Artikel::create($data);

    return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil dibuat!');
}

    public function show(Artikel $artikel)
    {
        return view('admin.artikel.show', compact('artikel'));
    }

    public function update(Request $request, Artikel $artikel)
    {
        $request->validate([
            'judul' => 'required',
            'konten' => 'required',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->judul);
        
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($artikel->gambar) {\Storage::disk('public')->delete($artikel->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('artikel', 'public');
        }
        
        $artikel->update($data);

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil diperbarui!');
    }

    public function destroy(Artikel $artikel)
    {
        if ($artikel->gambar) {
            \Storage::disk('public')->delete($artikel->gambar);
        }
        $artikel->delete();
        
        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil dihapus!');
    }
}