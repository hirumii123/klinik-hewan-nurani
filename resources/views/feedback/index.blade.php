@extends('layouts.admin')

@section('title', 'Daftar Feedback')

@section('content')
<h2 class="mb-4">Feedback</h2>

<div class="d-flex justify-content-end mb-3">
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
                    {{-- Saran Penyakit Column with Popover --}}
                    <td style="max-width: 200px;"> {{-- Batasi lebar kolom --}}
                        @if ($feedback->suggested_disease)
                            <span class="feedback-snippet"
                                  data-bs-toggle="popover"
                                  data-bs-trigger="hover focus"
                                  data-bs-placement="bottom"
                                  data-bs-html="true"
                                  data-bs-content="{{ e($feedback->suggested_disease) }}" {{-- Langsung gunakan teks, e() untuk keamanan --}}
                                  style="cursor: help; display: block; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                {{ $feedback->suggested_disease }}
                            </span>
                        @else
                            -
                        @endif
                    </td>
                    {{-- Saran Gejala Column with Popover --}}
                    <td style="max-width: 300px;"> {{-- Batasi lebar kolom --}}
                        @if ($feedback->suggested_symptoms)
                            <span class="feedback-snippet"
                                  data-bs-toggle="popover"
                                  data-bs-trigger="hover focus"
                                  data-bs-placement="bottom"
                                  data-bs-html="true"
                                  data-bs-content="{{ nl2br(e($feedback->suggested_symptoms)) }}" {{-- Gunakan nl2br untuk baris baru, e() untuk keamanan --}}
                                  style="cursor: help; display: block; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                {{ $feedback->suggested_symptoms }}
                            </span>
                        @else
                            -
                        @endif
                    </td>
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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize all popovers
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        })
    });
</script>
@endpush
