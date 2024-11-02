@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="bg-gray-100 rounded-lg my-6 p-4 lg:p-8 relative overflow-hidden z-0">
        <div class="flex flex-col lg:flex-row justify-between items-center">
            <div class="z-10 mb-8 lg:mb-0 lg:w-1/2 text-left">
                <p class="text-gray-600 mb-2">No need to worry,</p>
                <h2 class="text-4xl font-bold mb-4">We Provide Grooming and Vet Checks</h2>
                <button 
                    onclick="window.location.href='{{ route('appointments.create') }}'"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-full transition duration-300 ease-in-out mb-4">
                    Book new appointment
                </button>
                <div class="relative">
                    <input type="text" placeholder="Nearest Grooming or Vet" class="w-full px-4 py-2 border rounded-full text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <svg class="h-5 w-5 text-gray-400 absolute right-3 top-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
            </div>
            <div class="w-full lg:w-1/2 relative">
                <img src="{{ asset('images/petdog.png') }}" alt="Happy dog" class="w-full h-auto object-cover rounded-lg">
            </div>
        </div>
    </section>

    <!-- Most Popular Section -->
    @include('partials.most-popular', ['popularShops' => $popularShops])

    <!-- Services Section -->
    @include('partials.services', ['services' => $services])

    <!-- Veterinaries Section -->
    @include('partials.veterinaryshop')

    <!-- Grooming Section -->
    @include('partials.groomingshop')
@endsection
