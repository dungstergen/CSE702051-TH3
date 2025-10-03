<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\ParkingLot;
use App\Models\User;
use Carbon\Carbon;

class AdminReportController extends Controller
{
    /**
     * Display reports dashboard
     */
    public function index()
    {
        // Get current month stats
        $currentMonth = Carbon::now()->format('Y-m');
        $lastMonth = Carbon::now()->subMonth()->format('Y-m');

        // Revenue stats
        $currentMonthRevenue = Payment::where('payment_status', 'completed')
                                     ->whereYear('created_at', Carbon::now()->year)
                                     ->whereMonth('created_at', Carbon::now()->month)
                                     ->sum('amount');

        $lastMonthRevenue = Payment::where('payment_status', 'completed')
                                  ->whereYear('created_at', Carbon::now()->subMonth()->year)
                                  ->whereMonth('created_at', Carbon::now()->subMonth()->month)
                                  ->sum('amount');

        // Booking stats
        $currentMonthBookings = Booking::whereYear('created_at', Carbon::now()->year)
                                      ->whereMonth('created_at', Carbon::now()->month)
                                      ->count();

        $lastMonthBookings = Booking::whereYear('created_at', Carbon::now()->subMonth()->year)
                                   ->whereMonth('created_at', Carbon::now()->subMonth()->month)
                                   ->count();

        // Top performing parking lots
        $topParkingLots = Booking::with('parkingLot')
                                ->whereYear('created_at', Carbon::now()->year)
                                ->whereMonth('created_at', Carbon::now()->month)
                                ->selectRaw('parking_lot_id, COUNT(*) as booking_count, SUM(total_amount) as total_revenue')
                                ->groupBy('parking_lot_id')
                                ->orderBy('total_revenue', 'desc')
                                ->limit(5)
                                ->get();

        // Revenue growth percentage
        $revenueGrowth = $lastMonthRevenue > 0 ?
            (($currentMonthRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100 : 0;

        // Booking growth percentage
        $bookingGrowth = $lastMonthBookings > 0 ?
            (($currentMonthBookings - $lastMonthBookings) / $lastMonthBookings) * 100 : 0;

        return view('admin.reports.index', compact(
            'currentMonthRevenue',
            'lastMonthRevenue',
            'currentMonthBookings',
            'lastMonthBookings',
            'topParkingLots',
            'revenueGrowth',
            'bookingGrowth'
        ));
    }

    /**
     * Revenue report
     */
    public function revenue(Request $request)
    {
        $startDate = $request->get('start_date', Carbon::now()->subMonth()->format('Y-m-d'));
        $endDate = $request->get('end_date', Carbon::now()->format('Y-m-d'));

        // Total revenue
        $totalRevenue = Payment::where('payment_status', 'completed')
                              ->whereBetween('created_at', [$startDate, $endDate])
                              ->sum('amount');

        // Revenue by day
        $dailyRevenue = Payment::where('payment_status', 'completed')
                              ->whereBetween('created_at', [$startDate, $endDate])
                              ->selectRaw('DATE(created_at) as date, SUM(amount) as total')
                              ->groupBy('date')
                              ->orderBy('date')
                              ->get();

        // Revenue by parking lot
        $revenueByParkingLot = Payment::with('booking.parkingLot')
                                     ->where('payment_status', 'completed')
                                     ->whereBetween('created_at', [$startDate, $endDate])
                                     ->get()
                                     ->groupBy('booking.parkingLot.name')
                                     ->map(function ($payments) {
                                         return $payments->sum('amount');
                                     });

        // Revenue by payment method
        $revenueByMethod = Payment::where('payment_status', 'completed')
                                 ->whereBetween('created_at', [$startDate, $endDate])
                                 ->selectRaw('payment_method, SUM(amount) as total')
                                 ->groupBy('payment_method')
                                 ->get();

        return view('admin.reports.revenue', compact(
            'totalRevenue',
            'dailyRevenue',
            'revenueByParkingLot',
            'revenueByMethod',
            'startDate',
            'endDate'
        ));
    }

    /**
     * Usage report
     */
    public function usage(Request $request)
    {
        $startDate = $request->get('start_date', Carbon::now()->subMonth()->format('Y-m-d'));
        $endDate = $request->get('end_date', Carbon::now()->format('Y-m-d'));

        // Total bookings
        $totalBookings = Booking::whereBetween('created_at', [$startDate, $endDate])->count();

        // Bookings by status
        $bookingsByStatus = Booking::whereBetween('created_at', [$startDate, $endDate])
                                  ->selectRaw('status, COUNT(*) as count')
                                  ->groupBy('status')
                                  ->get();

        // Most popular parking lots
        $popularParkingLots = Booking::with('parkingLot')
                                    ->whereBetween('created_at', [$startDate, $endDate])
                                    ->selectRaw('parking_lot_id, COUNT(*) as booking_count')
                                    ->groupBy('parking_lot_id')
                                    ->orderBy('booking_count', 'desc')
                                    ->limit(10)
                                    ->get();

        // Peak hours
        $peakHours = Booking::whereBetween('created_at', [$startDate, $endDate])
                           ->selectRaw('HOUR(start_time) as hour, COUNT(*) as count')
                           ->groupBy('hour')
                           ->orderBy('count', 'desc')
                           ->get();

        // New users
        $newUsers = User::whereBetween('created_at', [$startDate, $endDate])->count();

        // Average booking duration
        $avgDuration = Booking::whereBetween('created_at', [$startDate, $endDate])
                             ->avg('duration_hours');

        return view('admin.reports.usage', compact(
            'totalBookings',
            'bookingsByStatus',
            'popularParkingLots',
            'peakHours',
            'newUsers',
            'avgDuration',
            'startDate',
            'endDate'
        ));
    }

    /**
     * Export reports
     */
    public function export(Request $request, $type)
    {
        $startDate = $request->get('start_date', Carbon::now()->subMonth()->format('Y-m-d'));
        $endDate = $request->get('end_date', Carbon::now()->format('Y-m-d'));

        switch ($type) {
            case 'revenue':
                return $this->exportRevenue($startDate, $endDate);
            case 'usage':
                return $this->exportUsage($startDate, $endDate);
            case 'bookings':
                return $this->exportBookings($startDate, $endDate);
            default:
                return redirect()->back()->with('error', 'Loại báo cáo không hợp lệ!');
        }
    }

    private function exportRevenue($startDate, $endDate)
    {
        $payments = Payment::with(['booking.user', 'booking.parkingLot'])
                          ->where('payment_status', 'completed')
                          ->whereBetween('created_at', [$startDate, $endDate])
                          ->get();

        $filename = "revenue_report_{$startDate}_{$endDate}.csv";

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function() use ($payments) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Date', 'User', 'Parking Lot', 'Amount', 'Payment Method']);

            foreach ($payments as $payment) {
                fputcsv($file, [
                    $payment->created_at->format('Y-m-d'),
                    $payment->booking->user->name,
                    $payment->booking->parkingLot->name,
                    $payment->amount,
                    $payment->payment_method
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function exportUsage($startDate, $endDate)
    {
        $bookings = Booking::with(['user', 'parkingLot'])
                          ->whereBetween('created_at', [$startDate, $endDate])
                          ->get();

        $filename = "usage_report_{$startDate}_{$endDate}.csv";

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function() use ($bookings) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Date', 'User', 'Parking Lot', 'Status', 'Duration', 'Amount']);

            foreach ($bookings as $booking) {
                fputcsv($file, [
                    $booking->booking_date,
                    $booking->user->name,
                    $booking->parkingLot->name,
                    $booking->status,
                    $booking->duration_hours . ' hours',
                    $booking->total_amount
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function exportBookings($startDate, $endDate)
    {
        $bookings = Booking::with(['user', 'parkingLot', 'payment'])
                          ->whereBetween('created_at', [$startDate, $endDate])
                          ->get();

        $filename = "bookings_report_{$startDate}_{$endDate}.csv";

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function() use ($bookings) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'Date', 'User', 'Email', 'Parking Lot', 'Status', 'Duration', 'Amount', 'Payment Status']);

            foreach ($bookings as $booking) {
                fputcsv($file, [
                    $booking->id,
                    $booking->booking_date,
                    $booking->user->name,
                    $booking->user->email,
                    $booking->parkingLot->name,
                    $booking->status,
                    $booking->duration_hours . ' hours',
                    $booking->total_amount,
                    $booking->payment ? $booking->payment->payment_status : 'No payment'
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
