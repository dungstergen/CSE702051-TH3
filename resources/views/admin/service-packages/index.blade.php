@extends('admin.layout')
@section('page-title', 'Quản lý Gói dịch vụ - Paspark Admin')
@section('page-heading', 'Quản lý Gói dịch vụ')

@section('content')
<div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <div class="flex items-center justify-between mb-4">
                    <h6 class="mb-0 dark:text-white">Danh sách gói dịch vụ</h6>
                    <div class="space-x-2">
                        <a href="{{ route('admin.service-packages.create') }}" class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer bg-gradient-to-tl from-green-600 to-lime-400 leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs">
                            <i class="fas fa-plus mr-2"></i>Thêm gói mới
                        </a>
                    </div>
                </div>
            </div>

            <div class="flex-auto p-0">
                <div class="p-6 overflow-x-auto">
                    <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                        <thead class="align-bottom">
                            <tr>
                                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Gói dịch vụ</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Giá</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Trạng thái</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Sử dụng</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $packages = [
                                    ['id' => 1, 'name' => 'Gói Cơ Bản', 'price' => 50000, 'description' => 'Gói dịch vụ cơ bản với bảo vệ, camera giám sát và hỗ trợ 24/7', 'status' => 'active', 'usage_count' => 245],
                                    ['id' => 2, 'name' => 'Gói Tiêu Chuẩn', 'price' => 100000, 'description' => 'Gói dịch vụ tiêu chuẩn với thêm dịch vụ rửa xe cơ bản và bảo dưỡng nhẹ', 'status' => 'active', 'usage_count' => 158],
                                    ['id' => 3, 'name' => 'Gói Cao Cấp', 'price' => 150000, 'description' => 'Gói dịch vụ cao cấp với rửa xe miễn phí, bảo dưỡng và valet parking', 'status' => 'active', 'usage_count' => 89],
                                    ['id' => 4, 'name' => 'Gói VIP', 'price' => 250000, 'description' => 'Gói dịch vụ VIP với đầy đủ tiện ích cao cấp và ưu tiên tối đa', 'status' => 'inactive', 'usage_count' => 12],
                                ];
                            @endphp
                            @foreach($packages as $package)
                            <tr>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="flex px-2 py-1">
                                        <div class="flex flex-col justify-center">
                                            <h6 class="mb-0 leading-normal text-sm font-semibold">{{ $package['name'] }}</h6>
                                            <p class="mb-0 leading-tight text-xs text-slate-400">{{ Str::limit($package['description'], 50) }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span class="text-sm font-bold leading-tight text-slate-400">{{ number_format($package['price']) }}đ</span>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span class="px-2 py-1 text-xs font-semibold text-white rounded {{ $package['status'] == 'active' ? 'bg-green-500' : 'bg-gray-500' }}">
                                        {{ $package['status'] == 'active' ? 'Hoạt động' : 'Tạm dừng' }}
                                    </span>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="flex items-center justify-center">
                                        <span class="text-sm font-semibold text-slate-700">{{ $package['usage_count'] }}</span>
                                        <span class="ml-1 text-xs text-slate-400">lượt</span>
                                    </div>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="flex items-center justify-center space-x-2">
                                        <a href="{{ route('admin.service-packages.show', $package['id']) }}" class="text-blue-600 hover:text-blue-800" title="Xem chi tiết">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.service-packages.edit', $package['id']) }}" class="text-green-600 hover:text-green-800" title="Chỉnh sửa">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button onclick="toggleStatus({{ $package['id'] }})" class="text-orange-600 hover:text-orange-800" title="Thay đổi trạng thái">
                                            <i class="fas fa-{{ $package['status'] == 'active' ? 'pause' : 'play' }}"></i>
                                        </button>
                                        <button onclick="deletePackage({{ $package['id'] }})" class="text-red-600 hover:text-red-800" title="Xóa">
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

<!-- Package Statistics -->
<div class="flex flex-wrap -mx-3 mb-6">
    <!-- Total Packages -->
    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p class="mb-0 font-sans font-semibold leading-normal uppercase text-sm text-slate-400">Tổng gói dịch vụ</p>
                            <h5 class="mb-2 font-bold text-slate-700 dark:text-white">4</h5>
                            <p class="mb-0 text-slate-400">
                                <span class="font-bold leading-normal text-emerald-500 text-sm">3</span> đang hoạt động
                            </p>
                        </div>
                    </div>
                    <div class="w-4/12 max-w-full px-3 ml-auto text-right flex-none">
                        <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-blue-500 to-violet-500">
                            <i class="fas fa-layer-group text-lg relative top-3.5 text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Most Popular Package -->
    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p class="mb-0 font-sans font-semibold leading-normal uppercase text-sm text-slate-400">Gói phổ biến nhất</p>
                            <h5 class="mb-2 font-bold text-slate-700 dark:text-white text-sm">Gói Cơ Bản</h5>
                            <p class="mb-0 text-slate-400">
                                <span class="font-bold leading-normal text-emerald-500 text-sm">245</span> lượt sử dụng
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

    <!-- Total Revenue from Packages -->
    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p class="mb-0 font-sans font-semibold leading-normal uppercase text-sm text-slate-400">Doanh thu từ gói</p>
                            <h5 class="mb-2 font-bold text-slate-700 dark:text-white">{{ number_format(42500000) }}đ</h5>
                            <p class="mb-0 text-slate-400">
                                <span class="font-bold leading-normal text-emerald-500 text-sm">+18%</span> tháng này
                            </p>
                        </div>
                    </div>
                    <div class="w-4/12 max-w-full px-3 ml-auto text-right flex-none">
                        <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-orange-500 to-yellow-500">
                            <i class="fas fa-coins text-lg relative top-3.5 text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Average Package Price -->
    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p class="mb-0 font-sans font-semibold leading-normal uppercase text-sm text-slate-400">Giá trung bình</p>
                            <h5 class="mb-2 font-bold text-slate-700 dark:text-white">{{ number_format(137500) }}đ</h5>
                            <p class="mb-0 text-slate-400">
                                <span class="text-sm text-slate-400">Qua 4 gói dịch vụ</span>
                            </p>
                        </div>
                    </div>
                    <div class="w-4/12 max-w-full px-3 ml-auto text-right flex-none">
                        <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-red-600 to-orange-600">
                            <i class="fas fa-calculator text-lg relative top-3.5 text-white"></i>
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
function toggleStatus(packageId) {
    if (confirm('Bạn có chắc chắn muốn thay đổi trạng thái gói dịch vụ này?')) {
        // In real app, make AJAX call to toggle status
        alert(`Đã thay đổi trạng thái gói dịch vụ #${packageId}`);
        location.reload();
    }
}

function deletePackage(packageId) {
    if (confirm('Bạn có chắc chắn muốn xóa gói dịch vụ này?\nLưu ý: Việc xóa có thể ảnh hưởng đến các booking đang sử dụng gói này.')) {
        // In real app, make AJAX call to delete
        alert(`Đã xóa gói dịch vụ #${packageId}`);
        location.reload();
    }
}
</script>
@endpush
