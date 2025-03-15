<div class="dropdown">
    <button class="btn btn-sm btn-light rounded-circle" 
            type="button" 
            data-bs-toggle="dropdown" 
            aria-expanded="false"
            onclick="event.stopPropagation();">
        <i class="bi bi-three-dots-vertical"></i>
    </button>
    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
        <li>
            <button class="dropdown-item d-flex align-items-center" 
                    data-bs-toggle="modal" 
                    data-bs-target="#editGenreModal{{ $genre->id }}"
                    onclick="event.stopPropagation();">
                <i class="bi bi-pencil-square me-2 text-warning"></i>Edit
            </button>
        </li>
        <li>
            <hr class="dropdown-divider">
        </li>
        <li>
            <form action="{{ route('genres.destroy', $genre->id) }}" 
                  method="POST" 
                  id="deleteForm{{ $genre->id }}"
                  onsubmit="return confirmDelete(event)">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="dropdown-item d-flex align-items-center text-danger"
                        onclick="event.stopPropagation();">
                    <i class="bi bi-trash me-2"></i>Delete
                </button>
            </form>
        </li>
    </ul>
</div>