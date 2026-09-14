@extends('layouts.app')

@section('title', 'Maintenance Details - Car Rental Management')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-slate-900">Maintenance Details</h1>
        <div class="flex items-center gap-2">
            <a href="{{ route('maintenances.edit', $maintenance) }}" class="rounded-lg bg-amber-500 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-amber-600">Edit</a>
            <a href="{{ route('maintenances.index') }}" class="rounded-lg bg-slate-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-700">Back</a>
        </div>
    </div>

    <div class="overflow-hidden rounded-xl border border-slate-300 bg-slate-200/80 shadow-md p-6 max-w-2xl">
        <dl class="grid grid-cols-2 gap-4">
            <div>
                <dt class="text-sm text-slate-500">Car</dt>
                <dd class="font-semibold">{{ $maintenance->car->full_name }}</dd>
            </div>
            <div>
                <dt class="text-sm text-slate-500">License Plate</dt>
                <dd class="font-semibold">{{ $maintenance->car->license_plate }}</dd>
            </div>
            <div>
                <dt class="text-sm text-slate-500">Scheduled Date</dt>
                <dd class="font-semibold">{{ $maintenance->scheduled_date->format('M d, Y') }}</dd>
            </div>
            <div>
                <dt class="text-sm text-slate-500">Completed Date</dt>
                <dd class="font-semibold">{{ $maintenance->completed_date?->format('M d, Y') ?? 'N/A' }}</dd>
            </div>
            <div>
                <dt class="text-sm text-slate-500">Type</dt>
                <dd class="font-semibold capitalize">{{ str_replace('_', ' ', $maintenance->type) }}</dd>
            </div>
            <div>
                <dt class="text-sm text-slate-500">Cost</dt>
                <dd class="font-semibold">${{ number_format($maintenance->cost, 2) }}</dd>
            </div>
            <div>
                <dt class="text-sm text-slate-500">Status</dt>
                <dd class="font-semibold capitalize">{{ str_replace('_', ' ', $maintenance->status) }}</dd>
            </div>
        </dl>
        @if($maintenance->description)
            <div class="mt-4">
                <dt class="text-sm text-slate-500">Description</dt>
                <dd class="mt-1">{{ $maintenance->description }}</dd>
            </div>
        @endif
    </div>
@endsection
