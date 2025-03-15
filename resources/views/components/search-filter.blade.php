<!-- resources/views/components/search-filter.blade.php -->
<div class="search-filter-container mb-3">
    <form action="{{ request()->routeIs('genres.show') ? route('genres.show', $genre->id) : route('films.index') }}" method="GET" id="searchFilterForm">
        
        <div class="d-lg-none mb-2">
            <button type="button" class="btn btn-light btn-sm w-100 d-flex align-items-center justify-content-between py-2" 
                data-bs-toggle="collapse" data-bs-target="#searchFilterCollapse" 
                aria-expanded="false" aria-controls="searchFilterCollapse">
                <span><i class="bi bi-funnel-fill me-1"></i>Filter & Search</span>
                <i class="bi bi-chevron-down"></i>
            </button>
        </div>

        <div class="collapse d-lg-block" id="searchFilterCollapse">
            <div class="card glass border-0 shadow-sm rounded-3 overflow-hidden">
                <div class="card-body p-2 p-lg-3">
                    <div class="row g-2">
                        <div class="col-lg-5 col-12">
                            <div class="input-group input-group-sm">
                                <span class="input-group-text border-0 bg-light text-primary">
                                    <i class="bi bi-search"></i>
                                </span>
                                <input type="text" 
                                    name="search" 
                                    class="form-control border-0 bg-light py-1" 
                                    placeholder="Search {{ request()->routeIs('genres.*') ? 'genre' : 'movie' }} title, year..." 
                                    value="{{ request('search') }}"
                                    aria-label="Search {{ request()->routeIs('genres.*') ? 'genre' : 'movie' }}">
                                <button type="submit" class="btn btn-primary btn-sm px-2 d-none d-md-block">
                                    Search
                                </button>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm w-100 mt-1 d-md-none">
                                <i class="bi bi-search me-1"></i>Search
                            </button>
                        </div>

                        <form method="GET" action="{{ route('films.index') }}">
    <div class="col-lg-4 col-md-6 col-12">
        <div class="input-group input-group-sm">
            <span class="input-group-text border-0 bg-light text-primary">
                <i class="bi bi-sort-down"></i>
            </span>
            <select name="sort" 
                    class="form-select border-0 bg-light py-1" 
                    onchange="this.form.submit()"
                    aria-label="Sort by">
                <option value="" {{ !request('sort') ? 'selected' : '' }}>Sort by</option>
                <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Highest Rating</option>
                <option value="year" {{ request('sort') == 'year' ? 'selected' : '' }}>Newest Year</option>
                <option value="reviews" {{ request('sort') == 'reviews' ? 'selected' : '' }}>Most Reviews</option>
                <option value="title_asc" {{ request('sort') == 'title_asc' ? 'selected' : '' }}>Title A-Z</option>
                <option value="title_desc" {{ request('sort') == 'title_desc' ? 'selected' : '' }}>Title Z-A</option>
            </select>
        </div>
    </div>
</form>

                        <div class="col-lg-3 col-md-6 col-12">
                            @auth
                                @if (!request()->routeIs('genres.show')) 
                                    <button type="button" 
                                        class="btn btn-primary btn-sm rounded-pill w-100 d-flex align-items-center justify-content-center gap-1 py-1" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#createFilmModal">
                                        <i class="bi bi-plus-circle"></i>
                                        <span>Add Movie</span>
                                    </button>
                                @endif
                            @endauth
                        </div>
                    </div>

                    @if(request('search') || request('sort'))
                    <div class="active-filters mt-2 overflow-auto pb-1">
                        <div class="d-flex align-items-center flex-nowrap gap-1">
                            <div class="text-muted small me-1 text-nowrap">Filters:</div>
                            
                            @if(request('search'))
                            <div class="badge bg-light text-dark border px-2 py-1 d-flex align-items-center small">
                                <span class="text-truncate" style="max-width: 100px;">"{{ request('search') }}"</span>
                                <a href="{{ request()->routeIs('genres.*') ? route('genres.index', array_merge(request()->except('search'), ['page' => 1])) : route('films.index', array_merge(request()->except('search'), ['page' => 1])) }}" class="ms-1 text-danger">
                                    <i class="bi bi-x-circle-fill small"></i>
                                </a>
                            </div>
                            @endif
                            
                            @if(request('sort'))
                            <div class="badge bg-light text-dark border px-2 py-1 d-flex align-items-center small">
                                <span>
                                    @if(request('sort') == 'rating') 
                                        Highest Rating
                                    @elseif(request('sort') == 'year_desc')
                                        Newest Year
                                    @elseif(request('sort') == 'year_asc')
                                        Oldest Year
                                    @elseif(request('sort') == 'reviews')
                                        Most Reviews
                                    @elseif(request('sort') == 'title_asc')
                                        Title A-Z
                                    @elseif(request('sort') == 'title_desc')
                                        Title Z-A
                                    @endif
                                </span>
                                <a href="{{ request()->routeIs('genres.*') ? route('genres.index', array_merge(request()->except('sort'), ['page' => 1])) : route('films.index', array_merge(request()->except('sort'), ['page' => 1])) }}" class="ms-1 text-danger">
                                    <i class="bi bi-x-circle-fill small"></i>
                                </a>
                            </div>
                            @endif
                            
                            <a href="{{ request()->routeIs('genres.*') ? route('genres.index') : route('films.index') }}" class="ms-auto btn btn-sm btn-link text-decoration-none p-0 text-nowrap">
                                <i class="bi bi-arrow-counterclockwise"></i> Reset
                            </a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </form>
</div>
