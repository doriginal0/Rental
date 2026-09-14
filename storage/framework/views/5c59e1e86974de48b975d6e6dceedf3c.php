<?php $__env->startSection('title', 'Cars - Car Rental Management'); ?>

<?php $__env->startSection('content'); ?>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-slate-900">Drivers</h1>
        <a href="<?php echo e(route('drivers.create')); ?>" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">+ Add Driver</a>
    </div>

    <div class="overflow-hidden rounded-xl border border-slate-300 bg-slate-200/80 shadow-md">
        <table class="min-w-full divide-y divide-slate-300/80 bg-slate-100/80">
            <thead class="bg-slate-700 text-slate-200">
                <tr class="transition-colors hover:bg-white/80">
                    <th class="whitespace-nowrap px-3 py-2.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-200">Name</th>
                    <th class="whitespace-nowrap px-3 py-2.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-200">License Number</th>
                    <th class="whitespace-nowrap px-3 py-2.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-200">License Expiry</th>
                    <th class="whitespace-nowrap px-3 py-2.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-200">Daily Rate</th>
                    <th class="whitespace-nowrap px-3 py-2.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-200">Status</th>
                    <th class="whitespace-nowrap px-3 py-2.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-200">Bookings</th>
                    <th class="whitespace-nowrap px-3 py-2.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-200">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-300/80 bg-slate-100/80">
                <?php $__empty_1 = true; $__currentLoopData = $drivers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $driver): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="transition-colors hover:bg-white/80">
                        <td class="whitespace-nowrap px-3 py-2.5">
                            <div class="font-semibold"><?php echo e($driver->name); ?></div>
                        </td>
                        <td class="whitespace-nowrap px-3 py-2.5"><?php echo e($driver->license_number); ?></td>
                        <td class="whitespace-nowrap px-3 py-2.5"><?php echo e($driver->license_expiry?->format('d M Y') ?? 'N/A'); ?></td>
                        <td class="whitespace-nowrap px-3 py-2.5"><?php echo e($driver->driver_daily_rate ?? 'N/A'); ?></td>
                        <td class="whitespace-nowrap px-3 py-2.5">
                            <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-semibold 
                                <?php if($driver->status == 'available'): ?> bg-emerald-100 text-emerald-700
                                <?php elseif($driver->status == 'hired'): ?> bg-orange-100 text-orange-700
                                <?php else: ?> bg-slate-200 text-slate-700 <?php endif; ?>">
                                <?php echo e(ucfirst($driver->status)); ?>

                            </span>
                        </td>
                        <td class="whitespace-nowrap px-3 py-2.5"><?php echo e($driver->bookings_count); ?></td>
                        <td class="whitespace-nowrap px-3 py-2.5 flex items-center gap-2">
                            <a href="<?php echo e(route('drivers.show', $driver)); ?>" class="text-slate-600 hover:text-slate-900 hover:underline">View</a>
                            <a href="<?php echo e(route('drivers.edit', $driver)); ?>" class="text-amber-600 hover:text-amber-800 hover:underline">Edit</a>
                            <form action="<?php echo e(route('drivers.destroy', $driver)); ?>" method="POST" class="inline" onsubmit="return confirm('Delete this driver?')">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="text-rose-600 hover:text-rose-800 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr class="transition-colors hover:bg-white/80">
                        <td colspan="6" class="whitespace-nowrap px-3 py-2.5 text-center text-slate-500">No drivers found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        <?php echo e($drivers->links()); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\WEB\car-rental-app\resources\views/drivers/index.blade.php ENDPATH**/ ?>