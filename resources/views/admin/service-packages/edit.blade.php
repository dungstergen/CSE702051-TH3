@extends('admin.layout')

@section('title', 'Chỉnh Sửa Gói Dịch Vụ')

@section('content')
<div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <div class="flex items-center justify-between">
                    <h6 class="mb-0 dark:text-white">Chỉnh Sửa Gói Dịch Vụ: {{ $package->name }}</h6>
                    <a href="{{ route('admin.service-packages.index') }}" class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer bg-gradient-to-tl from-orange-500 to-yellow-500 leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs">
                        <i class="fas fa-arrow-left mr-1"></i>Quay lại
                    </a>
                </div>
            </div>
            <div class="flex-auto p-6">
                <form action="{{ route('admin.service-packages.update', $package->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="flex flex-wrap -mx-3">
                        <!-- Basic Information -->
                        <div class="w-full max-w-full px-3 lg:w-6/12 lg:flex-none">
                            <div class="mb-4">
                                <label for="name" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Tên gói dịch vụ <span class="text-red-500">*</span></label>
                                <input type="text" name="name" id="name" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" value="{{ old('name', $package->name) }}" required>
                                @error('name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="w-full max-w-full px-3 lg:w-6/12 lg:flex-none">
                            <div class="mb-4">
                                <label for="price" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Giá (VNĐ) <span class="text-red-500">*</span></label>
                                <input type="number" name="price" id="price" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" value="{{ old('price', $package->price) }}" min="0" required>
                                @error('price')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="w-full max-w-full px-3 lg:w-6/12 lg:flex-none">
                            <div class="mb-4">
                                <label for="duration_hours" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Thời hạn (giờ)</label>
                                <input type="number" name="duration_hours" id="duration_hours" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" value="{{ old('duration_hours', $package->duration_hours) }}" min="1" placeholder="Ví dụ: 24, 72, 720">
                                @error('duration_hours')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="w-full max-w-full px-3">
                            <div class="mb-4">
                                <label for="description" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Mô tả</label>
                                <textarea name="description" id="description" rows="3" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none">{{ old('description', $package->description) }}</textarea>
                                @error('description')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Features -->
                        <div class="w-full max-w-full px-3">
                            <div class="mb-4">
                                <label class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Tính năng <span class="text-red-500">*</span></label>
                                <div id="features-container">
                                    @php($featureList = old('features', $package->features ?? ['']))
                                    @foreach($featureList as $index => $feature)
                                    <div class="flex items-center mb-2 feature-item">
                                        <input type="text" name="features[]" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none mr-2" value="{{ $feature }}" placeholder="Nhập tính năng..." required>
                                        <button type="button" class="remove-feature inline-block px-3 py-2 text-xs font-bold text-center text-white uppercase align-middle transition-all bg-red-600 border-0 rounded-lg cursor-pointer hover:scale-102 active:opacity-85 hover:shadow-xs leading-normal ease-in tracking-tight-rem shadow-md bg-150 bg-x-25" {{ $index == 0 && count($featureList) == 1 ? 'style=display:none' : '' }}>
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                    @endforeach
                                </div>
                                <button type="button" id="add-feature" class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer bg-gradient-to-tl from-orange-500 to-yellow-500 leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs">
                                    <i class="fas fa-plus mr-1"></i>Thêm tính năng
                                </button>
                                @error('features')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Status Options -->
                        <div class="w-full max-w-full px-3 lg:w-6/12 lg:flex-none">
                            <div class="mb-4">
                                <label class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Trạng thái</label>
                                <div class="flex items-center">
                                    <input type="checkbox" name="is_active" id="is_active" class="mr-2" value="1" {{ old('is_active', $package->is_active) ? 'checked' : '' }}>
                                    <label for="is_active" class="text-sm text-slate-700 dark:text-white/80">Kích hoạt</label>
                                </div>
                            </div>
                        </div>

                        <div class="w-full max-w-full px-3 lg:w-6/12 lg:flex-none">
                            <div class="mb-4">
                                <label class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Nổi bật</label>
                                <div class="flex items-center">
                                    <input type="checkbox" name="is_featured" id="is_featured" class="mr-2" value="1" {{ old('is_featured', $package->is_featured) ? 'checked' : '' }}>
                                    <label for="is_featured" class="text-sm text-slate-700 dark:text-white/80">Đánh dấu nổi bật</label>
                                </div>
                            </div>
                        </div>

                        <!-- Package Information -->
                        <div class="w-full max-w-full px-3">
                            <div class="p-4 mb-4 bg-gray-50 rounded-lg">
                                <h6 class="text-sm font-semibold text-gray-700 mb-2">Thông tin thêm</h6>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-600">
                                    <div>
                                        <strong>ID:</strong> {{ $package->id }}
                                    </div>
                                    <div>
                                        <strong>Ngày tạo:</strong> {{ $package->created_at->format('d/m/Y H:i') }}
                                    </div>
                                    <div>
                                        <strong>Cập nhật lần cuối:</strong> {{ $package->updated_at->format('d/m/Y H:i') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center justify-end pt-4 border-t border-gray-200">
                        <a href="{{ route('admin.service-packages.index') }}" class="inline-block px-6 py-3 mr-3 font-bold text-center text-gray-700 uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer leading-pro text-xs ease-soft-in tracking-tight-soft hover:scale-102 active:opacity-85">
                            Hủy
                        </a>
                        <button type="submit" class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer bg-gradient-to-tl from-green-600 to-lime-400 leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs">
                            <i class="fas fa-save mr-1"></i>Cập nhật
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const addFeatureBtn = document.getElementById('add-feature');
    const featuresContainer = document.getElementById('features-container');

    function updateRemoveButtons() {
        const featureItems = featuresContainer.querySelectorAll('.feature-item');
        featureItems.forEach((item, index) => {
            const removeBtn = item.querySelector('.remove-feature');
            if (featureItems.length > 1) {
                removeBtn.style.display = 'inline-block';
            } else {
                removeBtn.style.display = 'none';
            }
        });
    }

    addFeatureBtn.addEventListener('click', function() {
        const newFeatureItem = document.createElement('div');
        newFeatureItem.className = 'flex items-center mb-2 feature-item';
        newFeatureItem.innerHTML = `
            <input type="text" name="features[]" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none mr-2" placeholder="Nhập tính năng..." required>
            <button type="button" class="remove-feature inline-block px-3 py-2 text-xs font-bold text-center text-white uppercase align-middle transition-all bg-red-600 border-0 rounded-lg cursor-pointer hover:scale-102 active:opacity-85 hover:shadow-xs leading-normal ease-in tracking-tight-rem shadow-md bg-150 bg-x-25">
                <i class="fas fa-minus"></i>
            </button>
        `;

        featuresContainer.appendChild(newFeatureItem);
        updateRemoveButtons();

        // Add event listener to new remove button
        newFeatureItem.querySelector('.remove-feature').addEventListener('click', function() {
            newFeatureItem.remove();
            updateRemoveButtons();
        });
    });

    // Add event listeners to existing remove buttons
    featuresContainer.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-feature') || e.target.parentElement.classList.contains('remove-feature')) {
            const featureItem = e.target.closest('.feature-item');
            featureItem.remove();
            updateRemoveButtons();
        }
    });

    // Initial update
    updateRemoveButtons();
});
</script>
@endsection
