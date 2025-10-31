@extends('admin.layout')
@section('page-title', 'Thông tin tài khoản - Paspark Admin')
@section('page-heading', 'Thông tin tài khoản')

@section('content')
    @section('additional_css')
        <style>
            /* Ensure uploaded avatar never overflows and always stays circular */
            .admin-avatar {
                width: 96px;
                height: 96px;
                border-radius: 9999px;
                overflow: hidden;
                border: 4px solid #ffffff;
                box-shadow: 0 4px 12px rgba(0, 0, 0, .15);
                background: #f8fafc;
            }

            .admin-avatar img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                display: block;
            }
        </style>
    @endsection
    <div class="flex flex-wrap -mx-3">
        <!-- Profile Info Card -->
        <div class="w-full max-w-full px-3 mb-6 lg:w-4/12 lg:flex-none">
            <div
                class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                <div class="relative">
                    <!-- Cover Image -->
                    <div class="relative w-full h-32 bg-gradient-to-r from-blue-500 to-purple-600 rounded-t-2xl">
                        <div class="absolute inset-0 bg-black opacity-20 rounded-t-2xl"></div>
                    </div>
                    <!-- Profile Avatar -->
                    <div class="absolute -bottom-12 left-1/2 transform -translate-x-1/2">
                        <div class="relative">
                            <div class="admin-avatar">
                                @if($admin->avatar ?? false)
                                    <img src="{{ asset('storage/' . $admin->avatar) }}" alt="Profile">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($admin->name ?? 'Admin') }}&size=100&background=3b82f6&color=ffffff&rounded=true"
                                        alt="Profile">
                                @endif
                            </div>
                            @php $active = ($admin->is_active ?? true); @endphp
                            <div class="absolute bottom-0 right-0 w-6 h-6 border-2 border-white rounded-full"
                                style="background-color: {{ $active ? '#22c55e' : '#ef4444' }};"
                                title="{{ $active ? 'Hoạt động' : 'Ngừng hoạt động' }}"></div>
                        </div>
                    </div>
                </div>

                <div class="flex-auto p-6 pt-16 text-center">
                    <h5 class="mb-1 font-bold text-slate-700 dark:text-white">{{ $admin->name ?? 'Administrator' }}</h5>
                    <p class="mb-3 text-sm font-semibold text-slate-400">{{ $admin->email ?? 'admin@paspark.com' }}</p>
                    <div class="mb-3 text-xs text-slate-400">
                        @php
                            $roleNames = method_exists($admin, 'getRoleNames') ? $admin->getRoleNames() : collect([$admin->role ?? 'admin']);
                        @endphp
                        @foreach($roleNames as $r)
                            <span
                                class="px-2 py-1 bg-gray-100 text-gray-700 rounded-full mr-1 inline-block font-semibold">{{ ucfirst($r) }}</span>
                        @endforeach
                    </div>

                    <div class="flex justify-center mb-4">
                        @php $active = ($admin->is_active ?? true); @endphp
                        <div class="btn-chip {{ $active ? 'btn-emerald' : 'btn-red' }}"
                            style="border-width:0; background: {{ $active ? '#ECFDF5' : '#FEF2F2' }}; color: {{ $active ? '#047857' : '#B91C1C' }};">
                            <i class="btn-icon fas fa-shield-alt"></i>
                            Trạng thái: {{ $active ? 'Hoạt động' : 'Ngừng hoạt động' }}
                        </div>
                    </div>

                    <div class="flex flex-wrap justify-center -mx-2 mb-4">
                        @php
                            $perms = method_exists($admin, 'getAllPermissions') ? $admin->getAllPermissions()->pluck('name')->take(6) : collect();
                        @endphp
                        @forelse($perms as $p)
                            <div class="px-2 py-1 mx-1 mb-2 text-xs font-semibold text-gray-600 bg-gray-100 rounded-full">
                                <i class="fas fa-key mr-1"></i>{{ $p }}
                            </div>
                        @empty
                            <div class="px-2 py-1 mx-1 mb-2 text-xs font-semibold text-gray-600 bg-gray-100 rounded-full">
                                <i class="fas fa-key mr-1"></i>Không có quyền cụ thể
                            </div>
                        @endforelse
                    </div>

                    <div class="text-sm text-gray-600">
                        <p class="mb-1">
                            <i class="fas fa-calendar-alt mr-2 text-gray-400"></i>
                            Tham gia từ {{ $admin->created_at ? $admin->created_at->format('d/m/Y') : 'N/A' }}
                        </p>
                        <p class="mb-1">
                            <i class="fas fa-clock mr-2 text-gray-400"></i>
                            Đăng nhập cuối:
                            {{ $admin->last_login_at ? \Carbon\Carbon::parse($admin->last_login_at)->format('d/m/Y H:i') : 'N/A' }}
                        </p>
                        <p>
                            <i class="fas fa-network-wired mr-2 text-gray-400"></i>
                            IP cuối: {{ $admin->last_login_ip ?? 'N/A' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profile Edit Form -->
        <div class="w-full max-w-full px-3 mb-6 lg:w-8/12 lg:flex-none">
            <div
                class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                    <div class="flex items-center justify-between">
                        <h6 class="mb-0 dark:text-white">Chỉnh sửa thông tin</h6>
                        <div class="flex space-x-2">
                            <span class="btn-chip btn-emerald">
                                <i class="btn-icon fas fa-check-circle"></i>Đã xác thực
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
                                <input type="tel" name="phone" id="phone" value="{{ old('phone', $admin->phone ?? '') }}"
                                    class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                                    placeholder="Nhập số điện thoại">
                                @error('phone')
                                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                                <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80"
                                    for="created_at">
                                    Ngày tạo tài khoản
                                </label>
                                <input type="text" name="created_at" id="created_at"
                                    value="{{ $admin->created_at ? $admin->created_at->format('d/m/Y H:i') : 'N/A' }}"
                                    class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-gray-100 bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all"
                                    readonly>
                            </div>

                            <!-- Change Password Section -->
                            <div class="w-full px-3 mb-4 mt-6">
                                <h6 class="text-lg font-semibold text-slate-700 dark:text-white mb-4">Đổi mật khẩu</h6>
                                <p class="text-sm text-gray-600 mb-4">Để trống nếu không muốn thay đổi mật khẩu</p>
                            </div>

                            <div class="w-full max-w-full px-3 mb-6">
                                <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80"
                                    for="current_password">
                                    Mật khẩu hiện tại
                                </label>
                                <div class="relative">
                                    <input type="password" name="current_password" id="current_password"
                                        class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 pr-10 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                                        placeholder="Nhập mật khẩu hiện tại">
                                    <button type="button"
                                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600"
                                        onclick="togglePassword('current_password')">
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
                                    <button type="button"
                                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600"
                                        onclick="togglePassword('password')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                                <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80"
                                    for="password_confirmation">
                                    Xác nhận mật khẩu mới
                                </label>
                                <div class="relative">
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                        class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 pr-10 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                                        placeholder="Nhập lại mật khẩu mới">
                                    <button type="button"
                                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600"
                                        onclick="togglePassword('password_confirmation')">
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
                                    <p class="text-xs text-gray-500 mt-1">Chấp nhận: JPG, PNG, GIF. Kích thước tối đa: 2MB
                                    </p>
                                </div>
                                @error('avatar')
                                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <button type="button" onclick="resetForm()" class="btn-solid btn-solid-red mr-3">
                                <i class="fas fa-rotate-left mr-2"></i>Đặt lại
                            </button>
                            <button type="submit" class="btn-solid btn-solid-orange">
                                <i class="fas fa-save mr-2"></i>Cập nhật
                            </button>
                        </div>
                    </form>
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
        document.getElementById('avatar').addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    // In a real application, you would update the profile image preview here
                    console.log('Avatar preview:', e.target.result);
                };
                reader.readAsDataURL(file);
            }
        });

        // Form validation
        document.querySelector('form').addEventListener('submit', function (e) {
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
