<div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3 mb-4" id="genreGrid">
    @foreach($genres as $genre)
        @include('components.genres.genre-card', ['genre' => $genre])
    @endforeach
    
    @if($genres->isEmpty())
        <div class="col-12 text-center py-5">
            <h4 class="text-muted">No genres found</h4>
        </div>
    @endif
</div>
