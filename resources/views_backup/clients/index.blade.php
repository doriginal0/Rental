@extends('layouts.app')

@section('title', 'Clients Overview')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Clients Overview</h1>
    <p class="text-gray-600 mt-1">All registered rental companies and their overall statistics.</p>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Company</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Cars</th>
                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Customers</th>
                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Bookings</th>
                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse ($clients as $client)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $client->company_name }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $client->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $client->email }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-700">{{ $client->cars_count}}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-700">{{ $client->customers_count }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-700">{{ $client->bookings_count }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        @if ($client->isAdmin())
                            <span class="px-2 py-1 text-xs font-semibold bg-purple-100 text-purple-700 rounded-full">Admin</span>
                        @else
                            <span class="px-2 py-1 text-xs font-semibold bg-gray-100 text-gray-600 rounded-full">Client</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        @if ($client->id !== auth()->id())
                            <form method="POST" action="{{ route('clients.destroy', $client) }}"
                                  onsubmit="return confirm('Delete {{ $client->company_name }}? This removes all their cars, customers, bookings, payments and maintenance. This cannot be undone.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="inline-flex items-center px-3 py-1 text-xs font-medium text-red-600 bg-red-50 border border-red-200 rounded hover:bg-red-100">
                                    Delete
                                </button>
                            </form>
                        @else
                            <span class="text-xs text-gray-400">(you)</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="px-6 py-4 text-center text-gray-500">No clients found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $clients->links() }}
</div>
@endsection