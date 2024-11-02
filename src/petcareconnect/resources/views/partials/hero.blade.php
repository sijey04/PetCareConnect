<section class="relative bg-white py-16 md:py-24">
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row items-center">
            <div class="lg:w-1/2 lg:pr-12">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 leading-tight mb-6">
                    Your Pet's Health, Our Priority
                </h1>
                <p class="text-lg md:text-xl text-gray-600 mb-8">
                    Connect with trusted veterinarians and pet care services in your area. Schedule appointments, get expert advice, and ensure your pet's well-being.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-custom-blue hover:bg-blue-600 transition duration-150 ease-in-out">
                        Get Started
                    </a>
                    <a href="#services" class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 transition duration-150 ease-in-out">
                        Learn More
                    </a>
                </div>
            </div>
            <div class="lg:w-1/2 mt-12 lg:mt-0">
                <img src="{{ asset('images/hero-pet.png') }}" alt="Happy pets" class="w-full h-auto rounded-lg shadow-xl">
            </div>
        </div>
    </div>
</section> 