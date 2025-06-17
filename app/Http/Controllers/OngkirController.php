<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class OngkirController extends Controller
{
    //
      public function getLocation(Request $request)
    {
        $keyword = $request->input('keyword');
    
        $response = Http::withHeaders([
            'x-api-key' => config('ONGKIR_API_KEY'), // Pastikan Anda telah mengatur API key di file .env
            'Accept' => 'application/json',
          
        ])->get(config('ongkir.search_url'), [
            'keyword' => $keyword
        ]);
    
        Log::info('Location API Response', $response->json()); // Tambahkan log
  

        return response()->json($response->json());

    }
    

    // Hitung ongkir
    public function getCost(Request $request)
    {
        $origin = $request->input('origin');
        $destination = $request->input('destination');
        $weight = $request->input('weight');
        $courier = $request->input('courier');
      
    
        try {
            $response = Http::withHeaders([
                'key' => config('ongkir.key'), 
                'Accept' => 'application/json'
            ])
            -> asForm()
            ->post('https://rajaongkir.komerce.id/api/v1/calculate/domestic-cost', [
                'origin' => $origin,
                'destination' => $destination,
                'weight' => $weight,
                'courier' => $courier,
                
            ]);
    
            // Mengecek apakah respons berhasil
            if ($response->successful()) {
                $responseData = $response->json();
                Log::info('Respons API:', $responseData);
                return response()->json($responseData);
            } else {
                Log::error('Permintaan API gagal', ['response' => $response->body()]);
                return response()->json(['error' => 'Gagal menghitung biaya pengiriman'], 500);
            }
        } catch (\Exception $e) {
            Log::error('Exception Permintaan API', ['message' => $e->getMessage()]);
            return response()->json(['error' => 'Terjadi kesalahan saat mengambil biaya pengiriman'], 500);
        }
    }
     public function pilihPengiriman(Request $request)
    {
        // Validasi input
        $request->validate([
            'service' => 'required|string',
            'cost' => 'required|numeric',
            'etd' => 'required|string',
            'courier' => 'required|string',
            'weight' => 'required|numeric',
        ]);

        // Simpan data pilihan pengiriman di session (atau bisa simpan ke DB)
       $pilihan = [
    'service' => $request->service,
    'cost' => $request->cost,
    'etd' => $request->etd,
    'courier' => $request->courier,
    'weight' => $request->weight,
];


        Session::put('pilihan_pengiriman', $pilihan);

        return response()->json([
            'message' => 'Pilihan pengiriman berhasil disimpan',
            'data' => $pilihan,
        ]);
    }
    // app/Http/Controllers/PengirimanController.php

public function form(Request $request)
{
    $totalPrice = $request->input('total_price');
    $totalWeight = $request->input('total_weight');

    return view('frontend.v_order.shipping',compact('totalPrice','totalWeight') 
    );
}

}
