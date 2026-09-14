@extends('layouts.app')

@section('title', 'Car Details - Car Rental Management')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-slate-900">{{ $car->full_name }}</h1>
        <div class="flex items-center gap-2">
            <a href="{{ route('cars.edit', $car) }}" class="rounded-lg bg-amber-500 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-amber-600">Edit</a>
            <a href="{{ route('cars.index') }}" class="rounded-lg bg-slate-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-700">Back</a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="overflow-hidden rounded-xl border border-slate-300 bg-slate-200/80 shadow-md p-6">
            <h2 class="text-xl font-semibold mb-4">Car Information</h2>
            <dl class="grid grid-cols-2 gap-4">
                <div>
                    <dt class="text-sm text-slate-500">Make</dt>
                    <dd class="font-semibold">{{ $car->make }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-slate-500">Model</dt>
                    <dd class="font-semibold">{{ $car->model }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-slate-500">Year</dt>
                    <dd class="font-semibold">{{ $car->year }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-slate-500">License Plate</dt>
                    <dd class="font-semibold">{{ $car->license_plate }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-slate-500">Color</dt>
                    <dd class="font-semibold">{{ $car->color ?? 'N/A' }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-slate-500">Transmission</dt>
                    <dd class="font-semibold capitalize">{{ $car->transmission }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-slate-500">Seats</dt>
                    <dd class="font-semibold">{{ $car->seats }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-slate-500">Daily Rate</dt>
                    <dd class="font-semibold text-emerald-700">${{ number_format($car->daily_rate, 2) }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-slate-500">Status</dt>
                    <dd class="font-semibold capitalize">{{ $car->status }}</dd>
                </div>
            </dl>
            @if($car->description)
                <div class="mt-4">
                    <dt class="text-sm text-slate-500">Description</dt>
                    <dd class="mt-1">{{ $car->description }}</dd>
                </div>
            @endif
        </div>

        <div class="overflow-hidden rounded-xl border border-slate-300 bg-slate-200/80 shadow-md p-6">
            <h2 class="text-xl font-semibold mb-4">Booking History</h2>
            @if($car->bookings->count())
                <table class="min-w-full divide-y divide-slate-300/80 bg-slate-100/80">
                    <thead>
                        <tr class="transition-colors hover:bg-white/80">
                            <th class="whitespace-nowrap px-3 py-2.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-200">Customer</th>
                            <th class="whitespace-nowrap px-3 py-2.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-200">Pickup</th>
                            <th class="whitespace-nowrap px-3 py-2.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-200">Return</th>
                            <th class="whitespace-nowrap px-3 py-2.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-200">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-300/80 bg-slate-100/80">
                        @foreach($car->bookings as $booking)
                            <tr class="transition-colors hover:bg-white/80">
                                <td class="whitespace-nowrap px-3 py-2.5">{{ $booking->customer->full_name }}</td>
                                <td class="whitespace-nowrap px-3 py-2.5">{{ $booking->pickup_datetime->format('M d, Y') }}</td>
                                <td class="whitespace-nowrap px-3 py-2.5">{{ $booking->return_datetime->format('M d, Y') }}</td>
                                <td class="whitespace-nowrap px-3 py-2.5 capitalize">{{ $booking->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-slate-500">No bookings for this car yet.</p>
            @endif
        </div>
    </div>

    <div class="overflow-hidden rounded-xl border border-slate-300 bg-slate-200/80 shadow-md p-6 mt-8">
        <h2 class="text-xl font-semibold mb-4">Maintenance History</h2>
        @if($car->maintenances->count())
            <table class="min-w-full divide-y divide-slate-300/80 bg-slate-100/80">
                <thead>
                    <tr class="transition-colors hover:bg-white/80">
                        <th class="whitespace-nowrap px-3 py-2.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-200">Date</th>
                        <th class="whitespace-nowrap px-3 py-2.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-200">Type</th>
                        <th class="whitespace-nowrap px-3 py-2.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-200">Cost</th>
                        <th class="whitespace-nowrap px-3 py-2.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-200">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-300/80 bg-slate-100/80">
                    @foreach($car->maintenances as $m)
                        <tr class="transition-colors hover:bg-white/80">
                            <td class="whitespace-nowrap px-3 py-2.5">{{ $m->scheduled_date->format('M d, Y') }}</td>
                            <td class="whitespace-nowrap px-3 py-2.5 capitalize">{{ str_replace('_', ' ', $m->type) }}</td>
                            <td class="whitespace-nowrap px-3 py-2.5">${{ number_format($m->cost, 2) }}</td>
                            <td class="whitespace-nowrap px-3 py-2.5 capitalize">{{ $m->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-slate-500">No maintenance records.</p>
        @endif
    </div>
@endsection
