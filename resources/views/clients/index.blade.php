@extends('layouts.app')

@section('title', 'Clients Overview')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-slate-900">Clients Overview</h1>
    <p class="text-slate-600 mt-1">All registered rental companies and their overall statistics.</p>
</div>

<div class="overflow-hidden rounded-xl border border-slate-300 bg-slate-200/80 shadow-md">
    <table class="min-w-full divide-y divide-slate-300/80 bg-slate-100/80">
        <thead class="bg-slate-700 text-slate-200">
            <tr class="transition-colors hover:bg-white/80">
                <th class="whitespace-nowrap px-3 py-2.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-200">Company</th>
                <th class="whitespace-nowrap px-3 py-2.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-200">Name</th>
                <th class="whitespace-nowrap px-3 py-2.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-200">Email</th>
                <th class="px-6 py-3 text-center text-xs font-medium text-slate-500 uppercase tracking-wider">Cars</th>
                <th class="px-6 py-3 text-center text-xs font-medium text-slate-500 uppercase tracking-wider">Customers</th>
                <th class="px-6 py-3 text-center text-xs font-medium text-slate-500 uppercase tracking-wider">Bookings</th>
                <th class="px-6 py-3 text-center text-xs font-medium text-slate-500 uppercase tracking-wider">Role</th>
                <th class="px-6 py-3 text-center text-xs font-medium text-slate-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-slate-100/80 divide-y divide-slate-300/80">
            @forelse ($clients as $client)
                <tr class="hover:bg-slate-700 text-slate-200">
                    <td class="whitespace-nowrap px-3 py-2.5 whitespace-nowrap">
                        <div class="text-sm font-medium text-slate-900">{{ $client->company_name }}</div>
                    </td>
                    <td class="whitespace-nowrap px-3 py-2.5 whitespace-nowrap text-sm text-slate-500">{{ $client->name }}</td>
                    <td class="whitespace-nowrap px-3 py-2.5 whitespace-nowrap text-sm text-slate-500">{{ $client->email }}</td>
                    <td class="whitespace-nowrap px-3 py-2.5 whitespace-nowrap text-center text-sm text-slate-700">{{ $client->cars_count}}</td>
                    <td class="whitespace-nowrap px-3 py-2.5 whitespace-nowrap text-center text-sm text-slate-700">{{ $client->customers_count }}</td>
                    <td class="whitespace-nowrap px-3 py-2.5 whitespace-nowrap text-center text-sm text-slate-700">{{ $client->bookings_count }}</td>
                    <td class="whitespace-nowrap px-3 py-2.5 whitespace-nowrap text-center">
                        @if ($client->isAdmin())
                            <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-semibold bg-violet-100 text-violet-700 rounded-full">Admin</span>
                        @else
                            <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-semibold bg-slate-200 text-slate-700 rounded-full">Client</span>
                        @endif
                    </td>
                    <td class="whitespace-nowrap px-3 py-2.5 whitespace-nowrap text-center">
                        @if ($client->id !== auth()->id())
                            <form method="POST" action="{{ route('clients.destroy', $client) }}"
                                  onsubmit="return confirm('Delete {{ $client->company_name }}? This removes all their cars, customers, bookings, payments and maintenance. This cannot be undone.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="inline-flex items-center px-3 py-1 text-xs font-medium text-rose-600 bg-rose-50 border border-rose-200 rounded hover:bg-rose-100">
                                    Delete
                                </button>
                            </form>
                        @else
                            <span class="text-xs text-slate-400">(you)</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr class="transition-colors hover:bg-white/80">
                    <td colspan="8" class="whitespace-nowrap px-3 py-2.5 text-center text-slate-500">No clients found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $clients->links() }}
</div>
@endsection