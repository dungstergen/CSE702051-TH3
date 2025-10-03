<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'parking_lot_id',
        'booking_id',
        'rating',
        'comment',
        'is_visible',
        'admin_note'
    ];

    protected $casts = [
        'rating' => 'integer',
        'is_visible' => 'boolean'
    ];

    /**
     * Get the user that owns the review
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the parking lot for this review
     */
    public function parkingLot()
    {
        return $this->belongsTo(ParkingLot::class);
    }

    /**
     * Get the booking for this review
     */
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    /**
     * Get rating stars for display
     */
    public function getRatingStarsAttribute()
    {
        $stars = '';
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $this->rating) {
                $stars .= '★';
            } else {
                $stars .= '☆';
            }
        }
        return $stars;
    }

    /**
     * Get rating color based on score
     */
    public function getRatingColorAttribute()
    {
        if ($this->rating >= 4) return 'success';
        if ($this->rating >= 3) return 'warning';
        return 'danger';
    }

    /**
     * Scope for visible reviews
     */
    public function scopeVisible($query)
    {
        return $query->where('is_visible', true);
    }

    /**
     * Scope for hidden reviews
     */
    public function scopeHidden($query)
    {
        return $query->where('is_visible', false);
    }

    /**
     * Scope for reviews with rating
     */
    public function scopeWithRating($query, $rating)
    {
        return $query->where('rating', $rating);
    }

    /**
     * Scope for recent reviews
     */
    public function scopeRecent($query, $days = 30)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    /**
     * Scope for high rated reviews (4-5 stars)
     */
    public function scopeHighRated($query)
    {
        return $query->where('rating', '>=', 4);
    }

    /**
     * Scope for low rated reviews (1-2 stars)
     */
    public function scopeLowRated($query)
    {
        return $query->where('rating', '<=', 2);
    }
}
