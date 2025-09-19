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
    <!-- booking style -->
    <link href="{{ asset('user/css/booking.css') }}" rel="stylesheet" />

</head>

<body class="sub_page">

<body>

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
                            <li class="nav-item">
<a class="nav-link" href="{{ url('/dashboard') }}">Bảng điều khiển</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="{{ url('/booking') }}">Đặt chỗ <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/history') }}">Lịch sử</a>
                            </li>
                        </ul>
                        <form class="form-inline">
                            <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </button>
                        </form>
                    </div>
                </nav>
            </div>
        </header>
        <!-- end header section -->
    </div>

    <!-- Booking section -->
    <section class="booking_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>
                    Đặt chỗ đỗ xe
                </h2>
                <p>
                    Tìm và đặt chỗ đỗ xe gần bạn một cách nhanh chóng và tiện lợi
                </p>
            </div>

            <div class="row">
                <!-- Search & Filter Panel -->
                <div class="col-lg-4">
                    <div class="search_panel">
                        <h4>Tìm kiếm bãi đỗ xe</h4>

                        <!-- Location Search -->
                        <div class="search_group">
                            <label>Địa điểm</label>
                            <div class="input_wrapper">
                                <i class="fa fa-map-marker"></i>
                                <input type="text" id="locationSearch" placeholder="Nhập địa chỉ hoặc tên địa điểm">
                                <button type="button" class="location_btn" id="getCurrentLocation">
                                    <i class="fa fa-crosshairs"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Date & Time -->
                        <div class="row">
                            <div class="col-6">
                                <div class="search_group">
                                    <label>Ngày đỗ xe</label>
                                    <div class="input_wrapper">
                                        <i class="fa fa-calendar"></i>
                                        <input type="date" id="parkingDate" min="2025-09-19">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
<div class="search_group">
                                    <label>Giờ vào</label>
                                    <div class="input_wrapper">
                                        <i class="fa fa-clock-o"></i>
                                        <input type="time" id="entryTime">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="search_group">
                                    <label>Thời gian đỗ</label>
                                    <div class="input_wrapper">
                                        <i class="fa fa-hourglass-half"></i>
                                        <select id="duration">
                                            <option value="1">1 giờ</option>
                                            <option value="2">2 giờ</option>
                                            <option value="3" selected>3 giờ</option>
                                            <option value="4">4 giờ</option>
                                            <option value="6">6 giờ</option>
                                            <option value="8">8 giờ</option>
                                            <option value="12">12 giờ</option>
                                            <option value="24">24 giờ</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="search_group">
                                    <label>Loại xe</label>
                                    <div class="input_wrapper">
                                        <i class="fa fa-car"></i>
                                        <select id="vehicleType">
                                            <option value="car">Ô tô</option>
                                            <option value="motorcycle">Xe máy</option>
                                            <option value="bike">Xe đạp</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Price Range -->
                        <div class="search_group">
                            <label>Khoảng giá (VNĐ/giờ)</label>
                            <div class="price_range">
                                <input type="range" id="priceRange" min="5000" max="50000" value="25000" step="5000">
                                <div class="price_display">
                                    <span>5,000</span>
<span id="currentPrice">25,000</span>
                                    <span>50,000</span>
                                </div>
                            </div>
                        </div>

                        <!-- Features Filter -->
                        <div class="search_group">
                            <label>Tiện ích</label>
                            <div class="features_filter">
                                <label class="feature_item">
                                    <input type="checkbox" value="covered">
                                    <span class="checkmark"></span>
                                    Có mái che
                                </label>
                                <label class="feature_item">
                                    <input type="checkbox" value="security">
                                    <span class="checkmark"></span>
                                    Bảo vệ 24/7
                                </label>
                                <label class="feature_item">
                                    <input type="checkbox" value="cctv">
                                    <span class="checkmark"></span>
                                    Camera giám sát
                                </label>
                                <label class="feature_item">
                                    <input type="checkbox" value="wash">
                                    <span class="checkmark"></span>
                                    Rửa xe
                                </label>
                                <label class="feature_item">
                                    <input type="checkbox" value="electric">
                                    <span class="checkmark"></span>
                                    Sạc xe điện
                                </label>
                            </div>
                        </div>

                        <button type="button" class="search_btn" id="searchParking">
                            <i class="fa fa-search"></i>
                            Tìm kiếm
                        </button>
                    </div>
                </div>

                <!-- Map & Results -->
                <div class="col-lg-8">
                    <div class="map_results_container">
                        <!-- Map Section -->
                        <div class="map_section">
                            <div id="parkingMap" class="parking_map">
                                <!-- Map sẽ được load bằng JavaScript -->
                                <div class="map_placeholder">
                                    <i class="fa fa-map"></i>
                                    <p>Bản đồ sẽ hiển thị các bãi đỗ xe gần bạn</p>
                                    <small>Nhấn "Tìm kiếm" để xem kết quả</small>
                                </div>
</div>

                            <!-- Map Controls -->
                            <div class="map_controls">
                                <button type="button" class="map_control_btn" id="toggleView">
                                    <i class="fa fa-list"></i>
                                </button>
                                <button type="button" class="map_control_btn" id="centerMap">
                                    <i class="fa fa-crosshairs"></i>
                                </button>
                                <button type="button" class="map_control_btn" id="zoomIn">
                                    <i class="fa fa-plus"></i>
                                </button>
                                <button type="button" class="map_control_btn" id="zoomOut">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Results List -->
                        <div class="results_section">
                            <div class="results_header">
                                <h4>Kết quả tìm kiếm</h4>
                                <div class="sort_options">
                                    <select id="sortBy">
                                        <option value="distance">Khoảng cách</option>
                                        <option value="price">Giá thấp nhất</option>
                                        <option value="rating">Đánh giá cao</option>
                                        <option value="availability">Còn chỗ</option>
                                    </select>
                                </div>
                            </div>

                            <div class="parking_results" id="parkingResults">
                                <!-- Parking Lot 1 -->
                                <div class="parking_card" data-lat="10.762622" data-lng="106.660172">
                                    <div class="parking_image">
                                        <img src="{{ asset('user/images/parking1.jpg') }}" alt="Bãi đỗ xe Vincom">
                                        <div class="availability_badge available">Còn 15 chỗ</div>
                                    </div>
                                    <div class="parking_info">
                                        <h5>Bãi đỗ xe Vincom Center</h5>
                                        <p class="location">
                                            <i class="fa fa-map-marker"></i>
                                            72 Lê Thánh Tôn, Quận 1, TP.HCM
                                        </p>
                                        <p class="distance">
                                            <i class="fa fa-road"></i>
                                            0.8 km từ vị trí của bạn
</p>
                                        <div class="features">
                                            <span class="feature"><i class="fa fa-shield"></i> Bảo vệ 24/7</span>
                                            <span class="feature"><i class="fa fa-video-camera"></i> Camera</span>
                                            <span class="feature"><i class="fa fa-umbrella"></i> Mái che</span>
                                        </div>
                                        <div class="rating">
                                            <div class="stars">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <span class="rating_score">4.8</span>
                                            <span class="review_count">(124 đánh giá)</span>
                                        </div>
                                    </div>
                                    <div class="parking_price">
                                        <div class="price_info">
                                            <span class="price">15,000 VNĐ</span>
                                            <span class="unit">/giờ</span>
                                        </div>
                                        <div class="total_estimate">
                                            Tổng: <strong>45,000 VNĐ</strong>
                                        </div>
                                        <button type="button" class="book_btn" data-parking-id="1">
                                            Đặt chỗ
                                        </button>
                                    </div>
                                </div>

                                <!-- Parking Lot 2 -->
                                <div class="parking_card" data-lat="10.771973" data-lng="106.698228">
                                    <div class="parking_image">
                                        <img src="{{ asset('user/images/parking2.jpg') }}" alt="Bãi đỗ xe Big C">
                                        <div class="availability_badge limited">Còn 3 chỗ</div>
                                    </div>
                                    <div class="parking_info">
                                        <h5>Bãi đỗ xe Big C Thăng Long</h5>
                                        <p class="location">
                                            <i class="fa fa-map-marker"></i>
                                            222 Trần Hưng Đạo, Quận 5, TP.HCM
</p>
                                        <p class="distance">
                                            <i class="fa fa-road"></i>
                                            1.2 km từ vị trí của bạn
                                        </p>
                                        <div class="features">
                                            <span class="feature"><i class="fa fa-shield"></i> Bảo vệ 24/7</span>
                                            <span class="feature"><i class="fa fa-video-camera"></i> Camera</span>
                                            <span class="feature"><i class="fa fa-tint"></i> Rửa xe</span>
                                        </div>
                                        <div class="rating">
                                            <div class="stars">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-half-o"></i>
                                            </div>
                                            <span class="rating_score">4.6</span>
                                            <span class="review_count">(89 đánh giá)</span>
                                        </div>
                                    </div>
                                    <div class="parking_price">
                                        <div class="price_info">
                                            <span class="price">12,000 VNĐ</span>
                                            <span class="unit">/giờ</span>
                                        </div>
                                        <div class="total_estimate">
                                            Tổng: <strong>36,000 VNĐ</strong>
                                        </div>
                                        <button type="button" class="book_btn" data-parking-id="2">
                                            Đặt chỗ
                                        </button>
                                    </div>
                                </div>

                                <!-- Parking Lot 3 -->
                                <div class="parking_card" data-lat="10.782740" data-lng="106.695215">
                                    <div class="parking_image">
                                        <img src="{{ asset('user/images/parking3.jpg') }}" alt="Bãi đỗ xe Lotte">
                                        <div class="availability_badge full">Hết chỗ</div>
                                    </div>
                                    <div class="parking_info">
<h5>Bãi đỗ xe Lotte Center</h5>
                                        <p class="location">
                                            <i class="fa fa-map-marker"></i>
                                            128 Nguyễn Huệ, Quận 1, TP.HCM
                                        </p>
                                        <p class="distance">
                                            <i class="fa fa-road"></i>
                                            0.5 km từ vị trí của bạn
                                        </p>
                                        <div class="features">
                                            <span class="feature"><i class="fa fa-shield"></i> Bảo vệ 24/7</span>
                                            <span class="feature"><i class="fa fa-video-camera"></i> Camera</span>
                                            <span class="feature"><i class="fa fa-umbrella"></i> Mái che</span>
                                            <span class="feature"><i class="fa fa-bolt"></i> Sạc xe điện</span>
                                        </div>
                                        <div class="rating">
                                            <div class="stars">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <span class="rating_score">4.9</span>
                                            <span class="review_count">(156 đánh giá)</span>
                                        </div>
                                    </div>
                                    <div class="parking_price">
                                        <div class="price_info">
                                            <span class="price">20,000 VNĐ</span>
                                            <span class="unit">/giờ</span>
                                        </div>
                                        <div class="total_estimate">
                                            Tổng: <strong>60,000 VNĐ</strong>
                                        </div>
                                        <button type="button" class="book_btn disabled" disabled>
                                            Hết chỗ
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Load More -->
                            <div class="load_more_section">
<button type="button" class="load_more_btn" id="loadMore">
                                    <i class="fa fa-refresh"></i>
                                    Xem thêm kết quả
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end booking section -->

    <!-- Booking Modal -->
    <div class="modal fade" id="bookingModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Xác nhận đặt chỗ</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="booking_summary">
                        <div class="parking_details">
                            <h6>Thông tin bãi đỗ xe</h6>
                            <div class="detail_item">
                                <strong id="modalParkingName">Bãi đỗ xe Vincom Center</strong>
                                <p id="modalParkingAddress">72 Lê Thánh Tôn, Quận 1, TP.HCM</p>
                            </div>
                        </div>

                        <div class="booking_details">
                            <h6>Chi tiết đặt chỗ</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="detail_item">
                                        <label>Ngày đỗ xe:</label>
                                        <span id="modalDate">19/09/2025</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="detail_item">
                                        <label>Giờ vào:</label>
                                        <span id="modalEntryTime">14:00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="detail_item">
                                        <label>Thời gian đỗ:</label>
                                        <span id="modalDuration">3 giờ</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="detail_item">
                                        <label>Giờ ra dự kiến:</label>
<span id="modalExitTime">17:00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="detail_item">
                                <label>Loại xe:</label>
                                <span id="modalVehicleType">Ô tô</span>
                            </div>
                        </div>

                        <div class="price_breakdown">
                            <h6>Chi tiết giá</h6>
                            <div class="price_item">
                                <span>Giá đỗ xe:</span>
                                <span><span id="modalHourlyRate">15,000</span> VNĐ/giờ</span>
                            </div>
                            <div class="price_item">
                                <span>Thời gian:</span>
                                <span><span id="modalHours">3</span> giờ</span>
                            </div>
                            <div class="price_item">
                                <span>Phí dịch vụ:</span>
                                <span>5,000 VNĐ</span>
                            </div>
                            <div class="price_item total">
                                <span>Tổng cộng:</span>
                                <span><strong id="modalTotal">50,000</strong> VNĐ</span>
                            </div>
                        </div>

                        <div class="vehicle_info">
                            <h6>Thông tin xe</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" class="form-control" placeholder="Biển số xe *" id="licensePlate" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" placeholder="Màu xe" id="vehicleColor">
                                </div>
                            </div>
                            <textarea class="form-control" rows="2" placeholder="Ghi chú (tùy chọn)" id="bookingNotes"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-primary" id="confirmBooking">
                        <i class="fa fa-check"></i>
                        Xác nhận đặt chỗ
                    </button>
                </div>
            </div>
        </div>
    </div>

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
    <!-- booking js -->
    <script src="{{ asset('user/js/booking.js') }}"></script>

</body>

</html>
