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
    <!-- login page style -->
    <link href="{{ asset('user/css/login.css') }}" rel="stylesheet" />
    <!-- loading screen style -->
    <link href="{{ asset('user/css/loading.css') }}" rel="stylesheet" />

    <!-- Animate CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

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
                                <a class="nav-link" href="{{ url('/about') }}">Giới thiệu</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/pricing') }}">Bảng giá</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/why') }}">Tại sao chọn chúng tôi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/testimonial') }}">Đánh giá khách hàng</a>
                            </li>
                             <li class="nav-item active">
                                <a class="nav-link" href="{{ url('/login') }}">Đăng nhập <span
                                        class="sr-only">(current)</span> </a>
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

    <!-- about login -->

    <section class="login_section">
        <div class="container">
            <div class="login_container">
                <div class="row no-gutters">
                    <div class="col-lg-6">
                        <div class="login_left animate__animated animate__fadeInLeft">
                            <div>
                                <h2 class="login_title">Chào Mừng Trở Lại!</h2>
                                <p class="login_subtitle">
                                    Đăng nhập để quản lý chỗ đỗ xe của bạn và trải nghiệm dịch vụ bãi đỗ xe hiện đại,
                                    an toàn và tiện lợi nhất.
                                </p>
                                <div class="mt-4">
                                    <i class="fa fa-car fa-3x mb-3"></i>
                                    <p>Hệ thống quản lý bãi đỗ xe thông minh</p>
                                </div>
                                <a href="{{ url('/register') }}" class="register_link">Tạo Tài Khoản Mới</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="login_right animate__animated animate__fadeInRight">
                            <h3 class="form_title">Đăng Nhập</h3>
                            <form action="{{ route('login.post') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" placeholder="Email hoặc Tên đăng nhập"
                                        required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        name="password" placeholder="Mật khẩu" required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="checkbox_container">
                                    <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label for="remember">Ghi nhớ đăng nhập</label>
                                </div>

                                <button type="submit" class="btn_login">
                                    <i class="fa fa-sign-in mr-2"></i>
                                    Đăng Nhập
                                </button>

                                <a href="#" class="forgot_password">
                                    Quên mật khẩu?
                                </a>
                            </form>

                            <div class="text-center mt-4">
                                <p class="text-muted">
                                    Chưa có tài khoản?
                                    <a href="{{ route('register') }}" style="color: #ff6f3c; font-weight: 600;">
                                        Đăng ký ngay
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('user/js/bootstrap.js') }}"></script>

    <script>
        // Add some interactive effects
        $(document).ready(function () {
            // Focus effects with smooth transitions
            $('.form-control').on('focus', function () {
                $(this).parent().addClass('focused');
                $(this).addClass('animate__animated animate__fadeIn');
            });

            $('.form-control').on('blur', function () {
                if ($(this).val() === '') {
                    $(this).parent().removeClass('focused');
                }
                $(this).removeClass('animate__animated animate__fadeIn');
            });

            // Button click effect with improved animation
            $('.btn_login').on('click', function (e) {
                const $btn = $(this);

                // Remove any existing animation classes
                $btn.removeClass('animate__animated animate__pulse animate__heartBeat');

                // Add pulse animation
                $btn.addClass('animate__animated animate__pulse');

                // Add loading state
                const originalText = $btn.html();
                $btn.html('<i class="fa fa-spinner fa-spin mr-2"></i>Đang xử lý...');

                // Remove animation and restore text after delay
                setTimeout(() => {
                    $btn.removeClass('animate__animated animate__pulse');
                    $btn.addClass('animate__animated animate__heartBeat');

                    setTimeout(() => {
                        $btn.removeClass('animate__animated animate__heartBeat');
                        $btn.html(originalText);
                    }, 600);
                }, 300);
            });

            // Add hover effects for form controls
            $('.form-control').hover(
                function() {
                    $(this).addClass('animate__animated animate__fadeIn');
                },
                function() {
                    $(this).removeClass('animate__animated animate__fadeIn');
                }
            );

            // Add entrance animations
            $('.login_left').addClass('animate__animated animate__fadeInLeft');
            $('.login_right').addClass('animate__animated animate__fadeInRight');

             // Set animation delays for staggered effect
            $('.login_right').css('animation-delay', '0.2s');
            $('.login_left').css('animation-delay', '0.4s');

            // Staggered animation for form fields - từ trong ra ngoài
            $('.form-group').each(function(index) {
                $(this).css('animation-delay', (0.8 + index * 0.15) + 's');
                $(this).addClass('animate__animated animate__fadeInUp');
            });

            // Animation cho title và button
            $('.form_title').css('animation-delay', '0.6s').addClass('animate__animated animate__fadeInDown');
            $('.btn_login').css('animation-delay', '1.5s').addClass('animate__animated animate__zoomIn');
            $('.text-center').css('animation-delay', '1.7s').addClass('animate__animated animate__fadeIn');

            // Animation cho content panel elements
            $('.login_title').css('animation-delay', '0.6s').addClass('animate__animated animate__fadeInDown');
            $('.login_subtitle').css('animation-delay', '0.8s').addClass('animate__animated animate__fadeInUp');
            $('.fa-users').parent().css('animation-delay', '1.0s').addClass('animate__animated animate__zoomIn');
            $('.register_link').css('animation-delay', '1.2s').addClass('animate__animated animate__fadeInUp');
        });
    </script>

    <!-- end about login -->

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
