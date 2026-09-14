@extends('layouts.app')

@section('title', 'Cars - Car Rental Management')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-slate-900">Drivers</h1>
        <a href="{{ route('drivers.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">+ Add Driver</a>
    </div>

    <div class="overflow-hidden rounded-xl border border-slate-300 bg-slate-200/80 shadow-md">
        <table class="min-w-full divide-y divide-slate-300/80 bg-slate-100/80">
            <thead class="bg-slate-700 text-slate-200">
                <tr class="transition-colors hover:bg-white/80">
                    <th class="whitespace-nowrap px-3 py-2.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-200">Name</th>
                    <th class="whitespace-nowrap px-3 py-2.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-200">License Number</th>
                    <th class="whitespace-nowrap px-3 py-2.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-200">License Expiry</th>
                    <th class="whitespace-nowrap px-3 py-2.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-200">Daily Rate</th>
                    <th class="whitespace-nowrap px-3 py-2.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-200">Status</th>
                    <th class="whitespace-nowrap px-3 py-2.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-200">Bookings</th>
                    <th class="whitespace-nowrap px-3 py-2.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-200">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-300/80 bg-slate-100/80">
                @forelse($drivers as $driver)
                    <tr class="transition-colors hover:bg-white/80">
                        <td class="whitespace-nowrap px-3 py-2.5">
                            <div class="font-semibold">{{ $driver->name}}</div>
                        </td>
                        <td class="whitespace-nowrap px-3 py-2.5">{{ $driver->license_number }}</td>
                        <td class="whitespace-nowrap px-3 py-2.5">{{ $driver->license_expiry?->format('d M Y') ?? 'N/A' }}</td>
                        <td class="whitespace-nowrap px-3 py-2.5">{{ $driver->driver_daily_rate ?? 'N/A' }}</td>
                        <td class="whitespace-nowrap px-3 py-2.5">
                            <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-semibold 
                                @if($driver->status == 'available') bg-emerald-100 text-emerald-700
                                @elseif($driver->status == 'hired') bg-orange-100 text-orange-700
                                @else bg-slate-200 text-slate-700 @endif">
                                {{ ucfirst($driver->status) }}
                            </span>
                        </td>
                        <td class="whitespace-nowrap px-3 py-2.5">{{ $driver->bookings_count }}</td>
                        <td class="whitespace-nowrap px-3 py-2.5 flex items-center gap-2">
                            <a href="{{ route('drivers.show', $driver) }}" class="text-slate-600 hover:text-slate-900 hover:underline">View</a>
                            <a href="{{ route('drivers.edit', $driver) }}" class="text-amber-600 hover:text-amber-800 hover:underline">Edit</a>
                            <form action="{{ route('drivers.destroy', $driver) }}" method="POST" class="inline" onsubmit="return confirm('Delete this driver?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-rose-600 hover:text-rose-800 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr class="transition-colors hover:bg-white/80">
                        <td colspan="6" class="whitespace-nowrap px-3 py-2.5 text-center text-slate-500">No drivers found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $drivers->links() }}
    </div>
@endsection
