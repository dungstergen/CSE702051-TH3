@php /** @var \App\Models\Booking $booking */ @endphp
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết đặt chỗ</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style> body{padding:20px;} </style>
    </head>
<body>
    <div class="container">
        <h1 class="mb-4">Chi tiết đặt chỗ</h1>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <div class="card">
            <div class="card-body">
                <p><strong>Mã đặt chỗ:</strong> {{ $booking->booking_code ?? ('BK'.$booking->id) }}</p>
                <p><strong>Bãi đỗ:</strong> {{ $booking->parkingLot->name ?? 'N/A' }}</p>
                <p><strong>Địa chỉ:</strong> {{ $booking->parkingLot->address ?? 'N/A' }}</p>
                <p><strong>Thời gian:</strong> {{ $booking->start_time->format('d/m/Y H:i') }} - {{ $booking->end_time->format('d/m/Y H:i') }}</p>
                <p><strong>Thời lượng:</strong> {{ $booking->duration_hours }} giờ</p>
                <p><strong>Biển số:</strong> {{ $booking->license_plate }}</p>
                <p><strong>Tổng phí:</strong> {{ number_format((float)$booking->total_cost, 0, ',', '.') }} VNĐ</p>
                <p><span class="badge bg-{{ $booking->status_color }}">{{ $booking->status_text }}</span></p>
            </div>
        </div>

        <div class="mt-3">
            <a href="{{ route('user.history') }}" class="btn btn-secondary">Lịch sử</a>
            <a href="{{ route('user.payment', ['booking_id' => $booking->id]) }}" class="btn btn-primary">Thanh toán</a>
        </div>
    </div>
</body>
</html>
