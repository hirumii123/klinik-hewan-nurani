<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel | @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
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
                        <i class="fas fa-cogs"></i> <span>Rules CF</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('shortcut-rules.index') }}" class="nav-link {{ request()->is('admin/shortcut-rules*') ? 'active' : '' }}">
                        <i class="fas fa-tree"></i> <span>Tree Shortcut</span>
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
