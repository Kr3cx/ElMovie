@extends('layouts.app')

@section('content')
<head><script src="https://www.google.com/recaptcha/api.js?hl=id" async defer></script></head>
<div class="container mt-5 pt-4"> <!-- Tambahkan margin-top dan padding-top -->
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6"> <!-- Lebar kolom disesuaikan -->
            <div class="card border-0 shadow-sm rounded-4"> <!-- Card lebih rounded dan shadow -->
                <div class="card-header bg-white border-0 text-center py-4">
                    <h2 class="fw-bold text-primary">{{ __('Register') }}</h2>
                    <p class="text-muted">Create your account to get started.</p>
                </div>

                <div class="card-body px-5 py-4"> <!-- Padding yang lebih luas -->
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Username Field -->
                        <div class="mb-4">
                            <label for="username" class="form-label fw-medium">{{ __('Username') }}</label>
                            <input id="username" type="text" class="form-control rounded-pill @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Name Field -->
                        <div class="mb-4">
                            <label for="name" class="form-label fw-medium">{{ __('Name') }}</label>
                            <input id="name" type="text" class="form-control rounded-pill @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Email Field -->
                        <div class="mb-4">
                            <label for="email" class="form-label fw-medium">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control rounded-pill @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Password Field -->
                        <div class="mb-4">
                            <label for="password" class="form-label fw-medium">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control rounded-pill @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Confirm Password Field -->
                        <div class="mb-4">
                            <label for="password-confirm" class="form-label fw-medium">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control rounded-pill" name="password_confirmation" required autocomplete="new-password">
                        </div>

			<!-- Recaptcha -->
			<div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
			@error('g-recaptcha-response')
        		<span style="color: red;">{{ $message }}</span>
    			@enderror
			<br>
			<br>

                        <!-- Submit Button -->
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill fw-bold">
                                {{ __('Register') }}
                            </button>
                        </div>			
                        <!-- Login Link -->
                        <div class="text-center mt-4">
                            <p class="text-muted">Already have an account? <a href="{{ route('login') }}" class="text-primary fw-medium">Login here</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
