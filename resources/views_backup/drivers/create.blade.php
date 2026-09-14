@extends('layouts.app')

@section('title', 'Add Driver - Car Rental Management')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Add New Driver</h1>

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
        <form action="{{ route('drivers.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" required class="w-full border rounded px-3 py-2 @error('name') border-red-500 @enderror">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">License Number</label>
                    <input type="text" name="license_number" value="{{ old('license_number') }}" class="w-full border rounded px-3 py-2 @error('license_number') border-red-500 @enderror">
                    @error('license_number') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">License Expiry</label>
                    <input type="date" name="license_expiry" value="{{ old('license_expiry', $driver->license_expiry ?? '') }}" class="w-full border rounded px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" class="w-full border rounded px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Daily Rate ($)</label>
                    <input type="number" step="0.01" name="driver_daily_rate" value="{{ old('driver_daily_rate') }}" class="w-full border rounded px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea type="text" name="description" rows="3" class="w-full border rounded px-3 py-2"></textarea>
                        
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
            <div class="mt-6 flex gap-3">
                <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">Save Driver</button>
                <a href="{{ route('drivers.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded hover:bg-gray-400">Cancel</a>
            </div>
        </form>
    </div>
@endsection
