@extends('admin.layout')
@section('page-title', 'Báo cáo Sử dụng - Paspark Admin')
@section('page-heading', 'Báo cáo Sử dụng')

@section('content')
<!-- Filter Section -->
<div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <div class="flex items-center justify-between mb-4">
                    <h6 class="mb-0 dark:text-white">Bộ lọc báo cáo sử dụng</h6>
                </div>
            </div>
            <div class="flex-auto p-6">
                <form id="usageFilterForm" class="flex flex-wrap -mx-3">
                    <div class="w-full max-w-full px-3 mb-4 md:w-3/12 md:flex-none">
                        <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Từ ngày:</label>
                        <input type="date" id="start_date" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" value="{{ now()->subDays(30)->format('Y-m-d') }}">
                    </div>
                    <div class="w-full max-w-full px-3 mb-4 md:w-3/12 md:flex-none">
                        <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Đến ngày:</label>
                        <input type="date" id="end_date" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" value="{{ now()->format('Y-m-d') }}">
                    </div>
                    <div class="w-full max-w-full px-3 mb-4 md:w-3/12 md:flex-none">
                        <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Bãi đỗ xe:</label>
                        <select id="parking_lot_filter" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow">
                            <option value="">Tất cả bãi đỗ xe</option>
                            <option value="1">Bãi đỗ xe AEON Mall Hà Đông</option>
                            <option value="2">Bãi đỗ xe TimeCity</option>
                            <option value="3">Bãi đỗ xe Royal City</option>
                            <option value="4">Bãi đỗ xe Vincom Bà Triệu</option>
                            <option value="5">Bãi đỗ xe Lotte Center</option>
                        </select>
                    </div>
                    <div class="w-full max-w-full px-3 mb-4 md:w-3/12 md:flex-none">
                        <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">&nbsp;</label>
                        <div class="flex space-x-2">
                            <button type="button" id="applyFilter" class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer bg-gradient-to-tl from-blue-600 to-cyan-400 leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs">
                                <i class="fas fa-filter mr-2"></i>Lọc
                            </button>
                            <button type="button" id="exportUsage" class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer bg-gradient-to-tl from-green-600 to-lime-400 leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs">
                                <i class="fas fa-download mr-2"></i>Xuất Excel
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Usage Summary Cards -->
<div class="flex flex-wrap -mx-3 mb-6">
    <!-- Total Bookings -->
    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p class="mb-0 font-sans font-semibold leading-normal uppercase text-sm text-slate-400">Tổng lượt đặt</p>
                            <h5 class="mb-2 font-bold text-slate-700 dark:text-white" id="totalBookings">1,247</h5>
                            <p class="mb-0 text-slate-400">
                                <span class="font-bold leading-normal text-emerald-500 text-sm">+15%</span>
                                so với tháng trước
                            </p>
                        </div>
                    </div>
                    <div class="w-4/12 max-w-full px-3 ml-auto text-right flex-none">
                        <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-blue-500 to-violet-500">
                            <i class="fas fa-calendar-check text-lg relative top-3.5 text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Average Occupancy -->
    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p class="mb-0 font-sans font-semibold leading-normal uppercase text-sm text-slate-400">Tỷ lệ sử dụng</p>
                            <h5 class="mb-2 font-bold text-slate-700 dark:text-white" id="occupancyRate">73.4%</h5>
                            <p class="mb-0 text-slate-400">
                                <span class="font-bold leading-normal text-emerald-500 text-sm">+8%</span>
                                tăng so với trước
                            </p>
                        </div>
                    </div>
                    <div class="w-4/12 max-w-full px-3 ml-auto text-right flex-none">
                        <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-emerald-500 to-teal-400">
                            <i class="fas fa-percentage text-lg relative top-3.5 text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Peak Hour -->
    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p class="mb-0 font-sans font-semibold leading-normal uppercase text-sm text-slate-400">Giờ cao điểm</p>
                            <h5 class="mb-2 font-bold text-slate-700 dark:text-white" id="peakHour">18:00 - 20:00</h5>
                            <p class="mb-0 text-slate-400">
                                <span class="text-xs">94% sử dụng</span>
                            </p>
                        </div>
                    </div>
                    <div class="w-4/12 max-w-full px-3 ml-auto text-right flex-none">
                        <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-orange-500 to-yellow-500">
                            <i class="fas fa-clock text-lg relative top-3.5 text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Average Duration -->
    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p class="mb-0 font-sans font-semibold leading-normal uppercase text-sm text-slate-400">Thời gian TB</p>
                            <h5 class="mb-2 font-bold text-slate-700 dark:text-white" id="avgDuration">2.4 giờ</h5>
                            <p class="mb-0 text-slate-400">
                                <span class="font-bold leading-normal text-blue-500 text-sm">Ổn định</span>
                            </p>
                        </div>
                    </div>
                    <div class="w-4/12 max-w-full px-3 ml-auto text-right flex-none">
                        <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-red-600 to-orange-600">
                            <i class="fas fa-hourglass-half text-lg relative top-3.5 text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Charts Section -->
<div class="flex flex-wrap -mx-3 mb-6">
    <!-- Hourly Usage Chart -->
    <div class="w-full max-w-full px-3 mb-6 lg:w-8/12 lg:flex-none">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <div class="flex items-center justify-between mb-4">
                    <h6 class="mb-0 dark:text-white">Biểu đồ sử dụng theo giờ</h6>
                    <div class="flex space-x-2">
                        <button type="button" class="usage-period-btn active" data-period="today">Hôm nay</button>
                        <button type="button" class="usage-period-btn" data-period="week">Tuần này</button>
                        <button type="button" class="usage-period-btn" data-period="month">Tháng này</button>
                    </div>
                </div>
            </div>
            <div class="flex-auto p-6">
                <div class="overflow-hidden">
                    <canvas id="hourlyUsageChart" class="max-h-80"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Booking Status Distribution -->
    <div class="w-full max-w-full px-3 mb-6 lg:w-4/12 lg:flex-none">
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

<!-- Detailed Usage Analytics -->
<div class="flex flex-wrap -mx-3 mb-6">
    <!-- Usage by Parking Lot -->
    <div class="w-full max-w-full px-3 mb-6 lg:w-6/12 lg:flex-none">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6 class="mb-0 dark:text-white">Sử dụng theo bãi đỗ xe</h6>
            </div>
            <div class="flex-auto p-0">
                <div class="p-6 overflow-x-auto">
                    <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                        <thead class="align-bottom">
                            <tr>
                                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Bãi đỗ xe</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Booking</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Tỷ lệ sử dụng</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">TB giờ/booking</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $usageData = [
                                    ['name' => 'AEON Mall Hà Đông', 'bookings' => 145, 'occupancy' => 89.2, 'avg_hours' => 2.8],
                                    ['name' => 'TimeCity', 'bookings' => 132, 'occupancy' => 84.5, 'avg_hours' => 2.3],
                                    ['name' => 'Royal City', 'bookings' => 118, 'occupancy' => 76.8, 'avg_hours' => 2.1],
                                    ['name' => 'Vincom Bà Triệu', 'bookings' => 98, 'occupancy' => 72.4, 'avg_hours' => 2.6],
                                    ['name' => 'Lotte Center', 'bookings' => 78, 'occupancy' => 65.3, 'avg_hours' => 1.9],
                                ];
                            @endphp
                            @foreach($usageData as $data)
                            <tr>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="flex px-2 py-1">
                                        <div class="flex flex-col justify-center">
                                            <h6 class="mb-0 leading-normal text-sm">{{ $data['name'] }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span class="font-semibold leading-tight text-xs text-slate-400">{{ $data['bookings'] }}</span>
                                </td>
                                <td class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="flex items-center justify-center">
                                        <span class="font-semibold leading-tight text-xs text-slate-400">{{ $data['occupancy'] }}%</span>
                                        <div class="ml-2 w-12 h-2 bg-gray-200 rounded overflow-hidden">
                                            <div class="h-full bg-green-500" style="width: {{ $data['occupancy'] }}%"></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span class="font-semibold leading-tight text-xs text-slate-400">{{ $data['avg_hours'] }}h</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Peak Hours Analysis -->
    <div class="w-full max-w-full px-3 mb-6 lg:w-6/12 lg:flex-none">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6 class="mb-0 dark:text-white">Phân tích giờ cao điểm</h6>
            </div>
            <div class="flex-auto p-6">
                <div class="space-y-4">
                    @php
                        $peakHours = [
                            ['time' => '7:00 - 9:00', 'usage' => 85, 'color' => 'bg-red-500', 'label' => 'Cao điểm sáng'],
                            ['time' => '12:00 - 14:00', 'usage' => 72, 'color' => 'bg-orange-500', 'label' => 'Cao điểm trưa'],
                            ['time' => '17:00 - 20:00', 'usage' => 94, 'color' => 'bg-red-600', 'label' => 'Cao điểm chiều'],
                            ['time' => '20:00 - 22:00', 'usage' => 68, 'color' => 'bg-yellow-500', 'label' => 'Giờ tối'],
                        ];
                    @endphp
                    @foreach($peakHours as $peak)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center">
                            <div class="w-3 h-3 {{ $peak['color'] }} rounded-full mr-3"></div>
                            <div>
                                <h6 class="text-sm font-semibold">{{ $peak['time'] }}</h6>
                                <p class="text-xs text-gray-600">{{ $peak['label'] }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="text-lg font-bold text-gray-800">{{ $peak['usage'] }}%</div>
                            <div class="w-16 h-2 bg-gray-200 rounded overflow-hidden">
                                <div class="h-full {{ $peak['color'] }}" style="width: {{ $peak['usage'] }}%"></div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Weekly Pattern -->
<div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6 class="mb-0 dark:text-white">Mẫu sử dụng theo tuần</h6>
            </div>
            <div class="flex-auto p-6">
                <div class="overflow-hidden">
                    <canvas id="weeklyPatternChart" class="max-h-80"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.usage-period-btn {
    @apply px-3 py-1 text-sm border rounded-lg mr-2 transition-colors;
}
.usage-period-btn.active {
    @apply bg-blue-600 text-white border-blue-600;
}
.usage-period-btn:not(.active) {
    @apply bg-gray-100 text-gray-700 border-gray-300 hover:bg-gray-200;
}
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Hourly Usage Chart
    const hourlyCtx = document.getElementById('hourlyUsageChart').getContext('2d');
    let hourlyChart = new Chart(hourlyCtx, {
        type: 'bar',
        data: {
            labels: ['6h', '7h', '8h', '9h', '10h', '11h', '12h', '13h', '14h', '15h', '16h', '17h', '18h', '19h', '20h', '21h', '22h', '23h'],
            datasets: [{
                label: 'Tỷ lệ sử dụng (%)',
                data: [45, 82, 89, 78, 65, 58, 72, 85, 69, 52, 48, 76, 88, 94, 91, 74, 62, 38],
                backgroundColor: 'rgba(59, 130, 246, 0.8)',
                borderColor: 'rgb(59, 130, 246)',
                borderWidth: 1
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
                    max: 100,
                    grid: {
                        drawBorder: false,
                        color: 'rgba(0,0,0,0.1)'
                    },
                    ticks: {
                        callback: function(value) {
                            return value + '%';
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
    const statusCtx = document.getElementById('bookingStatusChart').getContext('2d');
    const statusChart = new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: ['Hoàn thành', 'Đang sử dụng', 'Đang chờ', 'Đã hủy'],
            datasets: [{
                data: [68, 12, 15, 5],
                backgroundColor: [
                    'rgb(34, 197, 94)',
                    'rgb(59, 130, 246)',
                    'rgb(245, 158, 11)',
                    'rgb(239, 68, 68)'
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

    // Weekly Pattern Chart
    const weeklyCtx = document.getElementById('weeklyPatternChart').getContext('2d');
    const weeklyChart = new Chart(weeklyCtx, {
        type: 'line',
        data: {
            labels: ['Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7', 'Chủ nhật'],
            datasets: [{
                label: 'Số booking',
                data: [145, 162, 178, 185, 195, 234, 187],
                borderColor: 'rgb(34, 197, 94)',
                backgroundColor: 'rgba(34, 197, 94, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4
            }, {
                label: 'Tỷ lệ sử dụng (%)',
                data: [72, 78, 82, 85, 89, 94, 81],
                borderColor: 'rgb(245, 158, 11)',
                backgroundColor: 'rgba(245, 158, 11, 0.1)',
                borderWidth: 3,
                fill: false,
                tension: 0.4,
                yAxisID: 'y1'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            },
            scales: {
                y: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                    grid: {
                        drawBorder: false,
                        color: 'rgba(0,0,0,0.1)'
                    }
                },
                y1: {
                    type: 'linear',
                    display: true,
                    position: 'right',
                    max: 100,
                    grid: {
                        drawOnChartArea: false,
                    },
                    ticks: {
                        callback: function(value) {
                            return value + '%';
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

    // Period buttons functionality
    document.querySelectorAll('.usage-period-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.usage-period-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            const period = this.dataset.period;
            updateUsageData(period);
        });
    });

    function updateUsageData(period) {
        let labels, data;

        switch(period) {
            case 'week':
                labels = ['T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'CN'];
                data = [72, 78, 82, 85, 89, 94, 81];
                break;
            case 'month':
                labels = ['Tuần 1', 'Tuần 2', 'Tuần 3', 'Tuần 4'];
                data = [78, 82, 86, 89];
                break;
            default: // today
                labels = ['6h', '7h', '8h', '9h', '10h', '11h', '12h', '13h', '14h', '15h', '16h', '17h', '18h', '19h', '20h', '21h', '22h', '23h'];
                data = [45, 82, 89, 78, 65, 58, 72, 85, 69, 52, 48, 76, 88, 94, 91, 74, 62, 38];
        }

        hourlyChart.data.labels = labels;
        hourlyChart.data.datasets[0].data = data;
        hourlyChart.update();
    }

    // Export functionality
    document.getElementById('exportUsage').addEventListener('click', function() {
        alert('Xuất dữ liệu Excel đang được phát triển!');
    });

    // Apply filter functionality
    document.getElementById('applyFilter').addEventListener('click', function() {
        const startDate = document.getElementById('start_date').value;
        const endDate = document.getElementById('end_date').value;
        const parkingLot = document.getElementById('parking_lot_filter').value;

        console.log('Filtering usage data:', { startDate, endDate, parkingLot });
        alert('Lọc dữ liệu: ' + startDate + ' đến ' + endDate + (parkingLot ? ' - Bãi đỗ xe: ' + parkingLot : ''));
    });
});
</script>
@endpush
