@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow-sm border-0 rounded-lg">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                    <h3 class="fw-bold text-primary">Edit Profile</h3>
                </div>
                
                <div class="card-body p-4">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('profile.update') }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label small text-muted fw-medium">Name</label>
                                <input type="text" name="name" id="name" class="form-control form-control-lg @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label small text-muted fw-medium">Email</label>
                                <input type="email" name="email" id="email" class="form-control form-control-lg @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="umur" class="form-label small text-muted fw-medium">Age</label>
                                <input type="number" name="umur" id="umur" class="form-control form-control-lg @error('umur') is-invalid @enderror" value="{{ old('umur', $profil->umur) }}">
                                @error('umur')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="alamat" class="form-label small text-muted fw-medium">Address</label>
                                <input type="text" name="alamat" id="alamat" class="form-control form-control-lg @error('alamat') is-invalid @enderror" value="{{ old('alamat', $profil->alamat) }}">
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="bio" class="form-label small text-muted fw-medium">Bio</label>
                            <textarea name="bio" id="bio" class="form-control form-control-lg @error('bio') is-invalid @enderror" rows="4">{{ old('bio', $profil->bio) }}</textarea>
                            @error('bio')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('profile.edit') }}" class="btn btn-outline-secondary btn-lg px-4">Cancel</a>
                            <button type="submit" class="btn btn-primary btn-lg px-4">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .form-control:focus {
        border-color: #80bdff;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
    }
    
    .btn-primary {
        background-color: #0d6efd;
        border-color: #0d6efd;
        transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
        background-color: #0b5ed7;
        border-color: #0a58ca;
        transform: translateY(-1px);
    }
    
    .card {
        transition: all 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
    }
</style>
@endpush