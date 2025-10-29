<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="shortcut icon" href="{{ asset('user/images/favicon.png') }}" type="image/x-icon">
    <title>Thanh toán thành công - Paspark</title>
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
        <div class="alert alert-success d-flex align-items-center" role="alert">
            <i class="fa fa-check-circle mr-2"></i>
            <div>Thanh toán thành công!</div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0">Chi tiết thanh toán</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p class="mb-2"><strong>Mã giao dịch:</strong> {{ $payment->transaction_id }}</p>
                        <p class="mb-2"><strong>Số tiền:</strong> {{ number_format((float)$payment->amount, 0, ',', '.') }}đ</p>
                        <p class="mb-2"><strong>Trạng thái:</strong> <span class="badge badge-success">Hoàn tất</span></p>
                        <p class="mb-2"><strong>Thanh toán lúc:</strong> {{ optional($payment->paid_at)->format('d/m/Y H:i') }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-2"><strong>Bãi đỗ xe:</strong> {{ $payment->booking->parkingLot->name ?? '-' }}</p>
                        <p class="mb-2"><strong>Mã đặt chỗ:</strong> {{ $payment->booking->booking_code ?? $payment->booking->id }}</p>
                        <p class="mb-2"><strong>Thời gian:</strong>
                            @if($payment->booking->start_time && $payment->booking->end_time)
                                {{ $payment->booking->start_time->format('d/m/Y H:i') }} - {{ $payment->booking->end_time->format('d/m/Y H:i') }}
                            @else
                                -
                            @endif
                        </p>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="{{ route('user.booking.show', $payment->booking->id) }}" class="btn btn-primary mr-2">
                        <i class="fa fa-ticket"></i> Xem đặt chỗ
                    </a>
                    <a href="{{ route('user.history') }}" class="btn btn-outline-secondary">
                        <i class="fa fa-history"></i> Lịch sử đặt chỗ
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
