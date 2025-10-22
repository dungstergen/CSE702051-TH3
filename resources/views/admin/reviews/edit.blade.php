@extends('admin.layout')
@section('page-title', 'Chỉnh sửa Đánh giá - Paspark Admin')
@section('page-heading', 'Chỉnh sửa Đánh giá')

@section('content')
<div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <div class="flex items-center justify-between mb-4">
                    <h6 class="mb-0 dark:text-white">Chỉnh sửa Đánh giá #{{ $review->id }}</h6>
                    <div class="space-x-2">
                        <a href="{{ route('admin.reviews.show', $review) }}" class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer bg-gradient-to-tl from-orange-500 to-yellow-500 leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs">
                            <i class="fas fa-eye mr-2"></i>Xem
                        </a>
                        <a href="{{ route('admin.reviews.index') }}" class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer bg-gradient-to-tl from-orange-500 to-yellow-500 leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs">
                            <i class="fas fa-arrow-left mr-2"></i>Quay lại
                        </a>
                    </div>
                </div>
            </div>

            <div class="flex-auto p-6">
                <form method="POST" action="{{ route('admin.reviews.update', $review) }}">
                    @csrf
                    @method('PUT')
                    <div class="flex flex-wrap -mx-3">
                        <!-- Review Information (Read-only) -->
                        <div class="w-full px-3 mb-4">
                            <h6 class="text-lg font-semibold text-slate-700 dark:text-white mb-4">Thông tin cơ bản</h6>
                        </div>

                        <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Khách hàng:</label>
                            <div class="bg-gray-100 rounded-lg p-3">
                                <p class="text-sm font-semibold">{{ $review->user->name }}</p>
                                <p class="text-xs text-gray-600">{{ $review->user->email }}</p>
                            </div>
                        </div>

                        <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Bãi đỗ xe:</label>
                            <div class="bg-gray-100 rounded-lg p-3">
                                <p class="text-sm font-semibold">{{ $review->parkingLot->name }}</p>
                                <p class="text-xs text-gray-600">{{ $review->parkingLot->address }}</p>
                            </div>
                        </div>

                        @if($review->booking)
                        <div class="w-full max-w-full px-3 mb-6">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Booking liên quan:</label>
                            <div class="bg-blue-50 rounded-lg p-3">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-semibold">Booking #{{ $review->booking->id }}</p>
                                        <p class="text-xs text-gray-600">{{ $review->booking->start_time->format('d/m/Y H:i') }} - {{ $review->booking->end_time->format('d/m/Y H:i') }}</p>
                                    </div>
                                    <a href="{{ route('admin.bookings.show', $review->booking) }}" class="text-blue-600 hover:text-blue-800 text-sm">
                                        <i class="fas fa-external-link-alt mr-1"></i>Xem booking
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Rating and Review -->
                        <div class="w-full px-3 mb-4">
                            <h6 class="text-lg font-semibold text-slate-700 dark:text-white mb-4">Đánh giá</h6>
                        </div>

                        <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80" for="rating">
                                Số sao <span class="text-red-500">*</span>
                            </label>
                            <div class="flex items-center space-x-2 mb-2">
                                <div class="flex items-center" id="starRating">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star text-2xl cursor-pointer {{ $i <= old('rating', $review->rating) ? 'text-yellow-500' : 'text-gray-300' }} hover:text-yellow-500 transition-colors"
                                           data-rating="{{ $i }}"
                                           id="star-{{ $i }}"></i>
                                    @endfor
                                </div>
                                <span class="text-sm font-semibold text-gray-600" id="ratingText">
                                    @php
                                        $currentRating = old('rating', $review->rating);
                                        $ratingTexts = ['', 'Rất tệ', 'Tệ', 'Bình thường', 'Tốt', 'Rất tốt'];
                                    @endphp
                                    {{ $currentRating }} sao - {{ $ratingTexts[$currentRating] ?? 'Chọn số sao' }}
                                </span>
                            </div>
                            <input type="hidden" name="rating" id="rating" value="{{ old('rating', $review->rating) }}" required>
                            @error('rating')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="w-full max-w-full px-3 mb-6">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80" for="comment">
                                Bình luận
                            </label>
                            <textarea name="comment" id="comment" rows="4" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" placeholder="Nhập bình luận về bãi đỗ xe">{{ old('comment', $review->comment) }}</textarea>
                            @error('comment')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Original vs New Comparison -->
                        <div class="w-full max-w-full px-3 mb-6">
                            <div class="bg-blue-50 rounded-lg p-4">
                                <h6 class="text-md font-semibold text-blue-700 mb-2">So sánh thay đổi</h6>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <h6 class="text-sm font-semibold text-gray-700">Hiện tại</h6>
                                        <div class="flex items-center mb-2">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star text-sm {{ $i <= $review->rating ? 'text-yellow-500' : 'text-gray-300' }}"></i>
                                            @endfor
                                            <span class="ml-2 text-sm font-semibold">{{ $review->rating }}/5</span>
                                        </div>
                                        <p class="text-sm text-gray-600">{{ $review->comment ?: 'Không có bình luận' }}</p>
                                    </div>
                                    <div>
                                        <h6 class="text-sm font-semibold text-blue-700">Sẽ cập nhật</h6>
                                        <div class="flex items-center mb-2" id="newRatingPreview">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star text-sm {{ $i <= old('rating', $review->rating) ? 'text-yellow-500' : 'text-gray-300' }}" id="preview-star-{{ $i }}"></i>
                                            @endfor
                                            <span class="ml-2 text-sm font-semibold" id="newRatingValue">{{ old('rating', $review->rating) }}/5</span>
                                        </div>
                                        <p class="text-sm text-blue-600" id="newCommentPreview">{{ old('comment', $review->comment) ?: 'Không có bình luận' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('admin.reviews.index') }}" class="inline-block px-6 py-3 mr-3 font-bold text-center text-gray-700 uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer leading-pro text-xs ease-soft-in tracking-tight-soft hover:scale-102 active:opacity-85">
                            Hủy
                        </a>
                        <button type="submit" class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer bg-gradient-to-tl from-green-600 to-lime-400 leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs">
                            <i class="fas fa-save mr-2"></i>Cập nhật
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const stars = document.querySelectorAll('#starRating i');
    const ratingInput = document.getElementById('rating');
    const ratingText = document.getElementById('ratingText');
    const commentTextarea = document.getElementById('comment');
    const newCommentPreview = document.getElementById('newCommentPreview');
    const newRatingValue = document.getElementById('newRatingValue');
    const previewStars = document.querySelectorAll('#newRatingPreview i');

    function updatePreview() {
        // Update comment preview
        const commentValue = commentTextarea.value;
        newCommentPreview.textContent = commentValue || 'Không có bình luận';

        // Update rating preview
        const ratingValue = parseInt(ratingInput.value);
        newRatingValue.textContent = `${ratingValue}/5`;

        previewStars.forEach((star, index) => {
            if (index < ratingValue) {
                star.classList.remove('text-gray-300');
                star.classList.add('text-yellow-500');
            } else {
                star.classList.remove('text-yellow-500');
                star.classList.add('text-gray-300');
            }
        });
    }

    // Star rating functionality
    stars.forEach(star => {
        star.addEventListener('click', function() {
            const rating = parseInt(this.dataset.rating);
            ratingInput.value = rating;

            // Update star colors
            stars.forEach((s, index) => {
                if (index < rating) {
                    s.classList.remove('text-gray-300');
                    s.classList.add('text-yellow-500');
                } else {
                    s.classList.remove('text-yellow-500');
                    s.classList.add('text-gray-300');
                }
            });

            // Update rating text
            const ratingTexts = ['', 'Rất tệ', 'Tệ', 'Bình thường', 'Tốt', 'Rất tốt'];
            ratingText.textContent = `${rating} sao - ${ratingTexts[rating]}`;

            updatePreview();
        });

        star.addEventListener('mouseover', function() {
            const rating = parseInt(this.dataset.rating);
            stars.forEach((s, index) => {
                if (index < rating) {
                    s.classList.add('text-yellow-400');
                } else {
                    s.classList.remove('text-yellow-400');
                }
            });
        });

        star.addEventListener('mouseout', function() {
            stars.forEach(s => {
                s.classList.remove('text-yellow-400');
            });
        });
    });

    // Comment textarea change handler
    commentTextarea.addEventListener('input', updatePreview);

    // Initial preview update
    updatePreview();
});
</script>
@endsection
