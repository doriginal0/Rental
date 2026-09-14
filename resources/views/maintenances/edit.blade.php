@extends('layouts.app')

@section('title', 'Edit Maintenance - Car Rental Management')

@section('content')
    <h1 class="text-3xl font-bold text-slate-900 mb-6">Edit Maintenance</h1>

    <div class="overflow-hidden rounded-xl border border-slate-300 bg-slate-200/80 shadow-md p-6 max-w-2xl">
        <form action="{{ route('maintenances.update', $maintenance) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Car</label>
                    <select name="car_id" required class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-800 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                        @foreach($cars as $car)
                            <option value="{{ $car->id }}" {{ $maintenance->car_id == $car->id ? 'selected' : '' }}>
                                {{ $car->full_name }} - {{ $car->license_plate }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Scheduled Date</label>
                        <input type="date" name="scheduled_date" value="{{ $maintenance->scheduled_date->format('Y-m-d') }}" required class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-800 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Type</label>
                        <select name="type" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-800 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                            @foreach(['oil_change', 'tire_replacement', 'brake_service', 'general', 'other'] as $type)
                                <option value="{{ $type }}" {{ $maintenance->type == $type ? 'selected' : '' }}>{{ ucfirst(str_replace('_', ' ', $type)) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Description</label>
                    <textarea name="description" rows="3" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-800 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">{{ old('description', $maintenance->description) }}</textarea>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Cost ($)</label>
                        <input type="number" step="0.01" name="cost" value="{{ old('cost', $maintenance->cost) }}" required class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-800 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Status</label>
                        <select name="status" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-800 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                            @foreach(['scheduled', 'in_progress', 'completed'] as $status)
                                <option value="{{ $status }}" {{ $maintenance->status == $status ? 'selected' : '' }}>{{ ucfirst(str_replace('_', ' ', $status)) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="mt-6 flex gap-3">
                <button type="submit" class="rounded-lg bg-slate-700 px-6 py-2 font-semibold text-white shadow-sm transition hover:bg-slate-800">Update Maintenance</button>
                <a href="{{ route('maintenances.index') }}" class="rounded-lg bg-slate-600 px-6 py-2 font-semibold text-white shadow-sm transition hover:bg-slate-700">Cancel</a>
            </div>
        </form>
    </div>
@endsection
