<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - ParkingAdmin</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>ParkingAdmin</h2>
                <p>Hệ thống quản lý</p>
            </div>
            <nav>
                <ul class="sidebar-menu">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="icon fas fa-home"></i>
                            Tổng quan
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.parking') }}" class="{{ request()->routeIs('admin.parking') ? 'active' : '' }}">
                            <i class="icon fas fa-car"></i>
                            Quản lý vị trí
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.customers') }}" class="{{ request()->routeIs('admin.customers') ? 'active' : '' }}">
                            <i class="icon fas fa-users"></i>
                            Khách hàng
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.reports') }}" class="{{ request()->routeIs('admin.reports') ? 'active' : '' }}">
                            <i class="icon fas fa-chart-bar"></i>
                            Báo cáo
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.revenue') }}" class="{{ request()->routeIs('admin.revenue') ? 'active' : '' }}">
                            <i class="icon fas fa-dollar-sign"></i>
                            Doanh thu
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.settings') }}" class="{{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                            <i class="icon fas fa-cog"></i>
                            Cài đặt
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="header">
                <h1>@yield('page-title')</h1>
                <div class="breadcrumb">@yield('breadcrumb')</div>
            </div>

            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    <script>
        // Add some basic interactivity
        document.addEventListener('DOMContentLoaded', function() {
            // Add click handlers for parking spots
            const parkingSpots = document.querySelectorAll('.parking-spot');
            parkingSpots.forEach(spot => {
                spot.addEventListener('click', function() {
                    const spotNumber = this.textContent;
                    const status = this.classList.contains('spot-available') ? 'trống' :
                                 this.classList.contains('spot-occupied') ? 'đang sử dụng' : 'bảo trì';
                    alert(`Vị trí ${spotNumber} - Trạng thái: ${status}`);
                });
            });
        });
    </script>
</body>
</html>
