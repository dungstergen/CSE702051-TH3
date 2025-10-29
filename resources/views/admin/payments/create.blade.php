@extends('admin.layout')
@section('page-title', 'Thêm Thanh toán - Paspark Admin')
@section('page-heading', 'Thêm Thanh toán')

@section('content')
<div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <div class="flex items-center justify-between mb-4">
                    <h6 class="mb-0 dark:text-white">Thêm Thanh toán mới</h6>
                    <a href="{{ route('admin.payments.index') }}" class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer bg-gradient-to-tl from-orange-500 to-yellow-500 leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs">
                        <i class="fas fa-arrow-left mr-2"></i>Quay lại
                    </a>
                </div>
            </div>

            <div class="flex-auto p-6">
                <form method="POST" action="{{ route('admin.payments.store') }}">
                    @csrf
                    <div class="flex flex-wrap -mx-3">
                        <!-- Booking Selection -->
                        <div class="w-full px-3 mb-4">
                            <h6 class="text-lg font-semibold text-slate-700 dark:text-white mb-4">Thông tin booking</h6>
                        </div>

                        <div class="w-full max-w-full px-3 mb-6">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80" for="booking_id">
                                Booking <span class="text-red-500">*</span>
                            </label>
                            <select name="booking_id" id="booking_id" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" required>
                                <option value="">Chọn booking cần thanh toán</option>
                                @foreach($unpaidBookings as $booking)
                                    <option value="{{ $booking->id }}" data-amount="{{ $booking->total_cost }}" {{ old('booking_id') == $booking->id ? 'selected' : '' }}>
                                        #{{ $booking->id }} - {{ $booking->user->name }} - {{ $booking->parkingLot->name }} - {{ number_format($booking->total_cost, 0, ',', '.') }}đ
                                    </option>
                                @endforeach
                            </select>
                            @error('booking_id')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Payment Details -->
                        <div class="w-full px-3 mb-4">
                            <h6 class="text-lg font-semibold text-slate-700 dark:text-white mb-4">Chi tiết thanh toán</h6>
                        </div>

                        <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80" for="amount">
                                Số tiền <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="amount" id="amount" value="{{ old('amount') }}" min="0" step="1000" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" placeholder="Số tiền thanh toán" required>
                            @error('amount')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80" for="payment_method">
                                Phương thức thanh toán <span class="text-red-500">*</span>
                            </label>
                            <select name="payment_method" id="payment_method" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" required>
                                <option value="">Chọn phương thức</option>
                                <option value="credit_card" {{ old('payment_method') == 'credit_card' ? 'selected' : '' }}>Thẻ tín dụng</option>
                                <option value="bank_transfer" {{ old('payment_method') == 'bank_transfer' ? 'selected' : '' }}>Chuyển khoản ngân hàng</option>
                                <option value="e_wallet" {{ old('payment_method') == 'e_wallet' ? 'selected' : '' }}>Ví điện tử</option>
                                <option value="cash" {{ old('payment_method') == 'cash' ? 'selected' : '' }}>Thanh toán tại chỗ</option>
                            </select>
                            @error('payment_method')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80" for="transaction_id">
                                Mã giao dịch
                            </label>
                            <input type="text" name="transaction_id" id="transaction_id" value="{{ old('transaction_id') }}" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" placeholder="Mã giao dịch (nếu có)">
                            @error('transaction_id')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80" for="payment_status">
                                Trạng thái <span class="text-red-500">*</span>
                            </label>
                            <select name="payment_status" id="payment_status" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" required>
                                <option value="">Chọn trạng thái</option>
                                <option value="pending" {{ old('payment_status', 'pending') == 'pending' ? 'selected' : '' }}>Chờ thanh toán</option>
                                <option value="completed" {{ old('payment_status') == 'completed' ? 'selected' : '' }}>Đã thanh toán</option>
                                <option value="failed" {{ old('payment_status') == 'failed' ? 'selected' : '' }}>Thất bại</option>
                            </select>
                            @error('payment_status')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80" for="paid_at">
                                Ngày thanh toán
                            </label>
                            <input type="datetime-local" name="paid_at" id="paid_at" value="{{ old('paid_at') }}" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow">
                            @error('paid_at')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                            <p class="text-xs text-gray-500 mt-1">Chỉ cần điền nếu trạng thái là "Đã thanh toán"</p>
                        </div>

                        <div class="w-full max-w-full px-3 mb-6">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80" for="notes">
                                Ghi chú
                            </label>
                            <textarea name="notes" id="notes" rows="3" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" placeholder="Ghi chú về thanh toán">{{ old('notes') }}</textarea>
                            @error('notes')
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
                        <a href="{{ route('admin.payments.index') }}" class="inline-block px-6 py-3 mr-3 font-bold text-center text-gray-700 uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer leading-pro text-xs ease-soft-in tracking-tight-soft hover:scale-102 active:opacity-85">
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
    const bookingSelect = document.getElementById('booking_id');
    const amountInput = document.getElementById('amount');
    const statusSelect = document.getElementById('payment_status');
    const paidAtInput = document.getElementById('paid_at');
    const bookingPreview = document.getElementById('bookingPreview');

    bookingSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const amount = selectedOption.dataset.amount;

        if (amount) {
            amountInput.value = amount;
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
                    <div class="flex justify-between border-t pt-2">
                        <span class="text-md font-bold text-blue-700">Số tiền cần thanh toán:</span>
                        <span class="text-md font-bold text-blue-600">${parts[3]}</span>
                    </div>
                </div>
            `;
        } else {
            amountInput.value = '';
            bookingPreview.style.display = 'none';
        }
    });

    statusSelect.addEventListener('change', function() {
        if (this.value === 'completed' && !paidAtInput.value) {
            // Auto-set current datetime if status is completed
            const now = new Date();
            const year = now.getFullYear();
            const month = String(now.getMonth() + 1).padStart(2, '0');
            const day = String(now.getDate()).padStart(2, '0');
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            paidAtInput.value = `${year}-${month}-${day}T${hours}:${minutes}`;
        } else if (this.value !== 'completed') {
            paidAtInput.value = '';
        }
    });
});
</script>
@endsection
