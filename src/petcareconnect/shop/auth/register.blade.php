@extends('layouts.app')

@section('content')
<div class="flex flex-col lg:flex-row min-h-screen bg-custom-bg">
    <!-- Right side image -->
    <div class="hidden lg:flex flex-1 relative overflow-hidden bg-custom-bg min-h-screen items-center justify-center order-1 lg:order-2">
        <div class="absolute top-4 right-4 z-20">
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Pet Care Connect Logo" class="w-32 md:w-48">
            </a>
        </div>
        <div class="relative w-full h-full flex items-center justify-center pr-24 md:pr-32 lg:pr-40 pb-12 md:pb-20">
            <img src="{{ asset('images/kitten2.png') }}" alt="Cute kitten" class="relative z-10 w-[400px] md:w-[600px] lg:w-[700px] xl:w-[800px] object-contain mr-12 md:mr-20 lg:mr-28">
        </div>
    </div>

    <!-- Registration form -->
    <div class="flex-1 flex items-center justify-center bg-custom-bg p-4 lg:p-8 order-2 lg:order-1">
        <div class="w-full max-w-md space-y-8 px-4 sm:px-8 py-8 sm:py-10 bg-white rounded-3xl shadow-xl">
            <div class="text-center">
                <h2 class="text-1xl sm:text-3xl font-bold">Get Started With</h2>
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="Pet Care Connect Logo" class="w-24 sm:w-32 mx-auto mt-2">
                </a>
                <p class="text-gray-600 mt-2 text-sm sm:text-base">Getting started is easy</p>
            </div>

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Registration form -->
            <form method="POST" action="{{ route('register') }}" class="space-y-4 sm:space-y-6">
                @csrf
                
                <!-- Form fields here -->
                <div>
                    <input type="text" name="first_name" value="{{ old('first_name') }}" required
                           class="w-full px-3 py-2 text-sm sm:text-base border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-custom-blue focus:border-custom-blue"
                           placeholder="First Name">
                </div>

                <div>
                    <input type="text" name="last_name" value="{{ old('last_name') }}" required
                           class="w-full px-3 py-2 text-sm sm:text-base border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-custom-blue focus:border-custom-blue"
                           placeholder="Last Name">
                </div>

                <div>
                    <input type="email" name="email" value="{{ old('email') }}" required
                           class="w-full px-3 py-2 text-sm sm:text-base border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-custom-blue focus:border-custom-blue"
                           placeholder="Email">
                </div>

                <div x-data="{ showPassword: false, password: '' }" class="relative">
                    <input :type="showPassword ? 'text' : 'password'"
                           name="password"
                           x-model="password"
                           required
                           class="w-full px-3 py-2 text-sm sm:text-base border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-custom-blue focus:border-custom-blue"
                           placeholder="Password">
                    <button type="button"
                            @click="showPassword = !showPassword"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center">
                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>

                <div class="relative">
                    <input type="password"
                           name="password_confirmation"
                           required
                           class="w-full px-3 py-2 text-sm sm:text-base border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-custom-blue focus:border-custom-blue"
                           placeholder="Confirm Password">
                </div>

                <button type="submit"
                        class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-custom-blue hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-custom-blue">
                    Create Account
                </button>
            </form>

            <p class="text-center text-xs sm:text-sm text-gray-600">
                Have an account?
                <a href="{{ route('login') }}" class="text-custom-blue hover:underline">
                    Sign in!
                </a>
            </p>
        </div>
    </div>
</div>
@endsection 