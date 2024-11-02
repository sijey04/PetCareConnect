<div x-show="mobileMenuOpen" 
     class="lg:hidden fixed inset-0 z-50"
     x-transition:enter="transition-opacity ease-linear duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition-opacity ease-linear duration-300"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0">
    
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" @click="mobileMenuOpen = false"></div>

    <!-- Menu -->
    <div class="fixed inset-y-0 left-0 w-[85%] max-w-sm bg-white shadow-lg transform transition-transform duration-300"
         :class="{ '-translate-x-full': !mobileMenuOpen, 'translate-x-0': mobileMenuOpen }">
        
        <!-- Header -->
        <div class="flex justify-between items-center p-4 border-b bg-gray-50">
            <button @click="mobileMenuOpen = false" class="p-2 rounded-full hover:bg-gray-200 transition-colors duration-200">
                <svg class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Navigation -->
        <nav class="overflow-y-auto h-full pb-20">
            <div class="p-4">
                <h2 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Main Menu</h2>
                <div class="space-y-2">
                    <a href="#" class="flex items-center py-3 px-4 text-gray-700 hover:bg-teal-50 hover:text-teal-600 rounded-lg transition-colors duration-200">
                        <svg class="h-5 w-5 mr-3 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Home
                    </a>
                    <!-- Add more menu items here -->
                </div>
            </div>
        </nav>
    </div>
</div> 