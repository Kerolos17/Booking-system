<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'event_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'number_of_seats',
        'booking_time',
        'status',
        'qr_code',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
    public function isUsed()
    {
        return $this->status === 'confirmed';
    }
}
