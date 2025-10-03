@extends('user.layouts.app')

@section('title', 'Chi tiết đặt chỗ')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="fa fa-ticket mr-2"></i>
                        Chi tiết đặt chỗ #{{ $booking->booking_code }}
                    </h4>
                </div>
                <div class="card-body">
                    <!-- Booking Status -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6>Trạng thái đặt chỗ:</h6>
                            <span class="badge badge-{{ $booking->status == 'confirmed' ? 'success' : ($booking->status == 'pending' ? 'warning' : 'danger') }} p-2">
                                @switch($booking->status)
                                    @case('pending')
                                        <i class="fa fa-clock"></i> Chờ xác nhận
                                        @break
                                    @case('confirmed')
                                        <i class="fa fa-check"></i> Đã xác nhận
                                        @break
                                    @case('completed')
                                        <i class="fa fa-check-circle"></i> Hoàn thành
                                        @break
                                    @case('cancelled')
                                        <i class="fa fa-times"></i> Đã hủy
                                        @break
                                @endswitch
                            </span>
                        </div>
                        <div class="col-md-6">
                            <h6>Trạng thái thanh toán:</h6>
                            <span class="badge badge-{{ $booking->payment_status == 'completed' ? 'success' : ($booking->payment_status == 'pending' ? 'warning' : 'danger') }} p-2">
                                @switch($booking->payment_status)
                                    @case('pending')
                                        <i class="fa fa-credit-card"></i> Chờ thanh toán
                                        @break
                                    @case('completed')
                                        <i class="fa fa-money"></i> Đã thanh toán
                                        @break
                                    @case('failed')
                                        <i class="fa fa-exclamation-triangle"></i> Thanh toán thất bại
                                        @break
                                    @case('cancelled')
                                        <i class="fa fa-ban"></i> Đã hủy
                                        @break
                                @endswitch
                            </span>
                        </div>
                    </div>

                    <!-- Parking Information -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5><i class="fa fa-map-marker mr-2"></i>Thông tin bãi đỗ xe</h5>
                        </div>
                        <div class="card-body">
                            <h6>{{ $booking->parkingLot->name }}</h6>
                            <p class="text-muted mb-2">
                                <i class="fa fa-location-arrow mr-1"></i>
                                {{ $booking->parkingLot->address }}
                            </p>
                            <p class="mb-0">
                                <strong>Giá: </strong>{{ number_format($booking->parkingLot->hourly_rate, 0, ',', '.') }} VNĐ/giờ
                            </p>
                        </div>
                    </div>

                    <!-- Booking Details -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h6><i class="fa fa-calendar mr-2"></i>Thời gian</h6>
                                </div>
                                <div class="card-body">
                                    <p><strong>Bắt đầu:</strong><br>{{ $booking->start_time->format('d/m/Y H:i') }}</p>
                                    <p><strong>Kết thúc:</strong><br>{{ $booking->end_time->format('d/m/Y H:i') }}</p>
                                    <p><strong>Thời lượng:</strong> {{ $booking->duration_hours }} giờ</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h6><i class="fa fa-car mr-2"></i>Thông tin xe</h6>
                                </div>
                                <div class="card-body">
                                    <p><strong>Loại xe:</strong>
                                        @switch($booking->vehicle_type)
                                            @case('car') Ô tô @break
                                            @case('motorcycle') Xe máy @break
                                            @case('bicycle') Xe đạp @break
                                        @endswitch
                                    </p>
                                    <p><strong>Biển số:</strong> {{ $booking->license_plate }}</p>
                                    <p><strong>SĐT liên hệ:</strong> {{ $booking->phone_number }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($booking->servicePackage)
                    <div class="card mt-4">
                        <div class="card-header">
                            <h6><i class="fa fa-gift mr-2"></i>Gói dịch vụ</h6>
                        </div>
                        <div class="card-body">
                            <h6>{{ $booking->servicePackage->name }}</h6>
                            <p>{{ $booking->servicePackage->description }}</p>
                            <p><strong>Giá:</strong> {{ number_format($booking->servicePackage->price, 0, ',', '.') }} VNĐ</p>
                        </div>
                    </div>
                    @endif

                    @if($booking->special_requests)
                    <div class="card mt-4">
                        <div class="card-header">
                            <h6><i class="fa fa-comment mr-2"></i>Yêu cầu đặc biệt</h6>
                        </div>
                        <div class="card-body">
                            <p>{{ $booking->special_requests }}</p>
                        </div>
                    </div>
                    @endif

                    <!-- Total Cost -->
                    <div class="card mt-4 border-primary">
                        <div class="card-body text-center">
                            <h4 class="text-primary">
                                <strong>Tổng chi phí: {{ number_format($booking->total_cost, 0, ',', '.') }} VNĐ</strong>
                            </h4>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="text-center mt-4">
                        @if($booking->status == 'pending' && $booking->payment_status == 'pending')
                            <a href="{{ route('user.payment') }}?booking_id={{ $booking->id }}" class="btn btn-success btn-lg mr-2">
                                <i class="fa fa-credit-card mr-2"></i>Thanh toán ngay
                            </a>
                        @endif

                        @if(in_array($booking->status, ['pending', 'confirmed']) && $booking->start_time->gt(now()->addHour()))
                            <form action="{{ route('user.booking.cancel', $booking->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-danger btn-lg"
                                        onclick="return confirm('Bạn có chắc chắn muốn hủy đặt chỗ này?')">
                                    <i class="fa fa-times mr-2"></i>Hủy đặt chỗ
                                </button>
                            </form>
                        @endif

                        <a href="{{ route('user.history') }}" class="btn btn-secondary btn-lg">
                            <i class="fa fa-arrow-left mr-2"></i>Quay lại lịch sử
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Auto refresh page every 30 seconds for status updates
    setTimeout(function() {
        location.reload();
    }, 30000);
</script>
@endsection
