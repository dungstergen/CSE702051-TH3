@extends('user.layouts.app')<!DOCTYPE html>

<html>

@section('title', 'Thanh toán')

<head>

@section('styles')    <!-- Basic -->

<style>    <meta charset="utf-8" />

    .payment-method {    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        border: 2px solid #e0e0e0;    <!-- Mobile Metas -->

        border-radius: 10px;    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

        padding: 20px;    <!-- Site Metas -->

        cursor: pointer;    <meta name="keywords" content="" />

        transition: all 0.3s ease;    <meta name="description" content="" />

        margin-bottom: 15px;    <meta name="author" content="" />

    }    <link rel="shortcut icon" href="{{ asset('user/images/favicon.png') }}" type="image/x-icon">



    .payment-method:hover {    <title>Paspark</title>

        border-color: #007bff;

        transform: translateY(-2px);

        box-shadow: 0 5px 15px rgba(0,123,255,0.2);    <!-- bootstrap core css -->

    }    <link rel="stylesheet" type="text/css" href="{{ asset('user/css/bootstrap.css') }}" />



    .payment-method.selected {    <!-- fonts style -->

        border-color: #007bff;    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

        background: linear-gradient(135deg, #f8f9ff 0%, #e6f3ff 100%);

    }    <!-- nice select -->

        <link rel="stylesheet" href="{{ asset('user/css/nice-select.min.css') }}">

    .payment-method .icon {

        font-size: 2rem;    <!--owl slider stylesheet -->

        color: #007bff;    <link rel="stylesheet" type="text/css"

        margin-bottom: 10px;        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

    }

        <!-- font awesome style -->

    .booking-summary {    <link href="{{ asset('user/css/font-awesome.min.css') }}" rel="stylesheet" />

        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);

        color: white;    <!-- Custom styles for this template -->

        border-radius: 15px;    <link href="{{ asset('user/css/style.css') }}" rel="stylesheet" />

        padding: 25px;    <!-- responsive style -->

    }    <link href="{{ asset('user/css/responsive.css') }}" rel="stylesheet" />

        <!-- loading screen style -->

    .booking-summary .summary-item {    <link href="{{ asset('user/css/loading.css') }}" rel="stylesheet" />

        border-bottom: 1px solid rgba(255,255,255,0.2);    <!-- payment style -->

        padding: 10px 0;    <link href="{{ asset('user/css/payment.css') }}" rel="stylesheet" />

    }

    </head>

    .booking-summary .summary-item:last-child {

        border-bottom: none;<body class="sub_page">

        font-weight: bold;

        font-size: 1.2rem;    <div class="hero_area">

    }        <div class="bg-box">

                <img src="{{ asset('user/images/slider-bg.jpg') }}" alt="">

    .payment-form {        </div>

        background: white;        <!-- header section strats -->

        border-radius: 15px;        <header class="header_section">

        padding: 30px;            <div class="container">

        box-shadow: 0 10px 30px rgba(0,0,0,0.1);                <nav class="navbar navbar-expand-lg custom_nav-container ">

    }                    <a class="navbar-brand" href="{{ url('/') }}">

                            <span>

    .security-badge {                            Paspark

        background: #e8f5e8;                        </span>

        color: #4a7c59;                    </a>

        padding: 10px 15px;

        border-radius: 8px;                    <button class="navbar-toggler" type="button" data-toggle="collapse"

        font-size: 0.9rem;                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"

        margin-top: 15px;                        aria-expanded="false" aria-label="Toggle navigation">

    }                        <span class=""> </span>

</style>                    </button>

@endsection

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">

@section('content')                        <ul class="navbar-nav">

<div class="container mt-5">                            <li class="nav-item">

    <div class="row">                                <a class="nav-link" href="{{ url('/') }}">Trang chủ</a>

        <div class="col-12">                            </li>

            <h2 class="text-center mb-5">                            <li class="nav-item">

                <i class="fa fa-credit-card text-primary mr-2"></i>                                <a class="nav-link" href="{{ url('/dashboard') }}">Bảng điều khiển</a>

                Thanh toán đặt chỗ                            </li>

            </h2>                            <li class="nav-item">

        </div>                                <a class="nav-link" href="{{ url('/booking') }}">Đặt chỗ</a>

    </div>                            </li>

                            <li class="nav-item">

    <div class="row">                                <a class="nav-link" href="{{ url('/history') }}">Lịch sử</a>

        <!-- Booking Summary -->                            </li>

        <div class="col-lg-4">                        </ul>

            <div class="booking-summary sticky-top">                        <form class="form-inline">

                <h5 class="text-center mb-4">                            <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit">

                    <i class="fa fa-receipt mr-2"></i>                                <i class="fa fa-search" aria-hidden="true"></i>

                    Thông tin đặt chỗ                            </button>

                </h5>                        </form>

                                    </div>

                <div class="summary-item">                </nav>

                    <div class="d-flex justify-content-between">            </div>

                        <span>Mã đặt chỗ:</span>        </header>

                        <strong>{{ $booking->booking_code }}</strong>        <!-- end header section -->

                    </div>    </div>

                </div>

                    <!-- Payment section -->

                <div class="summary-item">    <section class="payment_section layout_padding">

                    <div class="d-flex justify-content-between">        <div class="container">

                        <span>Bãi đỗ xe:</span>            <div class="heading_container heading_center">

                        <span class="text-right">{{ $booking->parkingLot->name }}</span>                <h2>

                    </div>                    Thanh toán

                    <small class="text-light">{{ $booking->parkingLot->address }}</small>                </h2>

                </div>                <p>

                                    Hoàn tất thanh toán để xác nhận đặt chỗ đỗ xe của bạn

                <div class="summary-item">                </p>

                    <div class="d-flex justify-content-between">            </div>

                        <span>Thời gian:</span>

                        <span class="text-right">            <div class="row">

                            {{ $booking->start_time->format('d/m H:i') }} - {{ $booking->end_time->format('d/m H:i') }}                <div class="col-lg-8">

                        </span>                    <!-- Order Summary -->

                    </div>                    <div class="payment_card">

                    <small class="text-light">{{ $booking->duration_hours }} giờ</small>                        <h4>Chi tiết đơn hàng</h4>

                </div>                        <div class="order_summary">

                                            <div class="order_item">

                <div class="summary-item">                                <div class="item_info">

                    <div class="d-flex justify-content-between">                                    <h5>Bãi đỗ xe Vincom Center</h5>

                        <span>Loại xe:</span>                                    <p><i class="fa fa-map-marker"></i> 72 Lê Thánh Tôn, Quận 1, TP.HCM</p>

                        <span>                                    <p><i class="fa fa-clock-o"></i> 15/09/2025 - 08:00 đến 18:00</p>

                            @switch($booking->vehicle_type)                                    <p><i class="fa fa-car"></i> Vị trí: A2-15</p>

                                @case('car') Ô tô @break                                </div>

                                @case('motorcycle') Xe máy @break                                  <div class="item_price">

                                @case('bicycle') Xe đạp @break                                    <span class="price">120.000đ</span>

                            @endswitch                                </div>

                            ({{ $booking->license_plate }})                            </div>

                        </span>                            <div class="order_total">

                    </div>                                <div class="total_row">

                </div>                                    <span>Phí đỗ xe:</span>

                                                    <span>120.000đ</span>

                <div class="summary-item">                                </div>

                    <div class="d-flex justify-content-between">                                <div class="total_row">

                        <span>Tiền giữ xe:</span>                                    <span>Phí dịch vụ:</span>

                        <span>{{ number_format($booking->duration_hours * $booking->parkingLot->hourly_rate, 0, ',', '.') }} VNĐ</span>                                    <span>5.000đ</span>

                    </div>                                </div>

                </div>                                <div class="total_row">

                                                    <span>Giảm giá:</span>

                @if($booking->servicePackage)                                    <span class="discount">-10.000đ</span>

                <div class="summary-item">                                </div>

                    <div class="d-flex justify-content-between">                                <div class="total_row final">

                        <span>{{ $booking->servicePackage->name }}:</span>                                    <strong>Tổng cộng: <span class="final_price">115.000đ</span></strong>

                        <span>{{ number_format($booking->servicePackage->price, 0, ',', '.') }} VNĐ</span>                                </div>

                    </div>                            </div>

                </div>                        </div>

                @endif                    </div>



                <div class="summary-item">                    <!-- Payment Methods -->

                    <div class="d-flex justify-content-between">                    <div class="payment_card">

                        <span>Tổng cộng:</span>                        <h4>Phương thức thanh toán</h4>

                        <span>{{ number_format($booking->total_cost, 0, ',', '.') }} VNĐ</span>                        <div class="payment_methods">

                    </div>                            <div class="payment_option">

                </div>                                <input type="radio" id="momo" name="payment_method" value="momo" checked>

            </div>                                <label for="momo">

        </div>                                    <img src="{{ asset('user/images/momo.jpg') }}" alt="MoMo" class="payment_logo">

                                    <span>Ví MoMo</span>

        <!-- Payment Form -->                                </label>

        <div class="col-lg-8">                            </div>

            <div class="payment-form">                            <div class="payment_option">

                <h5 class="mb-4">                                <input type="radio" id="zalopay" name="payment_method" value="zalopay">

                    <i class="fa fa-payment mr-2"></i>                                <label for="zalopay">

                    Chọn phương thức thanh toán                                    <img src="{{ asset('user/images/vietcombank.jpg') }}" alt="Vietcombank" class="payment_logo">

                </h5>                                    <span>Vietcombank</span>

                                                </label>

                <form action="{{ route('user.payment.process') }}" method="POST" id="paymentForm">                            </div>

                    @csrf                            <div class="payment_option">

                    <input type="hidden" name="booking_id" value="{{ $booking->id }}">                                <input type="radio" id="vnpay" name="payment_method" value="vnpay">

                                                    <label for="vnpay">

                    <!-- Payment Methods -->                                    <img src="{{ asset('user/images/vietinbank.jpg') }}" alt="VietinBank" class="payment_logo">

                    <div class="row">                                    <span>VietinBank</span>

                        @foreach($paymentMethods as $key => $method)                                </label>

                        <div class="col-md-6">                            </div>

                            <div class="payment-method" onclick="selectPaymentMethod('{{ $key }}')">                            <div class="payment_option">

                                <div class="text-center">                                <input type="radio" id="banking" name="payment_method" value="banking">

                                    <i class="fa {{ $method['icon'] }} icon"></i>                                <label for="banking">

                                    <h6>{{ $method['name'] }}</h6>                                    <i class="fa fa-credit-card payment_icon"></i>

                                    <p class="text-muted small">{{ $method['description'] }}</p>                                    <span>Thẻ ATM/Internet Banking</span>

                                </div>                                </label>

                                                            </div>

                                @if($method['fee'] > 0)                            <div class="payment_option">

                                    <div class="text-center">                                <input type="radio" id="cash" name="payment_method" value="cash">

                                        <small class="text-info">Phí: {{ number_format($method['fee'], 0, ',', '.') }} VNĐ</small>                                <label for="cash">

                                    </div>                                    <i class="fa fa-money payment_icon"></i>

                                @endif                                    <span>Thanh toán tại chỗ</span>

                            </div>                                </label>

                        </div>                            </div>

                        @endforeach                        </div>

                    </div>                    </div>



                    <input type="hidden" name="payment_method" id="selected_payment_method" required>                    <!-- Payment Form -->

                                        <div class="payment_card" id="payment_form" style="display: none;">

                    <!-- Additional Information -->                        <h4>Thông tin thanh toán</h4>

                    <div id="payment_details" style="display: none;">                        <form>

                        <div class="card mt-4">                            <div class="row">

                            <div class="card-header">                                <div class="col-md-6">

                                <h6><i class="fa fa-info-circle mr-2"></i>Thông tin bổ sung</h6>                                    <div class="form-group">

                            </div>                                        <label>Số thẻ</label>

                            <div class="card-body">                                        <input type="text" class="form-control" placeholder="1234 5678 9012 3456">

                                <!-- E-wallet phone number -->                                    </div>

                                <div id="ewallet_fields" style="display: none;">                                </div>

                                    <div class="form-group">                                <div class="col-md-3">

                                        <label>Số điện thoại đăng ký ví điện tử *</label>                                    <div class="form-group">

                                        <input type="tel" class="form-control" name="phone_number"                                         <label>Tháng/Năm</label>

                                               placeholder="0912345678" value="{{ auth()->user()->phone ?? '' }}">                                        <input type="text" class="form-control" placeholder="MM/YY">

                                        <small class="text-muted">Số điện thoại đã đăng ký với ví điện tử</small>                                    </div>

                                    </div>                                </div>

                                </div>                                <div class="col-md-3">

                                                                    <div class="form-group">

                                <!-- Bank transfer info -->                                        <label>CVV</label>

                                <div id="bank_transfer_info" style="display: none;">                                        <input type="text" class="form-control" placeholder="123">

                                    <div class="alert alert-info">                                    </div>

                                        <h6><i class="fa fa-bank mr-2"></i>Thông tin chuyển khoản</h6>                                </div>

                                        <p class="mb-2"><strong>Ngân hàng:</strong> Vietcombank</p>                            </div>

                                        <p class="mb-2"><strong>Số tài khoản:</strong> 1234567890</p>                            <div class="form-group">

                                        <p class="mb-2"><strong>Chủ tài khoản:</strong> CONG TY PASPARK</p>                                <label>Tên chủ thẻ</label>

                                        <p class="mb-2"><strong>Nội dung chuyển khoản:</strong> {{ $booking->booking_code }}</p>                                <input type="text" class="form-control" placeholder="NGUYEN VAN A">

                                        <p class="mb-0"><strong>Số tiền:</strong> {{ number_format($booking->total_cost, 0, ',', '.') }} VNĐ</p>                            </div>

                                    </div>                        </form>

                                </div>                    </div>

                                                </div>

                                <!-- Cash payment info -->

                                <div id="cash_payment_info" style="display: none;">                <div class="col-lg-4">

                                    <div class="alert alert-warning">                    <!-- Promo Code -->

                                        <h6><i class="fa fa-money mr-2"></i>Thanh toán tiền mặt</h6>                    <div class="payment_card">

                                        <p class="mb-2">Bạn sẽ thanh toán tiền mặt trực tiếp tại bãi xe khi đến.</p>                        <h4><i class="fa fa-gift"></i> Mã giảm giá</h4>

                                        <p class="mb-0">Vui lòng chuẩn bị đúng số tiền: <strong>{{ number_format($booking->total_cost, 0, ',', '.') }} VNĐ</strong></p>                        <div class="promo_section">

                                    </div>                            <div class="promo_input_wrapper">

                                </div>                                <div class="input-group">

                            </div>                                    <input type="text" class="form-control promo_input" placeholder="Nhập mã giảm giá" id="promo_code_input">

                        </div>                                    <div class="input-group-append">

                    </div>                                        <button class="btn btn_promo" type="button" id="apply_promo_btn">

                                                                Áp dụng

                    <!-- Security Info -->                                        </button>

                    <div class="security-badge">                                    </div>

                        <i class="fa fa-lock mr-2"></i>                                </div>

                        Thông tin thanh toán của bạn được bảo mật an toàn với công nghệ mã hóa SSL 256-bit                                <small class="promo_hint">

                    </div>                                    <i class="fa fa-info-circle"></i> Nhập mã để nhận ưu đãi

                                                    </small>

                    <!-- Submit Button -->                            </div>

                    <div class="text-center mt-4">

                        <button type="submit" class="btn btn-primary btn-lg px-5" id="paymentSubmit" disabled>                            <div class="promo_available">

                            <i class="fa fa-credit-card mr-2"></i>                                <h6><i class="fa fa-tags"></i> Mã khuyến mãi có sẵn</h6>

                            Xác nhận thanh toán                                <div class="promo_list">

                        </button>                                    <div class="promo_item" data-code="FIRST10">

                                                                <div class="promo_badge">

                        <div class="mt-3">                                            <span class="promo_code">FIRST10</span>

                            <a href="{{ route('user.booking.show', $booking->id) }}" class="btn btn-outline-secondary">                                            <span class="promo_value">-10%</span>

                                <i class="fa fa-arrow-left mr-2"></i>Quay lại                                        </div>

                            </a>                                        <div class="promo_details">

                        </div>                                            <span class="promo_desc">Giảm 10% lần đầu</span>

                    </div>                                            <span class="promo_condition">Đặt lần đầu</span>

                </form>                                        </div>

            </div>                                        <button class="btn_copy_code" data-code="FIRST10">

        </div>                                            <i class="fa fa-copy"></i>

    </div>                                        </button>

</div>                                    </div>

@endsection                                    <div class="promo_item" data-code="WEEKEND20">

                                        <div class="promo_badge">

@section('scripts')                                            <span class="promo_code">WEEKEND20</span>

<script>                                            <span class="promo_value">-20%</span>

let selectedPaymentMethod = null;                                        </div>

                                        <div class="promo_details">

function selectPaymentMethod(method) {                                            <span class="promo_desc">Giảm 20% cuối tuần</span>

    // Remove previous selection                                            <span class="promo_condition">Thứ 7 - Chủ nhật</span>

    document.querySelectorAll('.payment-method').forEach(card => {                                        </div>

        card.classList.remove('selected');                                        <button class="btn_copy_code" data-code="WEEKEND20">

    });                                            <i class="fa fa-copy"></i>

                                            </button>

    // Add selection to clicked card                                    </div>

    event.currentTarget.classList.add('selected');                                    <div class="promo_item" data-code="SAVE15K">

                                            <div class="promo_badge">

    selectedPaymentMethod = method;                                            <span class="promo_code">SAVE15K</span>

    document.getElementById('selected_payment_method').value = method;                                            <span class="promo_value">-15K</span>

                                            </div>

    // Show payment details                                        <div class="promo_details">

    document.getElementById('payment_details').style.display = 'block';                                            <span class="promo_desc">Tiết kiệm 15.000đ</span>

                                                <span class="promo_condition">Đơn từ 100K</span>

    // Hide all method-specific fields                                        </div>

    document.getElementById('ewallet_fields').style.display = 'none';                                        <button class="btn_copy_code" data-code="SAVE15K">

    document.getElementById('bank_transfer_info').style.display = 'none';                                            <i class="fa fa-copy"></i>

    document.getElementById('cash_payment_info').style.display = 'none';                                        </button>

                                        </div>

    // Show relevant fields based on selected method                                </div>

    switch(method) {                            </div>

        case 'momo':                        </div>

        case 'zalopay':                    </div>

            document.getElementById('ewallet_fields').style.display = 'block';

            break;                    <!-- Payment Summary -->

        case 'bank_transfer':                    <div class="payment_card">

            document.getElementById('bank_transfer_info').style.display = 'block';                        <h4>Tóm tắt thanh toán</h4>

            break;                        <div class="payment_summary">

        case 'cash':                            <div class="summary_row">

            document.getElementById('cash_payment_info').style.display = 'block';                                <span>Tổng tiền:</span>

            break;                                <span>115.000đ</span>

    }                            </div>

                                <div class="summary_row">

    // Enable submit button                                <span>Phương thức:</span>

    document.getElementById('paymentSubmit').disabled = false;                                <span id="selected_method">Ví MoMo</span>

                                </div>

    // Update submit button text                            <div class="summary_actions">

    const submitBtn = document.getElementById('paymentSubmit');                                <button type="button" class="btn btn_primary btn_large" id="payment_btn">

    switch(method) {                                    <i class="fa fa-lock"></i> Thanh toán an toàn

        case 'momo':                                </button>

            submitBtn.innerHTML = '<i class="fa fa-mobile mr-2"></i>Thanh toán với MoMo';                                <p class="payment_note">

            break;                                    <i class="fa fa-shield"></i>

        case 'zalopay':                                    Giao dịch được bảo mật 100%

            submitBtn.innerHTML = '<i class="fa fa-credit-card mr-2"></i>Thanh toán với ZaloPay';                                </p>

            break;                            </div>

        case 'bank_transfer':                        </div>

            submitBtn.innerHTML = '<i class="fa fa-bank mr-2"></i>Xác nhận chuyển khoản';                    </div>

            break;                </div>

        case 'cash':            </div>

            submitBtn.innerHTML = '<i class="fa fa-money mr-2"></i>Xác nhận thanh toán tiền mặt';        </div>

            break;    </section>

    }    <!-- end payment section -->

}

    <!-- info section -->

// Form submission    <section class="info_section ">

document.getElementById('paymentForm').addEventListener('submit', function(e) {

    if (!selectedPaymentMethod) {        <div class="container">

        e.preventDefault();            <div class="info_top ">

        alert('Vui lòng chọn phương thức thanh toán');                <div class="row ">

        return;                    <div class="col-md-6 col-lg-3 info_col">

    }                        <div class="info_form">

                                <h4>

    // Validate phone number for e-wallet payments                                Kết Nối Với Chúng Tôi

    if ((selectedPaymentMethod === 'momo' || selectedPaymentMethod === 'zalopay')) {                            </h4>

        const phoneNumber = document.querySelector('input[name="phone_number"]').value;                            <form action="">

        if (!phoneNumber) {                                <input type="text" placeholder="Nhập Email Của Bạn" />

            e.preventDefault();                                <button type="submit">

            alert('Vui lòng nhập số điện thoại đăng ký ví điện tử');                                    Đăng Ký

            return;                                </button>

        }                            </form>

    }                            <div class="social_box">

                                    <a href="">

    // Show loading state                                    <i class="fa fa-facebook" aria-hidden="true"></i>

    const submitBtn = document.getElementById('paymentSubmit');                                </a>

    const originalText = submitBtn.innerHTML;                                <a href="">

    submitBtn.innerHTML = '<i class="fa fa-spinner fa-spin mr-2"></i>Đang xử lý...';                                    <i class="fa fa-twitter" aria-hidden="true"></i>

    submitBtn.disabled = true;                                </a>

                                    <a href="">

    // Add small delay to show loading effect                                    <i class="fa fa-linkedin" aria-hidden="true"></i>

    setTimeout(() => {                                </a>

        // Form will submit naturally                                <a href="">

    }, 1000);                                    <i class="fa fa-instagram" aria-hidden="true"></i>

});                                </a>

</script>                            </div>

@endsection                        </div>
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
