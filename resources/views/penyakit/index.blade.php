@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h2 class="text-center text-orange mb-4 fw-bold">🧾 Daftar Penyakit</h2>

    {{-- Tab Button --}}
    <div class="d-flex flex-wrap justify-content-center gap-2 mb-4" id="penyakitTabs">
        @foreach ($diseases as $index => $penyakit)
            <button class="btn btn-outline-primary penyakit-tab {{ $index === 0 ? 'active' : '' }}"
                data-id="penyakit-{{ $penyakit->id }}">
                {{ $penyakit->name }}
            </button>
        @endforeach
    </div>

    {{-- Container Penyakit --}}
    @foreach ($diseases as $index => $penyakit)
        <div class="card shadow rounded-4 p-4 mb-5 penyakit-content {{ $index !== 0 ? 'd-none' : '' }}"
             id="penyakit-{{ $penyakit->id }}">
            <h4 class="text-orange fw-bold">Nama Penyakit</h4>
            <p>{{ $penyakit->name }}</p>

            <h5 class="text-orange fw-bold">Gejala</h5>
            @php
                $items = preg_split('/\r\n|\r|\n/', $penyakit->description);
            @endphp
            <ul>
                @foreach ($items as $item)
                    @if (trim($item))
                        <li>{{ $item }}</li>
                    @endif
                @endforeach
            </ul>


            <h5 class="text-orange fw-bold">Solusi</h5>
            <div>{!! nl2br(e($penyakit->solution)) !!}</div>
        </div>
    @endforeach
</div>
@endsection

@push('styles')
<style>
    .text-orange {
        color: #EB6B22;
    }
    .btn-outline-warning.active,
    .btn-outline-warning:hover {
        background-color: #EB6B22;
        color: white;
        border-color: #EB6B22;
    }
</style>
@endpush

@push('scripts')
<script>
    const tabs = document.querySelectorAll('.penyakit-tab');
    const contents = document.querySelectorAll('.penyakit-content');

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            // Hapus semua aktif
            tabs.forEach(t => t.classList.remove('active'));
            contents.forEach(c => c.classList.add('d-none'));

            // Tambah aktif ke yang diklik
            tab.classList.add('active');
            const target = document.getElementById(tab.dataset.id);
            if (target) {
                target.classList.remove('d-none');
            }
        });
    });

</script>
@endpush
