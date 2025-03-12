@extends('layouts.app')

@section('title', $genre->name)

@section('content')
<div class="py-5">
    <div class="container">
        <div class="mb-4">
            <div class="d-flex align-items-center gap-3">
                <div class="mb-4">
                    <div class="d-flex align-items-center gap-3">
                        <div class="position-relative">
                            <div class="genre-icon rounded-circle bg-primary d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                <span class="text-white fs-3 fw-bold">{{ substr($genre->nama, 0, 1) }}</span>
                            </div>
                        </div>
                        <div>
                            <h1 class="fs-2 fs-md-3 fw-bold mb-1">{{ $genre->nama }}</h1>
                            <div class="d-flex align-items-center gap-2 text-muted small">
                                <span><i class="bi bi-film me-1"></i>{{ $genre->films()->count() }} Film</span>
                                <div class="vr"></div>
                                <span><i class="bi bi-calendar-check me-1"></i>Updated {{ now()->format('d M Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('components.search-filter', ['genre' => $genre])

        <div class="row g-2 g-md-3">
            @foreach($films as $film)
                <x-film-card :film="$film" />
            @endforeach
        </div>

        <div class="mt-4">
            {{ $films->links() }}
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('genres.index') }}" class="btn btn-primary d-inline-flex align-items-center gap-2 back-button">
                <i class="bi bi-arrow-left"></i>
                Back to Genres
            </a>
        </div>
    </div>
</div>

<style>
    .genre-icon {
        width: 60px;
        height: 60px;
        background-color: #0d6efd;
        transition: transform 0.2s ease-in-out;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
    }

    .genre-icon:hover {
        transform: scale(1.1);
    }

    .genre-icon span {
        font-size: 1.5rem;
        font-weight: bold;
    }

    @media (max-width: 576px) {
        .genre-icon {
            width: 50px;
            height: 50px;
        }
        .genre-icon span {
            font-size: 1.2rem;
        }
    }

    h1 {
        font-family: 'Arial', sans-serif;
        font-weight: bold;
        color: #333;
    }

    .back-button {
        padding: 10px 20px;
        border-radius: 5px;
        font-size: 1rem;
    }

    .back-button:hover {
        background-color: #0b5ed7;
        color: #fff;
    }
</style>
@endsection