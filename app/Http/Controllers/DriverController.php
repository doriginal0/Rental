<?php

namespace App\Http\Controllers;
use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = Driver::withCount('bookings')->orderBy('created_at')->paginate(10);
        return view('drivers.index', compact('drivers'));
    }
    //
    public function create()
    {
        return view('drivers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'license_number' => 'nullable|string|max:50',
            'license_expiry' => 'nullable|date|after:today',
            'driver_daily_rate' => 'nullable|numeric|min:0',
            'description' => 'nullable|string|max:100',
            'image_url' => 'nullable|url',
            
        ]);
        Driver::create($validated + ['client_id' => auth()->id()]);

        return redirect()->route('drivers.index')->with('success', 'Driver added successfully.');
    }

    public function edit(Driver $driver)
    {
        return view('drivers.edit', compact('driver'));
    }

     public function update(Request $request, Driver $driver)
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:100',
            'license_number' => 'nullable|string|max:50',
            'license_expiry' => 'nullable|date|after:today',
            'driver_daily_rate' => 'sometimes|nullable|numeric|min:0',
            'description' => 'nullable|string|max:100',
            'image_url' => 'nullable|url',
            
        ]);

       
        $driver->update($validated);

        return redirect()->route('drivers.index')->with('success', 'Driver updated successfully.');
    }

    public function destroy(Driver $driver)
    {
        $driver->delete();
        return redirect()->route('drivers.index')->with('success', 'Driver deleted successfully.');
    }

    public function show(Driver $driver)
    {
        $driver->load(['bookings.customer']);
        return view('drivers.show', compact('driver'));
    }
}

