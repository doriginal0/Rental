@extends('layouts.app')

@section('title', 'New Booking - Car Rental Management')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Create New Booking</h1>

    <div class="bg-white rounded-lg shadow p-6 max-w-2xl">
        @if ($errors->any())
                <div class="mb-5 p-4 bg-red-50 border border-red-200 rounded-md">
                    <ul class="list-disc text-sm text-red-600 pl-4 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        <form action="{{ route('bookings.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 gap-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Car</label>
                    <select name="car_id" id="car_id" required class="w-full border rounded px-3 py-2" 
                    onchange="if(this.value === 'add_car') { window.location.href = '{{ route('cars.create') }}'; }">
                        <option value="">Select a car</option>
                        @foreach($cars as $car)
                            <option value="{{ $car->id }}" data-rate="{{ $car->daily_rate }}">
                                {{ $car->full_name }} - ${{ number_format($car->daily_rate, 2) }}/day
                            </option>
                        @endforeach
                        <option value="add_car">
                                ..Add new car..
                        </option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Daily Rate</label>
                    <input type='number' name="daily_rate" id="daily_rate" class="w-20 border rounded px-3 py-2" value=''> / Day
                    
                </div>
                </div>
                <div class="flex items-center gap-2 mb-1">
                    <input type="checkbox" id="has_driver" class="w-4 h-4 green-600 text-green-600 border-gray-300 rounded">
                    <label for="has_driver" class="text-sm font-medium text-gray-700">Include a driver</label>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 transition-opacity" id="driver_section">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Driver (Optional)</label>
                    <select name="driver_id" id="driver_id" class="w-full border rounded px-3 py-2" disabled
                    onchange="if(this.value === 'add_driver') { window.location.href = '{{ route('drivers.create') }}'; }">
                        <option value="">Select a driver</option>
                        @foreach($drivers as $driver)
                            <option value="{{ $driver->id }}" {{ old('driver_id') == $driver->id ? 'selected' : '' }} data-rate="{{ $driver->driver_daily_rate }}">
                                {{ $driver->name }}
                            </option>
                        @endforeach
                        <option value="add_driver">
                                ..Add new driver..
                        </option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Driver Daily Rate</label>
                    <input type='number' name="driver_daily_rate" id="driver_daily_rate" class="w-20 border rounded px-3 py-2" value='' disabled> / Day
                    
                </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Customer</label>
                    <select name="customer_id" required class="w-full border rounded px-3 py-2"
                    onchange="if(this.value === 'add_customer') { window.location.href = '{{ route('customers.create') }}'; }">
                        <option value="">Select a customer</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                {{ $customer->full_name }} - {{ $customer->email }}
                            </option>
                        @endforeach
                        <option value="add_customer">
                                ..Add new customer..
                        </option>
                    </select>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pickup Date & Time</label>
                        <input type="datetime-local" id="pickup_datetime" name="pickup_datetime" value="{{ old('pickup_datetime') }}" required class="w-full border rounded px-3 py-2">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Return Date & Time</label>
                        <input type="datetime-local" name="return_datetime" id="return_datetime" value="{{ old('return_datetime') }}" required class="w-full border rounded px-3 py-2">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Payment Amount</label>
                    <input type='number' name="total_cost" id="total_cost" class="w-full border rounded px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Payment Method</label>
                    <select name="method" class="w-full border rounded px-3 py-2">
                        <option value="cash">Cash</option>
                        <option  value="card">Card</option>
                        <option value="bank_transfer">Bank Transfer</option>
                        <option value="online">Online</option>


                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
                    <textarea name="notes" rows="3" class="w-full border rounded px-3 py-2">{{ old('notes') }}</textarea>
                </div>
                
            </div>
            <div class="mt-6 flex gap-3">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Create Booking</button>
                <a href="{{ route('bookings.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded hover:bg-gray-400">Cancel</a>
            </div>
        </form>
    </div>
    <script>
        // Auto-calculate total cost = daily_rate × days

        const hasDriver = document.getElementById('has_driver');
        const driverSection = document.getElementById('driver_section');

        hasDriver.addEventListener('change', () => {
            
            const enabled = hasDriver.checked;

            driverSection.querySelectorAll('input, select').forEach(el => {el.disabled = !enabled});

            if (!enabled) {
        document.getElementById('driver_id').value = '';
        document.getElementById('driver_daily_rate').value = '';
        delete document.getElementById('driver_daily_rate').dataset.manual;
        
    }
        driverSection.classList.toggle('opacity-50', !enabled);
        calculate();
        })


        const carSelect = document.getElementById('car_id');
        const driverSelect = document.getElementById('driver_id');
const pickupInput = document.getElementById('pickup_datetime');
const returnInput = document.getElementById('return_datetime');
const dailyRateInput = document.getElementById('daily_rate');
const DriverdailyRateInput = document.getElementById('driver_daily_rate');
const totalCostInput = document.getElementById('total_cost');


            driverSelect.addEventListener('change', () => {
    delete DriverdailyRateInput.dataset.manual;
    // If "Select a driver" (empty) is chosen, clear the rate
    if (driverSelect.value === '') {
        DriverdailyRateInput.value = '';
    }
    calculate();
});

function calculate() {
            // Auto-fill rate from car ONLY if the user hasn't manually overridden it
            if (!dailyRateInput.dataset.manual) {
                const selected = carSelect.options[carSelect.selectedIndex];
                if (selected && selected.dataset.rate) {
                    dailyRateInput.value = selected.dataset.rate;
                }
            }

            if (!DriverdailyRateInput.dataset.manual) {
                const d_selected = driverSelect.options[driverSelect.selectedIndex];
                if (d_selected && d_selected.dataset.rate) {
                    DriverdailyRateInput.value = d_selected.dataset.rate;
                }
            }

            const pickup = new Date(pickupInput.value);
            const ret = new Date(returnInput.value);
            let days = 1;
            if (pickup && ret && ret > pickup) {
                const diffMs = ret - pickup;
                days = Math.max(1, Math.ceil(diffMs / (1000 * 60 * 60 * 24)));
            }

            const rate = parseFloat(dailyRateInput.value) || 0;
            const driver_rate = parseFloat(DriverdailyRateInput.value) || 0;
            totalCostInput.value = (days * (rate+driver_rate)).toFixed(2);
        }

        carSelect.addEventListener('change', () => {
            delete dailyRateInput.dataset.manual;  // picking a new car re-enables auto-fill
            calculate();
        });

        driverSelect.addEventListener('change', () => {
            delete DriverdailyRateInput.dataset.manual;  // picking a new car re-enables auto-fill
            calculate();
        });

        pickupInput.addEventListener('change', calculate);
        returnInput.addEventListener('change', calculate);

        // Mark as manually edited when the user types, then recalc
        dailyRateInput.addEventListener('input', () => {
            dailyRateInput.dataset.manual = '1';
            calculate();
        });
         DriverdailyRateInput.addEventListener('input', () => {
            DriverdailyRateInput.dataset.manual = '1';
            calculate();
        });

        calculate();
    </script>
@endsection
