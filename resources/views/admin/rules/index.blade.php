@extends('layouts.admin')

@section('title', 'Rules')

@section('content')
<h2 class="mb-4">CF Rules</h2>

<a href="{{ route('rules.create') }}" class="btn btn-primary mb-3">+ Tambah CF Rules</a>

<table class="table table-bordered table-striped align-middle">
    <thead class="table-light">
        <tr>
            <th style="width: 10%">Nama Penyakit</th>
            <th>Nama Gejala</th>
            <th>CF Value</th>
            <th style="width: 25%">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($rules as $rule)
            <tr>
                <td>{{ $rule->disease->code }} - {{ $rule->disease->name }}</td>
                <td>{{ $rule->symptom->code }} - {{ $rule->symptom->name }}</td>
                <td>{{ $rule->cf_value }}</td>
                <td>
                    <div class="d-flex gap-2 justify-content-start">
                        <a href="{{ route('rules.edit', $rule->id) }}" class="btn btn-sm"><img src="{{ asset('images/edit.png') }}" width="24"><span> Edit</span></a>
                        <form action="{{ route('rules.destroy', $rule->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm"><img src="{{ asset('images/delete.png') }}" width="24"><span> Delete</span></button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
