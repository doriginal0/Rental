<?php $__env->startSection('title', 'Finance - Car Rental Management'); ?>

<?php $__env->startSection('content'); ?>
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-slate-900">Finance Ledger</h1>
            <p class="text-slate-600 text-sm mt-1">Revenue, payouts and expenses</p>
        </div>
        <a href="<?php echo e(route('payments.create')); ?>" class="rounded-lg bg-slate-700 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800">+ Add Entry</a>
    </div>

    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
        <div class="overflow-hidden rounded-xl border border-slate-300 bg-slate-200/80 shadow-md p-6 border-l-4 border-green-500">
            <p class="text-sm font-medium text-slate-600">Total Revenue</p>
            <p class="text-3xl font-bold text-slate-900 text-emerald-700">$<?php echo e(number_format($totalRevenue, 2)); ?></p>
        </div>
        <div class="overflow-hidden rounded-xl border border-slate-300 bg-slate-200/80 shadow-md p-6 border-l-4 border-red-500">
            <p class="text-sm font-medium text-slate-600">Total Expenses</p>
            <p class="text-3xl font-bold text-slate-900 text-rose-600">$<?php echo e(number_format($totalExpenses, 2)); ?></p>
        </div>
        <div class="overflow-hidden rounded-xl border border-slate-300 bg-slate-200/80 shadow-md p-6 border-l-4 <?php echo e($net >= 0 ? 'border-green-500' : 'border-red-500'); ?>">
            <p class="text-sm font-medium text-slate-600">Net Profit</p>
            <p class="text-3xl font-bold text-slate-900 <?php echo e($net >= 0 ? 'text-emerald-700' : 'text-rose-600'); ?>">
                $<?php echo e(number_format($net, 2)); ?>

            </p>
        </div>
    </div>

    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <div class="overflow-hidden rounded-xl border border-slate-300 bg-slate-200/80 shadow-md">
            <h2 class="whitespace-nowrap px-3 py-2.5 font-semibold text-lg bg-green-50 text-green-800">Money In</h2>
            <table class="min-w-full text-sm">
                <tbody class="divide-y divide-slate-300/80 bg-slate-100/80">
                    <tr class="transition-colors hover:bg-white/80">
                        <td class="px-6 py-3">Booking Revenue</td>
                        <td class="px-6 py-3 text-right font-semibold">$<?php echo e(number_format($bookingRevenue, 2)); ?></td>
                    </tr>
                    <tr class="transition-colors hover:bg-white/80">
                        <td class="px-6 py-3">Miscellaneous Income</td>
                        <td class="px-6 py-3 text-right font-semibold">$<?php echo e(number_format($miscIncome, 2)); ?></td>
                    </tr>
                    <tr class="bg-slate-700 text-slate-200 font-bold">
                        <td class="px-6 py-3">Total</td>
                        <td class="px-6 py-3 text-right text-green-700">$<?php echo e(number_format($totalRevenue, 2)); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="overflow-hidden rounded-xl border border-slate-300 bg-slate-200/80 shadow-md">
            <h2 class="whitespace-nowrap px-3 py-2.5 font-semibold text-lg bg-red-50 text-red-800">Money Out</h2>
            <table class="min-w-full text-sm">
                <tbody class="divide-y divide-slate-300/80 bg-slate-100/80">
                    <tr class="transition-colors hover:bg-white/80">
                        <td class="px-6 py-3">Driver Payouts</td>
                        <td class="px-6 py-3 text-right font-semibold">$<?php echo e(number_format($driverPayouts, 2)); ?></td>
                    </tr>
                    <tr class="transition-colors hover:bg-white/80">
                        <td class="px-6 py-3">Maintenance</td>
                        <td class="px-6 py-3 text-right font-semibold">$<?php echo e(number_format($maintenanceSpend, 2)); ?></td>
                    </tr>
                    <tr class="transition-colors hover:bg-white/80">
                        <td class="px-6 py-3">Miscellaneous Expenses</td>
                        <td class="px-6 py-3 text-right font-semibold">$<?php echo e(number_format($miscExpense, 2)); ?></td>
                    </tr>
                    <tr class="bg-slate-700 text-slate-200 font-bold">
                        <td class="px-6 py-3">Total</td>
                        <td class="px-6 py-3 text-right text-red-700">$<?php echo e(number_format($totalExpenses, 2)); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="overflow-hidden rounded-xl border border-slate-300 bg-slate-200/80 shadow-md mb-8">
        <h2 class="whitespace-nowrap px-3 py-2.5 font-semibold text-lg bg-yellow-50 text-yellow-800">
            Income
            <span class="ml-2 text-sm font-normal">(detailed)</span>
            </h2>
             <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-300/80 bg-slate-100/80 text-sm">
                <thead class="bg-slate-700 text-slate-200">
                    <tr class="transition-colors hover:bg-white/80">
                        <th class="whitespace-nowrap px-3 py-2.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-200">Booking time</th>
                        <th class="whitespace-nowrap px-3 py-2.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-200">Customer</th>
                        <th class="whitespace-nowrap px-3 py-2.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-200">Amount</th>
                    </tr>
                    </thead>
            <tbody class="divide-y divide-slate-300/80 bg-slate-100/80">
                    <?php $__empty_1 = true; $__currentLoopData = $bookingRevenue_s; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking_s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="transition-colors hover:bg-white/80">
                            <td class="whitespace-nowrap px-3 py-2.5"><?php echo e($booking_s->pickup_datetime); ?></td>
                            <td class="whitespace-nowrap px-3 py-2.5"><?php echo e($booking_s->customer?->full_name ?? '-'); ?></td>
                            <td class="whitespace-nowrap px-3 py-2.5 font-semibold text-emerald-700"><?php echo e(number_format($booking_s->total_cost, 2)); ?> DZD</td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr class="transition-colors hover:bg-white/80">
                            <td colspan="5" class="whitespace-nowrap px-3 py-2.5 text-center text-slate-500">No income.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
    
    <div class="overflow-hidden rounded-xl border border-slate-300 bg-slate-200/80 shadow-md mb-8">
        <h2 class="whitespace-nowrap px-3 py-2.5 font-semibold text-lg bg-yellow-50 text-yellow-800">
            Pending Bookings
            <span class="ml-2 text-sm font-normal">(not yet counted as revenue)</span>
            
        </h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-300/80 bg-slate-100/80 text-sm">
                <thead class="bg-slate-700 text-slate-200">
                    <tr class="transition-colors hover:bg-white/80">
                        <th class="whitespace-nowrap px-3 py-2.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-200">Customer</th>
                        <th class="whitespace-nowrap px-3 py-2.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-200">Car</th>
                        <th class="whitespace-nowrap px-3 py-2.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-200">Pickup</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-slate-600 uppercase">Total</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-slate-600 uppercase">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-300/80 bg-slate-100/80">
                    <?php $__empty_1 = true; $__currentLoopData = $pendingBookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="transition-colors hover:bg-white/80">
                            <td class="whitespace-nowrap px-3 py-2.5"><?php echo e($booking->customer?->full_name ?? '—'); ?></td>
                            <td class="whitespace-nowrap px-3 py-2.5"><?php echo e($booking->car?->full_name ?? '—'); ?></td>
                            <td class="whitespace-nowrap px-3 py-2.5"><?php echo e($booking->pickup_datetime?->format('M d, Y H:i')); ?></td>
                            <td class="whitespace-nowrap px-3 py-2.5 text-right font-semibold">$<?php echo e(number_format($booking->total_cost, 2)); ?></td>
                            
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr class="transition-colors hover:bg-white/80">
                            <td colspan="5" class="whitespace-nowrap px-3 py-2.5 text-center text-slate-500">No pending bookings.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    
    <div class="overflow-hidden rounded-xl border border-slate-300 bg-slate-200/80 shadow-md">
        <h2 class="whitespace-nowrap px-3 py-2.5 font-semibold text-lg">Miscellaneous Entries</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-300/80 bg-slate-100/80 text-sm">
                <thead class="bg-slate-700 text-slate-200">
                    <tr class="transition-colors hover:bg-white/80">
                        <th class="whitespace-nowrap px-3 py-2.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-200">Date</th>
                        <th class="whitespace-nowrap px-3 py-2.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-200">Description</th>
                        <th class="whitespace-nowrap px-3 py-2.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-200">Type</th>
                        <th class="whitespace-nowrap px-3 py-2.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-200">Method</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-slate-600 uppercase">Amount</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-slate-600 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-300/80 bg-slate-100/80">
                    <?php $__empty_1 = true; $__currentLoopData = $miscEntries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $entry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="transition-colors hover:bg-white/80">
                            <td class="whitespace-nowrap px-3 py-2.5"><?php echo e($entry->created_at->format('M d, Y')); ?></td>
                            <td class="whitespace-nowrap px-3 py-2.5"><?php echo e($entry->description ?? '—'); ?></td>
                            <td class="whitespace-nowrap px-3 py-2.5">
                                <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-semibold <?php echo e($entry->isIncome() ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700'); ?>">
                                    <?php echo e(ucfirst($entry->type)); ?>

                                </span>
                            </td>
                            <td class="whitespace-nowrap px-3 py-2.5 capitalize"><?php echo e($entry->method ? str_replace('_', ' ', $entry->method) : '—'); ?></td>
                            <td class="whitespace-nowrap px-3 py-2.5 text-right font-semibold <?php echo e($entry->isIncome() ? 'text-green-700' : 'text-red-700'); ?>">
                                <?php echo e($entry->isIncome() ? '+' : '-'); ?>$<?php echo e(number_format($entry->amount, 2)); ?>

                            </td>
                            <td class="whitespace-nowrap px-3 py-2.5 text-right flex items-center gap-2 whitespace-nowrap">
                                <a href="<?php echo e(route('payments.edit', $entry)); ?>" class="text-amber-600 hover:text-amber-800 hover:underline">Edit</a>
                                <form action="<?php echo e(route('payments.destroy', $entry)); ?>" method="POST" class="inline" onsubmit="return confirm('Delete this entry?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="text-rose-600 hover:text-rose-800 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr class="transition-colors hover:bg-white/80">
                            <td colspan="6" class="whitespace-nowrap px-3 py-2.5 text-center text-slate-500">No miscellaneous entries yet.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\WEB\car-rental-app\resources\views/payments/index.blade.php ENDPATH**/ ?>