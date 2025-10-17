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

    <title>Đặt chỗ đỗ xe - Paspark</title>

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
                            <li class="nav-item active">
                                <a class="nav-link" href="{{ route('user.booking') }}">Đặt chỗ <span class="sr-only">(current)</span></a>
                            </li>
                            @auth
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.history') }}">Lịch sử</a>
                            </li>
                            @endauth
                            {{-- <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.pricing') }}">Gói dịch vụ</a>
                            </li> --}}
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

    <!-- Booking section -->
    <section class="booking_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>
                    <i class="fa fa-car mr-2"></i>
                    Đặt chỗ đỗ xe
                </h2>
                <p>
                    Chọn bãi đỗ xe phù hợp với bạn
                </p>
            </div>

    @if($recentBookings->count() > 0)
    <div class="row mb-5">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5><i class="fa fa-clock-o mr-2"></i>Đặt lại chỗ gần đây</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($recentBookings as $recent)
                        <div class="col-md-4">
                            <div class="recent-booking" onclick="rebookPrevious({{ $recent->id }})">
                                <h6>{{ $recent->parkingLot->name }}</h6>
                                <p class="mb-1"><i class="fa fa-map-marker mr-1"></i>{{ Str::limit($recent->parkingLot->address, 40) }}</p>
                                <p class="mb-1"><i class="fa fa-car mr-1"></i>{{ $recent->license_plate }} ({{ ucfirst($recent->vehicle_type) }})</p>
                                <small class="text-muted">{{ $recent->created_at->format('d/m/Y H:i') }}</small>
                                <div class="mt-2">
                                    <span class="badge badge-info">{{ number_format($recent->total_cost, 0, ',', '.') }} VNĐ</span>
                                    <span class="badge badge-primary">{{ $recent->duration_hours }}h</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="row">
        <!-- Available Parking Lots -->
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5><i class="fa fa-map mr-2"></i>Chọn bãi đỗ xe</h5>
                </div>
                <div class="card-body">
                    @if($parkingLots->count() > 0)
                        <div class="row">
                            @foreach($parkingLots as $lot)
                            <div class="col-md-6 mb-3">
                                <div class="card parking-lot-card h-100" onclick="selectParkingLot({{ $lot->id }})">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <h6 class="card-title mb-0">{{ $lot->name }}</h6>
                                            <span class="availability-indicator {{ $lot->available_spots > 5 ? 'available' : ($lot->available_spots > 0 ? 'limited' : 'full') }}"></span>
                                        </div>

                                        <p class="text-muted small mb-2">
                                            <i class="fa fa-map-marker mr-1"></i>{{ Str::limit($lot->address, 50) }}
                                        </p>

                                        <div class="row mb-2">
                                            <div class="col-6">
                                                <strong class="text-primary">{{ number_format($lot->hourly_rate, 0, ',', '.') }} VNĐ/h</strong>
                                            </div>
                                            <div class="col-6 text-right">
                                                <small class="text-muted">
                                                    {{ $lot->available_spots }}/{{ $lot->total_spots }} chỗ trống
                                                </small>
                                            </div>
                                        </div>

                                        @php
                                            $facilities = [];
                                            if (is_array($lot->facilities)) {
                                                $facilities = $lot->facilities;
                                            } elseif (is_string($lot->facilities)) {
                                                $decoded = json_decode($lot->facilities, true);
                                                $facilities = is_array($decoded) ? $decoded : [];
                                            }
                                        @endphp
                                        @if(!empty($facilities))
                                            <div class="mb-2">
                                                @foreach($facilities as $facility)
                                                    <span class="badge badge-secondary badge-sm mr-1">{{ $facility }}</span>
                                                @endforeach
                                            </div>
                                        @endif

                                        <div class="text-center">
                                            <button type="button" class="btn btn-outline-primary btn-sm" disabled>
                                                Chọn bãi này
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fa fa-exclamation-triangle fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">Không có bãi đỗ xe nào khả dụng</h5>
                            <p class="text-muted">Vui lòng thử lại sau hoặc liên hệ với chúng tôi để được hỗ trợ.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Service Packages -->
            @if($servicePackages->count() > 0)
            <div class="card">
                <div class="card-header">
                    <h5><i class="fa fa-gift mr-2"></i>Gói dịch vụ (Tùy chọn)</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($servicePackages as $package)
                        <div class="col-md-4 mb-3">
                            <div class="card service-package-card h-100" onclick="selectServicePackage({{ $package->id }}, this)">
                                <div class="card-body text-center">
                                    <h6 class="card-title">{{ $package->name }}</h6>
                                    <p class="text-muted small">{{ $package->description }}</p>
                                    <h5 class="text-primary">{{ number_format($package->price, 0, ',', '.') }} VNĐ</h5>

                                    @php
                                        $pkgFeatures = [];
                                        if (!empty($package->features)) {
                                            if (is_array($package->features)) {
                                                $pkgFeatures = $package->features;
                                            } elseif (is_string($package->features)) {
                                                $decoded = json_decode($package->features, true);
                                                $pkgFeatures = is_array($decoded) ? $decoded : [];
                                            }
                                        }
                                    @endphp
                                    @if(!empty($pkgFeatures))
                                        <div class="mt-2">
                                            @foreach($pkgFeatures as $feature)
                                                <small class="d-block"><i class="fa fa-check text-success mr-1"></i>{{ $feature }}</small>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Booking Form -->
        <div class="col-lg-4">
            <div class="booking-form sticky-top">
                <h5 class="text-center mb-4">
                    <i class="fa fa-calendar mr-2"></i>Thông tin đặt chỗ
                </h5>

                @guest
                <div class="alert alert-warning text-dark mb-3">
                    <i class="fa fa-info-circle mr-2"></i>
                    <strong>Lưu ý:</strong> Bạn cần đăng nhập để đặt chỗ. Hãy xem thông tin bãi đỗ bên dưới!
                </div>
                @endguest

                <form action="{{ route('user.booking.store') }}" method="POST" id="bookingForm">
                    @csrf

                    <input type="hidden" name="parking_lot_id" id="selected_parking_lot">
                    <input type="hidden" name="service_package_id" id="selected_service_package">

                    <!-- Selected Info Display -->
                    <div id="selected_info" class="mb-3" style="display: none;">
                        <div class="card bg-light text-dark">
                            <div class="card-body p-3">
                                <h6 id="selected_lot_name"></h6>
                                <p class="mb-1 small" id="selected_lot_address"></p>
                                <p class="mb-0"><strong id="selected_lot_rate"></strong></p>
                            </div>
                        </div>
                    </div>

                    <!-- Time Selection -->
                    <div class="form-group">
                        <label>Thời gian bắt đầu</label>
                        <input type="datetime-local" class="form-control" name="start_time" id="start_time"
                               min="{{ now()->format('Y-m-d\TH:i') }}" {{ auth()->guest() ? 'disabled' : '' }} required>
                    </div>

                    <div class="form-group">
                        <label>Thời gian kết thúc</label>
                        <input type="datetime-local" class="form-control" name="end_time" id="end_time" {{ auth()->guest() ? 'disabled' : '' }} required>
                    </div>

                    <!-- Vehicle Information -->
                    <div class="form-group">
                        <label>Loại xe</label>
                        <select class="form-control" name="vehicle_type" {{ auth()->guest() ? 'disabled' : '' }} required>
                            <option value="">Chọn loại xe</option>
                            <option value="car">Ô tô</option>
                            <option value="motorcycle">Xe máy</option>
                            <option value="bicycle">Xe đạp</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Biển số xe</label>
                        <input type="text" class="form-control" name="license_plate"
                               placeholder="VD: 30A-12345" {{ auth()->guest() ? 'disabled' : '' }} required>
                    </div>

                    <div class="form-group">
                        <label>Số điện thoại</label>
                        <input type="tel" class="form-control" name="phone_number"
                               placeholder="0912345678" value="{{ auth()->check() ? (auth()->user()->phone ?? '') : '' }}" {{ auth()->guest() ? 'disabled' : '' }} required>
                    </div>

                    <!-- Special Requests -->
                    <div class="form-group">
                        <label>Yêu cầu đặc biệt (Tùy chọn)</label>
                        <textarea class="form-control" name="special_requests" rows="3"
                                  placeholder="Ghi chú thêm về yêu cầu đặc biệt..." {{ auth()->guest() ? 'disabled' : '' }}></textarea>
                    </div>

                    <!-- Cost Estimation -->
                    <div class="card bg-dark text-white mb-3">
                        <div class="card-body p-3">
                            <h6>Ước tính chi phí</h6>
                            <div class="d-flex justify-content-between">
                                <span>Thời gian:</span>
                                <span id="duration_display">-- giờ</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span>Tiền giữ xe:</span>
                                <span id="parking_cost">0 VNĐ</span>
                            </div>
                            <div class="d-flex justify-content-between" id="service_cost_row" style="display: none;">
                                <span>Gói dịch vụ:</span>
                                <span id="service_cost">0 VNĐ</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <strong>Tổng cộng:</strong>
                                <strong id="total_cost">0 VNĐ</strong>
                            </div>
                        </div>
                    </div>

                    @auth
                    <button type="submit" class="btn btn-light btn-block btn-lg" id="bookingSubmit" disabled>
                        <i class="fa fa-calendar-plus-o mr-2"></i>Đặt chỗ ngay
                    </button>
                    @else
                    <a href="{{ route('login') }}" class="btn btn-warning btn-block btn-lg">
                        <i class="fa fa-sign-in mr-2"></i>Đăng nhập để đặt chỗ
                    </a>
                    @endauth
                </form>
            </div>
        </div>
    </div>
        </div>
    </section>
    <!-- end booking section -->

<script>
let selectedParkingLot = null;
let selectedServicePackage = null;

// Select parking lot
function selectParkingLot(lotId, el) {
    // Remove previous selection
    document.querySelectorAll('.parking-lot-card').forEach(card => {
        card.classList.remove('selected');
    });

    // Add selection to clicked card
    if (el) { el.classList.add('selected'); }

    // Get parking lot data via AJAX
    fetch(`{{ url('/user/api/parking-lot') }}/${lotId}`)
        .then(response => response.json())
        .then(data => {
            selectedParkingLot = data;
            document.getElementById('selected_parking_lot').value = lotId;

            // Update display
            document.getElementById('selected_info').style.display = 'block';
            document.getElementById('selected_lot_name').textContent = data.name;
            document.getElementById('selected_lot_address').textContent = data.address;
            document.getElementById('selected_lot_rate').textContent = `${new Intl.NumberFormat('vi-VN').format(data.hourly_rate)} VNĐ/giờ`;

            updateCostEstimation();
            checkFormValidity();
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Không thể tải thông tin bãi đỗ xe. Vui lòng thử lại.');
        });
}

// Select service package
function selectServicePackage(packageId, el) {
    // Toggle selection
    const clickedCard = el;
    const isSelected = clickedCard.classList.contains('selected');

    // Remove all selections first
    document.querySelectorAll('.service-package-card').forEach(card => {
        card.classList.remove('selected');
    });

    if (!isSelected) {
        clickedCard.classList.add('selected');
        selectedServicePackage = packageId;
        document.getElementById('selected_service_package').value = packageId;
    } else {
        selectedServicePackage = null;
        document.getElementById('selected_service_package').value = '';
    }

    updateCostEstimation();
}

// Update cost estimation
function updateCostEstimation() {
    const startTime = document.getElementById('start_time').value;
    const endTime = document.getElementById('end_time').value;

    if (!startTime || !endTime || !selectedParkingLot) {
        return;
    }

    const start = new Date(startTime);
    const end = new Date(endTime);
    const hours = Math.ceil((end - start) / (1000 * 60 * 60));

    if (hours <= 0) {
        return;
    }

    document.getElementById('duration_display').textContent = `${hours} giờ`;

    const parkingCost = hours * selectedParkingLot.hourly_rate;
    document.getElementById('parking_cost').textContent = `${new Intl.NumberFormat('vi-VN').format(parkingCost)} VNĐ`;

    let serviceCost = 0;
    if (selectedServicePackage) {
        // You would need to get service package price here
        // For now, using a placeholder
        serviceCost = 0; // This should be fetched from selected service package
        document.getElementById('service_cost_row').style.display = 'flex';
        document.getElementById('service_cost').textContent = `${new Intl.NumberFormat('vi-VN').format(serviceCost)} VNĐ`;
    } else {
        document.getElementById('service_cost_row').style.display = 'none';
    }

    const totalCost = parkingCost + serviceCost;
    document.getElementById('total_cost').textContent = `${new Intl.NumberFormat('vi-VN').format(totalCost)} VNĐ`;
}

// Check form validity
function checkFormValidity() {
    const parkingLotSelected = document.getElementById('selected_parking_lot').value;
    const startTime = document.getElementById('start_time').value;
    const endTime = document.getElementById('end_time').value;
    const vehicleType = document.querySelector('select[name="vehicle_type"]').value;
    const licensePlate = document.querySelector('input[name="license_plate"]').value;
    const phoneNumber = document.querySelector('input[name="phone_number"]').value;

    const isValid = parkingLotSelected && startTime && endTime && vehicleType && licensePlate && phoneNumber;

    document.getElementById('bookingSubmit').disabled = !isValid;
}

// Event listeners
document.getElementById('start_time').addEventListener('change', function() {
    const startTime = new Date(this.value);
    const minEndTime = new Date(startTime.getTime() + 60 * 60 * 1000); // Add 1 hour
    document.getElementById('end_time').min = minEndTime.toISOString().slice(0, 16);
    updateCostEstimation();
    checkFormValidity();
});

document.getElementById('end_time').addEventListener('change', function() {
    updateCostEstimation();
    checkFormValidity();
});

document.querySelectorAll('input, select, textarea').forEach(element => {
    element.addEventListener('input', checkFormValidity);
});

// Rebook previous booking
function rebookPrevious(bookingId) {
    if (confirm('Bạn có muốn sử dụng thông tin từ đặt chỗ này không?')) {
        // This would populate the form with previous booking data
        // Implementation depends on how you want to handle this
        console.log('Rebooking:', bookingId);
    }
}

// Form submission
document.getElementById('bookingForm').addEventListener('submit', function(e) {
    e.preventDefault();

    if (!selectedParkingLot) {
        alert('Vui lòng chọn bãi đỗ xe');
        return;
    }

    // Show loading state
    const submitBtn = document.getElementById('bookingSubmit');
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<i class="fa fa-spinner fa-spin mr-2"></i>Đang xử lý...';
    submitBtn.disabled = true;

    // Submit form
    this.submit();
});
</script>

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
