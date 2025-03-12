<div class="modal fade" id="editFilmModal" tabindex="-1" aria-labelledby="editFilmLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editFilmLabel">Edit Film</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('films.update', $film->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="judul" class="form-label">Film Title:</label>
                            <input type="text" name="judul" class="form-control" value="{{ $film->judul }}" required>
                        </div>
                        <div class="col-md-3">
                            <label for="tahun" class="form-label">Release Year:</label>
                            <input type="number" name="tahun" class="form-control" min="1900" max="{{ date('Y') }}" value="{{ $film->tahun }}" required>
                        </div>
                        <div class="col-md-3">
                            <label for="tipe" class="form-label">Type:</label>
                            <select name="tipe" class="form-select" id="tipeSelect">
                                <option value="movie" {{ $film->tipe == 'movie' ? 'selected' : '' }}>Film</option>
                                <option value="series" {{ $film->tipe == 'series' ? 'selected' : '' }}>Series</option>
                            </select>
                        </div>
                        
                        <div class="col-md-6 movie-field" id="durasiField">
                            <label for="durasi" class="form-label">Duration (minutes):</label>
                            <div class="input-group">
                                <input type="number" name="durasi" class="form-control" value="{{ $film->durasi }}">
                                <span class="input-group-text">minutes</span>
                            </div>
                        </div>
                        
                        <div class="col-md-6 series-field" id="episodeField">
                            <label for="jumlah_episode" class="form-label">Episode Count:</label>
                            <div class="input-group">
                                <input type="number" name="jumlah_episode" class="form-control" value="{{ $film->jumlah_episode }}">
                                <span class="input-group-text">episodes</span>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="genre_id" class="form-label">Genre:</label>
                            <select name="genre_id" class="form-select" required>
                                @foreach($genres as $genre)
                                    <option value="{{ $genre->id }}" {{ $film->genre_id == $genre->id ? 'selected' : '' }}>
                                        {{ $genre->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="col-12">
                            <label for="ringkasan" class="form-label">Summary:</label>
                            <textarea name="ringkasan" class="form-control" rows="4">{{ $film->ringkasan }}</textarea>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="poster" class="form-label">Poster (Image URL):</label>
                            <input type="text" name="poster" class="form-control" value="{{ $film->poster }}">
                        </div>
                        
                        <div class="col-md-6">
                            <label for="link" class="form-label">Link to Film:</label>
                            <input type="text" name="link" class="form-control" value="{{ $film->link }}">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-lg me-1"></i> Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>