<?php $__env->startSection('title', 'New Booking - Car Rental Management'); ?>

<?php $__env->startSection('content'); ?>
    <h1 class="text-3xl font-bold mb-6">Edit Booking</h1>

    <div class="bg-white rounded-lg shadow p-6 max-w-2xl">
        <?php if($errors->any()): ?>
                <div class="mb-5 p-4 bg-red-50 border border-red-200 rounded-md">
                    <ul class="list-disc text-sm text-red-600 pl-4 space-y-1">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>
        <form action="<?php echo e(route('bookings.update', $booking)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="grid grid-cols-1 gap-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Car</label>
                    <select name="car_id" id="car_id" required class="w-full border rounded px-3 py-2" 
                    onchange="if(this.value === 'add_car') { window.location.href = '<?php echo e(route('cars.create')); ?>'; }">
                        <option value="">Select a car</option>
                        <?php $__currentLoopData = $cars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $car): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($car->id); ?>" <?php echo e($booking->car_id == $car->id ? 'selected' : ''); ?> data-rate="<?php echo e($car->daily_rate); ?>">
                                <?php echo e($car->full_name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <option value="add_car">
                                ..Add new car..
                        </option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Daily Rate</label>
                    <input type='number' name="daily_rate" id="daily_rate" class="w-20 border rounded px-3 py-2" value="<?php echo e($booking->daily_rate); ?>"  data-manual="1"> / Day
                    
                </div>
                </div>
                
                <div class="flex items-center gap-2 mb-1">
                    <input type="checkbox" id="has_driver" class="w-4 h-4 text-blue-600 border-gray-300 rounded" <?php echo e($booking->driver_id ? 'checked' : ''); ?>>
                    <label for="has_driver" class="text-sm font-medium text-gray-700">Include a driver</label>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 <?php if(!$booking->driver_id): ?> opacity-50 <?php endif; ?>" id="driver_section" >
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Driver (Optional)</label>
                    <select name="driver_id" id="driver_id" class="w-full border rounded px-3 py-2"
                    onchange="if(this.value === 'add_driver') { window.location.href = '<?php echo e(route('drivers.create')); ?>'; }" <?php if(!$booking->driver_id): ?> disabled <?php endif; ?>>
                        <option value="">Select a driver</option>
                        <?php $__currentLoopData = $drivers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $driver): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($driver->id); ?>" <?php echo e($booking->driver_id == $driver->id ? 'selected' : ''); ?> data-rate="<?php echo e($driver->driver_daily_rate); ?>">
                                <?php echo e($driver->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <option value="add_driver">
                                ..Add new driver..
                        </option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Driver Daily Rate</label>
                    <input type='number' name="driver_daily_rate" id="driver_daily_rate" class="w-20 border rounded px-3 py-2" value='<?php echo e($booking->driver_daily_rate); ?>'  data-manual="1" <?php if(!$booking->driver_id): ?> disabled <?php endif; ?>> / Day
                    
                </div>
                
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Customer</label>
                    <select name="customer_id" required class="w-full border rounded px-3 py-2"
                    onchange="if(this.value === 'add_customer') { window.location.href = '<?php echo e(route('customers.create')); ?>'; }">
                        <option value="">Select a customer</option>
                        <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($customer->id); ?>" <?php echo e($booking->customer_id == $customer->id ? 'selected' : ''); ?>>
                                <?php echo e($customer->full_name); ?> - <?php echo e($customer->email); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <option value="add_customer">
                                ..Add new customer..
                        </option>
                    </select>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pickup Date & Time</label>
                        <input type="datetime-local" id="pickup_datetime" name="pickup_datetime" value="<?php echo e($booking->pickup_datetime->format('Y-m-d\TH:i')); ?>" required class="w-full border rounded px-3 py-2">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Return Date & Time</label>
                        <input type="datetime-local" name="return_datetime" id="return_datetime" value="<?php echo e($booking->return_datetime->format('Y-m-d\TH:i')); ?>" required class="w-full border rounded px-3 py-2">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Payment Amount</label>
                    <input type='number' name="total_cost" id="total_cost" class="w-full border rounded px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Payment Method</label>
                    <select name="method" class="w-full border rounded px-3 py-2">
                    
                        <option value="cash "<?php echo e($booking->method == 'cash' ? 'selected' : ''); ?>>Cash</option>
                        <option  value="card" <?php echo e($booking->method == 'card' ? 'selected' : ''); ?>>Card</option>
                        <option value="bank_transfer" <?php echo e($booking->method == 'bank_transfer' ? 'selected' : ''); ?>>Bank Transfer</option>
                        <option value="online" <?php echo e($booking->method == 'online' ? 'selected' : ''); ?>>Online</option>


                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" class="w-full border rounded px-3 py-2">
                        <?php $__currentLoopData = ['pending', 'confirmed', 'active', 'completed', 'cancelled']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($status); ?>" <?php echo e($booking->status == $status ? 'selected' : ''); ?>><?php echo e(ucfirst($status)); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
                    <textarea name="notes" rows="3" class="w-full border rounded px-3 py-2"><?php echo e(old('notes')); ?></textarea>
                </div>
                
            </div>
            <div class="mt-6 flex gap-3">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Edit Booking</button>
                <a href="<?php echo e(route('bookings.index')); ?>" class="bg-gray-300 text-gray-700 px-6 py-2 rounded hover:bg-gray-400">Cancel</a>
            </div>
        </form>
    </div>
    <script>
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
        // Auto-calculate total cost = daily_rate × days
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

        dailyRateInput.dataset.manual = '1';
        DriverdailyRateInput.dataset.manual = '1';
        calculate();
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\WEB\car-rental-app\resources\views/bookings/edit.blade.php ENDPATH**/ ?>