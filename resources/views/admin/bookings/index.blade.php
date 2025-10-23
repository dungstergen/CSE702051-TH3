@extends('admin.layout')
@section('page-title', 'Quản lý Booking - Paspark Admin')
@section('page-heading', 'Quản lý Booking')

@section('content')
<div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <div class="flex items-center justify-between mb-4">
                    <h6 class="mb-0 dark:text-white">Danh sách booking</h6>
                    <a href="{{ route('admin.bookings.create') }}" class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer bg-gradient-to-tl from-green-600 to-lime-400 leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs">
                        <i class="fas fa-plus mr-2"></i>Thêm booking
                    </a>
                </div>

                <!-- Search and Filter -->
                <div class="flex flex-wrap items-center justify-between mb-4">
                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <input type="text" id="searchInput" placeholder="Tìm kiếm booking..." class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-80 appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow">
                            <i class="fas fa-search absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        </div>

                        <select id="statusFilter" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow">
                            <option value="">Tất cả trạng thái</option>
                            <option value="pending">Chờ xác nhận</option>
                            <option value="confirmed">Đã xác nhận</option>
                            <option value="active">Đang hoạt động</option>
                            <option value="completed">Hoàn thành</option>
                            <option value="cancelled">Đã hủy</option>
                        </select>

                        <select id="parkingLotFilter" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow">
                            <option value="">Tất cả bãi đỗ xe</option>
                            @foreach($parkingLots as $lot)
                                <option value="{{ $lot->id }}">{{ $lot->name }}</option>
                            @endforeach
                        </select>

                        <input type="date" id="dateFilter" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow">
                    </div>

                    <div class="text-sm text-gray-600">
                        Tổng: <span class="font-semibold" id="totalCount">{{ $bookings->total() }}</span> booking
                    </div>
                </div>
            </div>

            <div class="flex-auto px-0 pt-0 pb-2">
                <div class="p-0 overflow-x-auto">
                    <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                        <thead class="align-bottom">
                            <tr>
                                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Khách hàng</th>
                                <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Bãi đỗ xe</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Thời gian</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Trạng thái</th>
                                {{-- <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Tổng tiền</th> --}}
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody id="bookingsTable">
                            @forelse($bookings as $booking)
                            <tr class="booking-row" data-user="{{ strtolower($booking->user->name) }}" data-email="{{ strtolower($booking->user->email) }}" data-parking-lot="{{ strtolower($booking->parkingLot->name) }}" data-status="{{ $booking->status }}" data-parking-lot-id="{{ $booking->parking_lot_id }}" data-date="{{ $booking->start_time->format('Y-m-d') }}">
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="flex px-2 py-1">
                                        <div class="flex flex-col justify-center">
                                            <h6 class="mb-0 text-sm leading-normal dark:text-white">{{ $booking->user->name }}</h6>
                                            <p class="mb-0 text-xs leading-tight text-slate-400">{{ $booking->user->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="flex flex-col justify-center">
                                        <p class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-80 max-w-xs truncate">{{ $booking->parkingLot->name }}</p>
                                        <p class="mb-0 text-xs leading-tight text-slate-400">{{ $booking->parkingLot->city }}</p>
                                    </div>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="flex flex-col items-center">
                                        <span class="text-xs font-semibold leading-tight dark:text-white dark:opacity-80">
                                            {{ $booking->start_time->format('d/m/Y H:i') }}
                                        </span>
                                        <span class="text-xs leading-tight text-slate-400">
                                            đến {{ $booking->end_time->format('d/m/Y H:i') }}
                                        </span>
                                        <span class="text-xs leading-tight text-blue-600 font-semibold">
                                            ({{ $booking->duration_hours }}h)
                                        </span>
                                    </div>
                                </td>
                                <td class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    @if($booking->status === 'pending')
                                        <span class="bg-gradient-to-tl px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none">
                                            Chờ xác nhận
                                        </span>
                                    @elseif($booking->status === 'confirmed')
                                        <span class="bg-gradient-to-tl px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none">
                                            Đã xác nhận
                                        </span>
                                    @elseif($booking->status === 'active')
                                        <span class="bg-gradient-to-tl px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none">
                                            Đang hoạt động
                                        </span>
                                    @elseif($booking->status === 'completed')
                                        <span class="bg-gradient-to-tl px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none">
                                            Hoàn thành
                                        </span>
                                    @else
                                        <span class="bg-gradient-to-tl px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none">
                                            Đã hủy
                                        </span>
                                    @endif
                                </td>
                                {{-- <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span class="text-xs font-semibold leading-tight dark:text-white dark:opacity-80">
                                        {{ number_format($booking->total_amount, 0, ',', '.') }}đ
                                    </span>
                                    @if($booking->payment && $booking->payment->status === 'completed')
                                        <br><span class="text-xs text-green-600 font-semibold">Đã thanh toán</span>
                                    @elseif($booking->payment && $booking->payment->status === 'pending')
                                        <br><span class="text-xs text-yellow-600 font-semibold">Chờ thanh toán</span>
                                    @else
                                        <br><span class="text-xs text-red-600 font-semibold">Chưa thanh toán</span>
                                    @endif
                                </td> --}}
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="flex items-center justify-center space-x-2">
                                        <a href="{{ route('admin.bookings.show', $booking) }}" class="text-blue-600 hover:text-blue-800 transition-colors" title="Xem chi tiết">
                                            <i class="fas fa-eye text-sm"></i>
                                        </a>
                                        <a href="{{ route('admin.bookings.edit', $booking) }}" class="text-orange-600 hover:text-orange-800 transition-colors" title="Chỉnh sửa">
                                            <i class="fas fa-edit text-sm"></i>
                                        </a>
                                        @if($booking->status !== 'completed')
                                        <form method="POST" action="{{ route('admin.bookings.destroy', $booking) }}" class="inline-block" onsubmit="return confirm('Bạn có chắc chắn muốn xóa booking này?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 transition-colors" title="Xóa">
                                                <i class="fas fa-trash text-sm"></i>
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="p-6 text-center text-slate-400">
                                    Không có booking nào
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            @if($bookings->hasPages())
            <div class="flex items-center justify-between px-6 py-3 border-t border-gray-200">
                <div class="flex items-center">
                    <p class="text-sm text-gray-700">
                        Hiển thị {{ $bookings->firstItem() }} đến {{ $bookings->lastItem() }} trong tổng số {{ $bookings->total() }} kết quả
                    </p>
                </div>
                <div class="flex items-center space-x-2">
                    {{ $bookings->links() }}
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const statusFilter = document.getElementById('statusFilter');
    const parkingLotFilter = document.getElementById('parkingLotFilter');
    const dateFilter = document.getElementById('dateFilter');
    const rows = document.querySelectorAll('.booking-row');
    const totalCount = document.getElementById('totalCount');

    function filterRows() {
        const searchTerm = searchInput.value.toLowerCase();
        const statusValue = statusFilter.value;
        const parkingLotValue = parkingLotFilter.value;
        const dateValue = dateFilter.value;
        let visibleCount = 0;

        rows.forEach(row => {
            const user = row.dataset.user;
            const email = row.dataset.email;
            const parkingLot = row.dataset.parkingLot;
            const status = row.dataset.status;
            const parkingLotId = row.dataset.parkingLotId;
            const date = row.dataset.date;

            const matchesSearch = user.includes(searchTerm) || email.includes(searchTerm) || parkingLot.includes(searchTerm);
            const matchesStatus = !statusValue || status === statusValue;
            const matchesParkingLot = !parkingLotValue || parkingLotId === parkingLotValue;
            const matchesDate = !dateValue || date === dateValue;

            if (matchesSearch && matchesStatus && matchesParkingLot && matchesDate) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        totalCount.textContent = visibleCount;
    }

    searchInput.addEventListener('input', filterRows);
    statusFilter.addEventListener('change', filterRows);
    parkingLotFilter.addEventListener('change', filterRows);
    dateFilter.addEventListener('change', filterRows);
});
</script>
@endsection
