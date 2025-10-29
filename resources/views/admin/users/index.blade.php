@extends('admin.layout')
@section('page-title', 'Quản lý Người dùng - Paspark Admin')
@section('page-heading', 'Quản lý Người dùng')

@section('content')
<div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <div class="flex flex-wrap items-center justify-between mb-4">
                    <h6 class="mb-0 dark:text-gray-700">Danh sách Người dùng</h6>
                    <a href="{{ route('admin.users.create') }}" class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer bg-gradient-to-tl from-green-600 to-lime-400 leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs">
                        <i class="fas fa-plus mr-2"></i>Thêm người dùng
                    </a>
                </div>

                <!-- Filter Form -->
                <form method="GET" class="mb-4">
                    <div class="flex flex-wrap -mx-2">
                        <div class="w-full md:w-1/3 px-2 mb-3">
                            <input type="text" name="search" value="{{ request('search') }}" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" placeholder="Tìm kiếm theo tên, email, số điện thoại...">
                        </div>
                        <div class="w-full md:w-1/4 px-2 mb-3">
                            <select name="status" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow">
                                <option value="">Tất cả trạng thái</option>
                                <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Hoạt động</option>
                                <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Không hoạt động</option>
                            </select>
                        </div>
                        <div class="w-full md:w-1/4 px-2 mb-3">
                            <button type="submit" class="inline-block px-6 py-2 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md hover:scale-102 active:opacity-85 hover:shadow-soft-xs" style="background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);">
                                <i class="fas fa-search mr-1"></i>Tìm kiếm
                            </button>
                            <a href="{{ route('admin.users.index') }}" class="inline-block px-4 py-2 ml-2 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md hover:scale-102 active:opacity-85 hover:shadow-soft-xs" style="background: linear-gradient(135deg, #6b7280 0%, #9ca3af 100%);">
                                Xóa lọc
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            <div class="flex-auto px-0 pt-0 pb-2">
                <div class="p-0 overflow-x-auto">
                    <table class="items-center w-full mb-0 align-top border-collapse dark:border-white/40 text-slate-500">
                        <thead class="align-bottom">
                            <tr>
                                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    #
                                </th>
                                <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Thông tin
                                </th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Số điện thoại
                                </th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Trạng thái
                                </th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Ngày tạo
                                </th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Thao tác
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                            <tr>
                                <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                    <p class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-80">{{ $user->id }}</p>
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 shadow-transparent">
                                    <div class="flex px-2 py-1">
                                        <div class="flex flex-col justify-center">
                                            <h6 class="mb-0 text-sm leading-normal dark:text-white">{{ $user->name }}</h6>
                                            <p class="mb-0 text-xs leading-tight dark:text-white dark:opacity-80 text-slate-400">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                    <span class="text-xs font-semibold leading-tight dark:text-white dark:opacity-80">{{ $user->phone ?? 'Chưa có' }}</span>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                    @if($user->is_active)
                                        <span class="bg-gradient-to-tl from-green-600 to-lime-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">Hoạt động</span>
                                    @else
                                        <span class="bg-gradient-to-tl from-slate-600 to-slate-300 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">Không hoạt động</span>
                                    @endif
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                    <span class="text-xs font-semibold leading-tight dark:text-white dark:opacity-80">{{ $user->created_at->format('d/m/Y') }}</span>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                    <div class="flex justify-center items-center flex-wrap gap-2">
                                        <a href="{{ route('admin.users.show', $user) }}" class="btn-chip btn-blue" title="Xem chi tiết">
                                            <i class="fas fa-eye btn-icon"></i>
                                            <span class="hidden sm:inline">Xem</span>
                                        </a>
                                        <a href="{{ route('admin.users.edit', $user) }}" class="btn-chip btn-emerald" title="Chỉnh sửa">
                                            <i class="fas fa-edit btn-icon"></i>
                                            <span class="hidden sm:inline">Sửa</span>
                                        </a>
                                        <form method="POST" action="{{ route('admin.users.toggle-status', $user) }}" class="inline-flex">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn-chip btn-orange" title="{{ $user->is_active ? 'Vô hiệu hóa' : 'Kích hoạt' }}">
                                                <i class="fas fa-{{ $user->is_active ? 'ban' : 'check' }} btn-icon"></i>
                                                <span class="hidden sm:inline">{{ $user->is_active ? 'Vô hiệu' : 'Kích hoạt' }}</span>
                                            </button>
                                        </form>
                                        @if($user->bookings_count == 0)
                                        <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="inline-flex" onsubmit="return confirm('Bạn có chắc chắn muốn xóa người dùng này?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-chip btn-red" title="Xóa">
                                                <i class="fas fa-trash btn-icon"></i>
                                                <span class="hidden sm:inline">Xóa</span>
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="p-4 text-center text-slate-400">
                                    <i class="fas fa-users text-4xl mb-4 opacity-50"></i>
                                    <p class="text-lg">Không có người dùng nào</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if($users->hasPages())
            <div class="px-6 py-4">
                {{ $users->appends(request()->query())->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
