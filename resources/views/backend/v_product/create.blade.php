@extends('backend.layout.app')

@section('content')
<!-- contentAwal -->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form class="form-horizontal" action="{{route('product.store')}}"
                    method="post" enctype="multipart/form-data">
                    @csrf
        
                    <div class="card-body">
                        <h4>{{$judul}}</h4>
                        <h4 class="card-title"></h4>
                        <div class="row">
                            <div class="col-md-4">
                                <!-- Foto Section -->
                                <div class="form-group">
                                    <label>Photo</label>
                                    <img class="foto-preview">
                                    <input type="file" name="foto" class="form-control @error('product_image') is-invalid @enderror"
                                        onchange="previewFoto()">
                                    @error('product_image')
                                    <div class="invalid-feedback alert-danger"></div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-8">
                                <!-- Form Fields -->
                                <div class="form-group">
                                    <label>Product Code</label>
                                    <input type="text" name="product_code" value="{{$productcode}}" class="form-control @error('product_code') is-invalid @enderror" readonly>
                                    @error('product_code')
                                    <span class="invalid-feedback alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Product Name</label>
                                    <input type="text" name="product_name" value="{{ old('product_name') }}" class="form-control @error('product_name') is-invalid @enderror">
                                    @error('product_name')
                                    <span class="invalid-feedback alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Product Type</label>
                                    <select class="form-control @error('product_type') is-invalid @enderror" name="product_type">
                                        <option value="" selected>--Choose Product Type--</option>
                                        <option value="125 CC">125 CC </option>
                                        <option value="150 CC">150 CC</option>
                                    </select>
                                    @error('product_type')
                                    <span class="invalid-feedback alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Merk</label>
                                    <select class="form-control @error('merk') is-invalid @enderror" name="id_merk">
                                        <option value="" selected>--Choose Merk--</option>
                                        @foreach($merks as $m)
                                            <option value="{{$m->id_merk}}">{{$m->merk_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('id_merk')
                                    <span class="invalid-feedback alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="product_description" class="form-control @error('product_description') is-invalid @enderror">{{ old('description') }}</textarea>
                                    @error('description')
                                    <span class="invalid-feedback alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="number" name="product_price" value="{{ old('product_price') }}" class="form-control @error('product_price') is-invalid @enderror" placeholder="Input Price">
                                    @error('product_price')
                                    <span class="invalid-feedback alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Stock</label>
                                    <input type="number" name="product_stock" value="{{ old('product_stock') }}" class="form-control @error('product_stock') is-invalid @enderror" placeholder="Input Stock">
                                    @error('product_stock')
                                    <span class="invalid-feedback alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                   <div class="form-group">
                                    <label>Weight</label>
                                    <input type="number" name="weight" value="{{ old('weight') }}" class="form-control @error('weight') is-invalid @enderror" placeholder="Input Weight">
                                    @error('weight')
                                    <span class="invalid-feedback alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="border-top">
                            <div class="card-body">
                                <button type="submit" class="btn " style="background-color: #00a373">Add</button>
                                <a href="{{route('product.index')}}">
                                    <button type="button" class="btn btn-secondary">Back</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
@endsection
