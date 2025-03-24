<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use App\Models\Film;
use Illuminate\Http\Request;

class UlasanController extends Controller
{
    // Middleware untuk memastikan user sudah login sebelum memberi ulasan
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Fungsi untuk menyimpan ulasan baru
    public function store(Request $request, Film $film)
    {
        // Validasi input rating dan review
        $request->validate([
            'rating' => 'required|integer|min:1|max:10',
            'review' => 'required'
        ]);

        // Cek apakah user sudah memberikan ulasan untuk film ini
        if (Ulasan::where('user_id', auth()->id())->where('film_id', $film->id)->exists()) {
            return redirect()->route('films.show', ['film' => $film->slug])
                ->with('error', 'Anda hanya bisa memberikan satu ulasan per film.');
        }

        // Simpan ulasan ke database
        Ulasan::create([
            'user_id' => auth()->id(),
            'film_id' => $film->id,
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        // Redirect ke halaman film berdasarkan slug
        return redirect()->route('films.show', ['film' => $film->slug])
            ->with('success', 'Ulasan berhasil ditambahkan');
    }

    // Fungsi untuk menampilkan halaman edit ulasan
    public function edit(Ulasan $ulasan)
    {
        // Cek apakah ulasan ini milik user yang sedang login
        if ($ulasan->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk mengedit ulasan ini.');
        }

        return view('ulasans.edit', compact('ulasan'));
    }

    // Fungsi untuk memperbarui ulasan
    public function update(Request $request, Ulasan $ulasan)
    {
        // Cek apakah ulasan ini milik user yang sedang login
        if ($ulasan->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk mengedit ulasan ini.');
        }

        // Validasi input
        $request->validate([
            'rating' => 'required|integer|min:1|max:10',
            'review' => 'required'
        ]);

        // Update ulasan di database
        $ulasan->update($request->all());

        // Redirect ke halaman film berdasarkan slug
        return redirect()->route('films.show', ['film' => $ulasan->film->slug])
            ->with('success', 'Ulasan berhasil diperbarui');
    }

    // Fungsi untuk menghapus ulasan
    public function destroy(Ulasan $ulasan)
    {
        // Cek apakah ulasan ini milik user yang sedang login
        if ($ulasan->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menghapus ulasan ini.');
        }

        // Hapus ulasan dari database
        $ulasan->delete();

        // Redirect ke halaman film berdasarkan slug
        return redirect()->route('films.show', ['film' => $ulasan->film->slug])
            ->with('success', 'Ulasan berhasil dihapus');
    }
}

