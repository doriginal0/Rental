<div>
    <!-- The whole future lies in uncertainty: live immediately. - Seneca -->
</div>


<?php $__env->startSection('title', 'Fleets - Car Rental Management'); ?>

<?php $__env->startSection('content'); ?>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Fleets</h1>
        <a href="<?php echo e(route('fleets.create')); ?>" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Add New Fleet</a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fleet Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Category</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total Cars</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Available Cars</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <?php $__empty_1 = true; $__currentLoopData = $fleets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fleet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="px-6 py-4">
                            <div class="font-semibold"><?php echo e($fleet->fleet_name); ?></div>
                        </td>
                        <td class="px-6 py-4"><?php echo e($fleet->category); ?></td>
                        <td class="px-6 py-4"><?php echo e($fleet->cars_count); ?></td>
                        <td class="px-6 py-4"><?php echo e($fleet->cars->where('status', 'available')->count()); ?></td>
                        <td class="px-6 py-4 space-x-2">
                            <a href="<?php echo e(route('fleets.show', $fleet)); ?>" class="text-blue-600 hover:underline">View</a>
                            <a href="<?php echo e(route('fleets.edit', $fleet)); ?>" class="text-yellow-700 hover:underline">Edit</a>
                            <form action="<?php echo e(route('fleets.destroy', $fleet)); ?>" method="POST" class="inline" onsubmit="return confirm('Delete this fleet?')">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">No fleets found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        <?php echo e($fleets->links()); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\WEB\car-rental-app\resources\views/fleets/index.blade.php ENDPATH**/ ?>