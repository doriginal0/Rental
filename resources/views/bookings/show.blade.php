@extends('layouts.app')

@section('title', 'Booking Details - Car Rental Management')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-3xl font-bold text-slate-900">
            Booking #{{ $booking->id }}
        </h1>

        <div class="flex items-center gap-2">
            <a href="{{ route('bookings.edit', $booking) }}"
               class="rounded-lg bg-amber-500 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-amber-600">
                Edit
            </a>

            <a href="{{ route('bookings.index') }}"
               class="rounded-lg bg-slate-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-700">
                Back
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        {{-- Booking details --}}
        <div class="overflow-hidden rounded-xl border border-slate-300 bg-slate-200/80 shadow-md">
            <div class="border-b border-slate-400/70 bg-slate-800 px-4 py-3">
                <h2 class="text-sm font-semibold uppercase tracking-wide text-slate-100">
                    Booking Details
                </h2>
            </div>

            <div class="p-5">
                <dl class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">Car</dt>
                        <dd class="mt-1 font-semibold text-slate-800">
                            {{ $booking->car->full_name }}
                        </dd>
                    </div>

                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">Customer</dt>
                        <dd class="mt-1 font-semibold text-slate-800">
                            {{ $booking->customer->full_name }}
                        </dd>
                    </div>

                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">Pickup</dt>
                        <dd class="mt-1 font-semibold text-slate-800">
                            {{ $booking->pickup_datetime->format('M d, Y H:i') }}
                        </dd>
                    </div>

                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">Return</dt>
                        <dd class="mt-1 font-semibold text-slate-800">
                            {{ $booking->return_datetime->format('M d, Y H:i') }}
                        </dd>
                    </div>

                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">Duration</dt>
                        <dd class="mt-1 font-semibold text-slate-800">
                            {{ $booking->duration_in_days }} day(s)
                        </dd>
                    </div>

                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">Total Cost</dt>
                        <dd class="mt-1 font-semibold text-emerald-700">
                            ${{ number_format($booking->total_cost, 2) }}
                        </dd>
                    </div>

                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">Driver</dt>
                        <dd class="mt-1 font-semibold {{ $booking->driver ? 'text-emerald-700' : 'text-red-600' }}">
                            {{ $booking->driver?->name ?? 'No driver' }}
                        </dd>
                    </div>

                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">Status</dt>
                        <dd class="mt-1 font-semibold capitalize text-slate-800">
                            {{ $booking->status }}
                        </dd>
                    </div>
                </dl>

                @if($booking->notes)
                    <div class="mt-5 border-t border-slate-300 pt-4">
                        <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">
                            Notes
                        </dt>
                        <dd class="mt-1 text-sm text-slate-700">
                            {{ $booking->notes }}
                        </dd>
                    </div>
                @endif
            </div>
        </div>

        {{-- Payments --}}
        <div class="overflow-hidden rounded-xl border border-slate-300 bg-slate-200/80 shadow-md">
            <div class="border-b border-slate-400/70 bg-slate-800 px-4 py-3">
                <h2 class="text-sm font-semibold uppercase tracking-wide text-slate-100">
                    Payments
                </h2>
            </div>

            @if($booking->payments->count())
                <div class="overflow-x-auto">
                    <table class="min-w-full text-left text-sm text-slate-700">
                        <thead class="bg-slate-700 text-xs uppercase tracking-wider text-slate-200">
                            <tr>
                                <th class="whitespace-nowrap px-3 py-2.5 font-semibold">Amount</th>
                                <th class="whitespace-nowrap px-3 py-2.5 font-semibold">Method</th>
                                <th class="whitespace-nowrap px-3 py-2.5 font-semibold">Status</th>
                                <th class="whitespace-nowrap px-3 py-2.5 font-semibold">Date</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-300/80 bg-slate-100/80">
                            @foreach($booking->payments as $payment)
                                <tr class="transition-colors hover:bg-white/80">
                                    <td class="whitespace-nowrap px-3 py-2.5 font-semibold text-slate-900">
                                        ${{ number_format($payment->amount, 2) }}
                                    </td>

                                    <td class="whitespace-nowrap px-3 py-2.5 capitalize">
                                        {{ str_replace('_', ' ', $payment->method) }}
                                    </td>

                                    <td class="whitespace-nowrap px-3 py-2.5">
                                        <span class="inline-flex rounded-full bg-slate-200 px-2.5 py-1 text-xs font-semibold capitalize text-slate-700">
                                            {{ $payment->status }}
                                        </span>
                                    </td>

                                    <td class="whitespace-nowrap px-3 py-2.5 text-slate-600">
                                        {{ $payment->paid_at?->format('M d, Y') ?? 'Pending' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="p-5 text-sm text-slate-500">
                    No payments recorded for this booking.
                </p>
            @endif
        </div>
    </div>
@endsection
