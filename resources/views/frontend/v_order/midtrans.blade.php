@extends('frontend.v_layout.app')

@section('content')
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>

<div class="container mt-5">
    <div class="text-center mb-4">
        <h3>Silakan Lanjutkan Pembayaran</h3>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card">
                <div class="card-body">

                    <h5 class="mb-3">Detail Pembayaran</h5>
                    <table class="table table-bordered">
                        <tr>
                            <th>Nama</th>
                            <td>{{ $nama ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $email ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>No. HP</th>
                            <td>{{ $no_hp ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Total Harga Produk</th>
                            <td>Rp {{ number_format(($total_harga ?? 0), 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Ongkir</th>
                            <td>Rp {{ number_format(($ongkir ?? 0), 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th><strong>Grand Total</strong></th>
                            <td><strong>Rp {{ number_format(($total_pembayaran?? 0), 0, ',', '.') }}</strong></td>
                        </tr>
                    </table>

                    <div class="text-center mt-4">
                        <button id="pay-button" class="btn btn-primary btn-lg">Bayar Sekarang</button>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<script type="text/javascript">
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function () {
      snap.pay('{{ $snapToken }}', {
    onSuccess: function(result){
        console.log('Success:', result);
        window.location.href = "/pembayaran/berhasil";
    },
    onPending: function(result){
        console.log('Pending:', result);
        alert("Menunggu pembayaran");
    },
    onError: function(result){
        console.error('Error:', result);
        alert("Pembayaran gagal: " + result.status_message);
    },
    onClose: function(){
        console.warn("User closed the payment popup.");
    }
});

    });
</script>
@endsection
