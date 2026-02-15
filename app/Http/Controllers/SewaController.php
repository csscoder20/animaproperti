<?php

namespace App\Http\Controllers;

use App\Models\Agen;
use App\Models\Properti;
use Illuminate\Http\Request;
use App\Models\JenisProperti;
use App\Models\MasterWilayah;
use Illuminate\Support\Facades\DB;


use App\Models\Slider; // ADDED

class SewaController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Sewa Properti';
        $properties = collect();
        $totalResults = 0;
        $isSearch = false;

        // Check if any search parameter is present
        if ($request->anyFilled(['keyword', 'lokasi', 'tipe', 'rooms', 'guests', 'checkin', 'checkout'])) {
            $isSearch = true;

            // Base query: Only "Disewa" and only "Kost" or "Apartemen"
            $query = Properti::with(['jenisProperti', 'agens'])
                ->where('penawaran', 'Disewa')
                ->whereHas('jenisProperti', function ($q) {
                    $q->whereIn('slug', ['kost', 'apartemen']);
                })
                ->latest();

            // Filter Keyword (Lokasi / Nama Kost / Apartemen)
            if ($request->filled('keyword')) {
                $keyword = $request->keyword;

                // 1. Cari kode wilayah yang namanya cocok dengan keyword (LIKE or SOUNDEX)
                $matchingWilayahCodes = MasterWilayah::where(function ($q) use ($keyword) {
                    $q->where('nama', 'LIKE', '%' . $keyword . '%')
                        ->orWhereRaw('SOUNDEX(nama) = SOUNDEX(?)', [$keyword])
                        ->orWhereRaw("SOUNDEX(REPLACE(nama, 'Kota ', '')) = SOUNDEX(?)", [$keyword])
                        ->orWhereRaw("SOUNDEX(REPLACE(nama, 'Kabupaten ', '')) = SOUNDEX(?)", [$keyword]);
                })
                    ->pluck('kode')
                    ->toArray();

                // dd($matchingWilayahCodes); // DEBUG

                $query->where(function ($q) use ($keyword, $matchingWilayahCodes) {
                    $q->where('judul', 'LIKE', '%' . $keyword . '%')
                        // Search by Full Address
                        ->orWhere('alamat_lengkap', 'LIKE', '%' . $keyword . '%')
                        // Search by Type Name (e.g. "Apartemen", "Kost")
                        ->orWhereHas('jenisProperti', function ($qType) use ($keyword) {
                            $qType->where('nama', 'LIKE', '%' . $keyword . '%');
                        })
                        // OR Search by Location (Kecamatan, Kabupaten, Provinsi) matches
                        ->orWhere(function ($subQ) use ($matchingWilayahCodes) {
                            if (!empty($matchingWilayahCodes)) {
                                $subQ->whereIn('kecamatan', $matchingWilayahCodes)
                                    ->orWhereIn('kabupaten', $matchingWilayahCodes)
                                    ->orWhereIn('provinsi', $matchingWilayahCodes);
                            }
                        });
                });
            }

            // Keep legacy legacy filters for backward compatibility if needed, 
            // but UI doesn't use them anymore.
            if ($request->filled('lokasi')) {
                $query->where('kecamatan', $request->lokasi);
            }

            if ($request->filled('tipe')) {
                $query->whereHas('jenisProperti', function ($q) use ($request) {
                    $q->where('slug', $request->tipe);
                });
            }

            // Filter Rooms (Ruangan)
            if ($request->filled('rooms') && $request->rooms !== 'any') {
                $query->where('jumlah_kamar', '>=', $request->rooms);
            }

            // Filter Guests (Orang) - Advanced Utilization Logic
            if ($request->filled('guests') && $request->guests !== 'any') {
                $adults = (int) $request->input('adults', 0);
                $children = (int) $request->input('children', 0);
                $rooms = (int) $request->input('rooms', 1);
                $totalGuests = (int) $request->guests; // Fallback for simple search

                // If granular inputs are missing but we have total guests, treat as Adults=Total
                if ($adults == 0 && $children == 0 && $totalGuests > 0) {
                    $adults = $totalGuests;
                }

                $query->where(function ($q) use ($adults, $children, $rooms, $totalGuests) {
                    // Logic A: Granular Columns Exist -> Check Utilization
                    $q->where(function ($sub) use ($adults, $children, $rooms) {
                        $sub->whereRaw('(COALESCE(kapasitas_dewasa_per_kamar, 0) > 0 OR COALESCE(kapasitas_anak_per_kamar, 0) > 0)')
                            ->whereRaw("
                                (
                                    IF(COALESCE(kapasitas_dewasa_per_kamar, 0) > 0, ? / kapasitas_dewasa_per_kamar, IF(? > 0, 1000, 0)) +
                                    IF(COALESCE(kapasitas_anak_per_kamar, 0) > 0, ? / kapasitas_anak_per_kamar, IF(? > 0, 1000, 0))
                                ) <= ?
                            ", [$adults, $adults, $children, $children, $rooms]);
                    })
                    // Logic B: Legacy / No Granular -> Check Total Capacity
                    ->orWhere(function ($sub) use ($totalGuests) {
                        $sub->whereRaw('(COALESCE(kapasitas_dewasa_per_kamar, 0) = 0 AND COALESCE(kapasitas_anak_per_kamar, 0) = 0)')
                            ->where('kapasitas_tamu', '>=', $totalGuests);
                    });
                });
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
        }

        // Data for filters
        $TipeSewa = JenisProperti::whereIn('slug', ['kost', 'apartemen'])->get();
        $kecamatanList = MasterWilayah::whereIn('kode', function ($sub) {
            $sub->select(DB::raw('LEFT(kecamatan, 8)'))
                ->from('propertis')
                ->where('penawaran', 'Disewa')
                ->distinct();
        })->orderBy('nama')->get();

        $agenList = Agen::select('id', 'nama_lengkap')->get();

        // Fetch Active Sliders
        $activeSliders = Slider::active()->orderBy('order')->get();

        return view('frontend.pages.sewa', compact(
            'title',
            'properties',
            'totalResults',
            'TipeSewa',
            'kecamatanList',
            'agenList',
            'activeSliders',
            'isSearch'
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



    public function confirmBooking(Request $request, $slug)
    {
        $request->validate([
            'checkin' => 'required|date',
            'checkout' => 'required|date|after:checkin',
            'rooms' => 'required|integer|min:1',
            'guests' => 'required|integer|min:1',
        ]);

        $property = Properti::with('agens')->where('slug', $slug)->firstOrFail();

        $checkin = \Carbon\Carbon::parse($request->checkin);
        $checkout = \Carbon\Carbon::parse($request->checkout);
        $duration = $checkin->diffInDays($checkout);

        // Calculation: Rooms * Price * Duration
        // Use harga_sewa_per_malam for rental properties (Kost/Apartemen)
        $pricePerNight = $property->harga_sewa_per_malam ?? $property->harga;
        $totalPrice = $request->rooms * $pricePerNight * $duration;

        $bookingData = $request->all();
        $bookingData['duration'] = $duration;
        $bookingData['total_price'] = $totalPrice;

        $title = 'Konfirmasi Pesanan - ' . $property->judul;
        $agents = $property->agens; // Pass agents to the view

        return view('frontend.pages.sewa-booking-confirm', compact(
            'title',
            'property',
            'bookingData',
            'agents'
        ));
    }

    public function bookingSummary(Request $request, $slug)
    {
        $request->validate([
            'customer_name' => 'required|string',
            'customer_phone' => 'required|string',
            'agent_phone' => 'required|string',
            'agent_name' => 'required|string',
            'checkin' => 'required|date',
            'checkout' => 'required|date|after:checkin',
            'rooms' => 'required|integer|min:1',
            'guests' => 'required|integer|min:1',
            'payment_method' => 'required|string',
        ]);

        $property = Properti::with(['jenisProperti', 'images', 'agens'])->where('slug', $slug)->firstOrFail();

        // Calculate duration and total price
        $checkin = \Carbon\Carbon::parse($request->checkin);
        $checkout = \Carbon\Carbon::parse($request->checkout);
        $duration = $checkin->diffInDays($checkout) ?: 1;
        // Use harga_sewa_per_malam for rental properties (Kost/Apartemen)
        $pricePerNight = $property->harga_sewa_per_malam ?? $property->harga;
        $totalPrice = $request->rooms * $pricePerNight * $duration;

        // Find the selected agent
        $agent = Agen::where('no_hp', 'LIKE', '%' . substr($request->agent_phone, -8))->first();
        
        if (!$agent) {
            $agent = $property->agens()->first();
        }

        if (!$agent) {
            return back()->with('error', 'Data agen tidak ditemukan untuk properti ini.');
        }

        // Get full address
        $alamatLengkap = $this->getAlamatLengkapProperti($property);

        $title = 'Ringkasan Pesanan - ' . $property->judul;

        return view('frontend.pages.sewa-booking-summary', compact(
            'title',
            'property',
            'agent',
            'alamatLengkap',
            'checkin',
            'checkout',
            'duration',
            'totalPrice',
            'request'
        ));
    }

    public function processBooking(Request $request, $slug)
    {
        $request->validate([
            'customer_name' => 'required|string',
            'customer_phone' => 'required|string',
            'agent_phone' => 'required|string',
            'agent_name' => 'nullable|string',
            'checkin' => 'required|date',
            'checkout' => 'required|date',
            'rooms' => 'required|integer',
            'guests' => 'required|integer',
            'duration' => 'required|integer',
            'total_price' => 'required|numeric',
            'payment_method' => 'required|string',
        ]);

        $property = Properti::where('slug', $slug)->firstOrFail();

        // Find Agent by phone
        $agent = null;
        if ($request->filled('agent_phone')) {
             $agent = Agen::where('no_hp', 'LIKE', '%' . substr($request->agent_phone, -8))->first();
        }
        
        if (!$agent) {
             // Fallback to first agent of the property if specific agent not found
            $agent = $property->agens()->first();
        }

        if (!$agent) {
             return back()->with('error', 'Data agen tidak ditemukan untuk properti ini.');
        }

        // Create Booking Record (Optional: If you want to save to DB)
        // Ensure your Booking model and table have 'payment_method' column if you want to save it.
        // For now, I will assume we might not have the column yet or just save it in notes/status if needed.
        // Or just proceed without saving payment_method to DB if column missing.
        
        $booking = \App\Models\Booking::create([
            'properti_id' => $property->id,
            'agent_id' => $agent->id,
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'checkin' => $request->checkin,
            'checkout' => $request->checkout,
            'rooms' => $request->rooms,
            'guests' => $request->guests,
            'duration' => $request->duration,
            'total_price' => $request->total_price,
            'status' => 'pending',
            'payment_method' => $request->payment_method,
        ]);

        // Construct WA Message
        $waPhone = $agent->no_hp;
        $waPhone = preg_replace('/\D/', '', $waPhone);
        if (str_starts_with($waPhone, '0')) {
            $waPhone = '62' . substr($waPhone, 1);
        }

        $checkinFormatted = \Carbon\Carbon::parse($request->checkin)->translatedFormat('d M Y, H:i');
        $checkoutFormatted = \Carbon\Carbon::parse($request->checkout)->translatedFormat('d M Y, H:i');
        $totalFormatted = number_format($request->total_price, 0, ',', '.');
        $paymentMethod = $request->payment_method;

        $message = "Halo Kak {$agent->nama_lengkap}, saya {$request->customer_name} ingin memesan properti:\n" .
            "*{$property->judul}*\n\n" .
            "Detail Pesanan:\n" .
            "- Check-in: {$checkinFormatted} WIB\n" .
            "- Check-out: {$checkoutFormatted} WIB\n" .
            "- Jumlah Kamar: {$request->rooms}\n" .
            "- Jumlah Tamu: {$request->guests} Orang\n" .
            "- Durasi: {$request->duration} Malam\n" .
            "- Total Harga: Rp {$totalFormatted}\n" .
            "- Metode Pembayaran: {$paymentMethod}\n\n" .
            "Mohon segera diproses. Terima kasih.";

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

    public function checkAvailability(Request $request, $slug)
    {
        $request->validate([
            'checkin' => 'required|date',
            'checkout' => 'required|date|after:checkin',
        ]);

        $property = Properti::where('slug', $slug)->firstOrFail();

        $checkin = $request->checkin;
        $checkout = $request->checkout;

        // Count overlapping bookings that are confirmed
        // Overlap logic: (StartA <= EndB) and (EndA >= StartB)
        $bookedRooms = \App\Models\Booking::where('properti_id', $property->id)
            ->where('status', 'confirmed')
            ->where(function ($query) use ($checkin, $checkout) {
                $query->where('checkin', '<', $checkout)
                    ->where('checkout', '>', $checkin);
            })
            ->sum('rooms');

        $availableRooms = $property->jumlah_kamar - $bookedRooms;

        // Ensure available rooms doesn't go below zero (though DB logic should prevent this)
        $availableRooms = max($availableRooms, 0);

        return response()->json([
            'available_rooms' => $availableRooms,
            'total_rooms' => $property->jumlah_kamar,
            'booked_rooms' => $bookedRooms
        ]);
    }
}
