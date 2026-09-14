<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Car;
use App\Models\Driver;
use App\Models\Customer;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['car', 'customer', 'driver'])
            ->orderByDesc('created_at')
            ->paginate(10);
        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
        $cars = Car::where('status', 'available')->get();
        $customers = Customer::orderBy('last_name')->get();
        $drivers = Driver::orderBy('name')->get();
        return view('bookings.create', compact('cars', 'customers', 'drivers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'car_id' => 'required|exists:cars,id',
            'customer_id' => 'required|exists:customers,id',
            'pickup_datetime' => 'required|date|after:now',
            'return_datetime' => 'required|date|after:pickup_datetime',
            'notes' => 'nullable|string',
            'method' => 'required|in:cash,card,bank_transfer,online',
            'driver_id' => 'nullable|exists:drivers,id',
            'daily_rate' => 'required|numeric|min:0',
            'total_cost' => 'required|numeric|min:0',
            'driver_daily_rate' => 'nullable|numeric|min:0'
        ]);

        $car = Car::findOrFail($validated['car_id']);

        // Calculate total cost based on duration
        

        $booking = Booking::create([
            ...$validated,
            'client_id' => auth()->id(),
            'status' => 'pending',
        ]);

        // Mark car as rented
        $car->update(['status' => 'rented']);

        return redirect()->route('bookings.index')->with('success', 'Booking created successfully.');
    }

    public function show(Booking $booking)
    {
        $booking->load(['car', 'customer', 'payments', 'driver']);
        return view('bookings.show', compact('booking'));
    }

    public function edit(Booking $booking)
    {
        $cars = Car::all();
        $customers = Customer::orderBy('last_name')->get();
        $drivers = Driver::orderBy('name')->get();
        return view('bookings.edit', compact('booking', 'cars', 'customers', 'drivers'));
    }

    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'car_id' => 'required|exists:cars,id',
            'customer_id' => 'required|exists:customers,id',
            'pickup_datetime' => 'required|date',
            'return_datetime' => 'required|date|after:pickup_datetime',
            'status' => 'required|in:pending,confirmed,active,completed,cancelled',
            'driver_id' => 'nullable|exists:drivers,id',
            'notes' => 'nullable|string',
            'daily_rate' => 'required|numeric|min:0',
            'total_cost' => 'required|numeric|min:0',
            'driver_daily_rate' => 'nullable|numeric|min:0',
            'method' => 'required|in:cash,card,bank_transfer,online'
        ]);

        $car = Car::findOrFail($validated['car_id']);
        
         if (empty($validated['driver_id'])) {
        $validated['driver_id'] = null;
        $validated['driver_daily_rate'] = null;
    }
        $booking->update($validated);

        // Update car status based on booking status
        if (in_array($validated['status'], ['completed', 'cancelled'])) {
            $car->update(['status' => 'available']);
        } elseif ($validated['status'] === 'active') {
            $car->update(['status' => 'rented']);
        }

        return redirect()->route('bookings.index')->with('success', 'Booking updated successfully.');
    }

    public function destroy(Booking $booking)
    {
        $booking->car()->update(['status' => 'available']);
        $booking->delete();
        return redirect()->route('bookings.index')->with('success', 'Booking deleted successfully.');
    }
}
