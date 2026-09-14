<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Fleet;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::withCount('bookings')->orderBy('make')->paginate(10);
        return view('cars.index', compact('cars'));
    }

    public function create()
    {   
        $fleets = Fleet::orderBy('fleet_name')->get();
        return view('cars.create', compact('fleets'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'make' => 'required|string|max:100',
            'fleet_id' => 'nullable|exists:fleets,id',
            'model' => 'required|string|max:100',
            'year' => 'required|integer|min:1990|max:' . (date('Y') + 1),
            'license_plate' => 'required|string|max:20|unique:cars',
            'color' => 'nullable|string|max:50',
            'transmission' => 'required|in:automatic,manual',
            'seats' => 'required|integer|min:1|max:20',
            'daily_rate' => 'required|numeric|min:0',
            'status' => 'required|in:available,rented,maintenance,retired',
            'image_url' => 'nullable|url',
            'description' => 'nullable|string',
        ]);

        Car::create($validated + ['client_id' => auth()->id()]);

        return redirect()->route('cars.index')->with('success', 'Car added successfully.');
    }

    public function show(Car $car)
    {
        $car->load(['bookings.customer', 'maintenances']);
        return view('cars.show', compact('car'));
    }

    public function edit(Car $car)
    {
         $fleets = Fleet::orderBy('fleet_name')->get();
        return view('cars.edit', compact('car', 'fleets'));
    }

    public function update(Request $request, Car $car)
    {
        $validated = $request->validate([
            'make' => 'required|string|max:100',
            'model' => 'required|string|max:100',
            'fleet_id' => 'nullable|exists:fleets,id',
            'year' => 'required|integer|min:1990|max:' . (date('Y') + 1),
            'license_plate' => 'required|string|max:20|unique:cars,license_plate,' . $car->id,
            'color' => 'nullable|string|max:50',
            'transmission' => 'required|in:automatic,manual',
            'seats' => 'required|integer|min:1|max:20',
            'daily_rate' => 'required|numeric|min:0',
            'status' => 'required|in:available,rented,maintenance,retired',
            'image_url' => 'nullable|url',
            'description' => 'nullable|string',
        ]);

        $car->update($validated);

        return redirect()->route('cars.index')->with('success', 'Car updated successfully.');
    }

    public function destroy(Car $car)
    {
        $car->delete();
        return redirect()->route('cars.index')->with('success', 'Car deleted successfully.');
    }
}
