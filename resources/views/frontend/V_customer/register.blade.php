@extends('frontend.v_layout.app') {{-- Sesuaikan dengan layout kamu --}}

@section('content')
<div class="container" style="max-width: 600px; margin-top: 40px;">
    <h2>Daftar Akun</h2>

    <form method="POST" action="{{ route('register.customer') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name">Nama Lengkap</label>
            <input type="text" class="form-control" name="name" required>
        </div>

        <div class="form-group">
            <label for="foto">Foto Profil</label>
            <input type="file" class="form-control" name="foto">
        </div>

        <div class="form-group">
            <label for="email">Alamat Email</label>
            <input type="email" class="form-control" name="email" required>
        </div>

        <div class="form-group">
            <label for="password">Kata Sandi</label>
            <input type="password" class="form-control" name="password" required>
        </div>

        <div class="form-group">
            <label for="phone">Nomor Telepon</label>
            <input type="text" class="form-control" name="phone">
        </div>

        <div class="form-group">
            <label for="address">Alamat</label>
            <textarea class="form-control" name="address" rows="2"></textarea>
        </div>

        <div class="form-group">
            <label for="city">Kota</label>
            <input type="text" class="form-control" name="city">
        </div>

        <div class="form-group">
            <label for="state">Provinsi</label>
            <input type="text" class="form-control" name="state">
        </div>

        <button type="submit" class="primary-btn mt-3">Daftar</button>
        <button type="reset" class="secondary-btn mt-3">Reset</button>
    </form>
</div>
@endsection
