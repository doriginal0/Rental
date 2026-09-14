<?php $__env->startSection('title', 'Booking Details - Car Rental Management'); ?>

<?php $__env->startSection('content'); ?>
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-3xl font-bold text-slate-900">
            Booking #<?php echo e($booking->id); ?>

        </h1>

        <div class="flex items-center gap-2">
            <a href="<?php echo e(route('bookings.edit', $booking)); ?>"
               class="rounded-lg bg-amber-500 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-amber-600">
                Edit
            </a>

            <a href="<?php echo e(route('bookings.index')); ?>"
               class="rounded-lg bg-slate-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-700">
                Back
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        
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
                            <?php echo e($booking->car->full_name); ?>

                        </dd>
                    </div>

                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">Customer</dt>
                        <dd class="mt-1 font-semibold text-slate-800">
                            <?php echo e($booking->customer->full_name); ?>

                        </dd>
                    </div>

                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">Pickup</dt>
                        <dd class="mt-1 font-semibold text-slate-800">
                            <?php echo e($booking->pickup_datetime->format('M d, Y H:i')); ?>

                        </dd>
                    </div>

                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">Return</dt>
                        <dd class="mt-1 font-semibold text-slate-800">
                            <?php echo e($booking->return_datetime->format('M d, Y H:i')); ?>

                        </dd>
                    </div>

                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">Duration</dt>
                        <dd class="mt-1 font-semibold text-slate-800">
                            <?php echo e($booking->duration_in_days); ?> day(s)
                        </dd>
                    </div>

                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">Total Cost</dt>
                        <dd class="mt-1 font-semibold text-emerald-700">
                            $<?php echo e(number_format($booking->total_cost, 2)); ?>

                        </dd>
                    </div>

                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">Driver</dt>
                        <dd class="mt-1 font-semibold <?php echo e($booking->driver ? 'text-emerald-700' : 'text-red-600'); ?>">
                            <?php echo e($booking->driver?->name ?? 'No driver'); ?>

                        </dd>
                    </div>

                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">Status</dt>
                        <dd class="mt-1 font-semibold capitalize text-slate-800">
                            <?php echo e($booking->status); ?>

                        </dd>
                    </div>
                </dl>

                <?php if($booking->notes): ?>
                    <div class="mt-5 border-t border-slate-300 pt-4">
                        <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">
                            Notes
                        </dt>
                        <dd class="mt-1 text-sm text-slate-700">
                            <?php echo e($booking->notes); ?>

                        </dd>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        
        <div class="overflow-hidden rounded-xl border border-slate-300 bg-slate-200/80 shadow-md">
            <div class="border-b border-slate-400/70 bg-slate-800 px-4 py-3">
                <h2 class="text-sm font-semibold uppercase tracking-wide text-slate-100">
                    Payments
                </h2>
            </div>

            <?php if($booking->payments->count()): ?>
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
                            <?php $__currentLoopData = $booking->payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="transition-colors hover:bg-white/80">
                                    <td class="whitespace-nowrap px-3 py-2.5 font-semibold text-slate-900">
                                        $<?php echo e(number_format($payment->amount, 2)); ?>

                                    </td>

                                    <td class="whitespace-nowrap px-3 py-2.5 capitalize">
                                        <?php echo e(str_replace('_', ' ', $payment->method)); ?>

                                    </td>

                                    <td class="whitespace-nowrap px-3 py-2.5">
                                        <span class="inline-flex rounded-full bg-slate-200 px-2.5 py-1 text-xs font-semibold capitalize text-slate-700">
                                            <?php echo e($payment->status); ?>

                                        </span>
                                    </td>

                                    <td class="whitespace-nowrap px-3 py-2.5 text-slate-600">
                                        <?php echo e($payment->paid_at?->format('M d, Y') ?? 'Pending'); ?>

                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p class="p-5 text-sm text-slate-500">
                    No payments recorded for this booking.
                </p>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\WEB\car-rental-app\resources\views/bookings/show.blade.php ENDPATH**/ ?>