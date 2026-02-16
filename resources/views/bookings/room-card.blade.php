<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Kartu Kamar #{{ $booking->room_number }}</title>
    <style>
        @page { margin: 0; }
        body { 
            font-family: 'Inter', 'Helvetica', 'Arial', sans-serif; 
            margin: 0; 
            padding: 0; 
            background-color: white;
            -webkit-print-color-adjust: exact;
        }
        .container {
            width: 100%;
            height: 100%;
            padding: 12px; /* Decreased padding to give more space */
            box-sizing: border-box;
            position: relative;
        }
        .card-border {
            position: absolute;
            top: 5px;
            bottom: 5px;
            left: 5px;
            right: 5px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
        }
        .accent-top {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: #1a2a6c;
            border-radius: 8px 8px 0 0;
        }
        .header {
            text-align: center;
            margin-top: 10px;
            margin-bottom: 10px;
            padding: 0 10px;
        }
        .logo { height: 35px; margin-bottom: 5px; }
        .property-title {
            font-size: 10px;
            font-weight: 700;
            color: #1a2a6c;
            text-transform: uppercase;
            line-height: 1.3;
            word-wrap: break-word;
            overflow-wrap: break-word;
            display: block;
            width: 100%;
            margin-top: 5px;
        }
        .room-box {
            text-align: center;
            margin: 5px 10px;
            padding: 8px;
            background: #f8fafc;
            border-radius: 6px;
            border: 1px solid #f1f5f9;
        }
        .room-label {
            font-size: 8px;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            margin-bottom: 1px;
        }
        .room-number {
            font-size: 44px;
            font-weight: 800;
            color: #0f172a;
            margin: 0;
            line-height: 1;
        }
        .details {
            margin: 10px 15px;
            font-size: 10.5px;
        }
        .detail-row {
            margin-bottom: 4px;
            border-bottom: 1px solid #f1f5f9;
            padding-bottom: 3px;
            display: table;
            width: 100%;
        }
        .detail-label {
            color: #64748b;
            font-weight: 600;
            display: table-cell;
            width: 60px;
        }
        .detail-value {
            color: #1e293b;
            font-weight: 500;
            display: table-cell;
        }
        .wifi-badge {
            margin: 10px 10px;
            padding: 8px;
            background: #f0f9ff;
            border: 1px solid #bae6fd;
            border-radius: 6px;
            text-align: center;
        }
        .wifi-title {
            font-size: 9px;
            font-weight: 700;
            color: #0369a1;
            margin-bottom: 1px;
        }
        .wifi-text {
            font-size: 8px;
            color: #0c4a6e;
            line-height: 1.2;
        }
        .footer {
            position: absolute;
            bottom: 12px;
            left: 0;
            right: 0;
            text-align: center;
        }
        .footer-text {
            font-size: 7.5px;
            color: #94a3b8;
        }
        .footer-url {
            font-size: 8.5px;
            font-weight: 700;
            color: #1a2a6c;
            margin-top: 1px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card-border">
            <div class="accent-top"></div>
            
            <div class="header">
                <img src="{{ public_path($settings['logo_path'] ?? 'storage/logos/logo.png') }}" class="logo">
                <div class="property-title">{{ strip_tags($booking->properti->judul) }}</div>
            </div>

            <div class="room-box">
                <div class="room-label">Nomor Kamar</div>
                <h1 class="room-number">{{ $booking->room_number ?? '-' }}</h1>
            </div>

            <div class="details">
                <div class="detail-row">
                    <span class="detail-label">Penyewa</span>
                    <span class="detail-value">: {{ $booking->customer_name }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Check-in</span>
                    <span class="detail-value">: {{ \Carbon\Carbon::parse($booking->checkin)->format('d M Y') }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Check-out</span>
                    <span class="detail-value">: {{ \Carbon\Carbon::parse($booking->checkout)->format('d M Y') }}</span>
                </div>
            </div>

            <div class="wifi-badge">
                <div class="wifi-title">📶 FASILITAS WIFI</div>
                <div class="wifi-text">Akses password melalui resepsionis atau agen yang bertugas.</div>
            </div>

            <div class="footer">
                <div class="footer-text">Selamat beristirahat, terima kasih.</div>
                <div class="footer-url">{{ parse_url(config('app.url'), PHP_URL_HOST) }}</div>
            </div>
        </div>
    </div>
</body>
</html>
