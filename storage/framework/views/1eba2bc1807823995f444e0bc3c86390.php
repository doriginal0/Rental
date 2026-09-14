<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Car Rental Management'); ?></title>
    
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-100 via-red-50 to-yellow-200">

    
   <div
    class="pointer-events-none fixed bottom-0 right-0 z-0 h-[520px] w-[520px] bg-contain bg-bottom-right bg-no-repeat opacity-30"
    style="background-image: url('<?php echo e(asset('icons/background_faded.png')); ?>');"
    aria-hidden="true">
</div>
    <div class="relative z-10">
    <header class="bg-gradient-to-br from-blue-100 via-yellow-100 to-red-50 shadow-lg">
        <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-2 flex items-center justify-between h-12">
            <a href="<?php echo e(route('dashboard')); ?>" class="flex items-center space-x-1 flex-shrink-0">
            <h1 class="flex items-center gap-2 text-2xl font-bold whitespace-nowrap">
    <img
        src="<?php echo e(asset('icons/dashboard.svg')); ?>"
        alt=""
        class="size-[1em] shrink-0"
    >
    <span>CarRental</span>
</h1>
            </a>
        <nav class="flex items-center space-x-2">
            <a href="<?php echo e(route('fleets.index')); ?>"
   class="px-4 py-2 rounded-lg text-sm font-medium flex items-center gap-2 transition-all duration-200
   <?php echo e(request()->routeIs('fleets.*')
       ? 'bg-blue-100 text-gray-900 shadow-md ring-1 ring-blue-200'
       : 'text-gray-700 hover:bg-gray-100'); ?>">

    <img src="<?php echo e(asset('icons/car.svg')); ?>" alt="" class="size-5 shrink-0">
    Fleets
</a>
            <a href="<?php echo e(route('cars.index')); ?>" class="px-4 py-2 rounded-lg text-sm font-medium flex items-center gap-2 <?php echo e(request()->routeIs('cars.*') ? 'bg-blue-100 text-gray-900 shadow-md ring-1 ring-blue-200' : 'text-gray-700 hover:bg-gray-100'); ?>">
                <img src="<?php echo e(asset('icons/car.svg')); ?>" alt="" class="size-5 shrink-0"> Cars
            </a>
             <a href="<?php echo e(route('drivers.index')); ?>" class="px-4 py-2 rounded-lg text-sm font-medium flex items-center gap-2 <?php echo e(request()->routeIs('drivers.*') ? 'bg-blue-100 text-gray-900 shadow-md ring-1 ring-blue-200' : 'text-gray-700 hover:bg-gray-100'); ?>">
                    <img src="<?php echo e(asset('icons/driver.svg')); ?>" alt="" class="size-5 shrink-0"> Drivers
                </a>
            <a href="<?php echo e(route('customers.index')); ?>" class="px-4 py-2 rounded-lg text-sm font-medium flex items-center gap-2 <?php echo e(request()->routeIs('customers.*') ? 'bg-blue-100 text-gray-900 shadow-md ring-1 ring-blue-200' : 'text-gray-700 hover:bg-gray-100'); ?>">
                <img src="<?php echo e(asset('icons/customer.svg')); ?>" alt="" class="size-5 shrink-0"> Customers
            </a>
            <a href="<?php echo e(route('bookings.index')); ?>" class="px-4 py-2 rounded-lg text-sm font-medium flex items-center gap-2  <?php echo e(request()->routeIs('bookings.*') ? 'bg-blue-100 text-gray-900 shadow-md ring-1 ring-blue-200' : 'text-gray-700 hover:bg-gray-100'); ?>">
                <img src="<?php echo e(asset('icons/booking.svg')); ?>" alt="" class="size-5 shrink-0"> Bookings
            </a>
            <a href="<?php echo e(route('payments.index')); ?>" class="px-4 py-2 rounded-lg text-sm font-medium flex items-center gap-2  <?php echo e(request()->routeIs('payments.*') ? 'bg-blue-100 text-gray-900 shadow-md ring-1 ring-blue-200' : 'text-gray-700 hover:bg-gray-100'); ?>">
                <img src="<?php echo e(asset('icons/pay.svg')); ?>" alt="" class="size-5 shrink-0"> Payments
            </a>
            <a href="<?php echo e(route('maintenances.index')); ?>" class="px-4 py-2 rounded-lg text-sm font-medium flex items-center gap-2  <?php echo e(request()->routeIs('maintenances.*') ? 'bg-blue-100 text-gray-900 shadow-md ring-1 ring-blue-200' : 'text-gray-700 hover:bg-gray-100'); ?>">
                <img src="<?php echo e(asset('icons/maintenance.svg')); ?>" alt="" class="size-5 shrink-0"> Maintenance
            </a>
            <?php if(auth()->guard()->check()): ?>
                    <?php if(auth()->user()->isAdmin()): ?>
                        <a href="<?php echo e(route('clients.index')); ?>" class="px-4 py-2 rounded-lg text-sm font-medium flex items-center gap-2  <?php echo e(request()->routeIs('clients.*') ? 'bg-blue-100 text-gray-900 shadow-md ring-1 ring-blue-200' : 'text-gray-700 hover:bg-gray-100'); ?>">
                Clients
            </a>
                    <?php endif; ?>
                <?php endif; ?>
        </nav>
       

                <div
    x-data="{ open: false }"
    @click.outside="open = false"
    class="relative ml-4 shrink-0"
>
    <button
        type="button"
        @click="open = !open"
        :aria-expanded="open"
        class="flex w-48 items-center justify-between gap-3 rounded-lg border border-slate-300
               bg-slate-100/80 px-3 py-2 text-sm font-semibold text-slate-700 shadow-sm
               transition hover:border-slate-400 hover:bg-white focus:outline-none
               focus:ring-2 focus:ring-slate-400/40"
    >

        <svg
            class="size-5 shrink-0 text-slate-500"
            fill="none"
            stroke="currentColor"
            stroke-width="1.8"
            viewBox="0 0 24 24"
            aria-hidden="true"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M15.75 6.75a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.25a7.5 7.5 0 0 1 15 0"
            />
        </svg>

        <span class="truncate">
            <?php echo e(auth()->user()->company_name); ?>

        </span>

        
        
        
        <svg
            class="size-4 shrink-0 text-slate-400 transition-transform"
            :class="{ 'rotate-180': open }"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            viewBox="0 0 24 24"
            aria-hidden="true"
        >
            <path stroke-linecap="round" stroke-linejoin="round" d="m6 9 6 6 6-6" />
        </svg>
    </button>

    
    <div
        x-cloak
        x-show="open"
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="translate-y-1 opacity-0"
        x-transition:enter-end="translate-y-0 opacity-100"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="translate-y-0 opacity-100"
        x-transition:leave-end="translate-y-1 opacity-0"
        class="absolute right-0 z-50 mt-2 w-56 overflow-hidden rounded-xl border
               border-slate-600 bg-slate-800 shadow-xl ring-1 ring-black/10"
    >
        <div class="border-b border-slate-700 px-4 py-3">
            <p class="truncate text-sm font-semibold text-white">
                <?php echo e(auth()->user()->company_name); ?>

            </p>
            <p class="text-xs text-slate-400">Account menu</p>
        </div>

        <div class="p-1.5">
            <a
                href="<?php echo e(route('profile.index')); ?>"
                class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium
                       text-slate-200 transition hover:bg-slate-700 hover:text-white"
            >
                <svg
                    class="size-4 text-slate-400"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    viewBox="0 0 24 24"
                    aria-hidden="true"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M15.75 6.75a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.25a7.5 7.5 0 0 1 15 0"
                    />
                </svg>
                Profile
            </a>

            <form method="POST" action="<?php echo e(route('logout')); ?>">
                <?php echo csrf_field(); ?>

                <button
                    type="submit"
                    class="flex w-full items-center gap-3 rounded-lg px-3 py-2.5 text-left
                           text-sm font-medium text-rose-300 transition hover:bg-rose-500/15
                           hover:text-rose-200"
                >
                    <svg
                        class="size-4"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        viewBox="0 0 24 24"
                        aria-hidden="true"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6A2.25 2.25 0 0 0 5.25 5.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 12h7.5m0 0-3-3m3 3-3 3"
                        />
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </div>
</div>
        
            
        </div>
    </header>
    <div x-data="{ sidebarOpen: true }" class="flex min-h-screen">

        <!-- ============ MOBILE TOP BAR ============ -->
        <div class="lg:hidden fixed top-0 left-0 right-0 z-50 bg-green-900 text-white p-4 flex items-center justify-between">
            <h1 class="text-xl font-bold">🚗 CarRental</h1>
            <!-- Mobile hamburger: lives INSIDE the top bar -->
            <button @click="document.getElementById('mobile-sidebar').classList.toggle('hidden')"
                    aria-label="Toggle navigation menu"
                    class="text-white focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>

        <!-- ============ MOBILE SIDEBAR (slide-over) ============ -->
        <div id="mobile-sidebar" class="hidden lg:hidden fixed inset-0 z-40 bg-gray-900 text-white pt-16">
            <div class="px-6 py-3 border-b border-gray-800">
                <p class="font-semibold"><?php echo e(auth()->user()->company_name); ?></p>
                <p class="text-gray-400 text-xs"><?php echo e(auth()->user()->email); ?></p>
            </div>
            <nav class="mt-4">
                <a href="<?php echo e(route('dashboard')); ?>" class="block px-6 py-3 hover:bg-gray-800 <?php echo e(request()->routeIs('dashboard') ? 'bg-gray-800 border-l-4 border-blue-500' : ''); ?>">
                    📊 Dashboard
                </a>
                <?php if(auth()->guard()->check()): ?>
                    <?php if(auth()->user()->isAdmin()): ?>
                        <a href="<?php echo e(route('clients.index')); ?>" class="block px-6 py-3 hover:bg-gray-800 <?php echo e(request()->routeIs('clients.*') ? 'bg-gray-800 border-l-4 border-purple-500' : ''); ?>">
                            🏢 Clients
                        </a>
                    <?php endif; ?>
                <?php endif; ?>
                <a href="<?php echo e(route('cars.index')); ?>" class="block px-6 py-3 hover:bg-gray-800 <?php echo e(request()->routeIs('cars.*') ? 'bg-gray-800 border-l-4 border-blue-500' : ''); ?>">
                    🚙 Cars
                </a>
                 <a href="<?php echo e(route('drivers.index')); ?>" class="block px-6 py-3 hover:bg-gray-800 <?php echo e(request()->routeIs('drivers.*') ? 'bg-gray-800 border-l-4 border-blue-500' : ''); ?>">
                    Drivers
                </a>
                <a href="<?php echo e(route('customers.index')); ?>" class="block px-6 py-3 hover:bg-gray-800 <?php echo e(request()->routeIs('customers.*') ? 'bg-gray-800 border-l-4 border-blue-500' : ''); ?>">
                    👤 Customers
                </a>
                <a href="<?php echo e(route('bookings.index')); ?>" class="block px-6 py-3 hover:bg-gray-800 <?php echo e(request()->routeIs('bookings.*') ? 'bg-gray-800 border-l-4 border-blue-500' : ''); ?>">
                    📅 Bookings
                </a>
                <a href="<?php echo e(route('payments.index')); ?>" class="block px-6 py-3 hover:bg-gray-800 <?php echo e(request()->routeIs('payments.*') ? 'bg-gray-800 border-l-4 border-blue-500' : ''); ?>">
                    💳 Payments
                </a>
                <a href="<?php echo e(route('maintenances.index')); ?>" class="block px-6 py-3 hover:bg-gray-800 <?php echo e(request()->routeIs('maintenances.*') ? 'bg-gray-800 border-l-4 border-blue-500' : ''); ?>">
                    🔧 Maintenance
                </a>
            </nav>
            <div class="absolute bottom-0 left-0 right-0 border-t border-gray-800 p-4">
                <form method="POST" action="<?php echo e(route('logout')); ?>">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="w-full text-left text-gray-300 hover:text-white text-sm">
                        ⏻ Logout
                    </button>
                </form>
            </div>
        </div>

        
                
                

            <!-- Logout -->
            

        <!-- ============ MAIN CONTENT ============ -->
        <main class="flex-1 overflow-x-auto p-4 pt-20 lg:p-8">
            <?php if(session('success')): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>
            <?php if(session('error')): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                    <?php echo e(session('error')); ?>

                </div>
            <?php endif; ?>
            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>
    </div>
</body>

</html>
<?php /**PATH D:\WEB\car-rental-app\resources\views/layouts/app.blade.php ENDPATH**/ ?>