@extends('admin.layout')
@section('page-title', 'Chi tiết Booking - Paspark Admin')
@section('page-heading', 'Chi tiết Booking')

@section('content')
<div class="flex flex-wrap -mx-3 mb-6">
    <!-- Booking Details Card -->
    <div class="w-full max-w-full px-3 lg:w-8/12 lg:flex-none">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <div class="flex items-center justify-between mb-4">
                    <h6 class="mb-0 dark:text-white">Thông tin chi tiết</h6>
                    <div class="space-x-2">
                        @if($booking->status !== 'completed' && $booking->status !== 'cancelled')
                        <a href="{{ route('admin.bookings.edit', $booking) }}" class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer bg-gradient-to-tl from-orange-500 to-yellow-500 leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs">
                            <i class="fas fa-edit mr-2"></i>Chỉnh sửa
                        </a>
                        @endif
                        <a href="{{ route('admin.bookings.index') }}" class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer bg-gradient-to-tl from-orange-500 to-yellow-500 leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs">
                            <i class="fas fa-arrow-left mr-2"></i>Quay lại
                        </a>
                    </div>
                </div>
            </div>

            <div class="flex-auto p-6">
                <div class="flex flex-wrap -mx-3">
                    <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                        <div class="mb-4">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">ID Booking:</label>
                            <p class="text-sm text-gray-600 dark:text-white/60">#{{ $booking->id }}</p>
                        </div>
                    </div>

                    <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                        <div class="mb-4">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Trạng thái:</label>
                            @if($booking->status === 'pending')
                                <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    Chờ xác nhận
                                </span>
                            @elseif($booking->status === 'confirmed')
                                <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                    Đã xác nhận
                                </span>
                            @elseif($booking->status === 'active')
                                <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                    Đang hoạt động
                                </span>
                            @elseif($booking->status === 'completed')
                                <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                    Hoàn thành
                                </span>
                            @else
                                <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                    Đã hủy
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Customer Information -->
                    <div class="w-full px-3 mb-4">
                        <h6 class="text-lg font-semibold text-slate-700 dark:text-white mb-4">Thông tin khách hàng</h6>
                    </div>

                    <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                        <div class="mb-4">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Họ và tên:</label>
                            <p class="text-sm text-gray-600 dark:text-white/60">{{ $booking->user->name }}</p>
                        </div>
                    </div>

                    <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                        <div class="mb-4">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Email:</label>
                            <p class="text-sm text-gray-600 dark:text-white/60">{{ $booking->user->email }}</p>
                        </div>
                    </div>

                    @if($booking->user->phone)
                    <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                        <div class="mb-4">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Số điện thoại:</label>
                            <p class="text-sm text-gray-600 dark:text-white/60">{{ $booking->user->phone }}</p>
                        </div>
                    </div>
                    @endif

                    <!-- Parking Lot Information -->
                    <div class="w-full px-3 mb-4 mt-6">
                        <h6 class="text-lg font-semibold text-slate-700 dark:text-white mb-4">Thông tin bãi đỗ xe</h6>
                    </div>

                    <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                        <div class="mb-4">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Tên bãi đỗ xe:</label>
                            <p class="text-sm text-gray-600 dark:text-white/60">{{ $booking->parkingLot->name }}</p>
                        </div>
                    </div>



                    <div class="w-full max-w-full px-3 mb-6">
                        <div class="mb-4">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Địa chỉ:</label>
                            <p class="text-sm text-gray-600 dark:text-white/60">{{ $booking->parkingLot->address }}</p>
                        </div>
                    </div>

                    <!-- Booking Details -->
                    <div class="w-full px-3 mb-4 mt-6">
                        <h6 class="text-lg font-semibold text-slate-700 dark:text-white mb-4">Chi tiết booking</h6>
                    </div>

                    <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                        <div class="mb-4">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Thời gian bắt đầu:</label>
                            <p class="text-sm text-gray-600 dark:text-white/60">{{ $booking->start_time->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>

                    <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                        <div class="mb-4">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Thời gian kết thúc:</label>
                            <p class="text-sm text-gray-600 dark:text-white/60">{{ $booking->end_time->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>

                    <div class="w-full max-w-full px-3 mb-6 md:w-4/12 md:flex-none">
                        <div class="mb-4">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Thời gian:</label>
                            <p class="text-lg font-bold text-blue-600">{{ $booking->duration_hours }} giờ</p>
                        </div>
                    </div>

                    <div class="w-full max-w-full px-3 mb-6 md:w-4/12 md:flex-none">
                        <div class="mb-4">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Giá/giờ:</label>
                            <p class="text-lg font-bold text-green-600">{{ number_format($booking->parkingLot->hourly_rate, 0, ',', '.') }}đ</p>
                        </div>
                    </div>

                    <div class="w-full max-w-full px-3 mb-6 md:w-4/12 md:flex-none">
                        <div class="mb-4">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Tổng tiền:</label>
                            <p class="text-lg font-bold text-purple-600">{{ number_format($booking->total_cost, 0, ',', '.') }}đ</p>
                        </div>
                    </div>

                    @if($booking->vehicle_type)
                    <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                        <div class="mb-4">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Loại xe:</label>
                            <p class="text-sm text-gray-600 dark:text-white/60">
                                @if($booking->vehicle_type === 'car')
                                    Ô tô
                                @elseif($booking->vehicle_type === 'motorcycle')
                                    Xe máy
                                @elseif($booking->vehicle_type === 'bicycle')
                                    Xe đạp
                                @else
                                    {{ $booking->vehicle_type }}
                                @endif
                            </p>
                        </div>
                    </div>
                    @endif

                    @if($booking->license_plate)
                    <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                        <div class="mb-4">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Biển số xe:</label>
                            <p class="text-sm text-gray-600 dark:text-white/60">{{ $booking->license_plate }}</p>
                        </div>
                    </div>
                    @endif

                    @if($booking->notes)
                    <div class="w-full max-w-full px-3 mb-6">
                        <div class="mb-4">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Ghi chú:</label>
                            <p class="text-sm text-gray-600 dark:text-white/60">{{ $booking->notes }}</p>
                        </div>
                    </div>
                    @endif

                    <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                        <div class="mb-4">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Ngày tạo:</label>
                            <p class="text-sm text-gray-600 dark:text-white/60">{{ $booking->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>

                    <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                        <div class="mb-4">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Cập nhật cuối:</label>
                            <p class="text-sm text-gray-600 dark:text-white/60">{{ $booking->updated_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Information -->
    <div class="w-full max-w-full px-3 lg:w-4/12 lg:flex-none">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border mb-6">
            <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6 class="mb-0 dark:text-white">Thông tin thanh toán</h6>
            </div>

            <div class="flex-auto p-6">
                @if($booking->payment)
                    <div class="mb-4">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-semibold text-slate-700 dark:text-white/80">Trạng thái thanh toán:</span>
                            @if($booking->payment->payment_status === 'completed')
                                <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                    Đã thanh toán
                                </span>
                            @elseif($booking->payment->payment_status === 'pending')
                                <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    Chờ thanh toán
                                </span>
                            @else
                                <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                    Thất bại
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-semibold text-slate-700 dark:text-white/80">Phương thức:</span>
                            <span class="text-sm text-gray-600 dark:text-white/60">
                                @if($booking->payment->payment_method === 'vnpay')
                                    VNPay
                                @elseif($booking->payment->payment_method === 'momo')
                                    MoMo
                                @elseif($booking->payment->payment_method === 'cash')
                                    Tiền mặt
                                @else
                                    {{ ucfirst($booking->payment->payment_method) }}
                                @endif
                            </span>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-semibold text-slate-700 dark:text-white/80">Số tiền:</span>
                            <span class="text-lg font-bold text-purple-600">{{ number_format($booking->payment->amount, 0, ',', '.') }}đ</span>
                        </div>
                    </div>

                    @if($booking->payment->transaction_id)
                    <div class="mb-4">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-semibold text-slate-700 dark:text-white/80">Mã giao dịch:</span>
                            <span class="text-xs text-gray-600 dark:text-white/60">{{ $booking->payment->transaction_id }}</span>
                        </div>
                    </div>
                    @endif

                    @if($booking->payment->paid_at)
                    <div class="mb-4">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-semibold text-slate-700 dark:text-white/80">Ngày thanh toán:</span>
                            <span class="text-sm text-gray-600 dark:text-white/60">{{ $booking->payment->paid_at->format('d/m/Y H:i') }}</span>
                        </div>
                    </div>
                    @endif
                @else
                    <div class="text-center py-8">
                        <i class="fas fa-credit-card text-4xl text-gray-300 mb-4"></i>
                        <p class="text-sm text-gray-500">Chưa có thông tin thanh toán</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Quick Actions -->
        @if($booking->status !== 'completed' && $booking->status !== 'cancelled')
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6 class="mb-0 dark:text-white">Thao tác nhanh</h6>
            </div>

            <div class="flex-auto p-6">
                <div class="space-y-3">
                    @if($booking->status === 'pending')
                    <form method="POST" action="{{ route('admin.bookings.update-status', $booking) }}" class="w-full mb-2">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="confirmed">
                        <button type="submit" class="w-full px-4 py-2 text-sm font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer bg-gradient-to-tl from-red-600 to-rose-400 leading-pro ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs">
                            <i class="fas fa-check mr-2"></i>Xác nhận booking
                        </button>
                    </form>
                    @endif

                    @if($booking->status === 'confirmed')
                    <form method="POST" action="{{ route('admin.bookings.update-status', $booking) }}" class="w-full mb-2">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="completed">
                        <button type="submit" class="w-full px-4 py-2 text-sm font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer bg-gradient-to-tl from-red-600 to-rose-400 leading-pro ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs">
                            <i class="fas fa-stop mr-2"></i>Hoàn thành
                        </button>
                    </form>
                    @endif

                    @if(in_array($booking->status, ['pending', 'confirmed']))
                    <form method="POST" action="{{ route('admin.bookings.update-status', $booking) }}" class="w-full mb-2" onsubmit="return confirm('Bạn có chắc chắn muốn hủy booking này?')">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="cancelled">
                        <button type="submit" class="w-full px-4 py-2 text-sm font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer bg-gradient-to-tl from-red-600 to-rose-400 leading-pro ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs">
                            <i class="fas fa-times mr-2"></i>Hủy booking
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
