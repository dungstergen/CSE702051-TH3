@extends('admin.layout')
@section('page-title', 'Thêm Đánh giá - Paspark Admin')
@section('page-heading', 'Thêm Đánh giá')

@section('content')
<div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <div class="flex items-center justify-between mb-4">
                    <h6 class="mb-0 dark:text-white">Thêm Đánh giá mới</h6>
                    <a href="{{ route('admin.reviews.index') }}" class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer bg-gradient-to-tl from-gray-600 to-gray-400 leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs">
                        <i class="fas fa-arrow-left mr-2"></i>Quay lại
                    </a>
                </div>
            </div>

            <div class="flex-auto p-6">
                <form method="POST" action="{{ route('admin.reviews.store') }}">
                    @csrf
                    <div class="flex flex-wrap -mx-3">
                        <!-- Customer and Parking Lot Selection -->
                        <div class="w-full px-3 mb-4">
                            <h6 class="text-lg font-semibold text-slate-700 dark:text-white mb-4">Thông tin cơ bản</h6>
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
                                    <option value="{{ $lot->id }}" {{ old('parking_lot_id') == $lot->id ? 'selected' : '' }}>
                                        {{ $lot->name }} - {{ $lot->city }}
                                    </option>
                                @endforeach
                            </select>
                            @error('parking_lot_id')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80" for="booking_id">
                                Booking (tuỳ chọn)
                            </label>
                            <select name="booking_id" id="booking_id" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow">
                                <option value="">Chọn booking (nếu có)</option>
                                @foreach($completedBookings as $booking)
                                    <option value="{{ $booking->id }}" data-user="{{ $booking->user_id }}" data-parking-lot="{{ $booking->parking_lot_id }}" {{ old('booking_id') == $booking->id ? 'selected' : '' }}>
                                        #{{ $booking->id }} - {{ $booking->user->name }} - {{ $booking->parkingLot->name }} ({{ $booking->start_time->format('d/m/Y') }})
                                    </option>
                                @endforeach
                            </select>
                            @error('booking_id')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Rating and Review -->
                        <div class="w-full px-3 mb-4">
                            <h6 class="text-lg font-semibold text-slate-700 dark:text-white mb-4">Đánh giá</h6>
                        </div>

                        <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80" for="rating">
                                Số sao <span class="text-red-500">*</span>
                            </label>
                            <div class="flex items-center space-x-2 mb-2">
                                <div class="flex items-center" id="starRating">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star text-2xl cursor-pointer text-gray-300 hover:text-yellow-500 transition-colors"
                                           data-rating="{{ $i }}"
                                           id="star-{{ $i }}"></i>
                                    @endfor
                                </div>
                                <span class="text-sm font-semibold text-gray-600" id="ratingText">Chọn số sao</span>
                            </div>
                            <input type="hidden" name="rating" id="rating" value="{{ old('rating') }}" required>
                            @error('rating')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="w-full max-w-full px-3 mb-6">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80" for="comment">
                                Bình luận
                            </label>
                            <textarea name="comment" id="comment" rows="4" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" placeholder="Nhập bình luận về bãi đỗ xe">{{ old('comment') }}</textarea>
                            @error('comment')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Booking Preview -->
                        <div class="w-full max-w-full px-3 mb-6" id="bookingPreview" style="display: none;">
                            <div class="bg-blue-50 rounded-lg p-4">
                                <h6 class="text-md font-semibold text-blue-700 mb-2">Thông tin booking</h6>
                                <div id="bookingDetails">
                                    <!-- Booking details will be populated by JavaScript -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('admin.reviews.index') }}" class="inline-block px-6 py-3 mr-3 font-bold text-center text-gray-700 uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer leading-pro text-xs ease-soft-in tracking-tight-soft hover:scale-102 active:opacity-85">
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
    const stars = document.querySelectorAll('#starRating i');
    const ratingInput = document.getElementById('rating');
    const ratingText = document.getElementById('ratingText');
    const bookingSelect = document.getElementById('booking_id');
    const userSelect = document.getElementById('user_id');
    const parkingLotSelect = document.getElementById('parking_lot_id');
    const bookingPreview = document.getElementById('bookingPreview');

    // Star rating functionality
    stars.forEach(star => {
        star.addEventListener('click', function() {
            const rating = parseInt(this.dataset.rating);
            ratingInput.value = rating;

            // Update star colors
            stars.forEach((s, index) => {
                if (index < rating) {
                    s.classList.remove('text-gray-300');
                    s.classList.add('text-yellow-500');
                } else {
                    s.classList.remove('text-yellow-500');
                    s.classList.add('text-gray-300');
                }
            });

            // Update rating text
            const ratingTexts = ['', 'Rất tệ', 'Tệ', 'Bình thường', 'Tốt', 'Rất tốt'];
            ratingText.textContent = `${rating} sao - ${ratingTexts[rating]}`;
        });

        star.addEventListener('mouseover', function() {
            const rating = parseInt(this.dataset.rating);
            stars.forEach((s, index) => {
                if (index < rating) {
                    s.classList.add('text-yellow-400');
                } else {
                    s.classList.remove('text-yellow-400');
                }
            });
        });

        star.addEventListener('mouseout', function() {
            stars.forEach(s => {
                s.classList.remove('text-yellow-400');
            });
        });
    });

    // Set initial rating if old value exists
    const oldRating = {{ old('rating', 0) }};
    if (oldRating > 0) {
        stars.forEach((s, index) => {
            if (index < oldRating) {
                s.classList.remove('text-gray-300');
                s.classList.add('text-yellow-500');
            }
        });
        const ratingTexts = ['', 'Rất tệ', 'Tệ', 'Bình thường', 'Tốt', 'Rất tốt'];
        ratingText.textContent = `${oldRating} sao - ${ratingTexts[oldRating]}`;
    }

    // Booking selection functionality
    bookingSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];

        if (selectedOption.value) {
            const userId = selectedOption.dataset.user;
            const parkingLotId = selectedOption.dataset.parkingLot;

            // Auto-select user and parking lot
            userSelect.value = userId;
            parkingLotSelect.value = parkingLotId;

            // Show booking preview
            bookingPreview.style.display = 'block';

            // Extract booking info from option text
            const optionText = selectedOption.text;
            const parts = optionText.split(' - ');

            document.getElementById('bookingDetails').innerHTML = `
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span class="text-sm text-blue-600">Booking ID:</span>
                        <span class="text-sm font-semibold">${parts[0]}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-blue-600">Khách hàng:</span>
                        <span class="text-sm font-semibold">${parts[1]}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-blue-600">Bãi đỗ xe:</span>
                        <span class="text-sm font-semibold">${parts[2]}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-blue-600">Ngày:</span>
                        <span class="text-sm font-semibold">${parts[3].replace('(', '').replace(')', '')}</span>
                    </div>
                </div>
            `;
        } else {
            bookingPreview.style.display = 'none';
        }
    });

    // Filter bookings based on selected user and parking lot
    function filterBookings() {
        const selectedUserId = userSelect.value;
        const selectedParkingLotId = parkingLotSelect.value;

        Array.from(bookingSelect.options).forEach(option => {
            if (option.value === '') return; // Keep the default option

            const optionUserId = option.dataset.user;
            const optionParkingLotId = option.dataset.parkingLot;

            const userMatch = !selectedUserId || optionUserId === selectedUserId;
            const parkingLotMatch = !selectedParkingLotId || optionParkingLotId === selectedParkingLotId;

            option.style.display = (userMatch && parkingLotMatch) ? 'block' : 'none';
        });

        // Reset booking selection if current selection is no longer valid
        const currentBookingOption = bookingSelect.options[bookingSelect.selectedIndex];
        if (currentBookingOption && currentBookingOption.style.display === 'none') {
            bookingSelect.value = '';
            bookingPreview.style.display = 'none';
        }
    }

    userSelect.addEventListener('change', filterBookings);
    parkingLotSelect.addEventListener('change', filterBookings);
});
</script>
@endsection
