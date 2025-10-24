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
                            <li class="nav-item active">
                                <a class="nav-link" href="{{ route('user.reviews') }}">Đánh giá <span class="sr-only">(current)</span></a>
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

    <!-- Reviews Section -->
    <section class="reviews_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>Đánh giá của tôi</h2>
                <p>Quản lý các đánh giá và phản hồi của bạn</p>
            </div>

            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa fa-check-circle"></i> {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
            </div>
            @endif

            <div class="row">
                <!-- Reviews List -->
                <div class="col-lg-8">
                    <!-- Stats Overview -->
                    <div class="review_stats mb-4">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="stat_box">
                                    <i class="fa fa-comments"></i>
                                    <div>
                                        <h4 id="totalReviews">5</h4>
                                        <p>Tổng đánh giá</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="stat_box">
                                    <i class="fa fa-star"></i>
                                    <div>
                                        <h4 id="avgRating">4.6</h4>
                                        <p>Đánh giá trung bình</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="stat_box">
                                    <i class="fa fa-clock-o"></i>
                                    <div>
                                        <h4 id="pendingReviews">2</h4>
                                        <p>Chờ đánh giá</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Filter Tabs -->
                    <div class="review_tabs mb-3">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#myReviews">
                                    Đánh giá của tôi
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#pendingReviews">
                                    Chưa đánh giá
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="tab-content">
                        <!-- My Reviews Tab -->
                        <div class="tab-pane fade show active" id="myReviews">
                            <div class="reviews_container">
                                <!-- Review Item -->
                                <div class="my_review_item">
                                    <div class="review_header">
                                        <div>
                                            <h5>Bãi đỗ xe Vincom Center</h5>
                                            <p class="text-muted small">
                                                <i class="fa fa-calendar"></i> 15/10/2025
                                            </p>
                                        </div>
                                        <div class="review_actions">
                                            <button class="btn btn-sm btn-primary" onclick="editReview(1)">
                                                <i class="fa fa-edit"></i> Sửa
                                            </button>
                                            <button class="btn btn-sm btn-danger" onclick="deleteReview(1)">
                                                <i class="fa fa-trash"></i> Xóa
                                            </button>
                                        </div>
                                    </div>
                                    <div class="review_rating mb-2">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <p class="review_content">
                                        Bãi đỗ xe rất rộng rãi và sạch sẽ. Nhân viên nhiệt tình, giá cả hợp lý.
                                        Tôi rất hài lòng với dịch vụ ở đây và sẽ quay lại trong tương lai!
                                    </p>
                                </div>

                                <!-- Review Item -->
                                <div class="my_review_item">
                                    <div class="review_header">
                                        <div>
                                            <h5>Bãi đỗ xe Big C</h5>
                                            <p class="text-muted small">
                                                <i class="fa fa-calendar"></i> 12/10/2025
                                            </p>
                                        </div>
                                        <div class="review_actions">
                                            <button class="btn btn-sm btn-primary" onclick="editReview(2)">
                                                <i class="fa fa-edit"></i> Sửa
                                            </button>
                                            <button class="btn btn-sm btn-danger" onclick="deleteReview(2)">
                                                <i class="fa fa-trash"></i> Xóa
                                            </button>
                                        </div>
                                    </div>
                                    <div class="review_rating mb-2">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                    </div>
                                    <p class="review_content">
                                        Vị trí thuận tiện, gần trung tâm. Camera an ninh đầy đủ.
                                        Chỉ có điều giờ cao điểm hơi đông một chút.
                                    </p>
                                </div>

                                <!-- Review Item -->
                                <div class="my_review_item">
                                    <div class="review_header">
                                        <div>
                                            <h5>Bãi đỗ xe Lotte Mart</h5>
                                            <p class="text-muted small">
                                                <i class="fa fa-calendar"></i> 08/10/2025
                                            </p>
                                        </div>
                                        <div class="review_actions">
                                            <button class="btn btn-sm btn-primary" onclick="editReview(3)">
                                                <i class="fa fa-edit"></i> Sửa
                                            </button>
                                            <button class="btn btn-sm btn-danger" onclick="deleteReview(3)">
                                                <i class="fa fa-trash"></i> Xóa
                                            </button>
                                        </div>
                                    </div>
                                    <div class="review_rating mb-2">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <p class="review_content">
                                        Tuyệt vời! Bãi đỗ xe hiện đại, an toàn. Sẽ quay lại lần sau.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Reviews Tab -->
                        <div class="tab-pane fade" id="pendingReviews">
                            <div class="pending_reviews_container">
                                <!-- Pending Review Item -->
                                <div class="pending_review_item">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <div>
                                            <h5>Bãi đỗ xe Aeon Mall</h5>
                                            <p class="text-muted small">
                                                <i class="fa fa-calendar"></i> Đã đỗ xe: 16/10/2025
                                            </p>
                                        </div>
                                        <span class="badge badge-warning">Chờ đánh giá</span>
                                    </div>
                                    <p class="text-muted mb-3">
                                        Bạn đã sử dụng dịch vụ tại bãi đỗ xe này. Hãy chia sẻ trải nghiệm của bạn!
                                    </p>
                                    <button class="btn btn_box" onclick="showReviewForm('Bãi đỗ xe Aeon Mall')">
                                        <i class="fa fa-star"></i> Viết đánh giá
                                    </button>
                                </div>

                                <!-- Pending Review Item -->
                                <div class="pending_review_item">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <div>
                                            <h5>Bãi đỗ xe SC VivoCity</h5>
                                            <p class="text-muted small">
                                                <i class="fa fa-calendar"></i> Đã đỗ xe: 14/10/2025
                                            </p>
                                        </div>
                                        <span class="badge badge-warning">Chờ đánh giá</span>
                                    </div>
                                    <p class="text-muted mb-3">
                                        Bạn đã sử dụng dịch vụ tại bãi đỗ xe này. Hãy chia sẻ trải nghiệm của bạn!
                                    </p>
                                    <button class="btn btn_box" onclick="showReviewForm('Bãi đỗ xe SC VivoCity')">
                                        <i class="fa fa-star"></i> Viết đánh giá
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Review Form Sidebar -->
                <div class="col-lg-4">
                    <div class="review_form_card">
                        <h4 class="mb-3">
                            <i class="fa fa-edit"></i> Viết đánh giá mới
                        </h4>

                        <form id="reviewForm" method="POST" action="{{ route('user.reviews.store') }}">
                            @csrf
                            <input type="hidden" name="booking_id" id="reviewBookingId">

                            <div class="form-group">
                                <label>Bãi đỗ xe</label>
                                <input type="text" class="form-control" id="reviewParkingLot" readonly>
                            </div>

                            <div class="form-group">
                                <label>Đánh giá *</label>
                                <div class="star_rating_input">
                                    <input type="radio" name="rating" id="star5" value="5">
                                    <label for="star5"><i class="fa fa-star"></i></label>

                                    <input type="radio" name="rating" id="star4" value="4">
                                    <label for="star4"><i class="fa fa-star"></i></label>

                                    <input type="radio" name="rating" id="star3" value="3">
                                    <label for="star3"><i class="fa fa-star"></i></label>

                                    <input type="radio" name="rating" id="star2" value="2">
                                    <label for="star2"><i class="fa fa-star"></i></label>

                                    <input type="radio" name="rating" id="star1" value="1">
                                    <label for="star1"><i class="fa fa-star"></i></label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Tiêu đề đánh giá *</label>
                                <input type="text" class="form-control" name="title"
                                    placeholder="Tóm tắt trải nghiệm của bạn" required>
                            </div>

                            <div class="form-group">
                                <label>Nội dung đánh giá *</label>
                                <textarea class="form-control" name="comment" rows="5"
                                    placeholder="Chia sẻ chi tiết về trải nghiệm của bạn..." required></textarea>
                                <small class="text-muted">Tối thiểu 20 ký tự</small>
                            </div>

                            <button type="submit" class="btn btn-warning btn_box w-100">
                                <i class="fa fa-paper-plane"></i> Gửi đánh giá
                            </button>
                        </form>
                    </div>

                    <!-- Review Guidelines -->
                    <div class="review_guidelines mt-4">
                        <h5>
                            <i class="fa fa-info-circle"></i> Hướng dẫn đánh giá
                        </h5>
                        <ul>
                            <li>Hãy trung thực và khách quan</li>
                            <li>Chia sẻ trải nghiệm cụ thể</li>
                            <li>Tôn trọng người khác</li>
                            <li>Không sử dụng ngôn từ thô tục</li>
                            <li>Không spam hoặc quảng cáo</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Reviews Section -->

    <!-- Edit Review Modal -->
    <div class="modal fade" id="editReviewModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Chỉnh sửa đánh giá</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editReviewForm">
                        <input type="hidden" id="editReviewId">

                        <div class="form-group">
                            <label>Đánh giá *</label>
                            <div class="star_rating_input">
                                <input type="radio" name="edit_rating" id="edit_star5" value="5">
                                <label for="edit_star5"><i class="fa fa-star"></i></label>

                                <input type="radio" name="edit_rating" id="edit_star4" value="4">
                                <label for="edit_star4"><i class="fa fa-star"></i></label>

                                <input type="radio" name="edit_rating" id="edit_star3" value="3">
                                <label for="edit_star3"><i class="fa fa-star"></i></label>

                                <input type="radio" name="edit_rating" id="edit_star2" value="2">
                                <label for="edit_star2"><i class="fa fa-star"></i></label>

                                <input type="radio" name="edit_rating" id="edit_star1" value="1">
                                <label for="edit_star1"><i class="fa fa-star"></i></label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Nội dung đánh giá *</label>
                            <textarea class="form-control" id="editReviewContent" rows="5" required></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn_box" onclick="saveEditReview()">
                        <i class="fa fa-save"></i> Lưu thay đổi
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom Styles -->
    <style>
        .review_stats .stat_box {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.08);
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .stat_box i {
            font-size: 40px;
            color: #ffbe33;
        }

        .stat_box h4 {
            font-size: 32px;
            font-weight: 700;
            margin: 0;
        }

        .review_tabs .nav-tabs {
            border-bottom: 2px solid #ffbe33;
        }

        .review_tabs .nav-link {
            color: #666;
            font-weight: 600;
        }

        .review_tabs .nav-link.active {
            color: #ffbe33;
            border-color: #ffbe33 #ffbe33 transparent;
        }

        .my_review_item {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.08);
            margin-bottom: 20px;
        }

        .review_header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 15px;
        }

        .review_header h5 {
            color: #252525;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .review_rating .fa-star {
            color: #ffbe33;
            font-size: 18px;
        }

        .review_content {
            color: #666;
            line-height: 1.6;
        }

        .review_actions {
            display: flex;
            gap: 10px;
        }

        .pending_review_item {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.08);
            margin-bottom: 20px;
        }

        .review_form_card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }

        .review_form_card h4 {
            color: #252525;
            font-weight: 700;
            padding-bottom: 10px;
            border-bottom: 2px solid #ffbe33;
        }

        .star_rating_input {
            display: flex;
            flex-direction: row-reverse;
            justify-content: flex-end;
            gap: 5px;
        }

        .star_rating_input input[type="radio"] {
            display: none;
        }

        .star_rating_input label {
            cursor: pointer;
            font-size: 30px;
            color: #ddd;
            transition: color 0.2s;
        }

        .star_rating_input input[type="radio"]:checked ~ label,
        .star_rating_input label:hover,
        .star_rating_input label:hover ~ label {
            color: #ffbe33;
        }

        .review_guidelines {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.08);
        }

        .review_guidelines h5 {
            color: #252525;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .review_guidelines ul {
            padding-left: 20px;
            color: #666;
        }

        .review_guidelines li {
            margin-bottom: 8px;
        }
    </style>

    <!-- JavaScript -->
    <script>
        function showReviewForm(parkingLotName) {
            document.getElementById('reviewParkingLot').value = parkingLotName;
            document.getElementById('reviewForm').scrollIntoView({ behavior: 'smooth' });
        }

        function editReview(reviewId) {
            // Load review data and show modal
            $('#editReviewModal').modal('show');
            document.getElementById('editReviewId').value = reviewId;

            // Load existing review data here
            // This is a placeholder - implement actual data loading
        }

        function saveEditReview() {
            const reviewId = document.getElementById('editReviewId').value;
            const content = document.getElementById('editReviewContent').value;

            // Implement save logic here
            alert('Đánh giá đã được cập nhật!');
            $('#editReviewModal').modal('hide');
        }

        function deleteReview(reviewId) {
            if (confirm('Bạn có chắc chắn muốn xóa đánh giá này?')) {
                // Implement delete logic here
                alert('Đánh giá đã được xóa!');
                location.reload();
            }
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

</body>

</html>
