@php
    $averageRating = $film->ulasans->count() > 0 ? $film->ulasans->avg('rating') : 0;
@endphp

<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3">
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center gap-3">
            <h3 class="m-0 fw-bold">Audience Reviews</h3>
            
            <div class="d-flex align-items-center px-3 py-2 rounded-pill shadow-sm" 
                 style="background: linear-gradient(to right, #FFF3CD, #FFE69C);">
                <div class="me-2 position-relative">
                    @for($i = 1; $i <= 5; $i++)
                        <i class="bi bi-star-fill position-relative" 
                           style="color: #d3d3d3; font-size: 1.2rem; margin-right: 2px;"></i>
                    @endfor
                    
                    <div class="position-absolute top-0 start-0 overflow-hidden" 
                         style="white-space: nowrap; width: {{ ($averageRating / 10) * 100 }}%;">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="bi bi-star-fill position-relative" 
                               style="color: #FFD700; font-size: 1.2rem; margin-right: 2px;"></i>
                        @endfor
                    </div>
                </div>
                <span class="fs-5 fw-bold" style="color: #664d03;">{{ number_format($averageRating, 1) }}</span>
                <span class="ms-1 opacity-75" style="color: #664d03;">/10</span>
            </div>
        </div>
    </div>
    
    <div class="card-body p-4">
        @auth
            @php
                $existingReview = $film->ulasans->where('user_id', auth()->id())->first();
            @endphp

            @if (!$existingReview)
                <div class="mb-4 p-4 rounded shadow-sm" style="background-color: #f8f9fa;">
                    <h5 class="mb-3"><i class="bi bi-pencil-square me-2"></i>Write Your Review</h5>
                    <form action="{{ route('ulasans.store', $film) }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label for="rating" class="form-label fw-medium">Rating (1-10):</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-warning text-dark">
                                        <i class="bi bi-star-fill"></i>
                                    </span>
                                    <input type="number" name="rating" class="form-control border-warning" min="1" max="10" required>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <label for="review" class="form-label fw-medium">Review:</label>
                                <textarea name="review" class="form-control" rows="3" placeholder="Share your thoughts about this film..." required></textarea>
                            </div>
                            <div class="col-12 text-end">
                                <button type="submit" class="btn btn-warning text-dark px-4 fw-medium">
                                    <i class="bi bi-send me-1"></i> Submit Review
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            @else
                <div class="alert alert-success mb-4 shadow-sm">
                    <i class="bi bi-check-circle-fill me-2"></i> You have already reviewed this film.
                </div>
            @endif
        @else
            <div class="alert alert-info mb-4 shadow-sm">
                <i class="bi bi-info-circle-fill me-2"></i> 
                <a href="{{ route('login') }}" class="alert-link">Login</a> to write a review.
            </div>
        @endauth

        <div class="review-list">
            @php
                $paginatedUlasans = $film->ulasans()->paginate(5);
            @endphp

            @forelse($paginatedUlasans as $ulasan)
                <div class="card mb-3 border-0 shadow-sm hover-shadow transition">
                    <div class="card-body p-4">
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-3 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="avatar me-3 text-white rounded-circle d-flex align-items-center justify-content-center shadow-sm" 
                                     style="width: 48px; height: 48px; background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);">
                                    {{ substr($ulasan->user->name, 0, 1) }}
                                </div>
                                <div>
                                    <h5 class="mb-0 fw-bold">{{ $ulasan->user->name }}</h5>
                                    <small class="text-muted">{{ $ulasan->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                            
                            <div class="px-3 py-2 rounded-pill shadow-sm" 
                                 style="background: linear-gradient(to right, rgba(255,193,7,0.2), rgba(255,193,7,0.5));">
                                <div class="d-flex align-items-center">
                                    <div class="me-2 position-relative">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="bi bi-star-fill position-relative" 
                                               style="color: #d3d3d3; font-size: 0.9rem;"></i>
                                        @endfor
                                        
                                        <div class="position-absolute top-0 start-0 overflow-hidden" 
                                             style="white-space: nowrap; width: {{ ($ulasan->rating / 10) * 100 }}%;">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="bi bi-star-fill position-relative" 
                                                   style="color: #FFD700; font-size: 0.9rem;"></i>
                                            @endfor
                                        </div>
                                    </div>
                                    <span class="fw-bold" style="color: #664d03;">{{ $ulasan->rating }}</span>
                                    <span class="ms-1 small opacity-75" style="color: #664d03;">/10</span>
                                </div>
                            </div>
                        </div>
                        
                        <p class="mb-3">{{ $ulasan->review }}</p>
                        
                        @auth
                            @if ($ulasan->user_id == auth()->id())
                                <div class="d-flex justify-content-end gap-2">
                                    <button class="btn btn-sm btn-outline-secondary rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#editUlasanModal{{ $ulasan->id }}">
                                        <i class="bi bi-pencil me-1"></i> Edit
                                    </button>

                                    <form action="{{ route('ulasans.destroy', $ulasan) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3" onclick="return confirm('Delete this review?')">
                                            <i class="bi bi-trash me-1"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            @endif
                        @endauth
                    </div>
                </div>

                <div class="modal fade" id="editUlasanModal{{ $ulasan->id }}" tabindex="-1" aria-labelledby="editUlasanModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Review</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('ulasans.update', $ulasan) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="rating" class="form-label">Rating (1-10):</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-warning text-dark"><i class="bi bi-star-fill"></i></span>
                                            <input type="number" name="rating" class="form-control border-warning" min="1" max="10" value="{{ $ulasan->rating }}" required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="review" class="form-label">Review:</label>
                                        <textarea name="review" class="form-control" rows="4" required>{{ $ulasan->review }}</textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-warning text-dark">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-5">
                    <i class="bi bi-chat-square-text fs-1 text-muted mb-3 d-block"></i>
                    <h5 class="text-muted">No reviews for this film yet</h5>
                    <p>Be the first to review!</p>
                </div>
            @endforelse

            <div class="d-flex justify-content-center mt-4">
                {{ $paginatedUlasans->links() }}
            </div>
        </div>
    </div>
</div>