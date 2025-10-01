

@extends('admin.layouts')

@section('title', 'Về chúng tôi - Paspark Admin')
@section('page_title', 'Về hệ thống Paspark')
@section('breadcrumb', 'Về chúng tôi')

@section('content')
<div class="flex flex-wrap -mx-3">
    <div class="w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-6">
                <div class="text-center mb-6">
                    <img src="{{ asset('admin/img/logo.png') }}" class="inline h-16 max-w-full" alt="Paspark Logo" />
                    <h1 class="text-3xl font-bold text-slate-700 dark:text-white mt-4">Paspark Admin</h1>
                    <p class="text-slate-500 dark:text-white/80">Hệ thống quản lý bãi đỗ xe thông minh</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="text-center p-6 bg-gradient-to-tl from-blue-500 to-violet-500 rounded-lg text-white">
                        <i class="ni ni-settings text-4xl mb-4"></i>
                        <h3 class="text-xl font-semibold mb-2">Quản lý hiệu quả</h3>
                        <p class="text-sm opacity-90">Theo dũi và quản lý tất cả vị trí đỗ xe một cách dễ dàng</p>
                    </div>

                    <div class="text-center p-6 bg-gradient-to-tl from-emerald-500 to-teal-400 rounded-lg text-white">
                        <i class="ni ni-chart-bar-32 text-4xl mb-4"></i>
                        <h3 class="text-xl font-semibold mb-2">Báo cáo chi tiết</h3>
                        <p class="text-sm opacity-90">Phân tích doanh thu và hiệu suất sử dụng bãi đỗ</p>
                    </div>

                    <div class="text-center p-6 bg-gradient-to-tl from-red-500 to-pink-500 rounded-lg text-white">
                        <i class="ni ni-single-02 text-4xl mb-4"></i>
                        <h3 class="text-xl font-semibold mb-2">Quản lý khách hàng</h3>
                        <p class="text-sm opacity-90">Theo dõi thông tin và lịch sử của khách hàng</p>
                    </div>

                    <div class="text-center p-6 bg-gradient-to-tl from-orange-500 to-yellow-500 rounded-lg text-white">
                        <i class="ni ni-money-coins text-4xl mb-4"></i>
                        <h3 class="text-xl font-semibold mb-2">Theo dõi doanh thu</h3>
                        <p class="text-sm opacity-90">Quản lý và theo dõi doanh thu theo thời gian thực</p>
                    </div>
                </div>

                <div class="mt-8 text-center">
                    <h3 class="text-xl font-semibold text-slate-700 dark:text-white mb-4">Phiên bản hệ thống</h3>
                    <div class="inline-block px-6 py-3 bg-gray-100 dark:bg-slate-800 rounded-lg">
                        <span class="text-sm font-medium text-slate-600 dark:text-white">Version 1.0.0</span>
                        <span class="mx-2 text-slate-400">|</span>
                        <span class="text-sm text-slate-600 dark:text-white">Laravel {{ app()->version() }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
