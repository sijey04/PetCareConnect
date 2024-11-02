<section id="services" class="my-6">
    <h2 class="text-2xl font-semibold mb-4">Services</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($services as $index => $service)
        <div class="bg-[#D9D9D9] rounded-lg shadow-md overflow-hidden relative w-full h-[700px] bg-cover bg-center transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-xl" 
             style="background-image: url('{{ asset('images/dog' . ($index + 1) . '.png') }}');">
            <div class="p-6 h-full flex flex-col bg-black bg-opacity-10 text-white transition duration-300 ease-in-out hover:bg-opacity-10">
                <p class="text-sm mb-2">FULL SERVICE</p>
                <h3 class="font-bold text-3xl mb-4">{{ $service->name }}</h3>
                <p class="mb-4 flex-grow">{{ $service->description }}</p>
                <button class="bg-teal-400 hover:bg-teal-500 text-white px-6 py-3 rounded-full transition duration-300">
                    Learn More
                </button>
            </div>
        </div>
        @endforeach
    </div>
</section> 