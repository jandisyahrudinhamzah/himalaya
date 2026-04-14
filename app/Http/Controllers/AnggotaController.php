<?php

// app/Http/Controllers/AnggotaController.php
namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnggotaController extends Controller
{
    public function index(Request $request)
    {
        $query = Anggota::query();
        
        if ($request->filled('jabatan')) {
            $query->where('jabatan', $request->jabatan);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        $anggotas = $query->latest()->paginate(12);
        return view('admin.anggota.index', compact('anggotas'));
    }

    public function create()
    {
        $page_title = "Tambah Anggota";
        $action_url = route('admin.anggota.store');
        return view('admin.anggota.form', compact('page_title', 'action_url'));
    }

    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:anggotas,email|max:255',
            'nim' => 'nullable|string|max:20',
            'no_hp' => 'nullable|string|max:20',
            'jabatan' => 'required|string',
            'status' => 'required|in:aktif,alumni,nonaktif',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bio' => 'nullable|string|max:500',
        ], [
            'nama.required' => 'Nama wajib diisi!',
            'email.required' => 'Email wajib diisi!',
            'email.unique' => 'Email sudah terdaftar!',
            'foto.image' => 'File harus berupa gambar!',
            'foto.max' => 'Ukuran foto maksimal 2MB!',
        ]);

        try {
            $data = $request->only([
                'nama', 'email', 'nim', 'no_hp', 'jabatan', 'status', 'bio'
            ]);

            // Upload foto
            if ($request->hasFile('foto')) {
                $data['foto'] = $request->file('foto')->store('anggota', 'public');
            }

            Anggota::create($data);

            return redirect()->route('admin.anggota.index')
                ->with('success', 'Anggota berhasil ditambahkan!');

        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    public function show(Anggota $anggota)
    {
        return view('admin.anggota.show', compact('anggota'));
    }

    public function edit(Anggota $anggota)
    {
        $page_title = "Edit Anggota - " . $anggota->nama;
        $action_url = route('admin.anggota.update', $anggota->id);

        return view('admin.anggota.form', compact('page_title', 'action_url', 'anggota'));
    }

    public function update(Request $request, Anggota $anggota)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:anggotas,email,' . $anggota->id . ',id|max:255',
            'nim' => 'nullable|string|max:20',
            'no_hp' => 'nullable|string|max:20',
            'jabatan' => 'required|string',
            'status' => 'required|in:aktif,alumni,nonaktif',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bio' => 'nullable|string|max:500',
        ]);

        try {
            $data = $request->only([
                'nama', 'email', 'nim', 'no_hp', 'jabatan', 'status', 'bio'
            ]);

            // Update foto
            if ($request->hasFile('foto')) {
                // Hapus foto lama
                if ($anggota->foto) {
                    Storage::disk('public')->delete($anggota->foto);
                }
                $data['foto'] = $request->file('foto')->store('anggota', 'public');
            }

            $anggota->update($data);

            return redirect()->route('admin.anggota.index')
                ->with('success', 'Data anggota berhasil diperbarui!');

        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Gagal update data: ' . $e->getMessage());
        }
    }

    public function destroy(Anggota $anggota)
    {
        try {
            if ($anggota->foto) {
                Storage::disk('public')->delete($anggota->foto);
            }
            $anggota->delete();

            return redirect()->route('admin.anggota.index')
                ->with('success', 'Anggota berhasil dihapus!');

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal hapus data: ' . $e->getMessage());
        }
    }
}