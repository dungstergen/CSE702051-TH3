
@extends('admin.build.master')

@section('title', 'Tài liệu hệ thống - Paspark Admin')
@section('page-title', 'Tài liệu hệ thống')
@section('breadcrumb-parent', 'Trang chủ')
@section('breadcrumb-current', 'Tài liệu')

@push('styles')
<style>
    .documentation-section {
        background: white;
        border-radius: 16px;
        padding: 24px;
        margin-bottom: 24px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        border: 1px solid #e2e8f0;
    }

    .doc-header {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 16px;
        border-bottom: 2px solid #f1f5f9;
    }

    .doc-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 16px;
        color: white;
        font-size: 20px;
    }

    .code-block {
        background: #1e293b;
        color: #e2e8f0;
        padding: 16px;
        border-radius: 8px;
        font-family: 'Courier New', monospace;
        font-size: 14px;
        margin: 12px 0;
        overflow-x: auto;
    }

    .api-endpoint {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 12px;
        margin: 8px 0;
        font-family: monospace;
    }

    .method-get { border-left: 4px solid #10b981; }
    .method-post { border-left: 4px solid #3b82f6; }
    .method-put { border-left: 4px solid #f59e0b; }
    .method-delete { border-left: 4px solid #ef4444; }
</style>
@endpush

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="documentation-section">
        <div class="text-center">
            <div class="w-20 h-20 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-book text-3xl text-white"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Tài liệu hệ thống Paspark</h1>
            <p class="text-gray-600 text-lg">Hướng dẫn sử dụng và tích hợp hệ thống quản lý bãi đỗ xe thông minh</p>
            <div class="flex justify-center items-center space-x-4 mt-4">
                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">Phiên bản 2.0</span>
                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">Cập nhật: {{ date('d/m/Y') }}</span>
            </div>
        </div>
    </div>

    <!-- Quick Navigation -->
    <div class="documentation-section">
        <div class="doc-header">
            <div class="doc-icon" style="background: linear-gradient(135deg, #667eea, #764ba2);">
                <i class="fas fa-compass"></i>
            </div>
            <div>
                <h3 class="text-xl font-semibold text-gray-800">Điều hướng nhanh</h3>
                <p class="text-gray-600 text-sm">Chọn phần bạn muốn tìm hiểu</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <a href="#overview" class="flex items-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors">
                <i class="fas fa-info-circle text-blue-600 mr-3"></i>
                <span class="font-medium text-blue-800">Tổng quan hệ thống</span>
            </a>
            <a href="#features" class="flex items-center p-4 bg-green-50 rounded-lg hover:bg-green-100 transition-colors">
                <i class="fas fa-star text-green-600 mr-3"></i>
                <span class="font-medium text-green-800">Tính năng chính</span>
            </a>
            <a href="#api" class="flex items-center p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition-colors">
                <i class="fas fa-code text-purple-600 mr-3"></i>
                <span class="font-medium text-purple-800">API Documentation</span>
            </a>
        </div>
    </div>

    <!-- System Overview -->
    <div id="overview" class="documentation-section">
        <div class="doc-header">
            <div class="doc-icon" style="background: linear-gradient(135deg, #3b82f6, #1d4ed8);">
                <i class="fas fa-chart-line"></i>
            </div>
            <div>
                <h3 class="text-xl font-semibold text-gray-800">Tổng quan hệ thống</h3>
                <p class="text-gray-600 text-sm">Kiến trúc và thành phần chính của Paspark</p>
            </div>
        </div>

        <div class="prose max-w-none">
            <p class="text-gray-700 mb-4">
                <strong>Paspark</strong> là hệ thống quản lý bãi đỗ xe thông minh được phát triển bằng Laravel Framework,
                tích hợp AI và IoT để tối ưu hóa việc quản lý không gian đỗ xe.
            </p>

            <h4 class="text-lg font-semibold text-gray-800 mb-3">Thành phần chính:</h4>
            <ul class="list-disc list-inside space-y-2 text-gray-700">
                <li><strong>Admin Dashboard:</strong> Giao diện quản trị với thống kê realtime</li>
                <li><strong>User Portal:</strong> Ứng dụng dành cho khách hàng</li>
                <li><strong>Payment Gateway:</strong> Tích hợp VNPay, MoMo, ZaloPay</li>
                <li><strong>AI License Plate Recognition:</strong> Nhận diện biển số tự động</li>
                <li><strong>IoT Integration:</strong> Kết nối với cảm biến và camera</li>
                <li><strong>Real-time Notifications:</strong> Thông báo SMS/Email tức thời</li>
            </ul>
        </div>
    </div>

    <!-- Troubleshooting -->
    <div class="documentation-section">
        <div class="doc-header">
            <div class="doc-icon" style="background: linear-gradient(135deg, #6b7280, #4b5563);">
                <i class="fas fa-tools"></i>
            </div>
            <div>
                <h3 class="text-xl font-semibold text-gray-800">Khắc phục sự cố</h3>
                <p class="text-gray-600 text-sm">Giải pháp cho các vấn đề thường gặp</p>
            </div>
        </div>

        <div class="space-y-6">
            <div>
                <h4 class="font-semibold text-gray-800 text-red-600">❌ Lỗi: Route not defined</h4>
                <p class="text-gray-700 mb-2"><strong>Nguyên nhân:</strong> Route chưa được khai báo trong web.php</p>
                <p class="text-gray-700 mb-2"><strong>Giải pháp:</strong></p>
                <div class="code-block">php artisan route:clear
php artisan config:clear
php artisan cache:clear</div>
            </div>

            <div>
                <h4 class="font-semibold text-gray-800 text-red-600">❌ Lỗi: Section not started</h4>
                <p class="text-gray-700 mb-2"><strong>Nguyên nhân:</strong> Cấu trúc Blade template sai</p>
                <p class="text-gray-700 mb-2"><strong>Giải pháp:</strong></p>
                <div class="code-block">php artisan view:clear</div>
            </div>

            <div>
                <h4 class="font-semibold text-gray-800 text-green-600">✅ Kiểm tra hệ thống</h4>
                <div class="code-block">php artisan about
php artisan route:list
php artisan config:show database</div>
            </div>
        </div>
    </div>

    <!-- Support -->
    <div class="documentation-section">
        <div class="text-center">
            <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-blue-500 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-headset text-2xl text-white"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-800 mb-2">Cần hỗ trợ?</h3>
            <p class="text-gray-600 mb-4">Liên hệ với chúng tôi để được hỗ trợ kỹ thuật</p>
            <div class="flex justify-center space-x-4">
                <a href="mailto:support@paspark.com" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-xl font-medium transition-colors">
                    <i class="fas fa-envelope mr-2"></i>
                    Email Support
                </a>
                <a href="tel:+84901234567" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-xl font-medium transition-colors">
                    <i class="fas fa-phone mr-2"></i>
                    Hotline: 0901 234 567
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Smooth scrolling for navigation links
document.addEventListener('DOMContentLoaded', function() {
    const links = document.querySelectorAll('a[href^="#"]');

    links.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();

            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);

            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });

                // Add highlight effect
                targetElement.style.backgroundColor = '#dbeafe';
                setTimeout(() => {
                    targetElement.style.backgroundColor = 'white';
                }, 2000);
            }
        });
    });

    // Copy code blocks on click
    const codeBlocks = document.querySelectorAll('.code-block');
    codeBlocks.forEach(block => {
        block.style.cursor = 'pointer';
        block.title = 'Click to copy';

        block.addEventListener('click', function() {
            navigator.clipboard.writeText(this.textContent).then(() => {
                // Show success message
                const originalBg = this.style.backgroundColor;
                this.style.backgroundColor = '#10b981';
                this.style.color = 'white';

                setTimeout(() => {
                    this.style.backgroundColor = originalBg;
                    this.style.color = '#e2e8f0';
                }, 1000);
            });
        });
    });
});
</script>
@endpush
