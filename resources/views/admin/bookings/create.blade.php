@extends('admin.layout')
@section('page-title', 'Thêm Booking - Paspark Admin')
@section('page-heading', 'Thêm Booking')

@section('content')
<div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <div class="flex items-center justify-between mb-4">
                    <h6 class="mb-0 dark:text-white">Thêm Booking mới</h6>
                    <a href="{{ route('admin.bookings.index') }}" class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer bg-gradient-to-tl from-gray-600 to-gray-400 leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs">
                        <i class="fas fa-arrow-left mr-2"></i>Quay lại
                    </a>
                </div>
            </div>

            <div class="flex-auto p-6">
                <form method="POST" action="{{ route('admin.bookings.store') }}">
                    @csrf
                    <div class="flex flex-wrap -mx-3">
                        <!-- Customer Selection -->
                        <div class="w-full px-3 mb-4">
                            <h6 class="text-lg font-semibold text-slate-700 dark:text-white mb-4">Thông tin khách hàng</h6>
                        </div>

                        <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80" for="user_id">
                                Khách hàng <span class="text-red-500">*</span>
                            </label>
                            <select name="user_id" id="user_id" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" required>
                                <option value="">Chọn khách hàng</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }} ({{ $user->email }})
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80" for="parking_lot_id">
                                Bãi đỗ xe <span class="text-red-500">*</span>
                            </label>
                            <select name="parking_lot_id" id="parking_lot_id" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" required>
                                <option value="">Chọn bãi đỗ xe</option>
                                @foreach($parkingLots as $lot)
                                    <option value="{{ $lot->id }}" data-rate="{{ $lot->hourly_rate }}" {{ old('parking_lot_id') == $lot->id ? 'selected' : '' }}>
                                        {{ $lot->name }} - {{ $lot->city }} ({{ number_format($lot->hourly_rate, 0, ',', '.') }}đ/giờ)
                                    </option>
                                @endforeach
                            </select>
                            @error('parking_lot_id')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Booking Time -->
                        <div class="w-full px-3 mb-4">
                            <h6 class="text-lg font-semibold text-slate-700 dark:text-white mb-4">Thời gian đặt chỗ</h6>
                        </div>

                        <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80" for="start_time">
                                Thời gian bắt đầu <span class="text-red-500">*</span>
                            </label>
                            <input type="datetime-local" name="start_time" id="start_time" value="{{ old('start_time') }}" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" required>
                            @error('start_time')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80" for="end_time">
                                Thời gian kết thúc <span class="text-red-500">*</span>
                            </label>
                            <input type="datetime-local" name="end_time" id="end_time" value="{{ old('end_time') }}" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" required>
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
                                <option value="car" {{ old('vehicle_type') == 'car' ? 'selected' : '' }}>Ô tô</option>
                                <option value="motorcycle" {{ old('vehicle_type') == 'motorcycle' ? 'selected' : '' }}>Xe máy</option>
                                <option value="bicycle" {{ old('vehicle_type') == 'bicycle' ? 'selected' : '' }}>Xe đạp</option>
                            </select>
                            @error('vehicle_type')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="w-full max-w-full px-3 mb-6 md:w-4/12 md:flex-none">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80" for="license_plate">
                                Biển số xe
                            </label>
                            <input type="text" name="license_plate" id="license_plate" value="{{ old('license_plate') }}" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" placeholder="Vd: 30A-123.45">
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
                                <option value="pending" {{ old('status', 'pending') == 'pending' ? 'selected' : '' }}>Chờ xác nhận</option>
                                <option value="confirmed" {{ old('status') == 'confirmed' ? 'selected' : '' }}>Đã xác nhận</option>
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Đang hoạt động</option>
                                <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                                <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                            </select>
                            @error('status')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="w-full max-w-full px-3 mb-6">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80" for="notes">
                                Ghi chú
                            </label>
                            <textarea name="notes" id="notes" rows="3" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" placeholder="Nhập ghi chú về booking">{{ old('notes') }}</textarea>
                            @error('notes')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Price Preview -->
                        <div class="w-full max-w-full px-3 mb-6">
                            <div class="bg-gray-50 rounded-lg p-4">
                                <h6 class="text-md font-semibold text-slate-700 mb-2">Chi tiết giá</h6>
                                <div class="space-y-2">
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600">Thời gian:</span>
                                        <span class="text-sm font-semibold" id="durationDisplay">0 giờ</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600">Giá/giờ:</span>
                                        <span class="text-sm font-semibold" id="hourlyRateDisplay">0đ</span>
                                    </div>
                                    <div class="flex justify-between border-t pt-2">
                                        <span class="text-md font-bold text-slate-700">Tổng tiền:</span>
                                        <span class="text-md font-bold text-purple-600" id="totalAmountDisplay">0đ</span>
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
                            <i class="fas fa-save mr-2"></i>Lưu
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const parkingLotSelect = document.getElementById('parking_lot_id');
    const startTimeInput = document.getElementById('start_time');
    const endTimeInput = document.getElementById('end_time');
    const hourlyRateDisplay = document.getElementById('hourlyRateDisplay');
    const durationDisplay = document.getElementById('durationDisplay');
    const totalAmountDisplay = document.getElementById('totalAmountDisplay');

    function updatePricePreview() {
        const selectedOption = parkingLotSelect.options[parkingLotSelect.selectedIndex];
        const hourlyRate = selectedOption.dataset.rate || 0;
        const startTime = new Date(startTimeInput.value);
        const endTime = new Date(endTimeInput.value);

        hourlyRateDisplay.textContent = parseFloat(hourlyRate).toLocaleString('vi-VN') + 'đ';

        if (startTimeInput.value && endTimeInput.value && endTime > startTime) {
            const diffInMs = endTime - startTime;
            const diffInHours = Math.ceil(diffInMs / (1000 * 60 * 60));
            const totalAmount = diffInHours * parseFloat(hourlyRate);

            durationDisplay.textContent = diffInHours + ' giờ';
            totalAmountDisplay.textContent = totalAmount.toLocaleString('vi-VN') + 'đ';
        } else {
            durationDisplay.textContent = '0 giờ';
            totalAmountDisplay.textContent = '0đ';
        }
    }

    parkingLotSelect.addEventListener('change', updatePricePreview);
    startTimeInput.addEventListener('change', updatePricePreview);
    endTimeInput.addEventListener('change', updatePricePreview);

    // Set minimum datetime to now
    const now = new Date();
    const year = now.getFullYear();
    const month = String(now.getMonth() + 1).padStart(2, '0');
    const day = String(now.getDate()).padStart(2, '0');
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');
    const nowString = `${year}-${month}-${day}T${hours}:${minutes}`;

    startTimeInput.min = nowString;
    endTimeInput.min = nowString;

    startTimeInput.addEventListener('change', function() {
        endTimeInput.min = this.value;
        if (endTimeInput.value && endTimeInput.value <= this.value) {
            endTimeInput.value = '';
        }
    });
});
</script>
@endsection
