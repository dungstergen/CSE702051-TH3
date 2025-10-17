<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicePackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'duration_type',
        'duration_value',
        'features',
        'max_vehicles',
        'max_bookings_per_month',
        'discount_percentage',
        'promotional_price',
        'promotion_start_date',
        'promotion_end_date',
        'is_active',
        'is_featured',
        'sort_order',
        'total_subscribers'
    ];

    protected $casts = [
        'features' => 'array',
        'price' => 'decimal:2',
        'promotional_price' => 'decimal:2',
        'discount_percentage' => 'decimal:2',
        'promotion_start_date' => 'date',
        'promotion_end_date' => 'date',
        'is_active' => 'boolean',
        'is_featured' => 'boolean'
    ];

    // Relationships
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function parkingLots()
    {
        return $this->belongsToMany(ParkingLot::class, 'parking_lot_service_packages');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Accessors
    public function getFormattedPriceAttribute()
    {
        return number_format((float)$this->price, 0, ',', '.') . ' VNĐ';
    }
}
