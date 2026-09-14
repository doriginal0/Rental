@extends('layouts.app')

@section('title', 'Finance - Car Rental Management')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold">Finance Ledger</h1>
            <p class="text-gray-600 text-sm mt-1">Revenue, payouts and expenses</p>
        </div>
        <a href="{{ route('payments.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Add Entry</a>
    </div>

    {{-- ── Stat cards ───────────────────────────────────────────── --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-green-500">
            <p class="text-sm font-medium text-gray-600">Total Revenue</p>
            <p class="text-3xl font-bold text-green-600">${{ number_format($totalRevenue, 2) }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-red-500">
            <p class="text-sm font-medium text-gray-600">Total Expenses</p>
            <p class="text-3xl font-bold text-red-600">${{ number_format($totalExpenses, 2) }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6 border-l-4 {{ $net >= 0 ? 'border-green-500' : 'border-red-500' }}">
            <p class="text-sm font-medium text-gray-600">Net Profit</p>
            <p class="text-3xl font-bold {{ $net >= 0 ? 'text-green-600' : 'text-red-600' }}">
                ${{ number_format($net, 2) }}
            </p>
        </div>
    </div>

    {{-- ── Breakdown ────────────────────────────────────────────── --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <h2 class="px-6 py-4 font-semibold text-lg bg-green-50 text-green-800">Money In</h2>
            <table class="min-w-full text-sm">
                <tbody class="divide-y divide-gray-100">
                    <tr>
                        <td class="px-6 py-3">Booking Revenue</td>
                        <td class="px-6 py-3 text-right font-semibold">${{ number_format($bookingRevenue, 2) }}</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-3">Miscellaneous Income</td>
                        <td class="px-6 py-3 text-right font-semibold">${{ number_format($miscIncome, 2) }}</td>
                    </tr>
                    <tr class="bg-gray-50 font-bold">
                        <td class="px-6 py-3">Total</td>
                        <td class="px-6 py-3 text-right text-green-700">${{ number_format($totalRevenue, 2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <h2 class="px-6 py-4 font-semibold text-lg bg-red-50 text-red-800">Money Out</h2>
            <table class="min-w-full text-sm">
                <tbody class="divide-y divide-gray-100">
                    <tr>
                        <td class="px-6 py-3">Driver Payouts</td>
                        <td class="px-6 py-3 text-right font-semibold">${{ number_format($driverPayouts, 2) }}</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-3">Maintenance</td>
                        <td class="px-6 py-3 text-right font-semibold">${{ number_format($maintenanceSpend, 2) }}</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-3">Miscellaneous Expenses</td>
                        <td class="px-6 py-3 text-right font-semibold">${{ number_format($miscExpense, 2) }}</td>
                    </tr>
                    <tr class="bg-gray-50 font-bold">
                        <td class="px-6 py-3">Total</td>
                        <td class="px-6 py-3 text-right text-red-700">${{ number_format($totalExpenses, 2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden mb-8">
        <h2 class="px-6 py-4 font-semibold text-lg bg-yellow-50 text-yellow-800">
            Income
            <span class="ml-2 text-sm font-normal">(detailed)</span>
            </h2>
             <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Booking time</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Customer</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Amount</th>
                    </tr>
                    </thead>
            <tbody class="divide-y divide-gray-200">
                    @forelse($bookingRevenue_s as $booking_s)
                        <tr>
                            <td class="px-6 py-4">{{ $booking_s->pickup_datetime}}</td>
                            <td class="px-6 py-4">{{ $booking_s->customer?->full_name ?? '-'}}</td>
                            <td class="px-6 py-4 font-semibold text-green-600">{{ number_format($booking_s->total_cost, 2)}} DZD</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">No income.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
    {{-- ── Pending bookings ─────────────────────────────────────── --}}
    <div class="bg-white rounded-lg shadow overflow-hidden mb-8">
        <h2 class="px-6 py-4 font-semibold text-lg bg-yellow-50 text-yellow-800">
            Pending Bookings
            <span class="ml-2 text-sm font-normal">(not yet counted as revenue)</span>
            
        </h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Customer</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Car</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Pickup</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-600 uppercase">Total</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-600 uppercase">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($pendingBookings as $booking)
                        <tr>
                            <td class="px-6 py-4">{{ $booking->customer?->full_name ?? '—' }}</td>
                            <td class="px-6 py-4">{{ $booking->car?->full_name ?? '—' }}</td>
                            <td class="px-6 py-4">{{ $booking->pickup_datetime?->format('M d, Y H:i') }}</td>
                            <td class="px-6 py-4 text-right font-semibold">${{ number_format($booking->total_cost, 2) }}</td>
                            {{-- <td class="px-6 py-4 text-right">
                                <form action="{{ route('bookings.updateStatus', $booking) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="confirmed">
                                    <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded text-xs hover:bg-green-700">
                                        Confirm
                                    </button>
                                </form>
                            </td> --}}
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">No pending bookings.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- ── Misc entries ─────────────────────────────────────────── --}}
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <h2 class="px-6 py-4 font-semibold text-lg">Miscellaneous Entries</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Description</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Method</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-600 uppercase">Amount</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-600 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($miscEntries as $entry)
                        <tr>
                            <td class="px-6 py-4">{{ $entry->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4">{{ $entry->description ?? '—' }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-xs rounded-full {{ $entry->isIncome() ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ ucfirst($entry->type) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 capitalize">{{ $entry->method ? str_replace('_', ' ', $entry->method) : '—' }}</td>
                            <td class="px-6 py-4 text-right font-semibold {{ $entry->isIncome() ? 'text-green-700' : 'text-red-700' }}">
                                {{ $entry->isIncome() ? '+' : '-' }}${{ number_format($entry->amount, 2) }}
                            </td>
                            <td class="px-6 py-4 text-right space-x-2 whitespace-nowrap">
                                <a href="{{ route('payments.edit', $entry) }}" class="text-yellow-700 hover:underline">Edit</a>
                                <form action="{{ route('payments.destroy', $entry) }}" method="POST" class="inline" onsubmit="return confirm('Delete this entry?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">No miscellaneous entries yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
