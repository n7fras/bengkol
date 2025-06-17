@extends('backend.Layout.app')
@section('content')
<!-- contentAwal -->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ $judul }}</h4>
                    <div class="row">
                        <div class="col-md-6">
                            
                            <div class="form-group">
                                <label>Nama Produk</label>
                                <input type="text" name="nama_produk" value="{{ old('product_name', $product->product_name) }}" class="form-control @error('nama_produk') is-invalid @enderror" placeholder="Masukkan Nama Produk" disabled>
                                @error('nama_produk')
                                <span class="invalid-feedback alert-danger" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                           
                            <div class="form-group">
                                <label>Foto Utama</label> <br>
                                <img src="{{ asset('storage/img-product/' . $product->foto) }}" class="foto-preview" width="100%">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Foto Tambahan</label>
                            <div id="foto-container">
                                <div class="row">
                                    @foreach($product->fotoTambahan as $foto)
                                    <div class="col-md-8 mb-2">
                                        <img src="{{ asset('storage/img-produk/' . $foto->foto) }}" width="100%">
                                    </div>
                                    <div class="col-md-4 mb-2 d-flex align-items-center">
                                        <form action="{{ route('backend.foto_produk.destroy', $foto->id) }}" method="post" onsubmit="return confirm('Yakin ingin hapus foto ini?')">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <button type="button" class="btn btn-primary add-foto mt-3">Tambah Foto</button>

                            <!-- Container untuk form upload baru -->
                            <div id="new-foto-forms" class="mt-3"></div>
                        </div>
                    </div>
                </div>
                <div class="border-top">
                    <div class="card-body">
                        <a href="{{ route('product.index') }}">
                            <button type="button" class="btn btn-secondary">Kembali</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- contentAkhir -->
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const fotoContainer = document.getElementById('foto-container');
        const addFotoButton = document.querySelector('.add-foto');
        addFotoButton.addEventListener('click', function() {
            const fotoRow = document.createElement('div');
            fotoRow.classList.add('form-group', 'row');
            fotoRow.innerHTML = `
<form action="{{ route('product.storeFotoTambahan') }}" method="post" enctype="multipart/form-data">
@csrf
<div class="col-md-12">
<input type="hidden" name="id_product" value="{{ $product->id }}">
<input type="file" name="foto[]" multiple class="form-control @error('foto') is-invalid @enderror">
<button type="submit" class="btn btn-success">Simpan</button>
</div>
</form>
`;
            fotoContainer.appendChild(fotoRow);
        });
    });
</script>
