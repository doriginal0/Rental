@extends('layouts.app')

@section('title', 'Edit Customer - Car Rental Management')

@section('content')
    <h1 class="text-3xl font-bold text-slate-900 mb-6">Edit Customer</h1>

    <div class="overflow-hidden rounded-xl border border-slate-300 bg-slate-200/80 shadow-md p-6 max-w-2xl">
        <form action="{{ route('customers.update', $customer) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">First Name</label>
                    <input type="text" name="first_name" value="{{ old('first_name', $customer->first_name) }}" required class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-800 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Last Name</label>
                    <input type="text" name="last_name" value="{{ old('last_name', $customer->last_name) }}" required class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-800 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email', $customer->email) }}" required class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-800 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone', $customer->phone) }}" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-800 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-slate-700 mb-1">Address</label>
                    <input type="text" name="address" value="{{ old('address', $customer->address) }}" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-800 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Driver's License No.</label>
                    <input type="text" name="license_number" value="{{ old('license_number', $customer->license_number) }}" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-800 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">License Expiry</label>
                    <input type="date" name="license_expiry" value="{{ old('license_expiry', $customer->license_expiry?->format('Y-m-d')) }}" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-800 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                </div>
            </div>
            <div class="mt-6 flex gap-3">
                <button type="submit" class="rounded-lg bg-slate-700 px-6 py-2 font-semibold text-white shadow-sm transition hover:bg-slate-800">Update Customer</button>
                <a href="{{ route('customers.index') }}" class="rounded-lg bg-slate-600 px-6 py-2 font-semibold text-white shadow-sm transition hover:bg-slate-700">Cancel</a>
            </div>
        </form>
    </div>
@endsection
