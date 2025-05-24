<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel | @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        html, body {
            height: 100%; /* Penting untuk memastikan 100vh bekerja dengan baik */
            margin: 0;
            padding: 0;
        }
        body {
            font-family: 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background-color: #f8f9fa;
        }
        /* Hapus min-height: 100vh; dari .d-flex agar konten tidak dipaksa memanjang */

        .sidebar {
            min-width: 250px;
            max-width: 250px;
            background-color: #2c3e50;
            color: #ecf0f1;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            padding: 20px 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Sidebar selalu setinggi viewport */
            box-sizing: border-box; /* Pastikan padding tidak menambah tinggi */
            position: sticky; /* Membuat sidebar 'sticky' */
            top: 0; /* Menempel di bagian atas viewport */
        }
        .sidebar.collapsed {
            min-width: 80px;
            max-width: 80px;
            padding: 20px 0;
        }
        .sidebar .h5 {
            color: #ecf0f1;
            text-align: center;
            margin-bottom: 30px;
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            transition: opacity 0.3s ease;
        }
        .sidebar.collapsed .h5 {
            opacity: 0;
            height: 0;
            margin-bottom: 0;
        }
        .sidebar a {
            color: #ecf0f1;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 12px 25px;
            transition: background-color 0.3s ease, color 0.3s ease, padding 0.3s ease;
            border-left: 5px solid transparent;
            white-space: nowrap;
            overflow: hidden;
        }
        .sidebar.collapsed a {
            padding: 12px 0;
            justify-content: center;
        }
        .sidebar a.active, .sidebar a:hover {
            background-color: #34495e;
            color: #ffffff;
            border-left-color: #3498db;
        }
        .sidebar a.active {
            font-weight: bold;
        }
        .sidebar a i {
            margin-right: 10px;
            font-size: 1.1em;
            transition: margin-right 0.3s ease;
        }
        .sidebar.collapsed a i {
            margin-right: 0;
        }
        .sidebar a span {
            transition: opacity 0.3s ease, width 0.3s ease;
        }
        .sidebar.collapsed a span {
            opacity: 0;
            width: 0;
        }
        .content-wrapper { /* Tambahkan wrapper untuk konten utama */
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        .content-area {
            padding: 30px;
            background-color: #ffffff;
            /* Hapus min-height di sini, biarkan tingginya mengikuti konten */
        }
        .navbar-top {
            background-color: #ffffff;
            padding: 15px 30px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .navbar-top h4 {
            flex-grow: 1;
            text-align: center;
            margin: 0;
            padding-right: 36px;
        }
        .navbar-toggler-sidebar {
            background-color: transparent;
            border: none;
            color: #2c3e50;
            font-size: 1.5rem;
            cursor: pointer;
            z-index: 1000;
        }
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
