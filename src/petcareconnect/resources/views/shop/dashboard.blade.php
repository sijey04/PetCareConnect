@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <!-- Shop Header -->
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center space-x-4">
                <img 
                    src="{{ Storage::url($shop->image) }}" 
                    alt="{{ $shop->name }}" 
                    class="w-16 h-16 rounded-full object-cover"
                >
                <div>
                    <h1 class="text-2xl font-bold">{{ $shop->name }}</h1>
                    <p class="text-gray-600">{{ ucfirst($shop->type) }} Shop</p>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm">
                    Open
                </span>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-blue-50 p-6 rounded-lg">
                <h3 class="text-lg font-semibold mb-2">Today's Appointments</h3>
                <p class="text-3xl font-bold">0</p>
            </div>
            <div class="bg-green-50 p-6 rounded-lg">
                <h3 class="text-lg font-semibold mb-2">Total Revenue</h3>
                <p class="text-3xl font-bold">₱0.00</p>
            </div>
            <div class="bg-purple-50 p-6 rounded-lg">
                <h3 class="text-lg font-semibold mb-2">Rating</h3>
                <p class="text-3xl font-bold">{{ number_format($shop->rating, 1) }}</p>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-gray-50 rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4">Recent Activity</h2>
            <div class="space-y-4">
                <p class="text-gray-600 text-center py-4">No recent activity</p>
            </div>
        </div>
    </div>
</div>
@endsection 