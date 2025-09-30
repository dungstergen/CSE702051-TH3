// Admin Panel JavaScript
document.addEventListener('DOMContentLoaded', function() {
    // Add some basic interactivity
    console.log('Admin Panel Loaded');

    // Parking spot interaction
    const parkingSpots = document.querySelectorAll('.parking-spot');
    parkingSpots.forEach(spot => {
        spot.addEventListener('click', function() {
            const spotNumber = this.textContent;
            const title = this.getAttribute('title') || '';

            if (this.classList.contains('spot-available')) {
                const action = confirm(`Vị trí ${spotNumber} đang trống. Bạn có muốn đánh dấu là đang sử dụng?`);
                if (action) {
                    this.classList.remove('spot-available');
                    this.classList.add('spot-occupied');
                    this.setAttribute('title', 'Xe: Mới vào');
                }
            } else if (this.classList.contains('spot-occupied')) {
                const action = confirm(`${title}\nBạn có muốn đánh dấu xe này đã ra khỏi bãi?`);
                if (action) {
                    this.classList.remove('spot-occupied');
                    this.classList.add('spot-available');
                    this.setAttribute('title', 'Vị trí trống');
                }
            } else if (this.classList.contains('spot-maintenance')) {
                const action = confirm(`Vị trí ${spotNumber} đang bảo trì. Bạn có muốn mở lại?`);
                if (action) {
                    this.classList.remove('spot-maintenance');
                    this.classList.add('spot-available');
                    this.setAttribute('title', 'Vị trí trống');
                }
            }
        });
    });

    // Auto refresh activity every 30 seconds (if on customers page)
    if (window.location.pathname.includes('customers')) {
        setInterval(() => {
            console.log('Auto refreshing activity feed...');
            // In real implementation, this would fetch new activities via AJAX
        }, 30000);
    }
});

// Global functions for buttons
function refreshLayout() {
    alert('Đang làm mới sơ đồ bãi đỗ xe...');
    setTimeout(() => {
        location.reload();
    }, 1000);
}

function exportReport() {
    alert('Đang xuất báo cáo...');
}

function toggleMaintenance() {
    const result = confirm('Bạn có muốn chuyển sang chế độ bảo trì không?');
    if (result) {
        alert('Đã chuyển sang chế độ bảo trì. Không cho phép xe mới vào.');
    }
}

function loadMoreActivity() {
    alert('Đang tải thêm hoạt động...');
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
}

function exportDailyReport() {
    alert('Đang xuất báo cáo ngày...');
}

function exportWeeklyReport() {
    alert('Đang xuất báo cáo tuần...');
}

function exportMonthlyReport() {
    alert('Đang xuất báo cáo tháng...');
}

function exportCustomReport() {
    alert('Mở form tùy chỉnh báo cáo...');
}

function loadMoreTransactions() {
    alert('Đang tải thêm giao dịch...');
}

// Settings functions
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
