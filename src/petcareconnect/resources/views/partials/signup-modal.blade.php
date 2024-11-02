<div
    x-data="{ 
        showPassword: false,
        confirmShowPassword: false,
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
    }"
    x-show="$store.signupModal.isOpen"
    class="fixed inset-0 z-50 overflow-y-auto"
    style="display: none;"
>
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <!-- Modal panel -->
        <div class="inline-block align-bottom bg-white rounded-3xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <!-- Close button -->
                <div class="absolute top-0 right-0 pt-4 pr-4">
                    <button 
                        type="button" 
                        class="text-gray-400 hover:text-gray-500"
                        @click="$store.signupModal.close()"
                    >
                        <span class="sr-only">Close</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Modal content -->
                <div class="text-center mb-6">
                    <h2 class="text-2xl font-bold">Create Account</h2>
                    <p class="text-gray-600 mt-2">Getting started is easy</p>
                </div>

                <!-- Social login buttons -->
                <div class="flex space-x-4 mb-6">
                    <button class="flex-1 flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        <img src="{{ asset('images/icons/google-logo.png') }}" alt="Google logo" class="w-5 h-5 mr-2">
                        Google
                    </button>
                    <button class="flex-1 flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        <img src="{{ asset('images/icons/facebook-logo.png') }}" alt="Facebook logo" class="w-5 h-5 mr-2">
                        Facebook
                    </button>
                </div>

                <!-- Divider -->
                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center">
                        <span class="w-full border-t border-gray-300"></span>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-gray-500">Or continue with</span>
                    </div>
                </div>

                <!-- Sign up form -->
                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf
                    
                    <div>
                        <input type="text" name="first_name" placeholder="First Name" required 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <input type="text" name="last_name" placeholder="Last Name" required 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <input type="email" name="email" placeholder="Email Address" required 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div class="relative">
                        <input 
                            :type="showPassword ? 'text' : 'password'"
                            name="password"
                            placeholder="Password"
                            required
                            x-model="password"
                            @input="calculateStrength()"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        >
                        <button 
                            type="button"
                            @click="showPassword = !showPassword"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center"
                        >
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        
                        <!-- Password strength meter -->
                        <div class="h-1 w-full bg-gray-200 rounded-full mt-2">
                            <div class="h-1 rounded-full transition-all duration-300"
                                :style="`width: ${strength}%; background-color: ${strengthColor()}`">
                            </div>
                        </div>
                        
                        <div class="text-xs text-gray-500 mt-1">
                            <span :class="{'text-green-600': strength >= 25}">✓ At least 8 characters</span><br>
                            <span :class="{'text-green-600': /[^A-Za-z0-9]/.test(password)}">✓ Special character</span><br>
                            <span :class="{'text-green-600': /[0-9]/.test(password)}">✓ Number</span><br>
                            <span :class="{'text-green-600': /[A-Z]/.test(password) && /[a-z]/.test(password)}">✓ Upper & lowercase</span>
                        </div>
                    </div>

                    <div class="relative">
                        <input 
                            :type="confirmShowPassword ? 'text' : 'password'"
                            name="password_confirmation"
                            placeholder="Confirm Password"
                            required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        >
                        <button 
                            type="button"
                            @click="confirmShowPassword = !confirmShowPassword"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center"
                        >
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>

                    <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Create Account
                    </button>
                </form>

                <p class="mt-4 text-center text-sm text-gray-600">
                    Already have an account?
                    <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-500">
                        Sign in
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.store('signupModal', {
            isOpen: false,
            open() {
                this.isOpen = true;
            },
            close() {
                this.isOpen = false;
            }
        });
    });
</script>
@endpush 