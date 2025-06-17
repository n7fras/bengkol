<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Merk;
use Midtrans\Snap;
use Midtrans\Config;

class CheckoutController extends Controller
{
    public function index()
    {
        $customer = auth('customer')->user();
        if (!$customer) {
            return redirect()->route('customer.login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $order = Order::with('orderItems.product')
            ->where('id_customer', $customer->id)
            ->where('status', 'pending')
            ->first();

        if (!$order || $order->orderItems->isEmpty()) {
            return redirect()->route('viewcart')->with('error', 'Keranjang belanja kosong.');
        }

        return view('frontend.checkout', [
            'judul' => 'Checkout',
            'order' => $order,
            'shipping' => session('shipping'),
            'customer' => $customer
        ]);
    }

    public function proses(Request $request)
    {
        $customer = auth('customer')->user();
        if (!$customer) {
            return redirect()->route('customer.login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $request->validate([
            'alamat' => 'required|string|max:255',
            'courier' => 'required|string',
            'service' => 'required|string',
            'cost' => 'required|numeric',
        ]);

        DB::beginTransaction();

        try {
            $order = Order::where('id_customer', $customer->id)
                ->where('status', 'pending')
                ->first();

            if (!$order) {
                return redirect()->route('viewcart')->with('error', 'Keranjang tidak ditemukan.');
            }

            $shipping = [
                'weight'=>$request->weight,
                'courier' => $request->courier,
                'service' => $request->service,
                'cost' => $request->cost,
                'etd' => $request->etd ?? '-',
            ];

            // Simpan detail pengiriman dan ubah status order
            $order->status = 'confirmed';
            $order->alamat = $request->alamat;
            $order->shipping_detail = json_encode($shipping);
            $order->total_price += $request->cost;
            $order->save();

            DB::commit();
            session()->forget('shipping');

            return redirect()->route('beranda')->with('success', 'Checkout berhasil! Pesanan Anda sedang diproses.');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Checkout Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memproses pesanan.');
        }
    }
    public function prosesPembayaran(Request $request)
{
     $order = Order::create([
        'id_customer' => auth()->guard('customer')->id(),
        'status' => 'pending',
        'courier' => session('shipping')['courier'],
        'delivery_service' => session('shipping')['service'],
        'shipping_cost' => $request->ongkir,
       'weight_total' => $request->weight,

        'total_price' => $request->total_harga,
        'grand_total' => $request->grand_total,
        'shipping_address' => auth()->user()->address ?? 'Alamat kosong',
        'post_code' => auth()->user()->postal_code ?? '00000',
    ]);
    // Konfigurasi Midtrans
    Config::$serverKey = env('MIDTRANS_SERVER_KEY');
    Config::$isProduction = false; // Ganti true saat live
    Config::$isSanitized = true;
    Config::$is3ds = true;

     $customer = auth('customer')->user();
    // Simpan order ID dan grand total
    $orderId = 'ORDER-' . uniqid();
   $grossAmount = (int) str_replace(['Rp', '.', ','], '', $request->grand_total);


    // Parameter transaksi
    $params = [
        'transaction_details' => [
            'order_id' => $orderId,
            'gross_amount' => $grossAmount,
        ],
        'customer_details' => [
            'first_name' => $customer->name,
            'email' => $customer->email,
            'phone' => $customer->phone,
        ]
    ];

    // Buat Snap Token
    $snapToken = Snap::getSnapToken($params);


    // Redirect ke halaman pembayaran
       return view('frontend.v_order.midtrans', [
        'snapToken' => $snapToken,
        'orderId' => $orderId,
        'grandTotal' => $grossAmount,
        'nama' => $customer->name,
        'email' => $customer->email,
        'no_hp' => $customer->phone,
        'total_harga' => $request->total_harga,
        'ongkir' => $request->ongkir,
        'total_pembayaran' => $request->grand_total,
    ]);
}
}
