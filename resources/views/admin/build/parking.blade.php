
@extends('admin.layouts')

@section('title', 'Quản lý bãi đỗ xe - Paspark Admin')
@section('page_title', 'Quản lý bãi đỗ xe')
@section('breadcrumb', 'Quản lý bãi đỗ xe')

@section('additional_css')
<style>
    .parking-spot {
        width: 60px;
        height: 40px;
        border: 2px solid #ddd;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
    }

    .parking-spot:hover {
        transform: scale(1.1);
        z-index: 10;
    }

    .spot-available {
        background: linear-gradient(135deg, #10b981, #34d399);
        color: white;
        border-color: #059669;
    }

    .spot-occupied {
        background: linear-gradient(135deg, #ef4444, #f87171);
        color: white;
        border-color: #dc2626;
    }

    .spot-maintenance {
        background: linear-gradient(135deg, #f59e0b, #fbbf24);
        color: white;
        border-color: #d97706;
    }

    .spot-reserved {
        background: linear-gradient(135deg, #3b82f6, #60a5fa);
        color: white;
        border-color: #2563eb;
    }

    .parking-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(60px, 1fr));
        gap: 15px;
        padding: 20px;
        background: #f8fafc;
        border-radius: 12px;
        margin: 20px 0;
    }

    .parking-section {
        background: white;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        margin-bottom: 24px;
    }

    .section-header {
        display: flex;
        justify-content: between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 12px;
        border-bottom: 2px solid #e5e7eb;
    }

    .status-card {
        background: linear-gradient(135deg, #ffffff, #f8fafc);
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
    }

    .status-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 16px rgba(0,0,0,0.1);
    }

    .control-panel {
        background: white;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }
</style>
@endsection

@section('content')
<div class="space-y-6">
    <!-- Control Panel -->
    <div class="control-panel">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Quản lý bãi đỗ xe</h2>
                <p class="text-gray-600">Giám sát và điều khiển tất cả các vị trí đỗ xe trong hệ thống</p>
            </div>
            <div class="flex space-x-3 mt-4 lg:mt-0">
                <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl font-medium transition-colors">
                    <i class="fas fa-sync-alt mr-2"></i>
                    Làm mới
                </button>
                <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-xl font-medium transition-colors">
                    <i class="fas fa-plus mr-2"></i>
                    Thêm vị trí
                </button>
                <button class="bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded-xl font-medium transition-colors">
                    <i class="fas fa-tools mr-2"></i>
                    Bảo trì
                </button>
            </div>
        </div>
    </div>

    <!-- Status Overview -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="status-card hover-lift">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-car text-blue-600 text-xl"></i>
                </div>
                <span class="text-2xl font-bold text-gray-800">300</span>
            </div>
            <h3 class="text-gray-600 font-medium mb-2">Tổng vị trí</h3>
            <div class="flex items-center text-sm">
                <span class="text-green-600 font-medium">+2</span>
                <span class="text-gray-500 ml-1">so với tháng trước</span>
            </div>
        </div>

        <div class="status-card hover-lift">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-ban text-red-600 text-xl"></i>
                </div>
                <span class="text-2xl font-bold text-gray-800">245</span>
            </div>
            <h3 class="text-gray-600 font-medium mb-2">Đang sử dụng</h3>
            <div class="flex items-center text-sm">
                <span class="text-red-600 font-medium">81.7%</span>
                <span class="text-gray-500 ml-1">tỉ lệ sử dụng</span>
            </div>
        </div>

        <div class="status-card hover-lift">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-check-circle text-green-600 text-xl"></i>
                </div>
                <span class="text-2xl font-bold text-gray-800">53</span>
            </div>
            <h3 class="text-gray-600 font-medium mb-2">Còn trống</h3>
            <div class="flex items-center text-sm">
                <span class="text-green-600 font-medium">17.7%</span>
                <span class="text-gray-500 ml-1">có sẵn</span>
            </div>
        </div>

        <div class="status-card hover-lift">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-tools text-orange-600 text-xl"></i>
                </div>
                <span class="text-2xl font-bold text-gray-800">2</span>
            </div>
            <h3 class="text-gray-600 font-medium mb-2">Bảo trì</h3>
            <div class="flex items-center text-sm">
                <span class="text-orange-600 font-medium">0.7%</span>
                <span class="text-gray-500 ml-1">tạm đóng</span>
            </div>
        </div>
    </div>

    <!-- Parking Layout Sections -->
    <!-- Section A -->
    <div class="parking-section">
        <div class="section-header">
            <div>
                <h3 class="text-xl font-semibold text-gray-800">Khu A - Lối vào chính</h3>
                <p class="text-gray-600 text-sm">40 vị trí | 25 đang sử dụng | 15 trống</p>
            </div>
            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-2">
                    <div class="w-4 h-4 bg-green-500 rounded-full"></div>
                    <span class="text-sm text-gray-600">Trống</span>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="w-4 h-4 bg-red-500 rounded-full"></div>
                    <span class="text-sm text-gray-600">Đang sử dụng</span>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="w-4 h-4 bg-orange-500 rounded-full"></div>
                    <span class="text-sm text-gray-600">Bảo trì</span>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="w-4 h-4 bg-blue-500 rounded-full"></div>
                    <span class="text-sm text-gray-600">Đặt trước</span>
                </div>
            </div>
        </div>

        <div class="parking-grid">
            <!-- Row 1 -->
            <div class="parking-spot spot-occupied" data-spot="A1" title="A1 - Xe: 29A-12345">A1</div>
            <div class="parking-spot spot-available" data-spot="A2" title="A2 - Trống">A2</div>
            <div class="parking-spot spot-occupied" data-spot="A3" title="A3 - Xe: 30B-67890">A3</div>
            <div class="parking-spot spot-available" data-spot="A4" title="A4 - Trống">A4</div>
            <div class="parking-spot spot-occupied" data-spot="A5" title="A5 - Xe: 31C-11111">A5</div>
            <div class="parking-spot spot-available" data-spot="A6" title="A6 - Trống">A6</div>
            <div class="parking-spot spot-occupied" data-spot="A7" title="A7 - Xe: 32D-22222">A7</div>
            <div class="parking-spot spot-available" data-spot="A8" title="A8 - Trống">A8</div>
            <div class="parking-spot spot-occupied" data-spot="A9" title="A9 - Xe: 33E-33333">A9</div>
            <div class="parking-spot spot-available" data-spot="A10" title="A10 - Trống">A10</div>

            <!-- Row 2 -->
            <div class="parking-spot spot-available" data-spot="A11" title="A11 - Trống">A11</div>
            <div class="parking-spot spot-occupied" data-spot="A12" title="A12 - Xe: 34F-44444">A12</div>
            <div class="parking-spot spot-available" data-spot="A13" title="A13 - Trống">A13</div>
            <div class="parking-spot spot-occupied" data-spot="A14" title="A14 - Xe: 35G-55555">A14</div>
            <div class="parking-spot spot-available" data-spot="A15" title="A15 - Trống">A15</div>
            <div class="parking-spot spot-occupied" data-spot="A16" title="A16 - Xe: 36H-66666">A16</div>
            <div class="parking-spot spot-available" data-spot="A17" title="A17 - Trống">A17</div>
            <div class="parking-spot spot-occupied" data-spot="A18" title="A18 - Xe: 37I-77777">A18</div>
            <div class="parking-spot spot-available" data-spot="A19" title="A19 - Trống">A19</div>
            <div class="parking-spot spot-occupied" data-spot="A20" title="A20 - Xe: 38J-88888">A20</div>

            <!-- Row 3 -->
            <div class="parking-spot spot-occupied" data-spot="A21" title="A21 - Xe: 39K-99999">A21</div>
            <div class="parking-spot spot-available" data-spot="A22" title="A22 - Trống">A22</div>
            <div class="parking-spot spot-occupied" data-spot="A23" title="A23 - Xe: 40L-00000">A23</div>
            <div class="parking-spot spot-available" data-spot="A24" title="A24 - Trống">A24</div>
            <div class="parking-spot spot-occupied" data-spot="A25" title="A25 - Xe: 41M-11223">A25</div>
            <div class="parking-spot spot-available" data-spot="A26" title="A26 - Trống">A26</div>
            <div class="parking-spot spot-occupied" data-spot="A27" title="A27 - Xe: 42N-33445">A27</div>
            <div class="parking-spot spot-available" data-spot="A28" title="A28 - Trống">A28</div>
            <div class="parking-spot spot-occupied" data-spot="A29" title="A29 - Xe: 43O-55667">A29</div>
            <div class="parking-spot spot-available" data-spot="A30" title="A30 - Trống">A30</div>

            <!-- Row 4 -->
            <div class="parking-spot spot-available" data-spot="A31" title="A31 - Trống">A31</div>
            <div class="parking-spot spot-occupied" data-spot="A32" title="A32 - Xe: 44P-77889">A32</div>
            <div class="parking-spot spot-available" data-spot="A33" title="A33 - Trống">A33</div>
            <div class="parking-spot spot-occupied" data-spot="A34" title="A34 - Xe: 45Q-99001">A34</div>
            <div class="parking-spot spot-available" data-spot="A35" title="A35 - Trống">A35</div>
            <div class="parking-spot spot-occupied" data-spot="A36" title="A36 - Xe: 46R-11223">A36</div>
            <div class="parking-spot spot-reserved" data-spot="A37" title="A37 - Đặt trước">A37</div>
            <div class="parking-spot spot-occupied" data-spot="A38" title="A38 - Xe: 47S-33445">A38</div>
            <div class="parking-spot spot-available" data-spot="A39" title="A39 - Trống">A39</div>
                    </div>
    </div>

    <!-- Section B -->
    <div class="parking-section">
        <div class="section-header">
            <div>
                <h3 class="text-xl font-semibold text-gray-800">Khu B - Gần thang máy</h3>
                <p class="text-gray-600 text-sm">35 vị trí | 20 đang sử dụng | 13 trống | 2 bảo trì</p>
            </div>
        </div>

        <div class="parking-grid">
            <!-- Row 1 -->
            <div class="parking-spot spot-occupied" data-spot="B1" title="B1 - Xe: 50A-11111">B1</div>
            <div class="parking-spot spot-available" data-spot="B2" title="B2 - Trống">B2</div>
            <div class="parking-spot spot-occupied" data-spot="B3" title="B3 - Xe: 51B-22222">B3</div>
            <div class="parking-spot spot-maintenance" data-spot="B4" title="B4 - Đang bảo trì">B4</div>
            <div class="parking-spot spot-occupied" data-spot="B5" title="B5 - Xe: 52C-33333">B5</div>
            <div class="parking-spot spot-available" data-spot="B6" title="B6 - Trống">B6</div>
            <div class="parking-spot spot-occupied" data-spot="B7" title="B7 - Xe: 53D-44444">B7</div>

            <!-- Row 2 -->
            <div class="parking-spot spot-available" data-spot="B8" title="B8 - Trống">B8</div>
            <div class="parking-spot spot-occupied" data-spot="B9" title="B9 - Xe: 54E-55555">B9</div>
            <div class="parking-spot spot-available" data-spot="B10" title="B10 - Trống">B10</div>
            <div class="parking-spot spot-occupied" data-spot="B11" title="B11 - Xe: 55F-66666">B11</div>
            <div class="parking-spot spot-available" data-spot="B12" title="B12 - Trống">B12</div>
            <div class="parking-spot spot-occupied" data-spot="B13" title="B13 - Xe: 56G-77777">B13</div>
            <div class="parking-spot spot-available" data-spot="B14" title="B14 - Trống">B14</div>

            <!-- Row 3 -->
            <div class="parking-spot spot-occupied" data-spot="B15" title="B15 - Xe: 57H-88888">B15</div>
            <div class="parking-spot spot-available" data-spot="B16" title="B16 - Trống">B16</div>
            <div class="parking-spot spot-occupied" data-spot="B17" title="B17 - Xe: 58I-99999">B17</div>
            <div class="parking-spot spot-available" data-spot="B18" title="B18 - Trống">B18</div>
            <div class="parking-spot spot-occupied" data-spot="B19" title="B19 - Xe: 59J-00000">B19</div>
            <div class="parking-spot spot-reserved" data-spot="B20" title="B20 - Đặt trước">B20</div>
            <div class="parking-spot spot-occupied" data-spot="B21" title="B21 - Xe: 60K-11122">B21</div>

            <!-- Row 4 -->
            <div class="parking-spot spot-available" data-spot="B22" title="B22 - Trống">B22</div>
            <div class="parking-spot spot-occupied" data-spot="B23" title="B23 - Xe: 61L-33344">B23</div>
            <div class="parking-spot spot-available" data-spot="B24" title="B24 - Trống">B24</div>
            <div class="parking-spot spot-occupied" data-spot="B25" title="B25 - Xe: 62M-55566">B25</div>
            <div class="parking-spot spot-available" data-spot="B26" title="B26 - Trống">B26</div>
            <div class="parking-spot spot-occupied" data-spot="B27" title="B27 - Xe: 63N-77788">B27</div>
            <div class="parking-spot spot-available" data-spot="B28" title="B28 - Trống">B28</div>

            <!-- Row 5 -->
            <div class="parking-spot spot-occupied" data-spot="B29" title="B29 - Xe: 64O-99900">B29</div>
            <div class="parking-spot spot-available" data-spot="B30" title="B30 - Trống">B30</div>
            <div class="parking-spot spot-occupied" data-spot="B31" title="B31 - Xe: 65P-11223">B31</div>
            <div class="parking-spot spot-available" data-spot="B32" title="B32 - Trống">B32</div>
            <div class="parking-spot spot-occupied" data-spot="B33" title="B33 - Xe: 66Q-44556">B33</div>
            <div class="parking-spot spot-maintenance" data-spot="B34" title="B34 - Đang bảo trì">B34</div>
            <div class="parking-spot spot-available" data-spot="B35" title="B35 - Trống">B35</div>
        </div>
    </div>

    <!-- Vehicle Management Panel -->
    <div class="bg-white rounded-2xl p-6 shadow-lg">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-semibold text-gray-800">Danh sách xe hiện tại</h3>
            <div class="flex space-x-3">
                <select id="filter-status" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="all">Tất cả trạng thái</option>
                    <option value="available">Chỗ trống</option>
                    <option value="occupied">Đang sử dụng</option>
                    <option value="maintenance">Bảo trì</option>
                </select>
                <input type="text" id="search-plate" placeholder="Tìm theo biển số xe..." class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition-colors" onclick="exportParkingData()">
                    <i class="fas fa-download mr-2"></i>
                    Xuất dữ liệu
                </button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full table-auto">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Biển số</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Loại xe</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vị trí</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thời gian đỗ</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phí dự kiến</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thao tác</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr class="vehicle-item hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap"><span class="plate-number font-medium text-gray-900">29A-12345</span></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Xe con</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">A1</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2h 30p</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-green-600">50.000₫</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                            <button class="text-blue-600 hover:text-blue-900" onclick="viewVehicleDetails('29A-12345')">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="text-red-600 hover:text-red-900" onclick="removeVehicle('29A-12345')">
                                <i class="fas fa-sign-out-alt"></i>
                            </button>
                        </td>
                    </tr>
                    <tr class="vehicle-item hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap"><span class="plate-number font-medium text-gray-900">30B-67890</span></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">SUV</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">A3</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">1h 15p</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-green-600">25.000₫</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                            <button class="text-blue-600 hover:text-blue-900" onclick="viewVehicleDetails('30B-67890')">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="text-red-600 hover:text-red-900" onclick="removeVehicle('30B-67890')">
                                <i class="fas fa-sign-out-alt"></i>
                            </button>
                        </td>
                    </tr>
                    <tr class="vehicle-item hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap"><span class="plate-number font-medium text-gray-900">31C-11111</span></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Xe tải nhỏ</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">A5</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">45p</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-green-600">15.000₫</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                            <button class="text-blue-600 hover:text-blue-900" onclick="viewVehicleDetails('31C-11111')">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="text-red-600 hover:text-red-900" onclick="removeVehicle('31C-11111')">
                                <i class="fas fa-sign-out-alt"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('additional_js')
<script>
// Parking management functions
function refreshParkingLayout() {
    showNotification('Đã làm mới sơ đồ bãi đỗ xe', 'success');

    const spots = document.querySelectorAll('.parking-spot');
    spots.forEach(spot => {
        spot.style.opacity = '0.5';
        setTimeout(() => {
            spot.style.opacity = '1';
        }, 500);
    });
}

function viewVehicleDetails(plateNumber) {
    showNotification(`Đang tải thông tin xe ${plateNumber}...`, 'info');
}

function removeVehicle(plateNumber) {
    if (confirm(`Bạn có chắc muốn đưa xe ${plateNumber} ra khỏi bãi?`)) {
        showNotification(`Đã đưa xe ${plateNumber} ra khỏi bãi`, 'success');
    }
}

function exportParkingData() {
    showNotification('Đang xuất dữ liệu...', 'info');
    setTimeout(() => {
        showNotification('Xuất dữ liệu thành công!', 'success');
    }, 2000);
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

// Interactive parking spot clicks
document.addEventListener('DOMContentLoaded', function() {
    const parkingSpots = document.querySelectorAll('.parking-spot');

    parkingSpots.forEach(spot => {
        spot.addEventListener('click', function() {
            const spotId = this.getAttribute('data-spot');
            const title = this.getAttribute('title');

            showNotification(`${title}`, 'info');
        });
    });

    // Search functionality
    document.getElementById('search-plate')?.addEventListener('keyup', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const vehicleItems = document.querySelectorAll('.vehicle-item');

        vehicleItems.forEach(item => {
            const plateNumber = item.querySelector('.plate-number').textContent.toLowerCase();
            if (plateNumber.includes(searchTerm)) {
                item.style.display = 'table-row';
            } else {
                item.style.display = 'none';
            }
        });
    });

    // Filter functionality
    document.getElementById('filter-status')?.addEventListener('change', function(e) {
        const filterValue = e.target.value;
        const parkingSpots = document.querySelectorAll('.parking-spot');

        parkingSpots.forEach(spot => {
            if (filterValue === 'all') {
                spot.style.display = 'flex';
            } else {
                const hasClass = spot.classList.contains(`spot-${filterValue}`);
                spot.style.display = hasClass ? 'flex' : 'none';
            }
        });
    });
});
</script>
        </div>
    </div>
        </div>

        <!-- Complete Parking Grid based on the image -->
        <div class="parking-grid">
            <!-- Row A -->
            <div class="parking-spot spot-occupied" title="Xe: 29A-123.45">A1</div>
            <div class="parking-spot spot-available" title="Vị trí trống">A2</div>
            <div class="parking-spot spot-occupied" title="Xe: 51B-789.12">A3</div>
            <div class="parking-spot spot-occupied" title="Xe: 30C-456.78">A4</div>
            <div class="parking-spot spot-available" title="Vị trí trống">A5</div>
            <div class="parking-spot spot-occupied" title="Xe: 77E-654.32">A6</div>
            <div class="parking-spot spot-available" title="Vị trí trống">A7</div>
            <div class="parking-spot spot-occupied" title="Xe: 29F-987.65">A8</div>
            <div class="parking-spot spot-occupied" title="Xe: 51G-321.09">A9</div>
            <div class="parking-spot spot-available" title="Vị trí trống">A10</div>
            <div class="parking-spot spot-occupied" title="Xe: 43H-159.75">B1</div>
            <div class="parking-spot spot-occupied" title="Xe: 88I-753.24">B2</div>
            <div class="parking-spot spot-available" title="Vị trí trống">B3</div>

            <!-- Row B -->
            <div class="parking-spot spot-maintenance" title="Đang bảo trì">B4</div>
            <div class="parking-spot spot-occupied" title="Xe: 30J-852.14">B5</div>
            <div class="parking-spot spot-available" title="Vị trí trống">B6</div>
            <div class="parking-spot spot-occupied" title="Xe: 77K-963.85">B7</div>
            <div class="parking-spot spot-occupied" title="Xe: 51C-456.78">B8</div>
            <div class="parking-spot spot-available" title="Vị trí trống">B9</div>
            <div class="parking-spot spot-occupied" title="Xe: 29L-741.96">B10</div>
            <div class="parking-spot spot-available" title="Vị trí trống">C1</div>
            <div class="parking-spot spot-occupied" title="Xe: 43M-258.36">C2</div>
            <div class="parking-spot spot-occupied" title="Xe: 88N-147.52">C3</div>
            <div class="parking-spot spot-available" title="Vị trí trống">C4</div>
            <div class="parking-spot spot-occupied" title="Xe: 30O-369.84">C5</div>
            <div class="parking-spot spot-occupied" title="Xe: 77P-582.17">C6</div>

            <!-- Row C -->
            <div class="parking-spot spot-available" title="Vị trí trống">C7</div>
            <div class="parking-spot spot-occupied" title="Xe: 51Q-693.48">C8</div>
            <div class="parking-spot spot-available" title="Vị trí trống">C9</div>
            <div class="parking-spot spot-occupied" title="Xe: 29R-804.59">C10</div>
            <div class="parking-spot spot-occupied" title="Xe: 43S-915.60">D1</div>
            <div class="parking-spot spot-available" title="Vị trí trống">D2</div>
            <div class="parking-spot spot-occupied" title="Xe: 88T-026.71">D3</div>
            <div class="parking-spot spot-occupied" title="Xe: 30U-137.82">D4</div>
            <div class="parking-spot spot-available" title="Vị trí trống">D5</div>
            <div class="parking-spot spot-occupied" title="Xe: 77V-248.93">D6</div>
            <div class="parking-spot spot-occupied" title="Xe: 51W-359.04">D7</div>
            <div class="parking-spot spot-available" title="Vị trí trống">D8</div>
            <div class="parking-spot spot-occupied" title="Xe: 29X-460.15">D9</div>

            <!-- Row D -->
            <div class="parking-spot spot-occupied" title="Xe: 43Y-571.26">D10</div>
        </div>

        <div class="parking-actions">
            <button class="btn btn-primary" onclick="refreshLayout()">
                <i class="fas fa-sync-alt"></i>
                Làm mới sơ đồ
            </button>
            <button class="btn btn-success" onclick="exportReport()">
                <i class="fas fa-file-export"></i>
                Xuất báo cáo
            </button>
            <button class="btn btn-warning" onclick="toggleMaintenance()">
                <i class="fas fa-tools"></i>
                Chế độ bảo trì
            </button>
        </div>
    </div>

    <!-- Parking Statistics -->
    <div class="row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 30px;">
        <div class="activity-feed">
            <h2>
                <i class="fas fa-chart-pie"></i>
                Thống kê theo thời gian
            </h2>

            <div style="padding: 20px;">
                <div style="display: flex; justify-content: space-between; margin-bottom: 15px;">
                    <span>6:00 - 8:00 (Giờ cao điểm sáng)</span>
                    <strong style="color: #ff6b35;">95%</strong>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 15px;">
                    <span>8:00 - 17:00 (Giờ làm việc)</span>
                    <strong style="color: #ff6b35;">88%</strong>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 15px;">
                    <span>17:00 - 19:00 (Giờ cao điểm chiều)</span>
                    <strong style="color: #ff6b35;">92%</strong>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 15px;">
                    <span>19:00 - 22:00 (Giờ tối)</span>
                    <strong style="color: #28a745;">45%</strong>
                </div>
                <div style="display: flex; justify-content: space-between;">
                    <span>22:00 - 6:00 (Giờ đêm)</span>
                    <strong style="color: #28a745;">15%</strong>
                </div>
            </div>
        </div>

        <div class="activity-feed">
            <h2>
                <i class="fas fa-exclamation-triangle"></i>
                Cảnh báo & Thông báo
            </h2>

            <div class="activity-item">
                <div class="activity-icon" style="background-color: #fff3cd; color: #856404;">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="activity-content">
                    <div class="title">Vị trí B4 cần bảo trì</div>
                    <div class="time">Đã báo cáo 2 giờ trước</div>
                </div>
            </div>

            <div class="activity-item">
                <div class="activity-icon" style="background-color: #d1ecf1; color: #0c5460;">
                    <i class="fas fa-info-circle"></i>
                </div>
                <div class="activity-content">
                    <div class="title">Công suất gần đầy (98/158)</div>
                    <div class="time">Cập nhật liên tục</div>
                </div>
            </div>

            <div class="activity-item">
                <div class="activity-icon" style="background-color: #d4edda; color: #155724;">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="activity-content">
                    <div class="title">Hệ thống hoạt động bình thường</div>
                    <div class="time">Kiểm tra lần cuối: 5 phút trước</div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function refreshLayout() {
            alert('Đang làm mới sơ đồ bãi đỗ xe...');
            // Simulate refresh
            setTimeout(() => {
                location.reload();
            }, 1000);
        }

        function exportReport() {
            alert('Đang xuất báo cáo...');
            // In real implementation, this would generate and download a report
        }

        function toggleMaintenance() {
            const result = confirm('Bạn có muốn chuyển sang chế độ bảo trì không?');
            if (result) {
                alert('Đã chuyển sang chế độ bảo trì. Không cho phép xe mới vào.');
            }
        }

        // Enhanced parking spot interaction
        document.addEventListener('DOMContentLoaded', function() {
            const parkingSpots = document.querySelectorAll('.parking-spot');
            parkingSpots.forEach(spot => {
                spot.addEventListener('click', function() {
                    const spotNumber = this.textContent;
                    const title = this.getAttribute('title');

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
        });
    </script>
@endsection
