<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Models\Car;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    public function index()
    {
        $maintenances = Maintenance::with('car')
            ->orderByDesc('scheduled_date')
            ->paginate(10);
        return view('maintenances.index', compact('maintenances'));
    }

    public function create()
    {
        $cars = Car::all();
        return view('maintenances.create', compact('cars'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'car_id' => 'required|exists:cars,id',
            'scheduled_date' => 'required|date',
            'type' => 'required|in:oil_change,tire_replacement,brake_service,general,other',
            'description' => 'nullable|string',
            'cost' => 'required|numeric|min:0',
            'status' => 'required|in:scheduled,in_progress,completed',
        ]);

        $maintenance = Maintenance::create($validated + ['client_id' => auth()->id()]);

        // Mark car as under maintenance
        if ($maintenance->status !== 'completed') {
            $maintenance->car()->update(['status' => 'maintenance']);
        }

        return redirect()->route('maintenances.index')->with('success', 'Maintenance record created successfully.');
    }

    public function show(Maintenance $maintenance)
    {
        $maintenance->load('car');
        return view('maintenances.show', compact('maintenance'));
    }

    public function edit(Maintenance $maintenance)
    {
        $cars = Car::all();
        return view('maintenances.edit', compact('maintenance', 'cars'));
    }

    public function update(Request $request, Maintenance $maintenance)
    {
        $validated = $request->validate([
            'car_id' => 'required|exists:cars,id',
            'scheduled_date' => 'required|date',
            'type' => 'required|in:oil_change,tire_replacement,brake_service,general,other',
            'description' => 'nullable|string',
            'cost' => 'required|numeric|min:0',
            'status' => 'required|in:scheduled,in_progress,completed',
        ]);

        $maintenance->update($validated);

        // Update car status
        if ($validated['status'] === 'completed') {
            $maintenance->car()->update(['status' => 'available']);
            $maintenance->completed_date = now();
            $maintenance->save();
        } else {
            $maintenance->car()->update(['status' => 'maintenance']);
        }

        return redirect()->route('maintenances.index')->with('success', 'Maintenance record updated successfully.');
    }

    public function destroy(Maintenance $maintenance)
    {
        $maintenance->delete();
        return redirect()->route('maintenances.index')->with('success', 'Maintenance record deleted successfully.');
    }
}
