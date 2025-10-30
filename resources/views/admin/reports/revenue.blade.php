@extends('admin.layout')
@section('page-title', 'Báo cáo Doanh thu')
@section('page-heading', 'Báo cáo Doanh thu')

@section('content')
<div class="flex flex-wrap -mx-3 mb-6">
	<div class="w-full max-w-full px-3">
		<div class="relative flex flex-col bg-white dark:bg-slate-850 shadow-xl rounded-2xl">
			<div class="p-6 pb-0">
				<h6 class="mb-0 dark:text-white">Bộ lọc</h6>
			</div>
			<div class="p-6 grid grid-cols-1 md:grid-cols-4 gap-4">
				<div>
					<label class="text-xs text-slate-500">Từ ngày</label>
					<input type="date" id="start_date" class="w-full border rounded-lg px-3 py-2" value="{{ now()->subDays(30)->format('Y-m-d') }}">
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
					<button type="button" id="exportRevenue" class="px-4 py-2 rounded-lg text-white bg-emerald-600">Xuất Excel</button>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="flex flex-wrap -mx-3 mb-6">
	<div class="w-full xl:w-1/4 px-3 mb-6">
		<div class="p-4 bg-white dark:bg-slate-850 rounded-2xl shadow"><div class="text-xs text-slate-400">Tổng doanh thu</div><div class="text-2xl font-bold" id="totalRevenue">-</div></div>
	</div>
	<div class="w-full xl:w-1/4 px-3 mb-6">
		<div class="p-4 bg-white dark:bg-slate-850 rounded-2xl shadow"><div class="text-xs text-slate-400">Doanh thu TB/ngày</div><div class="text-2xl font-bold" id="avgRevenue">-</div></div>
	</div>
	<div class="w-full xl:w-1/4 px-3 mb-6">
		<div class="p-4 bg-white dark:bg-slate-850 rounded-2xl shadow"><div class="text-xs text-slate-400">Ngày cao nhất</div><div class="text-2xl font-bold" id="peakRevenue">-</div></div>
	</div>
</div>

<div class="flex flex-wrap -mx-3 mb-6">
	<div class="w-full lg:w-8/12 px-3 mb-6">
		<div class="relative flex flex-col bg-white dark:bg-slate-850 shadow-xl rounded-2xl">
			<div class="p-6 pb-0"><h6 class="mb-0 dark:text-white">Doanh thu theo ngày</h6></div>
			<div class="p-6"><canvas id="revenueChart" class="max-h-96"></canvas></div>
		</div>
	</div>
	<div class="w-full lg:w-4/12 px-3 mb-6">
		<div class="relative flex flex-col bg-white dark:bg-slate-850 shadow-xl rounded-2xl">
			<div class="p-6 pb-0"><h6 class="mb-0 dark:text-white">Phân bố theo bãi đỗ</h6></div>
			<div class="p-6"><canvas id="revenueDistributionChart" class="max-h-80"></canvas></div>
		</div>
	</div>
</div>

<div class="flex flex-wrap -mx-3 mb-6">
	<div class="w-full px-3">
		<div class="relative flex flex-col bg-white dark:bg-slate-850 shadow-xl rounded-2xl">
			<div class="p-6 pb-0"><h6 class="mb-0 dark:text-white">Top bãi đỗ xe</h6></div>
			<div class="p-6 overflow-x-auto">
				<table class="w-full text-slate-600">
					<thead><tr><th class="text-left p-2">Bãi đỗ xe</th><th class="text-center p-2">Doanh thu</th><th class="text-center p-2">Booking</th><th class="text-center p-2">TB/Booking</th><th class="text-center p-2">Tỉ trọng</th></tr></thead>
					<tbody id="revenueByLotBody"></tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
	// Populate parking lot filter
	fetch('/user/api/parking-lots', { headers: { 'Accept': 'application/json' }})
		.then(r => r.json())
		.then(json => {
			const sel = document.getElementById('parking_lot_filter');
			if (Array.isArray(json)) {
				json.forEach(l => { const o = document.createElement('option'); o.value = l.id; o.textContent = l.name; sel.appendChild(o); });
			}
		}).catch(() => {});

	const revenueCtx = document.getElementById('revenueChart').getContext('2d');
	const revenueChart = new Chart(revenueCtx, { type: 'line', data: { labels: [], datasets: [{ label: 'Doanh thu (đ)', data: [], borderColor: 'rgb(59,130,246)', backgroundColor: 'rgba(59,130,246,0.1)', borderWidth: 3, fill: true, tension: 0.35 }] }, options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } } } });

	const distributionCtx = document.getElementById('revenueDistributionChart').getContext('2d');
	const distributionChart = new Chart(distributionCtx, { type: 'doughnut', data: { labels: [], datasets: [{ data: [], backgroundColor: ['#3b82f6','#22c55e','#f59e0b','#ef4444','#a855f7'], borderWidth: 0 }] }, options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom' } } } });

	function updateChartDataFromAPI(startDate, endDate, parkingLotId = '') {
		const params = new URLSearchParams({ start_date: startDate, end_date: endDate });
		if (parkingLotId) params.append('parking_lot_id', parkingLotId);
		fetch('/admin/api/reports/revenue?' + params.toString(), { headers: { 'Accept': 'application/json' }})
			.then(r => r.json())
			.then(json => {
				document.getElementById('totalRevenue').innerText = new Intl.NumberFormat('vi-VN').format(Math.round(json.summary.totalRevenue || 0)) + 'đ';
				document.getElementById('avgRevenue').innerText = new Intl.NumberFormat('vi-VN').format(Math.round(json.summary.avgPerDay || 0)) + 'đ';
				document.getElementById('peakRevenue').innerText = new Intl.NumberFormat('vi-VN').format(Math.round((json.summary.peakDay && json.summary.peakDay.total) ? json.summary.peakDay.total : 0)) + 'đ';

				revenueChart.data.labels = json.daily.labels || [];
				revenueChart.data.datasets[0].data = json.daily.totals || [];
				revenueChart.update();

				const labels = (json.byParkingLot || []).map(i => i.name);
				const data = (json.byParkingLot || []).map(i => i.percentage);
				distributionChart.data.labels = labels;
				distributionChart.data.datasets[0].data = data;
				distributionChart.update();

				const tbody = document.getElementById('revenueByLotBody');
				tbody.innerHTML = '';
				(json.byParkingLot || []).forEach(row => {
					const tr = document.createElement('tr');
					tr.innerHTML = `
						<td class="p-2">${row.name}</td>
						<td class="p-2 text-center">${new Intl.NumberFormat('vi-VN').format(Math.round(row.revenue || 0))}đ</td>
						<td class="p-2 text-center">${row.bookings || 0}</td>
						<td class="p-2 text-center">${new Intl.NumberFormat('vi-VN').format(Math.round(row.avg || 0))}đ</td>
						<td class="p-2 text-center">${row.percentage || 0}%</td>`;
					tbody.appendChild(tr);
				});
			});
	}

	document.getElementById('applyFilter').addEventListener('click', function() {
		const startDate = document.getElementById('start_date').value;
		const endDate = document.getElementById('end_date').value;
		const parkingLot = document.getElementById('parking_lot_filter').value;
		updateChartDataFromAPI(startDate, endDate, parkingLot);
	});

	document.getElementById('exportRevenue').addEventListener('click', function() {
		const startDate = document.getElementById('start_date').value;
		const endDate = document.getElementById('end_date').value;
		window.location.href = `{{ route('admin.reports.export', 'revenue') }}?start_date=${startDate}&end_date=${endDate}`;
	});

	// Initial load
	updateChartDataFromAPI(document.getElementById('start_date').value, document.getElementById('end_date').value);
});
</script>
@endpush
