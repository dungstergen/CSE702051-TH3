<?php

        namespace App\Http\Controllers;

        use App\Models\Booking;
        use App\Models\Payment;
        use Carbon\Carbon;
        use Illuminate\Http\Request;
        use Illuminate\Support\Facades\DB;
        use Symfony\Component\HttpFoundation\StreamedResponse;

        class AdminReportController extends Controller
        {
            // Page views
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

            // -------- APIs --------
            public function apiSummary(Request $request)
            {
                // Overall totals
            $totalRevenue = (float) Payment::where('payments.payment_status', 'completed')->sum('amount');
                $totalBookings = (int) Booking::count();

                // Revenue by month (last 12 months)
                $start = Carbon::now()->startOfMonth()->subMonths(11);
                $end = Carbon::now()->endOfMonth();

                $raw = Payment::query()
                    ->where('payments.payment_status', 'completed')
                    ->whereBetween(DB::raw('COALESCE(paid_at, created_at)'), [$start, $end])
                    ->selectRaw("DATE_FORMAT(COALESCE(paid_at, created_at), '%Y-%m') as ym, SUM(amount) as total")
                    ->groupBy('ym')
                    ->orderBy('ym')
                    ->pluck('total', 'ym')
                    ->toArray();

                $labels = [];
                $totals = [];
                $cursor = $start->copy();
                for ($i = 0; $i < 12; $i++) {
                    $key = $cursor->format('Y-m');
                    $labels[] = $cursor->format('m/Y');
                    $totals[] = isset($raw[$key]) ? (float) $raw[$key] : 0.0;
                    $cursor->addMonth();
                }

                // Bookings by status
                $bookingsByStatus = Booking::query()
                    ->select('status', DB::raw('COUNT(*) as c'))
                    ->groupBy('status')
                    ->pluck('c', 'status')
                    ->toArray();

                // Top parking lots by revenue
                $topLots = Payment::query()
                    ->where('payments.payment_status', 'completed')
                    ->join('bookings', 'bookings.id', '=', 'payments.booking_id')
                    ->join('parking_lots', 'parking_lots.id', '=', 'bookings.parking_lot_id')
                    ->select('parking_lots.id', 'parking_lots.name', DB::raw('SUM(payments.amount) as revenue'))
                    ->groupBy('parking_lots.id', 'parking_lots.name')
                    ->orderByDesc('revenue')
                    ->limit(5)
                    ->get();

                return response()->json([
                    'summary' => [
                        'totalRevenue' => (float) $totalRevenue,
                        'totalBookings' => $totalBookings,
                    ],
                    'revenueByMonth' => [
                        'labels' => $labels,
                        'totals' => $totals,
                    ],
                    'bookingsByStatus' => $bookingsByStatus,
                    'topParkingLots' => $topLots,
                ]);
            }

            public function apiRevenue(Request $request)
            {
                [$start, $end] = $this->parseDateRange($request, 30);
                $parkingLotId = $request->integer('parking_lot_id');

            $payments = Payment::query()->where('payments.payment_status', 'completed')
                    ->join('bookings', 'bookings.id', '=', 'payments.booking_id');

                if ($parkingLotId) {
                    $payments->where('bookings.parking_lot_id', $parkingLotId);
                }

                $payments->whereBetween(DB::raw('DATE(COALESCE(payments.paid_at, payments.created_at))'), [$start->toDateString(), $end->toDateString()]);

                // Daily totals
                $dailyRaw = (clone $payments)
                    ->selectRaw("DATE(COALESCE(payments.paid_at, payments.created_at)) as d, SUM(payments.amount) as total")
                    ->groupBy('d')
                    ->pluck('total', 'd')
                    ->toArray();

                $labels = [];
                $totals = [];
                $cursor = $start->copy();
                while ($cursor->lte($end)) {
                    $key = $cursor->toDateString();
                    $labels[] = $cursor->format('d/m');
                    $totals[] = isset($dailyRaw[$key]) ? (float) $dailyRaw[$key] : 0.0;
                    $cursor->addDay();
                }

                $totalRevenue = array_sum($totals);
                $days = max(1, $start->diffInDays($end) + 1);
                $avgPerDay = $totalRevenue / $days;

                // Peak day
                $peakDay = null;
                if (!empty($dailyRaw)) {
                    $maxDate = array_keys($dailyRaw, max($dailyRaw))[0];
                    $peakDay = [
                        'date' => Carbon::parse($maxDate)->format('d/m/Y'),
                        'total' => (float) $dailyRaw[$maxDate]
                    ];
                }

                // By parking lot
            $byLot = Payment::query()->where('payments.payment_status', 'completed')
                    ->join('bookings', 'bookings.id', '=', 'payments.booking_id')
                    ->join('parking_lots', 'parking_lots.id', '=', 'bookings.parking_lot_id')
                    ->whereBetween(DB::raw('DATE(COALESCE(payments.paid_at, payments.created_at))'), [$start->toDateString(), $end->toDateString()])
                    ->when($parkingLotId, fn($q) => $q->where('bookings.parking_lot_id', $parkingLotId))
                    ->select('parking_lots.id', 'parking_lots.name', DB::raw('SUM(payments.amount) as revenue'), DB::raw('COUNT(bookings.id) as bookings'))
                    ->groupBy('parking_lots.id', 'parking_lots.name')
                    ->orderByDesc('revenue')
                    ->get()
                    ->map(function ($row) use ($totalRevenue) {
                        $avg = $row->bookings > 0 ? ((float) $row->revenue / (int) $row->bookings) : 0.0;
                        $pct = $totalRevenue > 0 ? round(((float) $row->revenue * 100) / $totalRevenue, 1) : 0.0;
                        return [
                            'id' => $row->id,
                            'name' => $row->name,
                            'revenue' => (float) $row->revenue,
                            'bookings' => (int) $row->bookings,
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
                    'daily' => [
                        'labels' => $labels,
                        'totals' => $totals,
                    ],
                    'byParkingLot' => $byLot,
                ]);
            }

            public function apiUsage(Request $request)
            {
                [$start, $end] = $this->parseDateRange($request, 7);
                $parkingLotId = $request->integer('parking_lot_id');

                $bookings = Booking::query()
                    ->when($parkingLotId, fn($q) => $q->where('parking_lot_id', $parkingLotId))
                    ->whereBetween(DB::raw('DATE(COALESCE(start_time, booking_date))'), [$start->toDateString(), $end->toDateString()]);

                // Summary
                $totalBookings = (clone $bookings)->count();
                $avgDuration = (clone $bookings)->avg('duration_hours') ?? 0;

                // Hourly usage
                $hourlyRaw = (clone $bookings)
                    ->selectRaw('HOUR(COALESCE(start_time, created_at)) as h, COUNT(*) as c')
                    ->groupBy('h')
                    ->pluck('c', 'h')
                    ->toArray();
                $hourLabels = [];
                $hourCounts = [];
                for ($h = 0; $h < 24; $h++) {
                    $hourLabels[] = sprintf('%02d:00', $h);
                    $hourCounts[] = isset($hourlyRaw[$h]) ? (int) $hourlyRaw[$h] : 0;
                }

                $peakHourIndex = null;
                if (!empty($hourCounts)) {
                    $maxVal = max($hourCounts);
                    $peakHourIndex = $maxVal > 0 ? array_search($maxVal, $hourCounts) : null;
                }

                // Weekly pattern (by day)
                $weeklyRaw = (clone $bookings)
                    ->selectRaw('DATE(COALESCE(start_time, booking_date)) as d, COUNT(*) as c')
                    ->groupBy('d')
                    ->pluck('c', 'd')
                    ->toArray();

                $weekLabels = [];
                $weekCounts = [];
                $cursor = $start->copy();
                while ($cursor->lte($end)) {
                    $key = $cursor->toDateString();
                    $weekLabels[] = $cursor->format('d/m');
                    $weekCounts[] = isset($weeklyRaw[$key]) ? (int) $weeklyRaw[$key] : 0;
                    $cursor->addDay();
                }

                // Status distribution
                $statusMap = (clone $bookings)
                    ->select('status', DB::raw('COUNT(*) as c'))
                    ->groupBy('status')
                    ->pluck('c', 'status')
                    ->toArray();

                // Usage by parking lot
                $byLot = Booking::query()
                    ->when($parkingLotId, fn($q) => $q->where('parking_lot_id', $parkingLotId))
                    ->whereBetween(DB::raw('DATE(COALESCE(start_time, booking_date))'), [$start->toDateString(), $end->toDateString()])
                    ->join('parking_lots', 'parking_lots.id', '=', 'bookings.parking_lot_id')
                    ->select('parking_lots.id', 'parking_lots.name', DB::raw('COUNT(bookings.id) as bookings'), DB::raw('AVG(duration_hours) as avg_hours'))
                    ->groupBy('parking_lots.id', 'parking_lots.name')
                    ->orderByDesc('bookings')
                    ->get();

                return response()->json([
                    'summary' => [
                        'totalBookings' => (int) $totalBookings,
                        'avgDuration' => round((float) $avgDuration, 1),
                        'peakHour' => $peakHourIndex !== null ? [
                            'index' => $peakHourIndex,
                            'label' => $hourLabels[$peakHourIndex] ?? null,
                            'count' => $hourCounts[$peakHourIndex] ?? 0,
                        ] : null,
                    ],
                    'hourly' => [
                        'labels' => $hourLabels,
                        'counts' => $hourCounts,
                    ],
                    'weekly' => [
                        'labels' => $weekLabels,
                        'bookings' => $weekCounts,
                    ],
                    'status' => $statusMap,
                    'byParkingLot' => $byLot,
                ]);
            }

            public function export(Request $request, string $type)
            {
                [$start, $end] = $this->parseDateRange($request, 30);
                $filename = sprintf('reports_%s_%s_to_%s.csv', $type, $start->toDateString(), $end->toDateString());

                $callback = function () use ($type, $start, $end) {
                    $out = fopen('php://output', 'w');
                    if ($type === 'revenue') {
                        fputcsv($out, ['Date', 'Revenue']);
                        $rows = Payment::where('payments.payment_status', 'completed')
                            ->whereBetween(DB::raw('DATE(COALESCE(paid_at, created_at))'), [$start->toDateString(), $end->toDateString()])
                            ->selectRaw('DATE(COALESCE(paid_at, created_at)) as d, SUM(amount) as total')
                            ->groupBy('d')
                            ->orderBy('d')
                            ->get();
                        foreach ($rows as $row) {
                            fputcsv($out, [$row->d, (float) $row->total]);
                        }
                    } else { // usage
                        fputcsv($out, ['Hour', 'Bookings']);
                        $rows = Booking::whereBetween(DB::raw('DATE(COALESCE(start_time, booking_date))'), [$start->toDateString(), $end->toDateString()])
                            ->selectRaw('HOUR(COALESCE(start_time, created_at)) as h, COUNT(*) as c')
                            ->groupBy('h')
                            ->orderBy('h')
                            ->get();
                        foreach ($rows as $row) {
                            fputcsv($out, [sprintf('%02d:00', (int) $row->h), (int) $row->c]);
                        }
                    }
                    fclose($out);
                };

                return new StreamedResponse($callback, 200, [
                    'Content-Type' => 'text/csv',
                    'Content-Disposition' => 'attachment; filename="' . $filename . '"',
                ]);
            }

            // -------- Helpers --------
            private function parseDateRange(Request $request, int $defaultDays = 30): array
            {
                $startStr = $request->get('start_date');
                $endStr = $request->get('end_date');
                $end = $endStr ? Carbon::parse($endStr)->endOfDay() : Carbon::now()->endOfDay();
                $start = $startStr ? Carbon::parse($startStr)->startOfDay() : $end->copy()->subDays($defaultDays - 1)->startOfDay();
                return [$start, $end];
            }
        }

