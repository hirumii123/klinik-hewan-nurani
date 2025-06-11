@extends('layouts.app')

@section('content')
<div class="login-page-background d-flex align-items-center justify-content-center min-vh-100 py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-8 col-sm-10" data-aos="fade-up" data-aos-duration="1000">
                <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                    <div class="card-header bg-primary text-white text-center py-4 rounded-top-4">
                        <h2 class="h3 mb-0 fw-bold">Selamat Datang Kembali!</h2>
                        <p class="mb-0 text-white-50">Silakan masuk untuk melanjutkan</p>
                    </div>
                    <div class="card-body p-4 p-md-5">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            {{-- Pesan Sukses/Error General --}}
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <h5 class="alert-heading fs-6">Terjadi Kesalahan Login!</h5>
                                    <ul class="mb-0 ps-3">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <div class="mb-4">
                                <label for="email" class="form-label fw-semibold">Alamat Email</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="contoh@domain.com">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="password" class="form-label fw-semibold">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="********">
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 form-check d-flex justify-content-between align-items-center">
                                <div>
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label text-muted" for="remember">
                                        Ingat Saya
                                    </label>
                                </div>
                                {{-- Opsional: Link Lupa Password --}}
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link text-decoration-none text-primary" href="{{ route('password.request') }}">
                                        Lupa Password?
                                    </a>
                                @endif
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg fw-bold py-3 rounded-pill">
                                    <i class="fas fa-sign-in-alt me-2"></i>Masuk
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .login-page-background {
        /* Menggunakan warna dasar atau gradient untuk latar belakang halaman login */
        background: linear-gradient(to bottom right, #e2f0fe, #f7f9fa); /* Contoh gradient biru muda ke abu-abu */
        min-height: 100vh; /* Pastikan menutupi seluruh tinggi viewport */
        padding-top: 0; /* Hapus padding-top dari layout utama jika ada */
        padding-bottom: 0;
        margin-top: -100px; /* Kompensasi padding-top dari layout app jika ada */
    }

    /* Penyesuaian agar navbar tidak mengganggu layout login */
    body {
        overflow-x: hidden; /* Mencegah scroll horizontal yang tidak perlu */
    }

    #mainNavbar {
        position: absolute !important; /* Agar tidak mendorong konten login ke bawah */
        background-color: transparent !important;
        box-shadow: none !important;
    }
    #mainNavbar .nav-link,
    #mainNavbar .navbar-brand {
        color: #fff !important; /* Warna teks nav agar terlihat di latar belakang gradient */
        text-shadow: 1px 1px 2px rgba(0,0,0,0.2);
    }
    #mainNavbar.scrolled {
        background-color: rgba(var(--bs-primary-rgb), 0.9) !important; /* Kembali ke warna primary saat scroll */
        box-shadow: 0 2px 10px rgba(0,0,0,0.15) !important;
    }
</style>
@endpush
