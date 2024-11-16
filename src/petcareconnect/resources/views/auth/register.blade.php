<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'Pet Care Connect') }} - Register</title>
    
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-custom-bg font-[Poppins]">
    <div class="flex flex-col lg:flex-row min-h-screen bg-custom-bg">
        <!-- Sign up form container -->
        <div class="flex-1 flex items-center justify-center bg-custom-bg p-4 lg:p-8 order-1 lg:order-1">
            <div class="w-full max-w-md space-y-8 px-4 sm:px-8 py-8 sm:py-10 bg-white rounded-3xl shadow-xl">
                <div class="text-center">
                    <h2 class="text-1xl sm:text-3xl font-bold">Get Started With</h2>
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('images/logo.png') }}" alt="Pet Care Connect Logo" class="w-24 sm:w-32 mx-auto mt-2">
                    </a>
                    <p class="text-gray-600 mt-2 text-sm sm:text-base">Getting started is easy</p>
                </div>

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                        @foreach ($errors->all() as $error)
                            <span class="block sm:inline">{{ $error }}</span>
                        @endforeach
                    </div>
                @endif

                <!-- Social signup buttons -->
                <div class="flex space-x-4">
                    <button class="flex-1 flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-xs sm:text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        <img src="{{ asset('images/icons/google-logo.png') }}" alt="Google logo" class="w-4 h-4 sm:w-5 sm:h-5 mr-2">
                        Google
                    </button>
                    <button class="flex-1 flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-xs sm:text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        <img src="{{ asset('images/icons/facebook-logo.png') }}" alt="Facebook logo" class="w-4 h-4 sm:w-5 sm:h-5 mr-2">
                        Facebook
                    </button>
                </div>

                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <span class="w-full border-t border-gray-300"></span>
                    </div>
                    <div class="relative flex justify-center text-xs sm:text-sm">
                        <span class="px-2 bg-white text-gray-500">Or continue with</span>
                    </div>
                </div>

                <!-- Registration form -->
                <form method="POST" action="{{ route('register') }}" class="space-y-4 sm:space-y-6" x-data="{ 
                    first_name: '', 
                    last_name: '',
                    updateFullName() {
                        this.$refs.fullName.value = `${this.first_name} ${this.last_name}`.trim();
                    }
                }">
                    @csrf
                    <div>
                        <input type="text" 
                               name="first_name" 
                               x-model="first_name"
                               @input="updateFullName"
                               value="{{ old('first_name') }}" 
                               placeholder="First Name" 
                               required 
                               class="w-full px-3 py-2 text-sm sm:text-base border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-custom-blue focus:border-custom-blue">
                    </div>
                    <div>
                        <input type="text" 
                               name="last_name" 
                               x-model="last_name"
                               @input="updateFullName"
                               value="{{ old('last_name') }}" 
                               placeholder="Last Name" 
                               required 
                               class="w-full px-3 py-2 text-sm sm:text-base border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-custom-blue focus:border-custom-blue">
                    </div>
                    
                    <!-- Hidden input for full name -->
                    <input type="hidden" 
                           name="name" 
                           x-ref="fullName"
                           value="{{ old('name') }}">

                    <div>
                        <input type="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               placeholder="Enter Email" 
                               required 
                               class="w-full px-3 py-2 text-sm sm:text-base border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-custom-blue focus:border-custom-blue">
                    </div>

                    <!-- Password input with strength meter -->
                    <div x-data="{ 
                        showPassword: false,
                        password: '',
                        strength: 0,
                        strengthColor() {
                            if (this.strength < 25) return '#dc2626';
                            if (this.strength < 50) return '#f59e0b';
                            if (this.strength < 75) return '#10b981';
                            return '#059669';
                        },
                        calculateStrength() {
                            let score = 0;
                            if (this.password.length >= 8) score += 25;
                            if (/[^A-Za-z0-9]/.test(this.password)) score += 25;
                            if (/[0-9]/.test(this.password)) score += 25;
                            if (/[A-Z]/.test(this.password) && /[a-z]/.test(this.password)) score += 25;
                            this.strength = score;
                        }
                    }">
                        <div class="relative">
                            <input :type="showPassword ? 'text' : 'password'"
                                   name="password"
                                   x-model="password"
                                   @input="calculateStrength()"
                                   placeholder="Password"
                                   required
                                   class="w-full px-3 py-2 text-sm sm:text-base border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-custom-blue focus:border-custom-blue">
                            <button type="button"
                                    @click="showPassword = !showPassword"
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <svg class="h-4 w-4 sm:h-5 sm:w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                        
                        <!-- Password strength meter -->
                        <div class="h-1 w-full bg-gray-200 rounded-full mt-2">
                            <div class="h-full rounded-full transition-all duration-300"
                                 :style="`width: ${strength}%; background-color: ${strengthColor()}`"></div>
                        </div>
                        
                        <!-- Password requirements -->
                        <div class="mt-2 text-xs text-gray-600 space-y-1">
                            <p :class="{'text-green-600': password.length >= 8}">✓ At least 8 characters</p>
                            <p :class="{'text-green-600': /[^A-Za-z0-9]/.test(password)}">✓ One special character</p>
                            <p :class="{'text-green-600': /[0-9]/.test(password)}">✓ One number</p>
                            <p :class="{'text-green-600': /[A-Z]/.test(password) && /[a-z]/.test(password)}">✓ Mix of upper & lowercase letters</p>
                        </div>
                    </div>

                    <div class="relative" x-data="{ showConfirmPassword: false }">
                        <input :type="showConfirmPassword ? 'text' : 'password'" 
                               name="password_confirmation" 
                               placeholder="Confirm Password" 
                               required 
                               class="w-full px-3 py-2 text-sm sm:text-base border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-custom-blue focus:border-custom-blue">
                        <button type="button"
                                @click="showConfirmPassword = !showConfirmPassword"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <svg class="h-4 w-4 sm:h-5 sm:w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
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

        <!-- Image container for desktop only -->
        <div class="hidden lg:flex flex-1 relative overflow-hidden bg-custom-bg min-h-screen items-center justify-center order-2 lg:order-2">
            <div class="absolute top-4 right-4 z-20">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="Pet Care Connect Logo" class="w-32 md:w-48">
                </a>
            </div>
            <div class="relative w-full h-full flex items-center justify-center pr-24 md:pr-32 lg:pr-40 pb-12 md:pb-20">
                <img src="{{ asset('images/kitten2.png') }}" alt="Cute kitten" class="relative z-10 w-[400px] md:w-[600px] lg:w-[700px] xl:w-[800px] object-contain mr-12 md:mr-20 lg:mr-28">
            </div>
        </div>
    </div>
</body>
</html> 