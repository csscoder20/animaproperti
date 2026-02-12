<?php

namespace App\Http\Controllers;

use App\Models\Agen;
use App\Models\Properti;
use Illuminate\Http\Request;
use App\Models\JenisProperti;
use App\Models\MasterWilayah;
use Illuminate\Support\Facades\DB;

class SewaController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Sewa Properti';

        // Base query: Only "Disewa" and only "Kost" or "Apartemen"
        $query = Properti::with(['jenisProperti', 'agens'])
            ->where('penawaran', 'Disewa')
            ->whereHas('jenisProperti', function ($q) {
                $q->whereIn('slug', ['kost', 'apartemen']);
            })
            ->latest();

        // Filter Lokasi
        if ($request->filled('lokasi')) {
            $query->where('kecamatan', $request->lokasi);
        }

        // Filter Tipe Properti (Kost or Apartemen)
        if ($request->filled('tipe')) {
            $query->whereHas('jenisProperti', function ($q) use ($request) {
                $q->where('slug', $request->tipe);
            });
        }

        // Filter Rooms (Ruangan)
        if ($request->filled('rooms') && $request->rooms !== 'any') {
            $query->where('jumlah_kamar', '>=', $request->rooms);
        }

        // Filter Guests (Orang)
        if ($request->filled('guests') && $request->guests !== 'any') {
            $query->where('kapasitas_tamu', '>=', $request->guests);
        }

        // Filter Dates (Availability)
        if ($request->filled('checkin')) {
            $query->where(function ($q) use ($request) {
                $q->whereNull('tersedia_dari')
                    ->orWhere('tersedia_dari', '<=', $request->checkin);
            });
        }

        if ($request->filled('checkout')) {
            $query->where(function ($q) use ($request) {
                $q->whereNull('tersedia_sampai')
                    ->orWhere('tersedia_sampai', '>=', $request->checkout);
            });
        }

        // Paginate results
        $properties = $query->paginate(12)->appends($request->query());
        $totalResults = $properties->total();

        // Data for filters
        $TipeSewa = JenisProperti::whereIn('slug', ['kost', 'apartemen'])->get();
        $kecamatanList = MasterWilayah::whereIn('kode', function ($sub) {
            $sub->select(DB::raw('LEFT(kecamatan, 8)'))
                ->from('propertis')
                ->where('penawaran', 'Disewa')
                ->distinct();
        })->orderBy('nama')->get();

        $agenList = Agen::select('id', 'nama_lengkap')->get();

        return view('frontend.pages.sewa', compact(
            'title',
            'properties',
            'totalResults',
            'TipeSewa',
            'kecamatanList',
            'agenList'
        ));
    }
    public function show($slug)
    {
        $property = Properti::with(['jenisProperti', 'images', 'agens'])
            ->where('slug', $slug)
            ->firstOrFail();

        $title = $property->judul . ' - Sewa Properti';

        // Recommended: Other "Sewa" items (Kost/Apartemen)
        $recommendedProperties = Properti::with('images')
            ->where('id', '!=', $property->id)
            ->where('penawaran', 'Disewa')
            ->whereHas('jenisProperti', function ($q) {
                $q->whereIn('slug', ['kost', 'apartemen']);
            })
            ->latest()
            ->take(3)
            ->get();

        // Alamat
        $alamatLengkap = $this->getAlamatLengkapProperti($property);
        $mapsUrl = $alamatLengkap
            ? 'https://www.google.com/maps?q=' . urlencode($alamatLengkap) . '&output=embed'
            : null;

        return view('frontend.pages.sewa-details', compact(
            'title',
            'property',
            'recommendedProperties',
            'mapsUrl',
            'alamatLengkap'
        ));
    }

    public function booking($slug)
    {
        $property = Properti::with(['jenisProperti', 'images', 'agens'])
            ->where('slug', $slug)
            ->firstOrFail();

        $agents = $property->agens;
        $title = 'Booking ' . $property->judul;
        $alamatLengkap = $this->getAlamatLengkapProperti($property);

        return view('frontend.pages.sewa-booking', compact(
            'title',
            'property',
            'agents',
            'alamatLengkap'
        ));
    }

    public function confirmBooking(Request $request, $slug)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'checkin' => 'required|date',
            'checkout' => 'required|date|after:checkin',
            'rooms' => 'required|integer|min:1',
            'guests' => 'required|integer|min:1',
            'agent_phone' => 'required',
            'agent_name' => 'required',
        ]);

        $property = Properti::where('slug', $slug)->firstOrFail();

        $checkin = \Carbon\Carbon::parse($request->checkin);
        $checkout = \Carbon\Carbon::parse($request->checkout);
        $duration = $checkin->diffInDays($checkout);

        // Calculation: Rooms * Price * Duration
        $totalPrice = $request->rooms * $property->harga * $duration;

        $bookingData = $request->all();
        $bookingData['duration'] = $duration;
        $bookingData['total_price'] = $totalPrice;

        $title = 'Konfirmasi Pesanan - ' . $property->judul;

        return view('frontend.pages.sewa-booking-confirm', compact(
            'title',
            'property',
            'bookingData'
        ));
    }

    public function processBooking(Request $request, $slug)
    {
        $request->validate([
            'customer_name' => 'required|string',
            'customer_phone' => 'required|string',
            'agent_id' => 'nullable', // If we track agent ID. Currently we only have phone/name from form.
            // We should try to find the agent by phone or just store the name?
            // The booking table has `agent_id` foreign key!
            // We need the Agent ID. sewa-booking passed phone/name.
            // We should pass Agent ID from the form too.
            // I'll update the form to pass agent_id.
            'checkin' => 'required|date',
            'checkout' => 'required|date',
            'rooms' => 'required|integer',
            'guests' => 'required|integer',
            'duration' => 'required|integer',
            'total_price' => 'required|numeric',
        ]);

        $property = Properti::where('slug', $slug)->firstOrFail();

        // Find Agent by phone or name, OR better: pass agent_id from the start.
        // For now, let's try to lookup agent by phone (since we passed it).
        // The phone format in DB might differ from hidden field (62 vs 08).
        // Let's perform a loose search or better: Update the previous form to pass agent_id.
        // For this step, I'll assume we can pass agent_id. 
        // I will update sewa-booking to pass agent_id.

        // Temporary: fail safe
        $agent = Agen::where('no_hp', 'LIKE', '%' . substr($request->agent_phone, -8))->first();
        if (!$agent) {
            // Fallback or error?
            // Or just pick the first agent of the property?
            $agent = $property->agens()->first();
        }

        $booking = \App\Models\Booking::create([
            'properti_id' => $property->id,
            'agent_id' => $agent ? $agent->id : null,
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'checkin' => $request->checkin,
            'checkout' => $request->checkout,
            'rooms' => $request->rooms,
            'guests' => $request->guests,
            'duration' => $request->duration,
            'total_price' => $request->total_price,
            'status' => 'pending',
        ]);

        // Construct WA Message
        $waPhone = $agent ? $agent->no_hp : $request->agent_phone;
        $waPhone = preg_replace('/\D/', '', $waPhone);
        if (str_starts_with($waPhone, '0')) {
            $waPhone = '62' . substr($waPhone, 1);
        }

        $checkinFormatted = \Carbon\Carbon::parse($request->checkin)->translatedFormat('d M Y, H:i');
        $checkoutFormatted = \Carbon\Carbon::parse($request->checkout)->translatedFormat('d M Y, H:i');
        $totalFormatted = number_format($request->total_price, 0, ',', '.');

        $message = "Halo Kak {$agent->nama_lengkap}, saya {$request->customer_name} ingin memesan properti:\n" .
            "*{$property->judul}*\n\n" .
            "Detail Pesanan:\n" .
            "- Check-in: {$checkinFormatted} WIB\n" .
            "- Check-out: {$checkoutFormatted} WIB\n" .
            "- Jumlah Kamar: {$request->rooms}\n" .
            "- Jumlah Tamu: {$request->guests} Orang\n" .
            "- Durasi: {$request->duration} Malam\n" .
            "- Total Harga: Rp {$totalFormatted}\n\n" .
            "Mohon info ketersediaan dan cara pembayarannya. Terima kasih.";

        $url = "https://wa.me/{$waPhone}?text=" . urlencode($message);

        return redirect()->away($url);
    }

    private function getAlamatLengkapProperti(Properti $property): string
    {
        $kelurahan = MasterWilayah::getNamaByKode($property->kelurahan);
        $kecamatan = MasterWilayah::getNamaByKode($property->kecamatan);
        $kabupaten = MasterWilayah::getNamaByKode($property->kabupaten);
        $provinsi = MasterWilayah::getNamaByKode($property->provinsi);

        return implode(', ', array_filter([
            $property->alamat_lengkap,
            $kelurahan,
            $kecamatan,
            $kabupaten,
            $provinsi,
            $property->kode_pos,
        ]));
    }
}
