<section class="my-6">
    <h2 class="text-2xl font-semibold mb-4">Veterinary Shops</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-6">
        @foreach($popularShops as $shop)
        <div class="bg-white rounded-lg shadow-md overflow-hidden transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-xl">
            <div class="relative">
                <img src="{{ asset($shop->image) }}" alt="{{ $shop->name }}" class="w-full h-40 object-cover">
                <span class="absolute top-2 left-2 bg-white text-black text-xs font-semibold px-2 py-1 rounded-full">
                    {{ $shop->type }}
                </span>
                <button class="absolute top-2 right-2 text-white hover:text-red-500 transition-colors duration-300">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                </button>
            </div>
            <div class="p-4">
                <h3 class="font-semibold text-lg">{{ $shop->name }}</h3>
                <div class="flex items-center mt-1">
                    <span class="text-yellow-400">★★★★★</span>
                    <span class="ml-1 text-gray-600">{{ $shop->rating }}</span>
                </div>
                <p class="text-gray-600 text-sm mt-1">{{ $shop->address }}</p>
            </div>
        </div>
        @endforeach
    </div>
</section> 