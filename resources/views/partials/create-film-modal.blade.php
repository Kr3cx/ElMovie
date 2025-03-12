<!-- resources/views/partials/create-film-modal.blade.php -->
<div class="modal fade" id="createFilmModal" tabindex="-1" aria-labelledby="createFilmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createFilmModalLabel">Add New Film</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('films.store') }}" method="POST" id="createFilmForm">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="judul" class="form-label">Film Title:</label>
                            <input type="text" name="judul" class="form-control" id="judulInput" placeholder="Film Title" required>
                        </div>
                        <div class="col-md-3">
                            <label for="tahun" class="form-label">Release Year:</label>
                            <input type="number" name="tahun" class="form-control" id="tahunInput" min="1900" max="{{ date('Y') }}" value="{{ date('Y') }}" required>
                        </div>
                        <div class="col-md-3">
                            <label for="tipe" class="form-label">Type:</label>
                            <select name="tipe" class="form-select" id="tipeSelect" onchange="toggleEpisodeField()">
                                <option value="movie">Film</option>
                                <option value="series">Series</option>
                            </select>
                        </div>
                        
                        <div class="col-md-6 durasi-field">
                            <label for="durasi" class="form-label">Duration (minutes):</label>
                            <input type="number" name="durasi" class="form-control" id="durasiInput" min="1" value="120" placeholder="Duration">
                        </div>
                        
                        <div class="col-md-6 episode-field" style="display: none;">
                            <label for="jumlah_episode" class="form-label">Episode Count:</label>
                            <input type="number" name="jumlah_episode" class="form-control" id="episodeInput" min="1" value="1" placeholder="Number of Episodes">
                        </div>
                        
                        <div class="col-md-6">
                            <label for="genre_id" class="form-label">Genre:</label>
                            <select name="genre_id" class="form-select" required>
                                @foreach($genres as $genre)
                                <option value="{{ $genre->id }}" {{ isset($film) && $film->genre_id == $genre->id ? 'selected' : '' }}>
    {{ $genre->nama }}
</option>

                                @endforeach
                            </select>
                        </div>
                        
                        <div class="col-12">
                            <label for="ringkasan" class="form-label">Summary:</label>
                            <textarea name="ringkasan" class="form-control" id="ringkasanTextarea" rows="4" placeholder="Summary"></textarea>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="poster" class="form-label">Poster (Image URL):</label>
                            <input type="url" name="poster" class="form-control" id="posterInput" placeholder="Poster URL">
                        </div>
                        
                        <div class="col-md-6">
                            <label for="link" class="form-label">Link to Film:</label>
                            <input type="url" name="link" class="form-control" id="linkInput" placeholder="Film Link">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-plus-circle me-1"></i> Add Film
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function toggleEpisodeField() {
        const tipeSelect = document.getElementById('tipeSelect');
        const episodeField = document.querySelector('.episode-field');
        if (tipeSelect.value === 'series') {
            episodeField.style.display = 'block';
        } else {
            episodeField.style.display = 'none';
        }
    }
</script>