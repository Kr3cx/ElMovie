@extends('layouts.app')

@section('title', 'Error 404')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

 <style>
        .error-container {
            min-height: 70vh; /* Pastikan tetap berada di tengah tanpa mendorong footer */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        .error-code {
            font-size: 100px;
            font-weight: bold;
            color: #007bff; /* Biru */
        }
        .error-text {
            font-size: 22px;
            color: #6c757d; /* Abu-abu gelap */
            margin-bottom: 20px;
        }
        .btn-home {
            padding: 10px 20px;
            font-size: 18px;
            font-weight: bold;
        }
    </style>


<!-- Wrapper agar tidak mengganggu footer -->
    <div class="container error-container">
        <h1 class="error-code">404</h1>
        <p class="error-text">Oops! Halaman yang Anda cari tidak ditemukan.</p>
        <a href="{{ url('/') }}" class="btn btn-primary btn-home">Kembali ke Beranda</a>
    </div>

    <!-- Footer -->
    <footer class="text-center py-3">
        <div class="container">
            <p class="mb-0">© 2025 <strong>ElMovie</strong> | Created by Kresna & Ryan</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection
