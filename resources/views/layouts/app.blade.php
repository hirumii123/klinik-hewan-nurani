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

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Roboto', sans-serif;
        }
        .navbar-brand {
            font-weight: bold;
        }
        .rounded-4 {
            border-radius: 0.5rem;
        }
        .shadow {
            box-shadow: 0 .5rem 1rem rgba(0,0,0,.1)!important;
        }
        .whatsapp-float {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 9999;
        background-color: #25D366;
        padding: 10px;
        border-radius: 50%;
        box-shadow: 0 4px 6px rgba(0,0,0,0.3);
        animation: bounce 2s infinite;
        }
        @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        20% { transform: translateY(-5px); }
        }

        .statistics-section {
        background-image: url('asset('images/statistics-bg.jpg);
        background-size: cover;
        background-position: center;
        padding: 80px 0;
        position: relative;
        }

        .statistics-section .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(165, 75, 15, 0.85); /* Warna coklat dengan transparansi */
            z-index: 1;
        }

        .statistics-section .container {
            position: relative;
            z-index: 2;
        }

        .statistics-section h2 {
            margin-bottom: 0.5rem;
            font-size: 3rem;
        }

        @media (max-width: 768px) {
            .statistics-section h2 {
                font-size: 2.5rem;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">Nurani Petshop
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
                        <a class="nav-link" href="#">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Lokasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('penyakit') }}">Informasi Penyakit</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('info-diagnosa') }}">Diagnosa</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
    @if (session('success'))
        <div class="container mt-3">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="container mt-3">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    @if (session('warning'))
        <div class="container mt-3">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session('warning') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    @if (session('info'))
        <div class="container mt-3">
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                {{ session('info') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    @yield('content')
    </main>

    <footer class="bg-light py-4 mt-5">
        <div class="container text-center">
            <p class="mb-0">&copy; {{ date('Y') }} Sistem Pakar Diagnosa Penyakit Kucing</p>
            <small class="text-muted">Dibuat dengan Laravel 12</small>
        </div>
    </footer>

    <!-- WhatsApp Floating Button -->
    <a href="https://wa.me/6281226005692?text=Halo%20admin%20Nurani%20Petshop,%20saya%20mau%20tanya..." class="whatsapp-float" target="_blank">
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


</body>
@stack('scripts')

</html>
