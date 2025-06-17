@extends('backend.layout.app')

@section('content')
<div class="container">
    <h2>Tambah Merk Motor</h2>

    @if ($errors->any())
        <div style="color:red;">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
<p><strong>ID Merk : {{ $nextId }}</strong></p>
    <form action="{{ route('merk.store') }}" method="POST">
        @csrf
        <div class="form-group">
            
            <label for="merk_name">Nama Merk:</label>
            <input type="text" name="merk_name" id="merk_name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Simpan</button>
    </form>
</div>
@endsection
