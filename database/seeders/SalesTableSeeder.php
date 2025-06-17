<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sales; // Pastikan nama model sesuai dengan nama model yang digunakan

class SalesTableSeeder extends Seeder
{
    public function run()
    {
        Sales::create([
            'product_name' => 'Product A',
            'quantity' => 10,
            'amount' => 500.00,
            'sale_date' => '2025-01-01',
        ]);

        Sales::create([
            'product_name' => 'Product B',
            'quantity' => 5,
            'amount' => 300.00,
            'sale_date' => '2025-01-01',
        ]);

        // Tambah data lainnya sesuai kebutuhan
    }
}
