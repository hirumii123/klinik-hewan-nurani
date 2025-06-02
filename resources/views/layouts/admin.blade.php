<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel | @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
    </style>
</head>
<body>
    <div class="d-flex">
        {{-- Sidebar --}}
        <div class="sidebar">
            <h5 class="h5">Admin Nurani Pet Care</h5>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->is('admin') ? 'active' : '' }}">
                        <i class="fas fa-home"></i> <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('penyakit.index') }}" class="nav-link {{ request()->is('admin/penyakit*') ? 'active' : '' }}">
                        <i class="fas fa-virus"></i> <span>Penyakit</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('gejala.index') }}" class="nav-link {{ request()->is('admin/gejala*') ? 'active' : '' }}">
                        <i class="fas fa-thermometer-half"></i> <span>Gejala</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('kategori-gejala.index') }}" class="nav-link {{ request()->is('admin/kategori-gejala*') ? 'active' : '' }}">
                        <i class="fas fa-folder-open"></i> <span>Kategori Gejala</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('rules.index') }}" class="nav-link {{ request()->is('admin/rules*') ? 'active' : '' }}">
                        <i class="fas fa-cogs"></i> <span>CF Rules</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('shortcut-rules.index') }}" class="nav-link {{ request()->is('admin/shortcut-rules*') ? 'active' : '' }}">
                        <i class="fas fa-tree"></i> <span>Rule Shortcut FC</span>
                    </a>
                </li>
            </ul>
        </div>

        {{-- Content Wrapper --}}
        <div class="content-wrapper">
            <nav class="navbar-top">
                <button class="navbar-toggler-sidebar" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <h4>@yield('title', 'Dashboard')</h4>
                <div style="width: 36px;"></div>
            </nav>
            <div class="content-area">
                @yield('content')
            </div>
        </div>
    </div>

    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1055">
    @if (session('success'))
        <div class="toast align-items-center text-bg-success border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('success') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="toast align-items-center text-bg-danger border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('error') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    @endif

    @if (session('warning'))
        <div class="toast align-items-center text-bg-warning border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('warning') }}
                </div>
                <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    @endif
    </div>
    <script>
        const toastElList = [].slice.call(document.querySelectorAll('.toast'))
        const toastList = toastElList.map(function (toastEl) {
            return new bootstrap.Toast(toastEl, { delay: 3000 }).show()
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#sidebarToggle').on('click', function() {
                $('.sidebar').toggleClass('collapsed');
            });
        });
    </script>
</body>
</html>
