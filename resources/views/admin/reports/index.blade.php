@extends('admin.layout')
@section('page-title', 'Tổng quan Báo cáo - Paspark Admin')
@section('page-heading', 'Tổng quan Báo cáo')

@section('content')
<!-- Reports Navigation -->
<div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6 class="mb-0 dark:text-white text-xl font-bold">Các loại báo cáo</h6>
                <p class="text-sm text-gray-600 mt-2">Chọn loại báo cáo bạn muốn xem chi tiết</p>
            </div>
            <div class="flex-auto p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Revenue Report -->
                    <div class="group">
                        <a href="{{ route('admin.reports.revenue') }}" class="block">
                            <div class="relative flex flex-col min-w-0 break-words bg-gradient-to-r from-blue-500 to-purple-600 border-0 shadow-lg rounded-2xl bg-clip-border transform transition-all duration-300 hover:scale-105">
                                <div class="p-6 text-white">
                                    <div class="flex items-center justify-between mb-4">
                                        <div class="flex-shrink-0 w-12 h-12 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-chart-line text-2xl"></i>
                                        </div>
                                        <i class="fas fa-arrow-right text-sm opacity-70 group-hover:opacity-100 transition-opacity"></i>
                                    </div>
                                    <h5 class="text-lg font-bold mb-2">Báo cáo Doanh thu</h5>
                                    <p class="text-sm opacity-90">Theo dõi doanh thu, tăng trưởng và xu hướng theo thời gian</p>
                                    <div class="mt-4 text-xs opacity-80">
                                        <span>• Biểu đồ doanh thu</span><br>
                                        <span>• Phân tích theo bãi đỗ xe</span><br>
                                        <span>• Xuất dữ liệu Excel</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Usage Report -->
                    <div class="group">
                        <a href="{{ route('admin.reports.usage') }}" class="block">
                            <div class="relative flex flex-col min-w-0 break-words bg-gradient-to-r from-green-500 to-teal-600 border-0 shadow-lg rounded-2xl bg-clip-border transform transition-all duration-300 hover:scale-105">
                                <div class="p-6 text-white">
                                    <div class="flex items-center justify-between mb-4">
                                        <div class="flex-shrink-0 w-12 h-12 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-chart-bar text-2xl"></i>
                                        </div>
                                        <i class="fas fa-arrow-right text-sm opacity-70 group-hover:opacity-100 transition-opacity"></i>
                                    </div>
                                    <h5 class="text-lg font-bold mb-2">Báo cáo Sử dụng</h5>
                                    <p class="text-sm opacity-90">Phân tích tỷ lệ sử dụng, giờ cao điểm và xu hướng booking</p>
                                    <div class="mt-4 text-xs opacity-80">
                                        <span>• Tỷ lệ sử dụng theo giờ</span><br>
                                        <span>• Phân tích giờ cao điểm</span><br>
                                        <span>• Mẫu sử dụng theo tuần</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Quick Export -->
                    <div class="group">
                        <div class="relative flex flex-col min-w-0 break-words bg-gradient-to-r from-orange-500 to-red-600 border-0 shadow-lg rounded-2xl bg-clip-border">
                            <div class="p-6 text-white">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex-shrink-0 w-12 h-12 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-download text-2xl"></i>
                                    </div>
                                </div>
                                <h5 class="text-lg font-bold mb-2">Xuất dữ liệu</h5>
                                <p class="text-sm opacity-90">Xuất các báo cáo sang định dạng Excel, PDF</p>
                                <div class="mt-4 space-y-2">
                                    <button onclick="exportData('revenue')" class="w-full py-2 px-3 bg-white bg-opacity-20 rounded-lg text-xs hover:bg-opacity-30 transition-all">
                                        <i class="fas fa-file-excel mr-2"></i>Xuất doanh thu Excel
                                    </button>
                                    <button onclick="exportData('usage')" class="w-full py-2 px-3 bg-white bg-opacity-20 rounded-lg text-xs hover:bg-opacity-30 transition-all">
                                        <i class="fas fa-file-pdf mr-2"></i>Xuất sử dụng PDF
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Summary Statistics Cards -->
<div class="flex flex-wrap -mx-3 mb-6">
    <!-- Total Revenue -->
    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p class="mb-0 font-sans font-semibold leading-normal uppercase text-sm text-slate-400">Tổng doanh thu</p>
                            <h5 class="mb-2 font-bold text-slate-700 dark:text-white">{{ number_format($totalRevenue ?? 12450000) }}đ</h5>
                            <p class="mb-0 text-slate-400">
                                <span class="font-bold leading-normal text-emerald-500 text-sm">+23%</span>
                                so với tháng trước
                            </p>
                        </div>
                    </div>
                    <div class="w-4/12 max-w-full px-3 ml-auto text-right flex-none">
                        <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-blue-500 to-violet-500">
                            <i class="fas fa-coins text-lg relative top-3.5 text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Bookings -->
    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p class="mb-0 font-sans font-semibold leading-normal uppercase text-sm text-slate-400">Tổng booking</p>
                            <h5 class="mb-2 font-bold text-slate-700 dark:text-white">{{ $totalBookings ?? 342 }}</h5>
                            <p class="mb-0 text-slate-400">
                                <span class="font-bold leading-normal text-emerald-500 text-sm">+12%</span>
                                so với tháng trước
                            </p>
                        </div>
                    </div>
                    <div class="w-4/12 max-w-full px-3 ml-auto text-right flex-none">
                        <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-red-600 to-orange-600">
                            <i class="fas fa-calendar-check text-lg relative top-3.5 text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Active Users -->
    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p class="mb-0 font-sans font-semibold leading-normal uppercase text-sm text-slate-400">Người dùng hoạt động</p>
                            <h5 class="mb-2 font-bold text-slate-700 dark:text-white">{{ $activeUsers ?? 156 }}</h5>
                            <p class="mb-0 text-slate-400">
                                <span class="font-bold leading-normal text-emerald-500 text-sm">+8%</span>
                                so với tháng trước
                            </p>
                        </div>
                    </div>
                    <div class="w-4/12 max-w-full px-3 ml-auto text-right flex-none">
                        <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-emerald-500 to-teal-400">
                            <i class="fas fa-users text-lg relative top-3.5 text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Average Rating -->
    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p class="mb-0 font-sans font-semibold leading-normal uppercase text-sm text-slate-400">Đánh giá trung bình</p>
                            <h5 class="mb-2 font-bold text-slate-700 dark:text-white">{{ number_format($averageRating ?? 4.2, 1) }}/5</h5>
                            <p class="mb-0 text-slate-400">
                                <span class="font-bold leading-normal text-emerald-500 text-sm">+0.3</span>
                                so với tháng trước
                            </p>
                        </div>
                    </div>
                    <div class="w-4/12 max-w-full px-3 ml-auto text-right flex-none">
                        <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-orange-500 to-yellow-500">
                            <i class="fas fa-star text-lg relative top-3.5 text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Charts Section -->
<div class="flex flex-wrap -mx-3 mb-6">
    <!-- Revenue Chart -->
    <div class="w-full max-w-full px-3 mb-6 lg:w-7/12 lg:flex-none">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6 class="mb-0 dark:text-white">Biểu đồ doanh thu 12 tháng gần nhất</h6>
            </div>
            <div class="flex-auto p-6">
                <div class="overflow-hidden">
                    <canvas id="revenueChart" class="max-h-80"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Booking Status Chart -->
    <div class="w-full max-w-full px-3 mb-6 lg:w-5/12 lg:flex-none">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6 class="mb-0 dark:text-white">Trạng thái booking</h6>
            </div>
            <div class="flex-auto p-6">
                <div class="overflow-hidden">
                    <canvas id="bookingStatusChart" class="max-h-80"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tables Section -->
<div class="flex flex-wrap -mx-3 mb-6">
    <!-- Top Performing Parking Lots -->
    <div class="w-full max-w-full px-3 mb-6 lg:w-6/12 lg:flex-none">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6 class="mb-0 dark:text-white">Top bãi đỗ xe hiệu quả nhất</h6>
            </div>
            <div class="flex-auto p-0">
                <div class="p-6 overflow-x-auto">
                    <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                        <thead class="align-bottom">
                            <tr>
                                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Bãi đỗ xe</th>
                                <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Booking</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Doanh thu</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Đánh giá</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $topParkingLots = [
                                    ['name' => 'Bãi đỗ xe AEON Mall Hà Đông', 'bookings' => 45, 'revenue' => 2340000, 'rating' => 4.8],
                                    ['name' => 'Bãi đỗ xe TimeCity', 'bookings' => 38, 'revenue' => 1980000, 'rating' => 4.6],
                                    ['name' => 'Bãi đỗ xe Royal City', 'bookings' => 32, 'revenue' => 1750000, 'rating' => 4.5],
                                    ['name' => 'Bãi đỗ xe Vincom Bà Triệu', 'bookings' => 28, 'revenue' => 1560000, 'rating' => 4.3],
                                    ['name' => 'Bãi đỗ xe Lotte Center', 'bookings' => 25, 'revenue' => 1320000, 'rating' => 4.4],
                                ];
                            @endphp
                            @foreach($topParkingLots as $parking)
                            <tr>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="flex px-2 py-1">
                                        <div class="flex flex-col justify-center">
                                            <h6 class="mb-0 leading-normal text-sm">{{ $parking['name'] }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span class="text-xs font-semibold leading-tight text-slate-400">{{ $parking['bookings'] }} booking</span>
                                </td>
                                <td class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span class="font-semibold leading-tight text-xs text-slate-400">{{ number_format($parking['revenue']) }}đ</span>
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="flex items-center justify-center">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star text-xs {{ $i <= round($parking['rating']) ? 'text-yellow-500' : 'text-gray-300' }}"></i>
                                        @endfor
                                        <span class="ml-1 text-xs">{{ $parking['rating'] }}</span>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activities -->
    <div class="w-full max-w-full px-3 mb-6 lg:w-6/12 lg:flex-none">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6 class="mb-0 dark:text-white">Hoạt động gần đây</h6>
            </div>
            <div class="flex-auto p-0">
                <div class="p-6">
                    @php
                        $recentActivities = [
                            ['type' => 'booking', 'user' => 'Nguyễn Văn A', 'action' => 'đã đặt chỗ tại Bãi đỗ xe AEON Mall', 'time' => '5 phút trước', 'icon' => 'fas fa-calendar-plus', 'color' => 'text-green-600'],
                            ['type' => 'payment', 'user' => 'Trần Thị B', 'action' => 'đã thanh toán 150,000đ', 'time' => '12 phút trước', 'icon' => 'fas fa-credit-card', 'color' => 'text-blue-600'],
                            ['type' => 'review', 'user' => 'Lê Văn C', 'action' => 'đã đánh giá 5 sao cho TimeCity', 'time' => '23 phút trước', 'icon' => 'fas fa-star', 'color' => 'text-yellow-600'],
                            ['type' => 'register', 'user' => 'Phạm Thị D', 'action' => 'đã đăng ký tài khoản mới', 'time' => '1 giờ trước', 'icon' => 'fas fa-user-plus', 'color' => 'text-purple-600'],
                            ['type' => 'booking', 'user' => 'Hoàng Văn E', 'action' => 'đã hủy booking tại Royal City', 'time' => '2 giờ trước', 'icon' => 'fas fa-times-circle', 'color' => 'text-red-600'],
                        ];
                    @endphp
                    <div class="space-y-4">
                        @foreach($recentActivities as $activity)
                        <div class="flex items-center">
                            <div class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-full bg-gray-100">
                                <i class="{{ $activity['icon'] }} text-sm {{ $activity['color'] }}"></i>
                            </div>
                            <div class="ml-3 flex-grow">
                                <p class="text-sm text-gray-700">
                                    <span class="font-semibold">{{ $activity['user'] }}</span>
                                    {{ $activity['action'] }}
                                </p>
                                <p class="text-xs text-gray-500">{{ $activity['time'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Detailed Analytics -->
<div class="flex flex-wrap -mx-3 mb-6">
    <!-- Monthly Comparison -->
    <div class="w-full max-w-full px-3 mb-6">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <div class="flex items-center justify-between">
                    <h6 class="mb-0 dark:text-white">So sánh theo tháng</h6>
                    <div class="flex space-x-2">
                        <select id="monthFilter" class="px-3 py-1 text-sm border rounded-lg">
                            <option value="12">12 tháng</option>
                            <option value="6">6 tháng</option>
                            <option value="3">3 tháng</option>
                        </select>
                        <button id="exportData" class="px-4 py-1 text-sm text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                            <i class="fas fa-download mr-1"></i>Xuất dữ liệu
                        </button>
                    </div>
                </div>
            </div>
            <div class="flex-auto p-6">
                <div class="overflow-x-auto">
                    <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                        <thead class="align-bottom">
                            <tr>
                                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Tháng</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Doanh thu</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Booking</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Người dùng mới</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Đánh giá TB</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Tăng trưởng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $monthlyData = [
                                    ['month' => 'Tháng 1/2024', 'revenue' => 8950000, 'bookings' => 245, 'new_users' => 18, 'rating' => 4.1, 'growth' => '+15%'],
                                    ['month' => 'Tháng 2/2024', 'revenue' => 9240000, 'bookings' => 267, 'new_users' => 22, 'rating' => 4.2, 'growth' => '+18%'],
                                    ['month' => 'Tháng 3/2024', 'revenue' => 10150000, 'bookings' => 289, 'new_users' => 25, 'rating' => 4.3, 'growth' => '+22%'],
                                    ['month' => 'Tháng 4/2024', 'revenue' => 11200000, 'bookings' => 312, 'new_users' => 28, 'rating' => 4.2, 'growth' => '+25%'],
                                    ['month' => 'Tháng 5/2024', 'revenue' => 12450000, 'bookings' => 342, 'new_users' => 32, 'rating' => 4.4, 'growth' => '+28%'],
                                ];
                            @endphp
                            @foreach($monthlyData as $data)
                            <tr>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <h6 class="mb-0 leading-normal text-sm">{{ $data['month'] }}</h6>
                                </td>
                                <td class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span class="font-semibold">{{ number_format($data['revenue']) }}đ</span>
                                </td>
                                <td class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span class="font-semibold">{{ $data['bookings'] }}</span>
                                </td>
                                <td class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span class="font-semibold">{{ $data['new_users'] }}</span>
                                </td>
                                <td class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="flex items-center justify-center">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star text-xs {{ $i <= round($data['rating']) ? 'text-yellow-500' : 'text-gray-300' }}"></i>
                                        @endfor
                                        <span class="ml-1 text-xs">{{ $data['rating'] }}</span>
                                    </div>
                                </td>
                                <td class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span class="font-semibold text-emerald-500">{{ $data['growth'] }}</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Revenue Chart
    const revenueCtx = document.getElementById('revenueChart').getContext('2d');
    const revenueChart = new Chart(revenueCtx, {
        type: 'line',
        data: {
            labels: ['T1', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'T8', 'T9', 'T10', 'T11', 'T12'],
            datasets: [{
                label: 'Doanh thu (triệu đồng)',
                data: [8.95, 9.24, 10.15, 11.2, 12.45, 11.8, 13.2, 14.5, 13.8, 15.2, 16.4, 17.8],
                borderColor: 'rgb(59, 130, 246)',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        drawBorder: false,
                        color: 'rgba(0,0,0,0.1)'
                    },
                    ticks: {
                        callback: function(value) {
                            return value + 'tr';
                        }
                    }
                },
                x: {
                    grid: {
                        drawBorder: false,
                        display: false
                    }
                }
            }
        }
    });

    // Booking Status Chart
    const bookingStatusCtx = document.getElementById('bookingStatusChart').getContext('2d');
    const bookingStatusChart = new Chart(bookingStatusCtx, {
        type: 'doughnut',
        data: {
            labels: ['Hoàn thành', 'Đang chờ', 'Đã hủy', 'Đang sử dụng'],
            datasets: [{
                data: [68, 15, 12, 5],
                backgroundColor: [
                    'rgb(34, 197, 94)',
                    'rgb(59, 130, 246)',
                    'rgb(239, 68, 68)',
                    'rgb(245, 158, 11)'
                ],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        usePointStyle: true
                    }
                }
            }
        }
    });

    // Export data functionality
    window.exportData = function(type) {
        alert(`Xuất dữ liệu ${type} đang được phát triển! Sẽ sớm có trong phiên bản tiếp theo.`);
    };

    if (document.getElementById('exportData')) {
        document.getElementById('exportData').addEventListener('click', function() {
            alert('Chức năng xuất dữ liệu sẽ được phát triển trong phiên bản tiếp theo!');
        });
    }

    // Month filter functionality
    if (document.getElementById('monthFilter')) {
        document.getElementById('monthFilter').addEventListener('change', function() {
            const months = parseInt(this.value);
            // In a real application, this would trigger an AJAX request to filter data
            console.log('Filtering data for last', months, 'months');
        });
    }
});
</script>
@endpush
