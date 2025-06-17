<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil data penjualan per bulan
        $sales = Sales::selectRaw('MONTH(sale_date) as month, SUM(amount) as total_sales')
            ->groupBy('month')
            ->orderBy('month')
            ->get();
    
        // Mengubah bulan menjadi nama bulan
        $sales = $sales->map(function($sale) {
            $sale->month = \Carbon\Carbon::createFromFormat('m', $sale->month)->format('F');
            return $sale;
        })->toArray(); // Mengubah koleksi menjadi array
   
        return view('backend.submenu.dashboard', compact('sales'));
    }
    

}

