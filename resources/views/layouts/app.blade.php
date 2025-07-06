<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pakar Diagnosa Penyakit Kucing</title>
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <!-- Mengimpor font Merriweather dari Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link href="/css/app.css" rel="stylesheet">

</head>
<body>
    <nav id="mainNavbar" class="navbar navbar-expand-lg fixed-top navbar-light transition-navbar">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="fas fa-cat"></i> Nurani Pet Care
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/#tentang') }}">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/#layanan') }}">Layanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/#lokasi') }}">Lokasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('info-diagnosa') }}">Diagnosa Penyakit</a>
                    </li>
                    {{-- Logika untuk menampilkan tautan login/logout --}}
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Masuk</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                    Dashboard Admin
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    Keluar
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main>
    {{-- Container untuk Toast Notifications --}}
    <div aria-live="polite" aria-atomic="true" class="position-relative">
        {{-- Mengubah bottom-0 menjadi top-0 dan menambahkan margin-top untuk menghindari navbar --}}
        <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1080; margin-top: 80px;">
            @if (session('success'))
                <div class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="3000">
                    <div class="d-flex">
                        <div class="toast-body">
                            {{ session('success') }}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="5000">
                    <div class="d-flex">
                        <div class="toast-body">
                            {{ session('error') }}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            @endif

            @if (session('warning'))
                <div class="toast align-items-center text-bg-warning border-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="4000">
                    <div class="d-flex">
                        <div class="toast-body">
                            {{ session('warning') }}
                        </div>
                        <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            @endif

            @if (session('info'))
                <div class="toast align-items-center text-bg-info border-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="3000">
                    <div class="d-flex">
                        <div class="toast-body">
                            {{ session('info') }}
                        </div>
                        <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            @endif
        </div>
    </div>


    {{-- Bagian untuk menampilkan error validasi Laravel di form --}}
    @if ($errors->any())
        <div class="container mt-3">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    @yield('content')
    </main>

    <!-- <footer class="bg-light py-4 mt-5">
        <div class="container text-center">
            <p class="mb-0">&copy; {{ date('Y') }} Sistem Pakar Diagnosa Penyakit Kucing</p>
            <small class="text-muted">Dibuat dengan Laravel 12</small>
        </div>
    </footer> -->

    <!-- WhatsApp Floating Button -->
    <a href="https://wa.me/6281226005692?text=Halo%20admin%20Nurani%20Pet Care,%20saya%20mau%20tanya..." class="whatsapp-float" target="_blank">
    <img src="{{ asset('images/WhatsApp.svg') }}" alt="WhatsApp" width="50">
    </a>

    <!-- Bootstrap JS with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
    AOS.init({
        duration: 1000,
        once: true,
    });
    </script>
    <script>
    const navbar = document.getElementById('mainNavbar');

    window.addEventListener('scroll', function () {
        if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
        } else {
        navbar.classList.remove('scrolled');
        }
    });
    </script>

    {{-- Script untuk menginisialisasi Bootstrap Toasts --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Dapatkan semua elemen toast
            var toastElList = [].slice.call(document.querySelectorAll('.toast'))
            // Inisialisasi setiap toast
            var toastList = toastElList.map(function(toastEl) {
                return new bootstrap.Toast(toastEl, { autohide: true }).show();
            });
        });
    </script>

</body>
@stack('scripts')

</html>
