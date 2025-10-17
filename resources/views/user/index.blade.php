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
                        <ul class="navbar-nav  ">
                            <li class="nav-item active">
                                <a class="nav-link" href="{{ route('home') }}">Trang chủ <span
                                        class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.about') }}"> Giới thiệu</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.pricing') }}">Bảng giá</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.why') }}">Tại sao chọn chúng tôi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.testimonial') }}">Đánh giá khách hàng</a>
                            </li>
                        </ul>
                        <div class="user_options">
                            <a href="{{ route('login') }}" class="login_btn">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <span>Đăng nhập</span>
                            </a>
                        </div>
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
        <!-- slider section -->
        <section class="slider_section ">
            <div class="container">
                <div class="detail-box col-md-9 mx-auto px-0">
                    <h1>
                        Tìm Bãi Đỗ Xe Dễ Dàng Hơn Bao Giờ Hết
                    </h1>
                    <p>
                        Hệ thống quản lý bãi đỗ xe hiện đại của chúng tôi giúp bạn dễ dàng tìm kiếm và đặt chỗ đỗ xe
                        an toàn, thuận tiện với giá cả hợp lý. Trải nghiệm dịch vụ chuyên nghiệp và tiết kiệm thời gian
                        tối đa cho bạn.
                    </p>
                </div>
                <div class="find_form_container">
                    <form action="#">
                        <div class="form-row">
                            <div class="col-md-4 px-0">
                                <div class="form-group">
                                    <label for="">Chọn Bãi Đỗ Xe</label>
                                    <div class="input-group">
                                        <select class="form-control">
                                            <option data-display="Bãi Đỗ Xe Cao Tốc">Bãi Đỗ Xe Cao Tốc</option>
                                            <option value="1">Bãi Đỗ Xe Trung Tâm</option>
                                            <option value="2">Bãi Đỗ Xe Sân Bay</option>
                                            <option value="3">Bãi Đỗ Xe Khu Vực A</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 px-0">
                                <div class="form-group ">
                                    <label for="">Họ Và Tên</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Nguyễn Văn A" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 px-0">
                                <div class="form-group">
                                    <label for="">Số Điện Thoại</label>
                                    <div class="input-group ">
                                        <input type="text" class="form-control" placeholder="0123 456 789" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="btn-box">
                            <a href="{{ url('/dashboard') }}" class="btn-link">
                                <span>
                                    Tìm Kiếm Ngay
                                </span>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <!-- end slider section -->
    </div>

    <!-- about section -->

    <section class="about_section layout_padding">
        <div class="container  ">
            <div class="heading_container ">
                <h2>
                    Giới Thiệu Về Chúng Tôi
                </h2>
                <p>
                    Chúng tôi cung cấp dịch vụ bãi đỗ xe chất lượng cao với hệ thống quản lý hiện đại, đảm bảo an toàn và tiện lợi cho khách hàng
                </p>
            </div>
            <div class="row">
                <div class="col-lg-6 ">
                    <div class="img-box">
                        <img src="{{ asset('user/images/about-img.jpg') }}" alt="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="detail-box">
                        <h3>
                            Chúng Tôi Luôn Sẵn Sàng Hỗ Trợ
                        </h3>
                        <p>
                            Với nhiều năm kinh nghiệm trong lĩnh vực quản lý bãi đỗ xe, chúng tôi tự hào cung cấp dịch vụ
                            chất lượng cao với hệ thống bảo mật hiện đại, đảm bảo an toàn tuyệt đối cho xe của bạn.
                            Đội ngũ nhân viên chuyên nghiệp luôn sẵn sàng hỗ trợ 24/7.
                        </p>
                        <p>
                            Chúng tôi cam kết mang đến trải nghiệm dịch vụ tốt nhất với giá cả hợp lý, vị trí thuận lợi
                            và quy trình đặt chỗ đơn giản. Hãy để chúng tôi giúp bạn giải quyết nỗi lo về việc đỗ xe
                            một cách an toàn và tiện lợi nhất.
                        </p>
                        <a href="">
                            Xem Thêm
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- end about section -->

    <!-- why section -->

    <section class="why_section layout_padding-bottom">
        <div class="container">
            <div class="col-md-10 px-0">
                <div class="heading_container">
                    <h2>
                        Tại Sao Chọn Chúng Tôi
                    </h2>
                    <p>
                        Chúng tôi tự hào là đơn vị hàng đầu trong lĩnh vực cung cấp dịch vụ bãi đỗ xe với nhiều ưu điểm
                        vượt trội. Hệ thống hiện đại, dịch vụ chuyên nghiệp và cam kết mang đến sự hài lòng tuyệt đối
                        cho khách hàng là những giá trị cốt lõi của chúng tôi.
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-4 mx-auto">
                    <div class="box">
                        <div class="img-box">
                            <img src="{{ asset('user/images/w1.png') }}" alt="">
                        </div>
                        <div class="detail-box">
                            <h4>
                                Không Phí Đặt Chỗ
                            </h4>
                            <p>
                                Chúng tôi cam kết không thu thêm bất kỳ phí đặt chỗ nào. Khách hàng chỉ trả đúng giá
                                dịch vụ đỗ xe mà thôi. Điều này giúp bạn tiết kiệm chi phí và có trải nghiệm minh bạch,
                                không lo bị tính phí ẩn hay phụ phí không mong muốn.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mx-auto">
                    <div class="box">
                        <div class="img-box">
                            <img src="{{ asset('user/images/w2.png') }}" alt="">
                        </div>
                        <div class="detail-box">
                            <h4>
                                Thanh Toán Trực Tuyến
                            </h4>
                            <p>
                                Hệ thống thanh toán trực tuyến an toàn và tiện lợi với nhiều phương thức: thẻ tín dụng,
                                ví điện tử, chuyển khoản ngân hàng. Giao dịch được mã hóa bảo mật cao, đảm bảo thông tin
                                tài chính của bạn luôn được bảo vệ tuyệt đối.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mx-auto">
                    <div class="box ">
                        <div class="img-box">
                            <img src="{{ asset('user/images/w3.png') }}" alt="">
                        </div>
                        <div class="detail-box">
                            <h4>
                                Quy Trình Đặt Chỗ Đơn Giản
                            </h4>
                            <p>
                                Chỉ với 3 bước đơn giản: Chọn bãi đỗ - Nhập thông tin - Thanh toán, bạn đã có chỗ đỗ xe
                                an toàn. Giao diện thân thiện, hướng dẫn rõ ràng và xác nhận ngay lập tức giúp bạn đặt chỗ
                                nhanh chóng chỉ trong vài phút.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- end why section -->

    <!-- pricing section -->

    <section class="pricing_section layout_padding">
        <div class="bg-box">
            <img src="{{ asset('user/images/pricing-bg.jpg') }}" alt="">
        </div>
        <div class="container">
            <div class="heading_container heading_center">
                <h2>
                    Bảng Giá Dịch Vụ
                </h2>
            </div>
            <div class="col-xl-10 px-0 mx-auto">
                <div class="row">
                    <div class="col-md-6 col-lg-4 mx-auto">
                        <div class="box">
                            <h4 class="price">
                                50.000đ
                            </h4>
                            <h5 class="name">
                                Gói Cơ Bản
                            </h5>
                            <p>
                                Gói dịch vụ cơ bản dành cho khách hàng cần đỗ xe trong thời gian ngắn. Bao gồm bảo vệ
                                cơ bản, camera giám sát và hỗ trợ 24/7. Phù hợp cho việc đỗ xe hàng ngày trong khu vực
                                trung tâm thành phố.
                            </p>
                            <a href="">
                                Xem Thêm <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 mx-auto">
                        <div class="box box-center">
                            <h4 class="price">
                                150.000đ
                            </h4>
                            <h5 class="name">
                                Gói Cao Cấp
                            </h5>
                            <p>
                                Gói dịch vụ cao cấp với đầy đủ tiện ích hiện đại. Bao gồm rửa xe miễn phí, bảo dưỡng cơ bản,
                                bảo mật tối đa với hệ thống AI và dịch vụ valet parking. Lựa chọn tốt nhất cho khách hàng
                                cao cấp và xe hạng sang.
                            </p>
                            <a href="">
                                Xem Thêm <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 mx-auto">
                        <div class="box">
                            <h4 class="price">
                                100.000đ
                            </h4>
                            <h5 class="name">
                                Gói Tiêu Chuẩn
                            </h5>
                            <p>
                                Gói dịch vụ tiêu chuẩn với mức giá hợp lý. Bao gồm bảo vệ 24/7, hệ thống camera hiện đại,
                                wifi miễn phí và dịch vụ hỗ trợ khách hàng tận tình. Phù hợp cho hầu hết các loại xe và
                                nhu cầu đỗ xe thường xuyên.
                            </p>
                            <a href="">
                                Xem Thêm <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- end pricing section -->


    <!-- client section -->

    <section class="client_section layout_padding">
        <div class="container">
            <div class="heading_container col">
                <h2>
                    Khách Hàng Nói Gì Về <span>Chúng Tôi</span>
                </h2>
            </div>
            <div class="client_container">
                <div class="carousel-wrap ">
                    <div class="owl-carousel client_owl-carousel">
                        <div class="item">
                            <div class="box">
                                <div class="detail-box">
                                    <p>
                                        Tôi đã sử dụng dịch vụ bãi đỗ xe này được 6 tháng và rất hài lòng. Hệ thống bảo mật
                                        tốt, nhân viên thân thiện và giá cả hợp lý. Xe của tôi luôn được giữ an toàn và sạch sẽ.
                                        Tôi chắc chắn sẽ tiếp tục sử dụng dịch vụ này và giới thiệu cho bạn bè.
                                    </p>
                                </div>
                                <div class="client_id">
                                    <div class="img-box">
                                        <img src="{{ asset('user/images/c1.jpg') }}" alt="" class="img-1">
                                    </div>
                                    <div class="name">
                                        <h6>
                                            Nguyễn Thị Lan
                                        </h6>
                                        <p>
                                            Khách hàng VIP
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="box">
                                <div class="detail-box">
                                    <p>
                                        Dịch vụ tuyệt vời! Tôi làm việc trong khu vực trung tâm và cần đỗ xe hàng ngày.
                                        Bãi đỗ xe này có vị trí thuận lợi, giá cả phù hợp và đặc biệt là rất an toàn.
                                        Hệ thống đặt chỗ online rất tiện lợi. Tôi rất recommend cho mọi người!
                                    </p>
                                </div>
                                <div class="client_id">
                                    <div class="img-box">
                                        <img src="{{ asset('user/images/c2.jpg') }}" alt="" class="img-1">
                                    </div>
                                    <div class="name">
                                        <h6>
                                            Trần Văn Minh
                                        </h6>
                                        <p>
                                            Khách hàng thân thiết
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- end client section -->

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
    <!-- footer section -->

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
