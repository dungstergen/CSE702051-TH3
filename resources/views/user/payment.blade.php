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
    <!-- payment style -->
    <link href="{{ asset('user/css/payment.css') }}" rel="stylesheet" />

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

    <!-- Payment section -->
    <section class="payment_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>
                    Thanh toán
                </h2>
                <p>
                    Hoàn tất thanh toán để xác nhận đặt chỗ đỗ xe của bạn
                </p>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <!-- Order Summary -->
                    <div class="payment_card">
                        <h4>Chi tiết đơn hàng</h4>
                        <div class="order_summary">
                            <div class="order_item">
                                <div class="item_info">
                                    <h5>Bãi đỗ xe Vincom Center</h5>
                                    <p><i class="fa fa-map-marker"></i> 72 Lê Thánh Tôn, Quận 1, TP.HCM</p>
                                    <p><i class="fa fa-clock-o"></i> 15/09/2025 - 08:00 đến 18:00</p>
                                    <p><i class="fa fa-car"></i> Vị trí: A2-15</p>
                                </div>
                                <div class="item_price">
                                    <span class="price">120.000đ</span>
                                </div>
                            </div>
                            <div class="order_total">
                                <div class="total_row">
                                    <span>Phí đỗ xe:</span>
                                    <span>120.000đ</span>
                                </div>
                                <div class="total_row">
                                    <span>Phí dịch vụ:</span>
                                    <span>5.000đ</span>
                                </div>
                                <div class="total_row">
                                    <span>Giảm giá:</span>
                                    <span class="discount">-10.000đ</span>
                                </div>
                                <div class="total_row final">
                                    <strong>Tổng cộng: <span class="final_price">115.000đ</span></strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Methods -->
                    <div class="payment_card">
                        <h4>Phương thức thanh toán</h4>
                        <div class="payment_methods">
                            <div class="payment_option">
                                <input type="radio" id="momo" name="payment_method" value="momo" checked>
                                <label for="momo">
                                    <img src="{{ asset('user/images/momo.jpg') }}" alt="MoMo" class="payment_logo">
                                    <span>Ví MoMo</span>
                                </label>
                            </div>
                            <div class="payment_option">
                                <input type="radio" id="zalopay" name="payment_method" value="zalopay">
                                <label for="zalopay">
                                    <img src="{{ asset('user/images/vietcombank.jpg') }}" alt="Vietcombank" class="payment_logo">
                                    <span>Vietcombank</span>
                                </label>
                            </div>
                            <div class="payment_option">
                                <input type="radio" id="vnpay" name="payment_method" value="vnpay">
                                <label for="vnpay">
                                    <img src="{{ asset('user/images/vietinbank.jpg') }}" alt="VietinBank" class="payment_logo">
                                    <span>VietinBank</span>
                                </label>
                            </div>
                            <div class="payment_option">
                                <input type="radio" id="banking" name="payment_method" value="banking">
                                <label for="banking">
                                    <i class="fa fa-credit-card payment_icon"></i>
                                    <span>Thẻ ATM/Internet Banking</span>
                                </label>
                            </div>
                            <div class="payment_option">
                                <input type="radio" id="cash" name="payment_method" value="cash">
                                <label for="cash">
                                    <i class="fa fa-money payment_icon"></i>
                                    <span>Thanh toán tại chỗ</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Form -->
                    <div class="payment_card" id="payment_form" style="display: none;">
                        <h4>Thông tin thanh toán</h4>
                        <form>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Số thẻ</label>
                                        <input type="text" class="form-control" placeholder="1234 5678 9012 3456">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Tháng/Năm</label>
                                        <input type="text" class="form-control" placeholder="MM/YY">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>CVV</label>
                                        <input type="text" class="form-control" placeholder="123">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Tên chủ thẻ</label>
                                <input type="text" class="form-control" placeholder="NGUYEN VAN A">
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-4">
                    <!-- Promo Code -->
                    <div class="payment_card">
                        <h4><i class="fa fa-gift"></i> Mã giảm giá</h4>
                        <div class="promo_section">
                            <div class="promo_input_wrapper">
                                <div class="input-group">
                                    <input type="text" class="form-control promo_input" placeholder="Nhập mã giảm giá" id="promo_code_input">
                                    <div class="input-group-append">
                                        <button class="btn btn_promo" type="button" id="apply_promo_btn">
                                            Áp dụng
                                        </button>
                                    </div>
                                </div>
                                <small class="promo_hint">
                                    <i class="fa fa-info-circle"></i> Nhập mã để nhận ưu đãi
                                </small>
                            </div>

                            <div class="promo_available">
                                <h6><i class="fa fa-tags"></i> Mã khuyến mãi có sẵn</h6>
                                <div class="promo_list">
                                    <div class="promo_item" data-code="FIRST10">
                                        <div class="promo_badge">
                                            <span class="promo_code">FIRST10</span>
                                            <span class="promo_value">-10%</span>
                                        </div>
                                        <div class="promo_details">
                                            <span class="promo_desc">Giảm 10% lần đầu</span>
                                            <span class="promo_condition">Đặt lần đầu</span>
                                        </div>
                                        <button class="btn_copy_code" data-code="FIRST10">
                                            <i class="fa fa-copy"></i>
                                        </button>
                                    </div>
                                    <div class="promo_item" data-code="WEEKEND20">
                                        <div class="promo_badge">
                                            <span class="promo_code">WEEKEND20</span>
                                            <span class="promo_value">-20%</span>
                                        </div>
                                        <div class="promo_details">
                                            <span class="promo_desc">Giảm 20% cuối tuần</span>
                                            <span class="promo_condition">Thứ 7 - Chủ nhật</span>
                                        </div>
                                        <button class="btn_copy_code" data-code="WEEKEND20">
                                            <i class="fa fa-copy"></i>
                                        </button>
                                    </div>
                                    <div class="promo_item" data-code="SAVE15K">
                                        <div class="promo_badge">
                                            <span class="promo_code">SAVE15K</span>
                                            <span class="promo_value">-15K</span>
                                        </div>
                                        <div class="promo_details">
                                            <span class="promo_desc">Tiết kiệm 15.000đ</span>
                                            <span class="promo_condition">Đơn từ 100K</span>
                                        </div>
                                        <button class="btn_copy_code" data-code="SAVE15K">
                                            <i class="fa fa-copy"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Summary -->
                    <div class="payment_card">
                        <h4>Tóm tắt thanh toán</h4>
                        <div class="payment_summary">
                            <div class="summary_row">
                                <span>Tổng tiền:</span>
                                <span>115.000đ</span>
                            </div>
                            <div class="summary_row">
                                <span>Phương thức:</span>
                                <span id="selected_method">Ví MoMo</span>
                            </div>
                            <div class="summary_actions">
                                <button type="button" class="btn btn_primary btn_large" id="payment_btn">
                                    <i class="fa fa-lock"></i> Thanh toán an toàn
                                </button>
                                <p class="payment_note">
                                    <i class="fa fa-shield"></i>
                                    Giao dịch được bảo mật 100%
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end payment section -->

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
    <!-- payment js -->
    <script src="{{ asset('user/js/payment.js') }}"></script>

</body>

</html>
