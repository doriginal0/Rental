@extends('layouts.app')

@section('title', 'Cars - Car Rental Management')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-slate-900">Cars</h1>
        <a href="{{ route('cars.create') }}" class="rounded-lg bg-slate-700 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800">+ Add Car</a>
    </div>

    <div class="overflow-hidden rounded-xl border border-slate-300 bg-slate-200/80 shadow-md">
        <table class="min-w-full divide-y divide-slate-300/80 bg-slate-100/80">
            <thead class="bg-slate-700 text-slate-200">
                <tr class="transition-colors hover:bg-white/80">
                    <th class="whitespace-nowrap px-3 py-2.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-200">Car</th>
                    <th class="whitespace-nowrap px-3 py-2.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-200">License Plate</th>
                    <th class="whitespace-nowrap px-3 py-2.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-200">Daily Rate</th>
                    <th class="whitespace-nowrap px-3 py-2.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-200">Status</th>
                    <th class="whitespace-nowrap px-3 py-2.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-200">Bookings</th>
                    <th class="whitespace-nowrap px-3 py-2.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-200">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-300/80 bg-slate-100/80">
                @forelse($cars as $car)
                    <tr class="transition-colors hover:bg-white/80">
                        <td class="whitespace-nowrap px-3 py-2.5">
                            <div class="font-semibold">{{ $car->full_name }}</div>
                            <div class="text-sm text-slate-500">{{ $car->color }} • {{ $car->transmission }} • {{ $car->seats }} seats</div>
                        </td>
                        <td class="whitespace-nowrap px-3 py-2.5">{{ $car->license_plate }}</td>
                        <td class="whitespace-nowrap px-3 py-2.5">${{ number_format($car->daily_rate, 2) }}</td>
                        <td class="whitespace-nowrap px-3 py-2.5">
                            <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-semibold 
                                @if($car->status == 'available') bg-emerald-100 text-emerald-700
                                @elseif($car->status == 'rented') bg-orange-100 text-orange-700
                                @elseif($car->status == 'maintenance') bg-amber-100 text-amber-700
                                @else bg-slate-200 text-slate-700 @endif">
                                {{ ucfirst($car->status) }}
                            </span>
                        </td>
                        <td class="whitespace-nowrap px-3 py-2.5">{{ $car->bookings_count }}</td>
                        <td class="whitespace-nowrap px-3 py-2.5 flex items-center gap-2">
                            <a href="{{ route('cars.show', $car) }}" class="text-slate-600 hover:text-slate-900 hover:underline">View</a>
                            <a href="{{ route('cars.edit', $car) }}" class="text-amber-600 hover:text-amber-800 hover:underline">Edit</a>
                            <form action="{{ route('cars.destroy', $car) }}" method="POST" class="inline" onsubmit="return confirm('Delete this car?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-rose-600 hover:text-rose-800 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr class="transition-colors hover:bg-white/80">
                        <td colspan="6" class="whitespace-nowrap px-3 py-2.5 text-center text-slate-500">No cars found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $cars->links() }}
    </div>
@endsection
