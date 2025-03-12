<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use App\Models\Film;
use Illuminate\Http\Request;

class UlasanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, Film $film)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:10',
            'review' => 'required'
        ]);
    
        if (Ulasan::where('user_id', auth()->id())->where('film_id', $film->id)->exists()) {
            return redirect()->route('films.show', $film->id)->with('error', 'Anda hanya bisa memberikan satu ulasan per film.');
        }
    
        Ulasan::create([
            'user_id' => auth()->id(),
            'film_id' => $film->id,
            'rating' => $request->rating,
            'review' => $request->review,
        ]);
    
        return redirect()->route('films.show', $film->id)->with('success', 'Ulasan berhasil ditambahkan');
    }
    
    public function edit(Ulasan $ulasan)
    {
        if ($ulasan->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk mengedit ulasan ini.');
        }
    
        return view('ulasans.edit', compact('ulasan'));
    }
    
    public function update(Request $request, Ulasan $ulasan)
    {
        if ($ulasan->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk mengedit ulasan ini.');
        }
    
        $request->validate([
            'rating' => 'required|integer|min:1|max:10',
            'review' => 'required'
        ]);
    
        $ulasan->update($request->all());
    
        return redirect()->route('films.show', $ulasan->film_id)->with('success', 'Ulasan berhasil diperbarui');
    }
    
    public function destroy(Ulasan $ulasan)
    {
        if ($ulasan->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menghapus ulasan ini.');
        }
    
        $ulasan->delete();
    
        return redirect()->route('films.show', $ulasan->film_id)->with('success', 'Ulasan berhasil dihapus');
    }
    
}
