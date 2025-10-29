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
                            @forelse($packages as $package)
                            <tr>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="flex px-2 py-1">
                                        <div class="flex flex-col justify-center">
                                            <h6 class="mb-0 leading-normal text-sm font-semibold">
                                                {{ data_get($package, 'name') }}
                                                @if(data_get($package, 'is_featured'))
                                                    <span class="ml-2 px-2 py-0.5 text-xxs rounded bg-yellow-100 text-yellow-700 border border-yellow-300">Nổi bật</span>
                                                @endif
                                            </h6>
                                            <p class="mb-0 leading-tight text-xs text-slate-400">{{ \Illuminate\Support\Str::limit(data_get($package, 'description'), 50) }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span class="text-sm font-bold leading-tight text-slate-400">{{ number_format((float) data_get($package, 'price', 0)) }}đ</span>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span class="inline-flex items-center px-2 py-0.5 text-xs font-semibold rounded border {{ data_get($package, 'is_active') ? 'text-emerald-700 bg-emerald-50 border-emerald-200' : 'text-slate-700 bg-slate-100 border-slate-300' }}">
                                        {{ data_get($package, 'is_active') ? 'Hoạt động' : 'Tạm dừng' }}
                                    </span>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="flex items-center justify-center">
                                        <span class="text-sm font-semibold text-slate-700">{{ data_get($package, 'usage_count', 0) }}</span>
                                        <span class="ml-1 text-xs text-slate-400">lượt</span>
                                    </div>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b shadow-transparent">
                                    <div class="flex items-center justify-center flex-wrap gap-2">
                                        <a href="{{ route('admin.service-packages.show', data_get($package, 'id')) }}" class="btn-chip btn-blue" title="Xem chi tiết">
                                            <i class="fas fa-eye btn-icon"></i>
                                            <span>Xem</span>
                                        </a>
                                        <a href="{{ route('admin.service-packages.edit', data_get($package, 'id')) }}" class="btn-chip btn-emerald" title="Chỉnh sửa">
                                            <i class="fas fa-edit btn-icon"></i>
                                            <span>Sửa</span>
                                        </a>
                                        <button onclick="toggleStatus({{ (int) data_get($package, 'id') }})" class="btn-chip btn-orange" title="Thay đổi trạng thái" aria-label="Thay đổi trạng thái">
                                            <i class="fas fa-power-off btn-icon"></i>
                                            <span>Trạng thái</span>
                                        </button>
                                        <button onclick="deletePackage({{ (int) data_get($package, 'id') }})" class="btn-chip btn-red" title="Xóa" aria-label="Xóa">
                                            <i class="fas fa-trash btn-icon"></i>
                                            <span>Xóa</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="p-4 text-center text-slate-500">Chưa có gói dịch vụ nào.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    @if (is_object($packages) && method_exists($packages, 'links'))
                        <div class="mt-4">{{ $packages->links() }}</div>
                    @endif
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
                            <h5 class="mb-2 font-bold text-slate-700 dark:text-white">{{ $stats['total'] }}</h5>
                            <p class="mb-0 text-slate-400">
                                <span class="font-bold leading-normal text-emerald-500 text-sm">{{ $stats['active'] }}</span> đang hoạt động
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
                            <h5 class="mb-2 font-bold text-slate-700 dark:text-white text-sm">{{ is_object($packages) && method_exists($packages, 'first') ? optional($packages->first())->name : '—' }}</h5>
                            <p class="mb-0 text-slate-400">
                                <span class="font-bold leading-normal text-emerald-500 text-sm">{{ is_object($packages) && method_exists($packages, 'first') ? (optional($packages->first())->usage_count ?? 0) : 0 }}</span> lượt sử dụng
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
                            <h5 class="mb-2 font-bold text-slate-700 dark:text-white">—</h5>
                            <p class="mb-0 text-slate-400">
                                <span class="text-sm">Đang cập nhật</span>
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
                            <h5 class="mb-2 font-bold text-slate-700 dark:text-white">—</h5>
                            <p class="mb-0 text-slate-400">
                                <span class="text-sm text-slate-400">Qua {{ $stats['total'] }} gói dịch vụ</span>
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
const CSRF_TOKEN = '{{ csrf_token() }}';

async function toggleStatus(packageId) {
    if (!confirm('Bạn có chắc chắn muốn thay đổi trạng thái gói dịch vụ này?')) return;
    try {
        const res = await fetch(`/admin/service-packages/${packageId}/toggle-status`, {
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': CSRF_TOKEN,
                'Accept': 'application/json'
            }
        });
        const data = await res.json();
        if (data.success) {
            location.reload();
        } else {
            alert(data.message || 'Không thể cập nhật trạng thái.');
        }
    } catch (e) {
        alert('Có lỗi xảy ra khi cập nhật trạng thái.');
    }
}

async function deletePackage(packageId) {
    if (!confirm('Bạn có chắc chắn muốn xóa gói dịch vụ này?\nLưu ý: Việc xóa có thể ảnh hưởng đến các booking đang sử dụng gói này.')) return;
    try {
        const res = await fetch(`/admin/service-packages/${packageId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': CSRF_TOKEN,
                'Accept': 'text/html'
            },
            body: new URLSearchParams({ _method: 'DELETE' })
        });
        if (res.ok) {
            location.reload();
        } else {
            alert('Không thể xóa gói dịch vụ.');
        }
    } catch (e) {
        alert('Có lỗi xảy ra khi xóa gói dịch vụ.');
    }
}
</script>
@endpush
