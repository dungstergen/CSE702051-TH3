@extends('user.layouts.app')

@section('title', 'Thông tin cá nhân')

@section('styles')
<style>
    .profile-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 15px 15px 0 0;
        padding: 40px;
        position: relative;
    }
    
    .profile-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        border: 5px solid white;
        background: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        color: #667eea;
        margin: 0 auto 20px;
        position: relative;
    }
    
    .profile-form {
        background: white;
        border-radius: 0 0 15px 15px;
        padding: 40px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    
    .form-group label {
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
    }
    
    .form-control {
        border-radius: 8px;
        border: 2px solid #f1f1f1;
        padding: 12px 15px;
        transition: all 0.3s ease;
    }
    
    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }
    
    .stats-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 15px;
        padding: 25px;
        text-align: center;
        margin-bottom: 20px;
    }
    
    .stats-card .stats-number {
        font-size: 2.5rem;
        font-weight: bold;
        margin-bottom: 10px;
    }
    
    .stats-card .stats-label {
        opacity: 0.9;
        font-size: 0.9rem;
    }
    
    .security-section {
        background: #f8f9fa;
        border-radius: 15px;
        padding: 30px;
        margin-top: 30px;
    }
    
    .security-item {
        display: flex;
        justify-content: between;
        align-items: center;
        padding: 15px 0;
        border-bottom: 1px solid #e9ecef;
    }
    
    .security-item:last-child {
        border-bottom: none;
    }
    
    .activity-item {
        background: white;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 15px;
        border-left: 4px solid #667eea;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        border-radius: 8px;
        padding: 12px 30px;
        font-weight: 600;
    }
    
    .btn-outline-primary {
        border: 2px solid #667eea;
        color: #667eea;
        border-radius: 8px;
        padding: 12px 30px;
        font-weight: 600;
    }
    
    .btn-outline-primary:hover {
        background: #667eea;
        border-color: #667eea;
    }
</style>
@endsection

@section('content')
<div class="container mt-5">
    <div class="row">
        <!-- Profile Form -->
        <div class="col-lg-8">
            <div class="card shadow-lg border-0">
                <div class="profile-header">
                    <div class="profile-avatar">
                        <i class="fa fa-user"></i>
                    </div>
                    <div class="text-center">
                        <h3>{{ $user->name }}</h3>
                        <p class="mb-0">{{ $user->email }}</p>
                        <small class="opacity-75">Thành viên từ {{ $user->created_at->format('d/m/Y') }}</small>
                    </div>
                </div>
                
                <div class="profile-form">
                    <h5 class="mb-4">
                        <i class="fa fa-edit text-primary mr-2"></i>
                        Chỉnh sửa thông tin cá nhân  
                    </h5>
                    
                    <form action="{{ route('user.profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Họ và tên *</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                           id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email *</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                           id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Số điện thoại</label>
                                    <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                                           id="phone" name="phone" value="{{ old('phone', $user->phone) }}" 
                                           placeholder="0912345678">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gender">Giới tính</label>
                                    <select class="form-control @error('gender') is-invalid @enderror" 
                                            id="gender" name="gender">
                                        <option value="">Chọn giới tính</option>
                                        <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>Nam</option>
                                        <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>Nữ</option>
                                        <option value="other" {{ old('gender', $user->gender) == 'other' ? 'selected' : '' }}>Khác</option>
                                    </select>
                                    @error('gender')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="date_of_birth">Ngày sinh</label>
                            <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" 
                                   id="date_of_birth" name="date_of_birth" 
                                   value="{{ old('date_of_birth', $user->date_of_birth ? $user->date_of_birth->format('Y-m-d') : '') }}">
                            @error('date_of_birth')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="address">Địa chỉ</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" 
                                      id="address" name="address" rows="3" 
                                      placeholder="Nhập địa chỉ của bạn">{{ old('address', $user->address) }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary btn-lg px-4">
                                <i class="fa fa-save mr-2"></i>
                                Cập nhật thông tin
                            </button>
                            
                            <a href="{{ route('user.dashboard') }}" class="btn btn-outline-secondary btn-lg px-4 ml-2">
                                <i class="fa fa-arrow-left mr-2"></i>
                                Quay lại
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Statistics & Quick Actions -->
        <div class="col-lg-4">
            <!-- User Stats -->
            <div class="stats-card">
                <div class="stats-number">{{ $user->bookings->count() ?? 0 }}</div>
                <div class="stats-label">Tổng số đặt chỗ</div>
            </div>
            
            <div class="stats-card">
                <div class="stats-number">{{ $user->bookings->where('status', 'completed')->count() ?? 0 }}</div>
                <div class="stats-label">Đặt chỗ hoàn thành</div>
            </div>
            
            <div class="stats-card">
                <div class="stats-number">{{ number_format($user->payments->where('payment_status', 'completed')->sum('amount') ?? 0, 0, ',', '.') }}</div>
                <div class="stats-label">Tổng chi tiêu (VNĐ)</div>
            </div>
            
            <!-- Quick Actions -->
            <div class="card mt-4">
                <div class="card-header">
                    <h6><i class="fa fa-bolt text-primary mr-2"></i>Hành động nhanh</h6>
                </div>
                <div class="card-body">
                    <a href="{{ route('user.booking') }}" class="btn btn-outline-primary btn-block mb-2">
                        <i class="fa fa-plus mr-2"></i>Đặt chỗ mới
                    </a>
                    
                    <a href="{{ route('user.history') }}" class="btn btn-outline-primary btn-block mb-2">
                        <i class="fa fa-history mr-2"></i>Lịch sử đặt chỗ
                    </a>
                    
                    <a href="{{ route('user.payment.history') }}" class="btn btn-outline-primary btn-block">
                        <i class="fa fa-credit-card mr-2"></i>Lịch sử thanh toán
                    </a>
                </div>
            </div>
            
            <!-- Account Settings -->
            <div class="security-section">
                <h6 class="mb-3">
                    <i class="fa fa-shield text-primary mr-2"></i>
                    Cài đặt tài khoản
                </h6>
                
                <div class="security-item">
                    <div>
                        <strong>Đổi mật khẩu</strong>
                        <br>
                        <small class="text-muted">Cập nhật mật khẩu để bảo mật tài khoản</small>
                    </div>
                    <button class="btn btn-outline-primary btn-sm" onclick="openPasswordModal()">
                        <i class="fa fa-key mr-1"></i>Đổi
                    </button>
                </div>
                
                <div class="security-item">
                    <div>
                        <strong>Thông báo Email</strong>
                        <br>
                        <small class="text-muted">Nhận thông báo qua email</small>
                    </div>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="emailNotifications" checked>
                        <label class="custom-control-label" for="emailNotifications"></label>
                    </div>
                </div>
                
                <div class="security-item">
                    <div>
                        <strong>Xóa tài khoản</strong>
                        <br>
                        <small class="text-muted text-danger">Xóa vĩnh viễn tài khoản</small>
                    </div>
                    <button class="btn btn-outline-danger btn-sm" onclick="confirmDeleteAccount()">
                        <i class="fa fa-trash mr-1"></i>Xóa
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Change Password Modal -->
<div class="modal fade" id="passwordModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fa fa-key text-primary mr-2"></i>
                    Đổi mật khẩu
                </h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form action="{{ route('user.password.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label>Mật khẩu hiện tại *</label>
                        <input type="password" class="form-control" name="current_password" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Mật khẩu mới *</label>
                        <input type="password" class="form-control" name="new_password" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Xác nhận mật khẩu mới *</label>
                        <input type="password" class="form-control" name="new_password_confirmation" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save mr-2"></i>Cập nhật
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function openPasswordModal() {
    $('#passwordModal').modal('show');
}

function confirmDeleteAccount() {
    if (confirm('Bạn có chắc chắn muốn xóa tài khoản? Hành động này không thể hoàn tác.')) {
        if (confirm('Tất cả dữ liệu của bạn sẽ bị xóa vĩnh viễn. Bạn có chắc chắn?')) {
            // Submit delete account form
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route("user.account.delete") }}';
            
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            
            const methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'DELETE';
            
            form.appendChild(csrfToken);
            form.appendChild(methodField);
            document.body.appendChild(form);
            form.submit();
        }
    }
}

// Form validation
document.querySelector('form').addEventListener('submit', function(e) {
    const name = document.getElementById('name').value.trim();
    const email = document.getElementById('email').value.trim();
    
    if (!name || !email) {
        e.preventDefault();
        alert('Vui lòng nhập đầy đủ họ tên và email');
        return;
    }
    
    // Show loading state
    const submitBtn = this.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<i class="fa fa-spinner fa-spin mr-2"></i>Đang cập nhật...';
    submitBtn.disabled = true;
});
</script>
@endsection