<?php
require_once 'session_check.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PET CARE CONNECT</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">
    <div class="flex flex-1 overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-56 bg-white shadow-md flex-shrink-0 overflow-y-auto">
            <div class="p-1 pl-6 border-b border-gray-200">
                <img src="images/logo.png" alt="Pet Care Connect Logo" class="h-auto w-auto">
            </div>
            <nav class="flex-grow overflow-y-auto">
                <div class="px-4 py-2">
                    <a href="#" class="flex items-center py-2 px-4 text-gray-700 hover:bg-gray-100 rounded-md">
                        <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Home
                    </a>
                    <a href="#" class="flex items-center py-2 px-4 text-gray-700 hover:bg-gray-100 rounded-md">
                        <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                        Services
                    </a>
                    <a href="#" class="flex items-center py-2 px-4 text-gray-700 hover:bg-gray-100 rounded-md">
                        <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Appointments
                    </a>
                    <a href="#" class="flex items-center py-2 px-4 text-gray-700 hover:bg-gray-100 rounded-md">
                        <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        Contact us
                    </a>
                </div>
                <div class="border-t border-gray-200 my-2"></div>
                <div class="px-4 py-2">
                    <h2 class="text-gray-500 text-sm font-semibold mb-2">CATEGORIES</h2>    
                    <a href="#" class="flex items-center py-2 px-4 text-gray-700 hover:bg-gray-100 rounded-md">
                        <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Grooming
                    </a>
                    <a href="#" class="flex items-center py-2 px-4 text-gray-700 hover:bg-gray-100 rounded-md">
                        <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                        </svg>
                        Pet Clinic
                    </a>
                </div>
                <div class="border-t border-gray-200 my-2"></div>
                <div class="px-4 py-2">
                    <h2 class="text-gray-500 text-sm font-semibold mb-2">HELP CENTER</h2>    
                    <a href="#" class="flex items-center py-2 px-4 text-gray-700 hover:bg-gray-100 rounded-md">
                        <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        FAQs
                    </a>
                    <a href="#" class="flex items-center py-2 px-4 text-gray-700 hover:bg-gray-100 rounded-md">
                        <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                        </svg>
                        Report an Issue
                    </a>
                </div>
                
                <div class="px-4 py-2">
                    <h2 class="text-gray-500 text-sm font-semibold mb-2">More From Us</h2>    
                    <a href="#" class="flex items-center py-2 px-4 text-gray-700 hover:bg-gray-100 rounded-md">
                        <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Socials
                    </a>
                    <div class="border-t border-gray-200 my-2"></div>
                    <a href="#" class="flex items-center py-2 px-4 text-gray-700 hover:bg-gray-100 rounded-md">
                        <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Settings
                    </a>
                    <a href="#" class="flex items-center py-2 px-4 text-gray-700 hover:bg-gray-100 rounded-md">
                        <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Terms and Conditions
                    </a>
                    <a href="#" class="flex items-center py-2 px-4 text-gray-700 hover:bg-gray-100 rounded-md">
                        <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Privacy Policy
                    </a>
                    
                </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto px-8">
            <!-- Header -->
            <header class="bg-white shadow-sm sticky top-0 z-10 -mx-8 px-8">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                    <div class="flex items-center">
                        <button class="mr-4">
                            <svg class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                        <div class="relative">
                            <input type="text" placeholder="Filter" class="pl-8 pr-4 py-2 border rounded-md">
                            <svg class="h-5 w-5 text-gray-400 absolute left-2 top-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <button class="mr-4">
                            <svg class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                        </button>
                        <div class="relative" x-data="{ open: false }">
                            <img src="images/01.jpg" alt="User profile" class="h-8 w-8 rounded-full cursor-pointer" @click="open = !open">
                            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md overflow-hidden shadow-xl z-10">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                                <a href="logout.php" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Sign out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Hero Section -->
            <section class="bg-gray-100 rounded-lg my-6 p-8 relative overflow-hidden">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="z-10 mb-8 md:mb-0">
                        <p class="text-gray-600 mb-2">No need to worry,</p>
                        <h2 class="text-4xl font-bold mb-4">We Provide Grooming and Vet Checks</h2>
                        <button class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-full transition duration-300 ease-in-out mb-4">Book now</button>
                        <div class="relative">
                            <input type="text" placeholder="Nearest Groom/Veterinary" class="w-full px-4 py-2 border rounded-full text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <svg class="h-5 w-5 text-gray-400 absolute right-3 top-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="w-full md:w-1/2 relative">
                        <img src="images/petdog.png" alt="Happy dog" class="w-full h-auto object-cover rounded-lg">
                    </div>
                </div>
            </section>

            <!-- Most Popular Section -->
            <section class="my-6">
                <h2 class="text-2xl font-semibold mb-4">Most Popular</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-xl">
                        <div class="relative">
                            <img src="images/shops/shop1.png" alt="Cassa de Perro Veterinary Clinic" class="w-full h-40 object-cover">
                            <span class="absolute top-2 left-2 bg-white text-black text-xs font-semibold px-2 py-1 rounded-full">Veterinary</span>
                            <button class="absolute top-2 right-2 text-white hover:text-red-500 transition-colors duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </button>
                        </div>
                        <div class="p-4">
                            <h3 class="font-semibold text-lg">Cassa De Perro Veterinary Clinic</h3>
                            <div class="flex items-center mt-1">
                                <span class="text-yellow-400">★★★★★</span>
                                <span class="ml-1 text-gray-600">5.0</span>
                            </div>
                            <p class="text-gray-600 text-sm mt-1">Tumaga- Lurawan Rd, Zamboanga, Zamboanga del Sur</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-xl">
                        <div class="relative">
                            <img src="images/shops/shop2.png" alt="Paws and Claws" class="w-full h-40 object-cover">
                            <span class="absolute top-2 left-2 bg-white text-black text-xs font-semibold px-2 py-1 rounded-full">Grooming</span>
                            <button class="absolute top-2 right-2 text-white hover:text-red-500 transition-colors duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </button>
                        </div>
                        <div class="p-4">
                            <h3 class="font-semibold text-lg">Paws and Claws</h3>
                            <div class="flex items-center mt-1">
                                <span class="text-yellow-400">★★★★★</span>
                                <span class="ml-1 text-gray-600">5.0</span>
                            </div>
                            <p class="text-gray-600 text-sm mt-1">San Alfaro St, Zamboanga, 7000 Zamboanga del Sur</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-xl">
                        <div class="relative">
                            <img src="images/shops/shop3.png" alt="Waltec" class="w-full h-40 object-cover">
                            <span class="absolute top-2 left-2 bg-white text-black text-xs font-semibold px-2 py-1 rounded-full">Veterinary</span>
                            <button class="absolute top-2 right-2 text-white hover:text-red-500 transition-colors duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </button>
                        </div>
                        <div class="p-4">
                            <h3 class="font-semibold text-lg">Waltec</h3>
                            <div class="flex items-center mt-1">
                                <span class="text-yellow-400">★★★★★</span>
                                <span class="ml-1 text-gray-600">5.0</span>
                            </div>
                            <p class="text-gray-600 text-sm mt-1">Nuñez Ext. St, Zamboanga, Zamboanga del Sur</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Services Section -->
            <section class="my-6">
                <h2 class="text-2xl font-semibold mb-4">Services</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="bg-[#D9D9D9] rounded-lg shadow-md overflow-hidden relative w-full h-[700px] bg-cover bg-center transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-xl" style="background-image: url('images/dog1.png');">
                        <div class="p-6 h-full flex flex-col bg-black bg-opacity-20 text-white transition duration-300 ease-in-out hover:bg-opacity-40">
                            <p class="text-sm mb-2">FULL SERVICE</p>
                            <h3 class="font-bold text-3xl mb-4">GROOM</h3>
                            <p class="mb-4 flex-grow">Professional grooming services to keep your pet looking and feeling their best. Our expert groomers provide personalized care for all breeds.</p>
                            <button class="bg-teal-400 hover:bg-teal-500 text-white px-6 py-3 rounded-full transition duration-300">Learn More</button>
                        </div>
                    </div>
                    <div class="bg-[#D9D9D9] rounded-lg shadow-md overflow-hidden relative w-full h-[700px] bg-cover bg-center transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-xl" style="background-image: url('images/dog2.png');">
                        <div class="p-6 h-full flex flex-col bg-black bg-opacity-20 text-white transition duration-300 ease-in-out hover:bg-opacity-40">
                            <p class="text-sm mb-2">FULL SERVICE</p>
                            <h3 class="font-bold text-3xl mb-4">BATH</h3>
                            <p class="mb-4 flex-grow">Relaxing and thorough bath services to keep your pet clean and fresh. We use pet-friendly products for a comfortable experience.</p>
                            <button class="bg-teal-400 hover:bg-teal-500 text-white px-6 py-3 rounded-full transition duration-300">Learn More</button>
                        </div>
                    </div>
                    <div class="bg-[#D9D9D9] rounded-lg shadow-md overflow-hidden relative w-full h-[700px] bg-cover bg-center transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-xl" style="background-image: url('images/dog3.png');">
                        <div class="p-6 h-full flex flex-col bg-black bg-opacity-20 text-white transition duration-300 ease-in-out hover:bg-opacity-40">
                            <p class="text-sm mb-2">FULL SERVICE</p>
                            <h3 class="font-bold text-3xl mb-4">CHECK-UP</h3>
                            <p class="mb-4 flex-grow">Comprehensive veterinary check-ups to ensure your pet's health and well-being. Our experienced vets provide thorough examinations and preventive care.</p>
                            <button class="bg-teal-400 hover:bg-teal-500 text-white px-6 py-3 rounded-full transition duration-300">Learn More</button>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Veterinaries Section -->
            <section class="my-6">
                <h2 class="text-2xl font-semibold mb-4">Veterinaries</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-xl">
                        <div class="relative">
                            <img src="images/shops/shop1.png" alt="Cassa de Perro Veterinary Clinic" class="w-full h-40 object-cover">
                            <span class="absolute top-2 left-2 bg-white text-black text-xs font-semibold px-2 py-1 rounded-full">Veterinary</span>
                            <button class="absolute top-2 right-2 text-white hover:text-red-500 transition-colors duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </button>
                        </div>
                        <div class="p-4">
                            <h3 class="font-semibold text-lg">Cassa De Perro Veterinary Clinic</h3>
                            <div class="flex items-center mt-1">
                                <span class="text-yellow-400">★★★★★</span>
                                <span class="ml-1 text-gray-600">5.0</span>
                            </div>
                            <p class="text-gray-600 text-sm mt-1">Rumuokwu Rd, Zamboanga, Zamboanga del Sur</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-xl">
                        <div class="relative">
                            <img src="images/shops/shop2.png" alt="Paws and Claws" class="w-full h-40 object-cover">
                            <span class="absolute top-2 left-2 bg-white text-black text-xs font-semibold px-2 py-1 rounded-full">Veterinary</span>
                            <button class="absolute top-2 right-2 text-white hover:text-red-500 transition-colors duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </button>
                        </div>
                        <div class="p-4">
                            <h3 class="font-semibold text-lg">Paws and Claws</h3>
                            <div class="flex items-center mt-1">
                                <span class="text-yellow-400">★★★★★</span>
                                <span class="ml-1 text-gray-600">5.0</span>
                            </div>
                            <p class="text-gray-600 text-sm mt-1">San Alfaro St, Zamboanga, 7000 Zamboanga del Sur</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-xl">
                        <div class="relative">
                            <img src="images/shops/shop3.png" alt="Waltec" class="w-full h-40 object-cover">
                            <span class="absolute top-2 left-2 bg-white text-black text-xs font-semibold px-2 py-1 rounded-full">Veterinary</span>
                            <button class="absolute top-2 right-2 text-white hover:text-red-500 transition-colors duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </button>
                        </div>
                        <div class="p-4">
                            <h3 class="font-semibold text-lg">Waltec</h3>
                            <div class="flex items-center mt-1">
                                <span class="text-yellow-400">★★★★★</span>
                                <span class="ml-1 text-gray-600">5.0</span>
                            </div>
                            <p class="text-gray-600 text-sm mt-1">Nuñez Ext. St, Zamboanga, Zamboanga del Sur</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Grooming Section -->
            <section class="my-6">
                <h2 class="text-2xl font-semibold mb-4">Grooming</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-xl">
                        <div class="relative">
                            <img src="images/shops/shop1.png" alt="Cassa de Perro Veterinary Clinic" class="w-full h-40 object-cover">
                            <span class="absolute top-2 left-2 bg-white text-black text-xs font-semibold px-2 py-1 rounded-full">Grooming</span>
                            <button class="absolute top-2 right-2 text-white hover:text-red-500 transition-colors duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </button>
                        </div>
                        <div class="p-4">
                            <h3 class="font-semibold text-lg">Cassa De Perro Veterinary Clinic</h3>
                            <div class="flex items-center mt-1">
                                <span class="text-yellow-400">★★★★★</span>
                                <span class="ml-1 text-gray-600">5.0</span>
                            </div>
                            <p class="text-gray-600 text-sm mt-1">Rumuokwu Rd, Zamboanga, Zamboanga del Sur</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-xl">
                        <div class="relative">
                            <img src="images/shops/shop2.png" alt="Paws and Claws" class="w-full h-40 object-cover">
                            <span class="absolute top-2 left-2 bg-white text-black text-xs font-semibold px-2 py-1 rounded-full">Grooming</span>
                            <button class="absolute top-2 right-2 text-white hover:text-red-500 transition-colors duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </button>
                        </div>
                        <div class="p-4">
                            <h3 class="font-semibold text-lg">Paws and Claws</h3>
                            <div class="flex items-center mt-1">
                                <span class="text-yellow-400">★★★★★</span>
                                <span class="ml-1 text-gray-600">5.0</span>
                            </div>
                            <p class="text-gray-600 text-sm mt-1">San Alfaro St, Zamboanga, 7000 Zamboanga del Sur</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-xl">
                        <div class="relative">
                            <img src="images/shops/shop3.png" alt="Waltec" class="w-full h-40 object-cover">
                            <span class="absolute top-2 left-2 bg-white text-black text-xs font-semibold px-2 py-1 rounded-full">Grooming</span>
                            <button class="absolute top-2 right-2 text-white hover:text-red-500 transition-colors duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </button>
                        </div>
                        <div class="p-4">
                            <h3 class="font-semibold text-lg">Waltec</h3>
                            <div class="flex items-center mt-1">
                                <span class="text-yellow-400">★★★★★</span>
                                <span class="ml-1 text-gray-600">5.0</span>
                            </div>
                            <p class="text-gray-600 text-sm mt-1">Nuñez Ext. St, Zamboanga, Zamboanga del Sur</p>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-auto">
        <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 grid grid-cols-4 gap-8">
            <div>
                <h3 class="text-lg font-semibold mb-4">Services</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:text-gray-300">Grooming</a></li>
                    <li><a href="#" class="hover:text-gray-300">Veterinary</a></li>
                    <li><a href="#" class="hover:text-gray-300">Appointments</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-semibold mb-4">Shopping Online</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:text-gray-300">Security Policy</a></li>
                    <li><a href="#" class="hover:text-gray-300">Privacy Policy</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-semibold mb-4">About Us</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:text-gray-300">About us</a></li>
                    <li><a href="#" class="hover:text-gray-300">Contact us</a></li>
                    <li><a href="#" class="hover:text-gray-300">Careers</a></li>
                    <li><a href="#" class="hover:text-gray-300">Articles</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-semibold mb-4">Customer Service</h3>
                <p>+234-4131-1231</p>
                <p>Email: info@petcareconnect.com</p>
                <div class="mt-4">
                    <h4 class="text-sm font-semibold mb-2">Follow Us</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white">
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
</body>
</html>
