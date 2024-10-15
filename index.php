<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Care Connect - Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="styles.css">
</head>
<body class="bg-gray-100">
    <header class="bg-white shadow-md">
        <nav class="container mx-auto px-6 py-3 flex justify-between items-center">
            <div class="flex items-center">
                <img src="/placeholder.svg?height=50&width=200" alt="Pet Care Connect Logo" class="w-48">
            </div>
            <div class="flex items-center">
                <a href="#" class="text-gray-800 hover:text-blue-500 mx-3">Services</a>
                <a href="#" class="text-gray-800 hover:text-blue-500 mx-3">About Us</a>
                <a href="#" class="text-gray-800 hover:text-blue-500 mx-3">Contact</a>
                <a href="logout.php" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded ml-4">Logout</a>
            </div>
        </nav>
    </header>

    <main class="container mx-auto px-6 py-8">
        <section class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Welcome to Pet Care Connect</h1>
            <p class="text-xl text-gray-600">Your one-stop solution for all pet care needs</p>
        </section>

        <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="bg-white rounded-lg shadow-md p-6">
                <img src="/placeholder.svg?height=24&width=24" alt="Pet Grooming Icon" class="w-12 h-12 mb-4">
                <h2 class="text-2xl font-semibold mb-2">Pet Grooming</h2>
                <p class="text-gray-600">Professional grooming services for your furry friends</p>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6">
                <img src="/placeholder.svg?height=24&width=24" alt="Pet Clinic Icon" class="w-12 h-12 mb-4">
                <h2 class="text-2xl font-semibold mb-2">Pet Clinic</h2>
                <p class="text-gray-600">Expert veterinary care for your pets' health</p>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6">
                <img src="/placeholder.svg?height=24&width=24" alt="Pet Sitting Icon" class="w-12 h-12 mb-4">
                <h2 class="text-2xl font-semibold mb-2">Pet Sitting</h2>
                <p class="text-gray-600">Reliable pet sitting services when you're away</p>
            </div>
        </section>

        <section class="mt-12 text-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Why Choose Us?</h2>
            <p class="text-xl text-gray-600 mb-8">We provide top-notch care for your beloved pets</p>
            <a href="#" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-6 rounded-lg text-lg">Book a Service</a>
        </section>
    </main>

    <footer class="bg-gray-800 text-white py-8">
        <div class="container mx-auto px-6">
            <div class="flex flex-wrap justify-between">
                <div class="w-full md:w-1/4 mb-6 md:mb-0">
                    <h3 class="text-lg font-semibold mb-2">Pet Care Connect</h3>
                    <p class="text-gray-400">Your trusted partner in pet care</p>
                </div>
                <div class="w-full md:w-1/4 mb-6 md:mb-0">
                    <h3 class="text-lg font-semibold mb-2">Quick Links</h3>
                    <ul>
                        <li><a href="#" class="text-gray-400 hover:text-white">Home</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Services</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">About Us</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Contact</a></li>
                    </ul>
                </div>
                <div class="w-full md:w-1/4 mb-6 md:mb-0">
                    <h3 class="text-lg font-semibold mb-2">Contact Us</h3>
                    <p class="text-gray-400">123 Pet Street, Animalville, PA 12345</p>
                    <p class="text-gray-400">Phone: (123) 456-7890</p>
                    <p class="text-gray-400">Email: info@petcareconnect.com</p>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-sm text-gray-400 text-center">
                <p>&copy; 2023 Pet Care Connect. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>