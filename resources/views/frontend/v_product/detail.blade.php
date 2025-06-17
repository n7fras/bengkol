@extends('frontend.v_layout.app') 
@section('content') 
<!-- template -->

<!-- row --> 
<div class="row"> 
    <div class="col-md-12"> 
        <div class="billing-details"> 
            <div class="section-title"> 
                <h3 class="title">{{ $judul }} </h3> 
            </div> 
        </div> 
    </div> 

    <!-- Product Details --> 
    <div class="product product-details clearfix"> 
        <div class="col-md-6"> 
            <div id="product-main-view"> 
                <div class="product-view"> 
                    <img src="{{ asset('storage/img-product/' . $product->foto) }}" alt=""> 
                </div> 

                @foreach ($fotoproduktambahan as $item) 
                    @if ($item->id_product == $product->id) 
                        <div class="product-view"> 
                            <img src="{{ asset('storage/img-product/' . $item->foto) }}" alt=""> 
                        </div> 
                    @endif 
                @endforeach 
            </div> 

            <div id="product-view"> 
                <div class="product-view"> 
                    <img src="{{ asset('storage/img-product/' . $product->foto) }}" alt=""> 
                </div> 

                @foreach ($fotoproduktambahan as $item) 
                    @if ($item->id_product == $product->id) 
                        <div class="product-view"> 
                            <img src="{{ asset('storage/img-product/' . $item->foto) }}" alt=""> 
                        </div> 
                    @endif 
                @endforeach 
            </div> 
        </div> 

        <div class="col-md-6"> 
            <div class="product-body"> 
                <div class="product-label"> 
                     <img src="{{ asset('/image/' . strtolower($row->merk->merk_name) . '.png') }}"  alt="{{ $row->merk->merk_name }}"style="width: 45px; height: 40px; background-color: white; padding: 2px;">
                    <span class="sale">{{ $product->merk->merk_name }}</span> 
                </div> 

                <h2 class="product-name">{{ $product->product_name }}</h2> 
                <h3 class="product-price">Rp. {{ number_format($product->product_price, 0, ',', '.') }}</h3> 

                <p>{!! $product->detail !!}</p> 

                <div class="product-options"> 
                    <ul class="size-option"> 
                        <li><span class="text-uppercase">Weight:</span></li> 
                        {{ $product->weight }} Gram 
                    </ul> 
                    <ul class="size-option"> 
                        <li><span class="text-uppercase">Stok:</span></li> 
                        {{ $product->product_stock }} 
                    </ul> 
                </div> 

                <div class="product-btns"> 
                    @auth ('customer')
                        <form action="{{route('addtocart',$row->id)}}" method="post" style="display: inline-block;" title="Pesan Ke Aplikasi"> 
                            @csrf 
                            <button type="submit" class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Pesan</button> 
                        </form> 
                    @else 
                        <a href="{{ route('customer.login') }}" class="primary-btn add-to-cart" onclick="return confirm('Anda harus login terlebih dahulu');">
                            <i class="fa fa-shopping-cart"></i> Pesan
                        </a> 
                    @endauth 
                </div> 
            </div> 
        </div> 
    </div> 
</div> 
<!-- /Product Details --> 

<!-- end template--> 
@endsection
