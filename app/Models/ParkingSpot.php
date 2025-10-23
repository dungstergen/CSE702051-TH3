<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParkingSpot extends Model
{
    protected $fillable = [
        'parking_lot_id',
        'spot_code',
        'level',
        'status',
        'vehicle_type',
        'description',
    ];

    public function lot()
    {
        return $this->belongsTo(ParkingLot::class, 'parking_lot_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
