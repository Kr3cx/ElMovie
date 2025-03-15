<div class="d-flex justify-content-between align-items-center mb-4 animate__animated animate__fadeIn">
    <div>
        <h1 class="display-6 fw-bold text-primary mb-0">
            <i class="bi bi-grid-3x3-gap me-2"></i>{{ $title }}
        </h1>
        <p class="text-muted mb-0">{{ $description }}</p>
    </div>
    
    @auth
    <div class="d-none d-md-block">
        @if($title === 'Genre Categories')
        <button class="btn btn-primary rounded-pill px-4 py-2 d-flex align-items-center gap-2" 
                data-bs-toggle="modal" 
                data-bs-target="#createGenreModal">
            <i class="bi bi-plus-circle"></i>
            <span>Add Genre</span>
        </button>
        @endif
    </div>
    
    <div class="fab-container d-md-none">
        @if($title === 'Genre Categories')
        <button class="btn btn-primary rounded-circle shadow-lg fab-button" 
                data-bs-toggle="modal" 
                data-bs-target="#createGenreModal">
            <i class="bi bi-plus-lg"></i>
        </button>
        @endif
    </div>
    @endauth
</div>