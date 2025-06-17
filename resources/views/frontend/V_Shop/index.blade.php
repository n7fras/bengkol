@extends('frontend.v_layout.app')
@section('content')

                    <!-- STORE -->
                    <div id="store">
                        <!-- row -->
                        <div class="row">
                            <!-- Product Single -->
                            @foreach($produk as $row)
                            <div class="col-md-4 col-sm-6 col-xs-6">
                                <div class="product product-single">
                                    <div class="product-thumb">
                                        
                                      <div class="" >
                                           
                                       @if($row->merk && $row->merk->merk_name)
                                      <img src="{{ asset('/image/' . strtolower($row->merk->merk_name) . '.png') }}"  alt="{{ $row->merk->merk_name }}"style="width: 45px; height: 40px; background-color: white; padding: 2px;">
                                      @else
                                        <span class="merk">Merk tidak tersedia</span>
                                        @endif 
                                        <span class="sale" style="background-color: #fe9f14; border:3px solid black;color:#fff; padding:5px;" >{{ $row->merk->merk_name }}</span> 
                                        </div> 
                                      
                                        
                                        <a href="{{route('product.detail_product',$row->id)}}">  <button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Detail Product</button></a>
                                      
                                        <img src="{{asset('storage/img-product/'.$row->foto) }}" alt="" class="product-thumb">
                                    </div>
                                    <div class="product-body">
                                        <h3 class="product-price">Rp.{{number_format($row->product_price)}}  <span class="product-old-price">{{$row->product_type}}</span></h3>
                                       
                                        <h2 class="product-name"><a href="#">{{$row->product_name}}</a></h2>
                                        <div class="product-btns"> 
                                            <a href="{{route('product.detail_product',$row->id)}}" title="Detail Produk"> 
                                                <button class="main-btn icon-btn"><i class="fa fa-search
                    plus"></i></button> 
                                            </a> 
                                            <form action="{{route('addtocart',$row->id)}}" method="post" 
                                                style="display: inline-block;" title="Pesan Ke Aplikasi"> 
                                                @csrf 
                                                <button type="submit" class="primary-btn add-to-cart"><i 
                                                        class="fa fa-shopping-cart"></i> Pesan</button> 
                     

                     
                                            </form> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            @endforeach
                            <!-- /Product Single -->
                            <div class="clearfix visible-md visible-lg visible-sm visible-xs"></div>
                        </div>
                        <!-- /row -->
                    </div>
                    <!-- /STORE -->
                    </div>
                    <div class="col-md-12 text-center">
    {{ $produk->links('pagination::bootstrap-4') }}
</div>
@endsection
