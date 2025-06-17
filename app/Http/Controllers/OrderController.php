<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;        
use Illuminate\Support\Facades\auth;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Merk;
class OrderController extends Controller
{
    //
    public function addtocart($id)
    {
      $customer = auth('customer')->user();
  \Log::info('Customer Data:', [$customer]);
    \Log::info('Product ID:', [$id]);
        $product = Product::findOrFail($id);
        $order=Order::firstOrCreate(
            ['id_customer' => $customer->id,'status'=>'pending'],
            ['total_price' => 0]
        );

        $orderItem = OrderItem::firstOrCreate(
            ['id_order' => $order->id, 'id_product' => $product->id],
            ['quantity' => 1, 'price' => $product->product_price]
        );
        if(!$orderItem->wasRecentlyCreated) {
            $orderItem->quantity++; // Increment quantity if item already exists
            $orderItem->save();
        }
        $order->total_price += $product->product_price; // Update total price
        $order->save();
        return redirect()->route('viewcart')->with('success', 'Product added to cart successfully!');
    }
public function viewcart()
{
    $customer = auth('customer')->user();
    \Log::info('Customer Data:', [$customer]);

    $order = Order::firstOrCreate(
        ['id_customer' => $customer->id, 'status' => 'pending'],
        ['total_price' => 0]
    );

    $order->load(['orderItems.product']);

    return view('frontend.v_order.cart', [
        'judul' => 'View Cart',
        'order' => $order,
    ]);
}



   public function updateCart($item_id)
{
    $orderItem = OrderItem::findOrFail($item_id);

    // Autentikasi customer yang sedang login
    $customer = auth('customer')->user();
    if (!$customer) {
        return redirect()->back()->with('error', 'Silakan login terlebih dahulu.');
    }

    // Pastikan item milik customer tersebut
    $order = $orderItem->order;
    if (!$order || $order->id_customer !== $customer->id) {
        return redirect()->back()->with('error', 'Akses ditolak.');
    }

    // Validasi input jumlah
    $quantity = request('quantity');
    if (!is_numeric($quantity) || $quantity < 1) {
        return redirect()->back()->with('error', 'Jumlah tidak valid.');
    }

    // Update quantity dan harga item
    $product = $orderItem->product;
    $orderItem->quantity = $quantity;
    $orderItem->price = $product->product_price ;
    $orderItem->save();

    // Update total harga order
    $order->total_price = $order->orderItems->sum(function ($item) {
        return $item->price;
    });
    $order->save();

    return redirect()->back()->with('success', 'Keranjang berhasil diperbarui.');
}
public function removeFromCart($item_id)
{
    $orderItem = OrderItem::findOrFail($item_id);

    // Pastikan customer login
    $customer = auth('customer')->user();
    if (!$customer) {
        return redirect()->back()->with('error', 'Silakan login terlebih dahulu.');
    }

    // Pastikan item milik customer yang sedang login
    $order = $orderItem->order;
    if (!$order || $order->id_customer !== $customer->id) {
        return redirect()->back()->with('error', 'Akses ditolak.');
    }

    // Hapus item dari keranjang
    $orderItem->delete();

    // Update total harga order setelah penghapusan
    $order->total_price = $order->orderItems->sum(fn($item) => $item->price);
    if ($order->total_price < 0) {
        $order->total_price = 0;
    }

    // Jika tidak ada item tersisa, hapus session shipping
    if ($order->orderItems()->count() === 0) {
        session()->forget('shipping');
    }

    $order->save();

    return redirect()->back()->with('success', 'Item berhasil dihapus dari keranjang.');
}
}



