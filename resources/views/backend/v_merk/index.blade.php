@extends('backend.layout.app')

@section('content')
<div class="container">
    <h2>Daftar Merk Motor</h2>

    @if(session('success'))
        <p style="color:green;">{{ session('success') }}</p>
    @endif

    <a href="{{ route('merk.create') }}" class="btn btn-success mb-3">+ Tambah Merk</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Merk</th>
                <th>Nama Merk</th>
            </tr>
        </thead>
        <tbody>
            @foreach($merks as $merk)
                <tr>
                    <td>{{ $merk->id_merk }}</td>
                    <td>{{ $merk->merk_name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
