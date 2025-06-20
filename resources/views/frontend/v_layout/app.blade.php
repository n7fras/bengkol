<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('image/logobengkol.png') }}">
    <title>Bengkel Online</title>

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Hind:400,700" rel="stylesheet">

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">

    <!-- Slick -->
    <link type="text/css" rel="stylesheet" href="{{ asset('frontend/css/slick.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('frontend/css/slick-theme.css') }}">

    <!-- nouislider -->
    <link type="text/css" rel="stylesheet" href="{{ asset('frontend/css/nouislider.min.css') }}">

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}">

    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
<style>.product-thumb img {
    width: 100%; /* Lebar penuh sesuai kontainer */
    height: 200px; /* Sesuaikan tinggi sesuai kebutuhan */
    object-fit: cover; /* Memastikan gambar ter-crop dengan baik */
    border-radius: 5px; /* Opsional: Membuat sudut melengkung */
}
</style>
</head>

<body>
    <!-- HEADER -->
    <header>
        <!-- top Header -->
 <div class="top header">

 </div>
        <!-- /top Header -->

        <!-- header -->
        <div id="header">
            <div class="container">
               <div class="pull-left">
    <!-- Logo dan Teks Selamat Datang -->
    <div style="display: flex; align-items: center; gap: 10px;">
        <img src="{{ asset('image/image.png') }}" alt="" style="width: 80px; height: 80px;">
        @if (request()->segment(1) == 'beranda' || request()->segment(1) == '')
        <h3 class="text-uppercase" style="margin: 20px;">Selamat Datang di Bengkel Online</h3>
        @else
        <h3 class="text-uppercase" style="margin: 20px;">Bengkel Online</h3>
        @endif
    </div>
</div>
                    <!-- /Logo -->

                    <!-- Search -->

                    <!-- /Search -->
             
                <div class="pull-right">
                    <ul class="header-btns">
                        <!-- Cart -->
                   <li class="header-cart">
    @auth('customer')
        <a aria-expanded="true" href="{{ route('viewcart') }}">
            <div class="header-btns-icon">
                <i class="fa fa-shopping-cart"></i>
            </div>
            <strong class="text-uppercase">Keranjang</strong>
        </a>
    @else
        <a href="{{ route('customer.login') }}"
           onclick="return confirm('Anda harus login terlebih dahulu untuk melihat keranjang.')">
            <div class="header-btns-icon">
                <i class="fa fa-shopping-cart"></i>
            </div>
            <strong class="text-uppercase">Keranjang</strong>
        </a>
    @endauth
</li>

                        <!-- /Cart -->
                        @if (Auth::guard('customer')->check())
                        <!-- Account -->
                        <li class="header-account dropdown default-dropdown">
                            <div class="dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="true">
                                <div class="header-btns-icon">
                                    <i class="fa fa-user-o"></i>
                                </div>
                                <strong class="text-uppercase">{{Auth::guard('customer')->user()->name}}<i class="fa fa-caret-down"></i></strong>
                            </div>
                            
                            <ul class="custom-menu">
                                <li><a href="#"><i class="fa fa-user-o"></i> My Account</a></li>
                                <li><a href="{{route('customer.logout')}}"><i class="fa fa-power-off"></i>Keluar</a></li>
                            </ul>
                        </li>
                        @else
                        <li class="header-account dropdown default-dropdown"> 
    <div class="dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="true"> 
        <div class="header-btns-icon"> 
            <i class="fa fa-user-o"></i> 
        </div> 
        <strong class="text-uppercase">Akun Saya<i class="fa fa-caret-down"></i></strong> 
    </div> 
    <a href="{{ route('customer.login') }}" class="text-uppercase">Login</a> 
</li> 
@endif
                        <!-- /Account -->

                        <!-- Mobile nav toggle-->
                        <li class="nav-toggle">
                            <button class="nav-toggle-btn main-btn icon-btn"><i class="fa fa-bars"></i></button>
                        </li>
                        <!-- / Mobile nav toggle -->
                    </ul>
                </div>
            </div>
            <!-- header -->
        </div>
        <!-- container -->
    </header>
    <!-- /HEADER -->

    <!-- NAVIGATION -->
    <div id="navigation">
        <!-- container -->
        <div class="container">
             <div id="responsive-nav">
                @php
                $merk= DB::table('merk')->orderby('merk_name', 'asc')->get();
                @endphp
                @if (request()->segment(1) == 'beranda' )
                <!-- category nav -->
                <div class="category-nav">
                    <span class="category-header">MERK <i class="fa fa-list"></i></span>
                    <ul class="category-list">
                          <li><a href="{{route('shopping')}}">all</a></li>
                        @foreach ($merk as $merk)

                        <li><a href="{{route('shopping',$merk->id_merk)}}">{{$merk->merk_name}}</a></li>
                        @endforeach
                      
                    </ul>
                </div>
               @else
                   <div class="category-nav show-on-click">
                    <span class="category-header">MERK <i class="fa fa-list"></i></span>
                    <ul class="category-list">
                         <li><a href="{{route('shopping')}}">all</a></li>
                        @foreach ($merk as $merk)
                        <li><a href="{{route('shopping',$merk->id_merk)}}">{{$merk->merk_name}}</a></li>
                        @endforeach

                    </ul>
                </div>
                @endif
                <!-- /category nav -->

            
            </div>
                <!-- /category nav -->

                <!-- menu nav -->
                <div class="menu-nav">
                    <span class="menu-header">Menu <i class="fa fa-bars"></i></span>
                    <ul class="menu-list">
                        <li><a href="{{route('beranda')}}">Home</a></li>
                        <li><a href="{{route('shopping')}}">Shop</a></li>
                         <li><a href="#">Service</a></li>
                        <li><a href="#">Queue</a></li>

                    </ul>
                </div>
                <!-- menu nav -->
            </div>
        </div>
        <!-- /container -->
    </div>
    <!-- /NAVIGATION -->
    @if (request()->segment(1) == '' || request()->segment(1) == 'beranda') 

    <!-- HOME -->
    <div id="home">
        <!-- container -->
        <div class="container">
            <!-- home wrap -->
            <div class="home-wrap">
                <!-- home slick -->
                <div id="home-slick">
                    <!-- banner -->
                    <div class="banner banner-1">
                        <img src="{{ asset('frontend/img/banner01.jpg') }}" alt="">
                        <div class="banner-caption text-center">
                            <h1>Bags sale</h1>
                            <h3 class="white-color font-weak">Up to 50% Discount</h3>
                            <button class="primary-btn">Shop Now</button>
                        </div>
                    </div>
                    <!-- /banner -->

                    <!-- banner -->
                    <div class="banner banner-1">
                        <img src="{{ asset('frontend/img/banner02.jpg') }}" alt="">
                        <div class="banner-caption">
                            <h1 class="primary-color">HOT DEAL<br><span class="white-color font-weak">Up to 50% OFF</span></h1>
                            <button class="primary-btn">Shop Now</button>
                        </div>
                    </div>
                    <!-- /banner -->

                    <!-- banner -->
                    <div class="banner banner-1">
                        <img src="{{ asset('frontend/img/banner03.jpg') }}" alt="">
                        <div class="banner-caption">
                            <h1 class="white-color">New Product <span>Collection</span></h1>
                            <button class="primary-btn">Shop Now</button>
                        </div>
                          
                    </div>
                   
                    <!-- /banner -->
                </div>
                <!-- /home slick -->
            </div>
            <!-- /home wrap -->
        </div>
      
        <!-- /container -->
    </div>
    <!-- /HOME -->
  @endif
    <!-- section -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- ASIDE -->
                <div id="aside" class="col-md-3">
                    <!-- aside widget -->
                    <div class="aside">
                        <h3 class="aside-title">Top Rated Product</h3>
                        <!-- widget product -->
                        <div class="product product-widget">
                            <div class="product-thumb">
                                <img src="{{ asset('frontend/img/thumb-product01.jpg') }}" alt="">
                            </div>
                            <div class="product-body">
                                <h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>
                                <h3 class="product-price">$32.50 <del class="product-old-price">$45.00</del></h3>
                                <div class="product-rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o empty"></i>
                                </div>
                            </div>
                        </div>
                        <!-- /widget product -->

                        <!-- widget product -->
                        <div class="product product-widget">
                            <div class="product-thumb">
                                <img src="{{ asset('frontend/img/thumb-product01.jpg') }}" alt="">
                            </div>
                            <div class="product-body">
                                <h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>
                                <h3 class="product-price">$32.50</h3>
                                <div class="product-rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o empty"></i>
                                </div>
                            </div>
                        </div>
                        <!-- /widget product -->
                    </div>
                    <!-- /aside widget -->
                    <!-- aside widget -->
                    <div class="aside">
                        <h3 class="aside-title">Filter by Brand</h3>
                        <ul class="list-links">
                            <li><a href="#">Nike</a></li>
                            <li><a href="#">Adidas</a></li>
                            <li><a href="#">Polo</a></li>
                            <li><a href="#">Lacost</a></li>
                        </ul>
                    </div>
                    <!-- /aside widget -->
                </div>
                <!-- /ASIDE -->

                <!-- MAIN -->
                <div id="main" class="col-md-9">
                    <!-- store top filter -->
                    <!-- /store top filter -->
            @yield('content')

                    <!-- store bottom filter -->

                    <!-- /store bottom filter -->
                </div>
                <!-- /MAIN -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /section -->

    <!-- FOOTER -->
    <footer id="footer" class="section section-grey">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- footer widget -->
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="footer">
                        <!-- footer logo -->
                        <div class="footer-logo">
                            <a class="logo" href="#">
                                <img src="./img/logo.png" alt="">
                            </a>
                        </div>
                        <!-- /footer logo -->

                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna</p>

                        <!-- footer social -->
                        <ul class="footer-social">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                        </ul>
                        <!-- /footer social -->
                    </div>
                </div>
                <!-- /footer widget -->

                <!-- footer widget -->
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-header">My Account</h3>
                        <ul class="list-links">
                            <li><a href="#">My Account</a></li>
                            <li><a href="#">My Wishlist</a></li>
                            <li><a href="#">Compare</a></li>
                            <li><a href="#">Checkout</a></li>
                            <li><a href="#">Login</a></li>
                        </ul>
                    </div>
                </div>
                <!-- /footer widget -->

                <div class="clearfix visible-sm visible-xs"></div>

                <!-- footer widget -->
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-header">Customer Service</h3>
                        <ul class="list-links">
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Shiping & Return</a></li>
                            <li><a href="#">Shiping Guide</a></li>
                            <li><a href="#">FAQ</a></li>
                        </ul>
                    </div>
                </div>
                <!-- /footer widget -->

                <!-- footer subscribe -->
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-header">Stay Connected</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor.</p>
                        <form>
                            <div class="form-group">
                                <input class="input" placeholder="Enter Email Address">
                            </div>
                            <button class="primary-btn">Join Newslatter</button>
                        </form>
                    </div>
                </div>
                <!-- /footer subscribe -->
            </div>
            <!-- /row -->
            <hr>
            <!-- row -->
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center">
                    <!-- footer copyright -->
                    <div class="footer-copyright">
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;<script>
                            document.write(new Date().getFullYear());
                        </script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </div>
                    <!-- /footer copyright -->
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </footer>
    <!-- /FOOTER -->

    <!-- jQuery Plugins -->
 <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/slick.min.js') }}"></script>
    <script src="{{ asset('frontend/js/nouislider.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.zoom.min.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>

</body>

</html>