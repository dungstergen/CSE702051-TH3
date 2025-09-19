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
    <!-- history page style -->
    <link href="{{ asset('user/css/history.css') }}" rel="stylesheet" />
    <!-- history style -->
    <link href="{{ asset('user/css/history.css') }}" rel="stylesheet" />

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
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/booking') }}">Đặt chỗ</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="{{ url('/history') }}">Lịch sử <span class="sr-only">(current)</span></a>
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

    <!-- History section -->
    <section class="history_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>
                    Lịch sử đỗ xe
                </h2>
                <p>
                    Xem lại tất cả các lần đỗ xe và quản lý hoạt động của bạn
                </p>
            </div>

            <!-- Filter & Stats Section -->
            <div class="row">
                <div class="col-lg-3">
                    <div class="filter_panel">
                        <h4>Bộ lọc</h4>

                        <!-- Date Range Filter -->
                        <div class="filter_group">
                            <label>Khoảng thời gian</label>
                            <div class="date_range">
                                <input type="date" id="fromDate" class="form-control">
                                <span class="date_separator">đến</span>
                                <input type="date" id="toDate" class="form-control">
                            </div>
                        </div>

                        <!-- Status Filter -->
                        <div class="filter_group">
                            <label>Trạng thái</label>
                            <div class="status_filter">
                                <label class="filter_item">
                                    <input type="checkbox" value="completed" checked>
                                    <span class="checkmark"></span>
                                    Hoàn thành
                                </label>
                                <label class="filter_item">
                                    <input type="checkbox" value="cancelled" checked>
                                    <span class="checkmark"></span>
                                    Đã hủy
                                </label>
                                <label class="filter_item">
                                    <input type="checkbox" value="ongoing" checked>
                                    <span class="checkmark"></span>
                                    Đang diễn ra
                                </label>
                            </div>
                        </div>

                        <!-- Price Range Filter -->
                        <div class="filter_group">
                            <label>Khoảng giá</label>
                            <div class="price_range">
                                <input type="range" id="priceFilter" min="0" max="200000" value="200000" step="10000">
                                <div class="price_display">
                                    <span>0</span>
                                    <span id="maxPrice">200,000</span>
                                </div>
                            </div>
                        </div>

                        <!-- Location Filter -->
                        <div class="filter_group">
                            <label>Địa điểm</label>
                            <select id="locationFilter" class="form-control">
                                <option value="">Tất cả địa điểm</option>
                                <option value="vincom">Vincom Center</option>
                                <option value="bigc">Big C Thăng Long</option>
                                <option value="lotte">Lotte Center</option>
                                <option value="aeon">Aeon Mall</option>
                            </select>
                        </div>

                        <button type="button" class="btn_filter" id="applyFilter">
                            <i class="fa fa-filter"></i>
                            Áp dụng bộ lọc
                        </button>

                        <button type="button" class="btn_reset" id="resetFilter">
                            <i class="fa fa-refresh"></i>
                            Đặt lại
                        </button>
                    </div>

                    <!-- Quick Stats -->
                   
                </div>

                <div class="col-lg-9">
                    <!-- Search & Sort -->
                    <div class="search_sort_bar">
                        <div class="search_box">
                            <i class="fa fa-search"></i>
                            <input type="text" id="searchHistory" placeholder="Tìm kiếm theo địa điểm, mã đặt chỗ...">
                        </div>
                        <div class="sort_box">
                            <select id="sortHistory" class="form-control">
                                <option value="date_desc">Ngày mới nhất</option>
                                <option value="date_asc">Ngày cũ nhất</option>
                                <option value="price_desc">Giá cao nhất</option>
                                <option value="price_asc">Giá thấp nhất</option>
                                <option value="duration_desc">Thời gian dài nhất</option>
                                <option value="duration_asc">Thời gian ngắn nhất</option>
                            </select>
                        </div>
                        <div class="view_toggle">
                            <button type="button" class="view_btn active" data-view="list">
                                <i class="fa fa-list"></i>
                            </button>
                            <button type="button" class="view_btn" data-view="grid">
                                <i class="fa fa-th"></i>
                            </button>
                        </div>
                    </div>

                    <!-- History Results -->
                    <div class="history_results" id="historyResults">
                        <!-- History Item 1 -->
                        <div class="history_item" data-status="completed" data-price="45000" data-date="2025-09-15">
                            <div class="history_header">
                                <div class="booking_info">
                                    <h5>Bãi đỗ xe Vincom Center</h5>
                                    <span class="booking_code">#BP12345678</span>
                                </div>
                                <div class="status_badge completed">
                                    <i class="fa fa-check-circle"></i>
                                    Hoàn thành
                                </div>
                            </div>
                            <div class="history_content">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="detail_group">
                                            <div class="detail_item">
                                                <i class="fa fa-map-marker"></i>
                                                <span>72 Lê Thánh Tôn, Quận 1, TP.HCM</span>
                                            </div>
                                            <div class="detail_item">
                                                <i class="fa fa-calendar"></i>
                                                <span>15/09/2025</span>
                                            </div>
                                            <div class="detail_item">
                                                <i class="fa fa-clock-o"></i>
                                                <span>14:30 - 17:30 (3 giờ)</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="detail_group">
                                            <div class="detail_item">
                                                <i class="fa fa-car"></i>
                                                <span>Ô tô - 51B-123.45</span>
                                            </div>
                                            <div class="detail_item">
                                                <i class="fa fa-money"></i>
                                                <span>45,000 VNĐ</span>
                                            </div>
                                            <div class="detail_item">
                                                <i class="fa fa-star"></i>
                                                <span>Đã đánh giá: 5 sao</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Customer Review Section -->
                            <div class="customer_review_section">
                                <div class="review_header">
                                    <h6><i class="fa fa-comment-o"></i> Đánh giá của bạn</h6>
                                    <button class="btn_edit_review" data-booking-id="1">
                                        <i class="fa fa-edit"></i> Chỉnh sửa đánh giá
                                    </button>
                                </div>

                                <!-- Existing Review Display -->
                                <div class="existing_review" id="existingReview1">
                                    <div class="rating_display">
                                        <div class="stars">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <span class="rating_text">5.0 - Xuất sắc</span>
                                        <span class="review_date">Đánh giá ngày 15/09/2025</span>
                                    </div>
                                    <div class="review_comment">
                                        <p>"Bãi đỗ xe rất tiện lợi, gần trung tâm thương mại. Nhân viên thân thiện, giá cả hợp lý. Sẽ quay lại sử dụng dịch vụ."</p>
                                    </div>
                                    <div class="review_aspects">
                                        <div class="aspect_item">
                                            <span class="aspect_label">Vị trí:</span>
                                            <div class="aspect_stars">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                        </div>
                                        <div class="aspect_item">
                                            <span class="aspect_label">Dịch vụ:</span>
                                            <div class="aspect_stars">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                        </div>
                                        <div class="aspect_item">
                                            <span class="aspect_label">Giá cả:</span>
                                            <div class="aspect_stars">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                            </div>
                                        </div>
                                        <div class="aspect_item">
                                            <span class="aspect_label">An toàn:</span>
                                            <div class="aspect_stars">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Interactive Review Form -->
                                <div class="review_form" id="reviewForm1" style="display: none;">
                                    <form class="review_form_content">
                                        <!-- Overall Rating -->
                                        <div class="form_group">
                                            <label>Đánh giá tổng thể:</label>
                                            <div class="interactive_stars overall_rating" data-rating="5">
                                                <i class="fa fa-star-o" data-star="1"></i>
                                                <i class="fa fa-star-o" data-star="2"></i>
                                                <i class="fa fa-star-o" data-star="3"></i>
                                                <i class="fa fa-star-o" data-star="4"></i>
                                                <i class="fa fa-star-o" data-star="5"></i>
                                            </div>
                                            <span class="rating_label">Xuất sắc</span>
                                        </div>

                                        <!-- Comment -->
                                        <div class="form_group">
                                            <label>Nhận xét của bạn:</label>
                                            <textarea class="review_textarea" placeholder="Chia sẻ trải nghiệm của bạn về bãi đỗ xe này..." rows="4">Bãi đỗ xe rất tiện lợi, gần trung tâm thương mại. Nhân viên thân thiện, giá cả hợp lý. Sẽ quay lại sử dụng dịch vụ.</textarea>
                                        </div>

                                        <!-- Aspect Ratings -->
                                        <div class="form_group">
                                            <label>Đánh giá chi tiết:</label>
                                            <div class="aspect_ratings">
                                                <div class="aspect_rating_item">
                                                    <span class="aspect_name">Vị trí:</span>
                                                    <div class="interactive_stars aspect_rating" data-aspect="location" data-rating="5">
                                                        <i class="fa fa-star-o" data-star="1"></i>
                                                        <i class="fa fa-star-o" data-star="2"></i>
                                                        <i class="fa fa-star-o" data-star="3"></i>
                                                        <i class="fa fa-star-o" data-star="4"></i>
                                                        <i class="fa fa-star-o" data-star="5"></i>
                                                    </div>
                                                </div>
                                                <div class="aspect_rating_item">
                                                    <span class="aspect_name">Dịch vụ:</span>
                                                    <div class="interactive_stars aspect_rating" data-aspect="service" data-rating="5">
                                                        <i class="fa fa-star-o" data-star="1"></i>
                                                        <i class="fa fa-star-o" data-star="2"></i>
                                                        <i class="fa fa-star-o" data-star="3"></i>
                                                        <i class="fa fa-star-o" data-star="4"></i>
                                                        <i class="fa fa-star-o" data-star="5"></i>
                                                    </div>
                                                </div>
                                                <div class="aspect_rating_item">
                                                    <span class="aspect_name">Giá cả:</span>
                                                    <div class="interactive_stars aspect_rating" data-aspect="price" data-rating="4">
                                                        <i class="fa fa-star-o" data-star="1"></i>
                                                        <i class="fa fa-star-o" data-star="2"></i>
                                                        <i class="fa fa-star-o" data-star="3"></i>
                                                        <i class="fa fa-star-o" data-star="4"></i>
                                                        <i class="fa fa-star-o" data-star="5"></i>
                                                    </div>
                                                </div>
                                                <div class="aspect_rating_item">
                                                    <span class="aspect_name">An toàn:</span>
                                                    <div class="interactive_stars aspect_rating" data-aspect="safety" data-rating="5">
                                                        <i class="fa fa-star-o" data-star="1"></i>
                                                        <i class="fa fa-star-o" data-star="2"></i>
                                                        <i class="fa fa-star-o" data-star="3"></i>
                                                        <i class="fa fa-star-o" data-star="4"></i>
                                                        <i class="fa fa-star-o" data-star="5"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Form Actions -->
                                        <div class="form_actions">
                                            <button type="button" class="btn_save_review">
                                                <i class="fa fa-save"></i> Lưu đánh giá
                                            </button>
                                            <button type="button" class="btn_cancel_review">
                                                <i class="fa fa-times"></i> Hủy
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="history_actions">
                                <button type="button" class="action_btn view_details" data-id="1">
                                    <i class="fa fa-eye"></i>
                                    Chi tiết
                                </button>
                                <button type="button" class="action_btn download_receipt" data-id="1">
                                    <i class="fa fa-download"></i>
                                    Hóa đơn
                                </button>
                                <button type="button" class="action_btn book_again" data-id="1">
                                    <i class="fa fa-repeat"></i>
                                    Đặt lại
                                </button>
                            </div>
                        </div>

                        <!-- History Item 2 -->
                        <div class="history_item" data-status="completed" data-price="36000" data-date="2025-09-12">
                            <div class="history_header">
                                <div class="booking_info">
                                    <h5>Bãi đỗ xe Big C Thăng Long</h5>
                                    <span class="booking_code">#BP12345679</span>
                                </div>
                                <div class="status_badge completed">
                                    <i class="fa fa-check-circle"></i>
                                    Hoàn thành
                                </div>
                            </div>
                            <div class="history_content">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="detail_group">
                                            <div class="detail_item">
                                                <i class="fa fa-map-marker"></i>
                                                <span>222 Trần Hưng Đạo, Quận 5, TP.HCM</span>
                                            </div>
                                            <div class="detail_item">
                                                <i class="fa fa-calendar"></i>
                                                <span>12/09/2025</span>
                                            </div>
                                            <div class="detail_item">
                                                <i class="fa fa-clock-o"></i>
                                                <span>09:15 - 14:15 (5 giờ)</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="detail_group">
                                            <div class="detail_item">
                                                <i class="fa fa-car"></i>
                                                <span>Ô tô - 51B-123.45</span>
                                            </div>
                                            <div class="detail_item">
                                                <i class="fa fa-money"></i>
                                                <span>60,000 VNĐ</span>
                                            </div>
                                            <div class="detail_item">
                                                <i class="fa fa-star"></i>
                                                <span>Đã đánh giá: 4 sao</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Customer Review Section -->
                            <div class="customer_review_section">
                                <div class="review_header">
                                    <h6><i class="fa fa-comment-o"></i> Đánh giá của bạn</h6>
                                </div>
                                <div class="review_content">
                                    <div class="rating_display">
                                        <div class="stars">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                        <span class="rating_text">4.0 - Tốt</span>
                                        <span class="review_date">Đánh giá ngày 12/09/2025</span>
                                    </div>
                                    <div class="review_comment">
                                        <p>"Bãi đỗ xe khá rộng rãi, dễ dàng di chuyển. Tuy nhiên giá hơi cao so với các bãi khác trong khu vực."</p>
                                    </div>
                                    <div class="review_aspects">
                                        <div class="aspect_item">
                                            <span class="aspect_label">Vị trí:</span>
                                            <div class="aspect_stars">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                            </div>
                                        </div>
                                        <div class="aspect_item">
                                            <span class="aspect_label">Dịch vụ:</span>
                                            <div class="aspect_stars">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                            </div>
                                        </div>
                                        <div class="aspect_item">
                                            <span class="aspect_label">Giá cả:</span>
                                            <div class="aspect_stars">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                            </div>
                                        </div>
                                        <div class="aspect_item">
                                            <span class="aspect_label">An toàn:</span>
                                            <div class="aspect_stars">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="history_actions">
                                <button type="button" class="action_btn view_details" data-id="2">
                                    <i class="fa fa-eye"></i>
                                    Chi tiết
                                </button>
                                <button type="button" class="action_btn download_receipt" data-id="2">
                                    <i class="fa fa-download"></i>
                                    Hóa đơn
                                </button>
                                <button type="button" class="action_btn book_again" data-id="2">
                                    <i class="fa fa-repeat"></i>
                                    Đặt lại
                                </button>
                            </div>
                        </div>

                        <!-- History Item 3 -->
                        <div class="history_item" data-status="ongoing" data-price="30000" data-date="2025-09-19">
                            <div class="history_header">
                                <div class="booking_info">
                                    <h5>Bãi đỗ xe Aeon Mall</h5>
                                    <span class="booking_code">#BP12345680</span>
                                </div>
                                <div class="status_badge ongoing">
                                    <i class="fa fa-clock-o"></i>
                                    Đang diễn ra
                                </div>
                            </div>
                            <div class="history_content">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="detail_group">
                                            <div class="detail_item">
                                                <i class="fa fa-map-marker"></i>
                                                <span>30 Bờ Bao Tân Thắng, Quận Tân Phú, TP.HCM</span>
                                            </div>
                                            <div class="detail_item">
                                                <i class="fa fa-calendar"></i>
                                                <span>19/09/2025</span>
                                            </div>
                                            <div class="detail_item">
                                                <i class="fa fa-clock-o"></i>
                                                <span>15:00 - 17:00 (2 giờ)</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="detail_group">
                                            <div class="detail_item">
                                                <i class="fa fa-car"></i>
                                                <span>Ô tô - 51B-123.45</span>
                                            </div>
                                            <div class="detail_item">
                                                <i class="fa fa-money"></i>
                                                <span>36,000 VNĐ (dự kiến)</span>
                                            </div>
                                            <div class="detail_item">
                                                <i class="fa fa-hourglass-half"></i>
                                                <span>Còn 1 giờ 23 phút</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="history_actions">
                                <button type="button" class="action_btn view_details" data-id="3">
                                    <i class="fa fa-eye"></i>
                                    Chi tiết
                                </button>
                                <button type="button" class="action_btn extend_time" data-id="3">
                                    <i class="fa fa-plus"></i>
                                    Gia hạn
                                </button>
                                <button type="button" class="action_btn end_parking" data-id="3">
                                    <i class="fa fa-stop"></i>
                                    Kết thúc
                                </button>
                            </div>
                        </div>

                        <!-- History Item 4 -->
                        <div class="history_item" data-status="cancelled" data-price="0" data-date="2025-09-08">
                            <div class="history_header">
                                <div class="booking_info">
                                    <h5>Bãi đỗ xe Lotte Center</h5>
                                    <span class="booking_code">#BP12345677</span>
                                </div>
                                <div class="status_badge cancelled">
                                    <i class="fa fa-times-circle"></i>
                                    Đã hủy
                                </div>
                            </div>
                            <div class="history_content">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="detail_group">
                                            <div class="detail_item">
                                                <i class="fa fa-map-marker"></i>
                                                <span>128 Nguyễn Huệ, Quận 1, TP.HCM</span>
                                            </div>
                                            <div class="detail_item">
                                                <i class="fa fa-calendar"></i>
                                                <span>08/09/2025</span>
                                            </div>
                                            <div class="detail_item">
                                                <i class="fa fa-clock-o"></i>
                                                <span>18:00 - 20:00 (2 giờ)</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="detail_group">
                                            <div class="detail_item">
                                                <i class="fa fa-car"></i>
                                                <span>Ô tô - 51B-123.45</span>
                                            </div>
                                            <div class="detail_item">
                                                <i class="fa fa-money"></i>
                                                <span>Không tính phí</span>
                                            </div>
                                            <div class="detail_item">
                                                <i class="fa fa-info-circle"></i>
                                                <span>Hủy vì bận việc đột xuất</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="history_actions">
                                <button type="button" class="action_btn view_details" data-id="4">
                                    <i class="fa fa-eye"></i>
                                    Chi tiết
                                </button>
                                <button type="button" class="action_btn book_again" data-id="4">
                                    <i class="fa fa-repeat"></i>
                                    Đặt lại
                                </button>
                            </div>
                        </div>

                        <!-- History Item 5 - No Review Yet -->
                        <div class="history_item" data-status="completed" data-price="32000" data-date="2025-09-10">
                            <div class="history_header">
                                <div class="booking_info">
                                    <h5>Bãi đỗ xe Diamond Plaza</h5>
                                    <span class="booking_code">#BP12345676</span>
                                </div>
                                <div class="status_badge completed">
                                    <i class="fa fa-check-circle"></i>
                                    Hoàn thành
                                </div>
                            </div>
                            <div class="history_content">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="detail_group">
                                            <div class="detail_item">
                                                <i class="fa fa-map-marker"></i>
                                                <span>34 Lê Duẩn, Quận 1, TP.HCM</span>
                                            </div>
                                            <div class="detail_item">
                                                <i class="fa fa-calendar"></i>
                                                <span>10/09/2025</span>
                                            </div>
                                            <div class="detail_item">
                                                <i class="fa fa-clock-o"></i>
                                                <span>10:00 - 12:00 (2 giờ)</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="detail_group">
                                            <div class="detail_item">
                                                <i class="fa fa-car"></i>
                                                <span>Ô tô - 51B-123.45</span>
                                            </div>
                                            <div class="detail_item">
                                                <i class="fa fa-money"></i>
                                                <span>32,000 VNĐ</span>
                                            </div>
                                            <div class="detail_item">
                                                <i class="fa fa-star-o"></i>
                                                <span>Chưa đánh giá</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- New Review Section -->
                            <div class="customer_review_section">
                                <div class="review_header">
                                    <h6><i class="fa fa-comment-o"></i> Đánh giá bãi đỗ xe</h6>
                                    <button class="btn_write_review" data-booking-id="5">
                                        <i class="fa fa-edit"></i> Viết đánh giá
                                    </button>
                                </div>

                                <!-- No Review Message -->
                                <div class="no_review_message" id="noReviewMessage5">
                                    <div class="empty_review_state">
                                        <i class="fa fa-comment-o"></i>
                                        <p>Bạn chưa đánh giá bãi đỗ xe này</p>
                                        <small>Chia sẻ trải nghiệm của bạn để giúp những người khác</small>
                                    </div>
                                </div>

                                <!-- New Review Form -->
                                <div class="review_form" id="reviewForm5" style="display: none;">
                                    <form class="review_form_content">
                                        <!-- Overall Rating -->
                                        <div class="form_group">
                                            <label>Đánh giá tổng thể:</label>
                                            <div class="interactive_stars overall_rating" data-rating="0">
                                                <i class="fa fa-star-o" data-star="1"></i>
                                                <i class="fa fa-star-o" data-star="2"></i>
                                                <i class="fa fa-star-o" data-star="3"></i>
                                                <i class="fa fa-star-o" data-star="4"></i>
                                                <i class="fa fa-star-o" data-star="5"></i>
                                            </div>
                                            <span class="rating_label">Chọn đánh giá</span>
                                        </div>

                                        <!-- Comment -->
                                        <div class="form_group">
                                            <label>Nhận xét của bạn:</label>
                                            <textarea class="review_textarea" placeholder="Chia sẻ trải nghiệm của bạn về bãi đỗ xe này..." rows="4"></textarea>
                                        </div>

                                        <!-- Aspect Ratings -->
                                        <div class="form_group">
                                            <label>Đánh giá chi tiết:</label>
                                            <div class="aspect_ratings">
                                                <div class="aspect_rating_item">
                                                    <span class="aspect_name">Vị trí:</span>
                                                    <div class="interactive_stars aspect_rating" data-aspect="location" data-rating="0">
                                                        <i class="fa fa-star-o" data-star="1"></i>
                                                        <i class="fa fa-star-o" data-star="2"></i>
                                                        <i class="fa fa-star-o" data-star="3"></i>
                                                        <i class="fa fa-star-o" data-star="4"></i>
                                                        <i class="fa fa-star-o" data-star="5"></i>
                                                    </div>
                                                </div>
                                                <div class="aspect_rating_item">
                                                    <span class="aspect_name">Dịch vụ:</span>
                                                    <div class="interactive_stars aspect_rating" data-aspect="service" data-rating="0">
                                                        <i class="fa fa-star-o" data-star="1"></i>
                                                        <i class="fa fa-star-o" data-star="2"></i>
                                                        <i class="fa fa-star-o" data-star="3"></i>
                                                        <i class="fa fa-star-o" data-star="4"></i>
                                                        <i class="fa fa-star-o" data-star="5"></i>
                                                    </div>
                                                </div>
                                                <div class="aspect_rating_item">
                                                    <span class="aspect_name">Giá cả:</span>
                                                    <div class="interactive_stars aspect_rating" data-aspect="price" data-rating="0">
                                                        <i class="fa fa-star-o" data-star="1"></i>
                                                        <i class="fa fa-star-o" data-star="2"></i>
                                                        <i class="fa fa-star-o" data-star="3"></i>
                                                        <i class="fa fa-star-o" data-star="4"></i>
                                                        <i class="fa fa-star-o" data-star="5"></i>
                                                    </div>
                                                </div>
                                                <div class="aspect_rating_item">
                                                    <span class="aspect_name">An toàn:</span>
                                                    <div class="interactive_stars aspect_rating" data-aspect="safety" data-rating="0">
                                                        <i class="fa fa-star-o" data-star="1"></i>
                                                        <i class="fa fa-star-o" data-star="2"></i>
                                                        <i class="fa fa-star-o" data-star="3"></i>
                                                        <i class="fa fa-star-o" data-star="4"></i>
                                                        <i class="fa fa-star-o" data-star="5"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Form Actions -->
                                        <div class="form_actions">
                                            <button type="button" class="btn_save_review">
                                                <i class="fa fa-save"></i> Gửi đánh giá
                                            </button>
                                            <button type="button" class="btn_cancel_review">
                                                <i class="fa fa-times"></i> Hủy
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="history_actions">
                                <button type="button" class="action_btn view_details" data-id="5">
                                    <i class="fa fa-eye"></i>
                                    Chi tiết
                                </button>
                                <button type="button" class="action_btn download_receipt" data-id="5">
                                    <i class="fa fa-download"></i>
                                    Hóa đơn
                                </button>
                                <button type="button" class="action_btn book_again" data-id="5">
                                    <i class="fa fa-repeat"></i>
                                    Đặt lại
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Pagination -->
                    <div class="pagination_section">
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1">
                                        <i class="fa fa-chevron-left"></i>
                                    </a>
                                </li>
                                <li class="page-item active">
                                    <a class="page-link" href="#">1</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">2</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">3</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">
                                        <i class="fa fa-chevron-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end history section -->

    <!-- Detail Modal -->
    <div class="modal fade" id="detailModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Chi tiết đặt chỗ</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="detail_content">
                        <!-- Content will be populated by JavaScript -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" id="downloadDetailReceipt">
                        <i class="fa fa-download"></i>
                        Tải hóa đơn
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
    <!-- history js -->
    <script src="{{ asset('user/js/history.js') }}"></script>

</body>

</html>
