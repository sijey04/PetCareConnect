@extends('layouts.app')

@section('content')
<div class="bg-gray-100 flex flex-col min-h-screen" x-data="mobileMenu">
    <!-- Header -->
    @include('partials.header')

    <!-- Mobile Menu -->
    @include('partials.mobile-menu')

    <div class="flex flex-1">
        <!-- Sidebar -->
        @include('partials.sidebar')

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto bg-gray-100 px-4 lg:px-6">
            @include('partials.hero')
            @include('partials.most-popular')
            @include('partials.services')
            @include('partials.veterinaries')
            @include('partials.grooming')
        </main>
    </div>

    <!-- Footer -->
    @include('partials.footer')

    <!-- Signup Popup -->
    @include('partials.signup-popup')
</div>

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('mobileMenu', () => ({
            isOpen: false,
            toggleMenu() {
                this.isOpen = !this.isOpen;
            },
            closeMenu() {
                this.isOpen = false;
            }
        }))
    }) 
</script>
@endpush
@endsection 