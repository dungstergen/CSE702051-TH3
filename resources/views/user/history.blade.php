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
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/dashboard') }}">Bảng điều khiển</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/booking') }}">Đặt chỗ</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="{{ url('/dashboard') }}">Lịch sử<span
                                        class="sr-only">(current)</span> </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.reviews') }}">Đánh giá</a>
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

    <!-- History Section -->
    <section class="history_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>Lịch sử đặt chỗ</h2>
                <p>Xem và quản lý các lần đỗ xe của bạn</p>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="history_table_container">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fa fa-check-circle mr-2"></i>{{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fa fa-exclamation-triangle mr-2"></i>{{ session('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-hover" id="historyTable">
                                <thead>
                                    <tr>
                                        <th>Mã đặt chỗ</th>
                                        <th>Bãi đỗ xe</th>
                                        <th>Thời gian</th>
                                        <th>Biển số xe</th>
                                        <th>Tổng phí</th>
                                        <th>Trạng thái</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody id="historyTableBody">
                                    @forelse($bookings as $booking)
                                    <tr>
                                        <td><strong>{{ $booking->booking_code }}</strong></td>
                                        <td>
                                            <strong>{{ $booking->parkingLot->name ?? '' }}</strong><br>
                                            <small class="text-muted">{{ $booking->parkingLot->address ?? '' }}</small>
                                        </td>
                                        <td>
                                            <div><i class="fa fa-calendar"></i> {{ $booking->start_time->format('d/m/Y H:i') }}</div>
                                            <div><i class="fa fa-calendar"></i> {{ $booking->end_time->format('d/m/Y H:i') }}</div>
                                        </td>
                                        <td>{{ $booking->license_plate }}</td>
                                        <td><strong>{{ number_format($booking->total_cost, 0, ',', '.') }}đ</strong></td>
                                        <td>
                                            @if($booking->status === 'completed')
                                                <span class="status-badge status-completed"><i class="fa fa-check-circle"></i>Đã hoàn thành</span>
                                            @elseif($booking->status === 'cancelled')
                                                <span class="status-badge status-cancelled"><i class="fa fa-times-circle"></i>Đã hủy</span>
                                            @elseif($booking->status === 'pending')
                                                <span class="status-badge status-pending"><i class="fa fa-clock-o"></i>Chờ xác nhận</span>
                                            @else
                                                <span class="status-badge status-active"><i class="fa fa-play-circle"></i>Đang hoạt động</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="action-buttons">
                                                <a href="{{ route('user.booking.show', $booking->id) }}" class="btn btn-sm btn-info">
                                                    <i class="fa fa-eye"></i> Chi tiết
                                                </a>

                                                @if($booking->status !== 'cancelled' && $booking->payment_status !== 'completed')
                                                    <a href="{{ route('user.payment', ['booking_id' => $booking->id]) }}" class="btn btn-sm btn-success">
                                                        <i class="fa fa-credit-card"></i> Thanh toán
                                                    </a>
                                                @endif

                                                @if(method_exists($booking, 'canBeCancelled') ? $booking->canBeCancelled() : in_array($booking->status, ['pending','confirmed']))
                                                    <form action="{{ route('user.booking.cancel', $booking->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn hủy đặt chỗ này?');">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <i class="fa fa-times"></i> Hủy
                                                        </button>
                                                    </form>
                                                @endif

                                                @if($booking->status === 'completed' && empty($booking->review))
                                                    <a href="{{ route('user.reviews') }}" class="btn btn-sm btn-warning">
                                                        <i class="fa fa-star"></i> Đánh giá
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-5">
                                            <i class="fa fa-exclamation-circle fa-2x text-muted"></i>
                                            <p class="mt-3">Không có dữ liệu</p>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            @if(method_exists($bookings, 'links'))
                                <div class="d-flex justify-content-center mt-3">
                                    {{ $bookings->onEachSide(1)->links('pagination::bootstrap-4') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End History Section -->

    <!-- Booking Detail Modal -->
    <div class="modal fade" id="bookingDetailModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Chi tiết đặt chỗ</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="bookingDetailContent">
                    <!-- Content will be loaded dynamically -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-danger" id="cancelBookingBtn" style="display: none;">
                        <i class="fa fa-times"></i> Hủy đặt chỗ
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom Styles for History Page -->
    <style>
        .stat_card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.08);
            text-align: center;
            transition: transform 0.3s;
        }

        .stat_card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 25px rgba(0,0,0,0.15);
        }

        .stat_icon {
            font-size: 40px;
            color: #ffbe33;
            margin-bottom: 15px;
        }

        .stat_content h4 {
            font-size: 32px;
            font-weight: 700;
            color: #252525;
            margin-bottom: 5px;
        }

        .stat_content p {
            color: #666;
            margin: 0;
        }

        .filter_section {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.08);
        }

        .filter_section label {
            font-weight: 600;
            margin-bottom: 5px;
            display: block;
        }

        .history_table_container {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.08);
        }

        .table thead th {
            background: #ffbe33;
            color: white;
            border: none;
            font-weight: 600;
            padding: 15px;
        }

        .table tbody td {
            padding: 15px;
            vertical-align: middle;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 999px;
            font-size: 12.5px;
            font-weight: 600;
            letter-spacing: .2px;
            border: 1px solid transparent;
            background: #f8f9fa;
            color: #333;
            box-shadow: 0 1px 2px rgba(0,0,0,0.04);
        }

        .status-badge i {
            font-size: 14px;
            line-height: 1;
        }

        .status-completed {
            color: #1e7e34;
            background: rgba(40, 167, 69, 0.12);
            border-color: rgba(40, 167, 69, 0.28);
        }

        .status-active {
            color: #0b5ed7;
            background: rgba(13, 110, 253, 0.12);
            border-color: rgba(13, 110, 253, 0.28);
        }

        .status-cancelled {
            color: #a52834;
            background: rgba(220, 53, 69, 0.12);
            border-color: rgba(220, 53, 69, 0.28);
        }

        .status-pending {
            color: #946200;
            background: rgba(255, 193, 7, 0.16);
            border-color: rgba(255, 193, 7, 0.32);
        }

        .action-buttons {
            display: flex;
            gap: 5px;
        }

        .action-buttons .btn {
            padding: 5px 10px;
            font-size: 13px;
        }
    </style>

    <!-- Client-side history fetch removed: rely on server-rendered rows and pagination -->

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
    <!-- history js -->
    <script src="{{ asset('user/js/history.js') }}"></script>

</body>

</html>
