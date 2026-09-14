@extends('layouts.app')

@section('title', 'Edit Fleet - Car Rental Management')

@section('content')
    <div class="mb-6">
        <h1 class="text-3xl font-bold">Edit Fleet</h1>
        <p class="mt-1 text-sm text-gray-500">
            Update the fleet information below.
        </p>
    </div>

    <div class="max-w-2xl rounded-lg bg-white p-6 shadow">
        <form action="{{ route('fleets.update', $fleet) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="space-y-5">
                <div>
                    <label for="fleet_name" class="mb-1 block text-sm font-medium text-gray-700">
                        Fleet Name
                    </label>

                    <input
                        id="fleet_name"
                        type="text"
                        name="fleet_name"
                        value="{{ old('fleet_name', $fleet->fleet_name) }}"
                        maxlength="50"
                        required
                        class="w-full rounded border px-3 py-2 @error('fleet_name') border-red-500 @enderror"
                    >

                    @error('fleet_name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="category" class="mb-1 block text-sm font-medium text-gray-700">
                        Category
                    </label>

                    <input
                        id="category"
                        type="text"
                        name="category"
                        value="{{ old('category', $fleet->category) }}"
                        maxlength="100"
                        placeholder="For example: Commercial or Touristic"
                        class="w-full rounded border px-3 py-2 @error('category') border-red-500 @enderror"
                    >

                    @error('category')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="description" class="mb-1 block text-sm font-medium text-gray-700">
                        Description
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        rows="4"
                        maxlength="200"
                        class="w-full rounded border px-3 py-2 @error('description') border-red-500 @enderror"
                    >{{ old('description', $fleet->description) }}</textarea>

                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-6 flex gap-3">
                <button
                    type="submit"
                    class="rounded bg-blue-600 px-6 py-2 text-white hover:bg-blue-700"
                >
                    Update Fleet
                </button>

                <a
                    href="{{ route('fleets.index') }}"
                    class="rounded bg-gray-200 px-6 py-2 text-gray-700 hover:bg-gray-300"
                >
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection
