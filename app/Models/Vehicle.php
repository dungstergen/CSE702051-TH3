<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'number',
        'type',
        'brand',
    ];

    /**
     * Get the user that owns the vehicle.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the type label in Vietnamese
     */
    public function getTypeLabelAttribute()
    {
        return match($this->type) {
            'car' => 'Ô tô',
            'motorbike' => 'Xe máy',
            'truck' => 'Xe tải',
            default => 'Không xác định'
        };
    }

    /**
     * Get formatted license plate
     */
    public function getFormattedNumberAttribute()
    {
        return strtoupper($this->number);
    }
}
