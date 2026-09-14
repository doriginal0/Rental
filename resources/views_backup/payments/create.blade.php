@extends('layouts.app')

@section('title', 'Record Payment - Car Rental Management')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Record Payment</h1>

    <div class="bg-white rounded-lg shadow p-6 max-w-2xl">
        <form action="{{ route('payments.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Booking</label>
                    <select name="booking_id" required class="w-full border rounded px-3 py-2">
                        <option value="">Select a booking</option>
                        @foreach($bookings as $booking)
                            <option value="{{ $booking->id }}" {{ old('booking_id') == $booking->id ? 'selected' : '' }}>
                                #{{ $booking->id }} - {{ $booking->customer->full_name }} - ${{ number_format($booking->total_cost, 2) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Amount ($)</label>
                    <input type="number" step="0.01" name="amount" value="{{ old('amount') }}" required class="w-full border rounded px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Payment Method</label>
                    <select name="method" class="w-full border rounded px-3 py-2">
                        @foreach(['cash', 'card', 'bank_transfer', 'online'] as $method)
                            <option value="{{ $method }}" {{ old('method') == $method ? 'selected' : '' }}>{{ ucfirst(str_replace('_', ' ', $method)) }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" class="w-full border rounded px-3 py-2">
                        @foreach(['pending', 'completed', 'refunded', 'failed'] as $status)
                            <option value="{{ $status }}" {{ old('status') == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Reference</label>
                    <input type="text" name="reference" value="{{ old('reference') }}" class="w-full border rounded px-3 py-2">
                </div>
            </div>
            <div class="mt-6 flex gap-3">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Record Payment</button>
                <a href="{{ route('payments.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded hover:bg-gray-400">Cancel</a>
            </div>
        </form>
    </div>
@endsection
