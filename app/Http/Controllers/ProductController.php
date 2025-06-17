<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\Merk;
use App\Models\FotoProduct;
use App\Helpers\ImageHelper; // Pastikan Anda memiliki ImageHelper yang sesuai
class ProductController extends Controller
{
    //
    public function index()
    {
        return view('backend.v_product.index', [
            'judul' => 'Data Product',
            'products' => Product::with('merk')->get(),
        ]);

    }
    public function detail_product($id)
{
    $fotoproduktambahan = FotoProduct::where('id_product', $id)->get();
    $product = Product::with('merk')->findOrFail($id);
    $detail = Product::findOrFail($id);
    return view('frontend.v_product.detail', [
        'judul' => 'Detail Product',
        'row' => $detail,
        'product' => $product,
        'fotoproduktambahan' => $fotoproduktambahan
        
    ]);
}

    public function create()
    {
             // Membuat kode produk otomatis
             $lastProduct = Product::orderBy('id', 'desc')->first();
             $nextNumber = $lastProduct ? intval(substr($lastProduct->product_code, 4)) + 1 : 1;
             $productcode = 'PRD-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
             $merks = Merk::all();
        return view('backend.v_product.create', [
            'judul' => 'Create Product',
            'productcode'=>$productcode,
            'merks' => $merks
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'product_code' => 'required',
            'product_name' => 'required',
            'product_type' => 'required|in:125 CC,150 CC',
            'product_price' => 'required',
            'product_stock' => 'required',
            'id_merk' => 'required|exists:merk,id_merk',
            'product_description'=> 'required',
            'foto' => 'image|mimes:jpeg,jpg,png,gif|max:2048',
            'weight' => 'required',   
        ]);
    
        $massage = [
            'foto.image' => 'Image must be jpeg, jpg, png, atau gif.',
            'foto.max' => 'Maximum image file size is 2048 KB.'
        ];
    
        $lastProduct = Product::orderBy('id', 'desc')->first();
        $nextNumber = $lastProduct ? intval(substr($lastProduct->product_code, 4)) + 1 : 1;
        $productcode = 'PRD-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
 
    

        // Menyimpan data produk
        $product = new Product();
        $product->user_id = auth()->user()->id;
        $product->product_code = $productcode;
        $product->product_name = $request->product_name;
        $product->product_price = $request->product_price;
        $product->product_stock = $request->product_stock;
        $product->product_type = $request->product_type;
        $product->product_description = $request->product_description;
          $product->id_merk = $request->id_merk;
        $product->weight = $request->weight;
        $product->status = $request->status ?? 0;

        $product->foto = isset($originalFileName) ? $originalFileName : null;
        // Upload foto
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $originalFileName = date('YmdHis') . '_' . uniqid() . '.' . $extension;
        
            // Tentukan path untuk menyimpan file di public/storage/img-user
            $destinationPath = public_path('storage/img-product');
        
            // Pastikan direktori ada
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
        
            // Pindahkan file ke direktori yang diinginkan
            $file->move($destinationPath, $originalFileName);
        
            // Simpan nama file di database
            $product->foto = $originalFileName;
        }
        $product->save();
        Log::info('Request Data: ', $request->all());

        return redirect('/product')->with('success', 'Product has been added');
    }
public function uploadFotoTambahan(Request $request, $id)
{
    $request->validate([
        'foto_tambahan.*' => 'image|mimes:jpeg,jpg,png,gif|max:2048',
    ]);

    $product = Product::findOrFail($id);

    if ($request->hasFile('foto_tambahan')) {
        foreach ($request->file('foto_tambahan') as $file) {
            $extension = $file->getClientOriginalExtension();
            $fileName = date('YmdHis') . '_' . uniqid() . '.' . $extension;

            // Pindahkan file
            $file->move(public_path('storage/img-product'), $fileName);

            // Simpan ke DB
            FotoProduct::create([
                'id_product' => $product->id,
                'foto' => $fileName,
            ]);
        }
    }

    return redirect()->back()->with('success', 'Foto tambahan berhasil diupload.');
}

    

// app/Http/Controllers/ProductController.php
public function addstock(Request $request, $id)
{
    $Product = Product::findOrFail($id);
   return view('backend.v_product.addstock', [
       'judul' => 'Add Stock',
       'Product' => $Product


   ]);
}
public function updatestock(Request $request, $id)
    {
        // Validasi input stok
        $request->validate([
            'product_stock' => 'required|numeric|min:1', // Validasi stok yang ditambahkan
        ]);

        $Product = Product::findOrFail($id);

        // Tambahkan stok yang ada dengan stok baru
        $Product->product_stock += $request->product_stock;

        $Product->save();

        return redirect('/product')->with('success', 'Product stock has been updated');
    }



    // EDIT PRODUCT
    public function edit($id)
{
    // Ambil data produk berdasarkan ID
    $product = Product::findOrFail($id);
      $merks = Merk::all();

    // Kirim data ke tampilan untuk di-edit
    return view('backend.v_product.edit', [
        'judul' => 'Edit Product',
        'product' => $product,
        'merks' => $merks
    ]);
}

public function update(Request $request, $id)
{
   

    $product = Product::findOrFail($id);
    $merks = Merk::all();
    $fotolama = $product->foto;

    if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $extension = $file->getClientOriginalExtension();
        $originalFileName = date('YmdHis') . '_' . uniqid() . '.' . $extension;

        $file->storeAs('public/img-product', $originalFileName);


        if ($fotolama && Storage::exists('public/img-product/' . $fotolama)) {
            Storage::delete('public/img-product/' . $fotolama);
        }
    } else {
        $originalFileName = $fotolama;
    }
        
    $product->foto = $originalFileName;
        // update data product
        $product->product_name = $request->product_name;
        $product->product_price = $request->product_price;
        $product->product_type = $request->product_type;
        $product->product_description = $request->product_description;
        $product->id_merk = $request->id_merk;
        $product->weight = $request->weight;
        $product->status = $request->status ?? 0;

        //simpan ke database
    $product->save();

    return redirect('/product')->with('success', 'Product has been updated');
}
 public function addfototambahan($id)

{
    $product = Product::findOrFail($id);
    $fotoTambahan = FotoProduct::where('id_product', $id)->get();

    return view('backend.v_product.add_foto', [
        'judul' => 'Add Foto Tambahan',
        'product' => $product,
        'fotoTambahan' => $fotoTambahan
    ]);
}
// fungsi untuk menyimpan foto produk tambahan
 public function storeFoto(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_product' => 'required|exists:products,id',
            'foto.*' => 'image|mimes:jpeg,jpg,png,gif|file|max:1024',
        ]);

        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $file) {
                // Buat nama file yang unik
                $extension = $file->getClientOriginalExtension();
                $filename = date('YmdHis') . '_' . uniqid() . '.' . $extension;
                $directory = 'storage/img-product/';
                // Simpan dan resize gambar menggunakan ImageHelper
                ImageHelper::uploadAndResize($file, $directory, $filename, 800, null);
                // Simpan data ke database
                FotoProduct::create([
                    'id_product' => $request->id_product,
                    'foto' => $filename,
                ]);
            }
          

        }
        
        return redirect()->route('product.index', $request->product_id)
            ->with('success', 'Foto berhasil ditambahkan.');
    }
    }


