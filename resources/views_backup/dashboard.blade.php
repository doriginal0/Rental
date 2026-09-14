@extends('layouts.app')

@section('title', 'Dashboard - Car Rental Management')

@section('content')
    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
    <div>
        <p class="text-sm font-semibold uppercase tracking-widest text-blue-600">
            Fleet overview
        </p>

        <h1 class="mt-2 text-3xl font-bold tracking-tight text-slate-950 sm:text-4xl">
            Dashboard
        </h1>

        <p class="mt-2 max-w-2xl text-sm text-slate-500">
            Monitor your vehicles, bookings, customers, and revenue from one place.
        </p>
    </div>

    <div class="flex items-center gap-2 text-sm text-slate-500">
        <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
        System operational
    </div>
</div>
    
    <div class="grid grid-cols-1 gap-8 lg:items-start lg:grid-cols-[minmax(0,0.5fr)_minmax(0,1fr)_220px]">
    <!-- My Fleet -->
    <div class="overflow-hidden rounded-xl border border-slate-300 bg-slate-200/80 shadow-md">
        <div class="border-b border-slate-400/70 bg-slate-800 px-4 py-3">
            <h2 class="text-sm font-semibold tracking-wide text-slate-100">
                My Fleet
            </h2>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm text-slate-700">
                <thead class="bg-slate-700 text-xs uppercase tracking-wider text-slate-200">
                    <tr>
                        <th class="px-3 py-2.5 font-semibold">Fleet Name</th>
                        <th class="px-3 py-2.5 font-semibold">Total Vehicles</th>
                        <th class="px-3 py-2.5 font-semibold">Available</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-300/80 bg-slate-100/80">
                    @forelse($fleets as $fleet)
                        <tr class="transition-colors hover:bg-white/80">
                            <td class="whitespace-nowrap px-3 py-2.5 font-semibold text-slate-800">
                                {{ $fleet->fleet_name }}
                            </td>

                            <td class="whitespace-nowrap px-3 py-2.5 text-slate-700">
                                {{ $fleet->cars_count }}
                            </td>

                            <td class="whitespace-nowrap px-3 py-2.5 text-slate-700">
                                {{ $fleet->cars->where('status', 'available')->count() }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-3 py-6 text-center text-sm text-slate-500">
                                No fleets available
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

        <!-- Recent Bookings -->
        <div class="overflow-hidden rounded-xl border border-slate-300 bg-slate-200/80 shadow-md">
    <div class="border-b border-slate-400/70 bg-slate-800 px-4 py-3">
        <h2 class="text-sm font-semibold tracking-wide text-slate-100">
            Recent Bookings
        </h2>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full text-left text-sm text-slate-700">
            <thead class="bg-slate-700 text-xs uppercase tracking-wider text-slate-200">
                <tr>
                    <th class="px-3 py-2.5 font-semibold">Customer</th>
                    <th class="px-3 py-2.5 font-semibold">Car</th>
                    <th class="px-3 py-2.5 font-semibold">Status</th>
                    <th class="px-3 py-2.5 text-right font-semibold">Amount</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-slate-300/80 bg-slate-100/80">
                @forelse($recentBookings as $booking)
                    <tr class="transition-colors hover:bg-white/80">
                        <td class="whitespace-nowrap px-3 py-2.5 font-medium text-slate-800">
                            {{ $booking->customer->full_name }}
                        </td>

                        <td class="whitespace-nowrap px-3 py-2.5 text-slate-600">
                            {{ $booking->car->full_name }}
                        </td>

                        <td class="px-3 py-2.5">
                            <span @class([
                                'inline-flex rounded-full px-2 py-0.5 text-xs font-semibold',
                                'bg-emerald-100 text-emerald-800' => $booking->status === 'active',
                                'bg-amber-100 text-amber-800' => $booking->status === 'pending',
                                'bg-blue-100 text-blue-800' => $booking->status === 'completed',
                                'bg-rose-100 text-rose-800' => $booking->status === 'cancelled',
                                'bg-slate-200 text-slate-700' => !in_array(
                                    $booking->status,
                                    ['active', 'pending', 'completed', 'cancelled']
                                ),
                            ])>
                                {{ ucfirst($booking->status) }}
                            </span>
                        </td>

                        <td class="whitespace-nowrap px-3 py-2.5 text-right font-semibold text-slate-800">
                            ${{ number_format($booking->total_cost, 2) }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-3 py-6 text-center text-sm text-slate-500">
                            No recent bookings found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
         {{-- ِButtons --}}
        <div class="order-first relative min-w-0 lg:order-none">
    <div class="flex w-full flex-col gap-2">

        <a href="{{ route('cars.create') }}"
           class="inline-flex w-full items-center justify-left rounded-lg bg-slate-600 px-4 py-2.5 text-sm font-semibold text-slate-100 shadow-md transition lg:rounded-l-lg lg:w-100 hover:bg-slate-700">
            New vehicle
        </a>

        <a href="{{ route('bookings.create') }}"
           class="inline-flex w-full items-center justify-left rounded-lg bg-slate-600 px-4 py-2.5 text-sm font-semibold text-slate-100 shadow-md transition lg:rounded-l-lg lg:w-100 hover:bg-slate-700">
            New booking
        </a>

        <a href="{{ route('customers.create') }}"
           class="inline-flex w-full items-center justify-left rounded-lg bg-slate-600 px-4 py-2.5 text-sm font-semibold text-slate-100 shadow-md transition lg:rounded-l-lg lg:w-100 hover:bg-slate-700">
            New Customer
        </a>

        <a href="{{ route('fleets.index') }}"
           class="inline-flex w-full items-center justify-left rounded-lg bg-slate-600 px-4 py-2.5 text-sm font-semibold text-slate-100 shadow-md transition lg:rounded-l-lg lg:w-100 hover:bg-slate-700">
            Manage My Fleets
        </a>

        <a href="{{ route('maintenances.create') }}"
           class="inline-flex w-full items-center justify-left rounded-lg bg-slate-600 px-4 py-2.5 text-sm font-semibold text-slate-100 shadow-md transition lg:rounded-l-lg lg:w-100 hover:bg-slate-700">
            Schedule maintenance
        </a>

    </div>
</div>
</div>
        
<div class="grid grid-cols-1 gap-8 lg:items-start lg:grid-cols-[minmax(0,0.75fr)_minmax(0,0.75fr)]">
  
    
 {{-- CALENDAR --}}
@php
    $leading = \Carbon\Carbon::parse(array_key_first($days))->dayOfWeek;
@endphp

<div class="mt-8 overflow-hidden rounded-xl border border-slate-300 bg-slate-200/80 shadow-md">
    <div class="flex items-center justify-between border-b border-slate-400/70 bg-slate-800 px-4 py-3">
        <h2 class="text-sm font-semibold tracking-wide text-slate-100">
            Booking Calendar
        </h2>

        <div class="flex items-center gap-2 text-sm">
            <a href="{{ route('dashboard', ['month' => $prevMonth]) }}"
               class="rounded-md border border-slate-500 bg-slate-700 px-2.5 py-1 text-slate-100 transition hover:bg-slate-600">
                &larr;
            </a>

            <span class="min-w-[90px] text-center font-medium text-slate-200">
                {{ $month->format('F Y') }}
            </span>

            <a href="{{ route('dashboard', ['month' => $nextMonth]) }}"
               class="rounded-md border border-slate-500 bg-slate-700 px-2.5 py-1 text-slate-100 transition hover:bg-slate-600">
                &rarr;
            </a>
        </div>
    </div>

    <div class="p-4">
        <div class="mb-1 grid grid-cols-7 gap-1 text-center text-[11px] font-semibold uppercase tracking-wide text-slate-500">
            @foreach(['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] as $d)
                <div class="py-1">{{ $d }}</div>
            @endforeach
        </div>

        <div class="grid grid-cols-7 gap-1">
            @for($i = 0; $i < $leading; $i++)
                <div class="min-h-[80px] rounded-md border border-slate-200 bg-slate-300/40"></div>
            @endfor

            @foreach($days as $date => $entries)
                <div class="min-h-[80px] rounded-md border p-1 transition-colors hover:bg-white/70
                    {{ $date === now()->toDateString()
                        ? 'border-slate-500 bg-slate-300/80 ring-1 ring-slate-400'
                        : 'border-slate-300/80 bg-slate-100/80' }}">

                    <div class="mb-1 text-xs font-semibold text-slate-600">
                        {{ (int) \Carbon\Carbon::parse($date)->format('j') }}
                    </div>

                    <div class="space-y-0.5">
                        @foreach(array_slice($entries, 0, 3) as $e)
                            <div class="truncate rounded px-1 py-0.5 text-[10px] leading-tight text-white shadow-sm"
                                 style="background-color: {{ $e['color'] }}"
                                 title="{{ $e['car'] }}">
                                {{ $e['car'] }}
                            </div>
                        @endforeach

                        @if(count($entries) > 3)
                            <div class="text-[10px] font-medium text-slate-500">
                                +{{ count($entries) - 3 }} more
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4 flex flex-wrap gap-3 border-t border-slate-300/80 pt-3 text-xs text-slate-600">
            @foreach($legend as $car)
                <span class="flex items-center gap-1.5">
                    <span class="inline-block h-2.5 w-2.5 rounded-full shadow-sm"
                          style="background-color: {{ $car['color'] }}"></span>
                    {{ $car['name'] }}
                </span>
            @endforeach
        </div>
    </div>
</div>
<div class="mt-8 overflow-hidden rounded-xl border border-slate-300 bg-slate-200/80 shadow-md">
    <div class="border-b border-slate-400/70 bg-slate-800 px-4 py-3">
        <h2 class="text-sm font-semibold tracking-wide text-slate-100">
            Recent Maintenance
        </h2>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full text-left text-sm text-slate-700">
            <thead class="bg-slate-700 text-xs uppercase tracking-wider text-slate-200">
                <tr>
                    <th class="px-3 py-2.5 font-semibold">Car</th>
                    <th class="px-3 py-2.5 font-semibold">Scheduled At</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-slate-300/80 bg-slate-100/80">
                @forelse($recentMains as $mains)
                    <tr class="transition-colors hover:bg-white/80">
                        <td class="whitespace-nowrap px-3 py-2.5 font-medium text-slate-800">
                            {{ $mains->car->full_name }}
                        </td>

                        <td class="whitespace-nowrap px-3 py-2.5 text-slate-600">
                            {{ $mains->scheduled_date }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="px-3 py-6 text-center text-sm text-slate-500">
                            No recent maintenance scheduled.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
</div>


@endsection
