@extends('backend.layout.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                     {{-- Debugging route URL --}}
                     
                    <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                       @method('PUT')

                        <div class="form-group">
                            <label for="product_code">Product Code</label>
                            <input type="text" id="product_name" name="product_code" class="form-control" value="{{ old('product_code', $product->product_code) }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="product_name">Product Name</label>
                            <input type="text" id="product_name" name="product_name" class="form-control" value="{{ old('product_name', $product->product_name) }}" required>
                        </div>
                        <div class="form-group">
                            <label>Status</label>

                            <select name="status" class="form-control @error('status') is-invalid @enderror">
                                <option value="" {{ old('status', $product->status) == '' ? 'selected' : '' }}> -
                                    Pilih Status -</option>
                                <option value="1" {{ old('status', $product->status) == '1' ? 'selected' : '' }}>
                                    Public</option>
                                <option value="0" {{ old('status', $product->status) == '0' ? 'selected' : '' }}>
                                    Blok</option>
                            </select>
                            @error('status')
                            <span class="invalid-feedback alert-danger"
                                role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="product_type">Product Type</label>
                            <select id="product_type" name="product_type" class="form-control" required>
                                <option value="125 CC" {{ $product->product_type == '125 CC' ? 'selected' : '' }}>125 CC</option>
                                <option value="150 CC" {{ $product->product_type == '150 CC' ? 'selected' : '' }}>150 CC</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="product_price">Product Price</label>
                            <input type="number" id="product_price" name="product_price" class="form-control" value="{{ old('product_price', $product->product_price) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="product_price">Weight</label>
                            <input type="number" id="weight" name="weight" class="form-control" value="{{ old('weight', $product->weight) }}" required>
                        </div>
                     

                        <div class="form-group">
                            <label for="merk">Merk</label>
                          <select class="form-control @error('merk') is-invalid @enderror" name="id_merk">
                                        <option value="" selected>--Choose Merk--</option>
                                        @foreach($merks as $m)
                                                  <option value="{{ $m->id_merk }}"
            {{ old('id_merk', $product->id_merk ?? '') == $m->id_merk ? 'selected' : '' }}>{{ $m->merk_name }} </option>
                                        @endforeach
                                    </select>
                        </div>

                        <div class="form-group">
                            <label for="product_description">Product Description</label>
                            <textarea id="product_description" name="product_description" class="form-control" required>{{ old('product_description', $product->product_description) }}</textarea>
                        </div>
                        <div class="col-md-4">
                        <div class="form-group">
                            <label for="foto">Product Image</label>
                            <br>
                            @if ($product->foto)
                                <img src="{{ asset('storage/img-product/' . $product->foto) }}" alt="Product Image" style=" height: 150px;" class="foto-preview">
                            @else
                            <img class="foto-preview"src=""{{ asset('storage/img-user/'.$product->foto) }} style=" height: 150px;" >
                                 
                            @endif
                            <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" onchange="previewFoto()">
                            @error('foto')
                            <div class="invalid-feedback alert-danger"></div>
                            @enderror
                        </div>
                    </div>
                        <div class="modal-footer">
                            <a type="button" class="btn btn-secondary" data-dismiss="modal" href="{{url('product')}}">Close</a>
                            <button type="submit" class="btn btn-primary">Update Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
