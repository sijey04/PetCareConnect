<div class="lg:hidden" x-show="isOpen">
    <div class="fixed inset-0 bg-black bg-opacity-50" @click="closeMenu"></div>
    <div class="fixed inset-y-0 left-0 w-64 bg-white shadow-lg p-4">
        <!-- Mobile menu content -->
        <nav class="space-y-4">
            <a href="{{ route('home') }}" class="block text-gray-700 hover:text-gray-900">Home</a>
            <a href="#services" class="block text-gray-700 hover:text-gray-900">Services</a>
            @guest
                <a href="{{ route('login') }}" class="block text-gray-700 hover:text-gray-900">Login</a>
                <a href="{{ route('register') }}" class="block text-gray-700 hover:text-gray-900">Register</a>
            @endguest
        </nav>
    </div>
</div> 