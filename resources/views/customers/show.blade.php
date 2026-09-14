@extends('layouts.app')

@section('title', 'Customer Details - Car Rental Management')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-slate-900">{{ $customer->full_name }}</h1>
        <div class="flex items-center gap-2">
            <a href="{{ route('customers.edit', $customer) }}" class="rounded-lg bg-amber-500 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-amber-600">Edit</a>
            <a href="{{ route('customers.index') }}" class="rounded-lg bg-slate-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-700">Back</a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="overflow-hidden rounded-xl border border-slate-300 bg-slate-200/80 shadow-md p-6">
            <h2 class="text-xl font-semibold mb-4">Contact Information</h2>
            <dl class="grid grid-cols-2 gap-4">
                <div>
                    <dt class="text-sm text-slate-500">Email</dt>
                    <dd class="font-semibold">{{ $customer->email }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-slate-500">Phone</dt>
                    <dd class="font-semibold">{{ $customer->phone ?? 'N/A' }}</dd>
                </div>
                <div class="col-span-2">
                    <dt class="text-sm text-slate-500">Address</dt>
                    <dd class="font-semibold">{{ $customer->address ?? 'N/A' }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-slate-500">License Number</dt>
                    <dd class="font-semibold">{{ $customer->license_number ?? 'N/A' }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-slate-500">License Expiry</dt>
                    <dd class="font-semibold">{{ $customer->license_expiry?->format('M d, Y') ?? 'N/A' }}</dd>
                </div>
            </dl>
        </div>

        <div class="overflow-hidden rounded-xl border border-slate-300 bg-slate-200/80 shadow-md p-6">
            <h2 class="text-xl font-semibold mb-4">Booking History</h2>
            @if($customer->bookings->count())
                <table class="min-w-full divide-y divide-slate-300/80 bg-slate-100/80">
                    <thead>
                        <tr class="transition-colors hover:bg-white/80">
                            <th class="whitespace-nowrap px-3 py-2.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-200">Car</th>
                            <th class="whitespace-nowrap px-3 py-2.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-200">Pickup</th>
                            <th class="whitespace-nowrap px-3 py-2.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-200">Return</th>
                            <th class="whitespace-nowrap px-3 py-2.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-200">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-300/80 bg-slate-100/80">
                        @foreach($customer->bookings as $booking)
                            <tr class="transition-colors hover:bg-white/80">
                                <td class="whitespace-nowrap px-3 py-2.5">{{ $booking->car->full_name }}</td>
                                <td class="whitespace-nowrap px-3 py-2.5">{{ $booking->pickup_datetime->format('M d, Y') }}</td>
                                <td class="whitespace-nowrap px-3 py-2.5">{{ $booking->return_datetime->format('M d, Y') }}</td>
                                <td class="whitespace-nowrap px-3 py-2.5 capitalize">{{ $booking->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-slate-500">No bookings for this customer yet.</p>
            @endif
        </div>
    </div>
@endsection
