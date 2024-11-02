@extends('layouts.app')

@section('content')
<div class="flex flex-col lg:flex-row min-h-screen bg-custom-bg" x-data="{ showPassword: false }">
    <!-- Left side with image -->
    <div class="hidden lg:flex flex-1 relative overflow-hidden bg-custom-bg min-h-[50vh] lg:min-h-screen items-center justify-center">
        <div class="absolute top-4 left-4 z-20">
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Pet Care Connect Logo" class="w-32 md:w-48">
            </a>
        </div>
        <div class="relative w-full h-full flex items-center justify-center pl-24 md:pl-32 lg:pl-40 pb-16 md:pb-24 lg:pb-32">
            <img src="{{ asset('images/kitten.png') }}" alt="Cute kitten" class="relative z-10 w-[400px] md:w-[600px] lg:w-[700px] xl:w-[800px] object-contain ml-16 md:ml-24 lg:ml-32">
        </div>
    </div>

    <!-- Right side with login form -->
    <div class="flex-1 flex items-center justify-center bg-custom-bg p-4 lg:p-8">
        <div class="w-full max-w-md space-y-8 px-8 py-10 bg-white rounded-3xl shadow-xl">
            <div class="text-center">
                <h2 class="text-3xl font-bold">Welcome Back!</h2>
                <p class="text-gray-600 mt-2">Login into your account</p>
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

            <!-- Social Login Buttons -->
            <div class="flex space-x-4">
                <button class="flex-1 flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                    <img src="{{ asset('images/icons/google-logo.png') }}" alt="Google logo" class="w-5 h-5 mr-2">
                    Google
                </button>
                <button class="flex-1 flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                    <img src="{{ asset('images/icons/facebook-logo.png') }}" alt="Facebook logo" class="w-5 h-5 mr-2">
                    Facebook
                </button>
            </div>

            <div class="relative">
                <div class="absolute inset-0 flex items-center">
                    <span class="w-full border-t border-gray-300"></span>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-white text-gray-500">Or continue with</span>
                </div>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf
                <div>
                    <input type="email" name="email" value="{{ old('email') }}" required 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-custom-blue focus:border-custom-blue"
                           placeholder="Email">
                </div>

                <div class="relative">
                    <input :type="showPassword ? 'text' : 'password'" 
                           name="password" 
                           required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-custom-blue focus:border-custom-blue"
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

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input type="checkbox" name="remember" id="remember" 
                               class="h-4 w-4 text-custom-blue focus:ring-custom-blue border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-600">
                            Remember me
                        </label>
                    </div>
                    <a href="{{ route('password.request') }}" class="text-sm text-custom-blue hover:underline">
                        Forgot Password?
                    </a>
                </div>

                <button type="submit" 
                        class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-custom-blue hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-custom-blue">
                    Log In
                </button>
            </form>

            <p class="text-center text-sm text-gray-600">
                Don't have an account?
                <a href="{{ route('register') }}" class="text-custom-blue hover:underline">
                    Sign up!
                </a>
            </p>
        </div>
    </div>
</div>
@endsection 