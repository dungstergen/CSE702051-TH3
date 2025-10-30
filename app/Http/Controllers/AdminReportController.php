<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use App\Models\ParkingLot;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminReportController extends Controller
{
	// Views
	public function index()
	{
		return view('admin.reports.index');
	}

	public function revenue()
	{
		return view('admin.reports.revenue');
	}

	public function usage()
	{
		return view('admin.reports.usage');
	}

	// Export CSV
	public function export(string $type, Request $request)
	{
		$start = $this->parseDate($request->input('start_date', now()->subDays(30)->toDateString()))->startOfDay();
		$end = $this->parseDate($request->input('end_date', now()->toDateString()))->endOfDay();

		if ($type === 'revenue') {
			$daily = $this->queryDailyRevenue($start, $end, (int) $request->input('parking_lot_id'));
			$rows = [["Date", "Revenue"]];
			foreach ($daily['labels'] as $i => $label) {
				$rows[] = [$label, $daily['totals'][$i] ?? 0];
			}
			return $this->streamCsv('revenue.csv', $rows);
		}

		if ($type === 'usage') {
			$weekly = $this->queryWeeklyBookings($start, $end);
			$rows = [["Label", "Bookings"]];
			foreach ($weekly['labels'] as $i => $label) {
				$rows[] = [$label, $weekly['bookings'][$i] ?? 0];
			}
			return $this->streamCsv('usage.csv', $rows);
		}

		abort(404);
	}

	// APIs
	public function apiSummary(Request $request)
	{
		$start = $this->parseDate($request->input('start_date', now()->subDays(30)->toDateString()))->startOfDay();
		$end = $this->parseDate($request->input('end_date', now()->toDateString()))->endOfDay();

		// Totals
		$totalRevenue = (float) Payment::completed()->whereBetween('created_at', [$start, $end])->sum('amount');
		$totalBookings = (int) Booking::whereBetween('created_at', [$start, $end])->count();

		// Revenue by month (last 6 months)
		$months = collect(range(5, 0))->map(fn($i) => now()->copy()->subMonths($i)->startOfMonth());
		$revByMonth = $months->map(function ($m) use ($start, $end) {
			$ms = $m->copy()->startOfMonth();
			$me = $m->copy()->endOfMonth();
			$sum = (float) Payment::completed()
				->whereBetween('created_at', [max($ms, $start), min($me, $end)])
				->sum('amount');
			return [
				'label' => $m->format('m/Y'),
				'value' => $sum,
			];
		})->values();

		// Bookings by status
		$statusCounts = Booking::whereBetween('created_at', [$start, $end])
			->select('status', DB::raw('COUNT(*) as c'))
			->groupBy('status')
			->pluck('c', 'status');

		// Top parking lots by revenue
		$topLots = Payment::completed()
			->whereBetween('payments.created_at', [$start, $end])
			->join('bookings', 'bookings.id', '=', 'payments.booking_id')
			->join('parking_lots', 'parking_lots.id', '=', 'bookings.parking_lot_id')
			->groupBy('parking_lots.id', 'parking_lots.name')
			->select('parking_lots.name', DB::raw('SUM(payments.amount) as revenue'), DB::raw('COUNT(*) as bookings'))
			->orderByDesc('revenue')
			->limit(5)
			->get()
			->map(function ($row) use ($totalRevenue) {
				$avg = $row->bookings ? ((float)$row->revenue / (int)$row->bookings) : 0;
				$pct = $totalRevenue > 0 ? round(((float)$row->revenue * 100) / $totalRevenue, 1) : 0;
				return [
					'name' => $row->name,
					'revenue' => (float)$row->revenue,
					'bookings' => (int)$row->bookings,
					'avg' => $avg,
					'percentage' => $pct,
				];
			});

		return response()->json([
			'summary' => [
				'totalRevenue' => $totalRevenue,
				'totalBookings' => $totalBookings,
			],
			'revenueByMonth' => [
				'labels' => $revByMonth->pluck('label'),
				'totals' => $revByMonth->pluck('value'),
			],
			'bookingsByStatus' => $statusCounts,
			'topParkingLots' => $topLots,
		]);
	}

	public function apiRevenue(Request $request)
	{
		$start = $this->parseDate($request->input('start_date', now()->subDays(30)->toDateString()))->startOfDay();
		$end = $this->parseDate($request->input('end_date', now()->toDateString()))->endOfDay();
		$lotId = (int) $request->input('parking_lot_id');

		$daily = $this->queryDailyRevenue($start, $end, $lotId);

		$totalRevenue = array_sum($daily['totals']);
		$days = max(1, count($daily['labels']));
		$avgPerDay = $totalRevenue / $days;
		$peakIdx = $this->arrayArgMax($daily['totals']);
		$peakDay = $peakIdx >= 0 ? ['label' => $daily['labels'][$peakIdx], 'total' => $daily['totals'][$peakIdx]] : null;

		// Distribution by parking lot
		$byLot = Payment::completed()
			->whereBetween('payments.created_at', [$start, $end])
			->when($lotId, fn($q) => $q->join('bookings', 'bookings.id', '=', 'payments.booking_id')->where('bookings.parking_lot_id', $lotId),
				fn($q) => $q->join('bookings', 'bookings.id', '=', 'payments.booking_id'))
			->join('parking_lots', 'parking_lots.id', '=', 'bookings.parking_lot_id')
			->groupBy('parking_lots.id', 'parking_lots.name')
			->select('parking_lots.name', DB::raw('SUM(payments.amount) as revenue'), DB::raw('COUNT(*) as bookings'))
			->orderByDesc('revenue')
			->get();

		$byParkingLot = $byLot->map(function ($row) use ($totalRevenue) {
			$avg = $row->bookings ? ((float)$row->revenue / (int)$row->bookings) : 0;
			$pct = $totalRevenue > 0 ? round(((float)$row->revenue * 100) / $totalRevenue, 1) : 0;
			return [
				'name' => $row->name,
				'revenue' => (float)$row->revenue,
				'bookings' => (int)$row->bookings,
				'avg' => $avg,
				'percentage' => $pct,
			];
		});

		return response()->json([
			'summary' => [
				'totalRevenue' => $totalRevenue,
				'avgPerDay' => $avgPerDay,
				'peakDay' => $peakDay,
			],
			'daily' => $daily,
			'byParkingLot' => $byParkingLot,
		]);
	}

	public function apiUsage(Request $request)
	{
		$start = $this->parseDate($request->input('start_date', now()->toDateString()))->startOfDay();
		$end = $this->parseDate($request->input('end_date', now()->toDateString()))->endOfDay();
		$period = $request->input('period', 'today'); // today|week|month
		$lotId = (int) $request->input('parking_lot_id');

		$hourly = $this->queryHourlyBookings($start, $end, $lotId, $period);
		$weekly = $this->queryWeeklyBookings($start, $end, $lotId);

		$totalBookings = Booking::when($lotId, fn($q) => $q->where('parking_lot_id', $lotId))
			->whereBetween('created_at', [$start, $end])
			->count();

		$avgDuration = (float) Booking::when($lotId, fn($q) => $q->where('parking_lot_id', $lotId))
			->whereBetween('created_at', [$start, $end])
			->avg('duration_hours');

		// Status counts
		$status = Booking::when($lotId, fn($q) => $q->where('parking_lot_id', $lotId))
			->whereBetween('created_at', [$start, $end])
			->select('status', DB::raw('COUNT(*) as c'))
			->groupBy('status')
			->pluck('c', 'status');

		// By parking lot
		$byLot = Booking::when($lotId, fn($q) => $q->where('parking_lot_id', $lotId))
			->whereBetween('created_at', [$start, $end])
			->join('parking_lots', 'parking_lots.id', '=', 'bookings.parking_lot_id')
			->groupBy('parking_lots.id', 'parking_lots.name')
			->select('parking_lots.name', DB::raw('COUNT(*) as bookings'), DB::raw('AVG(duration_hours) as avg_hours'))
			->orderByDesc('bookings')
			->get()
			->map(fn($r) => [
				'name' => $r->name,
				'bookings' => (int)$r->bookings,
				'avg_hours' => round((float)$r->avg_hours, 1),
			]);

		// Peak hour
		$peakIdx = $this->arrayArgMax($hourly['counts']);
		$peakHour = $peakIdx >= 0 ? [
			'index' => $peakIdx,
			'label' => $hourly['labels'][$peakIdx],
		] : null;

		return response()->json([
			'summary' => [
				'totalBookings' => (int)$totalBookings,
				'avgDuration' => round($avgDuration ?: 0, 1),
				'peakHour' => $peakHour,
			],
			'hourly' => $hourly,
			'weekly' => $weekly,
			'status' => $status,
			'byParkingLot' => $byLot,
		]);
	}

	// Helpers
	private function parseDate($date)
	{
		try { return Carbon::parse($date); } catch (\Exception $e) { return now(); }
	}

	private function arrayArgMax(array $arr): int
	{
		if (empty($arr)) return -1;
		$max = max($arr);
		foreach ($arr as $i => $v) if ($v === $max) return $i;
		return -1;
	}

	private function queryDailyRevenue(Carbon $start, Carbon $end, int $parkingLotId = 0): array
	{
		$period = CarbonPeriod::create($start, $end);
		$labels = [];
		$totals = [];
		foreach ($period as $date) {
			$labels[] = $date->format('d/m');
			$sum = (float) Payment::completed()
				->whereDate('payments.created_at', $date->toDateString())
				->when($parkingLotId, function ($q) use ($parkingLotId) {
					$q->join('bookings', 'bookings.id', '=', 'payments.booking_id')
					  ->where('bookings.parking_lot_id', $parkingLotId);
				})
				->sum('amount');
			$totals[] = round($sum, 2);
		}
		return ['labels' => $labels, 'totals' => $totals];
	}

	private function queryHourlyBookings(Carbon $start, Carbon $end, int $parkingLotId = 0, string $period = 'today'): array
	{
		// Build hour buckets 0-23
		$labels = [];
		$counts = array_fill(0, 24, 0);
		for ($h = 0; $h < 24; $h++) { $labels[] = sprintf('%02d:00 - %02d:00', $h, ($h+1)%24); }

		$query = Booking::when($parkingLotId, fn($q) => $q->where('parking_lot_id', $parkingLotId))
			->whereBetween('start_time', [$start, $end]);

		$rows = $query
			->select(DB::raw('DATEPART(HOUR, start_time) as h'), DB::raw('COUNT(*) as c'))
			->groupBy(DB::raw('DATEPART(HOUR, start_time)'))
			->get();

		foreach ($rows as $r) {
			$idx = (int) $r->h;
			if ($idx >= 0 && $idx < 24) $counts[$idx] = (int)$r->c;
		}

		return ['labels' => $labels, 'counts' => $counts];
	}

	private function queryWeeklyBookings(Carbon $start, Carbon $end, int $parkingLotId = 0): array
	{
		// Labels Mon..Sun (Vi: Thứ 2..Chủ nhật)
		$labels = ['Thứ 2','Thứ 3','Thứ 4','Thứ 5','Thứ 6','Thứ 7','Chủ nhật'];
		$bookings = array_fill(0, 7, 0);

		$rows = Booking::when($parkingLotId, fn($q) => $q->where('parking_lot_id', $parkingLotId))
			->whereBetween('created_at', [$start, $end])
			->select(DB::raw("(DATEPART(WEEKDAY, created_at) + 5) % 7 as d"), DB::raw('COUNT(*) as c'))
			->groupBy(DB::raw("(DATEPART(WEEKDAY, created_at) + 5) % 7"))
			->get();

		foreach ($rows as $r) {
			$idx = (int) $r->d; // 0..6
			if ($idx >= 0 && $idx < 7) $bookings[$idx] = (int)$r->c;
		}
		return ['labels' => $labels, 'bookings' => $bookings];
	}

	private function streamCsv(string $filename, array $rows)
	{
		$headers = [
			'Content-Type' => 'text/csv',
			'Content-Disposition' => "attachment; filename=\"{$filename}\"",
		];
		$callback = function () use ($rows) {
			$out = fopen('php://output', 'w');
			foreach ($rows as $row) { fputcsv($out, $row); }
			fclose($out);
		};
		return response()->stream($callback, 200, $headers);
	}
}

