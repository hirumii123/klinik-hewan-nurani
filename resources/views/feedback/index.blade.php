@extends('layouts.admin')

@section('title', 'Daftar Feedback')

@section('content')
<h2 class="mb-4">Feedback</h2>

<div class="d-flex justify-content-end mb-3"> {{-- Menggunakan justify-content-end untuk menempatkan filter di kanan --}}
    <form action="{{ route('feedback-admin.index') }}" method="GET" class="d-flex gap-2 align-items-center">
        <div class="input-group">
            <span class="input-group-text">Dari Tanggal</span>
            <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
        </div>
        <div class="input-group">
            <span class="input-group-text">Sampai Tanggal</span>
            <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
        </div>
        <button type="submit" class="btn btn-primary">Filter</button>
        @if(request('start_date') || request('end_date'))
            <a href="{{ route('feedback-admin.index') }}" class="btn btn-danger">Reset</a>
        @endif
    </form>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-striped align-middle">
        <thead class="table-light">
            <tr>
                <th style="width: 5%;">No</th>
                <th>Saran Penyakit</th>
                <th>Saran Gejala</th>
                <th style="width: 15%;">Tanggal</th>
                <th style="width: 10%;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($feedbacks as $feedback)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $feedback->suggested_disease ?? '-' }}</td>
                    <td>{{ $feedback->suggested_symptoms ?? '-' }}</td>
                    <td>{{ $feedback->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <form action="{{ route('feedback-admin.destroy', $feedback->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus feedback ini?')" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm"><img src="{{ asset('images/delete.png') }}" width="24"><span> Delete</span></button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada feedback yang tersedia.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
