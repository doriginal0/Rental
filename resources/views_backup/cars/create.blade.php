@extends('layouts.app')

@section('title', 'Add Car - Car Rental Management')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Add New Car</h1>

    <div class="bg-white rounded-lg shadow p-6 max-w-2xl">
        @if ($errors->any())
                <div class="mb-5 p-4 bg-red-50 border border-red-200 rounded-md">
                    <ul class="list-disc text-sm text-red-600 pl-4 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        <form action="{{ route('cars.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Make</label>
                    <input type="text" name="make" value="{{ old('make') }}" required class="w-full border rounded px-3 py-2 @error('make') border-red-500 @enderror">
                    @error('make') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Model</label>
                    <input type="text" name="model" value="{{ old('model') }}" required class="w-full border rounded px-3 py-2 @error('model') border-red-500 @enderror">
                    @error('model') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Year</label>
                    <input type="number" name="year" value="{{ old('year', date('Y')) }}" required class="w-full border rounded px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">License Plate</label>
                    <input type="text" name="license_plate" value="{{ old('license_plate') }}" required class="w-full border rounded px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Color</label>
                    <input type="text" name="color" value="{{ old('color') }}" class="w-full border rounded px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Transmission</label>
                    <select name="transmission" class="w-full border rounded px-3 py-2">
                        <option value="automatic">Automatic</option>
                        <option value="manual">Manual</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Assigned to Fleet</label>
                    
                    <select name="transmission" class="w-full border rounded px-3 py-2">
                        @forelse($fleets as $fleet)
                        <option value="{{ $fleet->fleet_id }}">{{$fleet->fleet_name}}</option>
                    
                    @empty 
                        <option value="none">No fleet available</option>
                    @endforelse</select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Seats</label>
                    <input type="number" name="seats" value="{{ old('seats', 5) }}" required class="w-full border rounded px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Daily Rate ($)</label>
                    <input type="number" step="0.01" name="daily_rate" value="{{ old('daily_rate') }}" required class="w-full border rounded px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" class="w-full border rounded px-3 py-2">
                        <option value="available">Available</option>
                        <option value="maintenance">Maintenance</option>
                        <option value="retired">Retired</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Image URL</label>
                    <input type="url" name="image_url" value="{{ old('image_url') }}" class="w-full border rounded px-3 py-2">
                </div>
            </div>
            <div class="mt-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description" rows="3" class="w-full border rounded px-3 py-2">{{ old('description') }}</textarea>
            </div>
            <div class="mt-6 flex gap-3">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Save Car</button>
                <a href="{{ route('cars.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded hover:bg-gray-400">Cancel</a>
            </div>
        </form>
    </div>
@endsection
