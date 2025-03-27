<?php

namespace App\Http\Controllers;

use App\Mail\BookingConfirmationMail;
use App\Models\Event;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function create(Event $event)
    {
        return view('bookings.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_name'  => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'number_of_seats' => 'required|integer|min:1|max:100',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $today = Carbon::today();
        $totalSeatsToday = Booking::whereDate('booking_time', $today)->sum('number_of_seats');

        if ($totalSeatsToday + $request->number_of_seats > 100) {
            return redirect()->back()->withErrors(['number_of_seats' => 'Daily limit of 100 seats has been reached.'])->withInput();
        }

        $booking = Booking::create([
            'customer_name'   => $request->customer_name,
            'customer_email'  => $request->customer_email,
            'customer_phone'  => $request->customer_phone,
            'number_of_seats' => $request->number_of_seats,
            'booking_time'    => now(),
            'status'          => 'pending',
        ]);

        // $qrCodeData = $booking->id;
        // $qrCode = QrCode::format('png')->size(300)->margin(5)->generate($qrCodeData);

        // $qrPath = 'qrcodes/booking_' . $booking->id . '.png';
        // Storage::disk('public')->put($qrPath, $qrCode);

        // $booking->update(['qr_code' => $qrPath]);
        Mail::to($booking->customer_email)->send(new BookingConfirmationMail($booking));
        return redirect()->route('booking.confirmation', $booking->id);
    }

    public function confirmation(Booking $booking)
    {
        return view('bookings.confirmation', compact('booking'));
    }

    public function scanPage()
    {
        return view('scan_qr');
    }

    public function validateQr(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        if (!isset($data['booking_id'])) {
            return response()->json(['status' => 'error', 'message' => 'Invalid QR Code'], 400);
        }

        $bookingId = (int) filter_var($data['booking_id'], FILTER_SANITIZE_NUMBER_INT);

        $booking = Booking::find($bookingId);

        if (!$booking || $booking->status === 'confirmed') {
            return response()->json(['status' => 'error', 'message' => 'Invalid or already confirmed QR Code'], 400);
        }

        $booking->update(['status' => 'confirmed']);

        return response()->json([
            'status'       => 'success',
            'message'      => 'QR Code is valid',
            'customer_name' => $booking->customer_name,
            'customer_email' => $booking->customer_email,
            'customer_phone' => $booking->customer_phone,
            'booking_time' => $booking->booking_time,
            'seats'        => $booking->number_of_seats,
        ]);
    }
}
