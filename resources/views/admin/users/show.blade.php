@extends('admin.layout')
@section('page-title', 'Chi tiết Người dùng - Paspark Admin')
@section('page-heading', 'Chi tiết Người dùng')

@section('content')
<div class="flex flex-wrap -mx-3 mb-6">
    <!-- User Profile Card -->
    <div class="w-full max-w-full px-3 lg:w-8/12 lg:flex-none">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <div class="flex items-center justify-between mb-4">
                    <h6 class="mb-0 dark:text-white">Thông tin chi tiết</h6>
                    <div class="space-x-2">
                        <a href="{{ route('admin.users.edit', $user) }}" class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer bg-gradient-to-tl from-orange-500 to-yellow-500 leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs">
                            <i class="fas fa-edit mr-2"></i>Chỉnh sửa
                        </a>
                        <a href="{{ route('admin.users.index') }}" class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer bg-gradient-to-tl from-orange-500 to-yellow-500 leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs">
                            <i class="fas fa-arrow-left mr-2"></i>Quay lại
                        </a>
                    </div>
                </div>
            </div>

            <div class="flex-auto p-6">
                <div class="flex flex-wrap -mx-3">
                    <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                        <div class="mb-4">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">ID người dùng:</label>
                            <p class="text-sm text-gray-600 dark:text-white/60">#{{ $user->id }}</p>
                        </div>
                    </div>

                    <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                        <div class="mb-4">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Trạng thái:</label>
                            <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full {{ $user->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $user->is_active ? 'Hoạt động' : 'Không hoạt động' }}
                            </span>
                        </div>
                    </div>

                    <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                        <div class="mb-4">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Họ và tên:</label>
                            <p class="text-sm text-gray-600 dark:text-white/60">{{ $user->name }}</p>
                        </div>
                    </div>

                    <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                        <div class="mb-4">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Email:</label>
                            <p class="text-sm text-gray-600 dark:text-white/60">{{ $user->email }}</p>
                        </div>
                    </div>

                    <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                        <div class="mb-4">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Số điện thoại:</label>
                            <p class="text-sm text-gray-600 dark:text-white/60">{{ $user->phone ?: 'Chưa cập nhật' }}</p>
                        </div>
                    </div>

                    <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                        <div class="mb-4">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Xác minh email:</label>
                            <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full {{ $user->email_verified_at ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ $user->email_verified_at ? 'Đã xác minh' : 'Chưa xác minh' }}
                            </span>
                        </div>
                    </div>

                    <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                        <div class="mb-4">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Ngày tạo:</label>
                            <p class="text-sm text-gray-600 dark:text-white/60">{{ $user->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>

                    <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                        <div class="mb-4">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Cập nhật lần cuối:</label>
                            <p class="text-sm text-gray-600 dark:text-white/60">{{ $user->updated_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Card -->
    <div class="w-full max-w-full px-3 lg:w-4/12 lg:flex-none">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6 class="mb-0 dark:text-white">Thống kê hoạt động</h6>
            </div>

            <div class="flex-auto p-6">
                <div class="mb-4">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-semibold text-slate-700 dark:text-white/80">Tổng số booking:</span>
                        <span class="text-lg font-bold text-blue-600">{{ $user->bookings->count() }}</span>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-semibold text-slate-700 dark:text-white/80">Booking đang xử lý:</span>
                        <span class="text-lg font-bold text-green-600">{{ $user->bookings->whereIn('status', ['pending','confirmed'])->count() }}</span>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-semibold text-slate-700 dark:text-white/80">Booking hoàn thành:</span>
                        <span class="text-lg font-bold text-gray-600">{{ $user->bookings->where('status', 'completed')->count() }}</span>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-semibold text-slate-700 dark:text-white/80">Tổng thanh toán:</span>
                        <span class="text-lg font-bold text-purple-600">{{ number_format($user->payments->sum('amount'), 0, ',', '.') }}đ</span>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-semibold text-slate-700 dark:text-white/80">Đánh giá đã viết:</span>
                        <span class="text-lg font-bold text-yellow-600">{{ $user->reviews->count() }}</span>
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
                                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Bãi đỗ xe</th>
                                <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Thời gian</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Trạng thái</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Tổng tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($user->bookings->take(5) as $booking)
                            <tr>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="flex px-2 py-1">
                                        <div class="flex flex-col justify-center">
                                            <h6 class="mb-0 text-sm leading-normal dark:text-white">{{ $booking->parkingLot->name }}</h6>
                                            <p class="mb-0 text-xs leading-tight text-slate-400">{{ $booking->parkingLot->address }}</p>
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
                                        {{ number_format($booking->total_cost, 0, ',', '.') }}đ
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="p-6 text-center text-slate-400">
                                    Người dùng này chưa có booking nào
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
