<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GenreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index(Request $request)
    {
        $query = Genre::withCount('films');
    
        if ($request->has('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }
    
        $genres = $query->paginate(8);
        
        return view('genres.index', compact('genres'));
    }
    
    

    public function show(Genre $genre, Request $request)
    {
        $query = $genre->films();
    
        $this->applyFilters($query, $request);
    
        $films = $query->paginate(8);
    
        return view('genres.show', compact('genre', 'films', 'request'));
    }
    
    private function applyFilters($query, Request $request)
    {
        if ($request->has('search') && $request->search) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }
    
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'rating':
                    $query->withAvg('ulasans', 'rating')->orderByDesc('ulasans_avg_rating');
                    break;
                case 'tahun':
                    $query->orderByDesc('tahun');
                    break;
                case 'ulasan':
                    $query->withCount('ulasans')->orderByDesc('ulasans_count');
                    break;
                case 'judul_asc':
                    $query->orderBy('judul', 'asc');
                    break;
                case 'judul_desc':
                    $query->orderBy('judul', 'desc');
                    break;
                default:
                    $query->latest();
            }
        } else {
            $query->latest();
        }
    }

    public function create()
    {
        return view('genres.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255', // Sesuaikan dengan database
        ]);
    
        Genre::create([
            'nama' => $request->nama, // Pastikan sesuai dengan database
        ]);
    
        return redirect()->route('genres.index')->with('success', 'Genre berhasil ditambahkan');
    }
    

    public function edit(Genre $genre)
    {
        return view('genres.edit', compact('genre'));
    }

    public function update(Request $request, Genre $genre)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);
        

        $genre->update($request->all());

        return redirect()->route('genres.index')->with('success', 'Genre berhasil diperbarui');
    }

    public function destroy(Genre $genre)
    {
        $genre->delete();
        return redirect()->route('genres.index')->with('success', 'Genre berhasil dihapus');
    }
}
