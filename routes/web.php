<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\InternalUserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MechanicController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\MerkController;
use App\Http\Controllers\OngkirController;
use App\Http\Controllers\ShoppingController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Auth\RegisterController;
/*
|-------------------------------------------------------------------------- 
| Web Routes 
|-------------------------------------------------------------------------- 
| 
| Here is where you can register web routes for your application. These 
| routes are loaded by the RouteServiceProvider and all of them will 
| be assigned to the "web" middleware group. Make something great! 
|
*/

// Authentication Routes
Route::get('/login_mobas', [LoginController::class, 'login'])->name('login'); 
Route::post('/login', [LoginController::class, 'authLogin'])->name('authLogin');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
// Change Password Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/change-password', [InternalUserController::class, 'changePasswordForm'])->name('change-password.form');
    Route::post('/change-password', [InternalUserController::class, 'updatePassword'])->name('change-password.update');
});



Route::get('/merk', [MerkController::class, 'index'])->name('merk.index');
Route::get('/merk/create', [MerkController::class, 'create'])->name('merk.create');
Route::post('/merk', [MerkController::class, 'store'])->name('merk.store');

//frontend

// Frontend 
Route::get('/', [BerandaController::class, 'index'])->name('beranda'); 

Route::get('frontend/product/detail/{id}', [ProductController::class, 'detail_product'])->name('product.detail_product');


// Middleware Group for Authenticated Users
Route::middleware(['auth', 'check.status'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Internal User Routes
    Route::get('/internal_user', [InternalUserController::class, 'index'])->name('internal_user.index');
    Route::get('/internal_user/create', [InternalUserController::class, 'create'])->name('internal_user.create');
    Route::post('/internal_user/post', [InternalUserController::class, 'store'])->name('internal_user.store');
    Route::delete('/internal_user/delete/{id}', [InternalUserController::class, 'destroy'])->name('internal_user.delete');
    Route::post('/internal_user/update/{id}', [InternalUserController::class, 'update'])->name('internal_user.update');
    Route::get('/internal_user/edit/{id}', [InternalUserController::class, 'edit'])->name('internal_user.edit');
    Route::get('/internal_user/deactivate/{id}', [InternalUserController::class, 'deactivate'])->name('internal_user.deactivate');
    Route::get('/internal_user/reactivate/{id}', [InternalUserController::class, 'reactivate'])->name('internal_user.reactivate');
    // Product Routes
    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::get('/product/addstock/{id}', [ProductController::class, 'addstock'])->name('product.addstock');
    Route::put('/product/updatestock/{id}', [ProductController::class, 'updatestock'])->name('product.updatestock');
    Route::get('/product/detail/{id}', [ProductController::class, 'detail'])->name('product.detail');
    Route::get('/product/{id}/foto-tambahan', [ProductController::class, 'addfototambahan'])->name('product.uploadFotoTambahan');
    Route::post('/product/foto-tambahan', [ProductController::class, 'storeFoto'])->name('product.storeFotoTambahan');

});

// Internal User Operations
Route::post('/internal_user/post', [InternalUserController::class, 'store'])->name('internal_user.store');
Route::post('/internal_user/{id}/deactivate', [InternalUserController::class, 'deactivate'])->name('internal_user.deactivate');
Route::post('/internal_user/{id}/reactivate', [InternalUserController::class, 'reactivate'])->name('internal_user.reactivate');
Route::get('/internal_user/search', [InternalUserController::class, 'search'])->name('internal_user.search');


// customer
#login customer
Route::get('/login', [CustomerController::class, 'login'])->name('customer.login');
route::get('/customer',[CustomerController::class,'index'])->name('customer.data');
route::get('/customer/activity_log',[CustomerController::class,'log'])->name('customer.log_activity');
Route::get('/customer/logout', [CustomerController::class, 'logout'])->name('customer.logout');
Route::post('/customer/login', [CustomerController::class, 'authLoginManual'])->name('customer.auth');
Route::get('/register', function () {
    return view('frontend.V_customer.register');
})->name('register');

Route::post('/register', [RegisterController::class, 'register'])->name('register.customer');
//route untuk menambah produk ke keranjang
Route::post ('/addtocart/{id}', [OrderController::class, 'addtocart'])->name('addtocart');
//route untuk melihat keranjang
Route::get('/viewcart', [OrderController::class, 'viewcart'])->name('viewcart')->middleware('auth:customer');
 Route::post('/cart/update/{id}', [OrderController::class, 'updateCart'])->name('cart.update');
  Route::delete('/cart/remove/{id}', [OrderController::class, 'removeFromCart'])->name('cart.remove');

//shopping
Route::get('/shopping/{id?}', [ShoppingController::class, 'index'])->name('shopping');
Route::post('/pilih-pengiriman', function (Request $request) {
    session([
        'shipping' => [
            'courier' => $request->input('courier'),
            'service' => $request->input('service'),
            'cost' => $request->input('cost'),
            'etd' => $request->input('etd'),
        ]
    ]);

    return response()->json(['success' => true, 'message' => 'Pilihan pengiriman berhasil disimpan']);
});
Route::post('/checkout', [CheckoutController::class, 'prosesPembayaran'])->name('checkout.midtrans')->middleware('auth:customer');


// mechanic
route::get('/mechanic',[MechanicController::class,'index'])->name('mechanic.data');
route::get('/mechanic/activity_log',[MechanicController::class,'log'])->name('mechanic.log_activity');


//Api google
Route::get('/auth/google/redirect', [CustomerController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [CustomerController::class, 'handle_google_callback'])->name('google.callback');
//test
Route::get('/cek-ongkir', function () { 
    return view('test'); 
}); 
Route::get('/location', [OngkirController::class, 'getLocation']);
Route::post('/cost', [OngkirController::class, 'getCost'])->name('ongkir.getCost');
route::post('/form', [OngkirController::class, 'form'])->name('ongkir.form');

