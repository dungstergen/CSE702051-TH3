@extends('admin.layout')
@section('page-title', 'Thông tin tài khoản - Paspark Admin')
@section('page-heading', 'Thông tin tài khoản')

@section('content')
<div class="flex flex-wrap -mx-3">
    <!-- Profile Info Card -->
    <div class="w-full max-w-full px-3 mb-6 lg:w-4/12 lg:flex-none">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="relative">
                <!-- Cover Image -->
                <div class="relative w-full h-32 bg-gradient-to-r from-blue-500 to-purple-600 rounded-t-2xl">
                    <div class="absolute inset-0 bg-black opacity-20 rounded-t-2xl"></div>
                </div>
                <!-- Profile Avatar -->
                <div class="absolute -bottom-12 left-1/2 transform -translate-x-1/2">
                    <div class="relative">
                        <img src="https://ui-avatars.com/api/?name=Admin&size=100&background=3b82f6&color=ffffff&rounded=true"
                             alt="Profile"
                             class="w-24 h-24 rounded-full border-4 border-white shadow-lg">
                        <div class="absolute bottom-0 right-0 w-6 h-6 bg-green-500 border-2 border-white rounded-full"></div>
                    </div>
                </div>
            </div>

            <div class="flex-auto p-6 pt-16 text-center">
                <h5 class="mb-1 font-bold text-slate-700 dark:text-white">{{ $admin->name ?? 'Administrator' }}</h5>
                <p class="mb-3 text-sm font-semibold text-slate-400">{{ $admin->role ?? 'Quản trị viên hệ thống' }}</p>

                <div class="flex justify-center mb-4">
                    <div class="px-4 py-2 bg-blue-50 rounded-lg">
                        <span class="text-xs font-semibold text-blue-600">
                            <i class="fas fa-shield-alt mr-1"></i>
                            Trạng thái: Hoạt động
                        </span>
                    </div>
                </div>

                <div class="flex flex-wrap justify-center -mx-2 mb-4">
                    <div class="px-2 py-1 mx-1 mb-2 text-xs font-semibold text-gray-600 bg-gray-100 rounded-full">
                        <i class="fas fa-users mr-1"></i>Quản lý User
                    </div>
                    <div class="px-2 py-1 mx-1 mb-2 text-xs font-semibold text-gray-600 bg-gray-100 rounded-full">
                        <i class="fas fa-parking mr-1"></i>Quản lý Bãi đỗ
                    </div>
                    <div class="px-2 py-1 mx-1 mb-2 text-xs font-semibold text-gray-600 bg-gray-100 rounded-full">
                        <i class="fas fa-chart-bar mr-1"></i>Báo cáo
                    </div>
                </div>

                <div class="text-sm text-gray-600">
                    <p class="mb-1">
                        <i class="fas fa-calendar-alt mr-2 text-gray-400"></i>
                        Tham gia từ {{ $admin->created_at ? $admin->created_at->format('d/m/Y') : '01/01/2024' }}
                    </p>
                    <p>
                        <i class="fas fa-clock mr-2 text-gray-400"></i>
                        Đăng nhập cuối: {{ $admin->last_login_at ? $admin->last_login_at->format('d/m/Y H:i') : 'Hôm nay 14:30' }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Edit Form -->
    <div class="w-full max-w-full px-3 mb-6 lg:w-8/12 lg:flex-none">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <div class="flex items-center justify-between">
                    <h6 class="mb-0 dark:text-white">Chỉnh sửa thông tin</h6>
                    <div class="flex space-x-2">
                        <span class="px-3 py-1 text-xs font-semibold text-green-600 bg-green-100 rounded-full">
                            <i class="fas fa-check-circle mr-1"></i>Đã xác thực
                        </span>
                    </div>
                </div>
            </div>

            <div class="flex-auto p-6">
                @if(session('success'))
                    <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg" role="alert">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-check-circle text-green-400"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm">{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="flex flex-wrap -mx-3">
                        <!-- Personal Information -->
                        <div class="w-full px-3 mb-4">
                            <h6 class="text-lg font-semibold text-slate-700 dark:text-white mb-4">Thông tin cá nhân</h6>
                        </div>

                        <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80" for="name">
                                Họ và tên <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="name" id="name"
                                   value="{{ old('name', $admin->name ?? 'Administrator') }}"
                                   class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                                   placeholder="Nhập họ và tên">
                            @error('name')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80" for="email">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <input type="email" name="email" id="email"
                                   value="{{ old('email', $admin->email ?? 'admin@paspark.com') }}"
                                   class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                                   placeholder="admin@paspark.com">
                            @error('email')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80" for="phone">
                                Số điện thoại
                            </label>
                            <input type="tel" name="phone" id="phone"
                                   value="{{ old('phone', $admin->phone ?? '+84 123 456 789') }}"
                                   class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                                   placeholder="+84 123 456 789">
                            @error('phone')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80" for="role">
                                Vai trò
                            </label>
                            <input type="text" name="role" id="role"
                                   value="{{ old('role', $admin->role ?? 'Quản trị viên hệ thống') }}"
                                   class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-gray-100 bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all"
                                   readonly>
                        </div>

                        <!-- Change Password Section -->
                        <div class="w-full px-3 mb-4 mt-6">
                            <h6 class="text-lg font-semibold text-slate-700 dark:text-white mb-4">Đổi mật khẩu</h6>
                            <p class="text-sm text-gray-600 mb-4">Để trống nếu không muốn thay đổi mật khẩu</p>
                        </div>

                        <div class="w-full max-w-full px-3 mb-6">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80" for="current_password">
                                Mật khẩu hiện tại
                            </label>
                            <div class="relative">
                                <input type="password" name="current_password" id="current_password"
                                       class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 pr-10 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                                       placeholder="Nhập mật khẩu hiện tại">
                                <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600" onclick="togglePassword('current_password')">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            @error('current_password')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80" for="password">
                                Mật khẩu mới
                            </label>
                            <div class="relative">
                                <input type="password" name="password" id="password"
                                       class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 pr-10 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                                       placeholder="Nhập mật khẩu mới">
                                <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600" onclick="togglePassword('password')">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            @error('password')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80" for="password_confirmation">
                                Xác nhận mật khẩu mới
                            </label>
                            <div class="relative">
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                       class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 pr-10 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                                       placeholder="Nhập lại mật khẩu mới">
                                <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600" onclick="togglePassword('password_confirmation')">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Profile Avatar Upload -->
                        <div class="w-full px-3 mb-4 mt-6">
                            <h6 class="text-lg font-semibold text-slate-700 dark:text-white mb-4">Ảnh đại diện</h6>
                        </div>

                        <div class="w-full max-w-full px-3 mb-6">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80" for="avatar">
                                Tải lên ảnh mới
                            </label>
                            <div class="relative">
                                <input type="file" name="avatar" id="avatar" accept="image/*"
                                       class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow">
                                <p class="text-xs text-gray-500 mt-1">Chấp nhận: JPG, PNG, GIF. Kích thước tối đa: 2MB</p>
                            </div>
                            @error('avatar')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <button type="button" onclick="resetForm()" class="inline-block px-6 py-3 mr-3 font-bold text-center text-gray-700 uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer leading-pro text-xs ease-soft-in tracking-tight-soft hover:scale-102 active:opacity-85">
                            Đặt lại
                        </button>
                        <button type="submit" class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer bg-gradient-to-tl from-blue-600 to-cyan-400 leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs">
                            <i class="fas fa-save mr-2"></i>Cập nhật
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Activity Log -->
<div class="flex flex-wrap -mx-3 mt-6">
    <div class="w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6 class="mb-0 dark:text-white">
                    <i class="fas fa-history mr-2"></i>Hoạt động gần đây
                </h6>
            </div>
            <div class="flex-auto p-6">
                <div class="space-y-4">
                    @php
                        $activities = [
                            ['action' => 'Đăng nhập hệ thống', 'time' => '2 phút trước', 'ip' => '192.168.1.100', 'icon' => 'fa-sign-in-alt', 'color' => 'text-green-600'],
                            ['action' => 'Cập nhật thông tin bãi đỗ xe #15', 'time' => '1 giờ trước', 'ip' => '192.168.1.100', 'icon' => 'fa-edit', 'color' => 'text-blue-600'],
                            ['action' => 'Xem báo cáo doanh thu', 'time' => '3 giờ trước', 'ip' => '192.168.1.100', 'icon' => 'fa-chart-line', 'color' => 'text-purple-600'],
                            ['action' => 'Phê duyệt đánh giá của khách hàng', 'time' => '5 giờ trước', 'ip' => '192.168.1.100', 'icon' => 'fa-check-circle', 'color' => 'text-green-600'],
                            ['action' => 'Cập nhật thông tin profile', 'time' => '1 ngày trước', 'ip' => '192.168.1.95', 'icon' => 'fa-user-edit', 'color' => 'text-orange-600'],
                        ];
                    @endphp
                    @foreach($activities as $activity)
                    <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                        <div class="flex-shrink-0 w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-sm">
                            <i class="fas {{ $activity['icon'] }} {{ $activity['color'] }}"></i>
                        </div>
                        <div class="ml-4 flex-grow">
                            <p class="text-sm font-semibold text-gray-800">{{ $activity['action'] }}</p>
                            <div class="flex items-center text-xs text-gray-600">
                                <span>{{ $activity['time'] }}</span>
                                <span class="mx-2">•</span>
                                <span>IP: {{ $activity['ip'] }}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const icon = field.nextElementSibling.querySelector('i');

    if (field.type === 'password') {
        field.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        field.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

function resetForm() {
    if (confirm('Bạn có chắc chắn muốn đặt lại form?')) {
        document.querySelector('form').reset();
    }
}

// Preview avatar before upload
document.getElementById('avatar').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            // In a real application, you would update the profile image preview here
            console.log('Avatar preview:', e.target.result);
        };
        reader.readAsDataURL(file);
    }
});

// Form validation
document.querySelector('form').addEventListener('submit', function(e) {
    const newPassword = document.getElementById('password').value;
    const confirmPassword = document.getElementById('password_confirmation').value;

    if (newPassword && newPassword !== confirmPassword) {
        e.preventDefault();
        alert('Mật khẩu mới và xác nhận mật khẩu không khớp!');
        return false;
    }

    if (newPassword && newPassword.length < 8) {
        e.preventDefault();
        alert('Mật khẩu mới phải có ít nhất 8 ký tự!');
        return false;
    }
});
</script>
@endpush
