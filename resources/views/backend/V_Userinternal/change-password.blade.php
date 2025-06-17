@extends('backend.layout.app')

@section('content')
<div class="container">
    <h1>{{ $judul }}</h1>
    <form action="{{ route('change-password.update', auth()->user()->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="old_password" class="form-label">Password Lama</label>
            <input type="password" class="form-control @error('old_password') is-invalid @enderror" 
                   id="old_password" name="old_password">
            @error('old_password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password Baru</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                   id="password" name="password">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
        </div>

        <button type="submit" class="btn btn-primary">Perbarui Password</button>
    </form>
</div>
@endsection
