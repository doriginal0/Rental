<?php $__env->startSection('title', 'Customers - Car Rental Management'); ?>

<?php $__env->startSection('content'); ?>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-slate-900">Customers</h1>
        <a href="<?php echo e(route('customers.create')); ?>" class="rounded-lg bg-slate-700 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800">+ Add Customer</a>
    </div>

    <div class="overflow-hidden rounded-xl border border-slate-300 bg-slate-200/80 shadow-md">
        <table class="min-w-full divide-y divide-slate-300/80 bg-slate-100/80">
            <thead class="bg-slate-700 text-slate-200">
                <tr class="transition-colors hover:bg-white/80">
                    <th class="whitespace-nowrap px-3 py-2.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-200">Name</th>
                    <th class="whitespace-nowrap px-3 py-2.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-200">Email</th>
                    <th class="whitespace-nowrap px-3 py-2.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-200">Phone</th>
                    <th class="whitespace-nowrap px-3 py-2.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-200">License</th>
                    <th class="whitespace-nowrap px-3 py-2.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-200">Bookings</th>
                    <th class="whitespace-nowrap px-3 py-2.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-200">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-300/80 bg-slate-100/80">
                <?php $__empty_1 = true; $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="transition-colors hover:bg-white/80">
                        <td class="whitespace-nowrap px-3 py-2.5 font-semibold"><?php echo e($customer->full_name); ?></td>
                        <td class="whitespace-nowrap px-3 py-2.5"><?php echo e($customer->email); ?></td>
                        <td class="whitespace-nowrap px-3 py-2.5"><?php echo e($customer->phone ?? 'N/A'); ?></td>
                        <td class="whitespace-nowrap px-3 py-2.5"><?php echo e($customer->license_number ?? 'N/A'); ?></td>
                        <td class="whitespace-nowrap px-3 py-2.5"><?php echo e($customer->bookings_count); ?></td>
                        <td class="whitespace-nowrap px-3 py-2.5 flex items-center gap-2">
                            <a href="<?php echo e(route('customers.show', $customer)); ?>" class="text-slate-600 hover:text-slate-900 hover:underline">View</a>
                            <a href="<?php echo e(route('customers.edit', $customer)); ?>" class="text-amber-600 hover:text-amber-800 hover:underline">Edit</a>
                            <form action="<?php echo e(route('customers.destroy', $customer)); ?>" method="POST" class="inline" onsubmit="return confirm('Delete this customer?')">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="text-rose-600 hover:text-rose-800 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr class="transition-colors hover:bg-white/80">
                        <td colspan="6" class="whitespace-nowrap px-3 py-2.5 text-center text-slate-500">No customers found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        <?php echo e($customers->links()); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\WEB\car-rental-app\resources\views/customers/index.blade.php ENDPATH**/ ?>