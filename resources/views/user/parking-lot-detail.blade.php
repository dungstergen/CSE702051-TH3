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
                    <a class="navbar-brand" href="{{ route('home') }}">
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
                                <a class="nav-link" href="{{ route('home') }}">Trang chủ</a>
                            </li>
                            @auth
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.dashboard') }}">Bảng điều khiển</a>
                            </li>
                            @endauth
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.booking') }}">Đặt chỗ</a>
                            </li>
                            @auth
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.history') }}">Lịch sử</a>
                            </li>
                            @endauth
                        </ul>
                        <div class="navbar-nav ml-auto">
                            @auth
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
                            @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">
                                    <i class="fa fa-sign-in"></i> Đăng nhập
                                </a>
                            </li>
                            @endauth
                        </div>
                    </div>
                </nav>
            </div>
        </header>
        <!-- end header section -->
    </div>

    <!-- Parking Lot Detail Section -->
    <section class="parking_detail_section layout_padding">
        <div class="container">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('user.booking') }}">Đặt chỗ</a></li>
                    <li class="breadcrumb-item active">Chi tiết bãi đỗ xe</li>
                </ol>
            </nav>

            <div class="row">
                <!-- Left Column: Details -->
                <div class="col-lg-8">
                    <!-- Image Gallery -->
                    <div class="parking_gallery mb-4">
                        <div class="main_image">
                            <img id="mainImage" src="{{ asset('user/images/parking1.jpg') }}" alt="Parking Lot">
                        </div>
                        <div class="thumbnail_images mt-3">
                            <img src="{{ asset('user/images/parking1.jpg') }}" onclick="changeMainImage(this.src)">
                            <img src="{{ asset('user/images/parking2.jpg') }}" onclick="changeMainImage(this.src)">
                            <img src="{{ asset('user/images/parking3.jpg') }}" onclick="changeMainImage(this.src)">
                            <img src="{{ asset('user/images/parking1.jpg') }}" onclick="changeMainImage(this.src)">
                        </div>
                    </div>

                    <!-- Basic Information -->
                    <div class="detail_card">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h2 id="parkingName">Bãi đỗ xe Vincom Center</h2>
                                <p class="text-muted">
                                    <i class="fa fa-map-marker"></i>
                                    <span id="parkingAddress">72 Lê Thánh Tôn, Quận 1, TP. Hồ Chí Minh</span>
                                </p>
                            </div>
                            <div class="rating_badge">
                                <i class="fa fa-star"></i>
                                <span id="parkingRating">4.5</span>
                                <small>(<span id="reviewCount">128</span> đánh giá)</small>
                            </div>
                        </div>

                        <div class="price_info mb-3">
                            <h3 class="text-warning">
                                <span id="hourlyRate">15,000</span>đ/giờ
                            </h3>
                        </div>

                        <div class="capacity_info mb-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="info_box">
                                        <i class="fa fa-car"></i>
                                        <div>
                                            <strong>Chỗ trống</strong>
                                            <p><span id="availableSpaces">45</span>/<span id="totalSpaces">100</span></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info_box">
                                        <i class="fa fa-clock-o"></i>
                                        <div>
                                            <strong>Giờ mở cửa</strong>
                                            <p id="operatingHours">24/7</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Features & Amenities -->
                    <div class="detail_card">
                        <h4 class="mb-3">
                            <i class="fa fa-list"></i> Tiện nghi & Dịch vụ
                        </h4>

                        <div class="features_grid">
                            <div class="feature_item">
                                <i class="fa fa-shield"></i>
                                <span>Bảo vệ 24/7</span>
                            </div>
                            <div class="feature_item">
                                <i class="fa fa-video-camera"></i>
                                <span>Camera giám sát</span>
                            </div>
                            <div class="feature_item">
                                <i class="fa fa-wifi"></i>
                                <span>WiFi miễn phí</span>
                            </div>
                            <div class="feature_item">
                                <i class="fa fa-lightbulb-o"></i>
                                <span>Đèn chiếu sáng tốt</span>
                            </div>
                            <div class="feature_item">
                                <i class="fa fa-wheelchair"></i>
                                <span>Tiện nghi cho người khuyết tật</span>
                            </div>
                            <div class="feature_item">
                                <i class="fa fa-credit-card"></i>
                                <span>Thanh toán thẻ</span>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="detail_card">
                        <h4 class="mb-3">
                            <i class="fa fa-info-circle"></i> Mô tả
                        </h4>
                        <p id="parkingDescription">
                            Bãi đỗ xe Vincom Center là một trong những bãi đỗ xe hiện đại và rộng rãi nhất tại trung tâm thành phố.
                            Với diện tích lớn và trang thiết bị hiện đại, chúng tôi cam kết mang đến cho khách hàng trải nghiệm
                            đỗ xe an toàn và tiện lợi nhất. Bãi đỗ có hệ thống camera giám sát 24/7, bảo vệ túc trực,
                            và được trang bị đầy đủ tiện nghi như thang máy, toilet, wifi miễn phí.
                        </p>
                    </div>

                    <!-- Map Location -->
                    <div class="detail_card">
                        <h4 class="mb-3">
                            <i class="fa fa-map"></i> Vị trí
                        </h4>
                        <div id="map" style="height: 400px; background: #e9ecef; border-radius: 10px;">
                            <div class="d-flex align-items-center justify-content-center h-100">
                                <div class="text-center">
                                    <i class="fa fa-map-o fa-3x text-muted"></i>
                                    <p class="mt-2 text-muted">Bản đồ sẽ hiển thị ở đây</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Reviews Section -->
                    <div class="detail_card">
                        <h4 class="mb-4">
                            <i class="fa fa-comments"></i> Đánh giá từ khách hàng
                        </h4>

                        <!-- Rating Summary -->
                        <div class="rating_summary mb-4">
                            <div class="row">
                                <div class="col-md-4 text-center">
                                    <h1 class="display-3 text-warning mb-0">4.5</h1>
                                    <div class="stars mb-2">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-o"></i>
                                    </div>
                                    <p class="text-muted">128 đánh giá</p>
                                </div>
                                <div class="col-md-8">
                                    <div class="rating_bars">
                                        <div class="rating_bar_item">
                                            <span>5 <i class="fa fa-star"></i></span>
                                            <div class="progress">
                                                <div class="progress-bar bg-warning" style="width: 70%"></div>
                                            </div>
                                            <span>70%</span>
                                        </div>
                                        <div class="rating_bar_item">
                                            <span>4 <i class="fa fa-star"></i></span>
                                            <div class="progress">
                                                <div class="progress-bar bg-warning" style="width: 20%"></div>
                                            </div>
                                            <span>20%</span>
                                        </div>
                                        <div class="rating_bar_item">
                                            <span>3 <i class="fa fa-star"></i></span>
                                            <div class="progress">
                                                <div class="progress-bar bg-warning" style="width: 7%"></div>
                                            </div>
                                            <span>7%</span>
                                        </div>
                                        <div class="rating_bar_item">
                                            <span>2 <i class="fa fa-star"></i></span>
                                            <div class="progress">
                                                <div class="progress-bar bg-warning" style="width: 2%"></div>
                                            </div>
                                            <span>2%</span>
                                        </div>
                                        <div class="rating_bar_item">
                                            <span>1 <i class="fa fa-star"></i></span>
                                            <div class="progress">
                                                <div class="progress-bar bg-warning" style="width: 1%"></div>
                                            </div>
                                            <span>1%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Individual Reviews -->
                        <div class="reviews_list">
                            <div class="review_item">
                                <div class="d-flex justify-content-between">
                                    <div class="reviewer_info">
                                        <div class="reviewer_avatar">
                                            <i class="fa fa-user"></i>
                                        </div>
                                        <div>
                                            <strong>Nguyễn Văn A</strong>
                                            <p class="text-muted small">15/10/2025</p>
                                        </div>
                                    </div>
                                    <div class="review_rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                </div>
                                <p class="review_text mt-2">
                                    Bãi đỗ xe rất rộng rãi và sạch sẽ. Nhân viên nhiệt tình, giá cả hợp lý.
                                    Tôi rất hài lòng với dịch vụ ở đây!
                                </p>
                            </div>

                            <div class="review_item">
                                <div class="d-flex justify-content-between">
                                    <div class="reviewer_info">
                                        <div class="reviewer_avatar">
                                            <i class="fa fa-user"></i>
                                        </div>
                                        <div>
                                            <strong>Trần Thị B</strong>
                                            <p class="text-muted small">12/10/2025</p>
                                        </div>
                                    </div>
                                    <div class="review_rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                    </div>
                                </div>
                                <p class="review_text mt-2">
                                    Vị trí thuận tiện, gần trung tâm. Camera an ninh đầy đủ. Chỉ có điều giờ cao điểm hơi đông.
                                </p>
                            </div>

                            <div class="review_item">
                                <div class="d-flex justify-content-between">
                                    <div class="reviewer_info">
                                        <div class="reviewer_avatar">
                                            <i class="fa fa-user"></i>
                                        </div>
                                        <div>
                                            <strong>Lê Văn C</strong>
                                            <p class="text-muted small">08/10/2025</p>
                                        </div>
                                    </div>
                                    <div class="review_rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                </div>
                                <p class="review_text mt-2">
                                    Tuyệt vời! Bãi đỗ xe hiện đại, an toàn. Sẽ quay lại lần sau.
                                </p>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <button class="btn btn-outline-primary" onclick="loadMoreReviews()">
                                Xem thêm đánh giá
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Booking Form -->
                <div class="col-lg-4">
                    <div class="booking_sticky_card">
                        <h4 class="mb-3">Đặt chỗ ngay</h4>

                        <form method="POST" action="{{ route('user.booking.store') }}">
                            @csrf
                            <input type="hidden" name="parking_lot_id" value="1">

                            <div class="form-group">
                                <label>Thời gian bắt đầu *</label>
                                <input type="datetime-local" class="form-control" name="start_time"
                                    id="startTime" required onchange="calculatePrice()">
                            </div>

                            <div class="form-group">
                                <label>Thời gian kết thúc *</label>
                                <input type="datetime-local" class="form-control" name="end_time"
                                    id="endTime" required onchange="calculatePrice()">
                            </div>

                            <div class="form-group">
                                <label>Loại xe *</label>
                                <select class="form-control" name="vehicle_type" required>
                                    <option value="">Chọn loại xe</option>
                                    <option value="car">Ô tô</option>
                                    <option value="motorbike">Xe máy</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Biển số xe *</label>
                                <input type="text" class="form-control" name="vehicle_number"
                                    placeholder="VD: 29A-12345" required>
                            </div>

                            <div class="form-group">
                                <label>Ghi chú</label>
                                <textarea class="form-control" name="notes" rows="2"
                                    placeholder="Ghi chú đặc biệt (nếu có)"></textarea>
                            </div>

                            <div class="price_breakdown mb-3">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Thời gian:</span>
                                    <strong id="durationText">0 giờ</strong>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Đơn giá:</span>
                                    <strong>15,000đ/giờ</strong>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <span><strong>Tổng cộng:</strong></span>
                                    <h4 class="text-warning mb-0" id="totalPrice">0đ</h4>
                                </div>
                            </div>

                            @auth
                            <button type="submit" class="btn btn_box w-100">
                                <i class="fa fa-check"></i> Xác nhận đặt chỗ
                            </button>
                            @else
                            <a href="{{ route('login') }}" class="btn btn_box w-100">
                                <i class="fa fa-sign-in"></i> Đăng nhập để đặt chỗ
                            </a>
                            @endauth
                        </form>

                        <div class="contact_info mt-4">
                            <h5>Liên hệ hỗ trợ</h5>
                            <p>
                                <i class="fa fa-phone"></i> Hotline: 1900-xxxx<br>
                                <i class="fa fa-envelope"></i> support@paspark.vn
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Parking Lot Detail Section -->

    <!-- Custom Styles -->
    <style>
        .breadcrumb {
            background: white;
            padding: 15px 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }

        .parking_gallery .main_image {
            width: 100%;
            height: 400px;
            border-radius: 10px;
            overflow: hidden;
        }

        .parking_gallery .main_image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .thumbnail_images {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
        }

        .thumbnail_images img {
            width: 100%;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .thumbnail_images img:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .detail_card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }

        .detail_card h4 {
            color: #252525;
            font-weight: 700;
            padding-bottom: 10px;
            border-bottom: 2px solid #ffbe33;
        }

        .rating_badge {
            background: #fff3cd;
            padding: 10px 20px;
            border-radius: 8px;
            text-align: center;
        }

        .rating_badge .fa-star {
            color: #ffbe33;
            font-size: 20px;
        }

        .info_box {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .info_box i {
            font-size: 30px;
            color: #ffbe33;
        }

        .features_grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
        }

        .feature_item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .feature_item i {
            color: #ffbe33;
            font-size: 20px;
        }

        .booking_sticky_card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            position: sticky;
            top: 20px;
        }

        .price_breakdown {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
        }

        .review_item {
            padding: 20px;
            border-bottom: 1px solid #eee;
        }

        .reviewer_info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .reviewer_avatar {
            width: 50px;
            height: 50px;
            background: #ffbe33;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
        }

        .review_rating .fa-star {
            color: #ffbe33;
        }

        .rating_bar_item {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }

        .rating_bar_item .progress {
            flex: 1;
            height: 8px;
        }
    </style>

    <!-- JavaScript -->
    <script>
        function changeMainImage(src) {
            document.getElementById('mainImage').src = src;
        }

        function calculatePrice() {
            const startTime = document.getElementById('startTime').value;
            const endTime = document.getElementById('endTime').value;

            if (startTime && endTime) {
                const start = new Date(startTime);
                const end = new Date(endTime);
                const hours = Math.ceil((end - start) / (1000 * 60 * 60));

                if (hours > 0) {
                    const hourlyRate = 15000;
                    const total = hours * hourlyRate;

                    document.getElementById('durationText').textContent = hours + ' giờ';
                    document.getElementById('totalPrice').textContent = total.toLocaleString('vi-VN') + 'đ';
                }
            }
        }

        function loadMoreReviews() {
            alert('Đang tải thêm đánh giá...');
        }
    </script>



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

</body>

</html>
