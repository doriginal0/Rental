@extends('layouts.app')

@section('title', 'Cars - Car Rental Management')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Cars</h1>
        <a href="{{ route('cars.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Add Car</a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Car</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">License Plate</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Daily Rate</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Bookings</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($cars as $car)
                    <tr>
                        <td class="px-6 py-4">
                            <div class="font-semibold">{{ $car->full_name }}</div>
                            <div class="text-sm text-gray-500">{{ $car->color }} • {{ $car->transmission }} • {{ $car->seats }} seats</div>
                        </td>
                        <td class="px-6 py-4">{{ $car->license_plate }}</td>
                        <td class="px-6 py-4">${{ number_format($car->daily_rate, 2) }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs rounded-full 
                                @if($car->status == 'available') bg-green-100 text-green-700
                                @elseif($car->status == 'rented') bg-orange-100 text-orange-700
                                @elseif($car->status == 'maintenance') bg-yellow-100 text-yellow-700
                                @else bg-gray-100 text-gray-700 @endif">
                                {{ ucfirst($car->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">{{ $car->bookings_count }}</td>
                        <td class="px-6 py-4 space-x-2">
                            <a href="{{ route('cars.show', $car) }}" class="text-blue-600 hover:underline">View</a>
                            <a href="{{ route('cars.edit', $car) }}" class="text-yellow-700 hover:underline">Edit</a>
                            <form action="{{ route('cars.destroy', $car) }}" method="POST" class="inline" onsubmit="return confirm('Delete this car?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">No cars found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $cars->links() }}
    </div>
@endsection
