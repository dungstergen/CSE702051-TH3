@extends('user.layouts.app')

@section('title', 'Đặt chỗ đỗ xe')

@section('styles')
<style>
    .parking-lot-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        cursor: pointer;
    }
    
    .parking-lot-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
    
    .parking-lot-card.selected {
        border: 2px solid #007bff;
        background: linear-gradient(135deg, #f8f9ff 0%, #e6f3ff 100%);
    }
    
    .availability-indicator {
        display: inline-block;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        margin-right: 5px;
    }
    
    .available { background-color: #28a745; }
    .limited { background-color: #ffc107; }
    .full { background-color: #dc3545; }
    
    .booking-form {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 15px;
        padding: 30px;
    }
    
    .booking-form .form-control {
        border-radius: 8px;
        border: none;
        padding: 12px 15px;
    }
    
    .booking-form .form-control:focus {
        box-shadow: 0 0 0 0.2rem rgba(255,255,255,0.25);
    }
    
    .service-package-card {
        border: 2px solid transparent;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .service-package-card:hover {
        border-color: #007bff;
        transform: translateY(-2px);
    }
    
    .service-package-card.selected {
        border-color: #007bff;
        background: #f8f9ff;
    }
    
    .recent-booking {
        background: #f8f9fa;
        border-left: 4px solid #007bff;
        padding: 15px;
        margin-bottom: 15px;
        border-radius: 5px;
        cursor: pointer;
        transition: background 0.3s ease;
    }
    
    .recent-booking:hover {
        background: #e9ecef;
    }
</style>
@endsection

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <h2 class="text-center mb-5">
                <i class="fa fa-car text-primary mr-2"></i>
                Đặt chỗ đỗ xe
            </h2>
        </div>
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
                                        
                                        @if($lot->facilities)
                                            <div class="mb-2">
                                                @foreach(json_decode($lot->facilities) as $facility)
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
                            <div class="card service-package-card h-100" onclick="selectServicePackage({{ $package->id }})">
                                <div class="card-body text-center">
                                    <h6 class="card-title">{{ $package->name }}</h6>
                                    <p class="text-muted small">{{ $package->description }}</p>
                                    <h5 class="text-primary">{{ number_format($package->price, 0, ',', '.') }} VNĐ</h5>
                                    
                                    @if($package->features)
                                        <div class="mt-2">
                                            @foreach(json_decode($package->features) as $feature)
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
                               min="{{ now()->format('Y-m-d\TH:i') }}" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Thời gian kết thúc</label>
                        <input type="datetime-local" class="form-control" name="end_time" id="end_time" required>
                    </div>
                    
                    <!-- Vehicle Information -->
                    <div class="form-group">
                        <label>Loại xe</label>
                        <select class="form-control" name="vehicle_type" required>
                            <option value="">Chọn loại xe</option>
                            <option value="car">Ô tô</option>
                            <option value="motorcycle">Xe máy</option>
                            <option value="bicycle">Xe đạp</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Biển số xe</label>
                        <input type="text" class="form-control" name="license_plate" 
                               placeholder="VD: 30A-12345" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Số điện thoại</label>
                        <input type="tel" class="form-control" name="phone_number" 
                               placeholder="0912345678" value="{{ auth()->user()->phone ?? '' }}" required>
                    </div>
                    
                    <!-- Special Requests -->
                    <div class="form-group">
                        <label>Yêu cầu đặc biệt (Tùy chọn)</label>
                        <textarea class="form-control" name="special_requests" rows="3" 
                                  placeholder="Ghi chú thêm về yêu cầu đặc biệt..."></textarea>
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
                    
                    <button type="submit" class="btn btn-light btn-block btn-lg" id="bookingSubmit" disabled>
                        <i class="fa fa-calendar-plus-o mr-2"></i>Đặt chỗ ngay
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
let selectedParkingLot = null;
let selectedServicePackage = null;

// Select parking lot
function selectParkingLot(lotId) {
    // Remove previous selection
    document.querySelectorAll('.parking-lot-card').forEach(card => {
        card.classList.remove('selected');
    });
    
    // Add selection to clicked card
    event.currentTarget.classList.add('selected');
    
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
function selectServicePackage(packageId) {
    // Toggle selection
    const clickedCard = event.currentTarget;
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
@endsection