<?php

use App\Http\Controllers\BookingController;
use App\Models\Event;
use Illuminate\Support\Facades\Route;
Route::view('/', 'welcome');

Route::get('/booking', function () {
    $events = Event::with('bookings')->get();
    return view('events.index', compact('events'));
});
Route::get('/booking', [BookingController::class, 'create']);
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
Route::get('/booking/confirmation/{booking}', [BookingController::class, 'confirmation'])->name('booking.confirmation');

Route::get('/scan', [BookingController::class, 'scanPage'])->name('scan.page');
Route::post('/validate-qr', [BookingController::class, 'validateQR'])->name('validate.qr');
