<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice Booking #{{ $booking->id }}</title>
    <style>
        body { font-family: 'Inter', 'Helvetica', 'Arial', sans-serif; font-size: 12px; line-height: 1.5; color: #333; }
        .container { width: 100%; margin: 0 auto; }
        .header { border-bottom: 2px solid #444; padding-bottom: 10px; margin-bottom: 20px; }
        .header table { width: 100%; }
        .logo { height: 60px; }
        .invoice-title { font-size: 24px; font-weight: bold; color: #444; text-align: right; margin: 0; }
        .info-table { width: 100%; margin-bottom: 20px; }
        .info-table td { vertical-align: top; width: 50%; }
        .section-title { font-weight: bold; font-size: 14px; border-bottom: 1px solid #ddd; padding-bottom: 5px; margin-bottom: 10px; color: #555; }
        .details-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .details-table th { background: #f8f8f8; border: 1px solid #ddd; padding: 8px; text-align: left; }
        .details-table td { border: 1px solid #ddd; padding: 8px; }
        .total-section { text-align: right; }
        .total-amount { font-size: 18px; font-weight: bold; color: #2c3e50; }
        .footer { margin-top: 50px; font-size: 10px; color: #777; border-top: 1px solid #eee; padding-top: 10px; }
        .sig-section { margin-top: 40px; }
        .sig-box { width: 200px; text-align: center; float: right; }
        .clear { clear: both; }
        .text-right { text-align: right; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <table>
                <tr>
                    <td>
                        <img src="{{ public_path($settings['logo_path'] ?? 'storage/logos/logo.png') }}" class="logo">
                        <div style="margin-top: 5px;">
                            <strong>{{ $settings['site_name'] ?? 'Anima Properti' }}</strong><br>
                            {{ $settings['address'] ?? 'Alamat Properti Anda' }}<br>
                            Phone: {{ $settings['phone'] ?? '-' }} | Email: {{ $settings['email'] ?? '-' }}
                        </div>
                    </td>
                    <td class="text-right">
                        <h1 class="invoice-title">INVOICE SEWA</h1>
                        <div>No: #{{ strtoupper(substr($booking->id, 0, 8)) }}</div>
                        <div>Tanggal: {{ date('d/m/Y') }}</div>
                    </td>
                </tr>
            </table>
        </div>

        <table class="info-table">
            <tr>
                <td>
                    <div class="section-title">Informasi Penyewa</div>
                    <strong>{{ $booking->customer_name }}</strong><br>
                    Telp: {{ $booking->customer_phone }}<br>
                    No. Kamar: {{ $booking->room_number ?? '-' }}
                </td>
                <td>
                    <div class="section-title">Detail Properti</div>
                    <strong>{{ $booking->properti->judul }}</strong><br>
                    {{ $booking->properti->alamat }}<br>
                    Agen: {{ $booking->agent->nama_lengkap ?? '-' }}
                </td>
            </tr>
        </table>

        <div class="section-title">Detail Booking</div>
        <table class="details-table">
            <thead>
                <tr>
                    <th>Deskripsi</th>
                    <th class="text-right">Check-in</th>
                    <th class="text-right">Check-out</th>
                    <th class="text-right">Durasi</th>
                    <th class="text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        Sewa Unit: {{ $booking->properti->judul }}<br>
                        <small>Jumlah Kamar: {{ $booking->rooms }} | Tamu: {{ $booking->guests }}</small>
                    </td>
                    <td class="text-right">{{ \Carbon\Carbon::parse($booking->checkin)->format('d M Y') }}</td>
                    <td class="text-right">{{ \Carbon\Carbon::parse($booking->checkout)->format('d M Y') }}</td>
                    <td class="text-right">{{ $booking->duration }} Malam</td>
                    <td class="text-right">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <div class="total-section">
            <p>Metode Pembayaran: <strong>{{ strtoupper($booking->payment_method) }}</strong></p>
            <div class="total-amount">TOTAL: Rp {{ number_format($booking->total_price, 0, ',', '.') }}</div>
        </div>

        <div class="sig-section">
            <div class="sig-box">
                <p>Hormat Kami,</p>
                <div style="height: 60px;"></div>
                <p><strong>Admin {{ $settings['site_name'] ?? 'Anima Properti' }}</strong></p>
            </div>
            <div class="clear"></div>
        </div>

        <div class="footer">
            * Invoice ini adalah bukti pembayaran yang sah.<br>
            * Dicetak pada {{ date('d/m/Y H:i:s') }}
        </div>
    </div>
</body>
</html>
