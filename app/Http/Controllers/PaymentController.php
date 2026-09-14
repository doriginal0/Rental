<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\Maintenance;

class PaymentController extends Controller
{


    public function index()
    {
        $revenueStatuses = ['confirmed', 'active', 'completed'];
        $bookingRevenue_s = Booking::orderBy('pickup_datetime')->whereNotNull('customer_id')->with('customer')->paginate(10);
        $bookingRevenue = Booking::wherein('status', $revenueStatuses)->sum('total_cost');
        $driverPayouts = Booking::wherein('status', $revenueStatuses)
        ->wherenotNull('driver_id')
        ->get()
        ->sum(fn ($booking) => $booking->driver_daily_rate * $booking->duration_in_days);
        $maintenanceSpend = Maintenance::where('status', 'completed')->sum('cost');
        $miscIncome = Payment::whereNull('booking_id')->where('type', 'income')->sum('amount');
        $miscExpense = Payment::whereNull('booking_id')->where('type', 'expense')->sum('amount');
        $miscEntries = Payment::whereNull('booking_id')->orderByDesc('created_at')->get();
        $pendingBookings = Booking::where('status', 'pending')->with(['car', 'customer'])->orderBy('pickup_datetime')->get();
        $totalRevenue  = $bookingRevenue + $miscIncome;
        $totalExpenses = $driverPayouts + $maintenanceSpend + $miscExpense;
        $net           = $totalRevenue - $totalExpenses;
        return view('payments.index', compact(
    'bookingRevenue', 'driverPayouts', 'maintenanceSpend',
    'miscIncome', 'miscExpense', 'pendingBookings', 'miscEntries',
    'totalRevenue', 'totalExpenses', 'net', 'bookingRevenue_s'
));
    }

    public function create()
    {

        return view('payments.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'booking_id' => 'nullable|exists:bookings,id',
            'amount' => 'required|numeric|min:0',
            'method' => 'required|in:cash,card,bank_transfer,online',
            'status' => 'required|in:pending,completed,refunded,failed',
            'reference' => 'nullable|string|max:100',
            'type' => 'required|in:income,expense',
            'description' => 'nullable|string|max:255',
        ]);

        $validated['paid_at'] = $validated['status'] === 'completed' ? now() : null;

        Payment::create($validated + ['client_id' => auth()->id()]);

        return redirect()->route('payments.index')->with('success', 'Record added successfuly');
    }

    public function show(Payment $payment)
    {
        $payment->load('booking.car', 'booking.customer');
        return view('payments.show', compact('payment'));
    }

    public function edit(Payment $payment)
    {
        $bookings = Booking::with('customer')->get();
        return view('payments.edit', compact('payment', 'bookings'));
    }

    public function update(Request $request, Payment $payment)
    {
        $validated = $request->validate([

            'booking_id' => 'nullable|exists:bookings,id',
            'amount' => 'required|numeric|min:0',
            'method' => 'required|in:cash,card,bank_transfer,online',
            'status' => 'required|in:pending,completed,refunded,failed',
            'reference' => 'nullable|string|max:100',
            'type' => 'required|in:income,expense',
            'description' => 'nullable|string|max:400'
        ]);

        $validated['paid_at'] = $validated['status'] === 'completed' ? now() : null;

        $payment->update($validated);

        return redirect()->route('payments.index')->with('success', 'Record updated successfully.');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('payments.index')->with('success', 'Payment deleted successfully.');
    }
}
