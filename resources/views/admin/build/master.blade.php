<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('admin/img/apple-icon.png') }}" />
    <link rel="icon" type="image/png" href="{{ asset('admin/img/logo.png') }}" />
    <title>@yield('title', 'Paspark Admin - Hệ thống quản lý bãi đỗ xe')</title>

    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Nucleo Icons -->
    <link href="{{ asset('admin/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Perfect Scrollbar CSS -->
    <link href="{{ asset('admin/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Main Styling -->
    <link href="{{ asset('admin/css/argon-dashboard-tailwind.css?v=1.0.1') }}" rel="stylesheet" />
    <!-- Charts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.tailwindcss.min.css">
    <!-- Custom Admin Styles -->
    <link href="{{ asset('admin/css/custom-admin.css?v=' . time()) }}" rel="stylesheet" />

    <!-- Custom CSS for enhanced UI -->
    <style>
        .sidebar-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .card-gradient {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        }
        .text-gradient {
            background: linear-gradient(45deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .hover-lift {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .hover-lift:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .sidebar-item {
            transition: all 0.3s ease;
        }
        .sidebar-item:hover {
            background: rgba(255,255,255,0.1);
            transform: translateX(4px);
        }
        .glass-effect {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>

    @stack('styles')
</head>

<body class="m-0 font-sans text-base antialiased font-normal dark:bg-slate-900 leading-default bg-gray-50 text-slate-500">
    <!-- Background patterns -->
    <div class="absolute w-full bg-gray-50 dark:bg-slate-900 min-h-screen"></div>

    <!-- Sidebar Navigation -->
    <aside class="fixed inset-y-0 flex-wrap items-center justify-between block w-full p-0 my-4 overflow-y-auto antialiased transition-transform duration-300 -translate-x-full sidebar-gradient border-0 shadow-2xl max-w-64 ease-nav-brand z-990 xl:ml-6 rounded-2xl xl:left-0 xl:translate-x-0" aria-expanded="false">
        <!-- Logo -->
        <div class="h-20 flex items-center justify-center">
            <i class="absolute top-0 right-0 p-4 opacity-70 cursor-pointer fas fa-times text-white xl:hidden hover:opacity-100 transition-opacity" sidenav-close></i>
            <a class="flex items-center px-8 py-6 m-0 text-sm whitespace-nowrap text-white" href="{{ route('admin.dashboard') }}">
                <div class="flex items-center justify-center w-10 h-10 bg-white rounded-lg mr-3 shadow-lg">
                    <i class="fas fa-car text-blue-600 text-xl"></i>
                </div>
                <div class="flex flex-col">
                    <span class="text-xl font-bold">Paspark</span>
                    <span class="text-xs opacity-75">Quản lý bãi đỗ xe</span>
                </div>
            </a>
        </div>

        <hr class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-white/30 to-transparent" />

        <!-- Navigation Menu -->
        <div class="items-center block w-auto max-h-screen overflow-auto h-sidenav grow basis-full px-4">
            <ul class="flex flex-col pl-0 mb-0 space-y-1">
                <!-- Main Navigation -->
                <li class="w-full mb-2">
                    <h6 class="pl-4 text-xs font-bold leading-tight uppercase text-white opacity-60 mb-3">Menu chính</h6>
                </li>

                <li class="w-full">
                    <a class="sidebar-item py-3 {{ request()->routeIs('admin.dashboard') ? 'bg-white/20 text-white shadow-lg' : 'text-white/80 hover:text-white' }} text-sm my-0 flex items-center whitespace-nowrap rounded-xl px-4 font-medium transition-all duration-300" href="{{ route('admin.dashboard') }}">
                        <div class="mr-3 flex h-10 w-10 items-center justify-center rounded-xl {{ request()->routeIs('admin.dashboard') ? 'bg-white text-blue-600' : 'bg-white/10 text-white' }} transition-all duration-300">
                            <i class="fas fa-tachometer-alt text-lg"></i>
                        </div>
                        <span>Bảng điều khiển</span>
                    </a>
                </li>

                <li class="w-full">
                    <a class="sidebar-item py-3 {{ request()->routeIs('admin.parking') ? 'bg-white/20 text-white shadow-lg' : 'text-white/80 hover:text-white' }} text-sm my-0 flex items-center whitespace-nowrap rounded-xl px-4 font-medium transition-all duration-300" href="{{ route('admin.parking') }}">
                        <div class="mr-3 flex h-10 w-10 items-center justify-center rounded-xl {{ request()->routeIs('admin.parking') ? 'bg-white text-orange-600' : 'bg-white/10 text-white' }} transition-all duration-300">
                            <i class="fas fa-parking text-lg"></i>
                        </div>
                        <span>Quản lý bãi đỗ xe</span>
                    </a>
                </li>

                <li class="w-full">
                    <a class="sidebar-item py-3 {{ request()->routeIs('admin.customers') ? 'bg-white/20 text-white shadow-lg' : 'text-white/80 hover:text-white' }} text-sm my-0 flex items-center whitespace-nowrap rounded-xl px-4 font-medium transition-all duration-300" href="{{ route('admin.customers') }}">
                        <div class="mr-3 flex h-10 w-10 items-center justify-center rounded-xl {{ request()->routeIs('admin.customers') ? 'bg-white text-emerald-600' : 'bg-white/10 text-white' }} transition-all duration-300">
                            <i class="fas fa-users text-lg"></i>
                        </div>
                        <span>Khách hàng</span>
                    </a>
                </li>

                <li class="w-full">
                    <a class="sidebar-item py-3 {{ request()->routeIs('admin.reports') ? 'bg-white/20 text-white shadow-lg' : 'text-white/80 hover:text-white' }} text-sm my-0 flex items-center whitespace-nowrap rounded-xl px-4 font-medium transition-all duration-300" href="{{ route('admin.reports') }}">
                        <div class="mr-3 flex h-10 w-10 items-center justify-center rounded-xl {{ request()->routeIs('admin.reports') ? 'bg-white text-red-600' : 'bg-white/10 text-white' }} transition-all duration-300">
                            <i class="fas fa-chart-line text-lg"></i>
                        </div>
                        <span>Báo cáo</span>
                    </a>
                </li>

                <li class="w-full">
                    <a class="sidebar-item py-3 {{ request()->routeIs('admin.revenue') ? 'bg-white/20 text-white shadow-lg' : 'text-white/80 hover:text-white' }} text-sm my-0 flex items-center whitespace-nowrap rounded-xl px-4 font-medium transition-all duration-300" href="{{ route('admin.revenue') }}">
                        <div class="mr-3 flex h-10 w-10 items-center justify-center rounded-xl {{ request()->routeIs('admin.revenue') ? 'bg-white text-green-600' : 'bg-white/10 text-white' }} transition-all duration-300">
                            <i class="fas fa-money-bill-wave text-lg"></i>
                        </div>
                        <span>Doanh thu</span>
                    </a>
                </li>

                <!-- Account Management -->
                <li class="w-full mt-6 mb-2">
                    <h6 class="pl-4 text-xs font-bold leading-tight uppercase text-white opacity-60 mb-3">Quản lý tài khoản</h6>
                </li>

                <li class="w-full">
                    <a class="sidebar-item py-3 {{ request()->routeIs('admin.users') ? 'bg-white/20 text-white shadow-lg' : 'text-white/80 hover:text-white' }} text-sm my-0 flex items-center whitespace-nowrap rounded-xl px-4 font-medium transition-all duration-300" href="{{ route('admin.users') }}">
                        <div class="mr-3 flex h-10 w-10 items-center justify-center rounded-xl {{ request()->routeIs('admin.users') ? 'bg-white text-blue-600' : 'bg-white/10 text-white' }} transition-all duration-300">
                            <i class="fas fa-user-tie text-lg"></i>
                        </div>
                        <span>Người dùng</span>
                    </a>
                </li>

                <li class="w-full">
                    <a class="sidebar-item py-3 {{ request()->routeIs('admin.settings') ? 'bg-white/20 text-white shadow-lg' : 'text-white/80 hover:text-white' }} text-sm my-0 flex items-center whitespace-nowrap rounded-xl px-4 font-medium transition-all duration-300" href="{{ route('admin.settings') }}">
                        <div class="mr-3 flex h-10 w-10 items-center justify-center rounded-xl {{ request()->routeIs('admin.settings') ? 'bg-white text-purple-600' : 'bg-white/10 text-white' }} transition-all duration-300">
                            <i class="fas fa-cogs text-lg"></i>
                        </div>
                        <span>Cài đặt</span>
                    </a>
                </li>

                <!-- System -->
                <li class="w-full mt-6 mb-2">
                    <h6 class="pl-4 text-xs font-bold leading-tight uppercase text-white opacity-60 mb-3">Hệ thống</h6>
                </li>

                <li class="w-full">
                    <a class="sidebar-item py-3 text-white/80 hover:text-white text-sm my-0 flex items-center whitespace-nowrap rounded-xl px-4 font-medium transition-all duration-300" href="{{ route('admin.documentation') }}">
                        <div class="mr-3 flex h-10 w-10 items-center justify-center rounded-xl bg-white/10 text-white transition-all duration-300">
                            <i class="fas fa-book text-lg"></i>
                        </div>
                        <span>Tài liệu</span>
                    </a>
                </li>

                <li class="w-full">
                    <a class="sidebar-item py-3 text-white/80 hover:text-white text-sm my-0 flex items-center whitespace-nowrap rounded-xl px-4 font-medium transition-all duration-300" href="{{ route('admin.about') }}">
                        <div class="mr-3 flex h-10 w-10 items-center justify-center rounded-xl bg-white/10 text-white transition-all duration-300">
                            <i class="fas fa-info-circle text-lg"></i>
                        </div>
                        <span>Về chúng tôi</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl">
        <!-- Top Navigation Bar -->
        <nav class="relative flex flex-wrap items-center justify-between px-0 py-4 mx-6 transition-all ease-in shadow-none duration-250 rounded-2xl lg:flex-nowrap lg:justify-start glass-effect" navbar-main navbar-scroll="false">
            <div class="flex items-center justify-between w-full px-6 py-2 mx-auto flex-wrap-inherit">
                <nav>
                    <!-- Breadcrumb -->
                    <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
                        <li class="text-sm leading-normal">
                            <a class="text-white opacity-70 hover:opacity-100 transition-opacity" href="javascript:;">@yield('breadcrumb-parent', 'Trang chủ')</a>
                        </li>
                        <li class="text-sm pl-2 capitalize leading-normal text-white before:float-left before:pr-2 before:text-white/70 before:content-['/']" aria-current="page">@yield('breadcrumb-current', '')</li>
                    </ol>
                    <h1 class="mb-0 text-2xl font-bold text-white capitalize">@yield('page-title', '')</h1>
                </nav>

                <div class="flex items-center mt-2 grow sm:mt-0 sm:mr-6 md:mr-0 lg:flex lg:basis-auto">
                    <!-- Search -->
                    <div class="flex items-center md:ml-auto md:pr-4">
                        <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-xl ease">
                            <span class="text-sm ease leading-5.6 absolute z-50 -ml-px flex h-full items-center whitespace-nowrap rounded-xl rounded-tr-none rounded-br-none border border-r-0 border-transparent bg-transparent py-3 px-4 text-center font-normal text-white/70 transition-all">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" class="pl-12 text-sm focus:shadow-lg ease w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-xl border border-solid border-white/20 bg-white/10 backdrop-blur-sm text-white bg-clip-padding py-3 pr-4 transition-all placeholder:text-white/50 focus:border-white/40 focus:outline-none focus:bg-white/20" placeholder="Tìm kiếm trong hệ thống..." />
                        </div>
                    </div>

                    <!-- Top Right Navigation -->
                    <ul class="flex flex-row justify-end pl-0 mb-0 list-none md-max:w-full space-x-2">
                        <!-- Quick Actions -->
                        <li class="flex items-center">
                            <a href="#" class="flex items-center justify-center w-10 h-10 text-white bg-white/10 rounded-xl hover:bg-white/20 transition-all duration-300 backdrop-blur-sm">
                                <i class="fas fa-plus text-sm"></i>
                            </a>
                        </li>

                        <!-- Notifications -->
                        <li class="relative flex items-center">
                            <a href="javascript:;" class="flex items-center justify-center w-10 h-10 text-white bg-white/10 rounded-xl hover:bg-white/20 transition-all duration-300 backdrop-blur-sm relative" dropdown-trigger aria-expanded="false">
                                <i class="fas fa-bell text-sm"></i>
                                <span class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center">3</span>
                            </a>

                            <!-- Notifications Dropdown -->
                            <ul dropdown-menu class="text-sm transform-dropdown before:font-awesome before:leading-default before:duration-350 before:ease lg:shadow-3xl duration-250 min-w-80 before:sm:right-8 before:text-5.5 pointer-events-none absolute right-0 top-0 z-50 origin-top list-none rounded-xl border-0 border-solid border-transparent bg-white shadow-2xl bg-clip-padding px-0 py-4 text-left text-slate-500 opacity-0 transition-all before:absolute before:right-2 before:left-auto before:top-0 before:z-50 before:inline-block before:font-normal before:text-white before:antialiased before:transition-all before:content-['\f0d8'] sm:-mr-6 lg:absolute lg:right-0 lg:left-auto lg:mt-4 lg:block lg:cursor-pointer">
                                <li class="relative px-4 pb-2 border-b border-gray-100">
                                    <h6 class="text-sm font-semibold text-gray-800">Thông báo</h6>
                                </li>
                                <li class="relative">
                                    <a class="hover:bg-gray-50 ease py-3 clear-both block w-full whitespace-nowrap bg-transparent px-4 duration-300 lg:transition-colors" href="javascript:;">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0">
                                                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                                    <i class="fas fa-car text-blue-600"></i>
                                                </div>
                                            </div>
                                            <div class="ml-3 flex-1">
                                                <h6 class="text-sm font-medium text-gray-800">Có xe mới vào bãi</h6>
                                                <p class="text-xs text-gray-500 mt-1">
                                                    <i class="mr-1 fa fa-clock"></i>
                                                    2 phút trước
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="relative">
                                    <a class="hover:bg-gray-50 ease py-3 clear-both block w-full whitespace-nowrap bg-transparent px-4 duration-300 lg:transition-colors" href="javascript:;">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0">
                                                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                                    <i class="fas fa-money-bill-wave text-green-600"></i>
                                                </div>
                                            </div>
                                            <div class="ml-3 flex-1">
                                                <h6 class="text-sm font-medium text-gray-800">Thanh toán thành công</h6>
                                                <p class="text-xs text-gray-500 mt-1">
                                                    <i class="mr-1 fa fa-clock"></i>
                                                    15 phút trước
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="relative">
                                    <a class="hover:bg-gray-50 ease py-3 clear-both block w-full whitespace-nowrap bg-transparent px-4 duration-300 lg:transition-colors" href="javascript:;">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0">
                                                <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center">
                                                    <i class="fas fa-exclamation-triangle text-orange-600"></i>
                                                </div>
                                            </div>
                                            <div class="ml-3 flex-1">
                                                <h6 class="text-sm font-medium text-gray-800">Bãi đỗ xe gần đầy</h6>
                                                <p class="text-xs text-gray-500 mt-1">
                                                    <i class="mr-1 fa fa-clock"></i>
                                                    30 phút trước
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="relative px-4 pt-2 border-t border-gray-100">
                                    <a href="#" class="text-xs text-blue-600 hover:text-blue-800 font-medium">Xem tất cả thông báo</a>
                                </li>
                            </ul>
                        </li>

                        <!-- User Profile -->
                        <li class="flex items-center">
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open" class="flex items-center space-x-2 text-white bg-white/10 rounded-xl px-3 py-2 hover:bg-white/20 transition-all duration-300 backdrop-blur-sm">
                                    <img src="{{ asset('admin/img/team-2.jpg') }}" class="w-8 h-8 rounded-lg object-cover" alt="User">
                                    <span class="hidden sm:block text-sm font-medium">Admin</span>
                                    <i class="fas fa-chevron-down text-xs"></i>
                                </button>

                                <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg py-2 z-50">
                                    <a href="{{ route('admin.profile') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        <i class="fas fa-user mr-3"></i>
                                        Hồ sơ
                                    </a>
                                    <a href="{{ route('admin.settings') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        <i class="fas fa-cog mr-3"></i>
                                        Cài đặt
                                    </a>
                                    <div class="border-t border-gray-100 mt-2 pt-2">
                                        <a href="{{ route('admin.logout') }}" class="flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="fas fa-sign-out-alt mr-3"></i>
                                            Đăng xuất
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <!-- Mobile Menu Toggle -->
                        <li class="flex items-center xl:hidden">
                            <button class="flex items-center justify-center w-10 h-10 text-white bg-white/10 rounded-xl hover:bg-white/20 transition-all duration-300 backdrop-blur-sm" sidenav-trigger>
                                <div class="w-4 overflow-hidden">
                                    <i class="ease mb-1 relative block h-0.5 rounded-sm bg-white transition-all"></i>
                                    <i class="ease mb-1 relative block h-0.5 rounded-sm bg-white transition-all"></i>
                                    <i class="ease relative block h-0.5 rounded-sm bg-white transition-all"></i>
                                </div>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <div class="w-full px-6 py-6 mx-auto">
            @yield('content')
        </div>

        <!-- Footer -->
        <footer class="pt-8 pb-4">
            <div class="w-full px-6 mx-auto">
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <div class="flex flex-wrap items-center justify-between">
                        <div class="w-full max-w-full mb-4 lg:mb-0 lg:w-1/2">
                            <div class="text-sm leading-normal text-gray-600">
                                © {{ date('Y') }} <span class="font-semibold text-blue-600">Paspark</span> - Hệ thống quản lý bãi đỗ xe thông minh
                            </div>
                            <div class="text-xs text-gray-500 mt-1">
                                Phiên bản 1.0.0 | Được phát triển với ❤️ bởi Paspark Team
                            </div>
                        </div>
                        <div class="w-full max-w-full lg:w-1/2">
                            <ul class="flex flex-wrap justify-center lg:justify-end space-x-6">
                                <li>
                                    <a href="{{ route('admin.dashboard') }}" class="text-sm font-medium text-gray-600 hover:text-blue-600 transition-colors">Trang chủ</a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.documentation') }}" class="text-sm font-medium text-gray-600 hover:text-blue-600 transition-colors">Tài liệu</a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.about') }}" class="text-sm font-medium text-gray-600 hover:text-blue-600 transition-colors">Về chúng tôi</a>
                                </li>
                                <li>
                                    <a href="#" class="text-sm font-medium text-gray-600 hover:text-blue-600 transition-colors">Hỗ trợ</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </main>

    <!-- Core Scripts -->
    <!-- Alpine.js -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <!-- Popper -->
    <script src="https://unpkg.com/@popperjs/core@2" defer></script>
    <!-- Perfect Scrollbar -->
    <script src="{{ asset('admin/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <!-- Chart.js -->
    <script src="{{ asset('admin/js/plugins/chartjs.min.js') }}"></script>
    <!-- DataTables -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.tailwindcss.min.js"></script>
    <!-- Main Scripts -->
    <script src="{{ asset('admin/js/argon-dashboard-tailwind.js?v=1.0.1') }}"></script>
    <!-- Additional Admin Scripts -->
    <script src="{{ asset('admin/js/admin.js') }}"></script>
    <!-- Custom Admin Scripts -->
    <script src="{{ asset('admin/js/custom-admin.js?v=' . time()) }}"></script>

    <!-- Logout Form -->
    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="hidden">
        @csrf
    </form>

    <!-- Custom JavaScript for enhanced interactions -->
    <script>
        // Enhanced sidebar interactions
        document.addEventListener('DOMContentLoaded', function() {
            // Smooth scroll for sidebar
            const sidebar = document.querySelector('aside');
            if (sidebar) {
                new PerfectScrollbar(sidebar.querySelector('.h-sidenav'));
            }

            // Auto-hide notifications after some time
            setTimeout(() => {
                const notifications = document.querySelectorAll('.alert');
                notifications.forEach(notification => {
                    notification.style.transition = 'opacity 0.5s ease';
                    notification.style.opacity = '0';
                    setTimeout(() => notification.remove(), 500);
                });
            }, 5000);

            // Enhanced search functionality
            const searchInput = document.querySelector('input[placeholder*="Tìm kiếm"]');
            if (searchInput) {
                searchInput.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter') {
                        // Implement search functionality here
                        console.log('Searching for:', this.value);
                    }
                });
            }
        });

        // Chart color schemes
        const chartColors = {
            primary: '#667eea',
            secondary: '#764ba2',
            success: '#10b981',
            warning: '#f59e0b',
            danger: '#ef4444',
            info: '#3b82f6'
        };

        // Common chart options
        const defaultChartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0,0,0,0.1)'
                    }
                },
                x: {
                    grid: {
                        color: 'rgba(0,0,0,0.1)'
                    }
                }
            }
        };
    </script>

    @stack('scripts')
</body>
</html>
