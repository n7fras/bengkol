@extends('backend.layout.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('product.updatestock', $Product->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="">
                            <div class="modal-header" id="addstockModalLabel">
                                <h5>Add Stock</h5>
                            </div>
                            <div class="">
                                <label for="product_name">Product Code</label>
                                <input type="text" id="product_code" class="form-control" value="{{ $Product->product_code }}" readonly>
                            </div>
                                <div class="form-group">
                                    <label for="product_name">Product Name</label>
                                    <input type="text" id="product_name" class="form-control" value="{{ $Product->product_name }}" readonly>
                                </div>
                                <label for="product_name">Product Stock Now</label>
                                <input type="text" id="product_name" class="form-control" value="{{ $Product->product_stock }}" readonly>
                            </div>
                                
                                <div class="form-group">
                                    <label for="product_stock">Additional Stock</label>
                                    <input type="number" id="product_stock" name="product_stock" class="form-control" required min="1">
                                </div>
      
                            </div>
                            <div class="modal-footer">
                                <a type="button" class="btn btn-secondary" data-dismiss="modal " href="{{ route('product.index') }}">Close</a>
                                <button type="submit" class="btn" style="background-color: #00a373">Add Stock</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
