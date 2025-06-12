@extends('layouts.admin')

@section('title', 'Daftar Feedback')

@section('content')
<h2 class="mb-4">Daftar Feedback Pengguna</h2>

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
                        <form action="{{ route('feedback.destroy', $feedback->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus feedback ini?')" class="d-inline">
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
