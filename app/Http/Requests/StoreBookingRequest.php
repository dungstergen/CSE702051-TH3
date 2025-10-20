<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Routes already use 'auth' middleware; allow validation to run
        return true;
    }

    public function rules(): array
    {
        return [
            'parking_lot_id' => 'required|exists:parking_lots,id',
            'service_package_id' => 'nullable|exists:service_packages,id',
            'booking_date' => 'required|date|after_or_equal:today',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'vehicle_type' => 'nullable|string|max:50',
            'license_plate' => 'required|string|max:20',
            'phone_number' => 'required|string|max:20',
            'special_requests' => 'nullable|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'parking_lot_id.required' => 'Vui lòng chọn bãi đỗ xe.',
            'booking_date.required' => 'Vui lòng chọn ngày đặt chỗ.',
            'start_time.required' => 'Vui lòng chọn thời gian bắt đầu.',
            'end_time.required' => 'Vui lòng chọn thời gian kết thúc.',
            'end_time.after' => 'Thời gian kết thúc phải sau thời gian bắt đầu.',
            'license_plate.required' => 'Vui lòng nhập biển số xe.',
            'phone_number.required' => 'Vui lòng nhập số điện thoại.',
        ];
    }
}
