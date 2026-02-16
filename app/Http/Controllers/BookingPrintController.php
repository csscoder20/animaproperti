<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Pengaturan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class BookingPrintController extends Controller
{
    public function printInvoice($id)
    {
        $booking = Booking::with(['properti', 'agent'])->findOrFail($id);
        $settings = Pengaturan::getAllAsArray();

        $pdf = Pdf::loadView('bookings.invoice', compact('booking', 'settings'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream("invoice-booking-{$booking->id}.pdf");
    }

    public function printRoomCard($id)
    {
        $booking = Booking::with(['properti'])->findOrFail($id);
        $settings = Pengaturan::getAllAsArray();

        // Kartu nomor kamar biasanya lebih kecil, kita gunakan ukuran custom atau A6/A7
        // A6: 105 x 148 mm
        $pdf = Pdf::loadView('bookings.room-card', compact('booking', 'settings'))
            ->setPaper([0, 0, 297.64, 420.94], 'portrait'); // Ukuran A6 dalam poin (72 dpi)

        return $pdf->stream("room-card-{$booking->room_number}.pdf");
    }

    public function previewInvoice($id)
    {
        $booking = Booking::with(['properti', 'agent'])->findOrFail($id);
        $settings = Pengaturan::getAllAsArray();

        return view('bookings.invoice', compact('booking', 'settings'));
    }

    public function previewRoomCard($id)
    {
        $booking = Booking::with(['properti'])->findOrFail($id);
        $settings = Pengaturan::getAllAsArray();

        return view('bookings.room-card', compact('booking', 'settings'));
    }
}
