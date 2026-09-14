@extends('layouts.app')

@section('title', 'Maintenance - Car Rental Management')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Maintenance</h1>
        <a href="{{ route('maintenances.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Schedule Maintenance</a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Car</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Scheduled Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Cost</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($maintenances as $maintenance)
                    <tr>
                        <td class="px-6 py-4 font-semibold">{{ $maintenance->car->full_name }}</td>
                        <td class="px-6 py-4">{{ $maintenance->scheduled_date->format('M d, Y') }}</td>
                        <td class="px-6 py-4 capitalize">{{ str_replace('_', ' ', $maintenance->type) }}</td>
                        <td class="px-6 py-4">${{ number_format($maintenance->cost, 2) }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs rounded-full 
                                @if($maintenance->status == 'completed') bg-green-100 text-green-700
                                @elseif($maintenance->status == 'in_progress') bg-blue-100 text-blue-700
                                @else bg-yellow-100 text-yellow-700 @endif">
                                {{ ucfirst(str_replace('_', ' ', $maintenance->status)) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 space-x-2">
                            <a href="{{ route('maintenances.show', $maintenance) }}" class="text-blue-600 hover:underline">View</a>
                            <a href="{{ route('maintenances.edit', $maintenance) }}" class="text-yellow-700 hover:underline">Edit</a>
                            <form action="{{ route('maintenances.destroy', $maintenance) }}" method="POST" class="inline" onsubmit="return confirm('Delete this maintenance record?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">No maintenance records found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $maintenances->links() }}
    </div>
@endsection
