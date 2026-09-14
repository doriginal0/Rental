@extends('layouts.app')

@section('title', 'Edit Car - Car Rental Management')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Edit Car</h1>

    <div class="bg-white rounded-lg shadow p-6 max-w-2xl">
        <form action="{{ route('cars.update', $car) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Make</label>
                    <input type="text" name="make" value="{{ old('make', $car->make) }}" required class="w-full border rounded px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Model</label>
                    <input type="text" name="model" value="{{ old('model', $car->model) }}" required class="w-full border rounded px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Year</label>
                    <input type="number" name="year" value="{{ old('year', $car->year) }}" required class="w-full border rounded px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">License Plate</label>
                    <input type="text" name="license_plate" value="{{ old('license_plate', $car->license_plate) }}" required class="w-full border rounded px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Color</label>
                    <input type="text" name="color" value="{{ old('color', $car->color) }}" class="w-full border rounded px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Transmission</label>
                    <select name="transmission" class="w-full border rounded px-3 py-2">
                        <option value="automatic" {{ $car->transmission == 'automatic' ? 'selected' : '' }}>Automatic</option>
                        <option value="manual" {{ $car->transmission == 'manual' ? 'selected' : '' }}>Manual</option>
                    </select>
                </div>
                <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Assigned to Fleet</label>   
                    <select name="fleet_id" class="w-full border rounded px-3 py-2">
                         <option value="">No fleet selected</option>
                        @forelse($fleets as $fleet)
                         
                        <option value="{{ $fleet->id }}" @selected((string) old('fleet_id', $car->fleet_id) === (string) $fleet->id)>{{$fleet->fleet_name}}</option>
                    
                    @empty 
                        <option value="none">No fleet available</option>
                    @endforelse</select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Seats</label>
                    <input type="number" name="seats" value="{{ old('seats', $car->seats) }}" required class="w-full border rounded px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Daily Rate ($)</label>
                    <input type="number" step="0.01" name="daily_rate" value="{{ old('daily_rate', $car->daily_rate) }}" required class="w-full border rounded px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" class="w-full border rounded px-3 py-2">
                        @foreach(['available', 'rented', 'maintenance', 'retired'] as $status)
                            <option value="{{ $status }}" {{ $car->status == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Image URL</label>
                    <input type="url" name="image_url" value="{{ old('image_url', $car->image_url) }}" class="w-full border rounded px-3 py-2">
                </div>
            </div>
            <div class="mt-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description" rows="3" class="w-full border rounded px-3 py-2">{{ old('description', $car->description) }}</textarea>
            </div>
            <div class="mt-6 flex gap-3">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Update Car</button>
                <a href="{{ route('cars.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded hover:bg-gray-400">Cancel</a>
            </div>
        </form>
    </div>
@endsection
