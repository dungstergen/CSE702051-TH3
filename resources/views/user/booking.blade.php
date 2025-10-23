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
    <section class="booking_list_section">
        <div class="container-fluid">
            <div class="row">
                <!-- Left Sidebar - Filters -->
                <div class="col-lg-3">
                    <div class="filter_sidebar">
                        <!-- Location Filter -->
                        <div class="filter_box">
                            <h3 class="filter_title">
                                <i class="fa fa-filter"></i> BỘ LỌC
                            </h3>

                            <div class="filter_section">
                                <h4>Địa điểm</h4>
                                <input type="text" id="filter_location" class="filter_input" placeholder="Nhập địa điểm...">
                            </div>

                            <div class="filter_section">
                                <h4>Loại xe</h4>
                                <select id="filter_vehicle_type" class="filter_input">
                                    <option value="">Tất cả</option>
                                    <option value="car">Ô tô</option>
                                    <option value="motorbike">Xe máy</option>
                                    <option value="truck">Xe tải</option>
                                    <option value="other">Khác</option>
                                </select>
                            </div>

                            <div class="filter_section">
                                <h4>Khoảng giá (VNĐ/giờ)</h4>
                                <div class="price_range_filter">
                                    <input type="number" id="filter_price_min" class="filter_input" placeholder="Từ" min="0">
                                    <span class="range_separator">-</span>
                                    <input type="number" id="filter_price_max" class="filter_input" placeholder="Đến" min="0">
                                </div>
                            </div>

                            <div class="filter_section">
                                <button type="button" class="btn btn-primary btn-block" onclick="applyFilters()">
                                    <i class="fa fa-search"></i> Áp dụng
                                </button>
                                <button type="button" class="btn btn-secondary btn-block mt-2" onclick="clearFilters()">
                                    <i class="fa fa-refresh"></i> Xóa lọc
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Content - Parking Lots List -->
                <div class="col-lg-9">
                    <div class="booking_content">
                        <!-- Header Title -->
                        <div class="booking_header">
                            <h2>Danh Sách Bãi Đỗ Xe</h2>
                            <p class="text-muted">Tìm thấy <span id="total_lots">{{ count($parkingLots) }}</span> bãi đỗ xe</p>
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <!-- Parking Lots List -->
                        <div class="parking_lots_list" id="parking_lots_container">
                            @forelse($parkingLots as $lot)
                            <div class="parking_lot_card"
                                data-location="{{ strtolower($lot->address) }}"
                                data-price="{{ $lot->hourly_rate }}"
                                data-rating="{{ $lot->average_rating ?? 0 }}">
                                <div class="parking_card_image">
                                    <img src="{{ asset('user/images/c' . (($loop->index % 3) + 1) . '.jpg') }}" alt="{{ $lot->name }}">
                                    <div class="parking_card_name">
                                        <strong>{{ $lot->name }}</strong>
                                    </div>
                                </div>
                                <div class="parking_card_details">
                                    <h4 class="parking_title">{{ $lot->name }}</h4>
                                    <div class="parking_info_row">
                                        <i class="fa fa-map-marker text-danger"></i>
                                        <span>{{ $lot->address }}</span>
                                    </div>
                                    <div class="parking_info_row">
                                        <i class="fa fa-car text-primary"></i>
                                        <span>Chỗ trống: {{ $lot->available_spots }}/{{ $lot->total_spots }}</span>
                                    </div>
                                    <div class="parking_meta">
                                        @if($lot->hourly_rate < 15000)
                                            <span class="badge badge-danger">
                                                <i class="fa fa-fire"></i> Giá rẻ
                                            </span>
                                        @endif
                                        <span class="parking_rating">
                                            <i class="fa fa-star text-warning"></i>
                                            {{ number_format($lot->average_rating ?? 0, 1) }}
                                            <small class="text-muted">({{ $lot->reviews_count ?? 0 }} đánh giá)</small>
                                        </span>
                                    </div>
                                </div>
                                <div class="parking_card_action">
                                    <div class="parking_price_display">
                                        <h3 class="price_number">{{ number_format($lot->hourly_rate) }}₫</h3>
                                        <span class="price_unit">/giờ</span>
                                    </div>
                                    <button class="btn_book_now" onclick="openSpotSelectionModal({{ $lot->id }}, '{{ $lot->name }}', '{{ $lot->address }}', {{ $lot->hourly_rate }})">
                                        Đặt chỗ
                                    </button>
                                </div>
                            </div>
                            @empty
                            <div class="text-center py-5">
                                <i class="fa fa-car fa-4x text-muted mb-3"></i>
                                <h4>Không tìm thấy bãi đỗ xe nào</h4>
                                <p class="text-muted">Vui lòng thử lại với điều kiện khác</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Booking Section -->

    <!-- Spot Selection Modal -->
    <div class="modal fade" id="spotSelectionModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <h5 class="modal-title">Chọn vị trí đỗ xe</h5>
                        <p class="text-muted mb-0">
                            <strong id="spot_modal_parking_name"></strong> -
                            <small id="spot_modal_parking_address"></small>
                        </p>
                    </div>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="spot_modal_parking_lot_id">
                    <input type="hidden" id="spot_modal_hourly_rate">

                    <div class="alert alert-info mb-3">
                        <i class="fa fa-info-circle"></i>
                        <strong>Chú thích:</strong>
                        <span class="ml-3"><span class="spot-legend available"></span> Trống</span>
                        <span class="ml-3"><span class="spot-legend occupied"></span> Đã đặt</span>
                        <span class="ml-3"><span class="spot-legend selected"></span> Đang chọn</span>
                    </div>

                    <!-- Parking Spots Grid -->
                    <div id="parking_spots_container" class="parking-spots-grid">
                        <div class="text-center py-5">
                            <i class="fa fa-spinner fa-spin fa-3x text-muted"></i>
                            <p class="mt-3">Đang tải sơ đồ vị trí...</p>
                        </div>
                    </div>

                    <!-- Selected Spot Info -->
                    <div class="selected-spot-info mt-3">
                        <strong>Vị trí đã chọn:</strong>
                        <span id="selected_spot_display" class="text-muted">Chưa chọn vị trí nào</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-primary" onclick="proceedToBooking()">
                        <i class="fa fa-arrow-right"></i> Tiếp tục đặt chỗ
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Booking Modal -->
    <div class="modal fade" id="bookingModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Đặt chỗ đỗ xe</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form action="{{ route('user.booking.store') }}" method="POST" id="bookingForm">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="parking_lot_id" id="modal_parking_lot_id">
                        <input type="hidden" name="parking_spot_id" id="modal_parking_spot_id">

                        <div class="alert alert-info">
                            <strong>Bãi đỗ:</strong> <span id="modal_parking_name"></span><br>
                            <strong>Vị trí:</strong> <span id="modal_parking_spot_code"></span><br>
                            <strong>Giá:</strong> <span id="modal_parking_price"></span>₫/giờ
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Ngày đặt <span class="text-danger">*</span></label>
                                    <input type="date" name="booking_date" class="form-control" required min="{{ date('Y-m-d') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Số điện thoại <span class="text-danger">*</span></label>
                                    <input type="text" name="phone_number" class="form-control" placeholder="0123456789" required
                                           value="{{ Auth::check() ? Auth::user()->phone : '' }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Giờ bắt đầu <span class="text-danger">*</span></label>
                                    <input type="datetime-local" name="start_time" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Giờ kết thúc <span class="text-danger">*</span></label>
                                    <input type="datetime-local" name="end_time" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Biển số xe <span class="text-danger">*</span></label>
                                    <input type="text" name="license_plate" class="form-control" placeholder="VD: 51A-12345" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label style="display: block"> Loại xe</label>
                                    <select name="vehicle_type" class="form-control">
                                        <option value="">-- Chọn loại xe --</option>
                                        <option value="car">Ô tô</option>
                                        <option value="motorbike">Xe máy</option>
                                        <option value="truck">Xe tải</option>
                                        <option value="other">Khác</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        @if(count($servicePackages) > 0)
                        <div class="form-group">
                            <label>Gói dịch vụ (tùy chọn)</label>
                            <select name="service_package_id" class="form-control">
                                <option value="">-- Không chọn gói --</option>
                                @foreach($servicePackages as $package)
                                <option value="{{ $package->id }}" data-price="{{ $package->price }}">
                                    {{ $package->name }} - {{ number_format($package->price) }}₫ ({{ $package->duration_hours }} giờ)
                                </option>
                                @endforeach
                            </select>
                        </div>
                        @endif

                        <div class="form-group">
                            <label>Yêu cầu đặc biệt</label>
                            <textarea name="special_requests" class="form-control" rows="3" placeholder="Ghi chú thêm (nếu có)..."></textarea>
                        </div>

                        <div class="alert alert-warning">
                            <i class="fa fa-info-circle"></i>
                            Sau khi đặt chỗ thành công, bạn cần thanh toán để xác nhận đơn hàng.
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="backToSpotSelection()">
                            <i class="fa fa-arrow-left"></i> Quay lại
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-check"></i> Xác nhận đặt chỗ
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
        /* Parking Lots List Container */
        .parking_lots_list {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        /* Parking Card - Horizontal Layout like in image */
        .parking_lot_card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            border: 1px solid #f0f0f0;
        }

        .parking_lot_card:hover {
            box-shadow: 0 4px 20px rgba(0,0,0,0.12);
            transform: translateY(-2px);
        }

        /* Left Section - Image and Name */
        .parking_card_image {
            flex-shrink: 0;
            width: 140px;
            text-align: center;
        }

        .parking_card_image img {
            width: 100px;
            height: 100px;
            border-radius: 10px;
            object-fit: cover;
            margin-bottom: 10px;
            border: 2px solid #f0f0f0;
        }

        .parking_card_name {
            font-size: 14px;
            color: #333;
        }

        .parking_card_name strong {
            display: block;
            font-weight: 600;
        }

        /* Middle Section - Details */
        .parking_card_details {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .parking_title {
            font-size: 20px;
            font-weight: 700;
            color: #333;
            margin: 0 0 5px 0;
        }

        .parking_info_row {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            color: #666;
        }

        .parking_info_row i {
            width: 18px;
            font-size: 14px;
        }

        .parking_meta {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: 5px;
        }

        .parking_meta .badge {
            padding: 4px 10px;
            font-size: 12px;
            font-weight: 600;
        }

        .parking_rating {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 14px;
            font-weight: 600;
            color: #333;
        }

        .parking_rating i {
            color: #ffc107;
            font-size: 16px;
        }

        .parking_rating small {
            font-weight: 400;
        }

        /* Right Section - Price and Button */
        .parking_card_action {
            flex-shrink: 0;
            text-align: right;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 15px;
            min-width: 150px;
        }

        .parking_price_display {
            display: flex;
            align-items: baseline;
            gap: 3px;
        }

        .price_number {
            font-size: 28px;
            font-weight: 700;
            color: #ff6b35;
            margin: 0;
            line-height: 1;
        }

        .price_unit {
            font-size: 14px;
            color: #666;
            font-weight: 500;
        }

        .btn_book_now {
            background: linear-gradient(135deg, #ffc107 0%, #ffb300 100%);
            color: white;
            border: none;
            padding: 12px 35px;
            border-radius: 25px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(255, 193, 7, 0.3);
            white-space: nowrap;
        }

        .btn_book_now:hover {
            background: linear-gradient(135deg, #ffb300 0%, #ffa000 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 193, 7, 0.4);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .parking_lot_card {
                flex-direction: column;
                text-align: center;
            }

            .parking_card_image {
                width: 100%;
            }

            .parking_card_details {
                align-items: center;
                text-align: center;
            }

            .parking_card_action {
                align-items: center;
                width: 100%;
            }

            .parking_price_display {
                justify-content: center;
            }
        }

        /* Filter Section Styles */
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

        /* Parking Level Container */
        .parking-level-container {
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .parking-level-title {
            background: linear-gradient(135deg, #6c5b7b 0%, #8b7a9e 100%);
            color: white;
            padding: 12px 30px;
            border-radius: 50px;
            font-size: 18px;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 20px;
            box-shadow: 0 4px 10px rgba(108, 91, 123, 0.3);
        }

        /* Sections Grid - Horizontal layout */
        .parking-sections-grid {
            display: flex;
            gap: 30px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .parking-section {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .parking-section-spots {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            gap: 10px;
            max-width: 800px;
        }

        /* Parking Spot Style */
        .parking-spot {
            width: 100px;
            height: 50px;
            border: 2px solid #ddd;
            border-radius: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background: #b3d4f5;
            position: relative;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .parking-spot:hover:not(.occupied) {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }

        .parking-spot.available {
            background: #b3d4f5;
            border-color: #7cb3e6;
        }

        .parking-spot.available:hover {
            background: #9ec8f0;
        }

        .parking-spot.occupied {
            background: #f5b3c4;
            border-color: #e67c98;
            cursor: not-allowed;
        }

        .parking-spot.selected {
            background: #b8e6b8;
            border-color: #5cb85c;
            border-width: 3px;
            box-shadow: 0 0 0 3px rgba(92, 184, 92, 0.3);
        }

        .parking-spot .spot-code {
            font-weight: 600;
            font-size: 15px;
            color: #333;
            text-align: center;
        }

        .spot-legend {
            display: inline-block;
            width: 30px;
            height: 20px;
            border-radius: 10px;
            border: 2px solid;
            vertical-align: middle;
        }

        .spot-legend.available {
            background: #b3d4f5;
            border-color: #7cb3e6;
        }

        .spot-legend.occupied {
            background: #f5b3c4;
            border-color: #e67c98;
        }

        .spot-legend.selected {
            background: #b8e6b8;
            border-color: #5cb85c;
        }

        .selected-spot-info {
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
            border-left: 4px solid #ffc107;
        }

        .selected-spot-info strong {
            color: #333;
        }

        #selected_spot_display {
            font-size: 16px;
            font-weight: 600;
            color: #ffc107 !important;
        }

        /* Modal XL for spot selection */
        .modal-xl {
            max-width: 1200px;
        }

        /* Parking spots container wrapper */
        #parking_spots_container {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            min-height: 400px;
            max-height: 600px;
            overflow-y: auto;
        }

        /* Responsive for parking layout */
        @media (max-width: 992px) {
            .parking-sections-grid {
                gap: 20px;
            }

            .parking-spot {
                width: 90px;
                height: 45px;
            }
        }

        @media (max-width: 768px) {
            .parking-sections-grid {
                flex-direction: column;
                align-items: center;
                gap: 20px;
            }

            .parking-spot {
                width: 80px;
                height: 40px;
                font-size: 13px;
            }

            .parking-level-title {
                font-size: 16px;
                padding: 10px 25px;
            }
        }

        @media (max-width: 576px) {
            .parking-spot {
                width: 70px;
                height: 35px;
                font-size: 12px;
            }
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

        async function loadParkingLots() {
            try {
                // Gọi API để lấy dữ liệu thực từ database
                const response = await fetch('/user/api/parking-lots');

                if (!response.ok) {
                    throw new Error('Failed to load parking lots');
                }

                parkingLots = await response.json();
                displayParkingLots();
            } catch (error) {
                console.error('Error loading parking lots:', error);
                // Hiển thị thông báo lỗi cho user
                const container = document.getElementById('parkingLotsList');
                container.innerHTML = `
                    <div class="text-center py-5">
                        <i class="fa fa-exclamation-triangle fa-3x text-danger"></i>
                        <p class="mt-3 text-danger">Không thể tải danh sách bãi đỗ xe. Vui lòng thử lại sau!</p>
                        <button class="btn btn-primary mt-2" onclick="loadParkingLots()">Thử lại</button>
                    </div>
                `;
            }
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

        // Seat Selection Modal Functions
        function openSeatModal(parkingName, parkingAddress, price) {
            const modal = document.getElementById('seatSelectionModal');
            document.getElementById('modalParkingName').textContent = parkingName;
            document.getElementById('modalParkingAddress').textContent = parkingAddress;
            document.getElementById('selectedSpotPrice').textContent = price;
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeSeatModal() {
            const modal = document.getElementById('seatSelectionModal');
            modal.classList.remove('active');
            document.body.style.overflow = 'auto';
            // Reset selected spots
            document.querySelectorAll('.parking_spot.selected').forEach(spot => {
                spot.classList.remove('selected');
            });
            document.getElementById('selectedSpotName').textContent = 'Chưa chọn';
        }

        // Handle spot selection
        document.addEventListener('DOMContentLoaded', function() {
            // Add click event to all book buttons
            document.querySelectorAll('.btn_book_parking').forEach(button => {
                button.addEventListener('click', function() {
                    const item = this.closest('.parking_lot_item');
                    const parkingName = item.querySelector('.parking_details h4').textContent;
                    const parkingAddress = item.querySelector('.parking_details p').textContent.trim();
                    const price = item.querySelector('.price_amount').textContent;
                    openSeatModal(parkingName, parkingAddress, price);
                });
            });

            // Handle parking spot click
            document.querySelectorAll('.parking_spot').forEach(spot => {
                spot.addEventListener('click', function() {
                    if (this.classList.contains('occupied')) {
                        alert('Vị trí này đã được đặt!');
                        return;
                    }

                    // Remove previous selection
                    document.querySelectorAll('.parking_spot.selected').forEach(s => {
                        s.classList.remove('selected');
                    });

                    // Select new spot
                    this.classList.add('selected');
                    document.getElementById('selectedSpotName').textContent = this.dataset.spot;
                });
            });
        });

        function confirmBooking() {
            const selectedSpot = document.querySelector('.parking_spot.selected');
            if (!selectedSpot) {
                alert('Vui lòng chọn vị trí đỗ xe!');
                return;
            }

            const spotName = selectedSpot.dataset.spot;
            alert(`Đặt chỗ thành công!\nVị trí: ${spotName}\nBãi đỗ: ${document.getElementById('modalParkingName').textContent}`);
            closeSeatModal();

            // TODO: Send booking to backend
        }

        // New functions for 2-step process
        function goToPaymentStep() {
            const selectedSpot = document.querySelector('.parking_spot.selected');
            if (!selectedSpot) {
                alert('Vui lòng chọn vị trí đỗ xe!');
                return;
            }

            // Update summary
            document.getElementById('summaryParkingName').textContent = document.getElementById('modalParkingName').textContent;
            document.getElementById('summarySpotName').textContent = selectedSpot.dataset.spot;

            // Hide step 1, show step 2
            document.getElementById('step1Content').style.display = 'none';
            document.getElementById('step2Content').style.display = 'block';

            // Update step indicators
            document.getElementById('step1Indicator').classList.remove('active');
            document.getElementById('step1Indicator').classList.add('completed');
            document.getElementById('step2Indicator').classList.add('active');

            // Update title
            document.getElementById('modalTitle').textContent = 'Thanh toán';
        }

        function backToSpotSelection() {
            // Show step 1, hide step 2
            document.getElementById('step1Content').style.display = 'block';
            document.getElementById('step2Content').style.display = 'none';

            // Update step indicators
            document.getElementById('step1Indicator').classList.add('active');
            document.getElementById('step1Indicator').classList.remove('completed');
            document.getElementById('step2Indicator').classList.remove('active');

            // Update title
            document.getElementById('modalTitle').textContent = 'Chọn vị trí đỗ xe';
        }

        function selectPaymentInModal(method) {
            document.querySelectorAll('.payment_method_card').forEach(card => {
                card.classList.remove('selected');
            });
            event.target.closest('.payment_method_card').classList.add('selected');
        }

        function confirmPayment() {
            const paymentMethod = document.querySelector('input[name="payment_method"]:checked');
            if (!paymentMethod) {
                alert('Vui lòng chọn phương thức thanh toán!');
                return;
            }

            const spotName = document.getElementById('summarySpotName').textContent;
            const parkingName = document.getElementById('summaryParkingName').textContent;
            const paymentLabel = paymentMethod.nextElementSibling.querySelector('span').textContent;

            alert(`Đặt chỗ thành công!\nBãi đỗ: ${parkingName}\nVị trí: ${spotName}\nPTTT: ${paymentLabel}`);

            closeSeatModal();

            // TODO: Send booking + payment to backend
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

    <!-- Booking Page JavaScript -->
    <script>
        let selectedSpotId = null;
        let selectedSpotCode = null;
        let currentParkingLotId = null;
        let currentHourlyRate = null;

        // Open spot selection modal
        function openSpotSelectionModal(lotId, lotName, lotAddress, hourlyRate) {
            @guest
                alert('Vui lòng đăng nhập để đặt chỗ!');
                window.location.href = '{{ route("login") }}';
                return;
            @endguest

            currentParkingLotId = lotId;
            currentHourlyRate = hourlyRate;

            document.getElementById('spot_modal_parking_lot_id').value = lotId;
            document.getElementById('spot_modal_parking_name').textContent = lotName;
            document.getElementById('spot_modal_parking_address').textContent = lotAddress;
            document.getElementById('spot_modal_hourly_rate').value = hourlyRate;

            // Reset selection
            selectedSpotId = null;
            selectedSpotCode = null;
            document.getElementById('selected_spot_display').textContent = 'Chưa chọn vị trí nào';
            document.getElementById('selected_spot_display').className = 'text-muted';

            $('#spotSelectionModal').modal('show');

            // Load parking spots
            loadParkingSpots();
        }

        // Load parking spots from API
        async function loadParkingSpots() {
            const lotId = document.getElementById('spot_modal_parking_lot_id').value;

            const container = document.getElementById('parking_spots_container');
            container.innerHTML = '<div class="text-center py-5"><i class="fa fa-spinner fa-spin fa-3x text-muted"></i><p class="mt-3">Đang tải sơ đồ vị trí...</p></div>';

            try {
                const response = await fetch(`/user/api/parking-lot/${lotId}/spots`);

                if (!response.ok) {
                    throw new Error('Failed to load parking spots');
                }

                const data = await response.json();
                displayParkingSpots(data.spots);
            } catch (error) {
                console.error('Error loading parking spots:', error);
                container.innerHTML = '<div class="text-center py-5 text-danger"><i class="fa fa-exclamation-triangle fa-3x"></i><p class="mt-3">Không thể tải sơ đồ vị trí. Vui lòng thử lại!</p></div>';
            }
        }

        // Display parking spots grid
        function displayParkingSpots(spots) {
            const container = document.getElementById('parking_spots_container');

            if (!spots || spots.length === 0) {
                container.innerHTML = '<div class="text-center py-5"><i class="fa fa-info-circle fa-3x text-muted"></i><p class="mt-3">Không có vị trí đỗ xe nào</p></div>';
                return;
            }

            container.innerHTML = '';

            // Group by level first
            const spotsByLevel = {};
            spots.forEach(spot => {
                const level = spot.level || 'Tầng 1';
                if (!spotsByLevel[level]) {
                    spotsByLevel[level] = [];
                }
                spotsByLevel[level].push(spot);
            });

            // Display each level
            Object.keys(spotsByLevel).sort().forEach(levelName => {
                // Level container
                const levelContainer = document.createElement('div');
                levelContainer.className = 'parking-level-container mb-4';

                // Level title
                const levelTitle = document.createElement('div');
                levelTitle.className = 'parking-level-title';
                levelTitle.textContent = levelName;
                levelContainer.appendChild(levelTitle);

                // Group spots by section (first letter of spot_code)
                const spotsBySection = {};
                spotsByLevel[levelName].forEach(spot => {
                    const section = spot.spot_code.charAt(0); // Get first letter (A, B, C, etc)
                    if (!spotsBySection[section]) {
                        spotsBySection[section] = [];
                    }
                    spotsBySection[section].push(spot);
                });

                // Sections grid
                const sectionsGrid = document.createElement('div');
                sectionsGrid.className = 'parking-sections-grid';

                // Display each section
                Object.keys(spotsBySection).sort().forEach(sectionName => {
                    const sectionContainer = document.createElement('div');
                    sectionContainer.className = 'parking-section';

                    // Section spots grid
                    const sectionSpots = document.createElement('div');
                    sectionSpots.className = 'parking-section-spots';

                    // Sort spots by number
                    spotsBySection[sectionName].sort((a, b) => {
                        const numA = parseInt(a.spot_code.substring(1));
                        const numB = parseInt(b.spot_code.substring(1));
                        return numA - numB;
                    });

                    spotsBySection[sectionName].forEach(spot => {
                        const spotDiv = document.createElement('div');
                        spotDiv.className = `parking-spot ${spot.is_available ? 'available' : 'occupied'}`;
                        spotDiv.dataset.spotId = spot.id;
                        spotDiv.dataset.spotCode = spot.spot_code;

                        spotDiv.innerHTML = `
                            <div class="spot-code">${spot.spot_code}</div>
                        `;

                        if (spot.is_available) {
                            spotDiv.onclick = function() {
                                selectSpot(spot.id, spot.spot_code, this);
                            };
                        } else {
                            spotDiv.title = 'Vị trí này đã được đặt';
                        }

                        sectionSpots.appendChild(spotDiv);
                    });

                    sectionContainer.appendChild(sectionSpots);
                    sectionsGrid.appendChild(sectionContainer);
                });

                levelContainer.appendChild(sectionsGrid);
                container.appendChild(levelContainer);
            });
        }

        // Select a parking spot
        function selectSpot(spotId, spotCode, element) {
            // Remove previous selection
            document.querySelectorAll('.parking-spot.selected').forEach(spot => {
                spot.classList.remove('selected');
            });

            // Select new spot
            element.classList.add('selected');
            selectedSpotId = spotId;
            selectedSpotCode = spotCode;

            document.getElementById('selected_spot_display').textContent = spotCode;
            document.getElementById('selected_spot_display').className = 'text-success font-weight-bold';
        }

        // Proceed to booking modal
        function proceedToBooking() {
            if (!selectedSpotId) {
                alert('Vui lòng chọn vị trí đỗ xe!');
                return;
            }

            const lotId = document.getElementById('spot_modal_parking_lot_id').value;
            const lotName = document.getElementById('spot_modal_parking_name').textContent;
            const hourlyRate = document.getElementById('spot_modal_hourly_rate').value;

            // Close spot selection modal
            $('#spotSelectionModal').modal('hide');

            // Open booking modal with pre-filled data
            openBookingModalWithSpot(lotId, lotName, hourlyRate, selectedSpotId, selectedSpotCode);
        }

        // Open booking modal with selected spot
        function openBookingModalWithSpot(lotId, lotName, hourlyRate, spotId, spotCode) {
            document.getElementById('modal_parking_lot_id').value = lotId;
            document.getElementById('modal_parking_spot_id').value = spotId;
            document.getElementById('modal_parking_name').textContent = lotName;
            document.getElementById('modal_parking_spot_code').textContent = spotCode;
            document.getElementById('modal_parking_price').textContent = parseInt(hourlyRate).toLocaleString('vi-VN');

            $('#bookingModal').modal('show');
        }

        // Back to spot selection from booking modal
        function backToSpotSelection() {
            // Close booking modal
            $('#bookingModal').modal('hide');

            // Wait for modal to close, then reopen spot selection modal
            setTimeout(function() {
                $('#spotSelectionModal').modal('show');
            }, 300);
        }

        // Open booking modal (old function - kept for compatibility)
        function openBookingModal(lotId, lotName, hourlyRate) {
            @guest
                alert('Vui lòng đăng nhập để đặt chỗ!');
                window.location.href = '{{ route("login") }}';
                return;
            @endguest

            document.getElementById('modal_parking_lot_id').value = lotId;
            document.getElementById('modal_parking_name').textContent = lotName;
            document.getElementById('modal_parking_price').textContent = hourlyRate.toLocaleString('vi-VN');

            $('#bookingModal').modal('show');
        }

        // Apply filters
        function applyFilters() {
            const location = document.getElementById('filter_location').value.toLowerCase();
            const vehicleType = document.getElementById('filter_vehicle_type').value;
            const priceMin = parseInt(document.getElementById('filter_price_min').value) || 0;
            const priceMax = parseInt(document.getElementById('filter_price_max').value) || Infinity;

            const items = document.querySelectorAll('.parking_lot_card[data-location]');
            let visibleCount = 0;

            items.forEach(item => {
                const itemLocation = item.getAttribute('data-location');
                const itemPrice = parseInt(item.getAttribute('data-price'));

                const matchLocation = !location || itemLocation.includes(location);
                const matchPrice = itemPrice >= priceMin && itemPrice <= priceMax;

                if (matchLocation && matchPrice) {
                    item.style.display = 'flex';
                    visibleCount++;
                } else {
                    item.style.display = 'none';
                }
            });

            document.getElementById('total_lots').textContent = visibleCount;
        }

        // Clear filters
        function clearFilters() {
            document.getElementById('filter_location').value = '';
            document.getElementById('filter_vehicle_type').value = '';
            document.getElementById('filter_price_min').value = '';
            document.getElementById('filter_price_max').value = '';

            const items = document.querySelectorAll('.parking_lot_card');
            items.forEach(item => {
                item.style.display = 'flex';
            });

            document.getElementById('total_lots').textContent = items.length;
        }

        // Set minimum datetime for booking
        document.addEventListener('DOMContentLoaded', function() {
            const now = new Date();
            now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
            const minDateTime = now.toISOString().slice(0, 16);

            const startTimeInput = document.querySelector('input[name="start_time"]');
            const endTimeInput = document.querySelector('input[name="end_time"]');

            if (startTimeInput) {
                startTimeInput.min = minDateTime;

                // Auto set end time when start time changes
                startTimeInput.addEventListener('change', function() {
                    const startTime = new Date(this.value);
                    startTime.setHours(startTime.getHours() + 1);
                    endTimeInput.min = startTime.toISOString().slice(0, 16);

                    // Auto-fill end time (1 hour after start)
                    if (!endTimeInput.value || new Date(endTimeInput.value) <= new Date(this.value)) {
                        endTimeInput.value = startTime.toISOString().slice(0, 16);
                    }
                });
            }
        });

    </script>

</body>

</html>
