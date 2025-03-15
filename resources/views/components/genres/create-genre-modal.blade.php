<div class="modal fade" id="createGenreModal" tabindex="-1" aria-labelledby="createGenreLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-4">
            <div class="modal-header border-0 bg-primary text-white">
                <h5 class="modal-title" id="createGenreLabel">
                    <i class="bi bi-plus-circle me-2"></i>Add New Genre
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('genres.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Genre Name</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0">
                                <i class="bi bi-tag"></i>
                            </span>
                            <input type="text" 
                                   name="nama" 
                                   id="createNama" 
                                   class="form-control bg-light border-0" 
                                   placeholder="Example: Action, Drama, Comedy, etc." 
                                   required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-2"></i>Cancel
                    </button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-plus-circle me-2"></i>Add
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>