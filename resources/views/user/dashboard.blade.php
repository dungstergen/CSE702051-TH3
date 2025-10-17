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
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.reviews') }}">Đánh giá</a>
                            </li>
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

    <!-- Hero Banner Section -->
    <section class="hero_banner_section">
        <div class="hero_overlay"></div>
        <div class="container">
            <div class="hero_content">
                <h1 class="hero_title">Đặt Chỗ Đỗ Xe Ô Tô & Xe Máy</h1>
                <p class="hero_subtitle">Tìm kiếm và đặt chỗ đỗ xe nhanh chóng, an toàn với giá tốt nhất</p>
            </div>

            <!-- Search Tabs -->
            <div class="search_container">
                <div class="search_tabs">
                    <button class="tab_button active" data-tab="car">
                        <i class="fa fa-car"></i> Ô tô
                    </button>
                    <button class="tab_button" data-tab="motorbike">
                        <i class="fa fa-motorcycle"></i> Xe máy
                    </button>
                </div>

                <!-- Search Form -->
                <div class="search_form_wrapper">
                    <form class="search_form" action="{{ route('user.booking') }}" method="GET">
                        <div class="form_grid">
                            <div class="form_item">
                                <label class="form_label">Địa điểm</label>
                                <div class="input_wrapper">
                                    <i class="fa fa-map-marker input_icon"></i>
                                    <input type="text" class="form_input" name="location" placeholder="Tìm bãi đỗ xe..." required>
                                </div>
                            </div>

                            <div class="form_divider">
                                <i class="fa fa-arrows-h"></i>
                            </div>

                            <div class="form_item">
                                <label class="form_label">Thời gian bắt đầu</label>
                                <div class="input_wrapper">
                                    <i class="fa fa-clock-o input_icon"></i>
                                    <input type="datetime-local" class="form_input" name="start_time" required>
                                </div>
                            </div>

                            <div class="form_item">
                                <label class="form_label">Thời gian kết thúc</label>
                                <div class="input_wrapper">
                                    <i class="fa fa-calendar input_icon"></i>
                                    <input type="datetime-local" class="form_input" name="end_time" required>
                                </div>
                            </div>

                            <div class="form_item">
                                <button type="submit" class="btn_search_submit">
                                    Tìm kiếm
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Contact Info Cards -->
                <div class="contact_info_row">
                    <div class="contact_card">
                        <div class="contact_icon">
                            <i class="fa fa-shield"></i>
                        </div>
                        <div class="contact_text">
                            <p class="contact_label">An toàn & Bảo mật</p>
                            <p class="contact_value">Camera 24/7 - Bảo vệ chuyên nghiệp</p>
                        </div>
                    </div>
                    <div class="contact_card">
                        <div class="contact_icon">
                            <i class="fa fa-clock-o"></i>
                        </div>
                        <div class="contact_text">
                            <p class="contact_label">Mở cửa liên tục</p>
                            <p class="contact_value">Phục vụ 24/7 mọi lúc mọi nơi</p>
                        </div>
                    </div>
                    <div class="contact_card">
                        <div class="contact_icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="contact_text">
                            <p class="contact_label">Hotline hỗ trợ</p>
                            <p class="contact_value">Liên hệ: +84 083 364 526</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Destination Section -->
    <section class="destination_section">
        <div class="container">
            <div class="section_heading">
                <span class="section_label">Bãi Đỗ Xe Nổi Bật</span>
                <h2 class="section_title">Điểm Đến Tuyệt Vời Của Bạn</h2>
            </div>

            <div class="row destination_grid">
                <!-- Parking Card 1 -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="destination_card">
                        <div class="card_image_wrapper">
                            <img src="{{ asset('user/images/slider-bg.jpg') }}" alt="Bãi Đỗ Xe Vincom" class="card_image">
                            <div class="card_badge discount_badge">
                                <span>-32%</span>
                            </div>
                            <div class="card_badge hot_badge">
                                <span>🔥 HOT</span>
                            </div>
                        </div>
                        <div class="card_content">
                            <div class="card_header">
                                <h4 class="card_destination">
                                    <i class="fa fa-building-o"></i> Bãi Đỗ Xe Vincom Center
                                </h4>
                                <div class="card_rating">
                                    <i class="fa fa-star"></i>
                                    <span>4.8</span>
                                </div>
                            </div>
                            <p class="card_address">
                                <i class="fa fa-map-marker"></i> 72 Lê Thánh Tôn, Quận 1, TP.HCM
                            </p>
                            <div class="card_details">
                                <div class="detail_item">
                                    <i class="fa fa-car"></i>
                                    <span>Ô tô & Xe máy</span>
                                </div>
                                <div class="detail_item">
                                    <i class="fa fa-shield"></i>
                                    <span>Bảo vệ 24/7</span>
                                </div>
                            </div>
                            <div class="card_footer">
                                <div class="price_wrapper">
                                    <span class="price_icon"><i class="fa fa-tag"></i></span>
                                    <span class="price">15.000₫</span>
                                    <span class="price_unit">/ giờ</span>
                                </div>
                                <a href="{{ route('user.booking') }}" class="btn_book">
                                    <i class="fa fa-calendar-check-o"></i> Đặt chỗ ngay
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Parking Card 2 -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="destination_card">
                        <div class="card_image_wrapper">
                            <img src="{{ asset('user/images/slider-bg.jpg') }}" alt="Bãi Đỗ Xe Lotte" class="card_image">
                            <div class="card_badge new_badge">
                                <span>MỚI</span>
                            </div>
                        </div>
                        <div class="card_content">
                            <div class="card_header">
                                <h4 class="card_destination">
                                    <i class="fa fa-building-o"></i> Bãi Đỗ Xe Lotte Mart
                                </h4>
                                <div class="card_rating">
                                    <i class="fa fa-star"></i>
                                    <span>4.5</span>
                                </div>
                            </div>
                            <p class="card_address">
                                <i class="fa fa-map-marker"></i> 20 Trần Phú, Quận 5, TP.HCM
                            </p>
                            <div class="card_details">
                                <div class="detail_item">
                                    <i class="fa fa-car"></i>
                                    <span>Rộng rãi</span>
                                </div>
                                <div class="detail_item">
                                    <i class="fa fa-video-camera"></i>
                                    <span>Camera HD</span>
                                </div>
                            </div>
                            <div class="card_footer">
                                <div class="price_wrapper">
                                    <span class="price_icon"><i class="fa fa-tag"></i></span>
                                    <span class="price">12.000₫</span>
                                    <span class="price_unit">/ giờ</span>
                                </div>
                                <a href="{{ route('user.booking') }}" class="btn_book">
                                    <i class="fa fa-calendar-check-o"></i> Đặt chỗ ngay
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Parking Card 3 -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="destination_card">
                        <div class="card_image_wrapper">
                            <img src="{{ asset('user/images/slider-bg.jpg') }}" alt="Bãi Đỗ Xe Aeon" class="card_image">
                            <div class="card_badge discount_badge">
                                <span>-20%</span>
                            </div>
                        </div>
                        <div class="card_content">
                            <div class="card_header">
                                <h4 class="card_destination">
                                    <i class="fa fa-building-o"></i> Bãi Đỗ Xe Aeon Mall
                                </h4>
                                <div class="card_rating">
                                    <i class="fa fa-star"></i>
                                    <span>4.9</span>
                                </div>
                            </div>
                            <p class="card_address">
                                <i class="fa fa-map-marker"></i> 30 Bờ Bao Tân Thắng, Tân Phú, TP.HCM
                            </p>
                            <div class="card_details">
                                <div class="detail_item">
                                    <i class="fa fa-wifi"></i>
                                    <span>Free WiFi</span>
                                </div>
                                <div class="detail_item">
                                    <i class="fa fa-sun-o"></i>
                                    <span>Có mái che</span>
                                </div>
                            </div>
                            <div class="card_footer">
                                <div class="price_wrapper">
                                    <span class="price_icon"><i class="fa fa-tag"></i></span>
                                    <span class="price">18.000₫</span>
                                    <span class="price_unit">/ giờ</span>
                                </div>
                                <a href="{{ route('user.booking') }}" class="btn_book">
                                    <i class="fa fa-calendar-check-o"></i> Đặt chỗ ngay
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Parking Card 4 -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="destination_card">
                        <div class="card_image_wrapper">
                            <img src="{{ asset('user/images/slider-bg.jpg') }}" alt="Bãi Đỗ Xe BigC" class="card_image">
                            <div class="card_badge hot_badge">
                                <span>🔥 HOT</span>
                            </div>
                        </div>
                        <div class="card_content">
                            <div class="card_header">
                                <h4 class="card_destination">
                                    <i class="fa fa-building-o"></i> Bãi Đỗ Xe Big C
                                </h4>
                                <div class="card_rating">
                                    <i class="fa fa-star"></i>
                                    <span>4.7</span>
                                </div>
                            </div>
                            <p class="card_address">
                                <i class="fa fa-map-marker"></i> 232 Nguyễn Đình Chiểu, Quận 3, TP.HCM
                            </p>
                            <div class="card_details">
                                <div class="detail_item">
                                    <i class="fa fa-motorcycle"></i>
                                    <span>Xe máy</span>
                                </div>
                                <div class="detail_item">
                                    <i class="fa fa-lock"></i>
                                    <span>An toàn</span>
                                </div>
                            </div>
                            <div class="card_footer">
                                <div class="price_wrapper">
                                    <span class="price_icon"><i class="fa fa-tag"></i></span>
                                    <span class="price">10.000₫</span>
                                    <span class="price_unit">/ giờ</span>
                                </div>
                                <a href="{{ route('user.booking') }}" class="btn_book">
                                    <i class="fa fa-calendar-check-o"></i> Đặt chỗ ngay
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Parking Card 5 -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="destination_card">
                        <div class="card_image_wrapper">
                            <img src="{{ asset('user/images/slider-bg.jpg') }}" alt="Bãi Đỗ Xe Parkson" class="card_image">
                            <div class="card_badge discount_badge">
                                <span>-15%</span>
                            </div>
                        </div>
                        <div class="card_content">
                            <div class="card_header">
                                <h4 class="card_destination">
                                    <i class="fa fa-building-o"></i> Bãi Đỗ Xe Parkson
                                </h4>
                                <div class="card_rating">
                                    <i class="fa fa-star"></i>
                                    <span>4.6</span>
                                </div>
                            </div>
                            <p class="card_address">
                                <i class="fa fa-map-marker"></i> 45 Lê Thánh Tôn, Quận 1, TP.HCM
                            </p>
                            <div class="card_details">
                                <div class="detail_item">
                                    <i class="fa fa-car"></i>
                                    <span>Đa dạng</span>
                                </div>
                                <div class="detail_item">
                                    <i class="fa fa-users"></i>
                                    <span>Valet parking</span>
                                </div>
                            </div>
                            <div class="card_footer">
                                <div class="price_wrapper">
                                    <span class="price_icon"><i class="fa fa-tag"></i></span>
                                    <span class="price">14.000₫</span>
                                    <span class="price_unit">/ giờ</span>
                                </div>
                                <a href="{{ route('user.booking') }}" class="btn_book">
                                    <i class="fa fa-calendar-check-o"></i> Đặt chỗ ngay
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Parking Card 6 -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="destination_card">
                        <div class="card_image_wrapper">
                            <img src="{{ asset('user/images/slider-bg.jpg') }}" alt="Bãi Đỗ Xe Coopmart" class="card_image">
                            <div class="card_badge new_badge">
                                <span>MỚI</span>
                            </div>
                            <div class="card_badge hot_badge">
                                <span>🔥 HOT</span>
                            </div>
                        </div>
                        <div class="card_content">
                            <div class="card_header">
                                <h4 class="card_destination">
                                    <i class="fa fa-building-o"></i> Bãi Đỗ Xe Coopmart
                                </h4>
                                <div class="card_rating">
                                    <i class="fa fa-star"></i>
                                    <span>5.0</span>
                                </div>
                            </div>
                            <p class="card_address">
                                <i class="fa fa-map-marker"></i> 168 Nguyễn Văn Cừ, Quận 5, TP.HCM
                            </p>
                            <div class="card_details">
                                <div class="detail_item">
                                    <i class="fa fa-star"></i>
                                    <span>Ưu đãi</span>
                                </div>
                                <div class="detail_item">
                                    <i class="fa fa-refresh"></i>
                                    <span>Linh hoạt</span>
                                </div>
                            </div>
                            <div class="card_footer">
                                <div class="price_wrapper">
                                    <span class="price_icon"><i class="fa fa-tag"></i></span>
                                    <span class="price">11.000₫</span>
                                    <span class="price_unit">/ giờ</span>
                                </div>
                                <a href="{{ route('user.booking') }}" class="btn_book">
                                    <i class="fa fa-calendar-check-o"></i> Đặt chỗ ngay
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
