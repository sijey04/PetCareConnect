@extends('layouts.auth')

@section('content')
<div class="min-h-screen bg-custom-bg flex items-center justify-center p-4 font-[Poppins]">
    <!-- Add logo outside the white box -->
    <a href="{{ route('home') }}" class="absolute top-4 left-4">
        <img src="{{ asset('images/logo.png') }}" alt="Pet Care Connect Logo" class="w-32 sm:w-40">
    </a>

    <div class="w-full max-w-md space-y-8 px-4 sm:px-8 py-8 sm:py-10 bg-white rounded-3xl shadow-xl">
        <!-- Header -->
        <div class="text-center">
            <h2 class="text-1xl sm:text-3xl font-bold">Register Your Shop</h2>
            <p class="text-gray-600 mt-2 text-sm sm:text-base">Complete the steps below</p>
        </div>

        <!-- Progress Steps -->
        <div class="relative progress-container" x-data="{ step: 1, totalSteps: 4 }">
            <div class="flex justify-between items-center mb-8 relative">
                <!-- Background Line -->
                <div class="absolute h-1 bg-gray-200 left-0 right-0 top-1/2 transform -translate-y-1/2"></div>
                
                <!-- Steps -->
                <div class="relative flex justify-between w-full">
                    <div class="step-item" :class="step >= 1 ? 'active' : ''">
                        <div class="rounded-full w-8 h-8 sm:w-10 sm:h-10 bg-white border-2 border-gray-200 flex items-center justify-center font-medium z-10"
                             :class="step >= 1 ? 'border-custom-blue bg-custom-blue text-white' : 'text-gray-400'">
                            1
                        </div>
                        <div class="text-xs mt-2" :class="step >= 1 ? 'text-custom-blue' : 'text-gray-400'">Basic Info</div>
                    </div>
                    
                    <div class="step-item" :class="step >= 2 ? 'active' : ''">
                        <div class="rounded-full w-8 h-8 sm:w-10 sm:h-10 bg-white border-2 border-gray-200 flex items-center justify-center font-medium z-10"
                             :class="step >= 2 ? 'border-custom-blue bg-custom-blue text-white' : 'text-gray-400'">
                            2
                        </div>
                        <div class="text-xs mt-2" :class="step >= 2 ? 'text-custom-blue' : 'text-gray-400'">Contact</div>
                    </div>
                    
                    <div class="step-item" :class="step >= 3 ? 'active' : ''">
                        <div class="rounded-full w-8 h-8 sm:w-10 sm:h-10 bg-white border-2 border-gray-200 flex items-center justify-center font-medium z-10"
                             :class="step >= 3 ? 'border-custom-blue bg-custom-blue text-white' : 'text-gray-400'">
                            3
                        </div>
                        <div class="text-xs mt-2" :class="step >= 3 ? 'text-custom-blue' : 'text-gray-400'">Services</div>
                    </div>
                    
                    <div class="step-item" :class="step >= 4 ? 'active' : ''">
                        <div class="rounded-full w-8 h-8 sm:w-10 sm:h-10 bg-white border-2 border-gray-200 flex items-center justify-center font-medium z-10"
                             :class="step >= 4 ? 'border-custom-blue bg-custom-blue text-white' : 'text-gray-400'">
                            4
                        </div>
                        <div class="text-xs mt-2" :class="step >= 4 ? 'text-custom-blue' : 'text-gray-400'">Review</div>
                    </div>
                </div>
            </div>

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    @foreach ($errors->all() as $error)
                        <span class="block sm:inline">{{ $error }}</span>
                    @endforeach
                </div>
            @endif

            <!-- Registration Form -->
            <form method="POST" action="{{ route('shop.register') }}" class="space-y-6" enctype="multipart/form-data">
                @csrf
                
                <!-- Step 1: Basic Information -->
                <div x-show="step === 1">
                    <div class="space-y-4">
                        <div>
                            <input type="text" 
                                   name="shop_name" 
                                   placeholder="Shop Name"
                                   class="w-full px-3 py-2 text-sm sm:text-base border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-custom-blue focus:border-custom-blue">
                        </div>
                        <div>
                            <select name="shop_type" 
                                    class="w-full px-3 py-2 text-sm sm:text-base border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-custom-blue focus:border-custom-blue">
                                <option value="">Select Shop Type</option>
                                <option value="veterinary">Veterinary Clinic</option>
                                <option value="grooming">Grooming Shop</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Step 2: Contact Information -->
                <div x-show="step === 2">
                    <div class="space-y-4">
                        <div>
                            <input type="tel" 
                                   name="phone" 
                                   placeholder="Contact Number"
                                   class="w-full px-3 py-2 text-sm sm:text-base border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-custom-blue focus:border-custom-blue">
                        </div>
                        <div>
                            <input type="text" 
                                   name="address" 
                                   placeholder="Shop Address"
                                   class="w-full px-3 py-2 text-sm sm:text-base border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-custom-blue focus:border-custom-blue">
                        </div>
                    </div>
                </div>

                <!-- Step 3: Services -->
                <div x-show="step === 3">
                    <div class="space-y-4">
                        <!-- Business Information -->
                        <div>
                            <input type="text" 
                                   name="tin" 
                                   placeholder="Tax Identification Number (TIN)"
                                   class="w-full px-3 py-2 text-sm sm:text-base border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-custom-blue focus:border-custom-blue">
                        </div>
                        
                        <div class="space-y-2">
                            <label class="block text-sm text-gray-700">Value Added Tax Registration Status</label>
                            <div class="flex gap-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="vat_status" value="registered" class="form-radio text-custom-blue">
                                    <span class="ml-2">VAT Registered</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="vat_status" value="non_registered" class="form-radio text-custom-blue">
                                    <span class="ml-2">Non-VAT Registered</span>
                                </label>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm text-gray-700">BIR Certificate of Registration</label>
                            <div class="flex items-center space-x-2">
                                <input type="file" 
                                       name="bir_certificate" 
                                       accept=".pdf,.jpg,.jpeg,.png"
                                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-custom-blue file:text-white hover:file:bg-blue-600">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="flex justify-between gap-4 pt-6">
                    <button type="button" 
                            x-show="step > 1"
                            @click="step--"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm sm:text-base font-medium text-gray-600 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-custom-blue">
                        Back
                    </button>
                    
                    <button type="button" 
                            x-show="step < totalSteps"
                            @click="step++"
                            class="w-full px-4 py-2 border border-transparent rounded-md shadow-sm text-sm sm:text-base font-medium text-white bg-custom-blue hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-custom-blue">
                        Continue
                    </button>

                    <button type="submit" 
                            x-show="step === totalSteps"
                            class="w-full px-4 py-2 border border-transparent rounded-md shadow-sm text-sm sm:text-base font-medium text-white bg-custom-blue hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-custom-blue">
                        Complete Registration
                    </button>
                </div>
            </form>
        </div>

        <!-- Help Text -->
        <p class="text-center text-xs sm:text-sm text-gray-600 mt-4">
            Need help? 
            <a href="#" class="text-custom-blue hover:underline">
                Contact Support
            </a>
        </p>
    </div>
</div>

<!-- Alpine.js Script for Step Names -->
<script>
    function getStepName(step) {
        const steps = {
            1: 'Basic Info',
            2: 'Contact',
            3: 'Services',
            4: 'Review'
        };
        return steps[step] || '';
    }
</script>
@endsection    