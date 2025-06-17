@extends('backend.layout.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{$judul}}</h5>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Product Code</th>
                                    <th>Product Name</th>
                                    <th>Product Type</th>
                                    <th>Merk</th>
                                    <th>Price</th>
                                    <th>Product Stock</th>
                                    <th>Weight</th>
                                    <th>PIC</th>
                                    <th><span class="mdi mdi-dots-vertical"></span></th>
                                </tr>
                            </thead>
                            <tbody>
                             
                               @foreach ($products as $product)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$product->product_code}}</td>
                                    <td>{{$product->product_name}}</td>
                                    <td>{{$product->product_type}}</td>
                                    <td>{{$product->merk?$product->merk->merk_name:'-'}}</td>
                                    <td>{{$product->product_price}}</td>
                                    <td>{{$product->product_stock}}</td>
                                    <td>{{$product->weight}}</td>
                                    <td>{{$product->internaluser->username}}</td>
                                    <td>
                                      
                                            <a class="nav-link  waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" > <i class="mdi mdi-dots-vertical"></i>
                                            </a>
                                             <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                <a class="dropdown-item" href="{{url('/product/edit/'.$product->id)}}">Edit</a>
                                                <a class="dropdown-item" href="{{url('/product/addstock/'.$product->id)}}">Add Stock</a>
                                                <a class="dropdown-item" href="{{ url('/product/' . $product->id . '/foto-tambahan') }}">Add Foto</a>

                                                <a class="dropdown-item" href="{{url('/product/detail/'.$product->id)}}">Detail</a>

                                            </div>
                                       
                                    </td>
                                </tr>
                           @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center">
                        {{-- {{ $users->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection




