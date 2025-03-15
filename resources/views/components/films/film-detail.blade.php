@php
    $averageRating = $film->ulasans->count() > 0 ? $film->ulasans->avg('rating') : 0;
    $ratingPercentage = ($averageRating / 10) * 100;
@endphp

<div class="card border-0 shadow-sm mb-4 overflow-hidden">
    <div class="row g-0">
        <div class="col-lg-4 position-relative">
            <img src="{{ $film->poster }}" class="img-fluid h-100 object-cover" style="object-fit: cover;" alt="{{ $film->judul }}">
            @if($film->link)
                <a href="{{ $film->link }}" target="_blank" class="position-absolute bottom-0 start-0 end-0 py-2 text-center bg-primary bg-opacity-75 text-white fw-bold text-decoration-none">
                    <i class="bi bi-play-circle-fill me-2"></i>Watch Now
                </a>
            @endif
        </div>
        
        <div class="col-lg-8">
            <div class="card-body p-4">
                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start gap-3 mb-3">
                    <div>
                        <h1 class="card-title mb-1 fw-bold">{{ $film->judul }}</h1>
                        <h5 class="text-muted">{{ $film->tahun }}</h5>
                    </div>
                    
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="rating-container position-relative">
                            <div class="d-flex align-items-center justify-content-center position-relative">
                                <svg class="rating-svg" width="90" height="90" viewBox="0 0 120 120">
                                    <circle cx="60" cy="60" r="54" fill="none" stroke="#f1f1f1" stroke-width="12" />
                                    <circle cx="60" cy="60" r="54" fill="none" stroke="#ffc107" stroke-width="12" 
                                            stroke-dasharray="339.3" stroke-dashoffset="{{ 339.3 - $ratingPercentage / 100 * 339.3 }}"
                                            transform="rotate(-90 60 60)" />
                                </svg>
                                
                                <div class="position-absolute text-center">
                                    <div class="fs-3 fw-bold lh-1">{{ number_format($averageRating, 1) }}</div>
                                    <div class="small opacity-75">out of 10</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="d-flex flex-wrap gap-2 mb-3">
                    <span class="badge bg-primary rounded-pill px-3 py-2 fs-6">{{ $film->genre->nama }}</span>
                    <span class="badge bg-secondary rounded-pill px-3 py-2 fs-6">
                        {{ $film->tipe == 'series' ? $film->jumlah_episode . ' Episodes' : $film->durasi . ' Minutes' }}
                    </span>
                    <span class="badge bg-info rounded-pill px-3 py-2 fs-6">{{ ucfirst($film->tipe) }}</span>
                </div>
                
                <h5 class="card-subtitle mb-2 fw-bold">Summary</h5>
                <p class="card-text">{{ $film->ringkasan }}</p>
                
                @auth
                    <div class="mt-4">
                        <button class="btn btn-outline-warning me-2" data-bs-toggle="modal" data-bs-target="#editFilmModal">
                            <i class="bi bi-pencil-square me-1"></i> Edit Film
                        </button>

                        <form action="{{ route('films.destroy', $film->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete?')" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger">
                                <i class="bi bi-trash me-1"></i> Delete
                            </button>
                        </form>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</div>