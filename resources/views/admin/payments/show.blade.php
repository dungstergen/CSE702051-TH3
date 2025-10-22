@extends('admin.layout')
@section('page-title', 'Chi tiết Thanh toán - Paspark Admin')
@section('page-heading', 'Chi tiết Thanh toán')

@section('content')
<div class="flex flex-wrap -mx-3 mb-6">
    <!-- Payment Details Card -->
    <div class="w-full max-w-full px-3 lg:w-8/12 lg:flex-none">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <div class="flex items-center justify-between mb-4">
                    <h6 class="mb-0 dark:text-white">Chi tiết thanh toán</h6>
                    <div class="space-x-2">
                        @if($payment->status !== 'completed' && $payment->status !== 'refunded')
                        <a href="{{ route('admin.payments.edit', $payment) }}" class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer bg-gradient-to-tl from-orange-500 to-yellow-500 leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs">
                            <i class="fas fa-edit mr-2"></i>Chỉnh sửa
                        </a>
                        @endif
                        <a href="{{ route('admin.payments.index') }}" class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer bg-gradient-to-tl from-orange-500 to-yellow-500 leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs">
                            <i class="fas fa-arrow-left mr-2"></i>Quay lại
                        </a>
                    </div>
                </div>
            </div>

            <div class="flex-auto p-6">
                <div class="flex flex-wrap -mx-3">
                    <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                        <div class="mb-4">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">ID Thanh toán:</label>
                            <p class="text-sm text-gray-600 dark:text-white/60">#{{ $payment->id }}</p>
                        </div>
                    </div>

                    <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                        <div class="mb-4">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Trạng thái:</label>
                            @if($payment->status === 'pending')
                                <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    Chờ thanh toán
                                </span>
                            @elseif($payment->status === 'completed')
                                <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                    Đã thanh toán
                                </span>
                            @elseif($payment->status === 'failed')
                                <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                    Thất bại
                                </span>
                            @else
                                <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                    Đã hoàn tiền
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Payment Information -->
                    <div class="w-full px-3 mb-4">
                        <h6 class="text-lg font-semibold text-slate-700 dark:text-white mb-4">Thông tin thanh toán</h6>
                    </div>

                    <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                        <div class="mb-4">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Số tiền:</label>
                            <p class="text-lg font-bold text-purple-600">{{ number_format($payment->amount, 0, ',', '.') }}đ</p>
                        </div>
                    </div>

                    <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                        <div class="mb-4">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Phương thức:</label>
                            <p class="text-sm text-gray-600 dark:text-white/60">
                                @if($payment->payment_method === 'vnpay')
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        <i class="fab fa-cc-visa mr-1"></i> VNPay
                                    </span>
                                @elseif($payment->payment_method === 'momo')
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-pink-100 text-pink-800">
                                        <i class="fas fa-mobile-alt mr-1"></i> MoMo
                                    </span>
                                @elseif($payment->payment_method === 'cash')
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-money-bill mr-1"></i> Tiền mặt
                                    </span>
                                @elseif($payment->payment_method === 'bank_transfer')
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                        <i class="fas fa-university mr-1"></i> Chuyển khoản
                                    </span>
                                @else
                                    {{ ucfirst($payment->payment_method) }}
                                @endif
                            </p>
                        </div>
                    </div>

                    @if($payment->transaction_id)
                    <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                        <div class="mb-4">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Mã giao dịch:</label>
                            <p class="text-sm text-gray-600 dark:text-white/60 font-mono">{{ $payment->transaction_id }}</p>
                        </div>
                    </div>
                    @endif

                    <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                        <div class="mb-4">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Ngày tạo:</label>
                            <p class="text-sm text-gray-600 dark:text-white/60">{{ $payment->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>

                    @if($payment->paid_at)
                    <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                        <div class="mb-4">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Ngày thanh toán:</label>
                            <p class="text-sm text-gray-600 dark:text-white/60">{{ $payment->paid_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                    @endif

                    @if($payment->notes)
                    <div class="w-full max-w-full px-3 mb-6">
                        <div class="mb-4">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Ghi chú:</label>
                            <p class="text-sm text-gray-600 dark:text-white/60">{{ $payment->notes }}</p>
                        </div>
                    </div>
                    @endif

                    <!-- Booking Information -->
                    <div class="w-full px-3 mb-4 mt-6">
                        <h6 class="text-lg font-semibold text-slate-700 dark:text-white mb-4">Thông tin booking</h6>
                    </div>

                    <div class="w-full max-w-full px-3 mb-6">
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="flex flex-wrap -mx-2">
                                <div class="w-full md:w-1/2 px-2 mb-4">
                                    <label class="mb-1 font-bold text-xs text-slate-700">Booking ID:</label>
                                    <p class="text-sm">
                                        <a href="{{ route('admin.bookings.show', $payment->booking) }}" class="text-blue-600 hover:text-blue-800 font-semibold">
                                            #{{ $payment->booking->id }}
                                        </a>
                                    </p>
                                </div>
                                <div class="w-full md:w-1/2 px-2 mb-4">
                                    <label class="mb-1 font-bold text-xs text-slate-700">Khách hàng:</label>
                                    <p class="text-sm">{{ $payment->booking->user->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $payment->booking->user->email }}</p>
                                </div>
                                <div class="w-full md:w-1/2 px-2 mb-4">
                                    <label class="mb-1 font-bold text-xs text-slate-700">Bãi đỗ xe:</label>
                                    <p class="text-sm">{{ $payment->booking->parkingLot->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $payment->booking->parkingLot->address }}</p>
                                </div>
                                <div class="w-full md:w-1/2 px-2 mb-4">
                                    <label class="mb-1 font-bold text-xs text-slate-700">Thời gian:</label>
                                    <p class="text-sm">{{ $payment->booking->start_time->format('d/m/Y H:i') }}</p>
                                    <p class="text-xs text-gray-500">đến {{ $payment->booking->end_time->format('d/m/Y H:i') }}</p>
                                </div>
                                <div class="w-full md:w-1/2 px-2 mb-4">
                                    <label class="mb-1 font-bold text-xs text-slate-700">Tổng tiền booking:</label>
                                    <p class="text-sm font-semibold">{{ number_format($payment->booking->total_amount, 0, ',', '.') }}đ</p>
                                </div>
                                <div class="w-full md:w-1/2 px-2 mb-4">
                                    <label class="mb-1 font-bold text-xs text-slate-700">Trạng thái booking:</label>
                                    <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full
                                        {{ $payment->booking->status === 'completed' ? 'bg-gray-100 text-gray-800' :
                                           ($payment->booking->status === 'active' ? 'bg-green-100 text-green-800' :
                                           ($payment->booking->status === 'confirmed' ? 'bg-blue-100 text-blue-800' :
                                           ($payment->booking->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800'))) }}">
                                        {{ ucfirst($payment->booking->status) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                        <div class="mb-4">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Cập nhật cuối:</label>
                            <p class="text-sm text-gray-600 dark:text-white/60">{{ $payment->updated_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="w-full max-w-full px-3 lg:w-4/12 lg:flex-none">
        @if($payment->status !== 'completed' && $payment->status !== 'refunded')
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border mb-6">
            <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6 class="mb-0 dark:text-white">Thao tác nhanh</h6>
            </div>

            <div class="flex-auto p-6">
                <div class="space-y-3">
                    @if($payment->status === 'pending')
                    <form method="POST" action="{{ route('admin.payments.update', $payment) }}" class="w-full">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="completed">
                        <input type="hidden" name="paid_at" value="{{ now()->format('Y-m-d\TH:i') }}">
                        <button type="submit" class="w-full px-4 py-2 text-sm font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer bg-gradient-to-tl from-green-600 to-lime-400 leading-pro ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs">
                            <i class="fas fa-check mr-2"></i>Xác nhận thanh toán
                        </button>
                    </form>

                    <form method="POST" action="{{ route('admin.payments.update', $payment) }}" class="w-full" onsubmit="return confirm('Bạn có chắc chắn thanh toán này thất bại?')">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="failed">
                        <button type="submit" class="w-full px-4 py-2 text-sm font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer bg-gradient-to-tl from-red-600 to-rose-400 leading-pro ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs">
                            <i class="fas fa-times mr-2"></i>Đánh dấu thất bại
                        </button>
                    </form>
                    @endif

                    @if($payment->status === 'completed')
                    <form method="POST" action="{{ route('admin.payments.update', $payment) }}" class="w-full" onsubmit="return confirm('Bạn có chắc chắn muốn hoàn tiền?')">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="refunded">
                        <button type="submit" class="w-full px-4 py-2 text-sm font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer bg-gradient-to-tl from-blue-600 to-cyan-400 leading-pro ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs">
                            <i class="fas fa-undo mr-2"></i>Hoàn tiền
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
        @endif

        <!-- Payment Statistics -->
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6 class="mb-0 dark:text-white">Thống kê khách hàng</h6>
            </div>

            <div class="flex-auto p-6">
                <div class="mb-4">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-semibold text-slate-700 dark:text-white/80">Tổng booking:</span>
                        <span class="text-lg font-bold text-blue-600">{{ $payment->booking->user->bookings->count() }}</span>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-semibold text-slate-700 dark:text-white/80">Tổng thanh toán:</span>
                        <span class="text-lg font-bold text-green-600">{{ number_format($payment->booking->user->payments->sum('amount'), 0, ',', '.') }}đ</span>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-semibold text-slate-700 dark:text-white/80">TT thành công:</span>
                        <span class="text-lg font-bold text-purple-600">{{ $payment->booking->user->payments->where('status', 'completed')->count() }}</span>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-semibold text-slate-700 dark:text-white/80">Khách hàng từ:</span>
                        <span class="text-sm text-gray-600 dark:text-white/60">{{ $payment->booking->user->created_at->format('d/m/Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
