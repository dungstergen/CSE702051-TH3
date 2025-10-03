<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('admin/img/apple-icon.png') }}" />
    <link rel="icon" type="image/png" href="{{ asset('admin/img/logo.png') }}" />
    <title>@yield('page-title', 'Paspark Admin')</title>

    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- FontAwesome 6 Backup CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Nucleo Icons -->
    <link href="{{ asset('admin/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Main Styling -->
    <link href="{{ asset('admin/css/argon-dashboard-tailwind.css?v=1.0.1') }}" rel="stylesheet" />

    <style>
        /* Profile Dropdown Styles */
        .profile-dropdown {
            position: relative;
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .profile-icon {
            color: white !important;
            font-size: 20px !important;
            font-family: "Font Awesome 5 Free", "Font Awesome 6 Free", -apple-system, BlinkMacSystemFont !important;
            font-weight: 900 !important;
            display: inline-block !important;
            visibility: visible !important;
            margin-right: 5px;
        }

        .profile-dropdown:hover .profile-icon {
            color: #e2e8f0 !important;
            transform: scale(1.15);
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.8);
        }

        .dropdown-arrow {
            color: white !important;
            font-size: 12px !important;
            margin-left: 5px;
            transition: transform 0.3s ease;
        }

        .profile-dropdown:hover .dropdown-arrow {
            transform: rotate(180deg);
        }

        /* Fallback for FontAwesome icons */
        .fa-user:before {
            content: "\f007" !important;
        }

        .fa-chevron-down:before {
            content: "\f078" !important;
        }
    </style>
    @yield('additional_css')
</head>

<body class="m-0 font-sans text-base antialiased font-normal dark:bg-slate-900 leading-default bg-gray-50 text-slate-500">
    <div class="absolute w-full bg-blue-500 dark:hidden min-h-75"></div>

    <!-- Sidebar -->
    <aside class="fixed inset-y-0 flex-wrap items-center justify-between block w-full p-0 my-4 antialiased transition-transform duration-200 -translate-x-full bg-white border-0 shadow-xl dark:shadow-none dark:bg-slate-850 max-w-64 ease-nav-brand z-990 xl:ml-6 rounded-2xl xl:left-0 xl:translate-x-0" aria-expanded="false">
        <div class="h-19">
            <i class="absolute top-0 right-0 p-4 opacity-50 cursor-pointer fas fa-times dark:text-white text-slate-400 xl:hidden" sidenav-close></i>
            <a class="block px-8 py-6 m-0 text-sm whitespace-nowrap dark:text-white text-slate-700" href="{{ route('admin.dashboard') }}">
                <img src="{{ asset('admin/img/logo.png') }}" class="inline h-full max-w-full transition-all duration-200 dark:hidden ease-nav-brand max-h-8" alt="main_logo" />
                <img src="{{ asset('admin/img/logo.png') }}" class="hidden h-full max-w-full transition-all duration-200 dark:inline ease-nav-brand max-h-8" alt="main_logo" />
                <span class="ml-1 font-semibold transition-all duration-200 ease-nav-brand">Paspark</span>
            </a>
        </div>

        <hr class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent" />

        <div class="items-center block w-auto h-sidenav grow basis-full">
            <ul class="flex flex-col pl-0 mb-0">
                <li class="mt-0.5 w-full">
                    <a class="py-2.7 {{ request()->is('admin/dashboard') ? 'bg-blue-500/13' : '' }} dark:text-white dark:opacity-80 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors" href="{{ route('admin.dashboard') }}">
                        <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class="relative top-0 text-sm leading-normal text-blue-500 ni ni-tv-2"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Bảng điều khiển</span>
                    </a>
                </li>

                <li class="mt-0.5 w-full">
                    <a class="{{ request()->is('admin/users*') ? 'bg-blue-500/13' : '' }} dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors" href="{{ route('admin.users.index') }}">
                        <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class="relative top-0 text-sm leading-normal text-emerald-500 fas fa-users"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Quản lý User</span>
                    </a>
                </li>

                <li class="mt-0.5 w-full">
                    <a class="{{ request()->is('admin/parking-lots*') ? 'bg-blue-500/13' : '' }} dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors" href="{{ route('admin.parking-lots.index') }}">
                        <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class="relative top-0 text-sm leading-normal text-orange-500 fas fa-parking"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Quản lý Bãi đỗ xe</span>
                    </a>
                </li>

                <li class="mt-0.5 w-full">
                    <a class="{{ request()->is('admin/bookings*') ? 'bg-blue-500/13' : '' }} dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors" href="{{ route('admin.bookings.index') }}">
                        <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class="relative top-0 text-sm leading-normal text-blue-500 fas fa-calendar-check"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Quản lý Đặt chỗ</span>
                    </a>
                </li>

                <li class="mt-0.5 w-full">
                    <a class="{{ request()->is('admin/payments*') ? 'bg-blue-500/13' : '' }} dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors" href="{{ route('admin.payments.index') }}">
                        <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class="relative top-0 text-sm leading-normal text-green-500 fas fa-credit-card"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Quản lý Thanh toán</span>
                    </a>
                </li>

                <li class="mt-0.5 w-full">
                    <a class="{{ request()->is('admin/reviews*') ? 'bg-blue-500/13' : '' }} dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors" href="{{ route('admin.reviews.index') }}">
                        <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class="relative top-0 text-sm leading-normal text-yellow-500 fas fa-star"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Quản lý Đánh giá</span>
                    </a>
                </li>

                <li class="mt-0.5 w-full">
                    <a class="{{ request()->is('admin/service-packages*') ? 'bg-blue-500/13' : '' }} dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors" href="{{ route('admin.service-packages.index') }}">
                        <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class="relative top-0 text-sm leading-normal text-indigo-500 fas fa-layer-group"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Quản lý Gói dịch vụ</span>
                    </a>
                </li>

                <li class="mt-0.5 w-full">
                    <a class="{{ request()->is('admin/testimonials*') ? 'bg-blue-500/13' : '' }} dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors" href="{{ route('admin.testimonials.index') }}">
                        <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class="relative top-0 text-sm leading-normal text-pink-500 fas fa-comments"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Quản lý Testimonial</span>
                    </a>
                </li>

                <li class="mt-0.5 w-full">
                    <a class="{{ request()->is('admin/reports*') ? 'bg-blue-500/13' : '' }} dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors" href="{{ route('admin.reports.index') }}">
                        <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class="relative top-0 text-sm leading-normal text-purple-500 fas fa-chart-pie"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Báo cáo & Thống kê</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl">
        <!-- Navbar -->
        <nav class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all ease-in shadow-none duration-250 rounded-2xl lg:flex-nowrap lg:justify-start" navbar-main navbar-scroll="false">
            <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">
                <nav>
                    <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
                        <li class="text-sm leading-normal">
                            <a class="text-white opacity-50" href="javascript:;">Trang</a>
                        </li>
                        <li class="text-sm pl-2 capitalize leading-normal text-white before:float-left before:pr-2 before:text-white before:content-['/']" aria-current="page">@yield('page-heading', 'Admin')</li>
                    </ol>
                    <h6 class="mb-0 font-bold text-white capitalize">@yield('page-heading', 'Quản lý Admin')</h6>
                </nav>

                <div class="flex items-center mt-2 grow sm:mt-0 sm:mr-6 md:mr-0 lg:flex lg:basis-auto">
                    <div class="flex items-center md:ml-auto md:pr-4">
                        <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease">
                            <span class="text-sm ease leading-5.6 absolute z-50 -ml-px flex h-full items-center whitespace-nowrap rounded-lg rounded-tr-none rounded-br-none border border-r-0 border-transparent bg-transparent py-2 px-2.5 text-center font-normal text-slate-500 transition-all">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" class="pl-9 text-sm focus:shadow-primary-outline ease w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 dark:bg-slate-850 dark:text-white bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow" placeholder="Tìm kiếm..." />
                        </div>
                    </div>

                    <ul class="flex flex-row justify-end pl-0 mb-0 list-none md-max:w-full">
                        <!-- Profile Dropdown -->
                        <li class="flex items-center relative">
                            <div class="dropdown">
                                <div class="profile-dropdown dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-user profile-icon">👤</i>
                                    <i class="fas fa-chevron-down dropdown-arrow">▼</i>
                                </div>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="{{ route('admin.profile') }}"><i class="fas fa-user-circle me-2"></i>Thông tin tài khoản</a></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                            @csrf
                                            <button type="submit" class="dropdown-item border-0 bg-transparent">
                                                <i class="fas fa-sign-out-alt me-2"></i>Đăng xuất
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <div class="w-full px-6 py-6 mx-auto">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('admin/js/plugins/chartjs.min.js') }}" async></script>
    <script src="{{ asset('admin/js/plugins/perfect-scrollbar.min.js') }}" async></script>
    <script src="{{ asset('admin/js/argon-dashboard-tailwind.js?v=1.0.1') }}" async></script>

    <script>
        // FontAwesome Icon Fallback
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                const profileIcon = document.querySelector('.profile-icon');
                if (profileIcon && profileIcon.offsetWidth === 0) {
                    // FontAwesome không load, sử dụng emoji
                    profileIcon.innerHTML = '👤';
                    profileIcon.style.fontSize = '16px';
                }

                const dropdownArrow = document.querySelector('.dropdown-arrow');
                if (dropdownArrow && dropdownArrow.offsetWidth === 0) {
                    dropdownArrow.innerHTML = '▼';
                    dropdownArrow.style.fontSize = '10px';
                }
            }, 1000);
        });
    </script>

    @yield('additional_js')
</body>
</html>
