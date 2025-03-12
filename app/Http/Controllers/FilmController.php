<?php


namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Genre;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index(Request $request)
    {
        $query = Film::query();
        $genres = Genre::all();
        $popularFilms = Film::latest()->take(4)->get();

        $this->applyFilters($query, $request);

        $films = $query->orderByDesc('tahun')->paginate(12);

        return view('films.index', compact('films', 'genres', 'popularFilms'));
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
                case 'year':
                    $query->orderByDesc('tahun');
                    break;
                case 'reviews':
                    $query->withCount('ulasans')->orderByDesc('ulasans_count');
                    break;
                case 'title_asc':
                    $query->orderBy('judul', 'asc');
                    break;
                case 'title_desc':
                    $query->orderBy('judul', 'desc');
                    break;
                default:
                    $query->latest();
            }
        } else {
            $query->latest();
        }
    }



    public function show(Film $film)
    {
        $ulasans = $film->ulasans()->latest()->get();
        $genres = Genre::all();
        return view('films.show', compact('film', 'ulasans', 'genres'));
    }


    public function create()
    {
        return view('films.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'tahun' => 'required|integer|min:1900|max:' . date('Y'),
            'ringkasan' => 'nullable|string',
            'poster' => 'required|string',
            'tipe' => 'required|in:movie,series',
            'jumlah_episode' => 'nullable|integer|min:1',
            'durasi' => 'nullable|integer|min:1',
            'link' => 'nullable|url'
        ]);

        Film::create($request->all());

        return redirect()->route('films.index')->with('success', 'Film berhasil ditambahkan');
    }

    public function edit(Film $film)
    {
        return view('films.edit', compact('film'));
    }

    public function update(Request $request, Film $film)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'tahun' => 'required|integer|min:1900|max:' . date('Y'),
            'ringkasan' => 'nullable|string',
            'poster' => 'required|string',
            'tipe' => 'required|in:movie,series',
            'jumlah_episode' => 'nullable|integer|min:1',
            'durasi' => 'nullable|integer|min:1',
            'link' => 'nullable|url'
        ]);

        $film->update($request->all());

        return redirect()->route('films.index')->with('success', 'Film berhasil diperbarui');
    }

    public function destroy(Film $film)
    {
        $film->delete();
        return redirect()->route('films.index')->with('success', 'Film berhasil dihapus');
    }
}
