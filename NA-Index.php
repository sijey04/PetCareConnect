<?php
require_once 'classes/session_check.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <title>PET CARE CONNECT</title>
    <link href="dist/css/styles.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="js/components.js"></script>
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body id="top" class="bg-gray-100 flex flex-col min-h-screen" x-data="mobileMenu">
    <header class="bg-white shadow-sm sticky top-0 z-50 flex items-center">
        <div class="flex-shrink-0 p-4 w-56">
            <img src="images/logo.png" alt="Pet Care Connect Logo" class="h-auto w-full max-w-[200px]">
        </div>
        <div class="flex-grow flex justify-between items-center px-4">
            <div class="flex items-center">     
                <button x-on:click="toggleMenu()" class="mr-4 lg:hidden">
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
            <div class="flex items-center space-x-2">
                <a href="auth/login.php" class="flex items-center py-2 px-4 text-gray-700 hover:bg-gray-200 hover:text-gray-900 rounded-md transition-colors duration-200">
                    <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                    </svg>
                    Login
                </a>
                <a href="auth/signup.php" class="flex items-center py-2 px-4 text-gray-700 hover:bg-gray-200 hover:text-gray-900 rounded-md transition-colors duration-200">
                    <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                    Sign Up
                </a>
            </div>
        </div>
    </header>

    <!-- Add this after the header -->
    <div class="lg:hidden">
        <!-- Mobile Sidebar -->
        <div id="mobile-menu" 
             x-cloak
             class="fixed inset-y-0 left-0 w-[85%] max-w-sm bg-white shadow-lg transform -translate-x-full transition-transform duration-300 ease-in-out z-50"
             :class="{ '-translate-x-full': !isOpen, 'translate-x-0': isOpen }">
            <!-- Header with logo and close button -->
            <div class="flex justify-between items-center p-4 border-b bg-gray-50">
                <button @click="closeMenu()" class="p-2 rounded-full hover:bg-gray-200 transition-colors duration-200">
                    <svg class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- User Profile Section -->
            <div class="p-4 border-b bg-gray-50">
                <div class="flex flex-col space-y-2">
                    <a href="auth/login.php" class="flex items-center py-3 px-4 text-gray-700 hover:bg-teal-50 hover:text-teal-600 rounded-lg transition-colors duration-200">
                        <svg class="h-5 w-5 mr-3 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        Login
                    </a>
                    <a href="auth/signup.php" class="flex items-center py-3 px-4 text-gray-700 hover:bg-teal-50 hover:text-teal-600 rounded-lg transition-colors duration-200">
                        <svg class="h-5 w-5 mr-3 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                        Sign Up
                    </a>
                </div>
            </div>

            <!-- Navigation Menu -->
            <nav class="overflow-y-auto h-full pb-20">
                <!-- Main Navigation -->
                <div class="p-4">
                    <h2 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Main Menu</h2>
                    <div class="space-y-2">
                        <a href="#top" class="flex items-center py-3 px-4 text-gray-700 hover:bg-teal-50 hover:text-teal-600 rounded-lg transition-colors duration-200">
                            <svg class="h-5 w-5 mr-3 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Home
                        </a>
                        <a href="#services" class="flex items-center py-3 px-4 text-gray-700 hover:bg-teal-50 hover:text-teal-600 rounded-lg transition-colors duration-200">
                            <svg class="h-5 w-5 mr-3 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            Services
                        </a>
                        <a href="#" 
                           @click.prevent="$dispatch('open-signup')" 
                           class="flex items-center py-3 px-4 text-gray-700 hover:bg-teal-50 hover:text-teal-600 rounded-lg transition-colors duration-200">
                            <svg class="h-5 w-5 mr-3 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Appointments
                        </a>
                    </div>
                </div>

                <!-- Categories Section -->
                <div class="p-4 border-t">
                    <h2 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Categories</h2>
                    <div class="space-y-2">
                        <a href="#" class="flex items-center py-3 px-4 text-gray-700 hover:bg-teal-50 hover:text-teal-600 rounded-lg transition-colors duration-200">
                            <svg class="h-5 w-5 mr-3 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Grooming
                        </a>
                        <a href="#" class="flex items-center py-3 px-4 text-gray-700 hover:bg-teal-50 hover:text-teal-600 rounded-lg transition-colors duration-200">
                            <svg class="h-5 w-5 mr-3 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                            </svg>
                            Pet Clinic
                        </a>
                    </div>
                </div>

                <!-- Settings Section -->
                <div class="p-4 border-t">
                    <h2 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Settings</h2>
                    <div class="space-y-2">
                        <a href="#" class="flex items-center py-3 px-4 text-gray-700 hover:bg-teal-50 hover:text-teal-600 rounded-lg transition-colors duration-200">
                            <svg class="h-5 w-5 mr-3 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Settings
                        </a>
                        <a href="#" class="flex items-center py-3 px-4 text-gray-700 hover:bg-teal-50 hover:text-teal-600 rounded-lg transition-colors duration-200">
                            <svg class="h-5 w-5 mr-3 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Terms & Privacy
                        </a>
                        
                    </div>
                </div>
            </nav>
        </div>

        <!-- Single Overlay -->
        <div id="mobile-menu-overlay" 
             x-cloak
             x-show="isOpen"
             class="fixed inset-0 bg-black/50 transition-opacity duration-300 ease-in-out z-40"
             @click="closeMenu">
        </div>
    </div>

    <!-- Update the main content container classes -->
    <div class="flex flex-1">
        <!-- Sidebar - Hide on mobile -->
        <aside class="hidden lg:block w-56 bg-gray-100 shadow-md flex-shrink-0">
            <nav class="flex-grow h-full">
                <div class="px-4 py-2">
                    <a href="#top" class="flex items-center py-2 px-4 text-gray-700 hover:bg-gray-200 hover:text-gray-900 rounded-md transition-colors duration-200">
                        <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Home
                    </a>
                    <a href="#services" class="flex items-center py-2 px-4 text-gray-700 hover:bg-gray-200 hover:text-gray-900 rounded-md transition-colors duration-200">
                        <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                        Services
                    </a>
                    <a href="#" 
                       @click.prevent="$dispatch('open-signup')"
                       class="flex items-center py-2 px-4 text-gray-700 hover:bg-gray-200 hover:text-gray-900 rounded-md transition-colors duration-200">
                        <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Appointments
                    </a>
                    <a href="#" class="flex items-center py-2 px-4 text-gray-700 hover:bg-gray-200 hover:text-gray-900 rounded-md transition-colors duration-200">
                        <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        Contact us
                    </a>
                </div>
                <div class="border-t border-gray-200 my-2"></div>
                <div class="px-4 py-2">
                    <h2 class="text-gray-500 text-sm font-semibold mb-2">CATEGORIES</h2>    
                    <a href="#" class="flex items-center py-2 px-4 text-gray-700 hover:bg-gray-200 hover:text-gray-900 rounded-md transition-colors duration-200">
                        <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Grooming
                    </a>
                    <a href="#" class="flex items-center py-2 px-4 text-gray-700 hover:bg-gray-200 hover:text-gray-900 rounded-md transition-colors duration-200">
                        <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                        </svg>
                        Pet Clinic
                    </a>
                </div>
                <div class="border-t border-gray-200 my-2"></div>
                <div class="px-4 py-2">
                    <h2 class="text-gray-500 text-sm font-semibold mb-2">HELP CENTER</h2>    
                    <a href="#" class="flex items-center py-2 px-4 text-gray-700 hover:bg-gray-200 hover:text-gray-900 rounded-md transition-colors duration-200">
                        <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        FAQs
                    </a>
                    <a href="#" class="flex items-center py-2 px-4 text-gray-700 hover:bg-gray-200 hover:text-gray-900 rounded-md transition-colors duration-200">
                        <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                        </svg>
                        Report an Issue
                    </a>
                </div>
                
                <div class="px-4 py-2">
                    <h2 class="text-gray-500 text-sm font-semibold mb-2">More From Us</h2>    
                    <a href="#" class="flex items-center py-2 px-4 text-gray-700 hover:bg-gray-200 hover:text-gray-900 rounded-md transition-colors duration-200">
                        <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Socials
                    </a>
                    <div class="border-t border-gray-200 my-2"></div>
                    <a href="#" class="flex items-center py-2 px-4 text-gray-700 hover:bg-gray-200 hover:text-gray-900 rounded-md transition-colors duration-200">
                        <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Settings
                    </a>
                    <a href="#" class="flex items-center py-2 px-4 text-gray-700 hover:bg-gray-200 hover:text-gray-900 rounded-md transition-colors duration-200">
                        <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Terms and Conditions
                    </a>
                    <a href="#" class="flex items-center py-2 px-4 text-gray-700 hover:bg-gray-200 hover:text-gray-900 rounded-md transition-colors duration-200">
                        <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Privacy Policy
                    </a>
                    
                </div>
        </aside>

        <!-- Main Content - Full width on mobile -->
        <main class="flex-1 overflow-y-auto bg-gray-100 px-4 lg:px-6">
            <!-- Hero Section -->
            <section class="bg-gray-100 rounded-lg my-6 p-4 lg:p-8 relative overflow-hidden">
                <div class="flex flex-col lg:flex-row justify-between items-center">
                    <div class="z-10 mb-8 lg:mb-0 lg:w-1/2 text-center lg:text-left">
                        <p class="text-gray-600 mb-2">No need to worry,</p>
                        <h2 class="text-4xl font-bold mb-4">We Provide Grooming and Vet Checks</h2>
                        <button @click="$dispatch('open-signup')" 
                                class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-full transition duration-300 ease-in-out mb-4">
                            Book now
                        </button>
                        <div class="relative">
                            <input type="text" placeholder="Nearest Groom/Veterinary" class="w-full px-4 py-2 border rounded-full text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <svg class="h-5 w-5 text-gray-400 absolute right-3 top-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="w-full lg:w-1/2 relative">
                        <img src="images/petdog.png" alt="Happy dog" class="w-full h-auto object-cover rounded-lg">
                    </div>
                </div>
            </section>

            <!-- Most Popular Section -->
            <section class="my-6">
                <h2 class="text-2xl font-semibold mb-4">Most Popular</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-6">
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
            <section id="services" class="my-6">
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

            <!-- Grooming Section -->
            <section class="my-6">
                <h2 class="text-2xl font-semibold mb-4">Grooming</h2>
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
        </main>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-auto">
        <div class="container mx-auto py-6 px-4">
            <div class="flex flex-col space-y-6">
                <div class="text-center lg:text-left">
                    <img src="images/logo.png" alt="Pet Care Connect Logo" class="h-10 mx-auto lg:mx-0">
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <h3 class="text-lg font-semibold mb-2">About Us</h3>
                        <p class="text-gray-300">Learn more about our mission and values.</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-2">Contact</h3>
                        <p class="text-gray-300">Email: info@petcareconnect.com</p>
                        <p class="text-gray-300">Phone: +1 (123) 456-7890</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-2">Follow Us</h3>
                        <div class="flex space-x-4">
                            <a href="#" class="text-gray-300 hover:text-white">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v-4" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </a>
                            <a href="#" class="text-gray-300 hover:text-white">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                </svg>
                            </a>
                            <a href="#" class="text-gray-300 hover:text-white">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="border-t border-gray-700 mt-8 pt-4 text-center text-sm text-gray-500">
            &copy; 2023 Pet Care Connect. All rights reserved.
        </div>
    </footer>

    <!-- Update the popup div -->
    <div id="signup-popup" 
         x-data="{ open: false }"
         x-show="open"
         @open-signup.window="open = true"
         class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
         style="display: none;">
        <div class="bg-white rounded-lg shadow-lg w-96 p-6 relative" @click.outside="open = false">
            <!-- Close button -->
            <button @click="open = false" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            
            <!-- Welcome message -->
            <h2 class="text-2xl font-bold text-center mb-4">Welcome to Pet Care Connect!</h2>
            
            <!-- Description -->
            <p class="text-gray-600 text-center mb-6">Join our community to access exclusive pet care services</p>
            
            <!-- Sign Up and Log In buttons -->
            <div class="flex justify-center space-x-4 mb-6">
                <a href="auth/signup.php" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-full flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                    Sign Up
                </a>
                <a href="auth/login.php" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-full flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                    </svg>
                    Log In
                </a>
            </div>
            
            <!-- Search bar -->
            <div class="relative">
                <input type="text" placeholder="Find Nearest Groom/Veterinary" class="w-full px-4 py-2 border rounded-full text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <svg class="h-5 w-5 text-gray-400 absolute right-3 top-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </div>
        </div>
    </div>

</body>
</html>
