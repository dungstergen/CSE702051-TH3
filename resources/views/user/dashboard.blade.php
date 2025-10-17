<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="{{ asset('user/images/favicon.png') }}" type="image/x-icon">

    <title>Paspark</title>


    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('user/css/bootstrap.css') }}" />

    <!-- fonts style -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

    <!-- nice select -->
    <link rel="stylesheet" href="{{ asset('user/css/nice-select.min.css') }}">

    <!--owl slider stylesheet -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

    <!-- font awesome style -->
    <link href="{{ asset('user/css/font-awesome.min.css') }}" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="{{ asset('user/css/style.css') }}" rel="stylesheet" />
    <!-- responsive style -->
    <link href="{{ asset('user/css/responsive.css') }}" rel="stylesheet" />
    <!-- loading screen style -->
    <link href="{{ asset('user/css/loading.css') }}" rel="stylesheet" />
    <!-- dashboard style -->
    <link href="{{ asset('user/css/dashboard.css') }}" rel="stylesheet" />

</head>

<body class="sub_page">

    <div class="hero_area">
        <div class="bg-box">
            <img src="{{ asset('user/images/slider-bg.jpg') }}" alt="">
        </div>
        <!-- header section strats -->
        <header class="header_section">
            <div class="container">
                <nav class="navbar navbar-expand-lg custom_nav-container ">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <span>
                            Paspark
                        </span>
                    </a>

                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class=""> </span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/') }}">Trang chủ</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="{{ url('/dashboard') }}">Bảng điều khiển <span
                                        class="sr-only">(current)</span> </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/booking') }}">Đặt chỗ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.history') }}">Lịch sử</a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.pricing') }}">Gói dịch vụ</a>
                            </li> --}}
                        </ul>
                        <div class="navbar-nav ml-auto">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-user"></i> {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('user.profile') }}">
                                        <i class="fa fa-user-circle mr-2"></i>Thông tin cá nhân
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="fa fa-sign-out mr-2"></i>Đăng xuất
                                        </button>
                                    </form>
                                </div>
                            </li>
                        </div>
                    </div>
                </nav>
            </div>
        </header>
        <!-- end header section -->
    </div>

    <!-- Dashboard section -->
    <section class="dashboard_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>
                    Bảng điều khiển của bạn
                </h2>
                <p>
                    Quản lý thông tin đỗ xe và tài khoản của bạn
                </p>
            </div>

            <!-- User Welcome Card -->
            <div class="row">
                <div class="col-12">
                    <div class="welcome_card">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h3>Xin chào, <span class="user_name">{{ $user->name }}</span>!</h3>
                                <p>Chúc mừng bạn đã quay trở lại với Paspark. Hãy quản lý các hoạt động đỗ xe của bạn tại đây.</p>
                            </div>
                            <div class="col-md-4 text-center">
                                <div class="user_avatar">
                                    <i class="fa fa-user-circle"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dashboard Stats -->
            <div class="row stats_row">
                <div class="col-lg-3 col-md-6">
                    <div class="stats_card">
                        <div class="stats_icon">
                            <i class="fa fa-car"></i>
                        </div>
                        <div class="stats_content">
                            <h4>{{ $userStats['total_bookings'] }}</h4>
                            <p>Lần đỗ xe</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stats_card">
                        <div class="stats_icon">
                            <i class="fa fa-clock-o"></i>
                        </div>
                        <div class="stats_content">
                            <h4>{{ number_format($userStats['total_hours'], 1) }}</h4>
                            <p>Giờ đỗ xe</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stats_card">
                        <div class="stats_icon">
                            <i class="fa fa-money"></i>
                        </div>
                        <div class="stats_content">
                            <h4>{{ number_format($userStats['total_spent']) }}</h4>
                            <p>Tổng chi phí (VNĐ)</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stats_card">
                        <div class="stats_icon">
                            <i class="fa fa-calendar-check-o"></i>
                        </div>
                        <div class="stats_content">
                            <h4>{{ $userStats['active_bookings'] }}</h4>
                            <p>Đang hoạt động</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="row">
                <div class="col-12">
                    <div class="quick_actions_section">
                        <h3>Thao tác nhanh</h3>
                        <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <a href="{{ url('/booking') }}" class="action_card">
                                    <div class="action_icon">
                                        <i class="fa fa-plus-circle"></i>
                                    </div>
                                    <div class="action_content">
                                        <h5>Đặt chỗ đỗ xe mới</h5>
                                        <p>Tìm và đặt chỗ đỗ xe gần bạn</p>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <a href="{{ url('/history') }}" class="action_card">
                                    <div class="action_icon">
                                        <i class="fa fa-history"></i>
                                    </div>
                                    <div class="action_content">
                                        <h5>Lịch sử đỗ xe</h5>
                                        <p>Xem chi tiết các lần đỗ xe trước</p>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <a href="{{ url('/payment') }}" class="action_card">
                                    <div class="action_icon">
                                        <i class="fa fa-credit-card"></i>
                                    </div>
                                    <div class="action_content">
                                        <h5>Thanh toán</h5>
                                        <p>Quản lý phương thức thanh toán</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activities -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="recent_activities">
                        <h3>Hoạt động gần đây</h3>
                        <div class="activity_list">
                            <div class="activity_item">
                                <div class="activity_icon">
                                    <i class="fa fa-car"></i>
                                </div>
                                <div class="activity_content">
                                    <h6>Đỗ xe tại Bãi đỗ xe Vincom</h6>
                                    <p>15/09/2025 - 14:30 | Thời gian: 3 giờ | Phí: 45,000 VNĐ</p>
                                </div>
                                <div class="activity_status success">
                                    <span>Hoàn thành</span>
                                </div>
                            </div>
                            <div class="activity_item">
                                <div class="activity_icon">
                                    <i class="fa fa-car"></i>
                                </div>
                                <div class="activity_content">
                                    <h6>Đỗ xe tại Bãi đỗ xe Big C</h6>
                                    <p>12/09/2025 - 09:15 | Thời gian: 5 giờ | Phí: 60,000 VNĐ</p>
                                </div>
                                <div class="activity_status success">
                                    <span>Hoàn thành</span>
                                </div>
                            </div>
                            <div class="activity_item">
                                <div class="activity_icon">
                                    <i class="fa fa-car"></i>
                                </div>
                                <div class="activity_content">
                                    <h6>Đỗ xe tại Bãi đỗ xe Lotte</h6>
                                    <p>10/09/2025 - 18:00 | Thời gian: 2 giờ | Phí: 30,000 VNĐ</p>
                                </div>
                                <div class="activity_status success">
                                    <span>Hoàn thành</span>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <a href="{{ url('/history') }}" class="btn_box">Xem tất cả</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="sidebar_widgets">
                        <!-- Current Parking Status -->
                        <div class="widget_card">
                            <h4>Trạng thái hiện tại</h4>
                            <div class="current_status">
                                <div class="status_icon inactive">
                                    <i class="fa fa-car"></i>
                                </div>
                                <p>Hiện tại bạn không đỗ xe ở đâu</p>
                                <a href="{{ url('/booking') }}" class="btn_small">Đặt chỗ ngay</a>
                            </div>
                        </div>

                        <!-- Upcoming Reservations -->
                        <div class="widget_card">
                            <h4>Đặt chỗ sắp tới</h4>
                            <div class="upcoming_list">
                                <div class="upcoming_item">
                                    <h6>Bãi đỗ xe Aeon Mall</h6>
                                    <p>20/09/2025 - 15:00</p>
                                    <span class="status_badge pending">Đã đặt</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end dashboard section -->

    <!-- info section -->
    <section class="info_section ">

        <div class="container">
            <div class="info_top ">
                <div class="row ">
                    <div class="col-md-6 col-lg-3 info_col">
                        <div class="info_form">
                            <h4>
                                Kết Nối Với Chúng Tôi
                            </h4>
                            <form action="">
                                <input type="text" placeholder="Nhập Email Của Bạn" />
                                <button type="submit">
                                    Đăng Ký
                                </button>
                            </form>
                            <div class="social_box">
                                <a href="">
                                    <i class="fa fa-facebook" aria-hidden="true"></i>
                                </a>
                                <a href="">
                                    <i class="fa fa-twitter" aria-hidden="true"></i>
                                </a>
                                <a href="">
                                    <i class="fa fa-linkedin" aria-hidden="true"></i>
                                </a>
                                <a href="">
                                    <i class="fa fa-instagram" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 info_col ">
                        <div class="info_detail">
                            <h4>
                                Giới Thiệu
                            </h4>
                            <p>
                                Chúng tôi là đơn vị hàng đầu trong lĩnh vực cung cấp dịch vụ bãi đỗ xe với hệ thống
                                hiện đại, an toàn và tiện lợi. Với cam kết mang đến dịch vụ chất lượng cao, chúng tôi
                                luôn đặt sự hài lòng của khách hàng lên hàng đầu.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 info_col ">
                        <div class="info_detail">
                            <h4>
                                Đặt Chỗ Trực Tuyến
                            </h4>
                            <p>
                                Hệ thống đặt chỗ trực tuyến của chúng tôi cho phép bạn dễ dàng tìm kiếm và đặt chỗ đỗ xe
                                chỉ với vài cú click. Thanh toán an toàn, xác nhận ngay lập tức và tiết kiệm thời gian
                                tối đa cho bạn.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 info_col">
                        <h4>
                            Liên Hệ Với Chúng Tôi
                        </h4>
                        <p>
                            Hãy liên hệ với chúng tôi để được tư vấn và hỗ trợ tốt nhất
                        </p>
                        <div class="contact_nav">
                            <a href="">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                <span>
                                    Địa Chỉ
                                </span>
                            </a>
                            <a href="">
                                <i class="fa fa-phone" aria-hidden="true"></i>
                                <span>
                                    Gọi : +01 123455678990
                                </span>
                            </a>
                            <a href="">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                <span>
                                    Email : demo@gmail.com
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end info_section -->
    <!-- footer section -->
    <footer class="footer_section">
        <div class="container">
            <p>
                &copy; <span id="displayYear"></span> All Rights Reserved By
                <a href="https://html.design/">Free Html Templates</a>
            </p>
        </div>
    </footer>
    <!-- end footer section -->

    <!-- jQery -->
    <script src="{{ asset('user/js/jquery-3.4.1.min.js') }}"></script>
    <!-- popper js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
        </script>
    <!-- nice select -->
    <script src="{{ asset('user/js/jquery.nice-select.min.js') }}"></script>
    <!-- bootstrap js -->
    <script src="{{ asset('user/js/bootstrap.js') }}"></script>
    <!-- owl slider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
    </script>
    <!-- custom js -->
    <script src="{{ asset('user/js/custom.js') }}"></script>
    <!-- loading screen js -->
    <script src="{{ asset('user/js/loading.js') }}"></script>
    <!-- dashboard js -->
    <script src="{{ asset('user/js/dashboard.js') }}"></script>

</body>

</html>
