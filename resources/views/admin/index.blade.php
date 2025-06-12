@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<h2 class="mb-4">Dashboard</h2>

<div class="row">
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card text-bg-success shadow card-dashboard"> {{-- TAMBAHKAN 'card-dashboard' DI SINI --}}
            <div class="card-body text-center">
                <h2>{{ $jumlahPenyakit }}</h2>
                <p class="mb-0">Penyakit Terdaftar</p>
                <a class="text-white" href="{{ route('penyakit.index') }}">Lihat</a>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card text-bg-primary shadow card-dashboard"> {{-- TAMBAHKAN 'card-dashboard' DI SINI --}}
            <div class="card-body text-center">
                <h2>{{ $jumlahGejala }}</h2>
                <p class="mb-0">Gejala Terdaftar</p>
                <a class="text-white" href="{{ route('gejala.index') }}">Lihat</a>
            </div>
        </div>
    </div>


    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card text-bg-warning shadow card-dashboard"> {{-- TAMBAHKAN 'card-dashboard' DI SINI --}}
            <div class="card-body text-center">
                <h2>{{ $jumlahRule }}</h2>
                <p class="mb-0">Rule Certainty Factor</p>
                <a class="text-dark" href="{{ route('rules.index') }}">Lihat</a>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card text-bg-danger shadow card-dashboard"> {{-- TAMBAHKAN 'card-dashboard' DI SINI --}}
            <div class="card-body text-center">
                <h2>{{ $jumlahShortcut }}</h2>
                <p class="mb-0">Tree Shortcut</p>
                <a class="text-white" href="{{ route('shortcut-rules.index') }}">Lihat</a>
            </div>
        </div>
    </div>
</div>
@endsection
