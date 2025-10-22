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
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.reviews') }}">Đánh giá</a>
                            </li>
                            @endauth
                        </ul>
                        <div class="navbar-nav ml-auto">
                            @auth
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-user"></i> {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item active" href="{{ route('user.profile') }}">
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

    <!-- Profile Section -->
    <section class="profile_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>Thông tin cá nhân</h2>
                <p>Quản lý thông tin tài khoản của bạn</p>
            </div>

            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa fa-check-circle"></i> {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fa fa-exclamation-circle"></i> {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
            </div>
            @endif

            <div class="row">
                <!-- Profile Sidebar -->
                <div class="col-lg-3">
                    <div class="profile_sidebar">
                        <div class="profile_avatar text-center mb-4">
                            <div class="avatar_circle">
                                <i class="fa fa-user"></i>
                            </div>
                            <h4 class="mt-3">{{ Auth::user()->name }}</h4>
                            <p class="text-muted">{{ Auth::user()->email }}</p>
                        </div>

                        <div class="profile_menu">
                            <a href="{{ route('user.profile') }}" class="profile_menu_item {{ Request::is('user/profile') && !Request::has('tab') ? 'active' : '' }}">
                                <i class="fa fa-user-circle"></i> Thông tin cơ bản
                            </a>
                            <a href="{{ route('user.profile') }}?tab=password" class="profile_menu_item {{ Request::get('tab') == 'password' ? 'active' : '' }}">
                                <i class="fa fa-lock"></i> Đổi mật khẩu
                            </a>
                            <a href="{{ route('user.profile') }}?tab=vehicle" class="profile_menu_item {{ Request::get('tab') == 'vehicle' ? 'active' : '' }}">
                                <i class="fa fa-car"></i> Thông tin xe
                            </a>
                            <a href="{{ route('user.profile') }}?tab=danger" class="profile_menu_item {{ Request::get('tab') == 'danger' ? 'active' : '' }}">
                                <i class="fa fa-exclamation-triangle"></i> Xóa tài khoản
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Profile Content -->
                <div class="col-lg-9">
                    @php
                        $currentTab = Request::get('tab', 'basic');
                    @endphp

                    <!-- Basic Information Tab -->
                    @if($currentTab == 'basic' || !in_array($currentTab, ['password', 'vehicle', 'danger']))
                        <div class="profile_content">
                            <div class="profile_card">
                                <h4 class="mb-4">
                                    <i class="fa fa-user-circle"></i> Thông tin cơ bản
                                </h4>

                                <form method="POST" action="{{ route('user.profile.update') }}">
                                    @csrf
                                    @method('PUT')

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Họ và tên *</label>
                                                <input type="text" class="form-control" name="name"
                                                    value="{{ old('name', Auth::user()->name) }}" required>
                                                @error('name')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Email *</label>
                                                <input type="email" class="form-control" name="email"
                                                    value="{{ old('email', Auth::user()->email) }}" required>
                                                @error('email')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Số điện thoại</label>
                                                <input type="text" class="form-control" name="phone"
                                                    value="{{ old('phone', Auth::user()->phone) }}">
                                                @error('phone')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Ngày sinh</label>
                                                <input type="date" class="form-control" name="date_of_birth"
                                                    value="{{ old('date_of_birth', Auth::user()->date_of_birth) }}">
                                                @error('date_of_birth')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Địa chỉ</label>
                                        <textarea class="form-control" name="address" rows="3">{{ old('address', Auth::user()->address) }}</textarea>
                                        @error('address')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="text-right">
                                        <button type="submit" class="btn btn_box">
                                            <i class="fa fa-save"></i> Lưu thay đổi
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif

                    <!-- Change Password Tab -->
                    @if($currentTab == 'password')
                        <div class="profile_content">
                            <div class="profile_card">
                                <h4 class="mb-4">
                                    <i class="fa fa-lock"></i> Đổi mật khẩu
                                </h4>

                                <form method="POST" action="{{ route('user.password.update') }}">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group">
                                        <label>Mật khẩu hiện tại *</label>
                                        <input type="password" class="form-control" name="current_password" required>
                                        @error('current_password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Mật khẩu mới *</label>
                                        <input type="password" class="form-control" name="password" required>
                                        @error('password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                        <small class="text-muted">Mật khẩu phải có ít nhất 8 ký tự</small>
                                    </div>

                                    <div class="form-group">
                                        <label>Xác nhận mật khẩu mới *</label>
                                        <input type="password" class="form-control" name="password_confirmation" required>
                                    </div>

                                    <div class="alert alert-info">
                                        <i class="fa fa-info-circle"></i>
                                        Sau khi đổi mật khẩu, bạn sẽ cần đăng nhập lại.
                                    </div>

                                    <div class="text-right">
                                        <button type="submit" class="btn btn_box">
                                            <i class="fa fa-key"></i> Đổi mật khẩu
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif

                    <!-- Vehicle Information Tab -->
                    @if($currentTab == 'vehicle')
                        <div class="profile_content">
                            <div class="profile_card">
                                <h4 class="mb-4">
                                    <i class="fa fa-car"></i> Thông tin xe
                                </h4>

                                <div class="alert alert-info">
                                    <i class="fa fa-info-circle"></i>
                                    Lưu thông tin xe để đặt chỗ nhanh hơn trong lần sau.
                                </div>

                                <form method="POST" action="{{ route('user.vehicles.update') }}">
                                    @csrf
                                    @method('PUT')

                                    <div id="vehiclesList">
                                        @php
                                            $vehicles = Auth::user()->vehicles ?? [];
                                        @endphp
                                        @if(count($vehicles) > 0)
                                            @foreach($vehicles as $i => $vehicle)
                                            <div class="vehicle-item mb-3 p-3 border rounded" style="background-color: #f8f9fa;">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-2">
                                                            <label>Biển số xe <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="vehicles[{{ $i }}][number]" value="{{ $vehicle->license_plate }}" required>
                                                            <input type="hidden" name="vehicles[{{ $i }}][id]" value="{{ $vehicle->id }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-2">
                                                            <label>Loại xe <span class="text-danger">*</span></label>
                                                            <select class="form-control" name="vehicles[{{ $i }}][type]" required>
                                                                <option value="">-- Chọn loại --</option>
                                                                <option value="car" {{ $vehicle->vehicle_type == 'car' ? 'selected' : '' }}>Ô tô</option>
                                                                <option value="motorbike" {{ $vehicle->vehicle_type == 'motorbike' ? 'selected' : '' }}>Xe máy</option>
                                                                <option value="truck" {{ $vehicle->vehicle_type == 'truck' ? 'selected' : '' }}>Xe tải</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-2">
                                                            <label>Nhãn hiệu</label>
                                                            <input type="text" class="form-control" name="vehicles[{{ $i }}][brand]" value="{{ $vehicle->brand }}" placeholder="VD: Honda, Toyota">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label>&nbsp;</label>
                                                        <!-- Không có nút xóa bằng JS, có thể thêm checkbox xóa nếu muốn -->
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        @else
                                            <div class="vehicle-item mb-3 p-3 border rounded" style="background-color: #f8f9fa;">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-2">
                                                            <label>Biển số xe <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="vehicles[0][number]" placeholder="VD: 29A-12345 hoặc 51B-123.45" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-2">
                                                            <label>Loại xe <span class="text-danger">*</span></label>
                                                            <select class="form-control" name="vehicles[0][type]" required>
                                                                <option value="">-- Chọn loại --</option>
                                                                <option value="car">Ô tô</option>
                                                                <option value="motorbike">Xe máy</option>
                                                                <option value="truck">Xe tải</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-2">
                                                            <label>Nhãn hiệu</label>
                                                            <input type="text" class="form-control" name="vehicles[0][brand]" placeholder="VD: Honda, Toyota">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label>&nbsp;</label>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-actions mt-3">
                                        <!-- Không còn nút thêm xe mới bằng JS, có thể thêm xe mới bằng cách submit lại form -->
                                        <button type="submit" class="btn btn_box float-right">
                                            <i class="fa fa-save"></i> Lưu thông tin xe
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif

                    <!-- Danger Zone Tab -->
                    @if($currentTab == 'danger')
                        <div class="profile_content">
                            <div class="profile_card">
                                <h4 class="mb-4 text-danger">
                                    <i class="fa fa-exclamation-triangle"></i> Vùng nguy hiểm
                                </h4>

                                <div class="alert alert-danger">
                                    <h5 class="alert-heading">Xóa tài khoản vĩnh viễn</h5>
                                    <p>Sau khi xóa tài khoản, tất cả dữ liệu và lịch sử của bạn sẽ bị xóa vĩnh viễn và không thể khôi phục.</p>
                                    <hr>
                                    <p class="mb-0">Hãy chắc chắn về quyết định này!</p>
                                </div>

                                <form method="POST" action="{{ route('user.account.delete') }}"
                                    onsubmit="return confirm('Bạn có chắc chắn muốn xóa tài khoản? Hành động này không thể hoàn tác!');">
                                    @csrf
                                    @method('DELETE')

                                    <div class="form-group">
                                        <label>Nhập mật khẩu để xác nhận *</label>
                                        <input type="password" class="form-control" name="password" required>
                                    </div>

                                    <button type="submit" class="btn btn-danger">
                                        <i class="fa fa-trash"></i> Xóa tài khoản vĩnh viễn
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- End Profile Section -->

    <!-- Custom Styles for Profile Page -->
    <style>
        .profile_sidebar {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }

        .avatar_circle {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: linear-gradient(135deg, #ffbe33 0%, #ff9933 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
        }

        .avatar_circle i {
            font-size: 60px;
            color: white;
        }

        .profile_menu {
            margin-top: 20px;
        }

        .profile_menu_item {
            display: block;
            padding: 15px 20px;
            color: #333;
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 10px;
            transition: all 0.3s;
        }

        .profile_menu_item:hover {
            background: #f8f9fa;
            color: #ffbe33;
            text-decoration: none;
        }

        .profile_menu_item.active {
            background: #ffbe33;
            color: white;
        }

        .profile_menu_item i {
            margin-right: 10px;
            width: 20px;
        }

        .profile_card {
            height: 370px;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }

        .profile_card h4 {
            color: #252525;
            font-weight: 700;
            padding-bottom: 15px;
            border-bottom: 2px solid #ffbe33;
        }

        .form-group label {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }

        .form-control {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px 15px;
        }

        .form-control:focus {
            border-color: #ffbe33;
            box-shadow: 0 0 0 0.2rem rgba(255, 190, 51, 0.25);
        }
    </style>

    <!-- JavaScript for Profile Page -->
    <script>
        let vehicleCount = 0;

        function addVehicle() {
            vehicleCount++;
            const vehiclesList = document.getElementById('vehiclesList');

            const vehicleItem = document.createElement('div');
            vehicleItem.className = 'vehicle-item mb-3 p-3 border rounded';
            vehicleItem.style.backgroundColor = '#f8f9fa';
            vehicleItem.innerHTML = `
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group mb-2">
                            <label>Biển số xe <span class="text-danger">*</span></label>
                            <input type="text"
                                   class="form-control"
                                   name="vehicles[${vehicleCount}][number]"
                                   placeholder="VD: 29A-12345 hoặc 51B-123.45"
                                   pattern="[0-9]{2}[A-Z]{1,2}-[0-9]{3,5}\\.?[0-9]{0,2}"
                                   title="Định dạng: 29A-12345 hoặc 51B-123.45"
                                   required>
                            <small class="text-muted">Biển số Việt Nam</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-2">
                            <label>Loại xe <span class="text-danger">*</span></label>
                            <select class="form-control" name="vehicles[${vehicleCount}][type]" required>
                                <option value="">-- Chọn loại --</option>
                                <option value="car">Ô tô</option>
                                <option value="motorbike">Xe máy</option>
                                <option value="truck">Xe tải</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-2">
                            <label>Nhãn hiệu</label>
                            <input type="text"
                                   class="form-control"
                                   name="vehicles[${vehicleCount}][brand]"
                                   placeholder="VD: Honda, Toyota">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label>&nbsp;</label>
                        <button type="button"
                                class="btn btn-danger btn-block"
                                onclick="removeVehicle(this)"
                                title="Xóa thông tin xe này">
                            <i class="fa fa-trash"></i> Xóa
                        </button>
                    </div>
                </div>
            `;

            vehiclesList.appendChild(vehicleItem);

            // Show success toast
            showToast('Đã thêm xe mới! Vui lòng điền thông tin.', 'success');

            // Focus on the license plate input
            vehicleItem.querySelector('input[type="text"]').focus();
        }

        function addVehicleWithData(vehicle) {
            // Helper function to add vehicle with existing data
            vehicleCount++;
            const vehiclesList = document.getElementById('vehiclesList');

            const vehicleItem = document.createElement('div');
            vehicleItem.className = 'vehicle-item mb-3 p-3 border rounded';
            vehicleItem.style.backgroundColor = '#f8f9fa';
            vehicleItem.dataset.vehicleId = vehicle.id || '';
            vehicleItem.innerHTML = `
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group mb-2">
                            <label>Biển số xe <span class="text-danger">*</span></label>
                            <input type="text"
                                   class="form-control"
                                   name="vehicles[${vehicleCount}][number]"
                                   value="${vehicle.number || ''}"
                                   placeholder="VD: 29A-12345"
                                   required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-2">
                            <label>Loại xe <span class="text-danger">*</span></label>
                            <select class="form-control" name="vehicles[${vehicleCount}][type]" required>
                                <option value="">-- Chọn loại --</option>
                                <option value="car" ${vehicle.type === 'car' ? 'selected' : ''}>Ô tô</option>
                                <option value="motorbike" ${vehicle.type === 'motorbike' ? 'selected' : ''}>Xe máy</option>
                                <option value="truck" ${vehicle.type === 'truck' ? 'selected' : ''}>Xe tải</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-2">
                            <label>Nhãn hiệu</label>
                            <input type="text"
                                   class="form-control"
                                   name="vehicles[${vehicleCount}][brand]"
                                   value="${vehicle.brand || ''}"
                                   placeholder="VD: Honda">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label>&nbsp;</label>
                        <button type="button"
                                class="btn btn-danger btn-block"
                                onclick="removeVehicle(this)"
                                title="Xóa thông tin xe này">
                            <i class="fa fa-trash"></i> Xóa
                        </button>
                    </div>
                </div>
            `;

            vehiclesList.appendChild(vehicleItem);
        }

        function removeVehicle(button) {
            // Confirm before removing
            if (confirm('Bạn có chắc chắn muốn xóa thông tin xe này?')) {
                const vehicleItem = button.closest('.vehicle-item');

                // Add fade out animation
                $(vehicleItem).fadeOut(300, function() {
                    $(this).remove();
                    showToast('Đã xóa thông tin xe', 'info');
                });
            }
        }

        function showToast(message, type = 'info') {
            // Create toast notification
            const toastTypes = {
                'success': 'alert-success',
                'error': 'alert-danger',
                'warning': 'alert-warning',
                'info': 'alert-info'
            };

            const icons = {
                'success': 'fa-check-circle',
                'error': 'fa-exclamation-circle',
                'warning': 'fa-exclamation-triangle',
                'info': 'fa-info-circle'
            };

            const toast = $('<div class="alert ' + toastTypes[type] + ' alert-dismissible fade show" role="alert">')
                .html('<i class="fa ' + icons[type] + ' mr-2"></i>' + message +
                      '<button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>')
                .css({
                    'position': 'fixed',
                    'top': '20px',
                    'right': '20px',
                    'z-index': 9999,
                    'min-width': '300px',
                    'box-shadow': '0 4px 12px rgba(0,0,0,0.15)',
                    'animation': 'slideInRight 0.3s ease-out'
                });

            $('body').append(toast);

            // Auto remove after 3 seconds
            setTimeout(function() {
                toast.fadeOut(300, function() {
                    $(this).remove();
                });
            }, 3000);
        }

        // Add CSS animation for toast
        if (!document.getElementById('toast-animation-styles')) {
            const style = document.createElement('style');
            style.id = 'toast-animation-styles';
            style.textContent = `
                @keyframes slideInRight {
                    from {
                        transform: translateX(100%);
                        opacity: 0;
                    }
                    to {
                        transform: translateX(0);
                        opacity: 1;
                    }
                }
            `;
            document.head.appendChild(style);
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
