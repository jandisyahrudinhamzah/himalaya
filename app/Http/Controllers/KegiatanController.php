<?php
// app/Http/Controllers/KegiatanController.php
namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class KegiatanController extends Controller
{
    public function index(Request $request)
    {
        $query = Kegiatan::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%')
                  ->orWhere('lokasi', 'like', '%' . $request->search . '%');
        }

        $kegiatans = $query->latest()->paginate(12);
        return view('admin.kegiatans.index', compact('kegiatans'));
    }

    public function create()
    {
        $page_title = "Tambah Kegiatan Baru";
        $action_url = route('admin.kegiatans.store');
        return view('admin.kegiatans.form', compact('page_title', 'action_url'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date|after_or_equal:today',
            'lokasi' => 'required|string|max:255',
            'kuota' => 'nullable|integer|min:1|max:1000',
            'status' => 'required|in:Upcoming,Ongoing,Selesai',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // 5MB
        ], [
            'judul.required' => 'Judul kegiatan wajib diisi!',
            'foto.image' => 'File harus berupa gambar!',
            'foto.mimes' => 'Format gambar: JPG, PNG, GIF',
            'foto.max' => 'Ukuran maksimal 5MB!',
            'tanggal.after_or_equal' => 'Tanggal tidak boleh masa lalu!',
        ]);

        try {
            $data = $request->only([
                'judul', 'deskripsi', 'tanggal', 'lokasi', 'kuota', 'status'
            ]);

            // UPLOAD FOTO
            if ($request->hasFile('foto')) {
                $foto = $request->file('foto');
                if ($foto->isValid()) {
                    $data['foto'] = $foto->store('kegiatans', 'public');
                }
            }

            Kegiatan::create($data);

            return redirect()->route('admin.kegiatans.index')
                ->with('success', '✅ Kegiatan berhasil ditambahkan!');

        } catch (\Exception $e) {
            Log::error('Kegiatan Store Error: ' . $e->getMessage());
            return back()->withInput()
                ->with('error', '❌ Gagal menyimpan: ' . $e->getMessage());
        }
    }

    public function show(Kegiatan $kegiatan)
    {
        return view('admin.kegiatans.show', compact('kegiatan'));
    }

    public function edit(Kegiatan $kegiatan)
    {
        $page_title = "Edit Kegiatan - " . $kegiatan->judul;
        $action_url = route('admin.kegiatans.update', $kegiatan);
        return view('admin.kegiatans.form', compact('page_title', 'action_url', 'kegiatan'));
    }

    public function update(Request $request, Kegiatan $kegiatan)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
            'lokasi' => 'required|string|max:255',
            'kuota' => 'nullable|integer|min:1|max:1000',
            'status' => 'required|in:Upcoming,Ongoing,Selesai',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        try {
            $data = $request->only([
                'judul', 'deskripsi', 'tanggal', 'lokasi', 'kuota', 'status'
            ]);

            // UPDATE FOTO
            if ($request->hasFile('foto')) {
                if ($kegiatan->foto) {
                    Storage::disk('public')->delete($kegiatan->foto);
                }
                $data['foto'] = $request->file('foto')->store('kegiatans', 'public');
            }

            $kegiatan->update($data);

            return redirect()->route('admin.kegiatans.index')
                ->with('success', '✅ Kegiatan berhasil diupdate!');

        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', '❌ Gagal update: ' . $e->getMessage());
        }
    }

    public function destroy(Kegiatan $kegiatan)
    {
        try {
            if ($kegiatan->foto) {
                Storage::disk('public')->delete($kegiatan->foto);
            }
            $kegiatan->delete();

            return redirect()->route('admin.kegiatans.index')
                ->with('success', '✅ Kegiatan berhasil dihapus!');

        } catch (\Exception $e) {
            return back()->with('error', '❌ Gagal hapus: ' . $e->getMessage());
        }
    }
}