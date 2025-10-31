@extends('admin.layout')
@section('page-title', 'Báo cáo & Thống kê - Tổng quan')
@section('page-heading', 'Báo cáo & Thống kê')

@section('content')
<div class="flex flex-wrap -mx-3 mb-4">
  <div class="w-full px-3">
    <div class="p-4 bg-white dark:bg-slate-850 rounded-2xl shadow flex flex-wrap items-center gap-2">
      <span class="text-xs text-slate-500 mr-2">Đi nhanh:</span>
      <a href="{{ route('admin.reports.revenue') }}" class="btn-chip btn-blue"><i class="btn-icon fas fa-chart-line"></i>Doanh thu</a>
      <a href="{{ route('admin.reports.usage') }}" class="btn-chip btn-emerald"><i class="btn-icon fas fa-chart-bar"></i>Sử dụng</a>
      <a href="{{ route('admin.reports.export', 'revenue') }}" class="btn-chip btn-orange"><i class="btn-icon fas fa-file-archive"></i>Tải dữ liệu (Doanh thu)</a>
      <a href="{{ route('admin.reports.export', 'usage') }}" class="btn-chip btn-orange"><i class="btn-icon fas fa-file-archive"></i>Tải dữ liệu (Sử dụng)</a>
    </div>
  </div>
  </div>

<div class="flex flex-wrap -mx-3 mb-6">
  <div class="w-full max-w-full px-3">
    <div class="relative flex flex-col bg-white dark:bg-slate-850 shadow-xl rounded-2xl">
      <div class="p-6 pb-0">
        <h6 class="mb-0 dark:text-white">Tổng quan</h6>
      </div>
      <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="p-4 bg-gray-50 rounded-xl"><div class="text-slate-400 text-xs mb-1">Tổng doanh thu</div><div class="text-2xl font-bold" id="cardTotalRevenue">-</div></div>
        <div class="p-4 bg-gray-50 rounded-xl"><div class="text-slate-400 text-xs mb-1">Tổng lượt đặt</div><div class="text-2xl font-bold" id="cardTotalBookings">-</div></div>
        <div class="p-4 bg-gray-50 rounded-xl"><div class="text-slate-400 text-xs mb-1">Top bãi đỗ xe</div><div class="text-sm" id="cardTopLot">-</div></div>
      </div>
    </div>
  </div>
</div>

<div class="flex flex-wrap -mx-3 mb-6">
  <div class="w-full lg:w-8/12 px-3 mb-6">
    <div class="relative flex flex-col bg-white dark:bg-slate-850 shadow-xl rounded-2xl">
      <div class="p-6 pb-0"><h6 class="mb-0 dark:text-white">Doanh thu theo tháng</h6></div>
      <div class="p-6"><canvas id="revByMonth" class="max-h-96"></canvas></div>
    </div>
  </div>
  <div class="w-full lg:w-4/12 px-3 mb-6">
    <div class="relative flex flex-col bg-white dark:bg-slate-850 shadow-xl rounded-2xl">
      <div class="p-6 pb-0"><h6 class="mb-0 dark:text-white">Trạng thái Booking</h6></div>
      <div class="p-6"><canvas id="statusChart" class="max-h-80"></canvas></div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
  fetch('/admin/api/reports/summary', { headers: { 'Accept': 'application/json' }})
    .then(r => r.json())
    .then(json => {
      document.getElementById('cardTotalRevenue').innerText = new Intl.NumberFormat('vi-VN').format(Math.round(json.summary.totalRevenue || 0)) + 'đ';
      document.getElementById('cardTotalBookings').innerText = new Intl.NumberFormat('vi-VN').format(json.summary.totalBookings || 0);

      const top = (json.topParkingLots || [])[0];
      document.getElementById('cardTopLot').innerText = top ? `${top.name}: ${new Intl.NumberFormat('vi-VN').format(Math.round(top.revenue))}đ` : '-';

      const rc = document.getElementById('revByMonth').getContext('2d');
      new Chart(rc, {
        type: 'line',
        data: {
          labels: json.revenueByMonth.labels || [],
          datasets: [{
            label: 'Doanh thu',
            data: json.revenueByMonth.totals || [],
            borderColor: 'rgb(59,130,246)',
            backgroundColor: 'rgba(59,130,246,0.12)',
            borderWidth: 3,
            fill: true,
            tension: 0.35
          }]
        },
        options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } } }
      });

      const sc = document.getElementById('statusChart').getContext('2d');
      const statusMap = json.bookingsByStatus || {};
      const labels = Object.keys(statusMap);
      const data = labels.map(k => statusMap[k]);
      new Chart(sc, {
        type: 'doughnut',
        data: { labels, datasets: [{ data, backgroundColor: ['#22c55e','#3b82f6','#f59e0b','#ef4444'], borderWidth: 0 }] },
        options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom' } } }
      });
    });
});
</script>
@endpush
