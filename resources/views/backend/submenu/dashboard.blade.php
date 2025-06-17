@extends('backend.layout.app')
@section('content')
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <!-- Chart-1 -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Penjualan Per Bulan</h5>
                    <canvas id="salesChart" width="400" height="200"></canvas>
                    <p>Waktu pembaruan:
                        <input id="updateInterval" type="text" value="" style="text-align: right; width:5em"> millisecond
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Data penjualan per bulan yang diambil dari database
   // Data penjualan per bulan yang diambil dari database
var salesData = @json($sales);
console.log(salesData);
var months = salesData.map(function(sales) {
    return sales.month; // Mengambil nama bulan
});

var totalSales = salesData.map(function(sales) {
    return sales.total_sales; // Mengambil total penjualan
});

// Membuat grafik menggunakan Chart.js
var ctx = document.getElementById('salesChart').getContext('2d');
var salesChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: months, // Labels bulan
        datasets: [{
            label: 'Total Penjualan',
            data: totalSales, // Data penjualan per bulan
            borderColor: 'rgba(75, 192, 192, 1)',
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            fill: true,
        }]
    },
    options: {
        scales: {
            x: {
                title: {
                    display: true,
                    text: 'Bulan'
                }
            },
            y: {
                title: {
                    display: true,
                    text: 'Total Penjualan (IDR)'
                },
                beginAtZero: true
            }
        }
    }
});

</script>

@endsection
