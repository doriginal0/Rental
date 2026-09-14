<?php $__env->startSection('title', 'Profile Information'); ?>

<?php $__env->startSection('content'); ?>

<h1 class="text-3xl font-bold text-slate-900 mb-6 text-center">Current Profile : <?php echo e(Auth()->user()->company_name); ?></h1>

<div class="overflow-hidden rounded-xl border border-slate-300 bg-slate-200/80 shadow-md p-6 max-w-5xl">
    <?php if($errors->any()): ?>
                <div class="mb-5 p-4 bg-rose-50 border border-rose-200 rounded-md">
                    <ul class="list-disc text-sm text-rose-600 pl-4 space-y-1">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>
<form action="<?php echo e(route('profile.update')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Company Name</label>
                    <input type="text" name="company_name" value="<?php echo e(old('company_name', Auth()->user()->company_name)); ?>" required class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-800 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
        </div>
        <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Name</label>
                    <input type="text" name="name" value="<?php echo e(old('name', Auth()->user()->name)); ?>" required class="w-full border border-black border-2 rounded px-3 py-2">
        </div>
        <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                    <input type="text" name="email" value="<?php echo e(old('email', Auth()->user()->email)); ?>" required class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-800 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
        </div>
        <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                    <input type="password" name="password" value="" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-800 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
        </div>

        <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Confirm Password</label>
                    <input type="password" name="password_confirmation" value="" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-800 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
        </div>
        <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Phone</label>
                    <input type="text" name="phone" value="<?php echo e(old('phone', Auth()->user()->phone)); ?>" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-800 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
        </div>
        <div class="mt-6 flex gap-3">
                <button type="submit" class="rounded-lg bg-slate-700 px-6 py-2 font-semibold text-white shadow-sm transition hover:bg-slate-800">Update Information</button>
            </div>


    


    </div>
    
    
    
</form>





</div>


<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\WEB\car-rental-app\resources\views/profile/index.blade.php ENDPATH**/ ?>