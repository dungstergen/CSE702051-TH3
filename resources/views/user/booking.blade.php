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
                            <li class="nav-item active">
                                <a class="nav-link" href="{{ route('user.booking') }}">Đặt chỗ <span class="sr-only">(current)</span></a>
                            </li>
                            @auth
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.history') }}">Lịch sử</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.reviews') }}">Đánh giá</a>
                            </li>
                            @endauth
                            {{-- <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.pricing') }}">Gói dịch vụ</a>
                            </li> --}}
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

    <!-- Booking Section -->
    <section class="booking_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>Đặt chỗ đỗ xe</h2>
                <p>Tìm và đặt chỗ đỗ xe phù hợp với bạn</p>
            </div>

            <!-- Search & Filter Section -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="search_filter_card">
                        <form id="searchFilterForm">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label><i class="fa fa-map-marker"></i> Vị trí</label>
                                    <input type="text" class="form-control" id="location" placeholder="Nhập địa chỉ hoặc tên bãi đỗ xe">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label><i class="fa fa-calendar"></i> Ngày bắt đầu</label>
                                    <input type="datetime-local" class="form-control" id="start_time">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label><i class="fa fa-calendar"></i> Ngày kết thúc</label>
                                    <input type="datetime-local" class="form-control" id="end_time">
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label>&nbsp;</label>
                                    <button type="button" class="btn btn_box w-100" onclick="searchParkingLots()">
                                        <i class="fa fa-search"></i> Tìm kiếm
                                    </button>
                                </div>
                            </div>

                            <!-- Advanced Filters -->
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label><i class="fa fa-car"></i> Loại xe</label>
                                    <select class="form-control" id="vehicle_type">
                                        <option value="">Tất cả</option>
                                        <option value="car">Ô tô</option>
                                        <option value="motorbike">Xe máy</option>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label><i class="fa fa-money"></i> Giá</label>
                                    <select class="form-control" id="price_range">
                                        <option value="">Tất cả</option>
                                        <option value="0-50000">Dưới 50,000đ</option>
                                        <option value="50000-100000">50,000đ - 100,000đ</option>
                                        <option value="100000-200000">100,000đ - 200,000đ</option>
                                        <option value="200000+">Trên 200,000đ</option>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label><i class="fa fa-sort"></i> Sắp xếp</label>
                                    <select class="form-control" id="sort_by">
                                        <option value="distance">Khoảng cách</option>
                                        <option value="price_low">Giá thấp đến cao</option>
                                        <option value="price_high">Giá cao đến thấp</option>
                                        <option value="rating">Đánh giá</option>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label>&nbsp;</label>
                                    <button type="button" class="btn btn-secondary w-100" onclick="resetFilters()">
                                        <i class="fa fa-refresh"></i> Đặt lại
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Parking Lots List -->
                <div class="col-lg-7">
                    <div class="parking_lots_container">
                        <h4 class="mb-3">Danh sách bãi đỗ xe <span id="resultCount">(0 kết quả)</span></h4>

                        <div id="parkingLotsList">
                            <!-- Parking Lot Cards will be loaded here dynamically -->
                            <div class="text-center py-5">
                                <i class="fa fa-spinner fa-spin fa-3x text-muted"></i>
                                <p class="mt-3">Đang tải danh sách bãi đỗ xe...</p>
                            </div>
                        </div>

                        <!-- Pagination -->
                        <div id="pagination" class="mt-4"></div>
                    </div>
                </div>

                <!-- Map & Booking Form -->
                <div class="col-lg-5">
                    <!-- Map Section -->
                    <div class="map_section mb-4">
                        <h4 class="mb-3">Bản đồ</h4>
                        <div id="map" style="height: 400px; background: #e9ecef; border-radius: 10px;">
                            <div class="d-flex align-items-center justify-content-center h-100">
                                <div class="text-center">
                                    <i class="fa fa-map-o fa-3x text-muted"></i>
                                    <p class="mt-2 text-muted">Bản đồ sẽ hiển thị ở đây</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Booking Form -->
                    <div class="booking_form_container" id="bookingFormContainer" style="display: none;">
                        <h4 class="mb-3">Thông tin đặt chỗ</h4>
                        <form id="bookingForm" method="POST" action="{{ route('user.booking.store') }}">
                            @csrf
                            <input type="hidden" name="parking_lot_id" id="selected_parking_lot_id">

                            <div class="form-group">
                                <label>Bãi đỗ xe đã chọn</label>
                                <input type="text" class="form-control" id="selected_parking_name" readonly>
                            </div>

                            <div class="form-group">
                                <label>Biển số xe *</label>
                                <input type="text" class="form-control" name="vehicle_number" required placeholder="VD: 29A-12345">
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
                                <label>Thời gian bắt đầu *</label>
                                <input type="datetime-local" class="form-control" name="start_time" required>
                            </div>

                            <div class="form-group">
                                <label>Thời gian kết thúc *</label>
                                <input type="datetime-local" class="form-control" name="end_time" required>
                            </div>

                            <div class="form-group">
                                <label>Ghi chú</label>
                                <textarea class="form-control" name="notes" rows="3" placeholder="Ghi chú đặc biệt (nếu có)"></textarea>
                            </div>

                            <div class="price_summary mb-3">
                                <h5>Tổng chi phí dự tính</h5>
                                <h3 id="estimated_price">0 VNĐ</h3>
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
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Booking Section -->

    <!-- Parking Lot Card Template (Hidden) -->
    <template id="parkingLotCardTemplate">
        <div class="parking_lot_card mb-3">
            <div class="row">
                <div class="col-md-4">
                    <img src="" class="parking_lot_image" alt="Parking Lot">
                </div>
                <div class="col-md-8">
                    <div class="parking_lot_info">
                        <h5 class="parking_lot_name"></h5>
                        <p class="parking_lot_address">
                            <i class="fa fa-map-marker"></i> <span class="address"></span>
                        </p>
                        <div class="parking_lot_details">
                            <span class="badge badge-info capacity">
                                <i class="fa fa-car"></i> <span class="available"></span>/<span class="total"></span>
                            </span>
                            <span class="badge badge-warning rating ml-2">
                                <i class="fa fa-star"></i> <span class="rate"></span>
                            </span>
                        </div>
                        <div class="parking_lot_price mt-2">
                            <strong class="price_text"></strong>
                        </div>
                        <div class="parking_lot_actions mt-2">
                            <button class="btn btn-sm btn-primary view_details">
                                <i class="fa fa-eye"></i> Chi tiết
                            </button>
                            <button class="btn btn-sm btn_box select_parking">
                                <i class="fa fa-check"></i> Chọn bãi đỗ này
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>

    <!-- Custom Styles for Booking Page -->
    <style>
        .search_filter_card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }

        .search_filter_card label {
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
        }

        .parking_lot_card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.08);
            transition: transform 0.3s;
        }

        .parking_lot_card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 25px rgba(0,0,0,0.15);
        }

        .parking_lot_image {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
        }

        .parking_lot_name {
            color: #ffbe33;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .parking_lot_address {
            color: #666;
            margin-bottom: 10px;
        }

        .booking_form_container {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            position: sticky;
            top: 20px;
        }

        .price_summary {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
        }

        .price_summary h3 {
            color: #ffbe33;
            font-weight: 700;
        }
    </style>

    <!-- JavaScript for Booking Functionality -->
    <script>
        let parkingLots = [];
        let currentPage = 1;
        const itemsPerPage = 5;

        // Load parking lots on page load
        document.addEventListener('DOMContentLoaded', function() {
            loadParkingLots();
        });

        function loadParkingLots() {
            // Simulated data - replace with actual API call
            parkingLots = [
                {
                    id: 1,
                    name: 'Bãi đỗ xe Vincom',
                    address: '72 Lê Thánh Tôn, Quận 1, TP.HCM',
                    available_spaces: 45,
                    total_spaces: 100,
                    hourly_rate: 15000,
                    rating: 4.5,
                    image: '{{ asset("user/images/parking1.jpg") }}'
                },
                {
                    id: 2,
                    name: 'Bãi đỗ xe Big C',
                    address: '232 Nguyễn Đình Chiểu, Quận 3, TP.HCM',
                    available_spaces: 20,
                    total_spaces: 80,
                    hourly_rate: 12000,
                    rating: 4.2,
                    image: '{{ asset("user/images/parking2.jpg") }}'
                },
                {
                    id: 3,
                    name: 'Bãi đỗ xe Lotte',
                    address: '20 Trần Phú, Quận 5, TP.HCM',
                    available_spaces: 60,
                    total_spaces: 150,
                    hourly_rate: 18000,
                    rating: 4.7,
                    image: '{{ asset("user/images/parking3.jpg") }}'
                }
            ];

            displayParkingLots();
        }

        function displayParkingLots() {
            const container = document.getElementById('parkingLotsList');
            const template = document.getElementById('parkingLotCardTemplate');

            container.innerHTML = '';

            if (parkingLots.length === 0) {
                container.innerHTML = '<div class="text-center py-5"><i class="fa fa-exclamation-circle fa-3x text-muted"></i><p class="mt-3">Không tìm thấy bãi đỗ xe phù hợp</p></div>';
                return;
            }

            parkingLots.forEach(lot => {
                const card = template.content.cloneNode(true);

                card.querySelector('.parking_lot_image').src = lot.image;
                card.querySelector('.parking_lot_name').textContent = lot.name;
                card.querySelector('.address').textContent = lot.address;
                card.querySelector('.available').textContent = lot.available_spaces;
                card.querySelector('.total').textContent = lot.total_spaces;
                card.querySelector('.rate').textContent = lot.rating;
                card.querySelector('.price_text').textContent = lot.hourly_rate.toLocaleString('vi-VN') + 'đ/giờ';

                card.querySelector('.select_parking').onclick = () => selectParkingLot(lot);
                card.querySelector('.view_details').onclick = () => viewDetails(lot.id);

                container.appendChild(card);
            });

            document.getElementById('resultCount').textContent = `(${parkingLots.length} kết quả)`;
        }

        function selectParkingLot(lot) {
            document.getElementById('bookingFormContainer').style.display = 'block';
            document.getElementById('selected_parking_lot_id').value = lot.id;
            document.getElementById('selected_parking_name').value = lot.name;

            // Scroll to form
            document.getElementById('bookingFormContainer').scrollIntoView({ behavior: 'smooth' });
        }

        function viewDetails(lotId) {
            window.location.href = `/user/parking-lot/${lotId}`;
        }

        function searchParkingLots() {
            // Implement search functionality
            alert('Chức năng tìm kiếm đang được phát triển');
        }

        function resetFilters() {
            document.getElementById('searchFilterForm').reset();
            loadParkingLots();
        }
    </script>

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

</body>

</html>
