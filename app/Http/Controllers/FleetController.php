<?php

namespace App\Http\Controllers;

use App\Models\Fleet;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FleetController extends Controller
{
    public function index()
    {
        $fleets = Fleet::orderBy('fleet_name')->withCount('cars')->paginate(10);
        return view('fleets.index', compact('fleets'));
    }

    public function create()
    {
        return view('fleets.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'fleet_name' => ['required|string|max:50', Rule::unique('fleets', 'fleet_name')->where(fn ($query) =>$query->where('client_id', auth()->id())
        ),],
            'category' => 'nullable|string|max:100',
            'description' => 'nullable|string|max:200',
        ]);

        Fleet::create($validated + ['client_id' => auth()->id()]);

        return redirect()->route('fleets.index')->with('success', 'New fleet added successfully.');
    }

    public function show(Fleet $fleet)
    {
        $fleet->load('cars');
        return view('fleets.show', compact('fleet'));
    }

    public function edit(Fleet $fleet)
    {
        return view('fleets.edit', compact('fleet'));
    }

    public function update(Request $request, Fleet $fleet)
    {
        $validated = $request->validate([
            'fleet_name' => ['required|string|max:50', Rule::unique('fleets', 'fleet_name')->where(fn ($query) =>$query->where('client_id', auth()->id())
        )->ignore($fleet),],
            'category' => 'nullable|string|max:100',
            'description' => 'nullable|string|max:50',
        ]);

        $fleet->update($validated);

        return redirect()->route('fleets.index')->with('success', 'Fleet updated successfully.');
    }

    public function destroy(Fleet $fleet)
    {
        $fleet->delete();
        return redirect()->route('fleets.index')->with('success', 'Fleet deleted successfully.');
    }
}
