@extends('admin.layout')
@section('page-title', 'Chi tiết Đánh giá - Paspark Admin')
@section('page-heading', 'Chi tiết Đánh giá #' . $review->id)

@section('content')
<div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h6 class="mb-2 dark:text-white text-xl font-bold">Chi tiết Đánh giá #{{ $review->id }}</h6>
                        <div class="flex items-center space-x-4 text-sm text-gray-600">
                            <span><i class="fas fa-calendar-alt mr-1"></i>{{ $review->created_at->format('d/m/Y H:i') }}</span>
                            <span><i class="fas fa-clock mr-1"></i>{{ $review->created_at->diffForHumans() }}</span>
                            @if($review->updated_at != $review->created_at)
                                <span class="text-blue-600"><i class="fas fa-edit mr-1"></i>Đã chỉnh sửa {{ $review->updated_at->diffForHumans() }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="space-x-2">
                        <a href="{{ route('admin.reviews.edit', $review) }}" class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer bg-gradient-to-tl from-green-600 to-lime-400 leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs">
                            <i class="fas fa-edit mr-2"></i>Chỉnh sửa
                        </a>
                        <form method="POST" action="{{ route('admin.reviews.destroy', $review) }}" class="inline-block" onsubmit="return confirm('Bạn có chắc chắn muốn xóa đánh giá này?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer bg-gradient-to-tl from-red-600 to-rose-400 leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs">
                                <i class="fas fa-trash mr-2"></i>Xóa
                            </button>
                        </form>
                        <a href="{{ route('admin.reviews.index') }}" class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer bg-gradient-to-tl from-orange-500 to-yellow-500 leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs">
                            <i class="fas fa-arrow-left mr-2"></i>Quay lại
                        </a>
                    </div>
                </div>
            </div>

            <div class="flex-auto p-6">
                <div class="flex flex-wrap -mx-3">
                    <!-- Review Rating Card -->
                    <div class="w-full max-w-full px-3 mb-6 lg:w-4/12 xl:w-3/12">
                        <div class="relative flex flex-col min-w-0 break-words bg-gradient-to-tl from-yellow-400 to-orange-400 border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border text-white">
                            <div class="p-6 text-center">
                                <div class="text-6xl font-bold mb-2">
                                    {{ $review->rating }}
                                </div>
                                <div class="flex justify-center mb-3">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star text-2xl {{ $i <= $review->rating ? 'text-white' : 'text-gray-200' }}"></i>
                                    @endfor
                                </div>
                                <p class="text-lg font-semibold">
                                    @switch($review->rating)
                                        @case(1) Rất tệ @break
                                        @case(2) Tệ @break
                                        @case(3) Bình thường @break
                                        @case(4) Tốt @break
                                        @case(5) Rất tốt @break
                                    @endswitch
                                </p>
                                <p class="text-sm opacity-90">Số sao đánh giá</p>
                            </div>
                        </div>
                    </div>

                    <!-- Review Details -->
                    <div class="w-full max-w-full px-3 mb-6 lg:w-8/12 xl:w-9/12">
                        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-lg rounded-2xl bg-clip-border">
                            <div class="p-6">
                                <h6 class="text-lg font-semibold text-slate-700 mb-4">Thông tin chi tiết</h6>

                                <!-- Customer Information -->
                                <div class="flex items-center p-4 mb-4 bg-gray-50 rounded-lg">
                                    <div class="flex-shrink-0 w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center">
                                        <i class="fas fa-user text-white"></i>
                                    </div>
                                    <div class="ml-4 flex-grow">
                                        <h6 class="text-md font-semibold text-gray-800">{{ $review->user->name }}</h6>
                                        <p class="text-sm text-gray-600">{{ $review->user->email }}</p>
                                        <p class="text-xs text-gray-500">Khách hàng từ {{ $review->user->created_at->format('d/m/Y') }}</p>
                                    </div>
                                    <div class="text-right">
                                        <a href="{{ route('admin.users.show', $review->user) }}" class="text-blue-600 hover:text-blue-800 text-sm">
                                            <i class="fas fa-external-link-alt mr-1"></i>Xem profile
                                        </a>
                                    </div>
                                </div>

                                <!-- Parking Lot Information -->
                                <div class="flex items-center p-4 mb-4 bg-green-50 rounded-lg">
                                    <div class="flex-shrink-0 w-12 h-12 bg-green-500 rounded-full flex items-center justify-center">
                                        <i class="fas fa-parking text-white"></i>
                                    </div>
                                    <div class="ml-4 flex-grow">
                                        <h6 class="text-md font-semibold text-gray-800">{{ $review->parkingLot->name }}</h6>
                                        <p class="text-sm text-gray-600">{{ $review->parkingLot->address }}</p>
                                        <div class="flex items-center mt-1">
                                            <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded">{{ number_format($review->parkingLot->price_per_hour) }}đ/giờ</span>
                                            <span class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded ml-2">{{ $review->parkingLot->total_spots }} chỗ</span>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <a href="{{ route('admin.parking-lots.show', $review->parkingLot) }}" class="text-green-600 hover:text-green-800 text-sm">
                                            <i class="fas fa-external-link-alt mr-1"></i>Xem bãi đỗ
                                        </a>
                                    </div>
                                </div>

                                <!-- Booking Information -->
                                @if($review->booking)
                                <div class="flex items-center p-4 mb-4 bg-purple-50 rounded-lg">
                                    <div class="flex-shrink-0 w-12 h-12 bg-purple-500 rounded-full flex items-center justify-center">
                                        <i class="fas fa-calendar-check text-white"></i>
                                    </div>
                                    <div class="ml-4 flex-grow">
                                        <h6 class="text-md font-semibold text-gray-800">Booking #{{ $review->booking->id }}</h6>
                                        <p class="text-sm text-gray-600">
                                            <i class="fas fa-clock mr-1"></i>
                                            {{ $review->booking->start_time->format('d/m/Y H:i') }} - {{ $review->booking->end_time->format('d/m/Y H:i') }}
                                        </p>
                                        <div class="flex items-center mt-1">
                                            <span class="text-xs bg-purple-100 text-purple-800 px-2 py-1 rounded">
                                                {{ $review->booking->status }}
                                            </span>
                                            <span class="text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded ml-2">
                                                {{ number_format($review->booking->total_price) }}đ
                                            </span>
                                            @if($review->booking->vehicle_plate)
                                            <span class="text-xs bg-gray-100 text-gray-800 px-2 py-1 rounded ml-2">
                                                {{ $review->booking->vehicle_plate }}
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <a href="{{ route('admin.bookings.show', $review->booking) }}" class="text-purple-600 hover:text-purple-800 text-sm">
                                            <i class="fas fa-external-link-alt mr-1"></i>Xem booking
                                        </a>
                                    </div>
                                </div>
                                @endif

                                <!-- Review Comment -->
                                <div class="p-4 bg-blue-50 rounded-lg">
                                    <h6 class="text-md font-semibold text-blue-700 mb-3">
                                        <i class="fas fa-comment-dots mr-2"></i>Bình luận của khách hàng
                                    </h6>
                                    @if($review->comment)
                                        <blockquote class="text-gray-700 italic border-l-4 border-blue-400 pl-4">
                                            "{{ $review->comment }}"
                                        </blockquote>
                                    @else
                                        <p class="text-gray-500 italic">Khách hàng chưa để lại bình luận nào.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Statistics & Actions -->
                    <div class="w-full max-w-full px-3 mb-6">
                        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-lg rounded-2xl bg-clip-border">
                            <div class="p-6">
                                <h6 class="text-lg font-semibold text-slate-700 mb-4">Thống kê liên quan</h6>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <!-- User's Total Reviews -->
                                    <div class="text-center p-4 bg-blue-50 rounded-lg">
                                        <div class="text-2xl font-bold text-blue-600">{{ $review->user->reviews()->count() }}</div>
                                        <p class="text-sm text-blue-700">Tổng đánh giá của khách hàng</p>
                                        <div class="flex justify-center mt-2">
                                            @php $avgUserRating = $review->user->reviews()->avg('rating') ?? 0; @endphp
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star text-sm {{ $i <= round($avgUserRating) ? 'text-yellow-500' : 'text-gray-300' }}"></i>
                                            @endfor
                                            <span class="ml-1 text-xs">({{ number_format($avgUserRating, 1) }})</span>
                                        </div>
                                    </div>

                                    <!-- Parking Lot's Total Reviews -->
                                    <div class="text-center p-4 bg-green-50 rounded-lg">
                                        <div class="text-2xl font-bold text-green-600">{{ $review->parkingLot->reviews()->count() }}</div>
                                        <p class="text-sm text-green-700">Tổng đánh giá bãi đỗ xe</p>
                                        <div class="flex justify-center mt-2">
                                            @php $avgParkingRating = $review->parkingLot->reviews()->avg('rating') ?? 0; @endphp
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star text-sm {{ $i <= round($avgParkingRating) ? 'text-yellow-500' : 'text-gray-300' }}"></i>
                                            @endfor
                                            <span class="ml-1 text-xs">({{ number_format($avgParkingRating, 1) }})</span>
                                        </div>
                                    </div>

                                    <!-- Review Position -->
                                    <div class="text-center p-4 bg-purple-50 rounded-lg">
                                        @php
                                            $totalReviews = \App\Models\Review::count();
                                            $olderReviews = \App\Models\Review::where('created_at', '<', $review->created_at)->count();
                                            $position = $olderReviews + 1;
                                        @endphp
                                        <div class="text-2xl font-bold text-purple-600">#{{ $position }}</div>
                                        <p class="text-sm text-purple-700">Thứ tự trong tổng số {{ $totalReviews }} đánh giá</p>
                                        <p class="text-xs text-gray-600 mt-1">
                                            @if($position <= $totalReviews * 0.1)
                                                <span class="text-green-600">✨ Đánh giá mới nhất</span>
                                            @elseif($position <= $totalReviews * 0.5)
                                                <span class="text-blue-600">📊 Đánh giá gần đây</span>
                                            @else
                                                <span class="text-gray-600">📅 Đánh giá cũ</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Related Reviews -->
                    @php
                        $relatedReviews = \App\Models\Review::where('parking_lot_id', $review->parkingLot->id)
                            ->where('id', '!=', $review->id)
                            ->orderBy('created_at', 'desc')
                            ->limit(3)
                            ->get();
                    @endphp

                    @if($relatedReviews->count() > 0)
                    <div class="w-full max-w-full px-3 mb-6">
                        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-lg rounded-2xl bg-clip-border">
                            <div class="p-6">
                                <h6 class="text-lg font-semibold text-slate-700 mb-4">
                                    <i class="fas fa-comments mr-2"></i>Đánh giá khác về bãi đỗ xe này
                                </h6>
                                <div class="space-y-4">
                                    @foreach($relatedReviews as $relatedReview)
                                    <div class="flex items-start p-3 bg-gray-50 rounded-lg">
                                        <div class="flex-shrink-0 w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center">
                                            <i class="fas fa-user text-gray-600 text-sm"></i>
                                        </div>
                                        <div class="ml-3 flex-grow">
                                            <div class="flex items-center justify-between">
                                                <h6 class="text-sm font-semibold">{{ $relatedReview->user->name }}</h6>
                                                <div class="flex items-center">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <i class="fas fa-star text-xs {{ $i <= $relatedReview->rating ? 'text-yellow-500' : 'text-gray-300' }}"></i>
                                                    @endfor
                                                    <span class="ml-1 text-xs text-gray-600">{{ $relatedReview->rating }}/5</span>
                                                </div>
                                            </div>
                                            @if($relatedReview->comment)
                                                <p class="text-sm text-gray-600 mt-1">{{ Str::limit($relatedReview->comment, 100) }}</p>
                                            @endif
                                            <div class="flex items-center justify-between mt-2">
                                                <span class="text-xs text-gray-500">{{ $relatedReview->created_at->format('d/m/Y') }}</span>
                                                <a href="{{ route('admin.reviews.show', $relatedReview) }}" class="text-blue-600 hover:text-blue-800 text-xs">
                                                    Xem chi tiết →
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="mt-4 text-center">
                                    <a href="{{ route('admin.reviews.index', ['parking_lot' => $review->parkingLot->id]) }}" class="text-blue-600 hover:text-blue-800 text-sm">
                                        <i class="fas fa-arrow-right mr-1"></i>Xem tất cả đánh giá của bãi đỗ xe này
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
