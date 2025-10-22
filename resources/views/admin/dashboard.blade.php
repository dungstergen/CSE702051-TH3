@extends('admin.layout')
@section('page-title', 'Dashboard - Paspark Admin')
@section('page-heading', 'Dashboard')

@section('content')
<!-- Statistics Cards Row -->
<div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">Tổng doanh thu</p>
                            <h5 class="mb-2 font-bold dark:text-white">{{ number_format($totalRevenue ?? 0) }}đ</h5>
                            <p class="mb-0 dark:text-white dark:opacity-60">
                                <span class="text-sm font-bold leading-normal text-emerald-500">+15%</span>
                                so với tháng trước
                            </p>
                        </div>
                    </div>
                    <div class="px-3 text-right basis-1/3">
                        <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-blue-500 to-violet-500">
                            <i class="ni leading-none ni-money-coins text-lg relative top-3.5 text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">Tổng số user</p>
                            <h5 class="mb-2 font-bold dark:text-white">{{ $totalUsers ?? 0 }}</h5>
                            <p class="mb-0 dark:text-white dark:opacity-60">
                                <span class="text-sm font-bold leading-normal text-emerald-500">+8%</span>
                                so với tháng trước
                            </p>
                        </div>
                    </div>
                    <div class="px-3 text-right basis-1/3">
                        <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-red-600 to-orange-600">
                            <i class="ni leading-none ni-world text-lg relative top-3.5 text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">Tổng đặt chỗ</p>
                            <h5 class="mb-2 font-bold dark:text-white">{{ $totalBookings ?? 0 }}</h5>
                            <p class="mb-0 dark:text-white dark:opacity-60">
                                <span class="text-sm font-bold leading-normal text-emerald-500">+12%</span>
                                so với tháng trước
                            </p>
                        </div>
                    </div>
                    <div class="px-3 text-right basis-1/3">
                        <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-emerald-500 to-teal-400">
                            <i class="ni leading-none ni-paper-diploma text-lg relative top-3.5 text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="w-full max-w-full px-3 sm:w-1/2 sm:flex-none xl:w-1/4">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">Tổng bãi đỗ xe</p>
                            <h5 class="mb-2 font-bold dark:text-white">{{ $totalParkingLots ?? 0 }}</h5>
                            <p class="mb-0 dark:text-white dark:opacity-60">
                                <span class="text-sm font-bold leading-normal text-emerald-500">+2</span>
                                bãi mới tháng này
                            </p>
                        </div>
                    </div>
                    <div class="px-3 text-right basis-1/3">
                        <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-orange-500 to-yellow-500">
                            <i class="ni leading-none ni-cart text-lg relative top-3.5 text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Charts Row -->
<div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full max-w-full px-3 lg:w-7/12 lg:flex-none">
        <div class="border-black/12.5 dark:bg-slate-850 dark:shadow-dark-xl shadow-xl relative z-20 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
            <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid p-6 pt-4 pb-0">
                <h6 class="capitalize dark:text-white">Xu hướng doanh thu (7 ngày qua)</h6>
                <p class="mb-0 text-sm leading-normal dark:text-white dark:opacity-60">
                    <i class="fa fa-arrow-up text-emerald-500"></i>
                    <span class="font-semibold">Tăng 4%</span> so với tuần trước
                </p>
            </div>
            <div class="flex-auto p-4">
                <canvas id="revenue-chart" height="300"></canvas>
            </div>
        </div>
    </div>

    <div class="w-full max-w-full px-3 lg:w-5/12 lg:flex-none">
        <div class="border-black/12.5 dark:bg-slate-850 dark:shadow-dark-xl shadow-xl relative z-20 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
            <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid p-6 pt-4 pb-0">
                <h6 class="capitalize dark:text-white">Trạng thái đặt chỗ</h6>
            </div>
            <div class="flex-auto p-4">
                <canvas id="booking-status-chart" height="300"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Service Packages & Testimonials Row -->
<div class="flex flex-wrap -mx-3 mb-6">
    <!-- Service Packages Summary -->
    <div class="w-full max-w-full px-3 mb-6 lg:w-6/12 lg:flex-none">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <div class="flex items-center justify-between">
                    <h6 class="mb-0 dark:text-white">Gói dịch vụ phổ biến</h6>
                    <a href="{{ route('admin.service-packages.index') }}" class="text-blue-600 hover:text-blue-800 text-sm">
                        <i class="fas fa-arrow-right mr-1"></i>Xem tất cả
                    </a>
                </div>
            </div>
            <div class="flex-auto p-6">
                <div class="space-y-3">
                    @php
                        $topPackages = [
                            ['name' => 'Gói Cơ Bản', 'price' => '50,000đ', 'usage' => 245, 'percentage' => 65],
                            ['name' => 'Gói Tiêu Chuẩn', 'price' => '100,000đ', 'usage' => 158, 'percentage' => 35],
                            ['name' => 'Gói Cao Cấp', 'price' => '150,000đ', 'usage' => 89, 'percentage' => 20],
                        ];
                    @endphp
                    @foreach($topPackages as $package)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex-grow">
                            <h6 class="text-sm font-semibold text-gray-800">{{ $package['name'] }}</h6>
                            <p class="text-xs text-gray-600">{{ $package['price'] }} • {{ $package['usage'] }} lượt sử dụng</p>
                        </div>
                        <div class="flex items-center">
                            <div class="w-16 h-2 bg-gray-200 rounded overflow-hidden mr-2">
                                <div class="h-full bg-blue-500" style="width: {{ $package['percentage'] }}%"></div>
                            </div>
                            <span class="text-xs font-semibold text-gray-700">{{ $package['percentage'] }}%</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Testimonials Summary -->
    <div class="w-full max-w-full px-3 mb-6 lg:w-6/12 lg:flex-none">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <div class="flex items-center justify-between">
                    <h6 class="mb-0 dark:text-white">Đánh giá khách hàng mới nhất</h6>
                    <a href="{{ route('admin.testimonials.index') }}" class="text-blue-600 hover:text-blue-800 text-sm">
                        <i class="fas fa-arrow-right mr-1"></i>Xem tất cả
                    </a>
                </div>
            </div>
            <div class="flex-auto p-6">
                <div class="space-y-3">
                    @php
                        $recentTestimonials = [
                            ['name' => 'Lê Thị Mai', 'content' => 'Lần đầu sử dụng dịch vụ, cảm thấy rất ấn tượng với sự chuyên nghiệp...', 'rating' => 4, 'status' => 'pending'],
                            ['name' => 'Phạm Quang Huy', 'content' => 'Dịch vụ valet parking rất tiện lợi, tiết kiệm được rất nhiều thời gian...', 'rating' => 5, 'status' => 'published'],
                        ];
                    @endphp
                    @foreach($recentTestimonials as $testimonial)
                    <div class="flex items-start p-3 bg-gray-50 rounded-lg">
                        <div class="flex-shrink-0 w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-user text-gray-600 text-xs"></i>
                        </div>
                        <div class="flex-grow">
                            <div class="flex items-center justify-between">
                                <h6 class="text-sm font-semibold text-gray-800">{{ $testimonial['name'] }}</h6>
                                <div class="flex items-center">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star text-xs {{ $i <= $testimonial['rating'] ? 'text-yellow-500' : 'text-gray-300' }}"></i>
                                    @endfor
                                </div>
                            </div>
                            <p class="text-xs text-gray-600 mt-1">{{ Str::limit($testimonial['content'], 60) }}</p>
                            <div class="flex items-center justify-between mt-2">
                                <span class="px-2 py-1 text-xs font-semibold rounded {{ $testimonial['status'] == 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ $testimonial['status'] == 'published' ? 'Đã xuất bản' : 'Chờ duyệt' }}
                                </span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Bookings Table -->
<div class="flex flex-wrap -mx-3">
    <div class="w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6 class="dark:text-white">Đặt chỗ gần đây</h6>
            </div>
            <div class="flex-auto px-0 pt-0 pb-2">
                <div class="p-0 overflow-x-auto">
                    <table class="items-center w-full mb-0 align-top border-collapse dark:border-white/40 text-slate-500">
                        <thead class="align-bottom">
                            <tr>
                                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Khách hàng</th>
                                <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Bãi đỗ xe</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Thời gian</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Số tiền</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentBookings ?? [] as $booking)
                            <tr>
                                <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                    <div class="flex px-2 py-1">
                                        <div class="flex flex-col justify-center">
                                            <h6 class="mb-0 text-sm leading-normal dark:text-white">{{ $booking->user->name ?? 'Unknown' }}</h6>
                                            <p class="mb-0 text-xs leading-tight dark:text-white dark:opacity-80 text-slate-400">{{ $booking->user->email ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                    <p class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-80">{{ $booking->parkingLot->name ?? 'Unknown' }}</p>
                                    <p class="mb-0 text-xs leading-tight dark:text-white dark:opacity-80 text-slate-400">{{ $booking->parkingLot->address ?? 'N/A' }}</p>
                                </td>
                                <td class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                    <span class="text-xs font-semibold leading-tight dark:text-white dark:opacity-80 text-slate-400">{{ $booking->booking_date ?? 'N/A' }}</span>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                    <span class="text-xs font-semibold leading-tight dark:text-white dark:opacity-80">{{ number_format($booking->total_amount ?? 0) }}đ</span>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                    @php
                                        $statusColors = [
                                            'pending' => 'bg-blue-500',
                                            'confirmed' => 'bg-blue-500',
                                            'cancelled' => 'bg-blue-500',
                                            'completed' => 'bg-blue-500'
                                        ];
                                        $statusTexts = [
                                            'pending' => 'Chờ xác nhận',
                                            'confirmed' => 'Đã xác nhận',
                                            'cancelled' => 'Đã hủy',
                                            'completed' => 'Hoàn thành'
                                        ];
                                    @endphp
                                    <span class="badge rounded-pill {{ $statusColors[$booking->status ?? 'pending'] ?? 'bg-secondary' }} text-white px-2 py-1 text-xs">
                                        {{ $statusTexts[$booking->status ?? 'pending'] ?? $booking->status }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="p-4 text-center text-slate-400">Không có đặt chỗ nào gần đây</td>
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

@section('additional_js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Revenue Chart
    const revenueCtx = document.getElementById('revenue-chart').getContext('2d');
    new Chart(revenueCtx, {
        type: 'line',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            datasets: [{
                label: 'Doanh thu (₫)',
                data: [12000000, 15000000, 8000000, 22000000, 18000000, 25000000, 20000000],
                borderColor: 'rgb(59, 130, 246)',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return new Intl.NumberFormat().format(value) + '₫';
                        }
                    }
                }
            }
        }
    });

    // Booking Status Chart
    const statusCtx = document.getElementById('booking-status-chart').getContext('2d');
    new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: ['Chờ xác nhận', 'Đã xác nhận', 'Đã hủy', 'Hoàn thành'],
            datasets: [{
                data: [15, 25, 15, 45],
                backgroundColor: [
                    '#F59E0B', // Yellow
                    '#10B981', // Green
                    '#EF4444', // Red
                    '#3B82F6'  // Blue
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
});
</script>
@endsection
