@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Back Button -->
    <div class="mb-4">
        <a href="{{ url()->previous() }}" class="text-gray-600 hover:text-gray-800 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Back
        </a>
    </div>

    <!-- Shop Header -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
        <div class="relative h-64">
            <img src="{{ asset('images/shops/shop1.png') }}" alt="Shop Banner" class="w-full h-full object-cover">
            <div class="absolute top-4 left-4">
                <span class="bg-green-500 text-green-500 !text-green-500 px-3 py-1 rounded-full text-sm">Open</span>
            </div>
        </div>
        
        <div class="p-6">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-2xl font-bold mb-2">{{ $shop->name ?? 'Paws and Claws' }}</h1>
                    <div class="flex items-center mb-2">
                        <div class="flex text-yellow-400">★★★★★</div>
                        <span class="ml-2 text-gray-600">(38)</span>
                    </div>
                    <p class="text-gray-600">Open MON-SAT from 8:30 AM - 5:00 PM • Zamboanga City</p>
                </div>
                <div class="flex space-x-4">
                    <button class="text-gray-600 hover:text-gray-800">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>
                        </svg>
                    </button>
                    <button class="text-gray-600 hover:text-gray-800">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Services and Reviews Tabs -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
        <div class="border-b">
            <div class="flex">
                <button class="px-6 py-3 border-b-2 border-blue-500 text-blue-500 font-medium">Services</button>
                <button class="px-6 py-3 text-gray-500 hover:text-gray-700">Reviews</button>
            </div>
        </div>

        <!-- Services Section -->
        <div class="p-6">
            <!-- Service Type Toggle -->
            <div class="flex space-x-4 mb-6">
                <button class="px-4 py-2 rounded-full bg-gray-100 text-gray-800 hover:bg-gray-200">Dog</button>
                <button class="px-4 py-2 rounded-full bg-blue-500 text-white">Cat</button>
            </div>

            <!-- Services List -->
            <div class="space-y-4">
                <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg">
                    <div>
                        <h3 class="font-medium">Cat bathing and blow dry</h3>
                        <p class="text-sm text-gray-500">Service</p>
                    </div>
                    <div class="text-right">
                        <p class="font-medium">PHP 749</p>
                    </div>
                </div>

                <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg">
                    <div>
                        <h3 class="font-medium">Cat ear cleaning</h3>
                        <p class="text-sm text-gray-500">Service</p>
                    </div>
                    <div class="text-right">
                        <p class="font-medium">PHP 499</p>
                    </div>
                </div>

                <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg">
                    <div>
                        <h3 class="font-medium">Cat full service grooming</h3>
                        <p class="text-sm text-gray-500">Full Service</p>
                    </div>
                    <div class="text-right">
                        <p class="font-medium">PHP 1,499</p>
                    </div>
                </div>

                <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg">
                    <div>
                        <h3 class="font-medium">Cat Nail Trimming</h3>
                        <p class="text-sm text-gray-500">Service</p>
                    </div>
                    <div class="text-right">
                        <p class="font-medium">PHP 199</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Rating & Reviews Section -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
        <div class="p-6">
            <h2 class="text-xl font-semibold mb-4">Rating & Reviews</h2>
            <div class="flex items-center mb-6">
                <div class="text-4xl font-bold mr-4">5.0</div>
                <div class="flex-grow">
                    <div class="flex items-center text-yellow-400 mb-1">★★★★★</div>
                    <p class="text-sm text-gray-500">24 ratings</p>
                </div>
            </div>

            <!-- Reviews List -->
            <div class="space-y-6">
                <div class="border-t pt-4">
                    <div class="flex items-center mb-2">
                        <img src="{{ asset('images/avatar1.jpg') }}" alt="Reviewer" class="w-10 h-10 rounded-full mr-3">
                        <div>
                            <h3 class="font-medium">Aziell Ahamad</h3>
                            <p class="text-sm text-gray-500">Thu, Oct 5, 2023 at 3:23 PM</p>
                        </div>
                    </div>
                    <div class="flex text-yellow-400 mb-2">★★★★★</div>
                    <p class="text-gray-700">First of all pogi si bossmon and 2nd this shop almost has everything for dogs and cats.</p>
                </div>

                <div class="border-t pt-4">
                    <div class="flex items-center mb-2">
                        <img src="{{ asset('images/avatar2.jpg') }}" alt="Reviewer" class="w-10 h-10 rounded-full mr-3">
                        <div>
                            <h3 class="font-medium">Kenken Ibrahim</h3>
                            <p class="text-sm text-gray-500">Fri, Oct 6, 2023 at 10:55 AM</p>
                        </div>
                    </div>
                    <div class="flex text-yellow-400 mb-2">★★★★★</div>
                    <p class="text-gray-700">Ambait bing kung katrabaho nw pero ikaw talaga yung nag ggrooming kay fireman up compartable mejo pens.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Book Now Button (Fixed at bottom) -->
    <div class="fixed bottom-0 left-0 right-0 bg-white border-t p-4">
        <div class="container mx-auto">
            <div class="flex items-center justify-between mb-3">
                <span class="text-green-500 font-medium flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <circle cx="10" cy="10" r="8"/>
                    </svg>
                    Currently Open
                </span>
                <button class="text-gray-600 hover:text-red-500 text-sm flex items-center" onclick="reportShop()">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    Report Shop
                </button>
            </div>
            <button class="w-full bg-blue-500 text-white py-3 rounded-lg font-medium hover:bg-blue-600 transition-colors">
                Book Now
            </button>
        </div>
    </div>
</div>
@endsection
