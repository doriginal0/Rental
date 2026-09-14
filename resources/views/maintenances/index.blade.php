@extends('layouts.app')

@section('title', 'Maintenance - Car Rental Management')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-slate-900">Maintenance</h1>
        <a href="{{ route('maintenances.create') }}" class="rounded-lg bg-slate-700 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800">+ Schedule Maintenance</a>
    </div>

    <div class="overflow-hidden rounded-xl border border-slate-300 bg-slate-200/80 shadow-md">
        <table class="min-w-full divide-y divide-slate-300/80 bg-slate-100/80">
            <thead class="bg-slate-700 text-slate-200">
                <tr class="transition-colors hover:bg-white/80">
                    <th class="whitespace-nowrap px-3 py-2.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-200">Car</th>
                    <th class="whitespace-nowrap px-3 py-2.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-200">Scheduled Date</th>
                    <th class="whitespace-nowrap px-3 py-2.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-200">Type</th>
                    <th class="whitespace-nowrap px-3 py-2.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-200">Cost</th>
                    <th class="whitespace-nowrap px-3 py-2.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-200">Status</th>
                    <th class="whitespace-nowrap px-3 py-2.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-200">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-300/80 bg-slate-100/80">
                @forelse($maintenances as $maintenance)
                    <tr class="transition-colors hover:bg-white/80">
                        <td class="whitespace-nowrap px-3 py-2.5 font-semibold">{{ $maintenance->car->full_name }}</td>
                        <td class="whitespace-nowrap px-3 py-2.5">{{ $maintenance->scheduled_date->format('M d, Y') }}</td>
                        <td class="whitespace-nowrap px-3 py-2.5 capitalize">{{ str_replace('_', ' ', $maintenance->type) }}</td>
                        <td class="whitespace-nowrap px-3 py-2.5">${{ number_format($maintenance->cost, 2) }}</td>
                        <td class="whitespace-nowrap px-3 py-2.5">
                            <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-semibold 
                                @if($maintenance->status == 'completed') bg-emerald-100 text-emerald-700
                                @elseif($maintenance->status == 'in_progress') bg-blue-100 text-blue-700
                                @else bg-amber-100 text-amber-700 @endif">
                                {{ ucfirst(str_replace('_', ' ', $maintenance->status)) }}
                            </span>
                        </td>
                        <td class="whitespace-nowrap px-3 py-2.5 flex items-center gap-2">
                            <a href="{{ route('maintenances.show', $maintenance) }}" class="text-slate-600 hover:text-slate-900 hover:underline">View</a>
                            <a href="{{ route('maintenances.edit', $maintenance) }}" class="text-amber-600 hover:text-amber-800 hover:underline">Edit</a>
                            <form action="{{ route('maintenances.destroy', $maintenance) }}" method="POST" class="inline" onsubmit="return confirm('Delete this maintenance record?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-rose-600 hover:text-rose-800 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr class="transition-colors hover:bg-white/80">
                        <td colspan="6" class="whitespace-nowrap px-3 py-2.5 text-center text-slate-500">No maintenance records found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $maintenances->links() }}
    </div>
@endsection
