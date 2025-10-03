@extends('admin.layout')
@section('page-title', 'Báo cáo Doanh thu - Paspark Admin')
@section('page-heading', 'Báo cáo Doanh thu')

@section('content')
<!-- Filter Section -->
<div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <div class="flex items-center justify-between mb-4">
                    <h6 class="mb-0 dark:text-white">Bộ lọc báo cáo</h6>
                </div>
            </div>
            <div class="flex-auto p-6">
                <form id="revenueFilterForm" class="flex flex-wrap -mx-3">
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
                            <button type="button" id="exportRevenue" class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer bg-gradient-to-tl from-green-600 to-lime-400 leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs">
                                <i class="fas fa-download mr-2"></i>Xuất Excel
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Revenue Summary Cards -->
<div class="flex flex-wrap -mx-3 mb-6">
    <!-- Total Revenue -->
    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p class="mb-0 font-sans font-semibold leading-normal uppercase text-sm text-slate-400">Tổng doanh thu</p>
                            <h5 class="mb-2 font-bold text-slate-700 dark:text-white" id="totalRevenue">{{ number_format(15420000) }}đ</h5>
                            <p class="mb-0 text-slate-400">
                                <span class="font-bold leading-normal text-emerald-500 text-sm">+23%</span>
                                so với kỳ trước
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

    <!-- Average Revenue per Day -->
    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p class="mb-0 font-sans font-semibold leading-normal uppercase text-sm text-slate-400">Trung bình/ngày</p>
                            <h5 class="mb-2 font-bold text-slate-700 dark:text-white" id="avgRevenue">{{ number_format(514000) }}đ</h5>
                            <p class="mb-0 text-slate-400">
                                <span class="font-bold leading-normal text-emerald-500 text-sm">+12%</span>
                                tăng so với trước
                            </p>
                        </div>
                    </div>
                    <div class="w-4/12 max-w-full px-3 ml-auto text-right flex-none">
                        <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-emerald-500 to-teal-400">
                            <i class="fas fa-chart-line text-lg relative top-3.5 text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Highest Revenue Day -->
    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p class="mb-0 font-sans font-semibold leading-normal uppercase text-sm text-slate-400">Ngày cao nhất</p>
                            <h5 class="mb-2 font-bold text-slate-700 dark:text-white" id="peakRevenue">{{ number_format(1250000) }}đ</h5>
                            <p class="mb-0 text-slate-400">
                                <span class="text-xs">28/09/2024</span>
                            </p>
                        </div>
                    </div>
                    <div class="w-4/12 max-w-full px-3 ml-auto text-right flex-none">
                        <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-orange-500 to-yellow-500">
                            <i class="fas fa-trophy text-lg relative top-3.5 text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Growth Rate -->
    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p class="mb-0 font-sans font-semibold leading-normal uppercase text-sm text-slate-400">Tỷ lệ tăng trưởng</p>
                            <h5 class="mb-2 font-bold text-slate-700 dark:text-white" id="growthRate">+23.5%</h5>
                            <p class="mb-0 text-slate-400">
                                <span class="font-bold leading-normal text-emerald-500 text-sm">Tích cực</span>
                            </p>
                        </div>
                    </div>
                    <div class="w-4/12 max-w-full px-3 ml-auto text-right flex-none">
                        <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-red-600 to-orange-600">
                            <i class="fas fa-arrow-up text-lg relative top-3.5 text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Revenue Chart -->
<div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <div class="flex items-center justify-between mb-4">
                    <h6 class="mb-0 dark:text-white">Biểu đồ doanh thu theo thời gian</h6>
                    <div class="flex space-x-2">
                        <button type="button" class="chart-period-btn active" data-period="daily">Theo ngày</button>
                        <button type="button" class="chart-period-btn" data-period="weekly">Theo tuần</button>
                        <button type="button" class="chart-period-btn" data-period="monthly">Theo tháng</button>
                    </div>
                </div>
            </div>
            <div class="flex-auto p-6">
                <div class="overflow-hidden">
                    <canvas id="revenueChart" class="max-h-96"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Revenue by Parking Lot -->
<div class="flex flex-wrap -mx-3 mb-6">
    <!-- Revenue Table -->
    <div class="w-full max-w-full px-3 mb-6 lg:w-8/12 lg:flex-none">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6 class="mb-0 dark:text-white">Doanh thu theo bãi đỗ xe</h6>
            </div>
            <div class="flex-auto p-0">
                <div class="p-6 overflow-x-auto">
                    <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                        <thead class="align-bottom">
                            <tr>
                                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Bãi đỗ xe</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Doanh thu</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Số booking</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">TB/booking</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">% tổng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $revenueData = [
                                    ['name' => 'Bãi đỗ xe AEON Mall Hà Đông', 'revenue' => 4250000, 'bookings' => 45, 'avg' => 94444, 'percentage' => 27.6],
                                    ['name' => 'Bãi đỗ xe TimeCity', 'revenue' => 3890000, 'bookings' => 38, 'avg' => 102368, 'percentage' => 25.2],
                                    ['name' => 'Bãi đỗ xe Royal City', 'revenue' => 3240000, 'bookings' => 32, 'avg' => 101250, 'percentage' => 21.0],
                                    ['name' => 'Bãi đỗ xe Vincom Bà Triệu', 'revenue' => 2560000, 'bookings' => 28, 'avg' => 91429, 'percentage' => 16.6],
                                    ['name' => 'Bãi đỗ xe Lotte Center', 'revenue' => 1480000, 'bookings' => 25, 'avg' => 59200, 'percentage' => 9.6],
                                ];
                            @endphp
                            @foreach($revenueData as $data)
                            <tr>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="flex px-2 py-1">
                                        <div class="flex flex-col justify-center">
                                            <h6 class="mb-0 leading-normal text-sm">{{ $data['name'] }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span class="font-semibold leading-tight text-xs text-slate-400">{{ number_format($data['revenue']) }}đ</span>
                                </td>
                                <td class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span class="font-semibold leading-tight text-xs text-slate-400">{{ $data['bookings'] }}</span>
                                </td>
                                <td class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span class="font-semibold leading-tight text-xs text-slate-400">{{ number_format($data['avg']) }}đ</span>
                                </td>
                                <td class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="flex items-center justify-center">
                                        <span class="font-semibold leading-tight text-xs text-slate-400">{{ $data['percentage'] }}%</span>
                                        <div class="ml-2 w-12 h-2 bg-gray-200 rounded overflow-hidden">
                                            <div class="h-full bg-blue-500" style="width: {{ $data['percentage'] }}%"></div>
                                        </div>
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

    <!-- Revenue Distribution Chart -->
    <div class="w-full max-w-full px-3 mb-6 lg:w-4/12 lg:flex-none">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6 class="mb-0 dark:text-white">Phân bố doanh thu</h6>
            </div>
            <div class="flex-auto p-6">
                <div class="overflow-hidden">
                    <canvas id="revenueDistributionChart" class="max-h-80"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.chart-period-btn {
    @apply px-3 py-1 text-sm border rounded-lg mr-2 transition-colors;
}
.chart-period-btn.active {
    @apply bg-blue-600 text-white border-blue-600;
}
.chart-period-btn:not(.active) {
    @apply bg-gray-100 text-gray-700 border-gray-300 hover:bg-gray-200;
}
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Revenue Chart
    const revenueCtx = document.getElementById('revenueChart').getContext('2d');
    let revenueChart = new Chart(revenueCtx, {
        type: 'line',
        data: {
            labels: ['01/10', '02/10', '03/10', '04/10', '05/10', '06/10', '07/10', '08/10', '09/10', '10/10'],
            datasets: [{
                label: 'Doanh thu (đ)',
                data: [450000, 520000, 380000, 720000, 650000, 890000, 1200000, 980000, 750000, 600000],
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
                            return new Intl.NumberFormat('vi-VN').format(value) + 'đ';
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

    // Revenue Distribution Chart
    const distributionCtx = document.getElementById('revenueDistributionChart').getContext('2d');
    const distributionChart = new Chart(distributionCtx, {
        type: 'doughnut',
        data: {
            labels: ['AEON Mall', 'TimeCity', 'Royal City', 'Vincom BT', 'Lotte Center'],
            datasets: [{
                data: [27.6, 25.2, 21.0, 16.6, 9.6],
                backgroundColor: [
                    'rgb(59, 130, 246)',
                    'rgb(34, 197, 94)',
                    'rgb(245, 158, 11)',
                    'rgb(239, 68, 68)',
                    'rgb(168, 85, 247)'
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

    // Chart period buttons
    document.querySelectorAll('.chart-period-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.chart-period-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            const period = this.dataset.period;
            updateChartData(period);
        });
    });

    function updateChartData(period) {
        let labels, data;

        switch(period) {
            case 'weekly':
                labels = ['Tuần 1', 'Tuần 2', 'Tuần 3', 'Tuần 4'];
                data = [3200000, 4100000, 3800000, 4320000];
                break;
            case 'monthly':
                labels = ['T1', 'T2', 'T3', 'T4', 'T5', 'T6'];
                data = [8950000, 9240000, 10150000, 11200000, 12450000, 13800000];
                break;
            default: // daily
                labels = ['01/10', '02/10', '03/10', '04/10', '05/10', '06/10', '07/10', '08/10', '09/10', '10/10'];
                data = [450000, 520000, 380000, 720000, 650000, 890000, 1200000, 980000, 750000, 600000];
        }

        revenueChart.data.labels = labels;
        revenueChart.data.datasets[0].data = data;
        revenueChart.update();
    }

    // Export functionality
    document.getElementById('exportRevenue').addEventListener('click', function() {
        alert('Xuất dữ liệu Excel đang được phát triển!');
    });

    // Apply filter functionality
    document.getElementById('applyFilter').addEventListener('click', function() {
        const startDate = document.getElementById('start_date').value;
        const endDate = document.getElementById('end_date').value;
        const parkingLot = document.getElementById('parking_lot_filter').value;

        console.log('Filtering revenue data:', { startDate, endDate, parkingLot });
        // In real app, this would trigger AJAX request to filter data
        alert('Lọc dữ liệu: ' + startDate + ' đến ' + endDate + (parkingLot ? ' - Bãi đỗ xe: ' + parkingLot : ''));
    });
});
</script>
@endpush
