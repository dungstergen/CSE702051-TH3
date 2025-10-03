<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkingLot extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'description',
        'capacity',
        'total_spots',
        'available_spots',
        'hourly_rate',
        'latitude',
        'longitude',
        'amenities',
        'facilities',
        'operating_hours',
        'contact_info',
        'status',
        'is_active'
    ];

    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
        'hourly_rate' => 'decimal:2',
        'is_active' => 'boolean',
        'facilities' => 'array'
    ];

    /**
     * Get bookings for this parking lot
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Get reviews for this parking lot
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Get active bookings
     */
    public function activeBookings()
    {
        return $this->bookings()->whereIn('status', ['pending', 'confirmed']);
    }

    /**
     * Get available spots
     */
    public function getAvailableSpotsAttribute()
    {
        $activeBookings = $this->activeBookings()->count();
        return max(0, $this->capacity - $activeBookings);
    }

    /**
     * Check if parking lot is available
     */
    public function isAvailable()
    {
        return $this->is_active && $this->available_spots > 0;
    }

    /**
     * Get average rating
     */
    public function getAverageRatingAttribute()
    {
        return $this->reviews()->where('is_visible', true)->avg('rating') ?? 0;
    }

    /**
     * Scope for active parking lots
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for available parking lots
     */
    public function scopeAvailable($query)
    {
        return $query->active()->where('capacity', '>', 0);
    }
}
