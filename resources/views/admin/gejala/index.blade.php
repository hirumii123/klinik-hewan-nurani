@extends('layouts.admin')

@section('title', 'Gejala')

@section('content')
<h2 class="mb-4">Gejala</h2>

<div class="d-flex justify-content-between align-items-center mb-3">
    <a href="{{ route('gejala.create') }}" class="btn btn-primary mb-3">+ Tambah Gejala</a>

    <form action="{{ route('gejala.index') }}" method="GET" class="d-flex gap-2">
        <div class="input-group">
            <select name="filter_category" class="form-select">
                <option value="">Filter Berdasarkan Kategori</option>
                @foreach ($kategoriList as $kategori)
                    <option value="{{ $kategori->id }}" {{ request('filter_category') == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->name }}
                    </option>
                @endforeach
            </select>
            <button class="btn btn-outline-secondary" type="submit">Filter</button>
        </div>
        @if(request('filter_category'))
            <a href="{{ route('gejala.index') }}" class="btn btn-danger">Reset</a>
        @endif
    </form>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-striped align-middle">
        <thead class="table-light">
            <tr>
                <th style="width: 5%">Kode</th>
                <th>Nama Gejala</th>
                <th>Kategori Gejala</th>
                <th style="width: 15%">Gambar</th>
                <th style="width: 15%">Sumber Gambar</th>
                <th style="width: 20%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($gejalas as $gejala)
                <tr>
                    <td>{{ $gejala->code }}</td>
                    <td>{{ $gejala->name }}</td>
                    <td>{{ $gejala->kategori->name ?? '-' }}</td>
                    <td>
                        @if ($gejala->image)
                            <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal"
                               data-image-url="{{ asset($gejala->image) }}"
                               data-image-source="{{ $gejala->image_source ?? 'Tidak ada sumber' }}"
                               class="d-block text-center image-zoom-trigger">
                                <img src="{{ asset($gejala->image) }}" alt="Gambar Gejala" style="width: 80px; height: auto; object-fit: cover; border-radius: 5px; cursor: pointer;">
                            </a>
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $gejala->image_source ?? '-' }}</td>
                    <td>
                        <div class="d-flex gap-2 justify-content-start">
                            <a href="{{ route('gejala.edit', $gejala->id) }}" class="btn btn-sm"><img src="{{ asset('images/edit.png') }}" width="24"><span> Edit</span></a>
                            <form action="{{ route('gejala.destroy', $gejala->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm"><img src="{{ asset('images/delete.png') }}" width="24"><span> Delete</span></button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data gejala yang ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="imageModalLabel">Detail Gambar Gejala</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center" style="background-color: #f8f9fa;">
        <img src="" class="img-fluid" id="modalImage" alt="Gambar Gejala Detail"
             style="max-height: 70vh; width: auto; object-fit: contain; display: block; margin: 0 auto; min-width: 100px; min-height: 100px; border: 1px solid #ddd;">
        <p class="text-muted mt-2" id="modalImageSource"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
    var imageModal = document.getElementById('imageModal');
imageModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    var imageUrl = button.getAttribute('data-image-url');
    var imageSource = button.getAttribute('data-image-source');

    console.log('Modal Triggered');
    console.log('Image URL:', imageUrl);
    console.log('Image Source:', imageSource);

    var modalImage = imageModal.querySelector('#modalImage');
    var modalImageSource = imageModal.querySelector('#modalImageSource');

    modalImage.src = '';
    modalImage.src = imageUrl + '?t=' + new Date().getTime(); // cache buster

    modalImageSource.textContent = 'Sumber: ' + imageSource;

    modalImage.onload = function () {
        console.log('✅ Gambar berhasil dimuat:', this.src);
    };
    modalImage.onerror = function () {
        console.error('❌ Gagal memuat gambar, fallback:', this.src);
        this.src = 'https://placehold.co/400x300/e0e0e0/555555?text=Gambar+Tidak+Ditemukan';
    };
});


    // Event listener saat modal ditutup untuk membersihkan src gambar
    imageModal.addEventListener('hidden.bs.modal', function () {
        var modalImage = imageModal.querySelector('#modalImage');
        modalImage.src = '';
        modalImage.onload = null;
        modalImage.onerror = null;
    });

        document.querySelectorAll('.image-zoom-trigger').forEach(function(trigger) {
        trigger.addEventListener('click', function() {
            console.log('Trigger Diklik!');
        });
    });
</script>
<style>
    img#modalImage {
    border: 2px dashed red;
}
</style>
@endpush
