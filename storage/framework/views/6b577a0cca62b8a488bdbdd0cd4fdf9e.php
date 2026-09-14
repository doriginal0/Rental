<?php $__env->startSection('title', 'Dashboard - Car Rental Management'); ?>

<?php $__env->startSection('content'); ?>
    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
    <div>
        <p class="text-sm font-semibold uppercase tracking-widest text-blue-600">
            Fleet overview
        </p>

        <h1 class="mt-2 text-3xl font-bold tracking-tight text-slate-950 sm:text-4xl">
            Dashboard
        </h1>

        <p class="mt-2 max-w-2xl text-sm text-slate-500">
            Monitor your vehicles, bookings, customers, and revenue from one place.
        </p>
    </div>

    <div class="flex items-center gap-2 text-sm text-slate-500">
        <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
        System operational
    </div>
</div>
    
    <div class="grid grid-cols-1 gap-8 lg:items-start lg:grid-cols-[minmax(0,0.5fr)_minmax(0,1fr)_220px]">
    <!-- My Fleet -->
    <div class="overflow-hidden rounded-xl border border-slate-300 bg-slate-200/80 shadow-md">
        <div class="border-b border-slate-400/70 bg-slate-800 px-4 py-3">
            <h2 class="text-sm font-semibold tracking-wide text-slate-100">
                My Fleet
            </h2>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm text-slate-700">
                <thead class="bg-slate-700 text-xs uppercase tracking-wider text-slate-200">
                    <tr>
                        <th class="px-3 py-2.5 font-semibold">Fleet Name</th>
                        <th class="px-3 py-2.5 font-semibold">Total Vehicles</th>
                        <th class="px-3 py-2.5 font-semibold">Available</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-300/80 bg-slate-100/80">
                    <?php $__empty_1 = true; $__currentLoopData = $fleets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fleet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="transition-colors hover:bg-white/80">
                            <td class="whitespace-nowrap px-3 py-2.5 font-semibold text-slate-800">
                                <?php echo e($fleet->fleet_name); ?>

                            </td>

                            <td class="whitespace-nowrap px-3 py-2.5 text-slate-700">
                                <?php echo e($fleet->cars_count); ?>

                            </td>

                            <td class="whitespace-nowrap px-3 py-2.5 text-slate-700">
                                <?php echo e($fleet->cars->where('status', 'available')->count()); ?>

                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="3" class="px-3 py-6 text-center text-sm text-slate-500">
                                No fleets available
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

        <!-- Recent Bookings -->
        <div class="overflow-hidden rounded-xl border border-slate-300 bg-slate-200/80 shadow-md">
    <div class="border-b border-slate-400/70 bg-slate-800 px-4 py-3">
        <h2 class="text-sm font-semibold tracking-wide text-slate-100">
            Recent Bookings
        </h2>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full text-left text-sm text-slate-700">
            <thead class="bg-slate-700 text-xs uppercase tracking-wider text-slate-200">
                <tr>
                    <th class="px-3 py-2.5 font-semibold">Customer</th>
                    <th class="px-3 py-2.5 font-semibold">Car</th>
                    <th class="px-3 py-2.5 font-semibold">Status</th>
                    <th class="px-3 py-2.5 text-right font-semibold">Amount</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-slate-300/80 bg-slate-100/80">
                <?php $__empty_1 = true; $__currentLoopData = $recentBookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="transition-colors hover:bg-white/80">
                        <td class="whitespace-nowrap px-3 py-2.5 font-medium text-slate-800">
                            <?php echo e($booking->customer->full_name); ?>

                        </td>

                        <td class="whitespace-nowrap px-3 py-2.5 text-slate-600">
                            <?php echo e($booking->car->full_name); ?>

                        </td>

                        <td class="px-3 py-2.5">
                            <span class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                'inline-flex rounded-full px-2 py-0.5 text-xs font-semibold',
                                'bg-emerald-100 text-emerald-800' => $booking->status === 'active',
                                'bg-amber-100 text-amber-800' => $booking->status === 'pending',
                                'bg-blue-100 text-blue-800' => $booking->status === 'completed',
                                'bg-rose-100 text-rose-800' => $booking->status === 'cancelled',
                                'bg-slate-200 text-slate-700' => !in_array(
                                    $booking->status,
                                    ['active', 'pending', 'completed', 'cancelled']
                                ),
                            ]); ?>">
                                <?php echo e(ucfirst($booking->status)); ?>

                            </span>
                        </td>

                        <td class="whitespace-nowrap px-3 py-2.5 text-right font-semibold text-slate-800">
                            $<?php echo e(number_format($booking->total_cost, 2)); ?>

                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="4" class="px-3 py-6 text-center text-sm text-slate-500">
                            No recent bookings found.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
         
        <div class="order-first relative min-w-0 lg:order-none">
    <div class="flex w-full flex-col gap-2">

        <a href="<?php echo e(route('cars.create')); ?>"
           class="inline-flex w-full items-center justify-left rounded-lg bg-slate-600 px-4 py-2.5 text-sm font-semibold text-slate-100 shadow-md transition lg:rounded-l-lg lg:w-100 hover:bg-slate-700">
            New vehicle
        </a>

        <a href="<?php echo e(route('bookings.create')); ?>"
           class="inline-flex w-full items-center justify-left rounded-lg bg-slate-600 px-4 py-2.5 text-sm font-semibold text-slate-100 shadow-md transition lg:rounded-l-lg lg:w-100 hover:bg-slate-700">
            New booking
        </a>

        <a href="<?php echo e(route('customers.create')); ?>"
           class="inline-flex w-full items-center justify-left rounded-lg bg-slate-600 px-4 py-2.5 text-sm font-semibold text-slate-100 shadow-md transition lg:rounded-l-lg lg:w-100 hover:bg-slate-700">
            New Customer
        </a>

        <a href="<?php echo e(route('fleets.index')); ?>"
           class="inline-flex w-full items-center justify-left rounded-lg bg-slate-600 px-4 py-2.5 text-sm font-semibold text-slate-100 shadow-md transition lg:rounded-l-lg lg:w-100 hover:bg-slate-700">
            Manage My Fleets
        </a>

        <a href="<?php echo e(route('maintenances.create')); ?>"
           class="inline-flex w-full items-center justify-left rounded-lg bg-slate-600 px-4 py-2.5 text-sm font-semibold text-slate-100 shadow-md transition lg:rounded-l-lg lg:w-100 hover:bg-slate-700">
            Schedule maintenance
        </a>

    </div>
</div>
</div>
        
<div class="grid grid-cols-1 gap-8 lg:items-start lg:grid-cols-[minmax(0,0.75fr)_minmax(0,0.75fr)]">
  
    
 
<?php
    $leading = \Carbon\Carbon::parse(array_key_first($days))->dayOfWeek;
?>

<div class="mt-8 overflow-hidden rounded-xl border border-slate-300 bg-slate-200/80 shadow-md">
    <div class="flex items-center justify-between border-b border-slate-400/70 bg-slate-800 px-4 py-3">
        <h2 class="text-sm font-semibold tracking-wide text-slate-100">
            Booking Calendar
        </h2>

        <div class="flex items-center gap-2 text-sm">
            <a href="<?php echo e(route('dashboard', ['month' => $prevMonth])); ?>"
               class="rounded-md border border-slate-500 bg-slate-700 px-2.5 py-1 text-slate-100 transition hover:bg-slate-600">
                &larr;
            </a>

            <span class="min-w-[90px] text-center font-medium text-slate-200">
                <?php echo e($month->format('F Y')); ?>

            </span>

            <a href="<?php echo e(route('dashboard', ['month' => $nextMonth])); ?>"
               class="rounded-md border border-slate-500 bg-slate-700 px-2.5 py-1 text-slate-100 transition hover:bg-slate-600">
                &rarr;
            </a>
        </div>
    </div>

    <div class="p-4">
        <div class="mb-1 grid grid-cols-7 gap-1 text-center text-[11px] font-semibold uppercase tracking-wide text-slate-500">
            <?php $__currentLoopData = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="py-1"><?php echo e($d); ?></div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="grid grid-cols-7 gap-1">
            <?php for($i = 0; $i < $leading; $i++): ?>
                <div class="min-h-[80px] rounded-md border border-slate-200 bg-slate-300/40"></div>
            <?php endfor; ?>

            <?php $__currentLoopData = $days; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date => $entries): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="min-h-[80px] rounded-md border p-1 transition-colors hover:bg-white/70
                    <?php echo e($date === now()->toDateString()
                        ? 'border-slate-500 bg-slate-300/80 ring-1 ring-slate-400'
                        : 'border-slate-300/80 bg-slate-100/80'); ?>">

                    <div class="mb-1 text-xs font-semibold text-slate-600">
                        <?php echo e((int) \Carbon\Carbon::parse($date)->format('j')); ?>

                    </div>

                    <div class="space-y-0.5">
                        <?php $__currentLoopData = array_slice($entries, 0, 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="truncate rounded px-1 py-0.5 text-[10px] leading-tight text-white shadow-sm"
                                 style="background-color: <?php echo e($e['color']); ?>"
                                 title="<?php echo e($e['car']); ?>">
                                <?php echo e($e['car']); ?>

                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <?php if(count($entries) > 3): ?>
                            <div class="text-[10px] font-medium text-slate-500">
                                +<?php echo e(count($entries) - 3); ?> more
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="mt-4 flex flex-wrap gap-3 border-t border-slate-300/80 pt-3 text-xs text-slate-600">
            <?php $__currentLoopData = $legend; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $car): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <span class="flex items-center gap-1.5">
                    <span class="inline-block h-2.5 w-2.5 rounded-full shadow-sm"
                          style="background-color: <?php echo e($car['color']); ?>"></span>
                    <?php echo e($car['name']); ?>

                </span>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<div class="mt-8 overflow-hidden rounded-xl border border-slate-300 bg-slate-200/80 shadow-md">
    <div class="border-b border-slate-400/70 bg-slate-800 px-4 py-3">
        <h2 class="text-sm font-semibold tracking-wide text-slate-100">
            Recent Maintenance
        </h2>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full text-left text-sm text-slate-700">
            <thead class="bg-slate-700 text-xs uppercase tracking-wider text-slate-200">
                <tr>
                    <th class="px-3 py-2.5 font-semibold">Car</th>
                    <th class="px-3 py-2.5 font-semibold">Scheduled At</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-slate-300/80 bg-slate-100/80">
                <?php $__empty_1 = true; $__currentLoopData = $recentMains; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mains): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="transition-colors hover:bg-white/80">
                        <td class="whitespace-nowrap px-3 py-2.5 font-medium text-slate-800">
                            <?php echo e($mains->car->full_name); ?>

                        </td>

                        <td class="whitespace-nowrap px-3 py-2.5 text-slate-600">
                            <?php echo e($mains->scheduled_date); ?>

                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="2" class="px-3 py-6 text-center text-sm text-slate-500">
                            No recent maintenance scheduled.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
</div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\WEB\car-rental-app\resources\views/dashboard.blade.php ENDPATH**/ ?>