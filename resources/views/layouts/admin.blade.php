<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel | @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: sans-serif; }
        .sidebar {
            min-height: 100vh;
            background-color: #343a40;
            color: #fff;
        }
        .sidebar a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 12px 16px;
        }
        .sidebar a.active, .sidebar a:hover {
            background-color: #495057;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        {{-- Sidebar --}}
        <div class="sidebar p-3">
            <h5 class="mb-4">🛠️ Admin CMS</h5>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->is('admin') ? 'active' : '' }}">
                        🏠 Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('penyakit.index') }}" class="nav-link {{ request()->is('admin/penyakit*') ? 'active' : '' }}">
                        💉 Penyakit
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('gejala.index') }}" class="nav-link {{ request()->is('admin/gejala*') ? 'active' : '' }}">
                        🐾 Gejala
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('kategori-gejala.index') }}" class="nav-link {{ request()->is('admin/kategori-gejala*') ? 'active' : '' }}">
                        📂 Kategori Gejala
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('rules.index') }}" class="nav-link {{ request()->is('admin/rules*') ? 'active' : '' }}">
                        ⚙️ Rules CF
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('shortcut-rules.index') }}" class="nav-link {{ request()->is('admin/shortcut-rules*') ? 'active' : '' }}">
                        🌳 Tree Shortcut
                    </a>
                </li>
            </ul>
        </div>

        {{-- Content --}}
        <div class="flex-grow-1 p-4">
            @yield('content')
        </div>
    </div>
</body>
</html>
