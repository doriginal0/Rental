@extends('layouts.app')

@section('title', 'Payment Details - Car Rental Management')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-slate-900">Payment #{{ $payment->id }}</h1>
        <div class="flex items-center gap-2">
            <a href="{{ route('payments.edit', $payment) }}" class="rounded-lg bg-amber-500 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-amber-600">Edit</a>
            <a href="{{ route('payments.index') }}" class="rounded-lg bg-slate-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-700">Back</a>
        </div>
    </div>

    <div class="overflow-hidden rounded-xl border border-slate-300 bg-slate-200/80 shadow-md p-6 max-w-2xl">
        <dl class="grid grid-cols-2 gap-4">
            <div>
                <dt class="text-sm text-slate-500">Booking</dt>
                <dd class="font-semibold">#{{ $payment->booking_id }}</dd>
            </div>
            <div>
                <dt class="text-sm text-slate-500">Customer</dt>
                <dd class="font-semibold">{{ $payment->booking->customer->full_name }}</dd>
            </div>
            <div>
                <dt class="text-sm text-slate-500">Car</dt>
                <dd class="font-semibold">{{ $payment->booking->car->full_name }}</dd>
            </div>
            <div>
                <dt class="text-sm text-slate-500">Amount</dt>
                <dd class="font-semibold text-emerald-700">${{ number_format($payment->amount, 2) }}</dd>
            </div>
            <div>
                <dt class="text-sm text-slate-500">Method</dt>
                <dd class="font-semibold capitalize">{{ str_replace('_', ' ', $payment->method) }}</dd>
            </div>
            <div>
                <dt class="text-sm text-slate-500">Status</dt>
                <dd class="font-semibold capitalize">{{ $payment->status }}</dd>
            </div>
            <div>
                <dt class="text-sm text-slate-500">Reference</dt>
                <dd class="font-semibold">{{ $payment->reference ?? 'N/A' }}</dd>
            </div>
            <div>
                <dt class="text-sm text-slate-500">Paid At</dt>
                <dd class="font-semibold">{{ $payment->paid_at?->format('M d, Y H:i') ?? 'N/A' }}</dd>
            </div>
        </dl>
    </div>
@endsection
