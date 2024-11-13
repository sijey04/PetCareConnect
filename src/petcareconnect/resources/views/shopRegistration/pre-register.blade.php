@extends('layouts.auth')

@section('content')
<div class="min-h-screen bg-custom-bg flex items-center justify-center p-4 font-[Poppins]">
    <a href="{{ route('home') }}" class="absolute top-4 left-4">
        <img src="{{ asset('images/logo.png') }}" alt="Pet Care Connect Logo" class="w-32 sm:w-40">
    </a>

    <div class="w-full max-w-md space-y-8 px-4 sm:px-8 py-8 sm:py-10 bg-white rounded-3xl shadow-xl">
        <div class="text-center">
            <h2 class="text-1xl sm:text-3xl font-bold">Register Your Shop</h2>
            <p class="text-gray-600 mt-2 text-sm sm:text-base">Join our network of pet care providers</p>
        </div>

        <div class="space-y-6">
            @guest
                <div class="text-center">
                    <p class="mb-4">Please sign in or create an account to register your shop.</p>
                    <div class="space-y-4">
                        <a href="{{ route('login') }}" 
                           class="block w-full px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-custom-blue hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-custom-blue">
                            Sign In
                        </a>
                        <a href="{{ route('register') }}" 
                           class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-custom-blue">
                            Create Account
                        </a>
                    </div>
                </div>
            @else
                <div class="text-center">
                    <p class="mb-4">Ready to start growing your business?</p>
                    <a href="{{ route('shop.register.form') }}" 
                       class="block w-full px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-custom-blue hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-custom-blue">
                        Continue Registration
                    </a>
                </div>
            @endguest
        </div>

        <div class="mt-8 pt-6 border-t border-gray-200">
            <h3 class="text-lg font-medium text-center mb-4">Benefits of Joining</h3>
            <div class="space-y-4">
                <div class="flex items-start">
                    <svg class="h-5 w-5 text-green-500 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span class="ml-2 text-sm text-gray-600">Reach more pet owners in your area</span>
                </div>
                <div class="flex items-start">
                    <svg class="h-5 w-5 text-green-500 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span class="ml-2 text-sm text-gray-600">Manage bookings efficiently</span>
                </div>
                <div class="flex items-start">
                    <svg class="h-5 w-5 text-green-500 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span class="ml-2 text-sm text-gray-600">Build your online presence</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 