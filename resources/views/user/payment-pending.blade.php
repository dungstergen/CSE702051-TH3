<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="shortcut icon" href="{{ asset('user/images/favicon.png') }}" type="image/x-icon">
    <title>Chờ xác nhận thanh toán - Paspark</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('user/css/bootstrap.css') }}" />
    <link href="{{ asset('user/css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('user/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('user/css/responsive.css') }}" rel="stylesheet" />
</head>
<body class="sub_page">
<div class="hero_area">
    <div class="bg-box">
        <img src="{{ asset('user/images/slider-bg.jpg') }}" alt="">
    </div>
    <header class="header_section">
        <div class="container">
            <nav class="navbar navbar-expand-lg custom_nav-container ">
                <a class="navbar-brand" href="{{ route('home') }}"><span>Paspark</span></a>
            </nav>
        </div>
    </header>
</div>

<section class="layout_padding">
    <div class="container">
        <div class="alert alert-info d-flex align-items-center" role="alert">
            <i class="fa fa-clock-o mr-2"></i>
            <div>Vui lòng hoàn tất chuyển khoản và chờ hệ thống xác nhận.</div>
        </div>

        <div class="card shadow-sm mb-3">
            <div class="card-header bg-white">
                <h5 class="mb-0">Thông tin giao dịch</h5>
            </div>
            <div class="card-body">
                <p class="mb-2"><strong>Mã giao dịch:</strong> {{ $payment->transaction_id }}</p>
                <p class="mb-2"><strong>Số tiền:</strong> {{ number_format((float)$payment->amount, 0, ',', '.') }}đ</p>
                <p class="mb-2"><strong>Trạng thái:</strong> <span class="badge badge-warning">Đang chờ</span></p>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0">Hướng dẫn chuyển khoản</h5>
            </div>
            <div class="card-body">
                <div class="alert alert-light">
                    <p class="mb-2"><strong>Ngân hàng:</strong> Vietcombank</p>
                    <p class="mb-2"><strong>Số tài khoản:</strong> 1234567890</p>
                    <p class="mb-2"><strong>Chủ tài khoản:</strong> CONG TY PASPARK</p>
                    <p class="mb-2"><strong>Nội dung chuyển khoản:</strong> {{ $payment->transaction_id }}</p>
                </div>
                <div class="mt-2">
                    <a href="{{ route('user.booking.show', $payment->booking->id) }}" class="btn btn-outline-secondary mr-2">
                        <i class="fa fa-ticket"></i> Xem đặt chỗ
                    </a>
                    <a href="{{ route('user.history') }}" class="btn btn-primary">
                        <i class="fa fa-history"></i> Về lịch sử đặt chỗ
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="{{ asset('user/js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('user/js/bootstrap.js') }}"></script>
</body>
</html>
