@extends('admin.layout')
@section('page-title', 'Chi tiết Bãi đỗ xe - Paspark Admin')
@section('page-heading', 'Chi tiết Bãi đỗ xe')

@section('content')
<div class="flex flex-wrap -mx-3 mb-6">
    <!-- Parking Lot Details Card -->
    <div class="w-full max-w-full px-3 lg:w-8/12 lg:flex-none">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <div class="flex items-center justify-between mb-4">
                    <h6 class="mb-0 dark:text-white">Thông tin chi tiết</h6>
                    <div class="space-x-2">
                        <a href="{{ route('admin.parking-lots.edit', $parkingLot) }}" class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer bg-gradient-to-tl from-orange-500 to-yellow-500 leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs">
                            <i class="fas fa-edit mr-2"></i>Chỉnh sửa
                        </a>
                        <a href="{{ route('admin.parking-lots.index') }}" class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer bg-gradient-to-tl from-orange-500 to-yellow-500 leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs">
                            <i class="fas fa-arrow-left mr-2"></i>Quay lại
                        </a>
                    </div>
                </div>
            </div>

            <div class="flex-auto p-6">
                <div class="flex flex-wrap -mx-3">
                    <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                        <div class="mb-4">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">ID bãi đỗ xe:</label>
                            <p class="text-sm text-gray-600 dark:text-white/60">#{{ $parkingLot->id }}</p>
                        </div>
                    </div>

                    <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                        <div class="mb-4">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Trạng thái:</label>
                            @if($parkingLot->status === 'active')
                                <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                    Hoạt động
                                </span>
                            @elseif($parkingLot->status === 'inactive')
                                <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                    Không hoạt động
                                </span>
                            @else
                                <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    Bảo trì
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                        <div class="mb-4">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Tên bãi đỗ xe:</label>
                            <p class="text-sm text-gray-600 dark:text-white/60">{{ $parkingLot->name }}</p>
                        </div>
                    </div>

                    <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                        <div class="mb-4">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Thành phố:</label>
                            <p class="text-sm text-gray-600 dark:text-white/60">{{ $parkingLot->city }}</p>
                        </div>
                    </div>

                    <div class="w-full max-w-full px-3 mb-6">
                        <div class="mb-4">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Địa chỉ:</label>
                            <p class="text-sm text-gray-600 dark:text-white/60">{{ $parkingLot->address }}</p>
                        </div>
                    </div>

                    @if($parkingLot->latitude && $parkingLot->longitude)
                    <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                        <div class="mb-4">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Vĩ độ:</label>
                            <p class="text-sm text-gray-600 dark:text-white/60">{{ $parkingLot->latitude }}</p>
                        </div>
                    </div>

                    <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                        <div class="mb-4">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Kinh độ:</label>
                            <p class="text-sm text-gray-600 dark:text-white/60">{{ $parkingLot->longitude }}</p>
                        </div>
                    </div>
                    @endif

                    <div class="w-full max-w-full px-3 mb-6 md:w-4/12 md:flex-none">
                        <div class="mb-4">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Tổng số chỗ:</label>
                            <p class="text-lg font-bold text-blue-600">{{ $parkingLot->total_spots }}</p>
                        </div>
                    </div>

                    <div class="w-full max-w-full px-3 mb-6 md:w-4/12 md:flex-none">
                        <div class="mb-4">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Chỗ trống:</label>
                            <p class="text-lg font-bold text-green-600">{{ $parkingLot->available_spots }}</p>
                        </div>
                    </div>

                    <div class="w-full max-w-full px-3 mb-6 md:w-4/12 md:flex-none">
                        <div class="mb-4">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Giá/giờ:</label>
                            <p class="text-lg font-bold text-purple-600">{{ number_format($parkingLot->hourly_rate, 0, ',', '.') }}đ</p>
                        </div>
                    </div>

                    @if($parkingLot->description)
                    <div class="w-full max-w-full px-3 mb-6">
                        <div class="mb-4">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Mô tả:</label>
                            <p class="text-sm text-gray-600 dark:text-white/60">{{ $parkingLot->description }}</p>
                        </div>
                    </div>
                    @endif

                    <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                        <div class="mb-4">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Ngày tạo:</label>
                            <p class="text-sm text-gray-600 dark:text-white/60">{{ $parkingLot->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>

                    <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                        <div class="mb-4">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Cập nhật lần cuối:</label>
                            <p class="text-sm text-gray-600 dark:text-white/60">{{ $parkingLot->updated_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Card -->
    <div class="w-full max-w-full px-3 lg:w-4/12 lg:flex-none">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border mb-6">
            <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6 class="mb-0 dark:text-white">Thống kê</h6>
            </div>

            <div class="flex-auto p-6">
                <div class="mb-4">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-semibold text-slate-700 dark:text-white/80">Tổng booking:</span>
                        <span class="text-lg font-bold text-blue-600">{{ $parkingLot->bookings->count() }}</span>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-semibold text-slate-700 dark:text-white/80">Booking hoạt động:</span>
                        <span class="text-lg font-bold text-green-600">{{ $parkingLot->bookings->where('status', 'active')->count() }}</span>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-semibold text-slate-700 dark:text-white/80">Booking hoàn thành:</span>
                        <span class="text-lg font-bold text-gray-600">{{ $parkingLot->bookings->where('status', 'completed')->count() }}</span>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-semibold text-slate-700 dark:text-white/80">Tổng doanh thu:</span>
                        <span class="text-lg font-bold text-purple-600">{{ number_format($parkingLot->bookings->sum('total_amount'), 0, ',', '.') }}đ</span>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-semibold text-slate-700 dark:text-white/80">Đánh giá:</span>
                        <span class="text-lg font-bold text-yellow-600">{{ $parkingLot->reviews->count() }}</span>
                    </div>
                </div>

                @if($parkingLot->reviews->count() > 0)
                <div class="mb-4">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-semibold text-slate-700 dark:text-white/80">Điểm trung bình:</span>
                        <div class="flex items-center">
                            <span class="text-lg font-bold text-yellow-600 mr-1">{{ number_format($parkingLot->reviews->avg('rating'), 1) }}</span>
                            <i class="fas fa-star text-yellow-500"></i>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Occupancy Rate Chart -->
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6 class="mb-0 dark:text-white">Tỷ lệ lấp đầy</h6>
            </div>

            <div class="flex-auto p-6">
                @php
                    $occupancyRate = $parkingLot->total_spots > 0 ? (($parkingLot->total_spots - $parkingLot->available_spots) / $parkingLot->total_spots) * 100 : 0;
                @endphp
                <div class="relative">
                    <div class="flex items-center justify-center mb-4">
                        <div class="relative w-32 h-32">
                            <svg class="w-32 h-32 transform -rotate-90" viewBox="0 0 36 36">
                                <path
                                    class="circle-bg"
                                    d="M18 2.0845
                                    a 15.9155 15.9155 0 0 1 0 31.831
                                    a 15.9155 15.9155 0 0 1 0 -31.831"
                                    fill="none"
                                    stroke="#e5e7eb"
                                    stroke-width="3"/>
                                <path
                                    class="circle"
                                    d="M18 2.0845
                                    a 15.9155 15.9155 0 0 1 0 31.831
                                    a 15.9155 15.9155 0 0 1 0 -31.831"
                                    fill="none"
                                    stroke="{{ $occupancyRate > 80 ? '#ef4444' : ($occupancyRate > 50 ? '#f59e0b' : '#10b981') }}"
                                    stroke-width="3"
                                    stroke-dasharray="{{ $occupancyRate }}, 100"/>
                            </svg>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <span class="text-xl font-bold {{ $occupancyRate > 80 ? 'text-red-500' : ($occupancyRate > 50 ? 'text-yellow-500' : 'text-green-500') }}">
                                    {{ number_format($occupancyRate, 1) }}%
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <p class="text-sm text-gray-600 dark:text-white/60">
                            {{ $parkingLot->total_spots - $parkingLot->available_spots }}/{{ $parkingLot->total_spots }} chỗ đã sử dụng
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Bookings -->
<div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6 class="mb-0 dark:text-white">Booking gần đây</h6>
            </div>

            <div class="flex-auto px-0 pt-0 pb-2">
                <div class="p-0 overflow-x-auto">
                    <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                        <thead class="align-bottom">
                            <tr>
                                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Khách hàng</th>
                                <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Thời gian</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Trạng thái</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Tổng tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($parkingLot->bookings->take(10) as $booking)
                            <tr>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="flex px-2 py-1">
                                        <div class="flex flex-col justify-center">
                                            <h6 class="mb-0 text-sm leading-normal dark:text-white">{{ $booking->user->name }}</h6>
                                            <p class="mb-0 text-xs leading-tight text-slate-400">{{ $booking->user->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <p class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-80">{{ $booking->start_time->format('d/m/Y H:i') }}</p>
                                    <p class="mb-0 text-xs leading-tight text-slate-400">đến {{ $booking->end_time->format('d/m/Y H:i') }}</p>
                                </td>
                                <td class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span class="bg-gradient-to-tl from-green-600 to-lime-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span class="text-xs font-semibold leading-tight dark:text-white dark:opacity-80">
                                        {{ number_format($booking->total_amount, 0, ',', '.') }}đ
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="p-6 text-center text-slate-400">
                                    Bãi đỗ xe này chưa có booking nào
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
