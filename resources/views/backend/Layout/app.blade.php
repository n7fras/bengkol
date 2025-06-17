<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('image/Logofix.png')}}">
    <title>MOBAS</title>
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/extra-libs/multicheck/multicheck.css') }}">
    <link href="{{ asset('backend/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/dist/css/style.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    



   
        <!-- Tambahkan Chart.js CDN -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

<style>
    .scroll-sidebar::-webkit-scrollbar {
    width: 0; /* Menyembunyikan scrollbar vertikal */
    height: 0; /* Menyembunyikan scrollbar horizontal */
}

.navbar-nav.float-right {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    display: flex;
    align-items: center;
}





</style>
</head>

<body>
    

    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" >
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin5" style="position: fixed; width: 100%;">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark"  >
                <div class="navbar-header" data-logobg="skin5" style="background-color: #00a373;">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)" id="humburger"><i class="ti-menu ti-close"></i></a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="{{url('/dashboard')}}">
                        <!-- Logo icon -->
                       
                            <b class="logo-icon ">
                                <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                                <!-- Dark Logo icon -->
                                                         
                                <img src="{{asset('image/Logofix.png')}}" alt="homepage" class="light-logo "style="width: 50px; height: 50px; margin-top: 15px; margin-left: 0px" />
                             
                                
                               
                            </b>
                     
                       
                      
                        <b class="logo-icon" > 
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                             <img src="{{asset('image/Mobas.png')}}" alt="homepage" class="light-logo" style="margin-top: 8px; margin-left: 15px; width: 125px; height: 50px" />
                            
                         </b> 
                        <!--End Logo icon -->
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse d-flex flex-nowrap" id="navbarSupportedContent" data-navbarbg="skin5" style="background-color: #00a373 !important ">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-left mr-auto">
                        <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
                     
                       
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-right"  >
                        <!-- ============================================================== -->
                        <!-- Comment -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown"style="margin-left: 850px">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-bell font-24" ></i>
                            </a>
                             <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- End Comment -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Messages -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown"  >
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="font-24 mdi mdi-comment-processing"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown" aria-labelledby="2">
                                <ul class="list-style-none">
                                    <li>
                                        <div class="">
                                             <!-- Message -->
                                            <a href="javascript:void(0)" class="link border-top">
                                                <div class="d-flex no-block align-items-center p-10">
                                                    <span class="btn btn-success btn-circle"><i class="ti-calendar"></i></span>
                                                    <div class="m-l-10">
                                                        <h5 class="m-b-0">Event today</h5> 
                                                        <span class="mail-desc">Just a reminder that event</span> 
                                                    </div>
                                                </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="link border-top">
                                                <div class="d-flex no-block align-items-center p-10">
                                                    <span class="btn btn-info btn-circle"><i class="ti-settings"></i></span>
                                                    <div class="m-l-10">
                                                        <h5 class="m-b-0">Settings</h5> 
                                                        <span class="mail-desc">You can customize this template</span> 
                                                    </div>
                                                </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="link border-top">
                                                <div class="d-flex no-block align-items-center p-10">
                                                    <span class="btn btn-primary btn-circle"><i class="ti-user"></i></span>
                                                    <div class="m-l-10">
                                                        <h5 class="m-b-0">Pavan kumar</h5> 
                                                        <span class="mail-desc">Just see the my admin!</span> 
                                                    </div>
                                                </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="link border-top">
                                                <div class="d-flex no-block align-items-center p-10">
                                                    <span class="btn btn-danger btn-circle"><i class="fa fa-link"></i></span>
                                                    <div class="m-l-10">
                                                        <h5 class="m-b-0">Luanch Admin</h5> 
                                                        <span class="mail-desc">Just see the my new admin!</span> 
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
               
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown" >
                            @if(Auth::user()->foto)
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{asset('storage/img-user/'.Auth::user()->foto)}}" alt="user" class="rounded-circle img-fluid" style="max-height: 40px; max-width: 40px; object-fit: cover;"></a>
                            @else
                            <a  class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{asset('storage/img-user/Kilua.jpg')}}" alt="user" class="rounded-circle img-fluid"  style="max-height: 40px; max-width: 40px; object-fit: cover;">
    
                            </a>                            
                            @endif
                            <div class="dropdown-menu dropdown-menu-right user-dd animated">
                                <a class="dropdown-item" href="javascript:void(0)"><i class="ti-user m-r-5 m-l-5"></i> My Profile</a>
                                <a class="dropdown-item" href="javascript:void(0)"><i class="ti-wallet m-r-5 m-l-5"></i> My Balance</a>
                                <a class="dropdown-item" href="javascript:void(0)"><i class="ti-email m-r-5 m-l-5"></i> Inbox</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{url('/change-password')}}"><i class="ti-settings m-r-5 m-l-5"></i> Reset Password</a>
                                
                                <a class="dropdown-item" href="#" 
                                   onclick="if(confirm('Apakah Anda yakin ingin logout?')) { event.preventDefault(); document.getElementById('logout-form').submit(); }">
                                    <i class="fa fa-power-off m-r-5 m-l-5"></i> Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                <div class="dropdown-divider"></div>
                                
                             
                                <div class="dropdown-divider"></div>
                                <div class="p-l-30 p-10"><a href="javascript:void(0)" class="btn btn-sm btn-success btn-rounded">View Profile</a></div>
                            </div>
                        </li>
                       
                    </ul>
                </div>
            </nav>
        </header>
    
 <aside class="left-sidebar"  data-sidebarbg="skin5"  style="background-color: #00a373; position: fixed">
            <!-- Sidebar scroll-->
<div class="scroll-sidebar" style="overflow: scroll; ">
                <!-- Sidebar navigation-->
 <nav class="sidebar-nav" >
                    <ul id="sidebarnav" class="mt-5" style="background-color: #00a373">
                       

                       <li class="sidebar-item d-flex  "style="justify-content: center">
   
                            <i class="mdi mdi-account-circle fs-1 text-muted hide-menu" style="font-size: 70px"></i>
                           
                    </li>
             
                    <li class="sidebar-item d-flex " style="justify-content: center"><i class="hide-menu" >{{Auth::user()->name}}</i></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{url('/dashboard')}}" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">User Internal </span></a>
                            <ul aria-expanded="false" class="collapse  first-level" style="background-color: #00a373">
                                <li class="sidebar-item"><a href="{{url('/internal_user')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> List User Internal</span></a></li>
                                <li class="sidebar-item"><a href="{{url('/internal_user/create')}}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Add User Internal</span></a></li>
                            </ul>
                        </li>
                         <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{url('/merk')}}" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Merk</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-cart"></i><span class="hide-menu">products </span></a>
                            <ul aria-expanded="false" class="collapse  first-level"style="background-color: #00a373">
                                <li class="sidebar-item"><a href="{{url('/product')}}" class="sidebar-link"><i class="mdi mdi-cart-outline"></i><span class="hide-menu"> Data Product </span></a></li>
                                <li class="sidebar-item"><a href="{{url('/product/create')}}" class="sidebar-link"><i class="mdi mdi-cart-plus"></i><span class="hide-menu"> Add Product </span></a></li>
                            </ul>
                        </li>
               
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span class="hide-menu">Customer</span></a>
                            <ul aria-expanded="false" class="collapse  first-level" style="background-color: #00a373">
                                <li class="sidebar-item"><a href="{{url('/customer')}}" class="sidebar-link"><i class="mdi mdi-account-multiple-check"></i><span class="hide-menu"> Data Customer</span></a></li>
                                <li class="sidebar-item"><a href="{{url('/customer/activity_log')}}" class="sidebar-link"><i class="mdi mdi-cog"></i><span class="hide-menu"> Log Activity Customer </span></a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-hammer-wrench"></i><span class="hide-menu">Mechanic </span></a>
                            <ul aria-expanded="false" class="collapse  first-level"style="background-color: #00a373">
                                <li class="sidebar-item"><a href="{{url('/mechanic')}}" class="sidebar-link"><i class="mdi mdi-wrench"></i><span class="hide-menu"> Data Mechanic</span></a></li>
                                <li class="sidebar-item"><a href="authentication-register.html" class="sidebar-link"><i class="mdi mdi-clipboard-list"></i><span class="hide-menu"> Mechanic KPI </span></a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-file-chart"></i><span class="hide-menu">Report </span></a>
                            <ul aria-expanded="false" class="collapse  first-level" style="background-color: #00a373">
                                <li class="sidebar-item"><a href="error-403.html" class="sidebar-link"><i class="mdi mdi-percent-box"></i><span class="hide-menu"> Sales Report </span></a></li>
                                <li class="sidebar-item"><a href="error-404.html" class="sidebar-link"><i class="mdi mdi-invoice-list-outline"></i><span class="hide-menu"> Product Report </span></a></li>
                                <li class="sidebar-item"><a href="error-405.html" class="sidebar-link"><i class="mdi mdi-file-table-box"></i><span class="hide-menu"> Customer Report </span></a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>

        <div class="page-wrapper" style="margin-top: 65px; " >
          

            <div class="container-fluid" >
            {{-- Kontenutama --}}
                @yield('content')
            </div>
          
           
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <div class="page-wrapper"><footer class="footer text-center mb-0 "style="padding-bottom: 0px">
            Application by Frasetya, Fiqriyah, Hans, Adrian, Rizky.R 2024. 
        </footer></div>
        <!-- ============================================================== -->
    </div>
    
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset ('backend/assets/libs/jquery/dist/jquery.min.js') }}"></script>

    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{asset ('backend/assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{asset ('backend/assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{asset ('backend/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="{{asset ('backend/assets/extra-libs/sparkline/sparkline.js') }}"></script>
    <!--Wave Effects -->
    <script src="{{ asset('backend/dist/js/waves.js') }}"></script>
    <!--Menu sidebar -->
    <script src="{{ asset('backend/dist/js/sidebarmenu.js') }}"></script>
    <!--Custom JavaScript -->
    <script src="{{ asset('backend/dist/js/custom.min.js') }}"></script>
    <!-- this page js -->
    <script src="{{asset ('backend/assets/extra-libs/multicheck/datatable-checkbox-init.js') }}"></script>
    <script src="{{asset ('backend/assets/extra-libs/multicheck/jquery.multicheck.js') }}"></script>
    <script src="{{asset ('backend/assets/extra-libs/DataTables/datatables.min.js') }}"></script>
    <script>
        // previewFoto
        function previewFoto() {
            const foto = document.querySelector('input[name="foto"]');
            const fotoPreview = document.querySelector('.foto-preview');
            fotoPreview.style.display = 'block';
            const fotoReader = new FileReader();
            fotoReader.readAsDataURL(foto.files[0]);
            fotoReader.onload = function(fotoEvent) {
                fotoPreview.src = fotoEvent.target.result;
                fotoPreview.style.width = '100%';
            }
        }
    </script>
    <script>
        function editItem() {
            alert('Edit item clicked!');
            // Tambahkan logika edit di sini
        }
    
        function changeStatus(status) {
            alert('Status changed to: ' + status);
            // Tambahkan logika perubahan status di sini
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const dropdownTrigger = document.querySelector('[data-bs-toggle="dropdown"]');
            if (dropdownTrigger) {
                dropdownTrigger.addEventListener('click', function () {
                    console.log('Dropdown clicked!');
                });
            }
        });
    </script>
   
    <script>
        function generatePassword(length = 8) {
            const charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+";
            let password = "";
            for (let i = 0; i < length; i++) {
                const randomIndex = Math.floor(Math.random() * charset.length);
                password += charset[randomIndex];
            }
            return password;
        }
    
        function setGeneratedPassword() {
            const passwordField = document.querySelector('input[name="password"]');
            passwordField.value = generatePassword(12);
        }
    
        document.addEventListener('DOMContentLoaded', function() {
            setGeneratedPassword(); // Generate password otomatis saat halaman dimuat
        });
    </script>
   <script>
    $('#addstockModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Tombol yang membuka modal
        var id = button.data('id'); // Ambil data-id
        var name = button.data('name'); // Ambil data-name

        // Set nilai input di modal
        $('#product_id').val(id);
        $('#product_name').val(name);

        // Atur URL action pada form
        $('#addStockForm').attr('action', '/product/addstock/' + id);
    });
</script>

    
</body>

</html>