<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Invoice</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        @media print {

            table thead {
                border: 0;
            }
        }

        .header {
            display: flex;
            justify-content: space-between;
        }

        .bold {
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 8px;
            border: 1px solid #000;
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        .header {
            display: flex;
        }

        table {
            border: none;
        }
    </style>
</head>

<body>
    <div class="header">
        <table class="borderles">
            <thead>
                <tr>
                    <th>
                        <img src="{{ public_path($settings['logo_path'] ?? 'themes/frontend/assets/img/android-chrome-512x512.png') }}"
                            alt="Logo" height="50">
                        <p>
                            {{ $settings['address'] ?? 'Ruko Saphire No. 49 Jl. Mutiara Boulevard Bulurokeng - Makassar' }}<br>
                            Phone: {{ $settings['phone'] ?? '+62 811-4617-733' }}<br>
                            Email: {{ $settings['email'] ?? 'mayakesuma558@gmail.com' }}
                        </p>
                    </th>
                    <th>
                        <h2>INVOICE</h2>
                        <p>
                            Invoice No: INV-PJ25/00{{ $penjualan->id }}<br>
                            Date: {{ \Carbon\Carbon::parse($penjualan->tanggal_penjualan)->format('d F, Y') }}
                        </p>
                    </th>
                </tr>
            </thead>
        </table>
    </div>


    <div class="alamatInv">
        <table class="borderles">
            <thead>
                <tr>
                    <th>
                        <p><strong>Alamat Penagihan:</strong><br>
                            {{ $penjualan->pelanggan->nama }}<br>
                            {{ $penjualan->pelanggan->alamat ?? '-' }}
                        </p>
                    </th>
                    <th>
                        <p><strong>Alamat Properti:</strong><br>
                            {{ $penjualan->properti->judul }}<br>
                            {{ $penjualan->properti->alamat }}<br>
                            Kelurahan: {{ $kelurahan ?? '-' }}<br>
                            Kecamatan: {{ $kecamatan ?? '-' }}<br>
                            Kabupaten/Kota: {{ $kabupaten ?? '-' }}<br>
                            Provinsi: {{ $provinsi ?? '-' }}<br>
                            Kode Pos: {{ $penjualan->kode_pos ?? '-' }}
                        </p>

                    </th>
                </tr>
            </thead>
        </table>
    </div>

    <table>
        <thead>
            <tr>
                <th>JUMLAH</th>
                <th>DESKRIPSI</th>
                <th>HARGA</th>
                <th>KOMISI</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1 UNIT</td>
                <td>
                    Pembayaran fee 1 Unit {{ $penjualan->properti->judul }}<br><br>
                    Tanggal Booking: 17-09-2020<br>
                    Tanggal DP 20%: 25-09-2020<br>
                    Tanggal Pelunasan: 28-09-2020<br><br>
                    Pembayaran Fee Rp. {{ number_format($penjualan->harga_jual, 0, ',', '.') }} x 3%
                </td>
                <td class="text-right">{{ number_format($penjualan->harga_jual, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($penjualan->harga_jual * 0.03, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="3" class="text-right"><strong>SUBTOTAL</strong></td>
                <td class="text-right">{{ number_format($penjualan->harga_jual * 0.03, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="3" class="text-right"><strong>TOTAL</strong></td>
                <td class="text-right">{{ number_format($penjualan->harga_jual * 0.03, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <p style="margin-top: 30px;">
        Pembayaran closing fee ditransfer ke rekening berikut:<br>
        <strong>Bank BCA Atas Nama ANITA MAYA KESUMA</strong><br>
        <strong>No Rek: 6871122625</strong>
    </p>

    <p style="margin-top: 50px;">
        Hormat Kami,<br>
        (TTD)<br><br><br>
        {{ $settings['site_name'] ?? 'ANIMA PROPERTI' }}
    </p>
</body>

</html>
