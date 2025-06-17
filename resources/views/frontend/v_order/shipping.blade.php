@extends('frontend.v_layout.app')

@section('content')
<div class="container" style="max-width: 700px; margin: 20px auto;">
    <h2>Pilih Pengiriman</h2>

    <form id="ongkirForm">
        @csrf

        <label for="destination">Lokasi Tujuan:</label><br>
        <select id="destination" placeholder="Ketik kota atau provinsi..."></select><br>
        <label for="alamat">Alamat Lengkap:</label><br>
        <textarea id="alamat"  class= "form-control"placeholder="Ketik Alamat Lengkap"></textarea><br>

        <label for="weight">Berat (gram):</label><br>
        <input type="number" id="weight" name="weight" value="{{ $totalWeight }}" readonly><br><br>

        <label for="courier">Kurir:</label><br>
        <select id="courier" name="courier" required>
            <option value="">Pilih Kurir</option>
            <option value="jne">JNE</option>
            <option value="tiki">TIKI</option>
            <option value="pos">POS Indonesia</option>
            <option value="jnt">J&T</option>
            <option value="sicepat">SiCepat</option>
        </select><br><br>

        <input type="hidden" id="totalPrice" value="{{ $totalPrice }}">

        <button type="submit" class="btn btn-primary">CEK ONGKIR</button>
    </form>

    <div id="result" style="margin-top: 20px;"></div>
</div>

<!-- Tom Select CSS -->
<link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet" />
<!-- Tom Select JS -->
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const destinationSelect = document.getElementById('destination');
    const resultDiv = document.getElementById('result');

    // Initialize Tom Select for destination
    new TomSelect(destinationSelect, {
        valueField: 'id',
        labelField: 'label',
        searchField: ['label'],
        load: function(query, callback) {
            if (query.length < 3) return callback();
            fetch(`/location?keyword=${encodeURIComponent(query)}`)
                .then(res => res.json())
                .then(data => {
                    if (data.meta?.code === 200 && Array.isArray(data.data)) {
                        callback(data.data);
                    } else {
                        callback();
                    }
                })
                .catch(() => callback());
        }
    });

    // Handle form submit cek ongkir
    document.getElementById('ongkirForm').addEventListener('submit', function (e) {
        e.preventDefault();

        const origin = 457; // Asal pengiriman, bisa dinamis kalau mau
        const destination = destinationSelect.value;
        const weight = document.getElementById('weight').value;
        const courier = document.getElementById('courier').value;
        const totalPrice = parseInt(document.getElementById('totalPrice').value);

        if (!destination || !weight || !courier) {
            alert('Pastikan semua kolom terisi dengan benar!');
            return;
        }

        fetch('/cost', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify({ origin, destination, weight, courier,weight }),
        })
        .then(res => res.json())
        .then(data => {
            resultDiv.innerHTML = '';

            if (data.meta?.code === 200 && Array.isArray(data.data)) {
                let tableHTML = `
                    <table class="table table-bordered" style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr>
                                <th>LAYANAN</th>
                                <th>BIAYA</th>
                                <th>ESTIMASI PENGIRIMAN</th>
                                <th>TOTAL BERAT</th>
                              
                                
                            </tr>
                        </thead>
                        <tbody>
                `;
data.data.forEach(service => {
    // Filter layanan JTR jika berat kurang dari 10.000 gram
    if (weight < 10000 && service.service.toLowerCase().includes('jtr')) {
        return; // skip tampilkan JTR
    }

    tableHTML += `
        <tr>
            <td>${service.service}</td>
            <td>${parseInt(service.cost).toLocaleString('id-ID')} Rupiah</td>
            <td>${service.etd} hari</td>
            <td>${weight} Gram</td>
            
            <td><button class="btn btn-success pilih-pengiriman-btn">PILIH PENGIRIMAN</button></td>
        </tr>
    `;
});


                tableHTML += '</tbody></table>';

                resultDiv.innerHTML = tableHTML;
            } else {
                resultDiv.innerHTML = '<p>Gagal mendapatkan biaya pengiriman.</p>';
            }
        })
        .catch(() => {
            resultDiv.innerHTML = '<p>Terjadi kesalahan saat mengambil data ongkir.</p>';
        });
    });

    // Event delegation tombol PILIH PENGIRIMAN
    resultDiv.addEventListener('click', function(e) {
        if (e.target.classList.contains('pilih-pengiriman-btn')) {
            e.preventDefault();
            const row = e.target.closest('tr');
            const service = row.children[0].textContent.trim();
            const costText = row.children[1].textContent.trim();
            const cost = parseInt(costText.replace(/\D/g, ''));
            const etdText = row.children[2].textContent.trim();
            const etd = etdText.replace(' hari', '');
            const courier = document.getElementById('courier').value;

            fetch('/pilih-pengiriman', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({ service, cost, etd, courier }),
            })
            .then(res => res.json())
            .then(data => {
                alert(data.message || 'Pilihan pengiriman berhasil disimpan!');
                // Bisa redirect ke halaman checkout atau update UI
                // Contoh redirect:
                 window.location.href = '/viewcart';
            })
            .catch(() => alert('Gagal menyimpan pilihan pengiriman.'));
        }
    });
});
</script>

<style>
.btn {
    padding: 6px 12px;
    background-color: #f15a29;
    color: white;
    border: none;
    cursor: pointer;
    border-radius: 4px;
}

.btn:hover {
    background-color: #d94e20;
}

.btn-primary {
    background-color: #007bff;
}

.btn-primary:hover {
    background-color: #0069d9;
}

.btn-success {
    background-color: #28a745;
}

.btn-success:hover {
    background-color: #218838;
}

table th, table td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: center;
}

table {
    border-collapse: collapse;
    width: 100%;
}
</style>

@endsection
