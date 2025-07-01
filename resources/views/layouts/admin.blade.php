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
        /* Gaya tambahan untuk dropdown di admin panel jika diperlukan */
        .admin-dropdown-toggle::after {
            vertical-align: 0.155em; /* Penyesuaian posisi panah dropdown */
        }
    </style>
</head>
<body>
    <div class="d-flex">
        {{-- Sidebar --}}
        <div class="sidebar">
            <h5 class="h5">
                <i class="fas fa-cat sidebar-logo-icon"></i>
                <span class="sidebar-logo-text">Admin Panel Nurani</span>
            </h5>
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
                <li class="nav-item">
                    <a href="{{ route('feedback-admin.index') }}" class="nav-link {{ request()->is('admin/feedback-admin*') ? 'active' : '' }}">
                        <i class="fas fa-comment-dots"></i> <span>Feedback</span>
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
                <h4 class="flex-grow-1 text-start ps-3 mb-0">@yield('Dashboard')</h4> {{-- Judul halaman tetap di kiri --}}

                {{-- Dropdown Nama Admin --}}
                @auth
                    <div class="dropdown ms-auto"> {{-- ms-auto akan mendorong dropdown ke kanan --}}
                        <a class="nav-link dropdown-toggle text-muted fs-6 admin-dropdown-toggle" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Halo, {{ Auth::user()->name }}!
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="adminDropdown">
                            <li><a class="dropdown-item" href="{{ url('/') }}">
                                <i class="fas fa-globe me-2"></i>Kembali ke Website
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                             document.getElementById('logout-form-admin').submit();">
                                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                                </a>
                                <form id="logout-form-admin" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                @endauth
                <div style="width: 36px;"></div> {{-- Elemen placeholder untuk menjaga keseimbangan layout --}}
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

    @stack('scripts')
</body>
</html>
