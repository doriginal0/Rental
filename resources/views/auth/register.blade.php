<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | Car Rental Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-slate-100 via-gray-50 to-slate-200 min-h-screen flex items-center justify-center py-12 px-4">

    <div class="w-full max-w-md">
        <!-- Heading -->
        <div class="text-center mb-8">
            <div class="text-5xl mb-2">🚗</div>
            <h1 class="text-3xl font-bold text-slate-900">Create your account</h1>
            <p class="text-slate-500 mt-1">Start managing your rental fleet</p>
        </div>

        <!-- Card -->
        <div class="rounded-xl border border-slate-300 bg-slate-200/80 shadow-md-md p-8">

            <!-- Validation errors -->
            @if ($errors->any())
                <div class="mb-5 p-4 bg-rose-50 border border-rose-200 rounded-md">
                    <ul class="list-disc text-sm text-rose-600 pl-4 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Registration form -->
            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                {{-- Your name --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-slate-700 mb-1">Your Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required
                           class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-800 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                           placeholder="e.g. Jane Smith">
                    @error('name')
                        <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Company name --}}
                <div>
                    <label for="company_name" class="block text-sm font-medium text-slate-700 mb-1">Company / Business Name</label>
                    <input type="text" id="company_name" name="company_name" value="{{ old('company_name') }}" required
                           class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-800 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                           placeholder="e.g. Smith's Car Rentals">
                    @error('company_name')
                        <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Phone --}}
                <div>
                    <label for="phone" class="block text-sm font-medium text-slate-700 mb-1">Phone <span class="text-slate-400">(optional)</span></label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
                           class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-800 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                           placeholder="e.g. 555-1234">
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required
                           class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-800 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                           placeholder="you@example.com">
                    @error('email')
                        <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                    <input type="password" id="password" name="password" required minlength="8"
                           class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-800 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                           placeholder="At least 8 characters">
                    @error('password')
                        <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Confirm password --}}
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-1">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required
                           class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-800 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                           placeholder="Re-enter your password">
                </div>

                {{-- Submit --}}
                <div>
                    <button type="submit"
                            class="w-full py-2.5 px-4 bg-slate-700 hover:bg-slate-800 text-white font-semibold rounded-lg transition">
                        Create Account
                    </button>
                </div>
            </form>
        </div>

        <!-- Link to login -->
        <p class="text-center text-sm text-slate-500 mt-5">
            Already have an account?
            <a href="{{ route('login') }}" class="text-slate-600 hover:text-slate-900 hover:underline">Log in</a>
        </p>
    </div>

</body>
</html>
