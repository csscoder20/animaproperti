<x-filament::page>
    <div class="p-6 bg-white shadow rounded">
        <h2 class="text-xl font-bold mb-4">Invoice Penjualan</h2>

        <p><strong>Nama Pembeli:</strong> {{ $record->pelanggan->nama ?? '-' }}</p>
        <p><strong>Properti:</strong> {{ $record->properti->judul ?? '-' }}</p>
        <p><strong>Harga Jual:</strong> Rp {{ number_format($record->harga_jual, 0, ',', '.') }}</p>
        <p><strong>Tanggal:</strong> {{ $record->tanggal_penjualan }}</p>
        <p><strong>Metode Pembayaran:</strong> {{ ucfirst($record->metode_pembayaran) }}</p>
        <p><strong>Status Pembayaran:</strong> {{ ucfirst($record->status_pembayaran) }}</p>

        <div class="mt-6">
            <a href="{{ url()->current() }}" onclick="window.print()" class="filament-button filament-button-size-sm">
                🖨 Cetak Invoice
            </a>
        </div>
    </div>
</x-filament::page>
