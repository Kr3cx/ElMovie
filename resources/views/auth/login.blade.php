@extends('layouts.app')

@section('content')
<head><script src="https://www.google.com/recaptcha/api.js?hl=id" async defer></script></head>
<div class="container mt-5 pt-4"> <!-- Jarak dari navbar -->
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6"> <!-- Lebar kolom disesuaikan -->
            <div class="card border-0 shadow-sm rounded-4"> <!-- Card lebih rounded dan shadow -->
                <div class="card-header bg-white border-0 text-center py-4">
                    <h2 class="fw-bold text-primary">{{ __('Login') }}</h2>
                    <p class="text-muted">Welcome back! Please login to your account.</p>
                </div>

                <div class="card-body px-5 py-4"> <!-- Padding yang lebih luas -->
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email Field -->
                        <div class="mb-4">
                            <label for="email" class="form-label fw-medium">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control rounded-pill @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Password Field -->
                        <div class="mb-4">
                            <label for="password" class="form-label fw-medium">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control rounded-pill @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

			<!-- Recaptcha -->
			<div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
			@error('g-recaptcha-response')
        		<span style="color: red;">{{ $message }}</span>
    			@enderror
			<br>
			<br>

                        <!-- Remember Me & Forgot Password -->
                        <div class="mb-4 d-flex justify-content-between align-items-center">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label text-muted" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                            @if (Route::has('password.request'))
                                <a class="text-primary fw-medium" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                        <!-- Submit Button -->
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill fw-bold">
                                {{ __('Login') }}
                            </button>
                        </div>

                        <!-- Register Link -->
                        <div class="text-center mt-4">
                            <p class="text-muted">Don't have an account? <a href="{{ route('register') }}" class="text-primary fw-medium">Register here</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
