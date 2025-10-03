@extends('admin.layout')

@section('title', 'Tạo Đánh Giá Mới')

@section('content')
<div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <div class="flex items-center justify-between">
                    <h6 class="mb-0 dark:text-white">Tạo Đánh Giá Mới</h6>
                    <a href="{{ route('admin.testimonials.index') }}" class="inline-block px-4 py-2 text-xs font-bold text-center text-white uppercase align-middle transition-all bg-gray-600 border-0 rounded-lg cursor-pointer hover:scale-102 active:opacity-85 hover:shadow-xs leading-normal ease-in tracking-tight-rem shadow-md bg-150 bg-x-25">
                        <i class="fas fa-arrow-left mr-1"></i>Quay lại
                    </a>
                </div>
            </div>
            <div class="flex-auto p-6">
                <form action="{{ route('admin.testimonials.store') }}" method="POST">
                    @csrf
                    <div class="flex flex-wrap -mx-3">
                        <!-- Customer Information -->
                        <div class="w-full max-w-full px-3 lg:w-6/12 lg:flex-none">
                            <div class="mb-4">
                                <label for="name" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Tên khách hàng <span class="text-red-500">*</span></label>
                                <input type="text" name="name" id="name" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" value="{{ old('name') }}" required>
                                @error('name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="w-full max-w-full px-3 lg:w-6/12 lg:flex-none">
                            <div class="mb-4">
                                <label for="email" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Email <span class="text-red-500">*</span></label>
                                <input type="email" name="email" id="email" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" value="{{ old('email') }}" required>
                                @error('email')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="w-full max-w-full px-3 lg:w-6/12 lg:flex-none">
                            <div class="mb-4">
                                <label for="phone" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Số điện thoại</label>
                                <input type="text" name="phone" id="phone" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" value="{{ old('phone') }}">
                                @error('phone')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="w-full max-w-full px-3 lg:w-6/12 lg:flex-none">
                            <div class="mb-4">
                                <label for="rating" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Đánh giá <span class="text-red-500">*</span></label>
                                <select name="rating" id="rating" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" required>
                                    <option value="">Chọn số sao</option>
                                    <option value="5" {{ old('rating') == '5' ? 'selected' : '' }}>⭐⭐⭐⭐⭐ (5 sao)</option>
                                    <option value="4" {{ old('rating') == '4' ? 'selected' : '' }}>⭐⭐⭐⭐ (4 sao)</option>
                                    <option value="3" {{ old('rating') == '3' ? 'selected' : '' }}>⭐⭐⭐ (3 sao)</option>
                                    <option value="2" {{ old('rating') == '2' ? 'selected' : '' }}>⭐⭐ (2 sao)</option>
                                    <option value="1" {{ old('rating') == '1' ? 'selected' : '' }}>⭐ (1 sao)</option>
                                </select>
                                @error('rating')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="w-full max-w-full px-3">
                            <div class="mb-4">
                                <label for="content" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Nội dung đánh giá <span class="text-red-500">*</span></label>
                                <textarea name="content" id="content" rows="6" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" placeholder="Nhập nội dung đánh giá..." required>{{ old('content') }}</textarea>
                                @error('content')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Status Options -->
                        <div class="w-full max-w-full px-3 lg:w-6/12 lg:flex-none">
                            <div class="mb-4">
                                <label for="status" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Trạng thái</label>
                                <select name="status" id="status" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none">
                                    <option value="pending" {{ old('status', 'pending') == 'pending' ? 'selected' : '' }}>Chờ duyệt</option>
                                    <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Đã xuất bản</option>
                                    <option value="rejected" {{ old('status') == 'rejected' ? 'selected' : '' }}>Từ chối</option>
                                </select>
                                @error('status')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="w-full max-w-full px-3 lg:w-6/12 lg:flex-none">
                            <div class="mb-4">
                                <label class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Nổi bật</label>
                                <div class="flex items-center">
                                    <input type="checkbox" name="is_featured" id="is_featured" class="mr-2" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                                    <label for="is_featured" class="text-sm text-slate-700 dark:text-white/80">Đánh dấu nổi bật</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center justify-end pt-4 border-t border-gray-200">
                        <a href="{{ route('admin.testimonials.index') }}" class="inline-block px-6 py-2 mr-3 text-xs font-bold text-center text-gray-700 uppercase align-middle transition-all bg-gray-200 border-0 rounded-lg cursor-pointer hover:scale-102 active:opacity-85 hover:shadow-xs leading-normal ease-in tracking-tight-rem shadow-md bg-150 bg-x-25">
                            Hủy
                        </a>
                        <button type="submit" class="inline-block px-6 py-2 text-xs font-bold text-center text-white uppercase align-middle transition-all bg-blue-600 border-0 rounded-lg cursor-pointer hover:scale-102 active:opacity-85 hover:shadow-xs leading-normal ease-in tracking-tight-rem shadow-md bg-150 bg-x-25">
                            <i class="fas fa-save mr-1"></i>Lưu đánh giá
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
