<!-- resources/views/components/film-card.blade.php -->
<div class="col-6 col-md-4 col-lg-3 animate__animated animate__fadeIn">
    <div class="card h-100 border-0 shadow-sm film-card overflow-hidden">
        <div class="position-relative">
            <img src="{{ $film->poster }}" 
                 class="card-img-top" 
                 alt="{{ $film->judul }}" 
                 loading="lazy"
                 style="height: 200px; object-fit: cover;">
            
            <div class="position-absolute top-0 end-0 m-1">
                <span class="badge bg-primary py-1 px-2 rounded-pill fs-micro">
                    {{ $film->genre->nama }}
                </span>
            </div>
            
            @php
                $averageRating = $film->ulasans->avg('rating') ?? 0;
            @endphp
            @if($film->ulasans->count() > 0)
            <div class="position-absolute top-0 start-0 m-1">
                <span class="badge bg-warning py-1 px-2 rounded-pill text-dark d-flex align-items-center gap-1 fs-micro">
                    <i class="bi bi-star-fill"></i>
                    <span>{{ number_format($averageRating, 1) }}</span>
                </span>
            </div>
            @endif
            
            <div class="position-absolute bottom-0 end-0 m-1">
                <span class="badge {{ $film->tipe == 'series' ? 'bg-danger' : 'bg-info' }} py-1 px-2 rounded-pill fs-micro">
                    {{ $film->tipe == 'series' ? 'Series' : 'Film' }}
                </span>
            </div>
            
            <div class="film-overlay position-absolute bottom-0 start-0 w-100 p-2"
                 style="background: linear-gradient(transparent, rgba(0,0,0,0.8));">
                <h6 class="card-title text-white fw-bold mb-1 text-truncate fs-card-title">{{ $film->judul }}</h6>
                <div class="d-flex justify-content-between align-items-center">
                    <p class="card-text text-white-50 mb-0 fs-micro">
                        <i class="bi bi-calendar-event me-1"></i>{{ $film->tahun }}
                    </p>
                    
                    <p class="card-text text-white-50 mb-0 fs-micro">
                        <i class="bi bi-chat-text me-1"></i>{{ $film->ulasans->count() }}
                    </p>
                </div>
            </div>
        </div>
        
        <a href="{{ route('films.show', $film->slug) }}" class="stretched-link" aria-label="Lihat detail {{ $film->judul }}"></a>
    </div>
</div>
