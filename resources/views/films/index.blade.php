@extends('layouts.app')

@section('title', 'Film List')

@section('content')
<div class="container content-wrapper" style="margin-top: 30px;">
@include('components.header', ['title' => 'Movie List', 'description' => 'Explore our collection of movies'])


    <x-search-filter />

    @if($films->count() > 0)
        <div class="row g-2 g-md-3">
            @foreach($films as $film)
                <x-film-card :film="$film" />
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-3">
    <nav aria-label="Film page navigation">
        <ul class="pagination pagination-sm justify-content-center flex-wrap">
            @if ($films->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link border-0 rounded-circle shadow-sm mx-1">&laquo;</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link border-0 rounded-circle shadow-sm mx-1" href="{{ $films->previousPageUrl() }}">&laquo;</a>
                </li>
            @endif

            @for ($i = 1; $i <= $films->lastPage(); $i++)
                <li class="page-item {{ $i == $films->currentPage() ? 'active' : '' }}">
                    <a class="page-link border-0 rounded-circle shadow-sm mx-1" href="{{ $films->url($i) }}">{{ $i }}</a>
                </li>
            @endfor

            @if ($films->hasMorePages())
                <li class="page-item">
                    <a class="page-link border-0 rounded-circle shadow-sm mx-1" href="{{ $films->nextPageUrl() }}">&raquo;</a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link border-0 rounded-circle shadow-sm mx-1">&raquo;</span>
                </li>
            @endif
        </ul>
    </nav>
</div>

    @else
        <div class="text-center py-3 my-2">
            <div class="text-muted mb-2" style="font-size: 3rem;">
                <i class="bi bi-film"></i>
            </div>
            <h5 class="mb-2">No films available yet</h5>
            <p class="text-muted mb-3 small">{{ request('search') ? 'No results for search "'.request('search').'"' : 'Be the first to add a film' }}</p>
            
            @auth
            <button type="button" 
                    class="btn btn-primary btn-sm rounded-pill px-3 py-1" 
                    data-bs-toggle="modal" 
                    data-bs-target="#createFilmModal">
                <i class="bi bi-plus-circle me-1"></i>Add New Film
            </button>
            @else
            <a href="{{ route('login') }}" class="btn btn-primary btn-sm rounded-pill px-3 py-1">
                <i class="bi bi-box-arrow-in-right me-1"></i>Login to Add Film
            </a>
            @endauth
        </div>
    @endif
</div>

@include('partials.create-film-modal', ['genres' => $genres])
@endsection