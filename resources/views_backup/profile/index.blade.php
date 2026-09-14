@extends('layouts.app')

@section('title', 'Profile Information')

@section('content')

<h1 class="text-3xl font-bold mb-6 text-center">Current Profile : {{ Auth()->user()->company_name }}</h1>

<div class="bg-white rounded-lg shadow p-6 max-w-5xl">
    @if ($errors->any())
                <div class="mb-5 p-4 bg-red-50 border border-red-200 rounded-md">
                    <ul class="list-disc text-sm text-red-600 pl-4 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
<form action="{{ route('profile.update') }}" method="POST">
    @csrf
    @method('PUT')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Company Name</label>
                    <input type="text" name="company_name" value="{{ old('company_name', Auth()->user()->company_name) }}" required class="w-full border rounded px-3 py-2">
        </div>
        <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                    <input type="text" name="name" value="{{ old('name', Auth()->user()->name) }}" required class="w-full border border-black border-2 rounded px-3 py-2">
        </div>
        <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="text" name="email" value="{{ old('email', Auth()->user()->email) }}" required class="w-full border rounded px-3 py-2">
        </div>
        <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" value="" class="w-full border rounded px-3 py-2">
        </div>

        <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                    <input type="password" name="password_confirmation" value="" class="w-full border rounded px-3 py-2">
        </div>
        <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone', Auth()->user()->phone) }}" class="w-full border rounded px-3 py-2">
        </div>
        <div class="mt-6 flex gap-3">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Update Information</button>
            </div>


    


    </div>
    
    
    
</form>





</div>


@endsection

