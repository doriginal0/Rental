@extends('layouts.app')

@section('title', 'Cars - Car Rental Management')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Drivers</h1>
        <a href="{{ route('drivers.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">+ Add Driver</a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">License Number</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">License Expiry</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Daily Rate</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Bookings</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($drivers as $driver)
                    <tr>
                        <td class="px-6 py-4">
                            <div class="font-semibold">{{ $driver->name}}</div>
                        </td>
                        <td class="px-6 py-4">{{ $driver->license_number }}</td>
                        <td class="px-6 py-4">{{ $driver->license_expiry?->format('d M Y') ?? 'N/A' }}</td>
                        <td class="px-6 py-4">{{ $driver->driver_daily_rate ?? 'N/A' }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs rounded-full 
                                @if($driver->status == 'available') bg-green-100 text-green-700
                                @elseif($driver->status == 'hired') bg-orange-100 text-orange-700
                                @else bg-gray-100 text-gray-700 @endif">
                                {{ ucfirst($driver->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">{{ $driver->bookings_count }}</td>
                        <td class="px-6 py-4 space-x-2">
                            <a href="{{ route('drivers.show', $driver) }}" class="text-blue-600 hover:underline">View</a>
                            <a href="{{ route('drivers.edit', $driver) }}" class="text-yellow-700 hover:underline">Edit</a>
                            <form action="{{ route('drivers.destroy', $driver) }}" method="POST" class="inline" onsubmit="return confirm('Delete this driver?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">No drivers found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $drivers->links() }}
    </div>
@endsection
