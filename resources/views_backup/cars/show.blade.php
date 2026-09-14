@extends('layouts.app')

@section('title', 'Car Details - Car Rental Management')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">{{ $car->full_name }}</h1>
        <div class="space-x-2">
            <a href="{{ route('cars.edit', $car) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Edit</a>
            <a href="{{ route('cars.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Back</a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold mb-4">Car Information</h2>
            <dl class="grid grid-cols-2 gap-4">
                <div>
                    <dt class="text-sm text-gray-500">Make</dt>
                    <dd class="font-semibold">{{ $car->make }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-gray-500">Model</dt>
                    <dd class="font-semibold">{{ $car->model }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-gray-500">Year</dt>
                    <dd class="font-semibold">{{ $car->year }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-gray-500">License Plate</dt>
                    <dd class="font-semibold">{{ $car->license_plate }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-gray-500">Color</dt>
                    <dd class="font-semibold">{{ $car->color ?? 'N/A' }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-gray-500">Transmission</dt>
                    <dd class="font-semibold capitalize">{{ $car->transmission }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-gray-500">Seats</dt>
                    <dd class="font-semibold">{{ $car->seats }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-gray-500">Daily Rate</dt>
                    <dd class="font-semibold text-green-600">${{ number_format($car->daily_rate, 2) }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-gray-500">Status</dt>
                    <dd class="font-semibold capitalize">{{ $car->status }}</dd>
                </div>
            </dl>
            @if($car->description)
                <div class="mt-4">
                    <dt class="text-sm text-gray-500">Description</dt>
                    <dd class="mt-1">{{ $car->description }}</dd>
                </div>
            @endif
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold mb-4">Booking History</h2>
            @if($car->bookings->count())
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Customer</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Pickup</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Return</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($car->bookings as $booking)
                            <tr>
                                <td class="px-4 py-3">{{ $booking->customer->full_name }}</td>
                                <td class="px-4 py-3">{{ $booking->pickup_datetime->format('M d, Y') }}</td>
                                <td class="px-4 py-3">{{ $booking->return_datetime->format('M d, Y') }}</td>
                                <td class="px-4 py-3 capitalize">{{ $booking->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-gray-500">No bookings for this car yet.</p>
            @endif
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6 mt-8">
        <h2 class="text-xl font-semibold mb-4">Maintenance History</h2>
        @if($car->maintenances->count())
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Cost</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($car->maintenances as $m)
                        <tr>
                            <td class="px-4 py-3">{{ $m->scheduled_date->format('M d, Y') }}</td>
                            <td class="px-4 py-3 capitalize">{{ str_replace('_', ' ', $m->type) }}</td>
                            <td class="px-4 py-3">${{ number_format($m->cost, 2) }}</td>
                            <td class="px-4 py-3 capitalize">{{ $m->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-gray-500">No maintenance records.</p>
        @endif
    </div>
@endsection
