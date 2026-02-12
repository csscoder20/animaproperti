<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Kwitansi Sewa</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            color: #333;
        }

        .header {
            border-bottom: 2px solid #0093dd;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .header table {
            width: 100%;
        }

        .header-info {
            text-align: right;
        }

        .header-logo {
            text-align: left;
        }

        .title {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
            text-decoration: underline;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .info-table th,
        .info-table td {
            padding: 5px;
            text-align: left;
            vertical-align: top;
        }

        .info-table th {
            width: 150px;
            font-weight: bold;
        }

        .details-table th,
        .details-table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .details-table th {
            background-color: #f2f2f2;
        }

        .text-right {
            text-align: right;
        }

        .footer {
            margin-top: 50px;
        }

        .footer table {
            width: 100%;
        }

        .signature {
            text-align: center;
            width: 200px;
        }

        .amount-box {
            border: 2px solid #0093dd;
            padding: 10px;
            display: inline-block;
            font-size: 14px;
            font-weight: bold;
            background-color: #e6f7ff;
        }
    </style>
</head>

<body>
    <div class="header">
        <table>
            <tr>
                <td class="header-logo">
                    <img src="{{ public_path($settings['logo_path'] ?? 'themes/frontend/assets/img/android-chrome-512x512.png') }}"
                        alt="Logo" height="50">
                    <p style="margin: 5px 0 0 0;">
                        {{ $settings['site_name'] ?? 'ANIMA PROPERTI' }}<br>
                        {{ $settings['address'] ?? 'Ruko Saphire No. 49 Jl. Mutiara Boulevard Bulurokeng - Makassar' }}
                    </p>
                </td>
                <td class="header-info">
                    <p>
                        No. Transaksi: <strong>SW/{{ date('Ymd', strtotime($penyewaan->tanggal_transaksi)) }}/{{ strtoupper(substr($penyewaan->id, 0, 4)) }}</strong><br>
                        Tanggal: <strong>{{ \Carbon\Carbon::parse($penyewaan->tanggal_transaksi)->translatedFormat('d F Y') }}</strong>
                    </p>
                </td>
            </tr>
        </table>
    </div>

    <div class="title">KWITANSI SEWA KOST/KONTRAKAN</div>

    <table class="info-table">
        <tr>
            <th>Sudah Terima Dari</th>
            <td>: {{ $penyewaan->pelanggan->nama }}</td>
        </tr>
        <tr>
            <th>Untuk Pembayaran</th>
            <td>: {{ $penyewaan->nama_penyewaan ?? 'Sewa Properti' }}</td>
        </tr>
        <tr>
            <th>Properti</th>
            <td>: {{ $penyewaan->properti->judul }}</td>
        </tr>
        <tr>
            <th>Alamat Properti</th>
            <td>: {{ $penyewaan->properti->alamat_lengkap }}</td>
        </tr>
    </table>

    <table class="details-table">
        <thead>
            <tr>
                <th>Deskripsi</th>
                <th>Lama Sewa</th>
                <th class="text-right">Total Biaya</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $penyewaan->nama_penyewaan ?? 'Sewa Properti' }}</td>
                <td>{{ $penyewaan->lama_sewa }}</td>
                <td class="text-right">Rp {{ number_format($penyewaan->harga_total, 0, ',', '.') }}</td>
            </tr>
        </tbody>
        <tfoot>
            @if($penyewaan->status_pembayaran === 'DP')
                <tr>
                    <th colspan="2" class="text-right">Nilai DP</th>
                    <th class="text-right">Rp {{ number_format($penyewaan->nilai_dp, 0, ',', '.') }}</th>
                </tr>
                <tr>
                    <th colspan="2" class="text-right">Sisa Pembayaran</th>
                    <th class="text-right">Rp
                        {{ number_format($penyewaan->harga_total - $penyewaan->nilai_dp, 0, ',', '.') }}</th>
                </tr>
            @else
                <tr>
                    <th colspan="2" class="text-right">Jumlah Dibayar (Lunas)</th>
                    <th class="text-right">Rp {{ number_format($penyewaan->pembayaran, 0, ',', '.') }}</th>
                </tr>
            @endif
        </tfoot>
    </table>

    <div class="amount-box">
        TERBILANG: Rp {{ number_format($penyewaan->status_pembayaran === 'DP' ? $penyewaan->nilai_dp : $penyewaan->pembayaran, 0, ',', '.') }} 
        <br>
        ( # {{ ucwords(\App\Helpers\NumberHelper::terbilang($penyewaan->status_pembayaran === 'DP' ? $penyewaan->nilai_dp : $penyewaan->pembayaran)) }} Rupiah # )
    </div>

    @if($penyewaan->catatan)
        <div style="margin-top: 20px;">
            <strong>Catatan:</strong><br>
            {{ $penyewaan->catatan }}
        </div>
    @endif

    <div class="footer">
        <table>
            <tr>
                <td>
                    <p>Catatan:<br>
                        - Kwitansi ini adalah bukti pembayaran yang sah.<br>
                        - Harap simpan kwitansi ini sebagai referensi.</p>
                </td>
                <td class="signature">
                    <p>Makassar, {{ \Carbon\Carbon::parse($penyewaan->tanggal_transaksi)->translatedFormat('d F Y') }}</p>
                    <br><br><br>
                    <p><strong>( ____________________ )</strong><br>
                        {{ $settings['site_name'] ?? 'ANIMA PROPERTI' }}</p>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>