<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Fleet;
use App\Models\Maintenance;
use App\Models\Car;
use App\Models\Customer;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
 use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
       
        $fleets = Fleet::orderBy('fleet_name')->withCount('cars')->paginate(10);
        

        $month      = request('month') ? Carbon::parse(request('month') . '-01') : now()->startOfMonth();
        $monthStart = $month->copy()->startOfMonth();
        $monthEnd   = $month->copy()->endOfMonth();

        $calendarBookings = Booking::whereIn('status', ['pending', 'confirmed', 'active'])
            ->where('return_datetime', '>=', $monthStart)
            ->where('pickup_datetime', '<=', $monthEnd)
            ->with('car')
            ->get();

        $palette   = ['#3b82f6','#10b981','#f59e0b','#ef4444','#8b5cf6','#06b6d4','#ec4899','#84cc16','#f97316','#6366f1'];
        $carColors = [];   // car_id => hex
        $legend    = [];   // car_id => ['name'=>..., 'color'=>...]

        foreach ($calendarBookings as $b) {
            $carColors[$b->car_id] ??= $palette[count($carColors) % count($palette)];
            $legend[$b->car_id]    ??= [
                'name'  => $b->car?->full_name ?? 'Car #' . $b->car_id,
                'color' => $carColors[$b->car_id],
            ];
        }

        // one array per day of the month
        $days = [];
        for ($d = $monthStart->copy(); $d->lte($monthEnd); $d->addDay()) {
            $days[$d->toDateString()] = [];
        }

        foreach ($calendarBookings as $b) {
            $start = $b->pickup_datetime->copy()->max($monthStart);
            $end   = $b->return_datetime->copy()->min($monthEnd);
            for ($d = $start->copy(); $d->lte($end); $d->addDay()) {
                $key = $d->toDateString();
                if (isset($days[$key])) {
                    $days[$key][] = [
                        'car'   => $b->car?->full_name ?? 'Car #' . $b->car_id,
                        'color' => $carColors[$b->car_id],
                    ];
                }
            }
        }

        $prevMonth = $month->copy()->subMonth()->format('Y-m');
        $nextMonth = $month->copy()->addMonth()->format('Y-m');

        $stats = [
            'total_cars' => Car::count(),
            'available_cars' => Car::where('status', 'available')->count(),
            'total_customers' => Customer::count(),
            'active_bookings' => Booking::where('status', 'active')->count(),
            'pending_bookings' => Booking::where('status', 'pending')->count(),
            'total_revenue' => Payment::where('status', 'completed')->sum('amount'),
        ];

        $recentBookings = Booking::with(['car', 'customer'])
            ->orderByDesc('created_at')
            ->limit(8)
            ->get();

        $recentMains = Maintenance::with('car')
            ->orderByDesc('scheduled_date')
            ->limit(8)
            ->get();

        $revenueByMonth = Payment::where('status', 'completed')
            ->where('paid_at', '>=', now()->subMonths(6))
            ->get()
            ->groupBy(fn($p) => $p->paid_at->format('Y-m'))
            ->map(fn($group) => $group->sum('amount'))
            ->sortKeys();

        $carStatusDistribution = Car::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get();

        return view('dashboard', compact('stats', 'recentBookings', 'revenueByMonth', 'carStatusDistribution', 'month', 'days', 'legend', 'prevMonth', 'nextMonth', 'recentMains', 'fleets'));
    }
}
