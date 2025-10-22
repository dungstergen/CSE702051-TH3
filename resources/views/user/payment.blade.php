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

    <!-- Payment Section -->
    <section class="payment_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>Thanh toán</h2>
                <p>Quản lý thanh toán và phương thức thanh toán</p>
            </div>

            <div class="row">
                <!-- Payment Options -->
                <div class="col-lg-7">
                    <div class="payment_card">
                        <h4 class="mb-4">
                            <i class="fa fa-credit-card"></i> Phương thức thanh toán
                        </h4>

                        <div class="payment_methods">
                            <!-- Credit/Debit Card -->
                            <div class="payment_method_item" onclick="selectPaymentMethod('card')">
                                <input type="radio" name="payment_method" id="method_card" value="card">
                                <label for="method_card">
                                    <div class="method_icon">
                                        <i class="fa fa-credit-card"></i>
                                    </div>
                                    <div class="method_info">
                                        <h5>Thẻ tín dụng/Ghi nợ</h5>
                                        <p>Visa, Mastercard, JCB</p>
                                    </div>
                                </label>
                            </div>

                            <!-- E-Wallet -->
                            <div class="payment_method_item" onclick="selectPaymentMethod('ewallet')">
                                <input type="radio" name="payment_method" id="method_ewallet" value="ewallet">
                                <label for="method_ewallet">
                                    <div class="method_icon">
                                        <i class="fa fa-mobile"></i>
                                    </div>
                                    <div class="method_info">
                                        <h5>Ví điện tử</h5>
                                        <p>MoMo, ZaloPay, VNPay</p>
                                    </div>
                                </label>
                            </div>

                            <!-- Bank Transfer -->
                            <div class="payment_method_item" onclick="selectPaymentMethod('bank')">
                                <input type="radio" name="payment_method" id="method_bank" value="bank">
                                <label for="method_bank">
                                    <div class="method_icon">
                                        <i class="fa fa-university"></i>
                                    </div>
                                    <div class="method_info">
                                        <h5>Chuyển khoản ngân hàng</h5>
                                        <p>Chuyển khoản qua Internet Banking</p>
                                    </div>
                                </label>
                            </div>

                            <!-- Cash -->
                            <div class="payment_method_item" onclick="selectPaymentMethod('cash')">
                                <input type="radio" name="payment_method" id="method_cash" value="cash" checked>
                                <label for="method_cash">
                                    <div class="method_icon">
                                        <i class="fa fa-money"></i>
                                    </div>
                                    <div class="method_info">
                                        <h5>Tiền mặt</h5>
                                        <p>Thanh toán trực tiếp tại bãi đỗ</p>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Payment Form (Dynamic based on method) -->
                        <div id="paymentFormContainer" class="mt-4" style="display: none;">
                            <!-- Card Payment Form -->
                            <div id="cardPaymentForm" class="payment_form" style="display: none;">
                                <h5 class="mb-3">Thông tin thẻ</h5>
                                <form>
                                    <div class="form-group">
                                        <label>Số thẻ *</label>
                                        <input type="text" class="form-control" placeholder="1234 5678 9012 3456" maxlength="19">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Ngày hết hạn *</label>
                                                <input type="text" class="form-control" placeholder="MM/YY" maxlength="5">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>CVV *</label>
                                                <input type="text" class="form-control" placeholder="123" maxlength="3">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Tên chủ thẻ *</label>
                                        <input type="text" class="form-control" placeholder="NGUYEN VAN A">
                                    </div>
                                </form>
                            </div>

                            <!-- E-Wallet Form -->
                            <div id="ewalletPaymentForm" class="payment_form" style="display: none;">
                                <h5 class="mb-3">Chọn ví điện tử</h5>
                                <div class="ewallet_options">
                                    <div class="ewallet_option">
                                        <input type="radio" name="ewallet" id="momo" value="momo">
                                        <label for="momo">
                                            <img src="{{ asset('user/images/momo.png') }}" alt="MoMo" style="height: 40px;">
                                            MoMo
                                        </label>
                                    </div>
                                    <div class="ewallet_option">
                                        <input type="radio" name="ewallet" id="zalopay" value="zalopay">
                                        <label for="zalopay">
                                            <img src="{{ asset('user/images/zalopay.png') }}" alt="ZaloPay" style="height: 40px;">
                                            ZaloPay
                                        </label>
                                    </div>
                                    <div class="ewallet_option">
                                        <input type="radio" name="ewallet" id="vnpay" value="vnpay">
                                        <label for="vnpay">
                                            <img src="{{ asset('user/images/vnpay.png') }}" alt="VNPay" style="height: 40px;">
                                            VNPay
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Bank Transfer Form -->
                            <div id="bankPaymentForm" class="payment_form" style="display: none;">
                                <h5 class="mb-3">Thông tin chuyển khoản</h5>
                                <div class="alert alert-info">
                                    <strong>Ngân hàng:</strong> Vietcombank<br>
                                    <strong>Số tài khoản:</strong> 1234567890<br>
                                    <strong>Chủ tài khoản:</strong> CONG TY PASPARK<br>
                                    <strong>Nội dung:</strong> <span id="transferContent">BK001 TenKhachHang</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment History -->
                    <div class="payment_card mt-4">
                        <h4 class="mb-4">
                            <i class="fa fa-history"></i> Lịch sử thanh toán
                        </h4>

                        <div class="table-responsive">
                            <table class="table" id="paymentHistoryTable">
                                <thead>
                                    <tr>
                                        <th>Mã thanh toán</th>
                                        <th>Ngày</th>
                                        <th>Phương thức</th>
                                        <th>Số tiền</th>
                                        <th>Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody id="paymentHistoryBody">
                                    <!-- Payment history will be loaded here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Payment Summary -->
                <div class="col-lg-5">
                    <div class="payment_summary">
                        <h4 class="mb-4">
                            <i class="fa fa-file-text-o"></i> Tóm tắt thanh toán
                        </h4>

                        <div class="summary_item">
                            <span>Bãi đỗ xe:</span>
                            <strong id="summary_parking_lot">-</strong>
                        </div>

                        <div class="summary_item">
                            <span>Thời gian đỗ:</span>
                            <strong id="summary_duration">-</strong>
                        </div>

                        <div class="summary_item">
                            <span>Phí đỗ xe:</span>
                            <strong id="summary_parking_fee">0đ</strong>
                        </div>

                        <div class="summary_item">
                            <span>Phí dịch vụ:</span>
                            <strong id="summary_service_fee">0đ</strong>
                        </div>

                        <hr>

                        <div class="summary_total">
                            <span>Tổng cộng:</span>
                            <h3 id="summary_total">0đ</h3>
                        </div>

                        <button type="button" class="btn btn_box w-100 mt-3 text-white" style="background: linear-gradient(90deg, #ffbe33 0%, #ff6f00 100%); border: none;" onclick="processPayment()">
                            <i class="fa fa-check"></i> Xác nhận thanh toán
                        </button>

                        <div class="payment_security mt-3">
                            <p class="text-center text-muted">
                                <i class="fa fa-lock"></i> Thanh toán được bảo mật
                            </p>
                        </div>
                    </div>

                    <!-- Promotions -->
                    <div class="promotions_card mt-4">
                        <h5 class="mb-3">
                            <i class="fa fa-gift"></i> Mã khuyến mãi
                        </h5>

                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="promoCode" placeholder="Nhập mã khuyến mãi">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" onclick="applyPromoCode()">
                                    Áp dụng
                                </button>
                            </div>
                        </div>

                        <div class="available_promos">
                            <p class="text-muted small">Khuyến mãi có sẵn:</p>
                            <div class="promo_item" onclick="usePromo('FIRST10')">
                                <div class="promo_code">FIRST10</div>
                                <div class="promo_desc">Giảm 10% cho lần đặt đầu tiên</div>
                            </div>
                            <div class="promo_item" onclick="usePromo('PARKING20')">
                                <div class="promo_code">PARKING20</div>
                                <div class="promo_desc">Giảm 20,000đ cho đơn từ 100,000đ</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Payment Section -->

    <!-- Custom Styles for Payment Page -->
    <style>
        .payment_card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }

        .payment_card h4 {
            color: #252525;
            font-weight: 700;
            padding-bottom: 15px;
            border-bottom: 2px solid #ffbe33;
        }

        .payment_method_item {
            border: 2px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 15px;
            cursor: pointer;
            transition: all 0.3s;
            position: relative;
        }

        .payment_method_item:hover {
            border-color: #ffbe33;
            background: #fff9f0;
        }

        .payment_method_item input[type="radio"] {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
        }

        .payment_method_item label {
            display: flex;
            align-items: center;
            margin: 0;
            cursor: pointer;
        }

        .method_icon {
            width: 60px;
            height: 60px;
            background: #f8f9fa;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
        }

        .method_icon i {
            font-size: 30px;
            color: #ffbe33;
        }

        .method_info h5 {
            margin: 0;
            font-weight: 600;
            color: #252525;
        }

        .method_info p {
            margin: 0;
            color: #666;
            font-size: 14px;
        }

        .payment_summary {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            /* position: sticky; */
            top: 20px;
        }

        .summary_item {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #eee;
        }

        .summary_total {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
        }

        .summary_total h3 {
            color: #ffbe33;
            font-weight: 700;
            margin: 0;
        }

        .promotions_card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }

        .promo_item {
            background: #f8f9fa;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 10px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .promo_item:hover {
            background: #ffbe33;
            color: white;
        }

        .promo_code {
            font-weight: 700;
            font-size: 14px;
        }

        .promo_desc {
            font-size: 12px;
            margin-top: 3px;
        }

        .ewallet_options {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
        }

        .ewallet_option {
            text-align: center;
        }

        .ewallet_option label {
            cursor: pointer;
            padding: 15px;
            border: 2px solid #ddd;
            border-radius: 10px;
            display: block;
            transition: all 0.3s;
        }

        .ewallet_option input[type="radio"]:checked + label {
            border-color: #ffbe33;
            background: #fff9f0;
        }

        .table thead th {
            background: #f8f9fa;
            font-weight: 600;
            border: none;
        }
    </style>

    <!-- JavaScript for Payment Page -->
    <script>
        let selectedMethod = 'cash';

        function selectPaymentMethod(method) {
            selectedMethod = method;
            document.getElementById(`method_${method}`).checked = true;

            // Hide all payment forms
            document.querySelectorAll('.payment_form').forEach(form => {
                form.style.display = 'none';
            });

            // Show selected payment form
            const formContainer = document.getElementById('paymentFormContainer');
            if (method !== 'cash') {
                formContainer.style.display = 'block';
                const selectedForm = document.getElementById(`${method}PaymentForm`);
                if (selectedForm) {
                    selectedForm.style.display = 'block';
                }
            } else {
                formContainer.style.display = 'none';
            }
        }

        function processPayment() {
            if (!selectedMethod) {
                alert('Vui lòng chọn phương thức thanh toán');
                return;
            }

            // Validate payment information based on method
            if (selectedMethod === 'card') {
                // Validate card info
                alert('Đang xử lý thanh toán bằng thẻ...');
            } else if (selectedMethod === 'ewallet') {
                // Process e-wallet payment
                alert('Đang chuyển đến trang thanh toán ví điện tử...');
            } else if (selectedMethod === 'bank') {
                // Process bank transfer
                alert('Vui lòng chuyển khoản theo thông tin đã cung cấp');
            } else {
                // Cash payment
                alert('Thanh toán thành công! Vui lòng thanh toán tiền mặt tại bãi đỗ xe');
            }
        }

        function applyPromoCode() {
            const promoCode = document.getElementById('promoCode').value;
            if (promoCode) {
                alert(`Đang áp dụng mã khuyến mãi: ${promoCode}`);
                // Apply promo code logic here
            }
        }

        function usePromo(code) {
            document.getElementById('promoCode').value = code;
            applyPromoCode();
        }

        // Load payment history
        function loadPaymentHistory() {
            const tbody = document.getElementById('paymentHistoryBody');

            // Simulated data
            const payments = [
                {
                    id: 'PAY001',
                    date: '15/10/2025',
                    method: 'Tiền mặt',
                    amount: 45000,
                    status: 'success'
                },
                {
                    id: 'PAY002',
                    date: '10/10/2025',
                    method: 'Thẻ',
                    amount: 60000,
                    status: 'success'
                }
            ];

            payments.forEach(payment => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td><strong>${payment.id}</strong></td>
                    <td>${payment.date}</td>
                    <td>${payment.method}</td>
                    <td><strong>${payment.amount.toLocaleString('vi-VN')}đ</strong></td>
                    <td><span class="badge badge-success">Thành công</span></td>
                `;
                tbody.appendChild(tr);
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            loadPaymentHistory();

            // Load payment summary from URL params or session
            document.getElementById('summary_parking_lot').textContent = 'Bãi đỗ xe Vincom';
            document.getElementById('summary_duration').textContent = '3 giờ';
            document.getElementById('summary_parking_fee').textContent = '45,000đ';
            document.getElementById('summary_service_fee').textContent = '5,000đ';
            document.getElementById('summary_total').textContent = '50,000đ';
        });
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
