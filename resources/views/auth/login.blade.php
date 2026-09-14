<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Car Rental Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-slate-100 via-gray-50 to-slate-200 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md p-8 rounded-xl border border-slate-300 bg-slate-200/80 shadow-lg">

        {{-- Header --}}
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-slate-900">🚗 CarRental</h1>
            <p class="text-slate-500 mt-2">Sign in to your dashboard</p>
        </div>

        {{-- Error messages --}}
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 whitespace-nowrap px-3 py-2.5 rounded mb-6">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Login form --}}
        <form method="POST" action="{{ route('login.attempt') }}">
            @csrf

            {{-- Email --}}
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-800 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                    placeholder="you@company.com"
                >
            </div>

            {{-- Password --}}
            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    required
                    class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-800 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                    placeholder="••••••••"
                >
            </div>

            {{-- Remember me --}}
            <div class="mb-6 flex items-center">
                <input
                    type="checkbox"
                    id="remember"
                    name="remember"
                    class="h-4 w-4 text-blue-600 border-slate-300 rounded"
                >
                <label for="remember" class="ml-2 text-sm text-slate-600">Remember me</label>
            </div>

            {{-- Submit --}}
            <button
                type="submit"
                class="w-full bg-slate-700 text-white py-2 px-4 rounded-lg hover:bg-slate-800 transition-colors font-medium"
            >
                Sign In
            </button>
        </form>
    </div>

</body>
</html>
