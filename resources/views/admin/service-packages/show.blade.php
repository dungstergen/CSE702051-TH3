@extends('admin.layout')
@section('page-title', 'Chi tiết Gói dịch vụ - Paspark Admin')
@section('page-heading', 'Chi tiết Gói dịch vụ')

@section('content')
<div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <div class="flex items-center justify-between mb-4">
                    <h6 class="mb-0 dark:text-white">{{ $package->name }}</h6>
                    <div class="space-x-2">
                        <a href="{{ route('admin.service-packages.edit', $package) }}" class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer bg-gradient-to-tl from-orange-500 to-yellow-500 leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs">
                            <i class="fas fa-edit mr-1"></i>Chỉnh sửa
                        </a>
                        <a href="{{ route('admin.service-packages.index') }}" class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer bg-gradient-to-tl from-orange-500 to-yellow-500 leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs">
                            <i class="fas fa-arrow-left mr-1"></i>Quay lại
                        </a>
                    </div>
                </div>
            </div>
            <div class="flex-auto p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <div class="mb-4">
                            <span class="text-sm text-slate-500">Trạng thái</span>
                            <div>
                                <span class="inline-flex items-center px-2 py-0.5 text-xs font-semibold rounded border {{ $package->is_active ? 'text-emerald-700 bg-emerald-50 border-emerald-200' : 'text-slate-700 bg-slate-100 border-slate-300' }}">
                                    {{ $package->is_active ? 'Hoạt động' : 'Tạm dừng' }}
                                </span>
                                @if($package->is_featured)
                                <span class="ml-2 inline-flex items-center px-2 py-0.5 text-xs font-semibold text-yellow-700 rounded bg-yellow-100 border border-yellow-300">
                                    Nổi bật
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-4">
                            <span class="text-sm text-slate-500">Giá</span>
                            <div class="text-lg font-semibold text-slate-800">{{ number_format((float) $package->price) }}đ</div>
                        </div>
                        <div class="mb-4">
                            <span class="text-sm text-slate-500">Thời hạn (giờ)</span>
                            <div class="text-slate-800">{{ $package->duration_hours ?? '—' }}</div>
                        </div>
                        <div class="mb-4">
                            <span class="text-sm text-slate-500">Mô tả</span>
                            <div class="text-slate-800">{{ $package->description ?? '—' }}</div>
                        </div>
                    </div>
                    <div>
                        <div class="mb-4">
                            <span class="text-sm text-slate-500">Tính năng</span>
                            @if(is_array($package->features) && count($package->features))
                            <ul class="list-disc ml-5 text-slate-800">
                                @foreach($package->features as $f)
                                    <li>{{ $f }}</li>
                                @endforeach
                            </ul>
                            @else
                                <div class="text-slate-500">Chưa có</div>
                            @endif
                        </div>
                        <div class="mb-4 grid grid-cols-2 gap-4 text-sm text-slate-600">
                            <div>
                                <strong>Ngày tạo:</strong> {{ optional($package->created_at)->format('d/m/Y H:i') }}
                            </div>
                            <div>
                                <strong>Cập nhật:</strong> {{ optional($package->updated_at)->format('d/m/Y H:i') }}
                            </div>
                            <div>
                                <strong>Lượt sử dụng:</strong> {{ $package->usage_count ?? 0 }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex items-center gap-3 border-t pt-4">
                    <button onclick="toggleStatus({{ $package->id }})" class="btn-solid btn-solid-orange">
                        <i class="fas fa-power-off btn-icon"></i>Chuyển trạng thái
                    </button>
                    <button onclick="toggleFeatured({{ $package->id }})" class="btn-solid btn-solid-yellow">
                        <i class="fas fa-star btn-icon"></i>Chuyển nổi bật
                    </button>
                    <button onclick="deletePackage({{ $package->id }})" class="btn-solid btn-solid-red">
                        <i class="fas fa-trash btn-icon"></i>Xóa
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
const CSRF_TOKEN = '{{ csrf_token() }}';

async function toggleStatus(id) {
    if (!confirm('Bạn có chắc chắn muốn thay đổi trạng thái gói dịch vụ này?')) return;
    try {
        const res = await fetch(`/admin/service-packages/${id}/toggle-status`, {
            method: 'PATCH',
            headers: { 'X-CSRF-TOKEN': CSRF_TOKEN, 'Accept': 'application/json' }
        });
        const data = await res.json();
        if (data.success) location.reload(); else alert(data.message || 'Không thể cập nhật trạng thái');
    } catch (e) {
        alert('Có lỗi xảy ra khi cập nhật trạng thái');
    }
}

async function toggleFeatured(id) {
    try {
        const res = await fetch(`/admin/service-packages/${id}/toggle-featured`, {
            method: 'PATCH',
            headers: { 'X-CSRF-TOKEN': CSRF_TOKEN, 'Accept': 'application/json' }
        });
        const data = await res.json();
        if (data.success) location.reload(); else alert(data.message || 'Không thể cập nhật nổi bật');
    } catch (e) {
        alert('Có lỗi xảy ra khi cập nhật nổi bật');
    }
}

async function deletePackage(id) {
    if (!confirm('Bạn có chắc chắn muốn xóa gói dịch vụ này?')) return;
    try {
        const res = await fetch(`/admin/service-packages/${id}`, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': CSRF_TOKEN },
            body: new URLSearchParams({ _method: 'DELETE' })
        });
        if (res.ok) window.location.href = '{{ route('admin.service-packages.index') }}'; else alert('Không thể xóa gói dịch vụ');
    } catch (e) {
        alert('Có lỗi xảy ra khi xóa gói dịch vụ');
    }
}
</script>
@endpush
