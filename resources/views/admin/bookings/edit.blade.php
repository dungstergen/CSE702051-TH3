@extends('admin.layout')
@section('page-title', 'Chỉnh sửa Booking - Paspark Admin')
@section('page-heading', 'Chỉnh sửa Booking')

@section('content')
<div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <div class="flex items-center justify-between mb-4">
                    <h6 class="mb-0 dark:text-white">Chỉnh sửa Booking #{{ $booking->id }}</h6>
                    <div class="space-x-2">
                        <a href="{{ route('admin.bookings.show', $booking) }}" class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer bg-gradient-to-tl from-orange-500 to-yellow-500 leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs">
                            <i class="fas fa-eye mr-2"></i>Xem
                        </a>
                        <a href="{{ route('admin.bookings.index') }}" class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer bg-gradient-to-tl from-orange-500 to-yellow-500 leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs">
                            <i class="fas fa-arrow-left mr-2"></i>Quay lại
                        </a>
                    </div>
                </div>
            </div>

            <div class="flex-auto p-6">
                <form method="POST" action="{{ route('admin.bookings.update', $booking) }}">
                    @csrf
                    @method('PUT')
                    <div class="flex flex-wrap -mx-3">
                        <!-- Customer Information (Read-only) -->
                        <div class="w-full px-3 mb-4">
                            <h6 class="text-lg font-semibold text-slate-700 dark:text-white mb-4">Thông tin khách hàng</h6>
                        </div>

                        <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Khách hàng:</label>
                            <div class="bg-gray-100 rounded-lg p-3">
                                <p class="text-sm font-semibold">{{ $booking->user->name }}</p>
                                <p class="text-xs text-gray-600">{{ $booking->user->email }}</p>
                            </div>
                        </div>

                        <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Bãi đỗ xe:</label>
                            <div class="bg-gray-100 rounded-lg p-3">
                                <p class="text-sm font-semibold">{{ $booking->parkingLot->name }}</p>
                                <p class="text-xs text-gray-600">{{ $booking->parkingLot->address }}</p>
                            </div>
                        </div>

                        <!-- Booking Time -->
                        <div class="w-full px-3 mb-4">
                            <h6 class="text-lg font-semibold text-slate-700 dark:text-white mb-4">Thời gian đặt chỗ</h6>
                        </div>

                        <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80" for="start_time">
                                Thời gian bắt đầu <span class="text-red-500">*</span>
                            </label>
                            <input type="datetime-local" name="start_time" id="start_time" value="{{ old('start_time', $booking->start_time->format('Y-m-d\TH:i')) }}" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" required>
                            @error('start_time')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80" for="end_time">
                                Thời gian kết thúc <span class="text-red-500">*</span>
                            </label>
                            <input type="datetime-local" name="end_time" id="end_time" value="{{ old('end_time', $booking->end_time->format('Y-m-d\TH:i')) }}" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" required>
                            @error('end_time')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Additional Information -->
                        <div class="w-full px-3 mb-4">
                            <h6 class="text-lg font-semibold text-slate-700 dark:text-white mb-4">Thông tin bổ sung</h6>
                        </div>

                        <div class="w-full max-w-full px-3 mb-6 md:w-4/12 md:flex-none">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80" for="vehicle_type">
                                Loại xe
                            </label>
                            <select name="vehicle_type" id="vehicle_type" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow">
                                <option value="">Chọn loại xe</option>
                                <option value="car" {{ old('vehicle_type', $booking->vehicle_type) == 'car' ? 'selected' : '' }}>Ô tô</option>
                                <option value="motorcycle" {{ old('vehicle_type', $booking->vehicle_type) == 'motorcycle' ? 'selected' : '' }}>Xe máy</option>
                                <option value="bicycle" {{ old('vehicle_type', $booking->vehicle_type) == 'bicycle' ? 'selected' : '' }}>Xe đạp</option>
                            </select>
                            @error('vehicle_type')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="w-full max-w-full px-3 mb-6 md:w-4/12 md:flex-none">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80" for="license_plate">
                                Biển số xe
                            </label>
                            <input type="text" name="license_plate" id="license_plate" value="{{ old('license_plate', $booking->license_plate) }}" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" placeholder="Vd: 30A-123.45">
                            @error('license_plate')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="w-full max-w-full px-3 mb-6 md:w-4/12 md:flex-none">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80" for="status">
                                Trạng thái <span class="text-red-500">*</span>
                            </label>
                            <select name="status" id="status" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" required>
                                <option value="">Chọn trạng thái</option>
                                <option value="pending" {{ old('status', $booking->status) == 'pending' ? 'selected' : '' }}>Chờ xác nhận</option>
                                <option value="confirmed" {{ old('status', $booking->status) == 'confirmed' ? 'selected' : '' }}>Đã xác nhận</option>
                                <option value="active" {{ old('status', $booking->status) == 'active' ? 'selected' : '' }}>Đang hoạt động</option>
                                <option value="completed" {{ old('status', $booking->status) == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                                <option value="cancelled" {{ old('status', $booking->status) == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                            </select>
                            @error('status')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="w-full max-w-full px-3 mb-6">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80" for="notes">
                                Ghi chú
                            </label>
                            <textarea name="notes" id="notes" rows="3" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" placeholder="Nhập ghi chú về booking">{{ old('notes', $booking->notes) }}</textarea>
                            @error('notes')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Price Preview -->
                        <div class="w-full max-w-full px-3 mb-6">
                            <div class="bg-gray-50 rounded-lg p-4">
                                <h6 class="text-md font-semibold text-slate-700 mb-2">Chi tiết giá (hiện tại)</h6>
                                <div class="space-y-2">
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600">Thời gian:</span>
                                        <span class="text-sm font-semibold">{{ $booking->duration_hours }} giờ</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600">Giá/giờ:</span>
                                        <span class="text-sm font-semibold">{{ number_format($booking->parkingLot->hourly_rate, 0, ',', '.') }}đ</span>
                                    </div>
                                    <div class="flex justify-between border-t pt-2">
                                        <span class="text-md font-bold text-slate-700">Tổng tiền hiện tại:</span>
                                        <span class="text-md font-bold text-purple-600">{{ number_format($booking->total_amount, 0, ',', '.') }}đ</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- New Price Preview -->
                        <div class="w-full max-w-full px-3 mb-6">
                            <div class="bg-blue-50 rounded-lg p-4" id="newPricePreview" style="display: none;">
                                <h6 class="text-md font-semibold text-blue-700 mb-2">Chi tiết giá mới</h6>
                                <div class="space-y-2">
                                    <div class="flex justify-between">
                                        <span class="text-sm text-blue-600">Thời gian mới:</span>
                                        <span class="text-sm font-semibold" id="newDurationDisplay">0 giờ</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm text-blue-600">Giá/giờ:</span>
                                        <span class="text-sm font-semibold">{{ number_format($booking->parkingLot->hourly_rate, 0, ',', '.') }}đ</span>
                                    </div>
                                    <div class="flex justify-between border-t pt-2">
                                        <span class="text-md font-bold text-blue-700">Tổng tiền mới:</span>
                                        <span class="text-md font-bold text-blue-600" id="newTotalAmountDisplay">0đ</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('admin.bookings.index') }}" class="inline-block px-6 py-3 mr-3 font-bold text-center text-gray-700 uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer leading-pro text-xs ease-soft-in tracking-tight-soft hover:scale-102 active:opacity-85">
                            Hủy
                        </a>
                        <button type="submit" class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer bg-gradient-to-tl from-green-600 to-lime-400 leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs">
                            <i class="fas fa-save mr-2"></i>Cập nhật
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const startTimeInput = document.getElementById('start_time');
    const endTimeInput = document.getElementById('end_time');
    const newPricePreview = document.getElementById('newPricePreview');
    const newDurationDisplay = document.getElementById('newDurationDisplay');
    const newTotalAmountDisplay = document.getElementById('newTotalAmountDisplay');

    const originalStartTime = new Date('{{ $booking->start_time->format('Y-m-d\TH:i') }}');
    const originalEndTime = new Date('{{ $booking->end_time->format('Y-m-d\TH:i') }}');
    const hourlyRate = {{ $booking->parkingLot->hourly_rate }};

    function updateNewPricePreview() {
        const newStartTime = new Date(startTimeInput.value);
        const newEndTime = new Date(endTimeInput.value);

        // Check if times have changed
        const startChanged = newStartTime.getTime() !== originalStartTime.getTime();
        const endChanged = newEndTime.getTime() !== originalEndTime.getTime();

        if ((startChanged || endChanged) && startTimeInput.value && endTimeInput.value && newEndTime > newStartTime) {
            const diffInMs = newEndTime - newStartTime;
            const diffInHours = Math.ceil(diffInMs / (1000 * 60 * 60));
            const totalAmount = diffInHours * hourlyRate;

            newDurationDisplay.textContent = diffInHours + ' giờ';
            newTotalAmountDisplay.textContent = totalAmount.toLocaleString('vi-VN') + 'đ';
            newPricePreview.style.display = 'block';
        } else {
            newPricePreview.style.display = 'none';
        }
    }

    startTimeInput.addEventListener('change', updateNewPricePreview);
    endTimeInput.addEventListener('change', updateNewPricePreview);

    startTimeInput.addEventListener('change', function() {
        endTimeInput.min = this.value;
        if (endTimeInput.value && endTimeInput.value <= this.value) {
            endTimeInput.value = '';
            updateNewPricePreview();
        }
    });
});
</script>
@endsection
