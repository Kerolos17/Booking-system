<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'description',
        'event_date',
        'total_seats',
    ];

    // العلاقة بين Event و Bookings (فعالية واحدة لها حجوزات متعددة)
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
