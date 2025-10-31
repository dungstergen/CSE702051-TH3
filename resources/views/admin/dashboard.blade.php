@extends('admin.layout')
@section('page-title', 'Dashboard - Paspark Admin')
@section('page-heading', 'Dashboard')

@section('content')
    <!-- Statistics Cards Row -->
    <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
            <div
                class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                <div class="flex-auto p-4">
                    <div class="flex flex-row -mx-3">
                        <div class="flex-none w-2/3 max-w-full px-3">
                            <div>
                                <p
                                    class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">
                                    Tổng doanh thu</p>
                                <h5 class="mb-2 font-bold dark:text-white">{{ number_format($totalRevenue ?? 0) }}đ</h5>
                                <p class="mb-0 dark:text-white dark:opacity-60">
                                    @php $revUp = ($revenueMoMPct ?? 0) >= 0; @endphp
                                    <span
                                        class="text-sm font-bold leading-normal {{ $revUp ? 'text-emerald-500' : 'text-red-500' }}">{{ $revUp ? '+' : '' }}{{ $revenueMoMPct ?? 0 }}%</span>
                                    so với tháng trước
                                </p>
                            </div>
                        </div>
                        <div class="px-3 text-right basis-1/3">
                            <div
                                class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-blue-500 to-violet-500">
                                <i class="ni leading-none ni-money-coins text-lg relative top-3.5 text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
            <div
                class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                <div class="flex-auto p-4">
                    <div class="flex flex-row -mx-3">
                        <div class="flex-none w-2/3 max-w-full px-3">
                            <div>
                                <p
                                    class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">
                                    Tổng số user</p>
                                <h5 class="mb-2 font-bold dark:text-white">{{ $totalUsers ?? 0 }}</h5>
                                <p class="mb-0 dark:text-white dark:opacity-60">
                                    @php $userUp = ($usersMoMPct ?? 0) >= 0; @endphp
                                    <span
                                        class="text-sm font-bold leading-normal {{ $userUp ? 'text-emerald-500' : 'text-red-500' }}">{{ $userUp ? '+' : '' }}{{ $usersMoMPct ?? 0 }}%</span>
                                    so với tháng trước
                                </p>
                            </div>
                        </div>
                        <div class="px-3 text-right basis-1/3">
                            <div
                                class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-red-600 to-orange-600">
                                <i class="ni leading-none ni-world text-lg relative top-3.5 text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
            <div
                class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                <div class="flex-auto p-4">
                    <div class="flex flex-row -mx-3">
                        <div class="flex-none w-2/3 max-w-full px-3">
                            <div>
                                <p
                                    class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">
                                    Tổng đặt chỗ</p>
                                <h5 class="mb-2 font-bold dark:text-white">{{ $totalBookings ?? 0 }}</h5>
                                <p class="mb-0 dark:text-white dark:opacity-60">
                                    @php $bookUp = ($bookingsMoMPct ?? 0) >= 0; @endphp
                                    <span
                                        class="text-sm font-bold leading-normal {{ $bookUp ? 'text-emerald-500' : 'text-red-500' }}">{{ $bookUp ? '+' : '' }}{{ $bookingsMoMPct ?? 0 }}%</span>
                                    so với tháng trước
                                </p>
                            </div>
                        </div>
                        <div class="px-3 text-right basis-1/3">
                            <div
                                class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-emerald-500 to-teal-400">
                                <i class="ni leading-none ni-paper-diploma text-lg relative top-3.5 text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full max-w-full px-3 sm:w-1/2 sm:flex-none xl:w-1/4">
            <div
                class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                <div class="flex-auto p-4">
                    <div class="flex flex-row -mx-3">
                        <div class="flex-none w-2/3 max-w-full px-3">
                            <div>
                                <p
                                    class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">
                                    Tổng bãi đỗ xe</p>
                                <h5 class="mb-2 font-bold dark:text-white">{{ $totalParkingLots ?? 0 }}</h5>
                                <p class="mb-0 dark:text-white dark:opacity-60">
                                    <span
                                        class="text-sm font-bold leading-normal text-emerald-500">+{{ $newParkingLotsCount ?? 0 }}</span>
                                    bãi mới tháng này
                                </p>
                            </div>
                        </div>
                        <div class="px-3 text-right basis-1/3">
                            <div
                                class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-orange-500 to-yellow-500">
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
            <div
                class="border-black/12.5 dark:bg-slate-850 dark:shadow-dark-xl shadow-xl relative z-20 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
                <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid p-6 pt-4 pb-0">
                    <h6 class="capitalize dark:text-white">Xu hướng doanh thu (7 ngày qua)</h6>
                    <p class="mb-0 text-sm leading-normal dark:text-white dark:opacity-60">
                        <i id="revenue-trend-icon" class="fa"></i>
                        <span id="revenue-trend-text" class="font-semibold">Đang tính…</span>
                        <span class="opacity-70">so với tuần trước</span>
                    </p>
                </div>
                <div class="flex-auto p-4">
                    <canvas id="revenue-chart" height="300"></canvas>
                </div>
            </div>
        </div>

        <div class="w-full max-w-full px-3 lg:w-5/12 lg:flex-none">
            <div
                class="border-black/12.5 dark:bg-slate-850 dark:shadow-dark-xl shadow-xl relative z-20 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
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
            <div
                class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                    <div class="flex items-center justify-between">
                        <h6 class="mb-0 dark:text-white">Gói dịch vụ phổ biến</h6>
                        <a href="{{ route('admin.service-packages.index') }}"
                            class="text-blue-600 hover:text-blue-800 text-sm" style="color:#2563EB;">
                            <i class="fas fa-arrow-right mr-1"></i>Xem tất cả
                        </a>
                    </div>
                </div>
                <div class="flex-auto p-6">
                    <div class="space-y-3">
                        @if(isset($topPackages) && count($topPackages) > 0)
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
                        @else
                            <div class="text-sm text-slate-500">Chưa có dữ liệu gói dịch vụ trong 30 ngày qua.</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>


    </div>

    <!-- Recent Bookings Table -->
    <div class="flex flex-wrap -mx-3">
        <div class="w-full max-w-full px-3">
            <div
                class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                    <div class="flex items-center justify-between">
                        <h6 class="mb-0 dark:text-white">Đặt chỗ gần đây</h6>
                        <a href="{{ route('admin.bookings.index') }}"
                            class="text-blue-600 hover:text-blue-800 text-sm" style="color:#2563EB;">
                            <i class="fas fa-arrow-right mr-1"></i>Xem tất cả
                        </a>
                    </div>
                </div>
                <div class="flex-auto px-0 pt-0 pb-2">
                    <div class="p-0 overflow-x-auto">
                        <table
                            class="items-center w-full mb-0 align-top border-collapse dark:border-white/40 text-slate-500">
                            <thead class="align-bottom">
                                <tr>
                                    <th
                                        class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        Khách hàng</th>
                                    <th
                                        class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        Bãi đỗ xe</th>
                                    <th
                                        class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        Thời gian</th>
                                    <th
                                        class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        Số tiền</th>
                                    <th
                                        class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentBookings ?? [] as $booking)
                                    <tr>
                                        <td
                                            class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                            <div class="flex px-2 py-1">
                                                <div class="flex flex-col justify-center">
                                                    <h6 class="mb-0 text-sm leading-normal dark:text-white">
                                                        {{ $booking->user->name ?? 'Unknown' }}
                                                    </h6>
                                                    <p
                                                        class="mb-0 text-xs leading-tight dark:text-white dark:opacity-80 text-slate-400">
                                                        {{ $booking->user->email ?? 'N/A' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td
                                            class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                            <p class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-80">
                                                {{ $booking->parkingLot->name ?? 'Unknown' }}
                                            </p>
                                            <p
                                                class="mb-0 text-xs leading-tight dark:text-white dark:opacity-80 text-slate-400">
                                                {{ $booking->parkingLot->address ?? 'N/A' }}
                                            </p>
                                        </td>
                                        <td
                                            class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                            <span
                                                class="text-xs font-semibold leading-tight dark:text-white dark:opacity-80 text-slate-400">{{ $booking->booking_date ?? 'N/A' }}</span>
                                        </td>
                                        <td
                                            class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                            <span
                                                class="text-xs font-semibold leading-tight dark:text-white dark:opacity-80">{{ number_format($booking->total_cost ?? 0) }}đ</span>
                                        </td>
                                        <td
                                            class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
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
                                                $statusClass = $statusColors[$booking->status ?? 'pending'] ?? 'bg-gray-400';
                                            @endphp
                                            <span class="rounded-full text-white px-2 py-1 text-xs {{ $statusClass }}">
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
        document.addEventListener('DOMContentLoaded', function () {
            const apiRevenueUrl = "{{ route('admin.reports.api.revenue') }}";
            const apiUsageUrl = "{{ route('admin.reports.api.usage') }}";

            function fmtDate(d) {
                const y = d.getFullYear();
                const m = String(d.getMonth() + 1).padStart(2, '0');
                const day = String(d.getDate()).padStart(2, '0');
                return `${y}-${m}-${day}`;
            }

            // Revenue Chart (last 7 days) + Trend vs previous 7 days
            const today = new Date();
            const end = new Date(today.getFullYear(), today.getMonth(), today.getDate());
            const start = new Date(end); start.setDate(end.getDate() - 6);
            const prevEnd = new Date(start); prevEnd.setDate(start.getDate() - 1);
            const prevStart = new Date(prevEnd); prevStart.setDate(prevEnd.getDate() - 6);

            const revenueCtx = document.getElementById('revenue-chart').getContext('2d');
            let revenueChart;

            fetch(`${apiRevenueUrl}?start_date=${fmtDate(start)}&end_date=${fmtDate(end)}`)
                .then(r => r.json())
                .then(async (cur) => {
                    const labels = cur?.daily?.labels || [];
                    const totals = cur?.daily?.totals || [];
                    const currentSum = Array.isArray(totals) ? totals.reduce((a, b) => a + (Number(b) || 0), 0) : 0;

                    revenueChart = new Chart(revenueCtx, {
                        type: 'line',
                        data: {
                            labels,
                            datasets: [{
                                label: 'Doanh thu (₫)',
                                data: totals,
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
                                        callback: function (value) {
                                            return new Intl.NumberFormat().format(value) + '₫';
                                        }
                                    }
                                }
                            }
                        }
                    });

                    // Fetch previous 7 days to compute trend
                    const prevResp = await fetch(`${apiRevenueUrl}?start_date=${fmtDate(prevStart)}&end_date=${fmtDate(prevEnd)}`);
                    const prev = await prevResp.json();
                    const prevTotals = prev?.daily?.totals || [];
                    const prevSum = Array.isArray(prevTotals) ? prevTotals.reduce((a, b) => a + (Number(b) || 0), 0) : 0;
                    const diff = currentSum - prevSum;
                    const pct = prevSum > 0 ? (diff * 100 / prevSum) : (currentSum > 0 ? 100 : 0);
                    const pctText = `${pct >= 0 ? 'Tăng' : 'Giảm'} ${Math.abs(pct).toFixed(1)}%`;
                    const icon = document.getElementById('revenue-trend-icon');
                    const text = document.getElementById('revenue-trend-text');
                    if (icon && text) {
                        icon.className = `fa ${pct >= 0 ? 'fa-arrow-up text-emerald-500' : 'fa-arrow-down text-red-500'}`;
                        text.textContent = pctText;
                    }
                })
                .catch(() => {
                    // leave default text if error
                });

            // Booking Status Chart (last 7 days)
            const statusCtx = document.getElementById('booking-status-chart').getContext('2d');
            fetch(`${apiUsageUrl}?start_date=${fmtDate(start)}&end_date=${fmtDate(end)}`)
                .then(r => r.json())
                .then(data => {
                    const map = data?.status || {};
                    const order = [
                        { key: 'pending', label: 'Chờ xác nhận', color: '#F59E0B' },
                        { key: 'confirmed', label: 'Đã xác nhận', color: '#10B981' },
                        { key: 'cancelled', label: 'Đã hủy', color: '#EF4444' },
                        { key: 'completed', label: 'Hoàn thành', color: '#3B82F6' }
                    ];
                    new Chart(statusCtx, {
                        type: 'doughnut',
                        data: {
                            labels: order.map(o => o.label),
                            datasets: [{
                                data: order.map(o => Number(map[o.key] || 0)),
                                backgroundColor: order.map(o => o.color)
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: { legend: { position: 'bottom' } }
                        }
                    });
                })
                .catch(() => {
                    // fallback silently
                });
        });
    </script>
@endsection
