<?php

namespace App\Http\Controllers;

use App\Models\Struktur;
use Illuminate\Http\Request;

class StrukturController extends Controller
{
    public function index(Request $request)
    {
        $query = Struktur::latest();

        // Search
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('jabatan', 'like', '%' . $request->search . '%');
            });
        }

        // Filter jabatan
        if ($request->filled('jabatan')) {
            $query->where('jabatan', $request->jabatan);
        }

        $data = $query->paginate(10);
        return view('admin.struktur.index', compact('data'));
    }

    // 🔥 METHOD INI YANG HILANG!
    public function create()
    {
        return view('admin.struktur.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'status' => 'required|in:aktif,alumni',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('struktur', 'public');
        }

        Struktur::create($data);

        return redirect()->route('admin.struktur.index')->with('success', 'Struktur ditambahkan!');
    }

    public function edit($id)
    {
        $struktur = Struktur::findOrFail($id);
        return view('admin.struktur.form', compact('struktur'));
    }

    public function update(Request $request, $id)
    {
        $struktur = Struktur::findOrFail($id);
        
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'status' => 'required|in:aktif,alumni',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();
        if ($request->hasFile('foto')) {
            if ($struktur->foto) {
                \Storage::disk('public')->delete($struktur->foto);
            }
            $data['foto'] = $request->file('foto')->store('struktur', 'public');
        }

        $struktur->update($data);

        return redirect()->route('admin.struktur.index')->with('success', 'Struktur diupdate!');
    }

    public function destroy($id)
    {
        $struktur = Struktur::findOrFail($id);
        if ($struktur->foto) {
            \Storage::disk('public')->delete($struktur->foto);
        }
        $struktur->delete();
        
        return redirect()->route('admin.struktur.index')->with('success', 'Struktur dihapus!');
    }
}