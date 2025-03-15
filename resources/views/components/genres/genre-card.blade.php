<div class="col animate__animated animate__fadeIn" style="animation-delay: {{ $loop->index * 0.05 }}s">
    <div class="film-genre-card h-100 border-0 shadow-sm overflow-hidden rounded-xl position-relative bg-white">
        <!-- Light Film-inspired Background -->
        <div class="genre-backdrop position-absolute w-100 h-100" 
             style="background: linear-gradient(to right, 
                    rgba(255,255,255,0.9), 
                    rgba(255,255,255,0.6)), 
                    url('{{ asset('images/genres/' . strtolower($genre->nama) . '.jpg') }}') center/cover no-repeat;">
        </div>
        
        <!-- Card Content -->
        <div class="card-content position-relative p-4 d-flex flex-column h-100">
            <!-- Genre Icon with Accent -->
            <div class="genre-accent mb-3">
                <span class="genre-accent-bubble shadow-sm" style="background-color: {{ 'hsl(' . (crc32($genre->nama) % 360) . ', 85%, 60%)' }}">
                    <i class="bi {{ getGenreIcon($genre->nama) }} text-white"></i>
                </span>
            </div>
            
            <!-- Genre Title -->
            <h4 class="genre-title fw-bold mb-2 text-dark">{{ $genre->nama }}</h4>
            
            <!-- Film Count with Cinematic Icon -->
            <div class="film-count d-flex align-items-center text-muted mb-auto">
                <i class="bi bi-film me-2"></i>
                <span>{{ $genre->films_count ?? 0 }} films</span>
            </div>
            
            <!-- Action Area -->
            <div class="action-area mt-4 d-flex justify-content-between align-items-center">
                <!-- Rating Preview (could show average rating for this genre) -->
                <div class="rating-preview">
                    <div class="stars-container">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= round(($genre->average_rating ?? 3.5)))
                                <i class="bi bi-star-fill text-warning"></i>
                            @else
                                <i class="bi bi-star text-warning"></i>
                            @endif
                        @endfor
                    </div>
                </div>
                
                <!-- Explore Button -->
                <a href="{{ route('genres.show', $genre->id) }}" class="btn btn-sm btn-primary rounded-pill px-3 explore-btn" aria-label="Explore {{ $genre->nama }} movies">
                    Explore <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
            
            <!-- Admin Controls -->
            @auth
            <div class="admin-controls position-absolute top-0 end-0 p-2">
                <div class="btn-group">
                    <button class="btn btn-sm btn-light shadow-sm edit-btn" 
                            type="button" 
                            data-bs-toggle="modal" 
                            data-bs-target="#editGenreModal{{ $genre->id }}"
                            onclick="event.stopPropagation();">
                        <i class="bi bi-pencil text-primary"></i>
                    </button>
                    <form action="{{ route('genres.destroy', $genre->id) }}" 
                          method="POST" 
                          id="deleteForm{{ $genre->id }}"
                          class="d-inline"
                          onsubmit="return confirmDelete(event)">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="btn btn-sm btn-light shadow-sm delete-btn"
                                onclick="event.stopPropagation();">
                            <i class="bi bi-trash text-danger"></i>
                        </button>
                    </form>
                </div>
            </div>
            @endauth
        </div>
        
        <a href="{{ route('genres.show', $genre->id) }}" class="card-link-overlay" aria-label="Browse {{ $genre->nama }} movies"></a>
    </div>
</div>

<!-- Light Cinematic Modal for editing -->
@auth
<div class="modal fade" id="editGenreModal{{ $genre->id }}" tabindex="-1" aria-labelledby="editGenreLabel{{ $genre->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0" style="background-color: {{ 'hsl(' . (crc32($genre->nama) % 360) . ', 85%, 85%)' }}">
                <h5 class="modal-title" id="editGenreLabel{{ $genre->id }}">
                    <i class="bi bi-film me-2 text-{{ strtolower(str_replace(' ', '-', $genre->nama)) }}"></i>Edit {{ $genre->nama }} Genre
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('genres.update', $genre->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Genre Name</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0">
                                <i class="bi bi-tag"></i>
                            </span>
                            <input type="text" 
                                   name="nama" 
                                   id="editNama{{ $genre->id }}" 
                                   class="form-control bg-light border-0" 
                                   value="{{ $genre->nama }}" 
                                   required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light rounded-pill px-4 border" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-2"></i>Cancel
                    </button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-check-circle me-2"></i>Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endauth

<style>
/* Custom CSS for Light Cinematic Film Genre Cards */
.film-genre-card {
    transition: all 0.3s ease;
    min-height: 200px;
    border: 1px solid rgba(0,0,0,0.05);
}

.film-genre-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
}

.genre-accent-bubble {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    font-size: 1.5rem;
}

.explore-btn {
    transition: all 0.3s ease;
    border: none;
}

.film-genre-card:hover .explore-btn {
    padding-right: 1.2rem;
}

.stars-container {
    font-size: 0.8rem;
    letter-spacing: 0.1em;
}

.rounded-xl {
    border-radius: 0.8rem;
}

/* Optional: Add film reel animation */
@keyframes filmReel {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

.film-count i {
    animation: filmReel 8s linear infinite;
    display: inline-block;
}

/* Light theme specific styles */
.genre-title {
    position: relative;
}

.genre-title::after {
    content: '';
    position: absolute;
    bottom: -5px;
    left: 0;
    width: 40px;
    height: 3px;
    background-color: rgba(0,0,0,0.1);
    border-radius: 3px;
}

.card-content {
    z-index: 2;
}
</style>