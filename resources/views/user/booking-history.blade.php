@extends('user.layouts.app')

@section('title', 'Lịch sử đặt chỗ')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="fa fa-history mr-2"></i>
                        Lịch sử đặt chỗ
                    </h4>
                </div>
                <div class="card-body">
                    @if($bookings->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Mã đặt chỗ</th>
                                        <th>Bãi đỗ xe</th>
                                        <th>Thời gian</th>
                                        <th>Loại xe</th>
                                        <th>Tổng tiền</th>
                                        <th>Trạng thái</th>
                                        <th>Thanh toán</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($bookings as $booking)
                                    <tr>
                                        <td>
                                            <strong>{{ $booking->booking_code }}</strong>
                                            <br>
                                            <small class="text-muted">{{ $booking->created_at->format('d/m/Y H:i') }}</small>
                                        </td>
                                        <td>
                                            <strong>{{ $booking->parkingLot->name }}</strong>
                                            <br>
                                            <small class="text-muted">{{ Str::limit($booking->parkingLot->address, 30) }}</small>
                                        </td>
                                        <td>
                                            <strong>Bắt đầu:</strong> {{ $booking->start_time->format('d/m H:i') }}<br>
                                            <strong>Kết thúc:</strong> {{ $booking->end_time->format('d/m H:i') }}<br>
                                            <small class="text-info">{{ $booking->duration_hours }} giờ</small>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @switch($booking->vehicle_type)
                                                    @case('car')
                                                        <i class="fa fa-car text-primary mr-2"></i>Ô tô
                                                        @break
                                                    @case('motorcycle')
                                                        <i class="fa fa-motorcycle text-warning mr-2"></i>Xe máy
                                                        @break
                                                    @case('bicycle')
                                                        <i class="fa fa-bicycle text-success mr-2"></i>Xe đạp
                                                        @break
                                                @endswitch
                                            </div>
                                            <small class="text-muted">{{ $booking->license_plate }}</small>
                                        </td>
                                        <td>
                                            <strong class="text-primary">{{ number_format($booking->total_cost, 0, ',', '.') }} VNĐ</strong>
                                            @if($booking->servicePackage)
                                                <br><small class="text-info">+ {{ $booking->servicePackage->name }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge badge-{{ $booking->status == 'confirmed' ? 'success' : ($booking->status == 'pending' ? 'warning' : ($booking->status == 'completed' ? 'primary' : 'danger')) }} p-2">
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
                                        </td>
                                        <td>
                                            <span class="badge badge-{{ $booking->payment_status == 'completed' ? 'success' : ($booking->payment_status == 'pending' ? 'warning' : 'danger') }} p-2">
                                                @switch($booking->payment_status)
                                                    @case('pending')
                                                        <i class="fa fa-credit-card"></i> Chờ thanh toán
                                                        @break
                                                    @case('completed')
                                                        <i class="fa fa-money"></i> Đã thanh toán
                                                        @break
                                                    @case('failed')
                                                        <i class="fa fa-exclamation-triangle"></i> Thất bại
                                                        @break
                                                    @case('cancelled')
                                                        <i class="fa fa-ban"></i> Đã hủy
                                                        @break
                                                @endswitch
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group-vertical btn-group-sm" role="group">
                                                <a href="{{ route('user.booking.show', $booking->id) }}"
                                                   class="btn btn-outline-info btn-sm mb-1">
                                                    <i class="fa fa-eye"></i> Chi tiết
                                                </a>

                                                @if($booking->status == 'pending' && $booking->payment_status == 'pending')
                                                    <a href="{{ route('user.payment') }}?booking_id={{ $booking->id }}"
                                                       class="btn btn-outline-success btn-sm mb-1">
                                                        <i class="fa fa-credit-card"></i> Thanh toán
                                                    </a>
                                                @endif

                                                @if(in_array($booking->status, ['pending', 'confirmed']) && $booking->start_time->gt(now()->addHour()))
                                                    <form action="{{ route('user.booking.cancel', $booking->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-outline-danger btn-sm"
                                                                onclick="return confirm('Bạn có chắc chắn muốn hủy đặt chỗ này?')">
                                                            <i class="fa fa-times"></i> Hủy
                                                        </button>
                                                    </form>
                                                @endif

                                                @if($booking->status == 'completed')
                                                    <a href="{{ route('user.booking') }}?rebook={{ $booking->id }}"
                                                       class="btn btn-outline-primary btn-sm">
                                                        <i class="fa fa-refresh"></i> Đặt lại
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $bookings->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fa fa-calendar-times-o fa-5x text-muted mb-3"></i>
                            <h4 class="text-muted">Chưa có lịch sử đặt chỗ</h4>
                            <p class="text-muted">Bạn chưa có bất kỳ đặt chỗ nào. Hãy bắt đầu đặt chỗ đầu tiên của bạn!</p>
                            <a href="{{ route('user.booking') }}" class="btn btn-primary btn-lg">
                                <i class="fa fa-plus mr-2"></i>Đặt chỗ ngay
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    @if($bookings->count() > 0)
    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h3 class="text-primary">{{ $bookings->where('status', 'completed')->count() }}</h3>
                    <p class="text-muted mb-0">Đặt chỗ hoàn thành</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h3 class="text-warning">{{ $bookings->where('status', 'pending')->count() }}</h3>
                    <p class="text-muted mb-0">Chờ xác nhận</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h3 class="text-success">{{ $bookings->where('payment_status', 'completed')->count() }}</h3>
                    <p class="text-muted mb-0">Đã thanh toán</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h3 class="text-info">{{ number_format($bookings->where('payment_status', 'completed')->sum('total_cost'), 0, ',', '.') }}</h3>
                    <p class="text-muted mb-0">Tổng chi tiêu (VNĐ)</p>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
    // Auto refresh every minute to update status
    setInterval(function() {
        location.reload();
    }, 60000);

    // Filter functionality (if needed)
    function filterBookings(status) {
        // Implementation for filtering bookings by status
        console.log('Filter by status:', status);
    }
</script>
@endsection
