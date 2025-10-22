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
                                <a class="nav-link" href="{{ url('/dashboard') }}">Lịch sử<span
                                        class="sr-only">(current)</span> </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.reviews') }}">Đánh giá</a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.pricing') }}">Gói dịch vụ</a>
                            </li> --}}
                        </ul>
                        <div class="navbar-nav ml-auto">
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
                        </div>
                    </div>
                </nav>
            </div>
        </header>
        <!-- end header section -->
    </div>

    <!-- History Section -->
    <section class="history_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>Lịch sử đặt chỗ</h2>
                <p>Xem và quản lý các lần đỗ xe của bạn</p>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="history_table_container">
                        <div class="table-responsive">
                            <table class="table table-hover" id="historyTable">
                                <thead>
                                    <tr>
                                        <th>Mã đặt chỗ</th>
                                        <th>Bãi đỗ xe</th>
                                        <th>Thời gian</th>
                                        <th>Biển số xe</th>
                                        <th>Tổng phí</th>
                                        <th>Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($bookings as $booking)
                                    <tr>
                                        <td><strong>{{ $booking->booking_code }}</strong></td>
                                        <td>
                                            <strong>{{ $booking->parkingLot->name ?? '' }}</strong><br>
                                            <small class="text-muted">{{ $booking->parkingLot->address ?? '' }}</small>
                                        </td>
                                        <td>
                                            <div><i class="fa fa-calendar"></i> {{ $booking->start_time->format('d/m/Y H:i') }}</div>
                                            <div><i class="fa fa-calendar"></i> {{ $booking->end_time->format('d/m/Y H:i') }}</div>
                                        </td>
                                        <td>{{ $booking->license_plate }}</td>
                                        <td><strong>{{ number_format($booking->total_cost, 0, ',', '.') }}đ</strong></td>
                                        <td>
                                            @if($booking->status === 'completed')
                                                <span class="status-badge status-completed">Đã hoàn thành</span>
                                            @elseif($booking->status === 'cancelled')
                                                <span class="status-badge status-cancelled">Đã hủy</span>
                                            @elseif($booking->status === 'pending')
                                                <span class="status-badge status-pending">Chờ xác nhận</span>
                                            @else
                                                <span class="status-badge status-active">Đang hoạt động</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-5">
                                            <i class="fa fa-exclamation-circle fa-2x text-muted"></i>
                                            <p class="mt-3">Không có dữ liệu</p>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End History Section -->

    <!-- Booking Detail Modal -->
    <div class="modal fade" id="bookingDetailModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Chi tiết đặt chỗ</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="bookingDetailContent">
                    <!-- Content will be loaded dynamically -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-danger" id="cancelBookingBtn" style="display: none;">
                        <i class="fa fa-times"></i> Hủy đặt chỗ
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom Styles for History Page -->
    <style>
        .stat_card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.08);
            text-align: center;
            transition: transform 0.3s;
        }

        .stat_card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 25px rgba(0,0,0,0.15);
        }

        .stat_icon {
            font-size: 40px;
            color: #ffbe33;
            margin-bottom: 15px;
        }

        .stat_content h4 {
            font-size: 32px;
            font-weight: 700;
            color: #252525;
            margin-bottom: 5px;
        }

        .stat_content p {
            color: #666;
            margin: 0;
        }

        .filter_section {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.08);
        }

        .filter_section label {
            font-weight: 600;
            margin-bottom: 5px;
            display: block;
        }

        .history_table_container {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.08);
        }

        .table thead th {
            background: #ffbe33;
            color: white;
            border: none;
            font-weight: 600;
            padding: 15px;
        }

        .table tbody td {
            padding: 15px;
            vertical-align: middle;
        }

        .status-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-completed {
            background: #28a745;
            color: white;
        }

        .status-active {
            background: #007bff;
            color: white;
        }

        .status-cancelled {
            background: #dc3545;
            color: white;
        }

        .status-pending {
            background: #ffc107;
            color: #333;
        }

        .action-buttons {
            display: flex;
            gap: 5px;
        }

        .action-buttons .btn {
            padding: 5px 10px;
            font-size: 13px;
        }
    </style>

    <!-- JavaScript for History Functionality -->
    <script>
        let bookingsHistory = [];
        let filteredBookings = [];
        let currentHistoryPage = 1;
        const historyItemsPerPage = 10;

        // Load bookings history on page load
        document.addEventListener('DOMContentLoaded', function() {
            loadBookingsHistory();
        });

        async function loadBookingsHistory() {
            try {
                // Gọi API để lấy dữ liệu thực từ database
                const response = await fetch('/user/api/bookings');

                if (!response.ok) {
                    throw new Error('Failed to load bookings history');
                }

                bookingsHistory = await response.json();
                filteredBookings = [...bookingsHistory];
                updateStatistics();
                displayBookingsHistory();
            } catch (error) {
                console.error('Error loading bookings:', error);
                // Hiển thị thông báo lỗi
                const tbody = document.getElementById('historyTableBody');
                tbody.innerHTML = `
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <i class="fa fa-exclamation-triangle fa-2x text-danger"></i>
                            <p class="mt-3 text-danger">Không thể tải lịch sử đặt chỗ. Vui lòng thử lại sau!</p>
                            <button class="btn btn-primary mt-2" onclick="loadBookingsHistory()">Thử lại</button>
                        </td>
                    </tr>
                `;
            }
        }

        function updateStatistics() {
            const completed = bookingsHistory.filter(b => b.status === 'completed').length;
            const active = bookingsHistory.filter(b => b.status === 'active').length;
            const cancelled = bookingsHistory.filter(b => b.status === 'cancelled').length;
            const totalSpent = bookingsHistory
                .filter(b => b.payment_status === 'paid')
                .reduce((sum, b) => sum + b.total_fee, 0);

            document.getElementById('completedBookings').textContent = completed;
            document.getElementById('activeBookings').textContent = active;
            document.getElementById('cancelledBookings').textContent = cancelled;
            document.getElementById('totalSpent').textContent = totalSpent.toLocaleString('vi-VN') + 'đ';
        }

        function displayBookingsHistory() {
            const tbody = document.getElementById('historyTableBody');
            tbody.innerHTML = '';

            if (filteredBookings.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <i class="fa fa-exclamation-circle fa-2x text-muted"></i>
                            <p class="mt-3">Không có dữ liệu</p>
                        </td>
                    </tr>
                `;
                return;
            }

            const start = (currentHistoryPage - 1) * historyItemsPerPage;
            const end = start + historyItemsPerPage;
            const pageBookings = filteredBookings.slice(start, end);

            pageBookings.forEach(booking => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td><strong>${booking.id}</strong></td>
                    <td>
                        <strong>${booking.parking_lot}</strong><br>
                        <small class="text-muted">${booking.address}</small>
                    </td>
                    <td>
                        <div><i class="fa fa-calendar"></i> ${formatDateTime(booking.start_time)}</div>
                        <div><i class="fa fa-calendar"></i> ${formatDateTime(booking.end_time)}</div>
                    </td>
                    <td>${booking.vehicle_number}</td>
                    <td><strong>${booking.total_fee.toLocaleString('vi-VN')}đ</strong></td>
                    <td>${getStatusBadge(booking.status)}</td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn btn-sm btn-info" onclick="viewBookingDetail('${booking.id}')">
                                <i class="fa fa-eye"></i> Chi tiết
                            </button>
                            ${booking.status === 'active' || booking.status === 'pending' ?
                                `<button class="btn btn-sm btn-danger" onclick="cancelBooking('${booking.id}')">
                                    <i class="fa fa-times"></i> Hủy
                                </button>` : ''}
                        </div>
                    </td>
                `;
                tbody.appendChild(tr);
            });

            renderHistoryPagination();
        }

        function getStatusBadge(status) {
            const statusMap = {
                'completed': { text: 'Đã hoàn thành', class: 'status-completed' },
                'active': { text: 'Đang hoạt động', class: 'status-active' },
                'cancelled': { text: 'Đã hủy', class: 'status-cancelled' },
                'pending': { text: 'Chờ xác nhận', class: 'status-pending' }
            };

            const statusInfo = statusMap[status] || { text: status, class: '' };
            return `<span class="status-badge ${statusInfo.class}">${statusInfo.text}</span>`;
        }

        function formatDateTime(dateTimeString) {
            const date = new Date(dateTimeString);
            const day = String(date.getDate()).padStart(2, '0');
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const year = date.getFullYear();
            const hours = String(date.getHours()).padStart(2, '0');
            const minutes = String(date.getMinutes()).padStart(2, '0');
            return `${day}/${month}/${year} ${hours}:${minutes}`;
        }

        function filterHistory() {
            const statusFilter = document.getElementById('statusFilter').value;
            const dateFrom = document.getElementById('dateFrom').value;
            const dateTo = document.getElementById('dateTo').value;

            filteredBookings = bookingsHistory.filter(booking => {
                let matches = true;

                if (statusFilter && booking.status !== statusFilter) {
                    matches = false;
                }

                if (dateFrom) {
                    const bookingDate = new Date(booking.start_time);
                    const filterDate = new Date(dateFrom);
                    if (bookingDate < filterDate) {
                        matches = false;
                    }
                }

                if (dateTo) {
                    const bookingDate = new Date(booking.start_time);
                    const filterDate = new Date(dateTo);
                    if (bookingDate > filterDate) {
                        matches = false;
                    }
                }

                return matches;
            });

            currentHistoryPage = 1;
            displayBookingsHistory();
        }

        function resetHistoryFilters() {
            document.getElementById('historyFilterForm').reset();
            filteredBookings = [...bookingsHistory];
            currentHistoryPage = 1;
            displayBookingsHistory();
        }

        function viewBookingDetail(bookingId) {
            const booking = bookingsHistory.find(b => b.id === bookingId);
            if (!booking) return;

            const content = `
                <div class="booking-detail">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6>Mã đặt chỗ</h6>
                            <p><strong>${booking.id}</strong></p>
                        </div>
                        <div class="col-md-6">
                            <h6>Trạng thái</h6>
                            <p>${getStatusBadge(booking.status)}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <h6>Bãi đỗ xe</h6>
                            <p><strong>${booking.parking_lot}</strong><br>${booking.address}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6>Thời gian bắt đầu</h6>
                            <p>${formatDateTime(booking.start_time)}</p>
                        </div>
                        <div class="col-md-6">
                            <h6>Thời gian kết thúc</h6>
                            <p>${formatDateTime(booking.end_time)}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6>Biển số xe</h6>
                            <p>${booking.vehicle_number}</p>
                        </div>
                        <div class="col-md-6">
                            <h6>Loại xe</h6>
                            <p>${booking.vehicle_type === 'car' ? 'Ô tô' : 'Xe máy'}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6>Tổng phí</h6>
                            <p><strong style="color: #ffbe33; font-size: 20px;">${booking.total_fee.toLocaleString('vi-VN')}đ</strong></p>
                        </div>
                        <div class="col-md-6">
                            <h6>Trạng thái thanh toán</h6>
                            <p>${booking.payment_status === 'paid' ? '<span class="badge badge-success">Đã thanh toán</span>' : '<span class="badge badge-warning">Chưa thanh toán</span>'}</p>
                        </div>
                    </div>
                </div>
            `;

            document.getElementById('bookingDetailContent').innerHTML = content;

            const cancelBtn = document.getElementById('cancelBookingBtn');
            if (booking.status === 'active' || booking.status === 'pending') {
                cancelBtn.style.display = 'inline-block';
                cancelBtn.onclick = () => cancelBooking(bookingId);
            } else {
                cancelBtn.style.display = 'none';
            }

            $('#bookingDetailModal').modal('show');
        }

        function cancelBooking(bookingId) {
            if (confirm('Bạn có chắc chắn muốn hủy đặt chỗ này?')) {
                // Implement cancel booking API call
                alert('Chức năng hủy đặt chỗ đang được phát triển');
                $('#bookingDetailModal').modal('hide');
            }
        }

        function renderHistoryPagination() {
            const totalPages = Math.ceil(filteredBookings.length / historyItemsPerPage);
            const pagination = document.getElementById('historyPagination');

            if (totalPages <= 1) {
                pagination.innerHTML = '';
                return;
            }

            let html = '<nav><ul class="pagination justify-content-center">';

            for (let i = 1; i <= totalPages; i++) {
                html += `<li class="page-item ${i === currentHistoryPage ? 'active' : ''}">
                    <a class="page-link" href="#" onclick="goToHistoryPage(${i}); return false;">${i}</a>
                </li>`;
            }

            html += '</ul></nav>';
            pagination.innerHTML = html;
        }

        function goToHistoryPage(page) {
            currentHistoryPage = page;
            displayBookingsHistory();
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
    <!-- history js -->
    <script src="{{ asset('user/js/history.js') }}"></script>

</body>

</html>
