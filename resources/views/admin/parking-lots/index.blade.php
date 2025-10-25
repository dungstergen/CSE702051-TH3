@extends('admin.layout')
@section('page-title', 'Quản lý Bãi đỗ xe - Paspark Admin')
@section('page-heading', 'Quản lý Bãi đỗ xe')

@section('content')
<div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <div class="flex items-center justify-between mb-4">
                    <h6 class="mb-0 dark:text-white">Danh sách bãi đỗ xe</h6>
                    <a href="{{ route('admin.parking-lots.create') }}" class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer bg-gradient-to-tl from-green-600 to-lime-400 leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs">
                        <i class="fas fa-plus mr-2"></i>Thêm bãi đỗ xe
                    </a>
                </div>

                <!-- Search and Filter -->
                <div class="flex flex-wrap items-center justify-between mb-4">
                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <input type="text" id="searchInput" placeholder="Tìm kiếm bãi đỗ xe..." class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-80 appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow">
                        </div>

                        <select id="statusFilter" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow">
                            <option value="">Tất cả trạng thái</option>
                            <option value="active">Hoạt động</option>
                            <option value="inactive">Không hoạt động</option>
                            <option value="maintenance">Bảo trì</option>
                        </select>

                        <select id="cityFilter" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow">
                            <option value="">Tất cả thành phố</option>
                            <option value="Hà Nội">Hà Nội</option>
                            <option value="Hồ Chí Minh">Hồ Chí Minh</option>
                            <option value="Đà Nẵng">Đà Nẵng</option>
                            <option value="Hải Phòng">Hải Phòng</option>
                        </select>
                    </div>

                    <div class="text-sm text-gray-600">
                        Tổng: <span class="font-semibold" id="totalCount">{{ $parkingLots->total() }}</span> bãi đỗ xe
                    </div>
                </div>
            </div>

            <div class="flex-auto px-0 pt-0 pb-2">
                <div class="p-0 overflow-x-auto">
                    <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                        <thead class="align-bottom">
                            <tr>
                                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Bãi đỗ xe</th>
                                <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Địa chỉ</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Sức chứa</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Giá/giờ</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Trạng thái</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody id="parkingLotsTable">
                            @forelse($parkingLots as $parkingLot)
                            <tr class="parking-lot-row" data-name="{{ strtolower($parkingLot->name) }}" data-address="{{ strtolower($parkingLot->address) }}" data-status="{{ $parkingLot->status }}" data-city="{{ $parkingLot->city }}">
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="flex px-2 py-1">
                                        <div class="flex flex-col justify-center">
                                            <h6 class="mb-0 text-sm leading-normal dark:text-white">{{ $parkingLot->name }}</h6>
                                            <p class="mb-0 text-xs leading-tight text-slate-400">{{ $parkingLot->city }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <p class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-80 max-w-xs truncate">{{ $parkingLot->address }}</p>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="flex flex-col items-center">
                                        <span class="text-xs font-semibold leading-tight dark:text-white dark:opacity-80">
                                            {{ $parkingLot->available_spots }}/{{ $parkingLot->total_spots }}
                                        </span>
                                        <div class="w-full bg-gray-200 rounded-full h-1.5 mt-1">
                                            @php
                                                $percentage = $parkingLot->total_spots > 0 ? ($parkingLot->available_spots / $parkingLot->total_spots) * 100 : 0;
                                                $colorClass = $percentage > 50 ? 'bg-green-600' : ($percentage > 20 ? 'bg-yellow-600' : 'bg-red-600');
                                            @endphp
                                            <div class="{{ $colorClass }} h-1.5 rounded-full" style="width: {{ $percentage }}%"></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span class="text-xs font-semibold leading-tight dark:text-white dark:opacity-80">
                                        {{ number_format($parkingLot->hourly_rate, 0, ',', '.') }}đ
                                    </span>
                                </td>
                                <td class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    @if($parkingLot->status === 'active')
                                        <span class="bg-gradient-to-tl from-green-600 to-lime-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                            Hoạt động
                                        </span>
                                    @elseif($parkingLot->status === 'inactive')
                                        <span class="bg-gradient-to-tl from-red-600 to-rose-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                            Không hoạt động
                                        </span>
                                    @else
                                        <span class="bg-gradient-to-tl from-orange-500 to-yellow-500 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                            Bảo trì
                                        </span>
                                    @endif
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="flex items-center justify-center space-x-2">
                                        <a href="{{ route('admin.parking-lots.show', $parkingLot) }}" class="text-blue-600 hover:text-blue-800 transition-colors" title="Xem chi tiết">
                                            <i class="fas fa-eye text-sm"></i>
                                        </a>
                                        <a href="{{ route('admin.parking-lots.edit', $parkingLot) }}" class="text-orange-600 hover:text-orange-800 transition-colors" title="Chỉnh sửa">
                                            <i class="fas fa-edit text-sm"></i>
                                        </a>
                                        <form method="POST" action="{{ route('admin.parking-lots.destroy', $parkingLot) }}" class="inline-block" onsubmit="return confirm('Bạn có chắc chắn muốn xóa bãi đỗ xe này?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 transition-colors" title="Xóa">
                                                <i class="fas fa-trash text-sm"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="p-6 text-center text-slate-400">
                                    Không có bãi đỗ xe nào
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            @if($parkingLots->hasPages())
            <div class="flex items-center justify-between px-6 py-3 border-t border-gray-200">
                <div class="flex items-center">
                    <p class="text-sm text-gray-700">
                        Hiển thị {{ $parkingLots->firstItem() }} đến {{ $parkingLots->lastItem() }} trong tổng số {{ $parkingLots->total() }} kết quả
                    </p>
                </div>
                <div class="flex items-center space-x-2">
                    {{ $parkingLots->links() }}
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
    const cityFilter = document.getElementById('cityFilter');
    const rows = document.querySelectorAll('.parking-lot-row');
    const totalCount = document.getElementById('totalCount');

    function filterRows() {
        const searchTerm = searchInput.value.toLowerCase();
        const statusValue = statusFilter.value;
        const cityValue = cityFilter.value;
        let visibleCount = 0;

        rows.forEach(row => {
            const name = row.dataset.name;
            const address = row.dataset.address;
            const status = row.dataset.status;
            const city = row.dataset.city;

            const matchesSearch = name.includes(searchTerm) || address.includes(searchTerm);
            const matchesStatus = !statusValue || status === statusValue;
            const matchesCity = !cityValue || city === cityValue;

            if (matchesSearch && matchesStatus && matchesCity) {
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
    cityFilter.addEventListener('change', filterRows);
});
</script>
@endsection
