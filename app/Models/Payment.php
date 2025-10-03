<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'amount',
        'payment_method',
        'payment_status',
        'transaction_id',
        'gateway_response',
        'paid_at',
        'refunded_at',
        'notes'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'paid_at' => 'datetime',
        'refunded_at' => 'datetime',
        'gateway_response' => 'array'
    ];

    /**
     * Get the booking that owns the payment
     */
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    /**
     * Check if payment is completed
     */
    public function isCompleted()
    {
        return $this->payment_status === 'completed';
    }

    /**
     * Check if payment is pending
     */
    public function isPending()
    {
        return $this->payment_status === 'pending';
    }

    /**
     * Check if payment is failed
     */
    public function isFailed()
    {
        return $this->payment_status === 'failed';
    }

    /**
     * Check if payment is refunded
     */
    public function isRefunded()
    {
        return $this->payment_status === 'refunded';
    }

    /**
     * Check if payment can be refunded
     */
    public function canBeRefunded()
    {
        return $this->isCompleted() && !$this->refunded_at;
    }

    /**
     * Get status color for display
     */
    public function getStatusColorAttribute()
    {
        return [
            'pending' => 'warning',
            'completed' => 'success',
            'failed' => 'danger',
            'refunded' => 'info'
        ][$this->payment_status] ?? 'secondary';
    }

    /**
     * Get status text in Vietnamese
     */
    public function getStatusTextAttribute()
    {
        return [
            'pending' => 'Đang xử lý',
            'completed' => 'Hoàn thành',
            'failed' => 'Thất bại',
            'refunded' => 'Đã hoàn tiền'
        ][$this->payment_status] ?? $this->payment_status;
    }

    /**
     * Get payment method text in Vietnamese
     */
    public function getMethodTextAttribute()
    {
        return [
            'credit_card' => 'Thẻ tín dụng',
            'debit_card' => 'Thẻ ghi nợ',
            'bank_transfer' => 'Chuyển khoản',
            'e_wallet' => 'Ví điện tử',
            'cash' => 'Tiền mặt'
        ][$this->payment_method] ?? $this->payment_method;
    }

    /**
     * Scope for completed payments
     */
    public function scopeCompleted($query)
    {
        return $query->where('payment_status', 'completed');
    }

    /**
     * Scope for pending payments
     */
    public function scopePending($query)
    {
        return $query->where('payment_status', 'pending');
    }

    /**
     * Scope for failed payments
     */
    public function scopeFailed($query)
    {
        return $query->where('payment_status', 'failed');
    }

    /**
     * Scope for refunded payments
     */
    public function scopeRefunded($query)
    {
        return $query->where('payment_status', 'refunded');
    }

    /**
     * Scope for payments in date range
     */
    public function scopeDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('created_at', [$startDate, $endDate]);
    }
}
