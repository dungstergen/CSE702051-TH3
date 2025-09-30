@extends('admin.build.master')

@section('title', 'Cài đặt hệ thống - Paspark Admin')
@section('page-title', 'Cài đặt hệ thống')
@section('breadcrumb-parent', 'Trang chủ')
@section('breadcrumb-current', 'Cài đặt')

@push('styles')
<style>
    .settings-section {
        background: white;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        margin-bottom: 24px;
    }

    .settings-header {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 16px;
        border-bottom: 2px solid #e5e7eb;
    }

    .settings-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 12px;
        color: white;
        font-size: 18px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #374151;
    }

    .form-input {
        width: 100%;
        padding: 12px;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        transition: all 0.3s ease;
        font-size: 14px;
    }

    .form-input:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .form-select {
        width: 100%;
        padding: 12px;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        background: white;
        transition: all 0.3s ease;
        font-size: 14px;
    }

    .toggle-switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .toggle-switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: .4s;
        border-radius: 34px;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
    }

    input:checked + .slider {
        background-color: #3b82f6;
    }

    input:checked + .slider:before {
        transform: translateX(26px);
    }

    .save-btn {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        padding: 12px 24px;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .save-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }
</style>
@endpush

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="settings-section">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Cài đặt hệ thống</h2>
                <p class="text-gray-600">Quản lý các thông số và cấu hình của hệ thống Paspark</p>
            </div>
            <div class="flex space-x-3">
                <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl font-medium transition-colors" onclick="resetToDefault()">
                    <i class="fas fa-undo mr-2"></i>
                    Khôi phục mặc định
                </button>
                <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-xl font-medium transition-colors" onclick="saveAllSettings()">
                    <i class="fas fa-save mr-2"></i>
                    Lưu tất cả
                </button>
            </div>
        </div>
    </div>

    <!-- Pricing Settings -->
    <div class="settings-section">
        <div class="settings-header">
            <div class="settings-icon" style="background: linear-gradient(135deg, #10b981, #059669);">
                <i class="fas fa-dollar-sign"></i>
            </div>
            <div>
                <h3 class="text-xl font-semibold text-gray-800">Cài đặt giá vé</h3>
                <p class="text-gray-600 text-sm">Quản lý cấu trúc giá và phí dịch vụ</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="form-group">
                <label class="form-label">Giá vé thường (15 phút đầu)</label>
                <div class="relative">
                    <input type="number" class="form-input pr-12" value="15000" id="basicPrice">
                    <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500">VNĐ</span>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Giá mỗi giờ tiếp theo</label>
                <div class="relative">
                    <input type="number" class="form-input pr-12" value="10000" id="hourlyRate">
                    <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500">VNĐ</span>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Giảm giá VIP (%)</label>
                <input type="number" class="form-input" value="20" min="0" max="100" id="vipDiscount">
            </div>

            <div class="form-group">
                <label class="form-label">Phí phạt quá giờ (mỗi giờ)</label>
                <div class="relative">
                    <input type="number" class="form-input pr-12" value="50000" id="overtimeFee">
                    <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500">VNĐ</span>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Thời gian miễn phí (phút)</label>
                <input type="number" class="form-input" value="10" id="freeTime">
            </div>

            <div class="form-group">
                <label class="form-label">Giá vé tối đa trong ngày</label>
                <div class="relative">
                    <input type="number" class="form-input pr-12" value="200000" id="maxDailyFee">
                    <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500">VNĐ</span>
                </div>
            </div>
        </div>

        <div class="mt-6">
            <button class="save-btn" onclick="savePricingSettings()">
                <i class="fas fa-save mr-2"></i>
                Lưu cài đặt giá
            </button>
        </div>
    </div>

    <!-- Parking Settings -->
    <div class="settings-section">
        <div class="settings-header">
            <div class="settings-icon" style="background: linear-gradient(135deg, #3b82f6, #1d4ed8);">
                <i class="fas fa-parking"></i>
            </div>
            <div>
                <h3 class="text-xl font-semibold text-gray-800">Cài đặt bãi đỗ xe</h3>
                <p class="text-gray-600 text-sm">Cấu hình vị trí và tính năng bãi đỗ</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="form-group">
                <label class="form-label">Tổng số vị trí</label>
                <input type="number" class="form-input" value="300" id="totalSpots">
            </div>

            <div class="form-group">
                <label class="form-label">Số tầng</label>
                <input type="number" class="form-input" value="3" id="totalFloors">
            </div>

            <div class="form-group">
                <label class="form-label">Vị trí VIP</label>
                <input type="text" class="form-input" value="A1-A40, B1-B35" id="vipSpots" placeholder="Ví dụ: A1-A10, B1-B5">
            </div>

            <div class="form-group">
                <label class="form-label">Vị trí dành cho người khuyết tật</label>
                <input type="text" class="form-input" value="A1-A5, B1-B3" id="disabledSpots" placeholder="Ví dụ: A1-A3, B1-B2">
            </div>

            <div class="form-group">
                <label class="form-label">Thời gian tối đa đỗ xe (giờ)</label>
                <input type="number" class="form-input" value="24" id="maxParkingTime">
            </div>

            <div class="form-group">
                <label class="form-label">Khu vực ưu tiên cho xe điện</label>
                <input type="text" class="form-input" value="C1-C20" id="electricVehicleSpots" placeholder="Ví dụ: C1-C10">
            </div>
        </div>

        <div class="mt-6">
            <button class="save-btn" onclick="saveParkingSettings()">
                <i class="fas fa-save mr-2"></i>
                Lưu cài đặt bãi đỗ
            </button>
        </div>
    </div>

    <!-- System Settings -->
    <div class="settings-section">
        <div class="settings-header">
            <div class="settings-icon" style="background: linear-gradient(135deg, #8b5cf6, #7c3aed);">
                <i class="fas fa-cogs"></i>
            </div>
            <div>
                <h3 class="text-xl font-semibold text-gray-800">Cài đặt hệ thống</h3>
                <p class="text-gray-600 text-sm">Cấu hình chung và tính năng hệ thống</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="form-group">
                <label class="form-label">Tên hệ thống</label>
                <input type="text" class="form-input" value="Paspark Admin System" id="systemName">
            </div>

            <div class="form-group">
                <label class="form-label">Múi giờ</label>
                <select class="form-select" id="timezone">
                    <option value="Asia/Ho_Chi_Minh" selected>UTC+7 (Việt Nam)</option>
                    <option value="Asia/Bangkok">UTC+7 (Bangkok)</option>
                    <option value="Asia/Tokyo">UTC+9 (Tokyo)</option>
                    <option value="UTC">UTC</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Ngôn ngữ mặc định</label>
                <select class="form-select" id="defaultLanguage">
                    <option value="vi" selected>Tiếng Việt</option>
                    <option value="en">English</option>
                    <option value="ja">日本語</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Định dạng tiền tệ</label>
                <select class="form-select" id="currencyFormat">
                    <option value="VND" selected>VNĐ (Vietnamese Dong)</option>
                    <option value="USD">USD (US Dollar)</option>
                    <option value="EUR">EUR (Euro)</option>
                </select>
            </div>
        </div>

        <!-- Feature Toggles -->
        <div class="mt-8">
            <h4 class="text-lg font-semibold text-gray-800 mb-4">Tính năng hệ thống</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="flex items-center justify-between">
                    <div>
                        <span class="font-medium text-gray-800">Thông báo SMS</span>
                        <p class="text-sm text-gray-600">Gửi SMS thông báo cho khách hàng</p>
                    </div>
                    <label class="toggle-switch">
                        <input type="checkbox" checked>
                        <span class="slider"></span>
                    </label>
                </div>

                <div class="flex items-center justify-between">
                    <div>
                        <span class="font-medium text-gray-800">Thông báo Email</span>
                        <p class="text-sm text-gray-600">Gửi email xác nhận và hóa đơn</p>
                    </div>
                    <label class="toggle-switch">
                        <input type="checkbox" checked>
                        <span class="slider"></span>
                    </label>
                </div>

                <div class="flex items-center justify-between">
                    <div>
                        <span class="font-medium text-gray-800">Nhận diện biển số tự động</span>
                        <p class="text-sm text-gray-600">Sử dụng AI để nhận diện biển số</p>
                    </div>
                    <label class="toggle-switch">
                        <input type="checkbox" checked>
                        <span class="slider"></span>
                    </label>
                </div>

                <div class="flex items-center justify-between">
                    <div>
                        <span class="font-medium text-gray-800">Thanh toán không tiếp xúc</span>
                        <p class="text-sm text-gray-600">Thanh toán qua QR code, NFC</p>
                    </div>
                    <label class="toggle-switch">
                        <input type="checkbox" checked>
                        <span class="slider"></span>
                    </label>
                </div>

                <div class="flex items-center justify-between">
                    <div>
                        <span class="font-medium text-gray-800">Đặt chỗ trước</span>
                        <p class="text-sm text-gray-600">Cho phép khách đặt chỗ trước</p>
                    </div>
                    <label class="toggle-switch">
                        <input type="checkbox">
                        <span class="slider"></span>
                    </label>
                </div>

                <div class="flex items-center justify-between">
                    <div>
                        <span class="font-medium text-gray-800">Báo cáo tự động</span>
                        <p class="text-sm text-gray-600">Tự động tạo báo cáo hàng ngày</p>
                    </div>
                    <label class="toggle-switch">
                        <input type="checkbox" checked>
                        <span class="slider"></span>
                    </label>
                </div>
            </div>
        </div>

        <div class="mt-6">
            <button class="save-btn" onclick="saveSystemSettings()">
                <i class="fas fa-save mr-2"></i>
                Lưu cài đặt hệ thống
            </button>
        </div>
    </div>

    <!-- Notification Settings -->
    <div class="settings-section">
        <div class="settings-header">
            <div class="settings-icon" style="background: linear-gradient(135deg, #f59e0b, #d97706);">
                <i class="fas fa-bell"></i>
            </div>
            <div>
                <h3 class="text-xl font-semibold text-gray-800">Cài đặt thông báo</h3>
                <p class="text-gray-600 text-sm">Cấu hình thông báo và cảnh báo</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="form-group">
                <label class="form-label">Email admin chính</label>
                <input type="email" class="form-input" value="admin@paspark.com" id="adminEmail">
            </div>

            <div class="form-group">
                <label class="form-label">Số điện thoại admin</label>
                <input type="tel" class="form-input" value="0901234567" id="adminPhone">
            </div>

            <div class="form-group">
                <label class="form-label">Cảnh báo khi bãi đầy (%)</label>
                <input type="number" class="form-input" value="90" min="50" max="100" id="fullAlert">
            </div>

            <div class="form-group">
                <label class="form-label">Thời gian gửi báo cáo hàng ngày</label>
                <input type="time" class="form-input" value="08:00" id="reportTime">
            </div>
        </div>

        <div class="mt-6">
            <button class="save-btn" onclick="saveNotificationSettings()">
                <i class="fas fa-save mr-2"></i>
                Lưu cài đặt thông báo
            </button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function savePricingSettings() {
    const basicPrice = document.getElementById('basicPrice').value;
    const hourlyRate = document.getElementById('hourlyRate').value;
    const vipDiscount = document.getElementById('vipDiscount').value;

    showNotification('Đã lưu cài đặt giá thành công!', 'success');
}

function saveParkingSettings() {
    const totalSpots = document.getElementById('totalSpots').value;
    const totalFloors = document.getElementById('totalFloors').value;
    const vipSpots = document.getElementById('vipSpots').value;

    showNotification('Đã lưu cài đặt bãi đỗ xe thành công!', 'success');
}

function saveSystemSettings() {
    const systemName = document.getElementById('systemName').value;
    const timezone = document.getElementById('timezone').value;
    const language = document.getElementById('defaultLanguage').value;

    showNotification('Đã lưu cài đặt hệ thống thành công!', 'success');
}

function saveNotificationSettings() {
    const adminEmail = document.getElementById('adminEmail').value;
    const adminPhone = document.getElementById('adminPhone').value;
    const fullAlert = document.getElementById('fullAlert').value;

    showNotification('Đã lưu cài đặt thông báo thành công!', 'success');
}

function saveAllSettings() {
    showNotification('Đang lưu tất cả cài đặt...', 'info');

    setTimeout(() => {
        showNotification('Đã lưu tất cả cài đặt thành công!', 'success');
    }, 1500);
}

function resetToDefault() {
    if (confirm('Bạn có chắc chắn muốn khôi phục tất cả cài đặt về mặc định? Thao tác này không thể hoàn tác!')) {
        showNotification('Đang khôi phục cài đặt mặc định...', 'warning');

        setTimeout(() => {
            // Reset form values
            document.getElementById('basicPrice').value = '15000';
            document.getElementById('hourlyRate').value = '10000';
            document.getElementById('vipDiscount').value = '20';
            document.getElementById('totalSpots').value = '300';
            document.getElementById('totalFloors').value = '3';

            showNotification('Đã khôi phục cài đặt mặc định thành công!', 'success');
        }, 2000);
    }
}

function showNotification(message, type) {
    const notification = document.createElement('div');
    notification.className = `notification ${type}`;
    notification.textContent = message;

    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 15px 20px;
        border-radius: 8px;
        color: white;
        z-index: 1000;
        animation: slideIn 0.3s ease;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    `;

    if (type === 'success') notification.style.backgroundColor = '#10b981';
    if (type === 'info') notification.style.backgroundColor = '#3b82f6';
    if (type === 'warning') notification.style.backgroundColor = '#f59e0b';
    if (type === 'error') notification.style.backgroundColor = '#ef4444';

    document.body.appendChild(notification);

    setTimeout(() => {
        notification.style.animation = 'slideOut 0.3s ease';
        setTimeout(() => notification.remove(), 300);
    }, 3000);
}

// Add CSS animation keyframes
const style = document.createElement('style');
style.textContent = `
    @keyframes slideIn {
        from { transform: translateX(100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    @keyframes slideOut {
        from { transform: translateX(0); opacity: 1; }
        to { transform: translateX(100%); opacity: 0; }
    }
`;
document.head.appendChild(style);

// Auto-save functionality
document.addEventListener('DOMContentLoaded', function() {
    const inputs = document.querySelectorAll('.form-input, .form-select');

    inputs.forEach(input => {
        input.addEventListener('change', function() {
            this.style.borderColor = '#f59e0b';
            setTimeout(() => {
                this.style.borderColor = '#e5e7eb';
            }, 1000);
        });
    });

    // Toggle switches
    const toggles = document.querySelectorAll('.toggle-switch input');
    toggles.forEach(toggle => {
        toggle.addEventListener('change', function() {
            const feature = this.closest('.flex').querySelector('.font-medium').textContent;
            const status = this.checked ? 'bật' : 'tắt';
            showNotification(`Đã ${status} tính năng: ${feature}`, 'info');
        });
    });
});
</script>
@endpush
                </button>
            </div>
        </div>
    </div>

    <!-- System Settings -->
    <div class="card">
        <h3>Cài đặt hệ thống</h3>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px; margin-top: 20px;">
            <div>
                <h4 style="margin-bottom: 15px; color: #333;">Thông báo</h4>
                <div style="margin-bottom: 15px;">
                    <label style="display: flex; align-items: center; gap: 8px;">
                        <input type="checkbox" checked>
                        <span>Gửi email thông báo khi bãi đầy</span>
                    </label>
                </div>
                <div style="margin-bottom: 15px;">
                    <label style="display: flex; align-items: center; gap: 8px;">
                        <input type="checkbox" checked>
                        <span>Thông báo SMS cho khách VIP</span>
                    </label>
                </div>
                <div style="margin-bottom: 15px;">
                    <label style="display: flex; align-items: center; gap: 8px;">
                        <input type="checkbox">
                        <span>Âm thanh cảnh báo tự động</span>
                    </label>
                </div>
            </div>

            <div>
                <h4 style="margin-bottom: 15px; color: #333;">Bảo mật</h4>
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px; font-weight: 500;">Thời gian tự động đăng xuất (phút):</label>
                    <input type="number" value="30" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                </div>
                <div style="margin-bottom: 15px;">
                    <label style="display: flex; align-items: center; gap: 8px;">
                        <input type="checkbox" checked>
                        <span>Yêu cầu xác thực 2 bước</span>
                    </label>
                </div>
                <div style="margin-bottom: 15px;">
                    <label style="display: flex; align-items: center; gap: 8px;">
                        <input type="checkbox" checked>
                        <span>Ghi log hoạt động</span>
                    </label>
                </div>
            </div>
        </div>

        <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #eee;">
            <button class="btn btn-success" onclick="saveSystemSettings()">
                <i class="fas fa-save"></i>
                Lưu cài đặt hệ thống
            </button>
            <button class="btn btn-warning" onclick="resetSettings()" style="margin-left: 10px;">
                <i class="fas fa-undo"></i>
                Khôi phục mặc định
            </button>
        </div>
    </div>

    <!-- Backup & Maintenance -->
    <div class="card">
        <h3>Sao lưu & Bảo trì</h3>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 15px; margin-top: 20px;">
            <button class="btn btn-primary" onclick="backupData()">
                <i class="fas fa-database"></i>
                Sao lưu dữ liệu
            </button>
            <button class="btn btn-info" onclick="restoreData()">
                <i class="fas fa-upload"></i>
                Khôi phục dữ liệu
            </button>
            <button class="btn btn-warning" onclick="clearCache()">
                <i class="fas fa-broom"></i>
                Xóa cache hệ thống
            </button>
            <button class="btn btn-danger" onclick="maintenanceMode()">
                <i class="fas fa-tools"></i>
                Chế độ bảo trì
            </button>
        </div>
    </div>

    <!-- User Management -->
    <div class="card">
        <h3>Quản lý người dùng</h3>
        <div style="margin-top: 20px;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: #f8f9fa;">
                        <th style="padding: 12px; text-align: left; border: 1px solid #dee2e6;">Tên đăng nhập</th>
                        <th style="padding: 12px; text-align: left; border: 1px solid #dee2e6;">Vai trò</th>
                        <th style="padding: 12px; text-align: left; border: 1px solid #dee2e6;">Lần cuối đăng nhập</th>
                        <th style="padding: 12px; text-align: left; border: 1px solid #dee2e6;">Trạng thái</th>
                        <th style="padding: 12px; text-align: center; border: 1px solid #dee2e6;">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="padding: 10px; border: 1px solid #dee2e6;">admin</td>
                        <td style="padding: 10px; border: 1px solid #dee2e6;"><span style="background: #dc3545; color: white; padding: 2px 6px; border-radius: 4px; font-size: 12px;">Super Admin</span></td>
                        <td style="padding: 10px; border: 1px solid #dee2e6;">2 phút trước</td>
                        <td style="padding: 10px; border: 1px solid #dee2e6;"><span style="background: #28a745; color: white; padding: 2px 6px; border-radius: 4px; font-size: 12px;">Hoạt động</span></td>
                        <td style="padding: 10px; border: 1px solid #dee2e6; text-align: center;">
                            <button class="btn btn-sm" style="background: #ffc107; color: black; padding: 4px 8px; font-size: 12px;" onclick="editUser('admin')">Sửa</button>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 10px; border: 1px solid #dee2e6;">manager1</td>
                        <td style="padding: 10px; border: 1px solid #dee2e6;"><span style="background: #007bff; color: white; padding: 2px 6px; border-radius: 4px; font-size: 12px;">Manager</span></td>
                        <td style="padding: 10px; border: 1px solid #dee2e6;">1 giờ trước</td>
                        <td style="padding: 10px; border: 1px solid #dee2e6;"><span style="background: #28a745; color: white; padding: 2px 6px; border-radius: 4px; font-size: 12px;">Hoạt động</span></td>
                        <td style="padding: 10px; border: 1px solid #dee2e6; text-align: center;">
                            <button class="btn btn-sm" style="background: #ffc107; color: black; padding: 4px 8px; font-size: 12px; margin-right: 5px;" onclick="editUser('manager1')">Sửa</button>
                            <button class="btn btn-sm" style="background: #dc3545; color: white; padding: 4px 8px; font-size: 12px;" onclick="deactivateUser('manager1')">Vô hiệu</button>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 10px; border: 1px solid #dee2e6;">staff1</td>
                        <td style="padding: 10px; border: 1px solid #dee2e6;"><span style="background: #6c757d; color: white; padding: 2px 6px; border-radius: 4px; font-size: 12px;">Staff</span></td>
                        <td style="padding: 10px; border: 1px solid #dee2e6;">3 giờ trước</td>
                        <td style="padding: 10px; border: 1px solid #dee2e6;"><span style="background: #28a745; color: white; padding: 2px 6px; border-radius: 4px; font-size: 12px;">Hoạt động</span></td>
                        <td style="padding: 10px; border: 1px solid #dee2e6; text-align: center;">
                            <button class="btn btn-sm" style="background: #ffc107; color: black; padding: 4px 8px; font-size: 12px; margin-right: 5px;" onclick="editUser('staff1')">Sửa</button>
                            <button class="btn btn-sm" style="background: #dc3545; color: white; padding: 4px 8px; font-size: 12px;" onclick="deactivateUser('staff1')">Vô hiệu</button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div style="margin-top: 20px;">
                <a href="{{ route('admin.users') }}" class="btn btn-success">
                    <i class="fas fa-user-plus"></i>
                    Thêm người dùng mới
                </a>
            </div>
        </div>
    </div>

    <script>
        function savePricing() {
            alert('Đã lưu cài đặt giá vé!');
        }

        function saveParkingSettings() {
            alert('Đã lưu cài đặt bãi đỗ!');
        }

        function saveSystemSettings() {
            alert('Đã lưu cài đặt hệ thống!');
        }

        function resetSettings() {
            if (confirm('Bạn có chắc chắn muốn khôi phục cài đặt mặc định?')) {
                alert('Đã khôi phục cài đặt mặc định!');
            }
        }

        function backupData() {
            alert('Đang tiến hành sao lưu dữ liệu...');
        }

        function restoreData() {
            alert('Chọn file sao lưu để khôi phục...');
        }

        function clearCache() {
            alert('Đã xóa cache hệ thống!');
        }

        function maintenanceMode() {
            if (confirm('Bạn có muốn chuyển hệ thống sang chế độ bảo trì?')) {
                alert('Hệ thống đã chuyển sang chế độ bảo trì!');
            }
        }

        function editUser(username) {
            alert(`Chỉnh sửa thông tin người dùng: ${username}`);
        }

        function deactivateUser(username) {
            if (confirm(`Bạn có chắc chắn muốn vô hiệu hóa người dùng: ${username}?`)) {
                alert(`Đã vô hiệu hóa người dùng: ${username}`);
            }
        }

        function addNewUser() {
            alert('Mở form thêm người dùng mới...');
        }
    </script>
@endpush
