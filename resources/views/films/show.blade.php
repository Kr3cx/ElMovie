@extends('layouts.app')

@section('title', $film->judul)

@section('content')
<div class="container py-5 mt-4">
    @include('components.films.film-detail', ['film' => $film])
    @include('components.films.film-reviews', ['film' => $film])
    @include('components.films.edit-film-modal', ['film' => $film])
</div>

<style>
    .hover-shadow:hover {
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
        transform: translateY(-2px);
    }
    .transition {
        transition: all 0.3s ease;
    }

    @media (max-width: 768px) {
        .container {
            padding: 1rem;
        }
        
        .card-body {
            padding: 1rem;
        }

        .col-lg-4 img {
            height: auto !important;
        }

        .rating-container svg {
            width: 60px;
            height: 60px;
        }

        .rating-container .fs-3 {
            font-size: 1.2rem !important;
        }

        .badge {
            font-size: 0.8rem !important;
            padding: 0.4rem 0.8rem !important;
        }

        h1.card-title {
            font-size: 1.5rem !important;
        }

        h5 {
            font-size: 1rem !important;
        }

        .review-list .card {
            padding: 0.8rem;
        }

        .avatar {
            width: 40px !important;
            height: 40px !important;
        }

        .btn {
            font-size: 0.9rem !important;
            padding: 0.4rem 0.8rem !important;
        }
    }
</style>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tipeSelect = document.getElementById('tipeSelect');
        const durasiField = document.getElementById('durasiField');
        const episodeField = document.getElementById('episodeField');
        
        function toggleFields() {
            if (tipeSelect.value === 'movie') {
                durasiField.style.display = 'block';
                episodeField.style.display = 'none';
            } else {
                durasiField.style.display = 'none';
                episodeField.style.display = 'block';
            }
        }
        
        toggleFields();
        tipeSelect.addEventListener('change', toggleFields);
    });
</script>
@endpush
@endsection