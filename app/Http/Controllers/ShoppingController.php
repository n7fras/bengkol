<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Merk; // Pastikan model Merk sudah ada
use Illuminate\Support\Facades\Auth;
class ShoppingController extends Controller
{
    //
  public function index($id = null)
{
    $query = Product::where('status', 1);

    if ($id) {
        $query->where('id_merk', $id);
    }

    $produk = $query->orderBy('updated_at', 'desc')->paginate(6);

    return view('frontend.V_Shop.index', [
        'judul' => 'Halaman Belanja',
        'produk' => $produk,
    ]);
}
}