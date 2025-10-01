
@extends('admin.layouts')

@section('title', 'Quản lý khách hàng - Paspark Admin')
@section('page_title', 'Quản lý khách hàng')
@section('breadcrumb', 'Khách hàng')

@section('additional_css')
<style>
    .customer-card {
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
        border: 1px solid #e5e7eb;
    }

    .customer-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 16px rgba(0,0,0,0.1);
    }

    .customer-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea, #764ba2);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 18px;
    }

    .vip-badge {
        background: linear-gradient(45deg, #f59e0b, #d97706);
        color: white;
        padding: 2px 8px;
        border-radius: 12px;
        font-size: 10px;
        font-weight: bold;
        text-transform: uppercase;
    }

    .regular-badge {
        background: linear-gradient(45deg, #6b7280, #4b5563);
        color: white;
        padding: 2px 8px;
        border-radius: 12px;
        font-size: 10px;
        font-weight: bold;
        text-transform: uppercase;
    }

    .status-active {
        color: #10b981;
        font-weight: 600;
    }

    .status-inactive {
        color: #6b7280;
        font-weight: 600;
    }

    .filter-tabs {
        display: flex;
        background: #f3f4f6;
        border-radius: 12px;
        padding: 4px;
        margin-bottom: 24px;
    }

    .filter-tab {
        flex: 1;
        padding: 12px 16px;
        text-align: center;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 500;
        color: #6b7280;
    }

    .filter-tab.active {
        background: white;
        color: #1f2937;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
</style>
@endsection

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="bg-white rounded-2xl p-6 shadow-lg">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Quản lý khách hàng</h2>
                <p class="text-gray-600">Theo dõi và quản lý thông tin khách hàng sử dụng dịch vụ</p>
            </div>
            <div class="flex space-x-3 mt-4 lg:mt-0">
                <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl font-medium transition-colors" onclick="showAddCustomerModal()">
                    <i class="fas fa-plus mr-2"></i>
                    Thêm khách hàng
                </button>
                <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-xl font-medium transition-colors" onclick="exportCustomerData()">
                    <i class="fas fa-file-export mr-2"></i>
                    Xuất dữ liệu
                </button>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="customer-card hover-lift">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-users text-blue-600 text-xl"></i>
                </div>
                <span class="text-2xl font-bold text-gray-800">1,247</span>
            </div>
            <h3 class="text-gray-600 font-medium mb-2">Tổng khách hàng</h3>
            <div class="flex items-center text-sm">
                <span class="text-green-600 font-medium">+12%</span>
                <span class="text-gray-500 ml-1">tháng này</span>
            </div>
        </div>

        <div class="customer-card hover-lift">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-car text-green-600 text-xl"></i>
                </div>
                <span class="text-2xl font-bold text-gray-800">98</span>
            </div>
            <h3 class="text-gray-600 font-medium mb-2">Đang đỗ xe</h3>
            <div class="flex items-center text-sm">
                <span class="text-blue-600 font-medium">Hiện tại</span>
                <span class="text-gray-500 ml-1">trong bãi</span>
            </div>
        </div>

        <div class="customer-card hover-lift">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-crown text-yellow-600 text-xl"></i>
                </div>
                <span class="text-2xl font-bold text-gray-800">156</span>
            </div>
            <h3 class="text-gray-600 font-medium mb-2">VIP Members</h3>
            <div class="flex items-center text-sm">
                <span class="text-yellow-600 font-medium">12.5%</span>
                <span class="text-gray-500 ml-1">tổng khách hàng</span>
            </div>
        </div>

        <div class="customer-card hover-lift">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-user-plus text-purple-600 text-xl"></i>
                </div>
                <span class="text-2xl font-bold text-gray-800">23</span>
            </div>
            <h3 class="text-gray-600 font-medium mb-2">Khách mới hôm nay</h3>
            <div class="flex items-center text-sm">
                <span class="text-purple-600 font-medium">Đăng ký mới</span>
            </div>
        </div>
    </div>

    <!-- Filter Tabs -->
    <div class="bg-white rounded-2xl p-6 shadow-lg">
        <div class="filter-tabs">
            <div class="filter-tab active" data-filter="all">
                <i class="fas fa-users mr-2"></i>
                Tất cả (1,247)
            </div>
            <div class="filter-tab" data-filter="vip">
                <i class="fas fa-crown mr-2"></i>
                VIP (156)
            </div>
            <div class="filter-tab" data-filter="regular">
                <i class="fas fa-user mr-2"></i>
                Thường (1,091)
            </div>
            <div class="filter-tab" data-filter="active">
                <i class="fas fa-car mr-2"></i>
                Đang đỗ xe (98)
            </div>
        </div>

        <!-- Search and Filter Controls -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-6">
            <div class="flex space-x-4">
                <div class="relative">
                    <input type="text" id="searchCustomer" placeholder="Tìm theo tên, SĐT, biển số..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 w-80">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
                <select class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option>Sắp xếp theo</option>
                    <option>Tên A-Z</option>
                    <option>Tên Z-A</option>
                    <option>Ngày đăng ký</option>
                    <option>Số lần sử dụng</option>
                </select>
            </div>
        </div>

        <!-- Customer Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="customerGrid">
            <!-- Customer Card 1 -->
            <div class="customer-card customer-item" data-type="vip" data-status="active">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center space-x-3">
                        <div class="customer-avatar">NVA</div>
                        <div>
                            <h4 class="font-semibold text-gray-800">Nguyễn Văn A</h4>
                            <p class="text-sm text-gray-500">ID: #001234</p>
                        </div>
                    </div>
                    <span class="vip-badge">VIP</span>
                </div>

                <div class="space-y-2 mb-4">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">Số điện thoại:</span>
                        <span class="font-medium">0912-345-678</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">Biển số xe:</span>
                        <span class="font-medium">29A-12345</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">Vị trí hiện tại:</span>
                        <span class="font-medium text-green-600">A1</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">Trạng thái:</span>
                        <span class="status-active">Đang đỗ xe</span>
                    </div>
                </div>

                <div class="flex space-x-2">
                    <button class="flex-1 bg-blue-50 text-blue-600 py-2 px-3 rounded-lg text-sm font-medium hover:bg-blue-100 transition-colors" onclick="viewCustomerDetails('001234')">
                        <i class="fas fa-eye mr-1"></i>
                        Chi tiết
                    </button>
                    <button class="flex-1 bg-green-50 text-green-600 py-2 px-3 rounded-lg text-sm font-medium hover:bg-green-100 transition-colors" onclick="contactCustomer('0912345678')">
                        <i class="fas fa-phone mr-1"></i>
                        Liên hệ
                    </button>
                </div>
            </div>

            <!-- Customer Card 2 -->
            <div class="customer-card customer-item" data-type="regular" data-status="inactive">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center space-x-3">
                        <div class="customer-avatar">LTB</div>
                        <div>
                            <h4 class="font-semibold text-gray-800">Lê Thị B</h4>
                            <p class="text-sm text-gray-500">ID: #001235</p>
                        </div>
                    </div>
                    <span class="regular-badge">Thường</span>
                </div>

                <div class="space-y-2 mb-4">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">Số điện thoại:</span>
                        <span class="font-medium">0923-456-789</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">Biển số xe:</span>
                        <span class="font-medium">30B-67890</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">Lần cuối sử dụng:</span>
                        <span class="font-medium">2 ngày trước</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">Trạng thái:</span>
                        <span class="status-inactive">Không đỗ xe</span>
                    </div>
                </div>

                <div class="flex space-x-2">
                    <button class="flex-1 bg-blue-50 text-blue-600 py-2 px-3 rounded-lg text-sm font-medium hover:bg-blue-100 transition-colors" onclick="viewCustomerDetails('001235')">
                        <i class="fas fa-eye mr-1"></i>
                        Chi tiết
                    </button>
                    <button class="flex-1 bg-green-50 text-green-600 py-2 px-3 rounded-lg text-sm font-medium hover:bg-green-100 transition-colors" onclick="contactCustomer('0923456789')">
                        <i class="fas fa-phone mr-1"></i>
                        Liên hệ
                    </button>
                </div>
            </div>

            <!-- Customer Card 3 -->
            <div class="customer-card customer-item" data-type="vip" data-status="active">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center space-x-3">
                        <div class="customer-avatar">TVC</div>
                        <div>
                            <h4 class="font-semibold text-gray-800">Trần Văn C</h4>
                            <p class="text-sm text-gray-500">ID: #001236</p>
                        </div>
                    </div>
                    <span class="vip-badge">VIP</span>
                </div>

                <div class="space-y-2 mb-4">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">Số điện thoại:</span>
                        <span class="font-medium">0934-567-890</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">Biển số xe:</span>
                        <span class="font-medium">31C-11111</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">Vị trí hiện tại:</span>
                        <span class="font-medium text-green-600">B5</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">Trạng thái:</span>
                        <span class="status-active">Đang đỗ xe</span>
                    </div>
                </div>

                <div class="flex space-x-2">
                    <button class="flex-1 bg-blue-50 text-blue-600 py-2 px-3 rounded-lg text-sm font-medium hover:bg-blue-100 transition-colors" onclick="viewCustomerDetails('001236')">
                        <i class="fas fa-eye mr-1"></i>
                        Chi tiết
                    </button>
                    <button class="flex-1 bg-green-50 text-green-600 py-2 px-3 rounded-lg text-sm font-medium hover:bg-green-100 transition-colors" onclick="contactCustomer('0934567890')">
                        <i class="fas fa-phone mr-1"></i>
                        Liên hệ
                    </button>
                </div>
            </div>

            <!-- Customer Card 4 -->
            <div class="customer-card customer-item" data-type="regular" data-status="inactive">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center space-x-3">
                        <div class="customer-avatar">PTD</div>
                        <div>
                            <h4 class="font-semibold text-gray-800">Phạm Thị D</h4>
                            <p class="text-sm text-gray-500">ID: #001237</p>
                        </div>
                    </div>
                    <span class="regular-badge">Thường</span>
                </div>

                <div class="space-y-2 mb-4">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">Số điện thoại:</span>
                        <span class="font-medium">0945-678-901</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">Biển số xe:</span>
                        <span class="font-medium">32D-22222</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">Lần cuối sử dụng:</span>
                        <span class="font-medium">1 tuần trước</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">Trạng thái:</span>
                        <span class="status-inactive">Không đỗ xe</span>
                    </div>
                </div>

                <div class="flex space-x-2">
                    <button class="flex-1 bg-blue-50 text-blue-600 py-2 px-3 rounded-lg text-sm font-medium hover:bg-blue-100 transition-colors" onclick="viewCustomerDetails('001237')">
                        <i class="fas fa-eye mr-1"></i>
                        Chi tiết
                    </button>
                    <button class="flex-1 bg-green-50 text-green-600 py-2 px-3 rounded-lg text-sm font-medium hover:bg-green-100 transition-colors" onclick="contactCustomer('0945678901')">
                        <i class="fas fa-phone mr-1"></i>
                        Liên hệ
                    </button>
                </div>
            </div>

            <!-- Customer Card 5 -->
            <div class="customer-card customer-item" data-type="regular" data-status="active">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center space-x-3">
                        <div class="customer-avatar">HVE</div>
                        <div>
                            <h4 class="font-semibold text-gray-800">Hoàng Văn E</h4>
                            <p class="text-sm text-gray-500">ID: #001238</p>
                        </div>
                    </div>
                    <span class="regular-badge">Thường</span>
                </div>

                <div class="space-y-2 mb-4">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">Số điện thoại:</span>
                        <span class="font-medium">0956-789-012</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">Biển số xe:</span>
                        <span class="font-medium">33E-33333</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">Vị trí hiện tại:</span>
                        <span class="font-medium text-green-600">A9</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">Trạng thái:</span>
                        <span class="status-active">Đang đỗ xe</span>
                    </div>
                </div>

                <div class="flex space-x-2">
                    <button class="flex-1 bg-blue-50 text-blue-600 py-2 px-3 rounded-lg text-sm font-medium hover:bg-blue-100 transition-colors" onclick="viewCustomerDetails('001238')">
                        <i class="fas fa-eye mr-1"></i>
                        Chi tiết
                    </button>
                    <button class="flex-1 bg-green-50 text-green-600 py-2 px-3 rounded-lg text-sm font-medium hover:bg-green-100 transition-colors" onclick="contactCustomer('0956789012')">
                        <i class="fas fa-phone mr-1"></i>
                        Liên hệ
                    </button>
                </div>
            </div>

            <!-- Customer Card 6 -->
            <div class="customer-card customer-item" data-type="vip" data-status="inactive">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center space-x-3">
                        <div class="customer-avatar">NTF</div>
                        <div>
                            <h4 class="font-semibold text-gray-800">Ngô Thị F</h4>
                            <p class="text-sm text-gray-500">ID: #001239</p>
                        </div>
                    </div>
                    <span class="vip-badge">VIP</span>
                </div>

                <div class="space-y-2 mb-4">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">Số điện thoại:</span>
                        <span class="font-medium">0967-890-123</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">Biển số xe:</span>
                        <span class="font-medium">34F-44444</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">Lần cuối sử dụng:</span>
                        <span class="font-medium">3 ngày trước</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">Trạng thái:</span>
                        <span class="status-inactive">Không đỗ xe</span>
                    </div>
                </div>

                <div class="flex space-x-2">
                    <button class="flex-1 bg-blue-50 text-blue-600 py-2 px-3 rounded-lg text-sm font-medium hover:bg-blue-100 transition-colors" onclick="viewCustomerDetails('001239')">
                        <i class="fas fa-eye mr-1"></i>
                        Chi tiết
                    </button>
                    <button class="flex-1 bg-green-50 text-green-600 py-2 px-3 rounded-lg text-sm font-medium hover:bg-green-100 transition-colors" onclick="contactCustomer('0967890123')">
                        <i class="fas fa-phone mr-1"></i>
                        Liên hệ
                    </button>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="flex justify-center mt-6">
            <nav class="flex space-x-2">
                <button class="px-3 py-2 text-sm text-gray-500 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">Trước</button>
                <button class="px-3 py-2 text-sm text-white bg-blue-600 rounded-lg">1</button>
                <button class="px-3 py-2 text-sm text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">2</button>
                <button class="px-3 py-2 text-sm text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">3</button>
                <button class="px-3 py-2 text-sm text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">Sau</button>
            </nav>
        </div>
    </div>
</div>
@endsection

@section('additional_js')
<script>
function showAddCustomerModal() {
    showNotification('Chức năng thêm khách hàng sẽ có trong phiên bản tiếp theo', 'info');
}

function exportCustomerData() {
    showNotification('Đang xuất dữ liệu khách hàng...', 'info');
    setTimeout(() => {
        showNotification('Xuất dữ liệu thành công!', 'success');
    }, 2000);
}

function viewCustomerDetails(customerId) {
    showNotification(`Đang tải thông tin chi tiết khách hàng #${customerId}...`, 'info');
}

function contactCustomer(phone) {
    showNotification(`Đang kết nối với ${phone}...`, 'info');
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
    `;

    if (type === 'success') notification.style.backgroundColor = '#10b981';
    if (type === 'info') notification.style.backgroundColor = '#3b82f6';
    if (type === 'warning') notification.style.backgroundColor = '#f59e0b';
    if (type === 'error') notification.style.backgroundColor = '#ef4444';

    document.body.appendChild(notification);

    setTimeout(() => {
        notification.remove();
    }, 3000);
}

document.addEventListener('DOMContentLoaded', function() {
    // Filter tabs functionality
    const filterTabs = document.querySelectorAll('.filter-tab');
    const customerItems = document.querySelectorAll('.customer-item');

    filterTabs.forEach(tab => {
        tab.addEventListener('click', function() {
            // Remove active class from all tabs
            filterTabs.forEach(t => t.classList.remove('active'));
            // Add active class to clicked tab
            this.classList.add('active');

            const filter = this.getAttribute('data-filter');

            customerItems.forEach(item => {
                if (filter === 'all') {
                    item.style.display = 'block';
                } else if (filter === 'active') {
                    const status = item.getAttribute('data-status');
                    item.style.display = status === 'active' ? 'block' : 'none';
                } else {
                    const type = item.getAttribute('data-type');
                    item.style.display = type === filter ? 'block' : 'none';
                }
            });
        });
    });

    // Search functionality
    document.getElementById('searchCustomer').addEventListener('keyup', function(e) {
        const searchTerm = e.target.value.toLowerCase();

        customerItems.forEach(item => {
            const customerName = item.querySelector('h4').textContent.toLowerCase();
            const customerPhone = item.querySelector('.space-y-2 .font-medium').textContent.toLowerCase();

            if (customerName.includes(searchTerm) || customerPhone.includes(searchTerm)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    });
});
</script>

        </div>

        <div class="activity-item">
            <div class="activity-icon exit">
                <i class="fas fa-sign-out-alt"></i>
            </div>
            <div class="activity-content">
                <div class="title">Xe 30B-987.65 rời vị trí C5</div>
                <div class="time">5 phút trước • Khách hàng: Trần Thị B • Thời gian đỗ: 3h 45m • Phí: 45.000đ</div>
            </div>
            <div style="margin-left: auto; padding: 4px 8px; background: #6c757d; color: white; border-radius: 4px; font-size: 12px;">
                Thường
            </div>
        </div>

        <div class="activity-item">
            <div class="activity-icon enter">
                <i class="fas fa-sign-in-alt"></i>
            </div>
            <div class="activity-content">
                <div class="title">Xe 51C-456.78 vào vị trí B8</div>
                <div class="time">8 phút trước • Khách hàng: Lê Văn C • Lần đầu sử dụng</div>
            </div>
            <div style="margin-left: auto; padding: 4px 8px; background: #17a2b8; color: white; border-radius: 4px; font-size: 12px;">
                Mới
            </div>
        </div>

        <div class="activity-item">
            <div class="activity-icon exit">
                <i class="fas fa-sign-out-alt"></i>
            </div>
            <div class="activity-content">
                <div class="title">Xe 43D-321.09 rời vị trí D2</div>
                <div class="time">12 phút trước • Khách hàng: Phạm Thị D • Thời gian đỗ: 1h 20m • Phí: 20.000đ</div>
            </div>
            <div style="margin-left: auto; padding: 4px 8px; background: #6c757d; color: white; border-radius: 4px; font-size: 12px;">
                Thường
            </div>
        </div>

        <div class="activity-item">
            <div class="activity-icon enter">
                <i class="fas fa-sign-in-alt"></i>
            </div>
            <div class="activity-content">
                <div class="title">Xe 77E-654.32 vào vị trí A6</div>
                <div class="time">15 phút trước • Khách hàng: Hoàng Văn E • Thẻ VIP</div>
            </div>
            <div style="margin-left: auto; padding: 4px 8px; background: #28a745; color: white; border-radius: 4px; font-size: 12px;">
                VIP
            </div>
        </div>

        <div class="activity-item">
            <div class="activity-icon enter">
                <i class="fas fa-sign-in-alt"></i>
            </div>
            <div class="activity-content">
                <div class="title">Xe 88F-789.01 vào vị trí C3</div>
                <div class="time">18 phút trước • Khách hàng: Đặng Thị F • Thẻ thường</div>
            </div>
            <div style="margin-left: auto; padding: 4px 8px; background: #6c757d; color: white; border-radius: 4px; font-size: 12px;">
                Thường
            </div>
        </div>

        <div class="activity-item">
            <div class="activity-icon exit">
                <i class="fas fa-sign-out-alt"></i>
            </div>
            <div class="activity-content">
                <div class="title">Xe 92G-345.67 rời vị trí B5</div>
                <div class="time">22 phút trước • Khách hàng: Vũ Văn G • Thời gian đỗ: 2h 15m • Phí: 30.000đ</div>
            </div>
            <div style="margin-left: auto; padding: 4px 8px; background: #6c757d; color: white; border-radius: 4px; font-size: 12px;">
                Thường
            </div>
        </div>

        <div class="activity-item">
            <div class="activity-icon enter">
                <i class="fas fa-sign-in-alt"></i>
            </div>
            <div class="activity-content">
                <div class="title">Xe 15H-890.12 vào vị trí D7</div>
                <div class="time">25 phút trước • Khách hàng: Mai Thị H • Thẻ VIP</div>
            </div>
            <div style="margin-left: auto; padding: 4px 8px; background: #28a745; color: white; border-radius: 4px; font-size: 12px;">
                VIP
            </div>
        </div>

        <div class="activity-item">
            <div class="activity-icon exit">
                <i class="fas fa-sign-out-alt"></i>
            </div>
            <div class="activity-content">
                <div class="title">Xe 67I-234.56 rời vị trí A9</div>
                <div class="time">28 phút trước • Khách hàng: Bùi Văn I • Thời gian đỗ: 4h 10m • Phí: 60.000đ</div>
            </div>
            <div style="margin-left: auto; padding: 4px 8px; background: #6c757d; color: white; border-radius: 4px; font-size: 12px;">
                Thường
            </div>
        </div>

        <div class="activity-item">
            <div class="activity-icon enter">
                <i class="fas fa-sign-in-alt"></i>
            </div>
            <div class="activity-content">
                <div class="title">Xe 34J-567.89 vào vị trí C8</div>
                <div class="time">30 phút trước • Khách hàng: Lý Thị J • Lần đầu sử dụng</div>
            </div>
            <div style="margin-left: auto; padding: 4px 8px; background: #17a2b8; color: white; border-radius: 4px; font-size: 12px;">
                Mới
            </div>
        </div>

        <!-- Load More Button -->
        <div style="text-align: center; margin-top: 20px;">
            <button class="btn btn-primary" onclick="loadMoreActivity()">
                <i class="fas fa-plus"></i>
                Xem thêm hoạt động
            </button>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 30px;">
        <div class="card">
            <h3>Thao tác nhanh</h3>
            <div style="display: flex; flex-direction: column; gap: 10px; margin-top: 15px;">
                <a href="{{ route('admin.customers.add') }}" class="btn btn-primary" style="text-decoration: none; text-align: center;">
                    <i class="fas fa-user-plus"></i>
                    Thêm khách hàng mới
                </a>
                <a href="{{ route('admin.customers.vip') }}" class="btn btn-success" style="text-decoration: none; text-align: center;">
                    <i class="fas fa-star"></i>
                    Cấp thẻ VIP
                </a>
                <button class="btn btn-warning" onclick="exportCustomerList()">
                    <i class="fas fa-file-export"></i>
                    Xuất danh sách khách hàng
                </button>
            </div>
        </div>

        <div class="card">
            <h3>Thống kê nhanh</h3>
            <div style="margin-top: 15px;">
                <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                    <span>Xe vào hôm nay:</span>
                    <strong>234 lượt</strong>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                    <span>Xe ra hôm nay:</span>
                    <strong>198 lượt</strong>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                    <span>Tỷ lệ VIP:</span>
                    <strong>12.5%</strong>
                </div>
                <div style="display: flex; justify-content: space-between;">
                    <span>Thời gian đỗ trung bình:</span>
                    <strong>2h 35m</strong>
                </div>
            </div>
        </div>
    </div>

    <script>
        function loadMoreActivity() {
            alert('Đang tải thêm hoạt động...');
            // In real implementation, this would load more activity records
        }

        function addNewCustomer() {
            const name = prompt('Nhập tên khách hàng:');
            const phone = prompt('Nhập số điện thoại:');
            const plate = prompt('Nhập biển số xe:');

            if (name && phone && plate) {
                alert(`Đã thêm khách hàng mới:\nTên: ${name}\nSĐT: ${phone}\nBiển số: ${plate}`);
            }
        }

        function issueVIPCard() {
            const customer = prompt('Nhập tên khách hàng để cấp thẻ VIP:');
            if (customer) {
                alert(`Đã cấp thẻ VIP cho khách hàng: ${customer}`);
            }
        }

        function exportCustomerList() {
            alert('Đang xuất danh sách khách hàng...');
            // In real implementation, this would generate and download a customer list
        }

        // Auto refresh activity every 30 seconds
        setInterval(() => {
            console.log('Auto refreshing activity feed...');
            // In real implementation, this would fetch new activities via AJAX
        }, 30000);
    </script>
@endsection
