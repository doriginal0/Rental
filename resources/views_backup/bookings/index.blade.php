@extends('layouts.app')

@section('title', 'Bookings - Car Rental Management')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-3xl font-bold text-slate-900">Bookings</h1>

        <a href="{{ route('bookings.create') }}"
           class="rounded-lg bg-slate-700 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800">
            + New Booking
        </a>
    </div>

    <div class="overflow-hidden rounded-xl border border-slate-300 bg-slate-200/80 shadow-md">
        <div class="border-b border-slate-400/70 bg-slate-800 px-4 py-3">
            <h2 class="text-sm font-semibold uppercase tracking-wide text-slate-100">
                Booking Records
            </h2>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm text-slate-700">
                <thead class="bg-slate-700 text-xs uppercase tracking-wider text-slate-200">
                    <tr>
                        <th class="whitespace-nowrap px-3 py-2.5 font-semibold">Customer</th>
                        <th class="whitespace-nowrap px-3 py-2.5 font-semibold">Car</th>
                        <th class="whitespace-nowrap px-3 py-2.5 font-semibold">Pickup</th>
                        <th class="whitespace-nowrap px-3 py-2.5 font-semibold">Return</th>
                        <th class="whitespace-nowrap px-3 py-2.5 font-semibold">Daily Rate</th>
                        <th class="whitespace-nowrap px-3 py-2.5 font-semibold">Driver</th>
                        <th class="whitespace-nowrap px-3 py-2.5 font-semibold">Driver Pay</th>
                        <th class="whitespace-nowrap px-3 py-2.5 font-semibold">Total</th>
                        <th class="whitespace-nowrap px-3 py-2.5 font-semibold">Status</th>
                        <th class="whitespace-nowrap px-3 py-2.5 font-semibold">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-300/80 bg-slate-100/80">
                    @forelse($bookings as $booking)
                        <tr class="transition-colors hover:bg-white/80">
                            <td class="whitespace-nowrap px-3 py-2.5 font-semibold text-slate-800">
                                {{ $booking->customer->full_name }}
                            </td>

                            <td class="whitespace-nowrap px-3 py-2.5">
                                {{ $booking->car->full_name }}
                            </td>

                            <td class="whitespace-nowrap px-3 py-2.5">
                                {{ $booking->pickup_datetime->format('M d, Y H:i') }}
                            </td>

                            <td class="whitespace-nowrap px-3 py-2.5">
                                {{ $booking->return_datetime->format('M d, Y H:i') }}
                            </td>

                            <td class="whitespace-nowrap px-3 py-2.5 font-semibold">
                                ${{ number_format($booking->daily_rate, 2) }}
                            </td>

                            <td class="whitespace-nowrap px-3 py-2.5">
                                {{ $booking->driver?->name ?? '—' }}
                            </td>

                            <td class="whitespace-nowrap px-3 py-2.5 font-semibold">
                                {{ $booking->driver_daily_rate !== null
                                    ? '$' . number_format($booking->driver_daily_rate, 2)
                                    : '—' }}
                            </td>

                            <td class="whitespace-nowrap px-3 py-2.5 font-semibold text-slate-900">
                                ${{ number_format($booking->total_cost, 2) }}
                            </td>

                            <td class="whitespace-nowrap px-3 py-2.5">
                                <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-semibold
                                    @if($booking->status === 'active')
                                        bg-emerald-100 text-emerald-700
                                    @elseif($booking->status === 'pending')
                                        bg-amber-100 text-amber-700
                                    @elseif($booking->status === 'confirmed')
                                        bg-blue-100 text-blue-700
                                    @elseif($booking->status === 'completed')
                                        bg-slate-200 text-slate-700
                                    @else
                                        bg-red-100 text-red-700
                                    @endif">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>

                            <td class="whitespace-nowrap px-3 py-2.5">
                                <div class="flex items-center gap-3">
                                    <a href="{{ route('bookings.show', $booking) }}"
                                       class="font-medium text-slate-600 hover:text-slate-900 hover:underline">
                                        View
                                    </a>

                                    <a href="{{ route('bookings.edit', $booking) }}"
                                       class="font-medium text-amber-600 hover:text-amber-800 hover:underline">
                                        Edit
                                    </a>

                                    <form action="{{ route('bookings.destroy', $booking) }}"
                                          method="POST"
                                          class="inline"
                                          onsubmit="return confirm('Delete this booking?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="font-medium text-red-600 hover:text-red-800 hover:underline">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="px-3 py-8 text-center text-sm text-slate-500">
                                No bookings found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $bookings->links() }}
    </div>
@endsection
