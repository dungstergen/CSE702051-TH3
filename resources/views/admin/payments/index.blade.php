@extends('admin.layout')
@section('page-title', 'Quản lý Thanh toán - Paspark Admin')
@section('page-heading', 'Quản lý Thanh toán')

@section('content')
<div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <div class="flex items-center justify-between mb-4">
                    <h6 class="mb-0 dark:text-white">Danh sách thanh toán</h6>
                    <a href="{{ route('admin.payments.create') }}" class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer bg-gradient-to-tl from-green-600 to-lime-400 leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs">
                        <i class="fas fa-plus mr-2"></i>Thêm thanh toán
                    </a>
                </div>

                <!-- Search and Filter -->
                <div class="flex flex-wrap items-center justify-between mb-4">
                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <input type="text" id="searchInput" placeholder="Tìm kiếm thanh toán..." class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-80 appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow">
                            <i class="fas fa-search absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        </div>

                        <select id="statusFilter" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow">
                            <option value="">Tất cả trạng thái</option>
                            <option value="pending">Chờ thanh toán</option>
                            <option value="completed">Đã thanh toán</option>
                            <option value="failed">Thất bại</option>
                            <option value="refunded">Đã hoàn tiền</option>
                        </select>

                        <select id="methodFilter" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow">
                            <option value="">Tất cả phương thức</option>
                            <option value="momo">Ví MoMo</option>
                            <option value="zalopay">Vietcombank</option>
                            <option value="vnpay">VietinBank</option>
                            <option value="banking">Thẻ ATM/Internet Banking</option>
                            <option value="cash">Thanh toán tại chỗ</option>
                        </select>

                        <input type="date" id="dateFilter" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow">
                    </div>

                    <div class="text-sm text-gray-600">
                        Tổng: <span class="font-semibold" id="totalCount">{{ $payments->total() }}</span> thanh toán
                        <br>
                        Tổng tiền: <span class="font-semibold text-green-600">{{ number_format($payments->sum('amount'), 0, ',', '.') }}đ</span>
                    </div>
                </div>
            </div>

            <div class="flex-auto px-0 pt-0 pb-2">
                <div class="p-0 overflow-x-auto">
                    <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                        <thead class="align-bottom">
                            <tr>
                                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Khách hàng</th>
                                <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Booking</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Phương thức</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Số tiền</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Trạng thái</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Ngày TT</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody id="paymentsTable">
                            @forelse($payments as $payment)
                            <tr class="payment-row" data-user="{{ strtolower($payment->booking->user->name) }}" data-email="{{ strtolower($payment->booking->user->email) }}" data-status="{{ $payment->status }}" data-method="{{ $payment->payment_method }}" data-date="{{ $payment->created_at->format('Y-m-d') }}">
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="flex px-2 py-1">
                                        <div class="flex flex-col justify-center">
                                            <h6 class="mb-0 text-sm leading-normal dark:text-white">{{ $payment->booking->user->name }}</h6>
                                            <p class="mb-0 text-xs leading-tight text-slate-400">{{ $payment->booking->user->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="flex flex-col justify-center">
                                        <p class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-80">
                                            <a href="{{ route('admin.bookings.show', $payment->booking) }}" class="text-blue-600 hover:text-blue-800">
                                                Booking #{{ $payment->booking->id }}
                                            </a>
                                        </p>
                                        <p class="mb-0 text-xs leading-tight text-slate-400">{{ $payment->booking->parkingLot->name }}</p>
                                    </div>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="flex flex-col items-center">
                                        @if($payment->payment_method === 'momo')
                                            <span class="text-xs font-semibold text-pink-600">
                                                <i class="fas fa-wallet mr-1"></i>Ví MoMo
                                            </span>
                                        @elseif($payment->payment_method === 'zalopay')
                                            <span class="text-xs font-semibold text-green-600">
                                                <i class="fas fa-university mr-1"></i>Vietcombank
                                            </span>
                                        @elseif($payment->payment_method === 'vnpay')
                                            <span class="text-xs font-semibold text-blue-600">
                                                <i class="fas fa-university mr-1"></i>VietinBank
                                            </span>
                                        @elseif($payment->payment_method === 'banking')
                                            <span class="text-xs font-semibold text-purple-600">
                                                <i class="fas fa-credit-card mr-1"></i>Thẻ ATM/Internet Banking
                                            </span>
                                        @elseif($payment->payment_method === 'cash')
                                            <span class="text-xs font-semibold text-orange-600">
                                                <i class="fas fa-money-bill mr-1"></i>Thanh toán tại chỗ
                                            </span>
                                        @else
                                            <span class="text-xs font-semibold text-gray-600">{{ ucfirst($payment->payment_method) }}</span>
                                        @endif
                                        @if($payment->transaction_id)
                                            <p class="mb-0 text-xs leading-tight text-slate-400">{{ substr($payment->transaction_id, 0, 8) }}...</p>
                                        @endif
                                    </div>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span class="text-sm font-bold text-purple-600">
                                        {{ number_format($payment->amount, 0, ',', '.') }}đ
                                    </span>
                                </td>
                                <td class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    @if($payment->status === 'pending')
                                        <span class="bg-gradient-to-tl from-yellow-500 to-orange-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                            Chờ TT
                                        </span>
                                    @elseif($payment->status === 'completed')
                                        <span class="bg-gradient-to-tl from-green-600 to-lime-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                            Đã TT
                                        </span>
                                    @elseif($payment->status === 'failed')
                                        <span class="bg-gradient-to-tl from-red-600 to-rose-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                            Thất bại
                                        </span>
                                    @else
                                        <span class="bg-gradient-to-tl from-blue-600 to-cyan-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                            Hoàn tiền
                                        </span>
                                    @endif
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="flex flex-col items-center">
                                        @if($payment->paid_at)
                                            <span class="text-xs font-semibold leading-tight dark:text-white dark:opacity-80">
                                                {{ $payment->paid_at->format('d/m/Y') }}
                                            </span>
                                            <span class="text-xs leading-tight text-slate-400">
                                                {{ $payment->paid_at->format('H:i') }}
                                            </span>
                                        @else
                                            <span class="text-xs text-gray-400">Chưa TT</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="flex items-center justify-center space-x-2">
                                        <a href="{{ route('admin.payments.show', $payment) }}" class="text-blue-600 hover:text-blue-800 transition-colors" title="Xem chi tiết">
                                            <i class="fas fa-eye text-sm"></i>
                                        </a>
                                        @if($payment->status !== 'completed')
                                        <a href="{{ route('admin.payments.edit', $payment) }}" class="text-orange-600 hover:text-orange-800 transition-colors" title="Chỉnh sửa">
                                            <i class="fas fa-edit text-sm"></i>
                                        </a>
                                        @endif
                                        @if($payment->status === 'pending')
                                        <form method="POST" action="{{ route('admin.payments.destroy', $payment) }}" class="inline-block" onsubmit="return confirm('Bạn có chắc chắn muốn xóa thanh toán này?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 transition-colors" title="Xóa">
                                                <i class="fas fa-trash text-sm"></i>
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="p-6 text-center text-slate-400">
                                    Không có thanh toán nào
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            @if($payments->hasPages())
            <div class="flex items-center justify-between px-6 py-3 border-t border-gray-200">
                <div class="flex items-center">
                    <p class="text-sm text-gray-700">
                        Hiển thị {{ $payments->firstItem() }} đến {{ $payments->lastItem() }} trong tổng số {{ $payments->total() }} kết quả
                    </p>
                </div>
                <div class="flex items-center space-x-2">
                    {{ $payments->links() }}
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const statusFilter = document.getElementById('statusFilter');
    const methodFilter = document.getElementById('methodFilter');
    const dateFilter = document.getElementById('dateFilter');
    const rows = document.querySelectorAll('.payment-row');
    const totalCount = document.getElementById('totalCount');

    function filterRows() {
        const searchTerm = searchInput.value.toLowerCase();
        const statusValue = statusFilter.value;
        const methodValue = methodFilter.value;
        const dateValue = dateFilter.value;
        let visibleCount = 0;

        rows.forEach(row => {
            const user = row.dataset.user;
            const email = row.dataset.email;
            const status = row.dataset.status;
            const method = row.dataset.method;
            const date = row.dataset.date;

            const matchesSearch = user.includes(searchTerm) || email.includes(searchTerm);
            const matchesStatus = !statusValue || status === statusValue;
            const matchesMethod = !methodValue || method === methodValue;
            const matchesDate = !dateValue || date === dateValue;

            if (matchesSearch && matchesStatus && matchesMethod && matchesDate) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        totalCount.textContent = visibleCount;
    }

    searchInput.addEventListener('input', filterRows);
    statusFilter.addEventListener('change', filterRows);
    methodFilter.addEventListener('change', filterRows);
    dateFilter.addEventListener('change', filterRows);
});
</script>
@endsection
