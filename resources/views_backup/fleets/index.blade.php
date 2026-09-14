<div>
    <!-- The whole future lies in uncertainty: live immediately. - Seneca -->
</div>
@extends('layouts.app')

@section('title', 'Fleets - Car Rental Management')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Fleets</h1>
        <a href="{{ route('fleets.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Add New Fleet</a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fleet Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Category</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total Cars</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Available Cars</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($fleets as $fleet)
                    <tr>
                        <td class="px-6 py-4">
                            <div class="font-semibold">{{ $fleet->fleet_name }}</div>
                        </td>
                        <td class="px-6 py-4">{{ $fleet->category }}</td>
                        <td class="px-6 py-4">{{ $fleet->cars_count }}</td>
                        <td class="px-6 py-4">{{ $fleet->cars->where('status', 'available')->count() }}</td>
                        <td class="px-6 py-4 space-x-2">
                            <a href="{{ route('fleets.show', $fleet) }}" class="text-blue-600 hover:underline">View</a>
                            <a href="{{ route('fleets.edit', $fleet) }}" class="text-yellow-700 hover:underline">Edit</a>
                            <form action="{{ route('fleets.destroy', $fleet) }}" method="POST" class="inline" onsubmit="return confirm('Delete this fleet?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">No fleets found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $fleets->links() }}
    </div>
@endsection
