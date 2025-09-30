@extends('admin.build.master')

@section('title', 'Bảng điều khiển - Paspark Admin')
@section('page-title', 'Bảng điều khiển')
@section('breadcrumb-parent', 'Trang chủ')
@section('breadcrumb-current', 'Dashboard')

@push('styles')
<style>
    .stats-card {
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
        transition: all 0.3s ease;
    }
    .stats-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    }
    .chart-container {
        position: relative;
        height: 400px;
    }
    .metric-badge {
        background: linear-gradient(45deg, #667eea, #764ba2);
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
    }
</style>
@endpush

@section('content')
<div class="space-y-6">
    <!-- Welcome Banner -->
    <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl p-8 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold mb-2">Chào mừng trở lại, Admin!</h1>
                <p class="text-blue-100 text-lg">Hôm nay {{ date('d/m/Y') }} - Hệ thống đang hoạt động tốt</p>
            </div>
            <div class="hidden md:block">
                <div class="w-24 h-24 bg-white/20 rounded-full flex items-center justify-center">
                    <i class="fas fa-chart-line text-4xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Key Metrics -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Vehicles -->
        <div class="stats-card bg-white rounded-2xl p-6 shadow-lg hover-lift">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Tổng xe trong bãi</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">245</p>
                    <div class="flex items-center mt-2">
                        <span class="text-green-500 text-sm font-medium">+12%</span>
                        <span class="text-gray-500 text-sm ml-2">so với hôm qua</span>
                    </div>
                </div>
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-car text-2xl text-blue-600"></i>
                </div>
            </div>
        </div>

        <!-- Available Spaces -->
        <div class="stats-card bg-white rounded-2xl p-6 shadow-lg hover-lift">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Chỗ trống</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">55</p>
                    <div class="flex items-center mt-2">
                        <span class="text-red-500 text-sm font-medium">-8%</span>
                        <span class="text-gray-500 text-sm ml-2">so với hôm qua</span>
                    </div>
                </div>
                <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-parking text-2xl text-orange-600"></i>
                </div>
            </div>
        </div>

        <!-- Today Revenue -->
        <div class="stats-card bg-white rounded-2xl p-6 shadow-lg hover-lift">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Doanh thu hôm nay</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">2.450.000₫</p>
                    <div class="flex items-center mt-2">
                        <span class="text-green-500 text-sm font-medium">+15%</span>
                        <span class="text-gray-500 text-sm ml-2">so với hôm qua</span>
                    </div>
                </div>
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-money-bill-wave text-2xl text-green-600"></i>
                </div>
            </div>
        </div>

        <!-- Active Users -->
        <div class="stats-card bg-white rounded-2xl p-6 shadow-lg hover-lift">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Người dùng hoạt động</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">1.234</p>
                    <div class="flex items-center mt-2">
                        <span class="text-green-500 text-sm font-medium">+5%</span>
                        <span class="text-gray-500 text-sm ml-2">so với tuần trước</span>
                    </div>
                </div>
                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-users text-2xl text-purple-600"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Revenue Chart -->
        <div class="bg-white rounded-2xl p-6 shadow-lg">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-semibold text-gray-800">Doanh thu 7 ngày qua</h3>
                <span class="metric-badge">+18.2%</span>
            </div>
            <div class="chart-container">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>

        <!-- Parking Usage Chart -->
        <div class="bg-white rounded-2xl p-6 shadow-lg">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-semibold text-gray-800">Tỷ lệ sử dụng bãi đỗ</h3>
                <span class="metric-badge">82%</span>
            </div>
            <div class="chart-container">
                <canvas id="parkingChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Recent Activities & Quick Stats -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Recent Activities -->
        <div class="lg:col-span-2 bg-white rounded-2xl p-6 shadow-lg">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-semibold text-gray-800">Hoạt động gần đây</h3>
                <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Xem tất cả</a>
            </div>
            <div class="space-y-4">
                <!-- Activity Item -->
                <div class="flex items-center p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-car text-blue-600"></i>
                    </div>
                    <div class="ml-4 flex-1">
                        <p class="text-sm font-medium text-gray-800">Xe 29A-12345 vào bãi</p>
                        <p class="text-xs text-gray-500">Khu vực A - Vị trí A12</p>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-gray-500">2 phút trước</p>
                        <span class="inline-block w-2 h-2 bg-green-500 rounded-full"></span>
                    </div>
                </div>

                <div class="flex items-center p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-money-bill text-green-600"></i>
                    </div>
                    <div class="ml-4 flex-1">
                        <p class="text-sm font-medium text-gray-800">Thanh toán 50.000₫</p>
                        <p class="text-xs text-gray-500">Xe 30B-67890 - 2 giờ đỗ</p>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-gray-500">5 phút trước</p>
                        <span class="inline-block w-2 h-2 bg-blue-500 rounded-full"></span>
                    </div>
                </div>

                <div class="flex items-center p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                    <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-exclamation-triangle text-orange-600"></i>
                    </div>
                    <div class="ml-4 flex-1">
                        <p class="text-sm font-medium text-gray-800">Cảnh báo: Bãi gần đầy</p>
                        <p class="text-xs text-gray-500">Chỉ còn 12 chỗ trống</p>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-gray-500">10 phút trước</p>
                        <span class="inline-block w-2 h-2 bg-orange-500 rounded-full"></span>
                    </div>
                </div>

                <div class="flex items-center p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                    <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-user-plus text-purple-600"></i>
                    </div>
                    <div class="ml-4 flex-1">
                        <p class="text-sm font-medium text-gray-800">Khách hàng mới đăng ký</p>
                        <p class="text-xs text-gray-500">Nguyễn Văn A - VIP Package</p>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-gray-500">15 phút trước</p>
                        <span class="inline-block w-2 h-2 bg-purple-500 rounded-full"></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="space-y-6">
            <!-- System Status -->
            <div class="bg-white rounded-2xl p-6 shadow-lg">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Tình trạng hệ thống</h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Máy chủ</span>
                        <div class="flex items-center">
                            <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                            <span class="text-sm font-medium text-green-600">Hoạt động</span>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Camera</span>
                        <div class="flex items-center">
                            <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                            <span class="text-sm font-medium text-green-600">Hoạt động</span>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Thanh toán</span>
                        <div class="flex items-center">
                            <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                            <span class="text-sm font-medium text-green-600">Hoạt động</span>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Rào chắn</span>
                        <div class="flex items-center">
                            <span class="w-2 h-2 bg-yellow-500 rounded-full mr-2"></span>
                            <span class="text-sm font-medium text-yellow-600">Bảo trì</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-2xl p-6 shadow-lg">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Thao tác nhanh</h3>
                <div class="space-y-3">
                    <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 px-4 rounded-xl transition-colors font-medium">
                        <i class="fas fa-plus mr-2"></i>
                        Thêm xe mới
                    </button>
                    <button class="w-full bg-green-600 hover:bg-green-700 text-white py-3 px-4 rounded-xl transition-colors font-medium">
                        <i class="fas fa-file-export mr-2"></i>
                        Xuất báo cáo
                    </button>
                    <button class="w-full bg-purple-600 hover:bg-purple-700 text-white py-3 px-4 rounded-xl transition-colors font-medium">
                        <i class="fas fa-cog mr-2"></i>
                        Cài đặt hệ thống
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Revenue Chart
    const revenueCtx = document.getElementById('revenueChart').getContext('2d');
    new Chart(revenueCtx, {
        type: 'line',
        data: {
            labels: ['T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'CN'],
            datasets: [{
                label: 'Doanh thu (VNĐ)',
                data: [1200000, 1500000, 1800000, 2100000, 2400000, 2200000, 2450000],
                borderColor: chartColors.primary,
                backgroundColor: chartColors.primary + '20',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: chartColors.primary,
                pointBorderColor: '#ffffff',
                pointBorderWidth: 2,
                pointRadius: 6
            }]
        },
        options: {
            ...defaultChartOptions,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return new Intl.NumberFormat('vi-VN', {
                                style: 'currency',
                                currency: 'VND'
                            }).format(value);
                        }
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    // Parking Usage Chart
    const parkingCtx = document.getElementById('parkingChart').getContext('2d');
    new Chart(parkingCtx, {
        type: 'doughnut',
        data: {
            labels: ['Đã sử dụng', 'Còn trống'],
            datasets: [{
                data: [245, 55],
                backgroundColor: [chartColors.primary, '#e5e7eb'],
                borderWidth: 0,
                cutout: '70%'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                        padding: 20
                    }
                }
            }
        }
    });

    // Real-time updates simulation
    setInterval(() => {
        // Simulate real-time data updates
        const activities = document.querySelectorAll('.flex.items-center.p-4');
        if (activities.length > 0) {
            activities[0].style.backgroundColor = '#dbeafe';
            setTimeout(() => {
                activities[0].style.backgroundColor = '#f9fafb';
            }, 2000);
        }
    }, 30000);
});
</script>
@endpush
