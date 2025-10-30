@extends('admin.layout')
@section('page-title', 'Báo cáo Sử dụng')
@section('page-heading', 'Báo cáo Sử dụng')

@section('content')
<!-- Filter Section -->
<div class="flex flex-wrap -mx-3 mb-6">
	<div class="w-full max-w-full px-3">
		<div class="relative flex flex-col bg-white dark:bg-slate-850 shadow-xl rounded-2xl">
			<div class="p-6 pb-0"><h6 class="mb-0 dark:text-white">Bộ lọc báo cáo sử dụng</h6></div>
			<div class="p-6 grid grid-cols-1 md:grid-cols-4 gap-4">
				<div>
					<label class="text-xs text-slate-500">Từ ngày</label>
					<input type="date" id="start_date" class="w-full border rounded-lg px-3 py-2" value="{{ now()->subDays(7)->format('Y-m-d') }}">
				</div>
				<div>
					<label class="text-xs text-slate-500">Đến ngày</label>
					<input type="date" id="end_date" class="w-full border rounded-lg px-3 py-2" value="{{ now()->format('Y-m-d') }}">
				</div>
				<div>
					<label class="text-xs text-slate-500">Bãi đỗ xe</label>
					<select id="parking_lot_filter" class="w-full border rounded-lg px-3 py-2">
						<option value="">Tất cả bãi đỗ xe</option>
					</select>
				</div>
				<div class="flex items-end gap-2">
					<button type="button" id="applyFilter" class="px-4 py-2 rounded-lg text-white bg-blue-600">Lọc</button>
					<button type="button" id="exportUsage" class="px-4 py-2 rounded-lg text-white bg-emerald-600">Xuất Excel</button>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Usage Summary Cards -->
<div class="flex flex-wrap -mx-3 mb-6">
	<div class="w-full xl:w-1/4 px-3 mb-6"><div class="p-4 bg-white dark:bg-slate-850 rounded-2xl shadow"><div class="text-xs text-slate-400">Tổng lượt đặt</div><div class="text-2xl font-bold" id="totalBookings">-</div></div></div>
	<div class="w-full xl:w-1/4 px-3 mb-6"><div class="p-4 bg-white dark:bg-slate-850 rounded-2xl shadow"><div class="text-xs text-slate-400">Tỷ lệ sử dụng</div><div class="text-2xl font-bold" id="occupancyRate">-</div></div></div>
	<div class="w-full xl:w-1/4 px-3 mb-6"><div class="p-4 bg-white dark:bg-slate-850 rounded-2xl shadow"><div class="text-xs text-slate-400">Giờ cao điểm</div><div class="text-2xl font-bold" id="peakHour">-</div></div></div>
	<div class="w-full xl:w-1/4 px-3 mb-6"><div class="p-4 bg-white dark:bg-slate-850 rounded-2xl shadow"><div class="text-xs text-slate-400">Thời gian TB</div><div class="text-2xl font-bold" id="avgDuration">-</div></div></div>

</div>

<!-- Charts Section -->
<div class="flex flex-wrap -mx-3 mb-6">
	<div class="w-full lg:w-8/12 px-3 mb-6">
		<div class="relative flex flex-col bg-white dark:bg-slate-850 shadow-xl rounded-2xl">
			<div class="p-6 pb-0 flex items-center justify-between">
				<h6 class="mb-0 dark:text-white">Biểu đồ sử dụng theo giờ</h6>
				<div class="flex gap-2">
					<button type="button" class="usage-period-btn active" data-period="today">Hôm nay</button>
					<button type="button" class="usage-period-btn" data-period="week">Tuần này</button>
					<button type="button" class="usage-period-btn" data-period="month">Tháng này</button>
				</div>
			</div>
			<div class="p-6"><canvas id="hourlyUsageChart" class="max-h-96"></canvas></div>
		</div>
	</div>
	<div class="w-full lg:w-4/12 px-3 mb-6">
		<div class="relative flex flex-col bg-white dark:bg-slate-850 shadow-xl rounded-2xl">
			<div class="p-6 pb-0"><h6 class="mb-0 dark:text-white">Trạng thái booking</h6></div>
			<div class="p-6"><canvas id="bookingStatusChart" class="max-h-80"></canvas></div>
		</div>
	</div>
</div>

<!-- Detailed Usage Analytics -->
<div class="flex flex-wrap -mx-3 mb-6">
	<div class="w-full lg:w-6/12 px-3 mb-6">
		<div class="relative flex flex-col bg-white dark:bg-slate-850 shadow-xl rounded-2xl">
			<div class="p-6 pb-0"><h6 class="mb-0 dark:text-white">Sử dụng theo bãi đỗ xe</h6></div>
			<div class="p-6 overflow-x-auto">
				<table class="w-full text-slate-600">
					<thead><tr><th class="text-left p-2">Bãi đỗ xe</th><th class="text-center p-2">Booking</th><th class="text-center p-2">Tỷ lệ sử dụng</th><th class="text-center p-2">TB giờ/booking</th></tr></thead>
					<tbody id="usageByLotBody"></tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="w-full lg:w-6/12 px-3 mb-6">
		<div class="relative flex flex-col bg-white dark:bg-slate-850 shadow-xl rounded-2xl">
			<div class="p-6 pb-0"><h6 class="mb-0 dark:text-white">Phân tích giờ cao điểm</h6></div>
			<div class="p-6"><div class="space-y-4" id="peakHoursContainer"></div></div>
		</div>
	</div>
</div>

<!-- Weekly Pattern -->
<div class="flex flex-wrap -mx-3 mb-6">
	<div class="w-full px-3">
		<div class="relative flex flex-col bg-white dark:bg-slate-850 shadow-xl rounded-2xl">
			<div class="p-6 pb-0"><h6 class="mb-0 dark:text-white">Mẫu sử dụng theo tuần</h6></div>
			<div class="p-6"><canvas id="weeklyPatternChart" class="max-h-96"></canvas></div>
		</div>
	</div>
</div>
@endsection

@push('styles')
<style>
.usage-period-btn { padding: 6px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 12px; background: #f1f5f9; color: #334155 }
.usage-period-btn.active { background: #2563eb; color: #fff; border-color: #2563eb }
.usage-period-btn:not(.active):hover { background: #e2e8f0 }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
	// Populate parking lots
	fetch('/user/api/parking-lots', { headers: { 'Accept': 'application/json' }})
		.then(r => r.json())
		.then(json => { const sel = document.getElementById('parking_lot_filter'); if (Array.isArray(json)) json.forEach(l => { const o = document.createElement('option'); o.value = l.id; o.textContent = l.name; sel.appendChild(o); }); });

	const hourlyCtx = document.getElementById('hourlyUsageChart').getContext('2d');
	const hourlyChart = new Chart(hourlyCtx, { type: 'bar', data: { labels: [], datasets: [{ label: 'Lượt đặt', data: [], backgroundColor: 'rgba(59,130,246,0.8)', borderColor: '#3b82f6', borderWidth: 1 }] }, options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } } } });

	const statusCtx = document.getElementById('bookingStatusChart').getContext('2d');
	const statusChart = new Chart(statusCtx, { type: 'doughnut', data: { labels: [], datasets: [{ data: [], backgroundColor: ['#22c55e','#3b82f6','#f59e0b','#ef4444'], borderWidth: 0 }] }, options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom' } } } });

	const weeklyCtx = document.getElementById('weeklyPatternChart').getContext('2d');
	const weeklyChart = new Chart(weeklyCtx, { type: 'line', data: { labels: [], datasets: [{ label: 'Số booking', data: [], borderColor: '#22c55e', backgroundColor: 'rgba(34,197,94,0.1)', borderWidth: 3, fill: true, tension: 0.35 }, { label: 'Tỷ lệ sử dụng (%)', data: [], borderColor: '#f59e0b', backgroundColor: 'rgba(245,158,11,0.1)', borderWidth: 3, fill: false, tension: 0.35, yAxisID: 'y1' }] }, options: { responsive: true, maintainAspectRatio: false, scales: { y1: { type: 'linear', position: 'right', max: 100, grid: { drawOnChartArea: false }, ticks: { callback: v => v + '%' } } } } });

	function fetchAndRenderUsage(startDate, endDate, parkingLotId = '', period = 'today') {
		const params = new URLSearchParams({ start_date: startDate, end_date: endDate, period });
		if (parkingLotId) params.append('parking_lot_id', parkingLotId);
		fetch('/admin/api/reports/usage?' + params.toString(), { headers: { 'Accept': 'application/json' }})
			.then(r => r.json())
			.then(json => {
				document.getElementById('totalBookings').innerText = new Intl.NumberFormat('vi-VN').format(json.summary.totalBookings || 0);
				document.getElementById('avgDuration').innerText = (json.summary.avgDuration || 0).toFixed(1) + ' giờ';
				document.getElementById('peakHour').innerText = (json.summary.peakHour && json.summary.peakHour.label) ? json.summary.peakHour.label : '-';
				document.getElementById('occupancyRate').innerText = '-';

				hourlyChart.data.labels = json.hourly.labels || [];
				hourlyChart.data.datasets[0].data = json.hourly.counts || [];
				hourlyChart.update();

				const statusMap = json.status || {};
				const sLabels = Object.keys(statusMap);
				const sData = sLabels.map(k => statusMap[k]);
				statusChart.data.labels = sLabels;
				statusChart.data.datasets[0].data = sData;
				statusChart.update();

				weeklyChart.data.labels = json.weekly.labels || [];
				const weeklyBookings = json.weekly.bookings || [];
				weeklyChart.data.datasets[0].data = weeklyBookings;
				const maxWeekly = Math.max(1, ...weeklyBookings);
				weeklyChart.data.datasets[1].data = weeklyBookings.map(v => Math.round((v * 100) / maxWeekly));
				weeklyChart.update();

				const tbody = document.getElementById('usageByLotBody');
				tbody.innerHTML = '';
				(json.byParkingLot || []).forEach(row => {
					const tr = document.createElement('tr');
					tr.innerHTML = `
						<td class=\"p-2\">${row.name}</td>
						<td class=\"p-2 text-center\">${row.bookings || 0}</td>
						<td class=\"p-2 text-center\">-</td>
						<td class=\"p-2 text-center\">${(row.avg_hours || 0).toFixed(1)}h</td>`;
					tbody.appendChild(tr);
				});

				const peakContainer = document.getElementById('peakHoursContainer');
				peakContainer.innerHTML = '';
				const counts = (json.hourly && json.hourly.counts) ? json.hourly.counts : [];
				const labelsH = (json.hourly && json.hourly.labels) ? json.hourly.labels : [];
				const pairs = counts.map((v, i) => ({ v, i })).sort((a,b) => b.v - a.v).slice(0, 3);
				const colors = ['bg-red-600','bg-orange-500','bg-yellow-500'];
				pairs.forEach((p, idx) => {
					const item = document.createElement('div');
					item.className = 'flex items-center justify-between p-3 bg-gray-50 rounded-lg';
					item.innerHTML = `
						<div class=\"flex items-center\"><div class=\"w-3 h-3 ${colors[idx % colors.length]} rounded-full mr-3\"></div><div><h6 class=\"text-sm font-semibold\">${labelsH[p.i] || ''}</h6><p class=\"text-xs text-gray-600\">Cao điểm</p></div></div>
						<div class=\"text-right\"><div class=\"text-lg font-bold text-gray-800\">${p.v}</div><div class=\"w-16 h-2 bg-gray-200 rounded overflow-hidden\"><div class=\"h-full ${colors[idx % colors.length]}\" style=\"width: 100%\"></div></div></div>`;
					peakContainer.appendChild(item);
				});
			});
	}

	document.querySelectorAll('.usage-period-btn').forEach(btn => {
		btn.addEventListener('click', function() {
			document.querySelectorAll('.usage-period-btn').forEach(b => b.classList.remove('active'));
			this.classList.add('active');
			const startDate = document.getElementById('start_date').value;
			const endDate = document.getElementById('end_date').value;
			const parkingLot = document.getElementById('parking_lot_filter').value;
			fetchAndRenderUsage(startDate, endDate, parkingLot, this.dataset.period);
		});
	});

	document.getElementById('applyFilter').addEventListener('click', function() {
		const startDate = document.getElementById('start_date').value;
		const endDate = document.getElementById('end_date').value;
		const parkingLot = document.getElementById('parking_lot_filter').value;
		const activeBtn = document.querySelector('.usage-period-btn.active');
		const period = activeBtn ? activeBtn.dataset.period : 'today';
		fetchAndRenderUsage(startDate, endDate, parkingLot, period);
	});

	document.getElementById('exportUsage').addEventListener('click', function() {
		const startDate = document.getElementById('start_date').value;
		const endDate = document.getElementById('end_date').value;
		window.location.href = `{{ route('admin.reports.export', 'usage') }}?start_date=${startDate}&end_date=${endDate}`;
	});

	// Initial load
	fetchAndRenderUsage(document.getElementById('start_date').value, document.getElementById('end_date').value);
});
</script>
@endpush
