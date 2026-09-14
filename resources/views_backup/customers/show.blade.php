@extends('layouts.app')

@section('title', 'Customer Details - Car Rental Management')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">{{ $customer->full_name }}</h1>
        <div class="space-x-2">
            <a href="{{ route('customers.edit', $customer) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Edit</a>
            <a href="{{ route('customers.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Back</a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold mb-4">Contact Information</h2>
            <dl class="grid grid-cols-2 gap-4">
                <div>
                    <dt class="text-sm text-gray-500">Email</dt>
                    <dd class="font-semibold">{{ $customer->email }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-gray-500">Phone</dt>
                    <dd class="font-semibold">{{ $customer->phone ?? 'N/A' }}</dd>
                </div>
                <div class="col-span-2">
                    <dt class="text-sm text-gray-500">Address</dt>
                    <dd class="font-semibold">{{ $customer->address ?? 'N/A' }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-gray-500">License Number</dt>
                    <dd class="font-semibold">{{ $customer->license_number ?? 'N/A' }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-gray-500">License Expiry</dt>
                    <dd class="font-semibold">{{ $customer->license_expiry?->format('M d, Y') ?? 'N/A' }}</dd>
                </div>
            </dl>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold mb-4">Booking History</h2>
            @if($customer->bookings->count())
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Car</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Pickup</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Return</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($customer->bookings as $booking)
                            <tr>
                                <td class="px-4 py-3">{{ $booking->car->full_name }}</td>
                                <td class="px-4 py-3">{{ $booking->pickup_datetime->format('M d, Y') }}</td>
                                <td class="px-4 py-3">{{ $booking->return_datetime->format('M d, Y') }}</td>
                                <td class="px-4 py-3 capitalize">{{ $booking->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-gray-500">No bookings for this customer yet.</p>
            @endif
        </div>
    </div>
@endsection
