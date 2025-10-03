@extends('admin.layout')
@section('page-title', 'Quản lý Đánh giá - Paspark Admin')
@section('page-heading', 'Quản lý Đánh giá')

@section('content')
<div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <div class="flex items-center justify-between mb-4">
                    <h6 class="mb-0 dark:text-white">Danh sách đánh giá</h6>
                    <a href="{{ route('admin.reviews.create') }}" class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer bg-gradient-to-tl from-green-600 to-lime-400 leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs">
                        <i class="fas fa-plus mr-2"></i>Thêm đánh giá
                    </a>
                </div>

                <!-- Search and Filter -->
                <div class="flex flex-wrap items-center justify-between mb-4">
                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <input type="text" id="searchInput" placeholder="Tìm kiếm đánh giá..." class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-80 appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow">
                            <i class="fas fa-search absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        </div>

                        <select id="ratingFilter" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow">
                            <option value="">Tất cả đánh giá</option>
                            <option value="5">5 sao</option>
                            <option value="4">4 sao</option>
                            <option value="3">3 sao</option>
                            <option value="2">2 sao</option>
                            <option value="1">1 sao</option>
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
                        Tổng: <span class="font-semibold" id="totalCount">{{ $reviews->total() }}</span> đánh giá
                        <br>
                        Điểm TB: <span class="font-semibold text-yellow-600">{{ number_format($reviews->avg('rating'), 1) }}</span>/5 ⭐
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
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Đánh giá</th>
                                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Bình luận</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Ngày tạo</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody id="reviewsTable">
                            @forelse($reviews as $review)
                            <tr class="review-row" data-user="{{ strtolower($review->user->name) }}" data-email="{{ strtolower($review->user->email) }}" data-parking-lot="{{ strtolower($review->parkingLot->name) }}" data-rating="{{ $review->rating }}" data-parking-lot-id="{{ $review->parking_lot_id }}" data-date="{{ $review->created_at->format('Y-m-d') }}">
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="flex px-2 py-1">
                                        <div class="flex flex-col justify-center">
                                            <h6 class="mb-0 text-sm leading-normal dark:text-white">{{ $review->user->name }}</h6>
                                            <p class="mb-0 text-xs leading-tight text-slate-400">{{ $review->user->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="flex flex-col justify-center">
                                        <p class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-80 max-w-xs truncate">{{ $review->parkingLot->name }}</p>
                                        <p class="mb-0 text-xs leading-tight text-slate-400">{{ $review->parkingLot->city }}</p>
                                    </div>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="flex flex-col items-center">
                                        <div class="flex items-center mb-1">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star text-sm {{ $i <= $review->rating ? 'text-yellow-500' : 'text-gray-300' }}"></i>
                                            @endfor
                                        </div>
                                        <span class="text-sm font-bold text-yellow-600">{{ $review->rating }}/5</span>
                                    </div>
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b shadow-transparent">
                                    <div class="max-w-xs">
                                        @if($review->comment)
                                            <p class="text-xs text-gray-600 dark:text-white/60 line-clamp-2">{{ Str::limit($review->comment, 100) }}</p>
                                        @else
                                            <p class="text-xs text-gray-400 italic">Không có bình luận</p>
                                        @endif
                                    </div>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="flex flex-col items-center">
                                        <span class="text-xs font-semibold leading-tight dark:text-white dark:opacity-80">
                                            {{ $review->created_at->format('d/m/Y') }}
                                        </span>
                                        <span class="text-xs leading-tight text-slate-400">
                                            {{ $review->created_at->format('H:i') }}
                                        </span>
                                    </div>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="flex items-center justify-center space-x-2">
                                        <a href="{{ route('admin.reviews.show', $review) }}" class="text-blue-600 hover:text-blue-800 transition-colors" title="Xem chi tiết">
                                            <i class="fas fa-eye text-sm"></i>
                                        </a>
                                        <a href="{{ route('admin.reviews.edit', $review) }}" class="text-orange-600 hover:text-orange-800 transition-colors" title="Chỉnh sửa">
                                            <i class="fas fa-edit text-sm"></i>
                                        </a>
                                        <form method="POST" action="{{ route('admin.reviews.destroy', $review) }}" class="inline-block" onsubmit="return confirm('Bạn có chắc chắn muốn xóa đánh giá này?')">
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
                                    Không có đánh giá nào
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            @if($reviews->hasPages())
            <div class="flex items-center justify-between px-6 py-3 border-t border-gray-200">
                <div class="flex items-center">
                    <p class="text-sm text-gray-700">
                        Hiển thị {{ $reviews->firstItem() }} đến {{ $reviews->lastItem() }} trong tổng số {{ $reviews->total() }} kết quả
                    </p>
                </div>
                <div class="flex items-center space-x-2">
                    {{ $reviews->links() }}
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Rating Statistics -->
<div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6 class="mb-0 dark:text-white">Thống kê đánh giá</h6>
            </div>

            <div class="flex-auto p-6">
                <div class="grid grid-cols-5 gap-4">
                    @for($i = 5; $i >= 1; $i--)
                        @php
                            $count = $reviews->where('rating', $i)->count();
                            $percentage = $reviews->count() > 0 ? ($count / $reviews->count()) * 100 : 0;
                        @endphp
                        <div class="text-center">
                            <div class="flex items-center justify-center mb-2">
                                <span class="text-sm font-semibold mr-2">{{ $i }}</span>
                                <i class="fas fa-star text-yellow-500"></i>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5 mb-2">
                                <div class="bg-yellow-500 h-2.5 rounded-full" style="width: {{ $percentage }}%"></div>
                            </div>
                            <p class="text-xs text-gray-600">{{ $count }} ({{ number_format($percentage, 1) }}%)</p>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const ratingFilter = document.getElementById('ratingFilter');
    const parkingLotFilter = document.getElementById('parkingLotFilter');
    const dateFilter = document.getElementById('dateFilter');
    const rows = document.querySelectorAll('.review-row');
    const totalCount = document.getElementById('totalCount');

    function filterRows() {
        const searchTerm = searchInput.value.toLowerCase();
        const ratingValue = ratingFilter.value;
        const parkingLotValue = parkingLotFilter.value;
        const dateValue = dateFilter.value;
        let visibleCount = 0;

        rows.forEach(row => {
            const user = row.dataset.user;
            const email = row.dataset.email;
            const parkingLot = row.dataset.parkingLot;
            const rating = row.dataset.rating;
            const parkingLotId = row.dataset.parkingLotId;
            const date = row.dataset.date;

            const matchesSearch = user.includes(searchTerm) || email.includes(searchTerm) || parkingLot.includes(searchTerm);
            const matchesRating = !ratingValue || rating === ratingValue;
            const matchesParkingLot = !parkingLotValue || parkingLotId === parkingLotValue;
            const matchesDate = !dateValue || date === dateValue;

            if (matchesSearch && matchesRating && matchesParkingLot && matchesDate) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        totalCount.textContent = visibleCount;
    }

    searchInput.addEventListener('input', filterRows);
    ratingFilter.addEventListener('change', filterRows);
    parkingLotFilter.addEventListener('change', filterRows);
    dateFilter.addEventListener('change', filterRows);
});
</script>
@endsection
