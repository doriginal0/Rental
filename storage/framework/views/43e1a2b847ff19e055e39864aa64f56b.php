<?php $__env->startSection('title', $fleet->fleet_name . ' - Car Rental Management'); ?>

<?php $__env->startSection('content'); ?>
    <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <h1 class="text-3xl font-bold"><?php echo e($fleet->fleet_name); ?></h1>

            <?php if($fleet->category): ?>
                <p class="mt-1 text-gray-500"><?php echo e($fleet->category); ?></p>
            <?php endif; ?>
        </div>

        <div class="flex gap-2">
            <a
                href="<?php echo e(route('fleets.edit', $fleet)); ?>"
                class="rounded bg-yellow-500 px-4 py-2 text-white hover:bg-yellow-600"
            >
                Edit Fleet
            </a>

            <a
                href="<?php echo e(route('fleets.index')); ?>"
                class="rounded bg-gray-200 px-4 py-2 text-gray-700 hover:bg-gray-300"
            >
                Back
            </a>
        </div>
    </div>

    <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-3">
        <div class="rounded-lg bg-white p-5 shadow">
            <p class="text-sm text-gray-500">Total Cars</p>
            <p class="mt-1 text-2xl font-bold"><?php echo e($fleet->cars->count()); ?></p>
        </div>

        <div class="rounded-lg bg-white p-5 shadow">
            <p class="text-sm text-gray-500">Available Cars</p>
            <p class="mt-1 text-2xl font-bold">
                <?php echo e($fleet->cars->where('status', 'available')->count()); ?>

            </p>
        </div>

        <div class="rounded-lg bg-white p-5 shadow">
            <p class="text-sm text-gray-500">Unavailable Cars</p>
            <p class="mt-1 text-2xl font-bold">
                <?php echo e($fleet->cars->where('status', '!=', 'available')->count()); ?>

            </p>
        </div>
    </div>

    <?php if($fleet->description): ?>
        <div class="mb-6 rounded-lg bg-white p-6 shadow">
            <h2 class="mb-2 text-lg font-semibold">Description</h2>
            <p class="text-gray-600"><?php echo e($fleet->description); ?></p>
        </div>
    <?php endif; ?>

    <div class="overflow-hidden rounded-lg bg-white shadow">
        <div class="border-b px-6 py-4">
            <h2 class="text-lg font-semibold">Fleet Vehicles</h2>
        </div>

        <?php if($fleet->cars->isEmpty()): ?>
            <p class="px-6 py-8 text-center text-gray-500">
                No cars are assigned to this fleet.
            </p>
        <?php else: ?>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500">
                                Vehicle
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500">
                                License Plate
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500">
                                Daily Rate
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500">
                                Status
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                        <?php $__currentLoopData = $fleet->cars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $car): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <div class="font-medium text-gray-900">
                                        <?php echo e($car->make); ?> <?php echo e($car->model); ?>

                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <?php echo e($car->year); ?>

                                    </div>
                                </td>

                                <td class="whitespace-nowrap px-6 py-4 text-gray-700">
                                    <?php echo e($car->license_plate); ?>

                                </td>

                                <td class="whitespace-nowrap px-6 py-4 text-gray-700">
                                    $<?php echo e(number_format($car->daily_rate, 2)); ?>

                                </td>

                                <td class="whitespace-nowrap px-6 py-4">
                                    <span class="rounded-full px-3 py-1 text-xs font-semibold
                                        <?php if($car->status === 'available'): ?>
                                            bg-green-100 text-green-800
                                        <?php elseif($car->status === 'rented'): ?>
                                            bg-blue-100 text-blue-800
                                        <?php elseif($car->status === 'maintenance'): ?>
                                            bg-yellow-100 text-yellow-800
                                        <?php else: ?>
                                            bg-gray-100 text-gray-800
                                        <?php endif; ?>
                                    ">
                                        <?php echo e(ucfirst($car->status)); ?>

                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\WEB\car-rental-app\resources\views/fleets/show.blade.php ENDPATH**/ ?>