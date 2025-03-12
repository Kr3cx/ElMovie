@extends('layouts.app')

@section('title', 'Genre List')

@section('content')
<div class="container content-wrapper">
    @include('components.header', ['title' => 'Genre Categories', 'description' => 'Find movies based on your favorite categories'])

    @include('components.genres.search')

    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3 mb-4" id="genreGrid">
        
        @foreach($genres as $genre)
            @include('components.genres.genre-card', ['genre' => $genre])
        @endforeach
        
        <div id="emptyState" class="col-12 text-center py-5 d-none">
            <div class="text-muted mb-3" style="font-size: 3rem;">
                <i class="bi bi-grid-3x3-gap"></i>
            </div>
            <h4 class="text-muted">No genres found</h4>
            <p class="text-muted">Try another keyword or add a new genre</p>
        </div>
    </div>

    <!-- Paginasi -->
    @if($genres->count() > 0)
        <div class="d-flex justify-content-center mt-3">
            <nav aria-label="Genre page navigation">
                <ul class="pagination pagination-sm justify-content-center flex-wrap">
                    @if ($genres->onFirstPage())
                        <li class="page-item disabled" aria-disabled="true">
                            <span class="page-link border-0 rounded-circle shadow-sm mx-1">&laquo;</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link border-0 rounded-circle shadow-sm mx-1" href="{{ $genres->previousPageUrl() }}" rel="prev">&laquo;</a>
                        </li>
                    @endif

                    @php
                        $startPage = max($genres->currentPage() - 1, 1);
                        $endPage = min($startPage + 2, $genres->lastPage());
                        
                        if ($endPage - $startPage < 2) {
                            $startPage = max($endPage - 2, 1);
                        }
                    @endphp
                    
                    @if($startPage > 1)
                        <li class="page-item">
                            <a class="page-link border-0 rounded-circle shadow-sm mx-1" href="{{ $genres->url(1) }}">1</a>
                        </li>
                        @if($startPage > 2)
                            <li class="page-item disabled">
                                <span class="page-link border-0 bg-transparent shadow-none">&hellip;</span>
                            </li>
                        @endif
                    @endif
                    
                    @for($i = $startPage; $i <= $endPage; $i++)
                        <li class="page-item {{ $i == $genres->currentPage() ? 'active' : '' }}">
                        <a class="page-link border-0 rounded-circle shadow-sm mx-1" href="{{ $genres->appends(request()->query())->url($i) }}">{{ $i }}</a>

                        </li>
                    @endfor
                    
                    @if($endPage < $genres->lastPage())
                        @if($endPage < $genres->lastPage() - 1)
                            <li class="page-item disabled">
                                <span class="page-link border-0 bg-transparent shadow-none">&hellip;</span>
                            </li>
                        @endif
                        <li class="page-item">
                            <a class="page-link border-0 rounded-circle shadow-sm mx-1" href="{{ $genres->url($genres->lastPage()) }}">{{ $genres->lastPage() }}</a>
                        </li>
                    @endif

                    @if ($genres->hasMorePages())
                        <li class="page-item">
                            <a class="page-link border-0 rounded-circle shadow-sm mx-1" href="{{ $genres->nextPageUrl() }}" rel="next">&raquo;</a>
                        </li>
                    @else
                        <li class="page-item disabled" aria-disabled="true">
                            <span class="page-link border-0 rounded-circle shadow-sm mx-1">&raquo;</span>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    @endif
</div>

@auth
    @include('components.genres.create-genre-modal')
@endauth


<style>
    .content-wrapper {
        margin-top: 30px;
        padding-top: 15px;
        padding-bottom: 30px;
    }
    
    .genre-card {
        transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
        border-radius: 16px !important;
        position: relative;
        cursor: pointer;
    }
    
    .genre-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    
    .genre-bg {
        height: 120px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        position: relative;
    }
    
    .genre-icon {
        font-size: 4rem;
        color: rgba(255, 255, 255, 0.8);
        z-index: 1;
    }
    
    .genre-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to bottom, rgba(0,0,0,0.1), rgba(0,0,0,0.3));
        z-index: 0;
    }
    
    .card-link-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 1;
    }
    
    .action-buttons {
        position: absolute;
        top: 10px;
        right: 10px;
        z-index: 2;
        display: flex;
        gap: 8px;
        opacity: 0;
        transition: opacity 0.2s ease-in-out;
    }
    
    .genre-card:hover .action-buttons {
        opacity: 1;
    }
    
    .btn-icon {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255, 255, 255, 0.9);
        border: none;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        transition: all 0.2s;
        color: #555;
        padding: 0;
    }
    
    .edit-btn:hover {
        background: rgba(255, 255, 255, 1);
        color: #007bff;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }
    
    .delete-btn:hover {
        background: rgba(255, 255, 255, 1);
        color: #dc3545;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }
    
    .glass {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
    }
    
    .animate__animated {
        animation-duration: 0.4s;
    }
    
    .animate__fadeIn {
        animation-name: fadeIn;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(8px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .fab-container {
        position: fixed;
        bottom: 2rem;
        right: 2rem;
        z-index: 999;
    }
    
    .fab-button {
        width: 56px;
        height: 56px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }
    
    @media (max-width: 576px) {
        .genre-bg {
            height: 100px;
        }
        
        .genre-icon {
            font-size: 3rem;
        }
        
        .btn-icon {
            width: 28px;
            height: 28px;
            font-size: 0.8rem;
        }
    }
</style>

<script>
    document.getElementById("searchGenre").addEventListener("keyup", function() {
        let searchValue = this.value;

        fetch("?search=" + searchValue)
            .then(response => response.text())
            .then(html => {
                let parser = new DOMParser();
                let doc = parser.parseFromString(html, 'text/html');
                document.getElementById("genreGrid").innerHTML = doc.getElementById("genreGrid").innerHTML;
            });
    });
</script>




<script>
    function getGenreIcon(genreName) {
        const iconMap = {
            'action': 'bi-lightning',
            'adventure': 'bi-compass',
            'animation': 'bi-emoji-smile',
            'biography': 'bi-person',
            'comedy': 'bi-emoji-laughing',
            'crime': 'bi-shield',
            'documentary': 'bi-camera-video',
            'drama': 'bi-mask',
            'family': 'bi-people',
            'fantasy': 'bi-stars',
            'history': 'bi-book',
            'sci-fi': 'bi-robot',
            'music': 'bi-music-note',
            'mystery': 'bi-question-circle',
            'romance': 'bi-heart',
            'fiction': 'bi-rocket',
            'thriller': 'bi-exclamation-circle',
            'war': 'bi-flag',
            'western': 'bi-signpost',
            'musical': 'bi-music-note-beamed',
            'sport': 'bi-trophy',
            'superhero': 'bi-shield-check'
        };
        
        const lowerGenre = genreName.toLowerCase();
        
        for (const [key, icon] of Object.entries(iconMap)) {
            if (lowerGenre.includes(key)) {
                return icon;
            }
        }
        
        return 'bi-film';
    }
    
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchGenre');
        const genreCards = document.querySelectorAll('.genre-card');
        const genreGrid = document.getElementById('genreGrid');
        const emptyState = document.getElementById('emptyState');
        
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                let hasResults = false;
                
                genreCards.forEach(card => {
                    const genreName = card.querySelector('.card-title').textContent.toLowerCase();
                    const cardContainer = card.closest('.col');
                    
                    if (genreName.includes(searchTerm)) {
                        cardContainer.style.display = 'block';
                        hasResults = true;
                    } else {
                        cardContainer.style.display = 'none';
                    }
                });
                
                if (hasResults) {
                    emptyState.classList.add('d-none');
                } else {
                    emptyState.classList.remove('d-none');
                }
            });
        }
        
        window.confirmDelete = function(event) {
            event.preventDefault();
            if (confirm('Are you sure you want to delete this genre?')) {
                event.target.submit();
            }
            return false;
        };
    });
</script>

<?php
function getGenreIcon($genreName) {
    $iconMap = [
        'action' => 'bi-lightning',
        'adventure' => 'bi-compass',
        'animation' => 'bi-emoji-smile',
        'biography' => 'bi-person',
        'comedy' => 'bi-emoji-laughing',
        'crime' => 'bi-shield',
        'documentary' => 'bi-camera-video',
        'drama' => 'bi-mask',
        'family' => 'bi-people',
        'fantasy' => 'bi-stars',
        'history' => 'bi-book',
        'sci-fi' => 'bi-robot',
        'music' => 'bi-music-note',
        'mystery' => 'bi-question-circle',
        'romance' => 'bi-heart',
        'fiction' => 'bi-rocket',
        'thriller' => 'bi-exclamation-circle',
        'war' => 'bi-flag',
        'western' => 'bi-signpost',
        'musical' => 'bi-music-note-beamed',
        'sport' => 'bi-trophy',
        'superhero' => 'bi-shield-check'
    ];
    
    $lowerGenre = strtolower($genreName);
    
    foreach ($iconMap as $key => $icon) {
        if (strpos($lowerGenre, $key) !== false) {
            return $icon;
        }
    }
    
    return 'bi-film';
}
?>
@endsection