@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Terms of Service</h1>
    <div class="prose max-w-none">
        <!-- Add your terms of service content here -->
        <p>Last updated: {{ date('F d, Y') }}</p>
        
        <h2 class="text-xl font-semibold mt-6 mb-4">1. Terms</h2>
        <p>By accessing Pet Care Connect, you agree to be bound by these terms of service...</p>
        
        <!-- Add more sections as needed -->
    </div>
</div>
@endsection 