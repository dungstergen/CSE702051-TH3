<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'parking_lot_id',
        'parking_spot_id',
        'service_package_id',
        'booking_code',
        'booking_date',
        'start_time',
        'end_time',
        'duration_hours',
        'vehicle_type',
        'license_plate',
        'phone_number',
        'special_requests',
        'total_cost',
        'status',
        'payment_status'
    ];

    protected $casts = [
        'booking_date' => 'date',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'total_cost' => 'decimal:2',
        'duration_hours' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user that owns the booking
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the parking lot for this booking
     */
    public function parkingLot()
    {
        return $this->belongsTo(ParkingLot::class);
    }

    /**
     * Get the parking spot for this booking
     */
    public function parkingSpot()
    {
        return $this->belongsTo(ParkingSpot::class);
    }

    /**
     * Get the payment for this booking
     */
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    /**
     * Get the review for this booking
     */
    public function review()
    {
        return $this->hasOne(Review::class);
    }

    /**
     * Get the service package for this booking
     */
    public function servicePackage()
    {
        return $this->belongsTo(ServicePackage::class);
    }

    /**
     * Check if booking is active
     */
    public function isActive()
    {
        return in_array($this->status, ['pending', 'confirmed']);
    }

    /**
     * Check if booking can be cancelled
     */
    public function canBeCancelled()
    {
        return in_array($this->status, ['pending', 'confirmed']) &&
               $this->start_time > now();
    }

    /**
     * Get status color for display
     */
    public function getStatusColorAttribute()
    {
        return [
            'pending' => 'warning',
            'confirmed' => 'success',
            'cancelled' => 'danger',
            'completed' => 'info'
        ][$this->status] ?? 'secondary';
    }

    /**
     * Get status text in Vietnamese
     */
    public function getStatusTextAttribute()
    {
        return [
            'pending' => 'Chờ xác nhận',
            'confirmed' => 'Đã xác nhận',
            'cancelled' => 'Đã hủy',
            'completed' => 'Hoàn thành'
        ][$this->status] ?? $this->status;
    }

    /**
     * Scope for active bookings
     */
    public function scopeActive($query)
    {
        return $query->whereIn('status', ['pending', 'confirmed']);
    }

    /**
     * Scope for today's bookings
     */
    public function scopeToday($query)
    {
        return $query->whereDate('booking_date', today());
    }

    /**
     * Scope for upcoming bookings
     */
    public function scopeUpcoming($query)
    {
        return $query->where('start_time', '>', now());
    }

    /**
     * Scope for completed bookings
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }
}
