@extends('admin.layout')
@section('page-title', 'Quản lý Testimonial - Paspark Admin')
@section('page-heading', 'Quản lý Đánh giá Khách hàng')

@section('content')
<div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <div class="flex items-center justify-between mb-4">
                    <h6 class="mb-0 dark:text-white">Danh sách testimonial</h6>
                    <div class="space-x-2">
                        <a href="{{ route('admin.testimonials.create') }}" class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer bg-gradient-to-tl from-green-600 to-lime-400 leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs">
                            <i class="fas fa-plus mr-2"></i>Thêm testimonial
                        </a>
                    </div>
                </div>
            </div>

            <div class="flex-auto p-0">
                <div class="p-6 overflow-x-auto">
                    <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                        <thead class="align-bottom">
                            <tr>
                                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Khách hàng</th>
                                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Nội dung</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Đánh giá</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Trạng thái</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $testimonials = [
                                    [
                                        'id' => 1,
                                        'customer_name' => 'Nguyễn Thị Lan',
                                        'customer_title' => 'Khách hàng VIP',
                                        'content' => 'Tôi đã sử dụng dịch vụ bãi đỗ xe này được 2 năm và rất hài lòng. Hệ thống bảo mật tốt, nhân viên thân thiện và giá cả hợp lý.',
                                        'rating' => 5,
                                        'avatar' => 'c1.jpg',
                                        'status' => 'published',
                                        'featured' => true,
                                        'created_at' => '2024-09-15'
                                    ],
                                    [
                                        'id' => 2,
                                        'customer_name' => 'Trần Văn Minh',
                                        'customer_title' => 'Khách hàng thân thiết',
                                        'content' => 'Dịch vụ tuyệt vời! Tôi làm việc trong khu vực trung tâm và cần đỗ xe hàng ngày. Bãi đỗ xe này có vị trí thuận lợi.',
                                        'rating' => 5,
                                        'avatar' => 'c2.jpg',
                                        'status' => 'published',
                                        'featured' => true,
                                        'created_at' => '2024-09-10'
                                    ],
                                    [
                                        'id' => 3,
                                        'customer_name' => 'Lê Thị Mai',
                                        'customer_title' => 'Khách hàng mới',
                                        'content' => 'Lần đầu sử dụng dịch vụ, cảm thấy rất ấn tượng với sự chuyên nghiệp và thái độ phục vụ nhiệt tình.',
                                        'rating' => 4,
                                        'avatar' => 'c3.jpg',
                                        'status' => 'pending',
                                        'featured' => false,
                                        'created_at' => '2024-10-01'
                                    ],
                                    [
                                        'id' => 4,
                                        'customer_name' => 'Phạm Quang Huy',
                                        'customer_title' => 'Doanh nhân',
                                        'content' => 'Dịch vụ valet parking rất tiện lợi, tiết kiệm được rất nhiều thời gian. Tôi rất recommend cho những người bận rộn.',
                                        'rating' => 5,
                                        'avatar' => 'c4.jpg',
                                        'status' => 'published',
                                        'featured' => false,
                                        'created_at' => '2024-09-28'
                                    ],
                                ];
                            @endphp
                            @foreach($testimonials as $testimonial)
                            <tr>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="flex px-2 py-1">
                                        <div class="flex-shrink-0 mr-3" style="width: 40px; height: 40px;">
                                            <img src="{{ asset('user/images/' . $testimonial['avatar']) }}" alt="Customer" class="w-full h-full object-cover rounded-full border-2 border-gray-200">
                                        </div>
                                        <div class="flex flex-col justify-center">
                                            <h6 class="mb-0 leading-normal text-sm font-semibold">{{ $testimonial['customer_name'] }}</h6>
                                            <p class="mb-0 leading-tight text-xs text-slate-400">{{ $testimonial['customer_title'] }}</p>
                                            @if($testimonial['featured'])
                                                <span class="px-2 py-1 text-xs font-semibold text-yellow-800 bg-yellow-100 rounded-full mt-1">
                                                    <i class="fas fa-star mr-1"></i>Nổi bật
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b shadow-transparent">
                                    <div class="max-w-xs">
                                        <p class="mb-0 text-xs text-slate-600">{{ Str::limit($testimonial['content'], 100) }}</p>
                                        <p class="mb-0 text-xs text-slate-400 mt-1">{{ $testimonial['created_at'] }}</p>
                                    </div>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="flex items-center justify-center">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star text-sm {{ $i <= $testimonial['rating'] ? 'text-yellow-500' : 'text-gray-300' }}"></i>
                                        @endfor
                                        <span class="ml-1 text-xs font-semibold">{{ $testimonial['rating'] }}/5</span>
                                    </div>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span class="px-2 py-1 text-xs font-semibold text-white rounded {{ $testimonial['status'] == 'published' ? 'bg-green-500' : ($testimonial['status'] == 'pending' ? 'bg-yellow-500' : 'bg-red-500') }}">
                                        @switch($testimonial['status'])
                                            @case('published')
                                                <i class="fas fa-check mr-1"></i>Đã xuất bản
                                                @break
                                            @case('pending')
                                                <i class="fas fa-clock mr-1"></i>Chờ duyệt
                                                @break
                                            @default
                                                <i class="fas fa-times mr-1"></i>Đã ẩn
                                        @endswitch
                                    </span>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="flex items-center justify-center space-x-2">
                                        <a href="{{ route('admin.testimonials.show', $testimonial['id']) }}" class="text-blue-600 hover:text-blue-800" title="Xem chi tiết">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.testimonials.edit', $testimonial['id']) }}" class="text-green-600 hover:text-green-800" title="Chỉnh sửa">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @if($testimonial['status'] == 'pending')
                                            <button onclick="approveTestimonial({{ $testimonial['id'] }})" class="text-green-600 hover:text-green-800" title="Phê duyệt">
                                                <i class="fas fa-check-circle"></i>
                                            </button>
                                        @endif
                                        <button onclick="toggleFeatured({{ $testimonial['id'] }})" class="text-yellow-600 hover:text-yellow-800" title="{{ $testimonial['featured'] ? 'Bỏ nổi bật' : 'Đặt nổi bật' }}">
                                            <i class="fas fa-{{ $testimonial['featured'] ? 'star-of-life' : 'star' }}"></i>
                                        </button>
                                        <button onclick="toggleStatus({{ $testimonial['id'] }})" class="text-orange-600 hover:text-orange-800" title="Thay đổi trạng thái">
                                            <i class="fas fa-toggle-{{ $testimonial['status'] == 'published' ? 'on' : 'off' }}"></i>
                                        </button>
                                        <button onclick="deleteTestimonial({{ $testimonial['id'] }})" class="text-red-600 hover:text-red-800" title="Xóa">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Testimonial Statistics -->
<div class="flex flex-wrap -mx-3 mb-6">
    <!-- Total Testimonials -->
    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p class="mb-0 font-sans font-semibold leading-normal uppercase text-sm text-slate-400">Tổng testimonial</p>
                            <h5 class="mb-2 font-bold text-slate-700 dark:text-white">4</h5>
                            <p class="mb-0 text-slate-400">
                                <span class="font-bold leading-normal text-green-500 text-sm">3</span> đã xuất bản
                            </p>
                        </div>
                    </div>
                    <div class="w-4/12 max-w-full px-3 ml-auto text-right flex-none">
                        <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-blue-500 to-violet-500">
                            <i class="fas fa-comments text-lg relative top-3.5 text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Average Rating -->
    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p class="mb-0 font-sans font-semibold leading-normal uppercase text-sm text-slate-400">Đánh giá trung bình</p>
                            <h5 class="mb-2 font-bold text-slate-700 dark:text-white">4.75/5</h5>
                            <div class="flex items-center">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star text-sm {{ $i <= 4.75 ? 'text-yellow-500' : 'text-gray-300' }}"></i>
                                @endfor
                            </div>
                        </div>
                    </div>
                    <div class="w-4/12 max-w-full px-3 ml-auto text-right flex-none">
                        <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-yellow-500 to-orange-500">
                            <i class="fas fa-star text-lg relative top-3.5 text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Approval -->
    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p class="mb-0 font-sans font-semibold leading-normal uppercase text-sm text-slate-400">Chờ duyệt</p>
                            <h5 class="mb-2 font-bold text-slate-700 dark:text-white">1</h5>
                            <p class="mb-0 text-slate-400">
                                <span class="text-sm text-slate-400">Cần xem xét</span>
                            </p>
                        </div>
                    </div>
                    <div class="w-4/12 max-w-full px-3 ml-auto text-right flex-none">
                        <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-orange-500 to-red-500">
                            <i class="fas fa-clock text-lg relative top-3.5 text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Testimonials -->
    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p class="mb-0 font-sans font-semibold leading-normal uppercase text-sm text-slate-400">Testimonial nổi bật</p>
                            <h5 class="mb-2 font-bold text-slate-700 dark:text-white">2</h5>
                            <p class="mb-0 text-slate-400">
                                <span class="text-sm text-slate-400">Hiển thị trang chủ</span>
                            </p>
                        </div>
                    </div>
                    <div class="w-4/12 max-w-full px-3 ml-auto text-right flex-none">
                        <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-emerald-500 to-teal-400">
                            <i class="fas fa-trophy text-lg relative top-3.5 text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function approveTestimonial(testimonialId) {
    if (confirm('Bạn có chắc chắn muốn phê duyệt testimonial này?')) {
        alert(`Đã phê duyệt testimonial #${testimonialId}`);
        location.reload();
    }
}

function toggleFeatured(testimonialId) {
    if (confirm('Bạn có muốn thay đổi trạng thái nổi bật của testimonial này?')) {
        alert(`Đã thay đổi trạng thái nổi bật testimonial #${testimonialId}`);
        location.reload();
    }
}

function toggleStatus(testimonialId) {
    if (confirm('Bạn có chắc chắn muốn thay đổi trạng thái testimonial này?')) {
        alert(`Đã thay đổi trạng thái testimonial #${testimonialId}`);
        location.reload();
    }
}

function deleteTestimonial(testimonialId) {
    if (confirm('Bạn có chắc chắn muốn xóa testimonial này?\nViệc xóa sẽ không thể hoàn tác.')) {
        alert(`Đã xóa testimonial #${testimonialId}`);
        location.reload();
    }
}
</script>
@endpush
