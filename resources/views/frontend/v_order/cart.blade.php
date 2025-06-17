@extends('frontend.v_layout.app')
@section('content')
<div class="col-md-12"> 
    <div class="order-summary clearfix"> 
        <div class="section-title"> 
            <p>KERANJANG</p> 
            <h3 class="title">Keranjang Belanja</h3> 
        </div> 

        <!-- Success Message -->
        @if(session()->has('success')) 
        <div class="alert alert-success alert-dismissible" role="alert"> 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> 
            <strong>{{ session('success') }}</strong> 
        </div> 
        @endif 

        <!-- Error Message -->
        @if(session()->has('error')) 
        <div class="alert alert-danger alert-dismissible" role="alert"> 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> 
            <strong>{{ session('error') }}</strong> 
        </div> 
        @endif 

        @if($order && $order->orderItems->count() > 0) 
        <table class="shopping-cart-table table"> 
            <thead> 
                <tr> 
                    <th>Produk</th> 
                    <th></th> 
                    <th class="text-center">Harga</th> 
                    <th class="text-center">Quantity</th> 
                    <th class="text-center">Total</th> 
                 
                    
                </tr> 
            </thead> 
            <tbody> 
                @php 
                    $totalHarga = 0; 
                    $totalBerat = 0; 
                @endphp 

                @foreach($order->orderItems as $item) 
                @php 
                    $totalHarga += $item->price * $item->quantity; 
                    $totalBerat += $item->product->weight * $item->quantity; 
                @endphp 
                <tr> 
                    <td class="thumb">
                        <img src="{{ asset('storage/img-product/' . $item->product->foto) }}" alt="">
                    </td> 
                    <td class="details"> 
                         <a>{{ $item->product->product_name }}</a> 
    <table style="width: 100%; margin-top: 5px;">
      <tr>
        <td style="width: 40%; font-weight: bold;">Weight:</td>
        <td>{{ $item->product->weight }} Gram</td>
      </tr>
      <tr>
        <td style="font-weight: bold;">Product Name:</td>
        <td>{{ $item->product->product_name }}</td>
      </tr>
    </table>
                    </td> 
                    <td class="price text-center"><strong>Rp. {{ number_format($item->price, 0, ',', '.') }}</strong></td> 
                    <td class="qty text-center"> 
                        <form action="{{route('cart.update',$item->id)}}" method="post"> 
                            @csrf 
                           
                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" style="width: 60px;"> 
                            <button type="submit" class="btn btn-sm btn-warning">Update</button> 
                        </form> 
                    </td> 
                    <td class="total text-center">
                        <strong class="primary-color">Rp. {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</strong>
                    </td> 
                    <td class="text-right"> 
                        <form action="{{route('cart.remove',$item->id)}}" method="post"> 
                            @csrf 
                            @method('DELETE') 
                            <button class="main-btn icon-btn"><i class="fa fa-close"></i></button> 
                        </form> 
                    </td> 
                </tr> 
                @endforeach 
            </tbody> 
        </table> 
        <div class="cart-summary" style="margin-top: 20px; text-align: right;">
 @unless (session()->has('shipping'))
    
      <h4>Total Berat: {{ $totalBerat }} Gram</h4>
    <h4>Sub Total Harga: Rp. {{ number_format($totalHarga, 0, ',', '.') }}</h4>
 @endunless
   
</div>

        <form action="{{route('ongkir.form')}}" method="post"> 
            @csrf 
            <input type="hidden" name="total_price" value="{{ $totalHarga }}"> 
            <input type="hidden" name="total_weight" value="{{ $totalBerat }}"> 
            <div class="pull-right"> 
                <button class="primary-btn">Pilih Pengiriman</button> 
                @if(session()->has('shipping'))
                     </form> 
    @php
        $shipping = session('shipping');
        $totalPembayaran = $totalHarga + $shipping['cost'];
    @endphp
 </div> 
   <div class="checkout-summary" >
    <table class="shopping-cart-table table" style="width: 500px; border-collapse: collapse; margin-top: 20px;">
         
        <tr>
            <td style="border: 1px solid #ddd; padding: 8px;"><strong>Kurir</strong></td>
            <td style="border: 1px solid #ddd; padding: 8px;">:</td>
            <td style="border: 1px solid #ddd; padding: 8px;">{{ strtoupper($shipping['courier']) }}</td>
        </tr>
        <tr>
            <td style="border: 1px solid #ddd; padding: 8px;"><strong>Layanan</strong></td>
            <td style="border: 1px solid #ddd; padding: 8px;">:</td>
            <td style="border: 1px solid #ddd; padding: 8px;">{{ $shipping['service'] }}</td>
        </tr>
        <tr>
            <td style="border: 1px solid #ddd; padding: 8px;"><strong>Subtotal </strong></td>
            <td style="border: 1px solid #ddd; padding: 8px;">:</td>
            <td style="border: 1px solid #ddd; padding: 8px;">Rp. {{ number_format($totalHarga, 0, ',', '.') }}</td>
        </tr>
         <tr>
            <td style="border: 1px solid #ddd; padding: 8px;"><strong>Ongkir</strong></td>
            <td style="border: 1px solid #ddd; padding: 8px;">:</td>
            <td style="border: 1px solid #ddd; padding: 8px;">Rp.{{ number_format($shipping['cost'], 0, ',', '.') }}</td>
        </tr>
         <tr>
            <td style="border: 1px solid #ddd; padding: 8px;"><strong>Grand Total</strong></td>
            <td style="border: 1px solid #ddd; padding: 8px;">:</td>
            <td style="border: 1px solid #ddd; padding: 8px;">Rp.{{ number_format($totalPembayaran, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td colspan="3" style="border: 1px solid #ddd; padding: 8px; text-align: center;">
                <form action="{{route('checkout.midtrans')}}" method="post">
    @csrf
    <input type="hidden" name="nama" value="{{ auth()->user()->name }}">
    <input type="hidden" name="email" value="{{ auth()->user()->email }}">
    <input type="hidden" name="no_hp" value="{{ auth()->user()->phone }}">
    <input type="hidden" name="total_harga" value="{{ $totalHarga }}">
    <input type="hidden" name="ongkir" value="{{ $shipping['cost'] }}">
   
        

    <input type="hidden" name="grand_total" value="{{ $totalPembayaran }}">

    <button type="submit" class="primary-btn">Checkout</button>
</form>

            </td>
        </tr>
    </table>
</div>

      
@endif

           
   
        @else 
        <p>Keranjang belanja kosong.</p> 
        @endif 
    </div> 
</div> 
@endsection