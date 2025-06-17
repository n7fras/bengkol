@extends('backend.layout.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-body">
                        <div class="form-group">
                            <labe >Product Image</label>
                            <br>
                            @if ($product->foto)
                                <img src="{{ asset('storage/img-product/' . $product->foto) }}" alt="Product Image" style="height: 150px;" class="foto-preview">
                            @else
                                <img class="foto-preview" src="{{ asset('storage/img-user/default.png') }}" style="height: 150px;">
                            @endif
                        </div>
                        
                    </div>
                    <h4 class="card-title">Detail Produk</h4>
                    
                    
                    <div class="form-group">
                        <label>Product Code</label>
                        <p class="form-control">{{ $product->product_code }}</p>
                    </div>
                    
                    <div class="form-group">
                        <label>Product Name</label>
                        <p class="form-control">{{ $product->product_name }}</p>
                    </div>
                    
                    <div class="form-group">
                        <label>Product Type</label>
                        <p class="form-control">{{ $product->product_type }}</p>
                    </div>
                    
                    <div class="form-group">
                        <label>Product Price</label>
                        <p class="form-control">Rp {{ number_format($product->product_price, 0, ',', '.') }}</p>
                    </div>
                    
                    <div class="form-group">
                        <label>Merk</label>
                        <p class="form-control">{{ $product->merk }}</p>
                    </div>
                    
                    <div class="form-group">
                        <label>Product Description</label>
                        <p class="form-control">{{ $product->product_description }}</p>
                    </div>
                    
                   
                    
                    <div class="modal-footer">
                        <a href="{{ route('product.index') }}" class="btn btn-secondary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
