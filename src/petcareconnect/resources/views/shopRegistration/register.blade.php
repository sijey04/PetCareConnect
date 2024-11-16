    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <title>{{ config('app.name', 'Pet Care Connect') }}</title>
        
        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
        
        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        
        <!-- Alpine.js -->
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
        
        <!-- OpenStreetMap CSS and JS -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
        <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
        
        <!-- Add this in the <head> section, after the other style imports -->
        <style>
            /* Progress container styles */
            .progress-container {
                @apply relative w-full max-w-xs mx-auto py-4;
            }

            /* Vertical line */
            .progress-line {
                @apply absolute left-1/2 top-0 bottom-0 w-0.5 bg-gray-200 -translate-x-1/2;
                z-index: 0;
            }

            /* Active progress line */
            .progress-line-active {
                @apply absolute left-1/2 top-0 w-0.5 bg-indigo-600 -translate-x-1/2 transition-all duration-500;
                z-index: 1;
            }

            /* Steps container */
            .steps-container {
                @apply relative flex flex-col space-y-8;
            }

            /* Step item */
            .step-item {
                @apply flex flex-col items-center relative z-10;
            }

            /* Step number */
            .step-number {
                @apply w-8 h-8 rounded-full bg-white border-2 border-gray-300 flex items-center justify-center text-sm font-medium text-gray-500 mb-2;
                transition: all 0.3s ease;
            }

            /* Step label */
            .step-label {
                @apply text-sm text-gray-500 font-medium;
                transition: all 0.3s ease;
            }

            /* Active state */
            .step-item.active .step-number {
                @apply border-indigo-600 bg-indigo-600 text-white;
            }

            .step-item.active .step-label {
                @apply text-indigo-600 font-semibold;
            }

            /* Completed state */
            .step-item.completed .step-number {
                @apply border-indigo-600 bg-indigo-600 text-white;
            }

            .step-item.completed .step-label {
                @apply text-indigo-600;
            }
        </style>
    </head>
    <body class="bg-gray-100 font-[Poppins]">
        <div class="min-h-screen bg-custom-bg flex items-center justify-center p-4" 
             x-data="{ isStep4: false }"
             x-init="$watch('currentStep', value => isStep4 = value === 4)">
            <!-- Add logo outside the white box -->
            <a href="{{ route('home') }}" class="absolute top-4 left-4">
                <img src="{{ asset('images/logo.png') }}" alt="Pet Care Connect Logo" class="w-32 sm:w-40">
            </a>

            <!-- Update the white container box classes -->
            <div class="w-full space-y-8 px-4 sm:px-8 py-8 sm:py-10 bg-white rounded-3xl shadow-xl transition-all duration-300"
                 :class="{ 'max-w-md': !isStep4, 'max-w-6xl': isStep4 }">
                <!-- Header -->
                <div class="text-center">
                    <h2 class="text-1xl sm:text-3xl font-bold">Register Your Shop</h2>
                    <p class="text-gray-600 mt-2 text-sm sm:text-base">Complete the steps below</p>
                </div>

                <!-- Wrap everything in a parent Alpine component -->
                <div x-data="{ 
                    currentStep: 1,
                    showMap: false,
                    map: null,
                    marker: null,
                    address: '',
                    latitude: '',
                    longitude: '',
                    formData: {
                        shop_name: '',
                        shop_type: '',
                        phone: '',
                        tin: '',
                        vat_status: '',
                        bir_certificate: '',
                        shop_image: null,
                        shop_image_preview: null
                    },
                    updateFormData() {
                        this.formData = {
                            shop_name: document.querySelector('[name=shop_name]').value,
                            shop_type: document.querySelector('[name=shop_type]').value,
                            phone: document.querySelector('[name=phone]').value,
                            tin: document.querySelector('[name=tin]').value,
                            vat_status: document.querySelector('[name=vat_status]:checked')?.value,
                            bir_certificate: document.querySelector('[name=bir_certificate]').files[0]?.name,
                            shop_image: document.querySelector('[name=shop_image]').files[0],
                            shop_image_preview: this.formData.shop_image_preview
                        }
                    },
                    nextStep() {
                        if (this.currentStep < 4) {
                            this.updateFormData();
                            this.currentStep++;
                        }
                    },
                    prevStep() {
                        if (this.currentStep > 1) {
                            this.currentStep--;
                        }
                    },
                    initMap() {
                        this.$nextTick(() => {
                            if (!this.map) {
                                console.log('Initializing map...');
                                try {
                                    // Wait for the modal to be fully visible
                                    setTimeout(() => {
                                        this.map = L.map('map').setView([6.9214, 122.0790], 13);
                                        
                                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                            attribution: '© OpenStreetMap contributors'
                                        }).addTo(this.map);

                                        // Add geocoder control
                                        const geocoder = L.Control.geocoder({
                                            defaultMarkGeocode: false
                                        })
                                        .on('markgeocode', (e) => {
                                            const { center, name } = e.geocode;
                                            if (this.marker) {
                                                this.marker.setLatLng(center);
                                            } else {
                                                this.marker = L.marker(center).addTo(this.map);
                                            }
                                            this.map.setView(center, 16);
                                            this.latitude = center.lat;
                                            this.longitude = center.lng;
                                            this.address = name;
                                        })
                                        .addTo(this.map);

                                        // Handle map clicks
                                        this.map.on('click', (e) => {
                                            const { lat, lng } = e.latlng;
                                            if (this.marker) {
                                                this.marker.setLatLng([lat, lng]);
                                            } else {
                                                this.marker = L.marker([lat, lng]).addTo(this.map);
                                            }
                                            this.latitude = lat;
                                            this.longitude = lng;
                                            
                                            // Reverse geocode the clicked location
                                            fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`)
                                                .then(response => response.json())
                                                .then(data => {
                                                    this.address = data.display_name;
                                                });
                                        });

                                        // Force map to update its size
                                        this.map.invalidateSize();
                                    }, 100);
                                } catch (error) {
                                    console.error('Error initializing map:', error);
                                }
                            } else {
                                // If map already exists, just update its size
                                this.map.invalidateSize();
                            }
                        });
                    },
                    confirmLocation() {
                        this.showMap = false;
                    }
                }">
                    <!-- Progress Steps -->
                    <div class="mb-24">
                        <div class="flex justify-between relative">
                            <!-- Background Line -->
                            <div class="absolute top-4 left-0 right-0 h-[1px] bg-gray-200"></div>
                            
                            <!-- Active Line (grows as steps progress) -->
                            <div class="absolute top-4 left-0 h-[1px] bg-indigo-600 transition-all duration-500"
                                 :style="`width: ${((currentStep - 1) / 3) * 100}%`"></div>
                            
                            <!-- Steps -->
                            <div class="relative flex justify-between w-full px-8">
                                <!-- Step 1 -->
                                <div class="relative flex flex-col items-center">
                                    <div class="w-8 h-8 rounded-full border border-gray-300 transition-colors duration-300 flex items-center justify-center bg-white z-10 text-sm"
                                         :class="currentStep >= 1 ? 'border-indigo-600 bg-indigo-600 text-white' : 'text-gray-500'">
                                        1
                                    </div>
                                    <div class="absolute mt-16 text-xs font-medium text-center w-max"
                                         :class="currentStep >= 1 ? 'text-indigo-600' : 'text-gray-500'">
                                        Basic Info
                                    </div>
                                </div>

                                <!-- Step 2 -->
                                <div class="relative flex flex-col items-center">
                                    <div class="w-8 h-8 rounded-full border border-gray-300 transition-colors duration-300 flex items-center justify-center bg-white z-10 text-sm"
                                         :class="currentStep >= 2 ? 'border-indigo-600 bg-indigo-600 text-white' : 'text-gray-500'">
                                        2
                                    </div>
                                    <div class="absolute mt-16 text-xs font-medium text-center w-max"
                                         :class="currentStep >= 2 ? 'text-indigo-600' : 'text-gray-500'">
                                        Contact
                                    </div>
                                </div>

                                <!-- Step 3 -->
                                <div class="relative flex flex-col items-center">
                                    <div class="w-8 h-8 rounded-full border border-gray-300 transition-colors duration-300 flex items-center justify-center bg-white z-10 text-sm"
                                         :class="currentStep >= 3 ? 'border-indigo-600 bg-indigo-600 text-white' : 'text-gray-500'">
                                        3
                                    </div>
                                    <div class="absolute mt-16 text-xs font-medium text-center w-max"
                                         :class="currentStep >= 3 ? 'text-indigo-600' : 'text-gray-500'">
                                        Services
                                    </div>
                                </div>

                                <!-- Step 4 -->
                                <div class="relative flex flex-col items-center">
                                    <div class="w-8 h-8 rounded-full border border-gray-300 transition-colors duration-300 flex items-center justify-center bg-white z-10 text-sm"
                                         :class="currentStep >= 4 ? 'border-indigo-600 bg-indigo-600 text-white' : 'text-gray-500'">
                                        4
                                    </div>
                                    <div class="absolute mt-16 text-xs font-medium text-center w-max"
                                         :class="currentStep >= 4 ? 'text-indigo-600' : 'text-gray-500'">
                                        Review
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Error Messages -->
                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                            @foreach ($errors->all() as $error)
                                <span class="block sm:inline">{{ $error }}</span>
                            @endforeach
                        </div>
                    @endif

                    <!-- Registration Form -->
                    <form method="POST" 
                        action="{{ route('shop.register') }}" 
                        class="space-y-6" 
                        enctype="multipart/form-data"
                        x-data="{ 
                            currentStep: 1,
                            showMap: false,
                            map: null,
                            marker: null,
                            address: '',
                            latitude: '',
                            longitude: '',
                            formData: {
                                shop_name: '',
                                shop_type: '',
                                phone: '',
                                tin: '',
                                vat_status: '',
                                bir_certificate: '',
                                shop_image: null,
                                shop_image_preview: null
                            },
                            updateFormData() {
                                this.formData = {
                                    shop_name: document.querySelector('[name=shop_name]').value,
                                    shop_type: document.querySelector('[name=shop_type]').value,
                                    phone: document.querySelector('[name=phone]').value,
                                    tin: document.querySelector('[name=tin]').value,
                                    vat_status: document.querySelector('[name=vat_status]:checked')?.value,
                                    bir_certificate: document.querySelector('[name=bir_certificate]').files[0]?.name,
                                    shop_image: document.querySelector('[name=shop_image]').files[0],
                                    shop_image_preview: this.formData.shop_image_preview
                                }
                            },
                            nextStep() {
                                if (this.currentStep < 4) {
                                    this.updateFormData();
                                    this.currentStep++;
                                }
                            },
                            prevStep() {
                                if (this.currentStep > 1) {
                                    this.currentStep--;
                                }
                            },
                            initMap() {
                                this.$nextTick(() => {
                                    if (!this.map) {
                                        console.log('Initializing map...');
                                        try {
                                            // Wait for the modal to be fully visible
                                            setTimeout(() => {
                                                this.map = L.map('map').setView([6.9214, 122.0790], 13);
                                                
                                                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                                    attribution: '© OpenStreetMap contributors'
                                                }).addTo(this.map);

                                                // Add geocoder control
                                                const geocoder = L.Control.geocoder({
                                                    defaultMarkGeocode: false
                                                })
                                                .on('markgeocode', (e) => {
                                                    const { center, name } = e.geocode;
                                                    if (this.marker) {
                                                        this.marker.setLatLng(center);
                                                    } else {
                                                        this.marker = L.marker(center).addTo(this.map);
                                                    }
                                                    this.map.setView(center, 16);
                                                    this.latitude = center.lat;
                                                    this.longitude = center.lng;
                                                    this.address = name;
                                                })
                                                .addTo(this.map);

                                                // Handle map clicks
                                                this.map.on('click', (e) => {
                                                    const { lat, lng } = e.latlng;
                                                    if (this.marker) {
                                                        this.marker.setLatLng([lat, lng]);
                                                    } else {
                                                        this.marker = L.marker([lat, lng]).addTo(this.map);
                                                    }
                                                    this.latitude = lat;
                                                    this.longitude = lng;
                                                    
                                                    // Reverse geocode the clicked location
                                                    fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`)
                                                        .then(response => response.json())
                                                        .then(data => {
                                                            this.address = data.display_name;
                                                        });
                                                });

                                                // Force map to update its size
                                                this.map.invalidateSize();
                                            }, 100);
                                        } catch (error) {
                                            console.error('Error initializing map:', error);
                                        }
                                    } else {
                                        // If map already exists, just update its size
                                        this.map.invalidateSize();
                                    }
                                });
                            },
                            confirmLocation() {
                                this.showMap = false;
                            }
                        }">
                        @csrf
                        
                        <!-- Step 1: Basic Information -->
                        <div x-show="currentStep === 1">
                            <div class="space-y-4">
                                <!-- Shop Image Upload -->
                                <div class="space-y-2">
                                    <label class="block text-sm text-gray-700">Shop Profile Image</label>
                                    <div class="flex items-center space-x-2">
                                        <!-- Image Preview -->
                                        <div class="relative w-24 h-24 rounded-lg overflow-hidden bg-gray-100">
                                            <img 
                                                x-show="formData.shop_image_preview"
                                                :src="formData.shop_image_preview"
                                                class="w-full h-full object-cover"
                                                alt="Shop preview">
                                            <div 
                                                x-show="!formData.shop_image_preview"
                                                class="w-full h-full flex items-center justify-center text-gray-400">
                                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                            </div>
                                        </div>
                                        
                                        <!-- Upload Button -->
                                        <div class="flex-1">
                                            <input type="file" 
                                                name="shop_image" 
                                                accept="image/jpeg,image/png,image/jpg"
                                                @change="const file = $event.target.files[0];
                                                        if (file) {
                                                            formData.shop_image = file;
                                                            const reader = new FileReader();
                                                            reader.onload = (e) => {
                                                                formData.shop_image_preview = e.target.result;
                                                            };
                                                            reader.readAsDataURL(file);
                                                        }"
                                                class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-custom-blue file:text-white hover:file:bg-blue-600">
                                            <p class="mt-1 text-xs text-gray-500">
                                                Recommended: Square image, minimum 500x500 pixels (Max 2MB)
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Existing fields -->
                                <div>
                                    <input type="text" 
                                        name="shop_name" 
                                        placeholder="Shop Name"
                                        x-model="formData.shop_name"
                                        class="w-full px-3 py-2 text-sm sm:text-base border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-custom-blue focus:border-custom-blue">
                                </div>
                                <div>
                                    <select name="shop_type" 
                                            x-model="formData.shop_type"
                                            class="w-full px-3 py-2 text-sm sm:text-base border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-custom-blue focus:border-custom-blue">
                                        <option value="">Select Shop Type</option>
                                        <option value="veterinary">Veterinary Clinic</option>
                                        <option value="grooming">Grooming Shop</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Step 2: Contact Information -->
                        <div x-show="currentStep === 2">
                            <!-- Add hidden fields for coordinates -->
                            <input type="hidden" name="latitude" x-model="latitude">
                            <input type="hidden" name="longitude" x-model="longitude">
                            <input type="hidden" name="address" x-model="address">
                            
                            <div class="space-y-4">
                                <div>
                                    <input type="tel" 
                                        name="phone" 
                                        placeholder="Contact Number"
                                        class="w-full px-3 py-2 text-sm sm:text-base border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-custom-blue focus:border-custom-blue">
                                </div>
                                <div class="relative">
                                    <div class="flex items-center">
                                        <input type="text" 
                                            name="address" 
                                            id="address"
                                            placeholder="Shop Address"
                                            x-model="address"
                                            class="w-full px-3 py-2 text-sm sm:text-base border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-custom-blue focus:border-custom-blue">
                                        <button type="button" 
                                                @click="showMap = true"
                                                class="absolute right-2 p-2 text-gray-400 hover:text-gray-600">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Map Modal -->
                            <div x-show="showMap" 
                                class="fixed inset-0 z-50 overflow-y-auto" 
                                aria-labelledby="map-modal" 
                                role="dialog" 
                                aria-modal="true"
                                x-init="$watch('showMap', value => { if(value) { initMap() } })">
                                <!-- Backdrop -->
                                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity z-40"></div>

                                <!-- Modal Panel -->
                                <div class="fixed inset-0 z-50 overflow-y-auto">
                                    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                                        <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                                            <div class="absolute right-0 top-0 pr-4 pt-4">
                                                <button type="button" 
                                                        @click="showMap = false"
                                                        class="rounded-md bg-white text-gray-400 hover:text-gray-500">
                                                    <span class="sr-only">Close</span>
                                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>

                                            <!-- Map Container -->
                                            <div class="mt-3 text-center sm:mt-0 sm:text-left">
                                                <h3 class="text-lg font-semibold leading-6 text-gray-900 mb-4">
                                                    Select Location
                                                </h3>
                                                <div class="mt-2">
                                                    <div id="map" class="h-96 w-full rounded-lg z-50" style="min-height: 400px;"></div>
                                                </div>
                                            </div>

                                            <!-- Action Buttons -->
                                            <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                                                <button type="button"
                                                        @click="confirmLocation"
                                                        class="inline-flex w-full justify-center rounded-md bg-custom-blue px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-600 sm:ml-3 sm:w-auto">
                                                    Confirm Location
                                                </button>
                                                <button type="button"
                                                        @click="showMap = false"
                                                        class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">
                                                    Cancel
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 3: Services -->
                        <div x-show="currentStep === 3">
                            <div class="space-y-4">
                                <!-- Business Information -->
                                <div>
                                    <input type="text" 
                                        name="tin" 
                                        placeholder="Tax Identification Number (TIN)"
                                        class="w-full px-3 py-2 text-sm sm:text-base border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-custom-blue focus:border-custom-blue">
                                </div>
                                
                                <div class="space-y-2">
                                    <label class="block text-sm text-gray-700">Value Added Tax Registration Status</label>
                                    <div class="flex gap-4">
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="vat_status" value="registered" class="form-radio text-custom-blue">
                                            <span class="ml-2">VAT Registered</span>
                                        </label>
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="vat_status" value="non_registered" class="form-radio text-custom-blue">
                                            <span class="ml-2">Non-VAT Registered</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="space-y-2">
                                    <label class="block text-sm text-gray-700">BIR Certificate of Registration</label>
                                    <div class="flex items-center space-x-2">
                                        <input type="file" 
                                            name="bir_certificate" 
                                            accept=".pdf,.jpg,.jpeg,.png"
                                            class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-custom-blue file:text-white hover:file:bg-blue-600">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 4: Review -->
                        <div x-show="currentStep === 4" class="min-h-[600px] w-full">
                            <div class="space-y-6 px-6">
                                <!-- Basic Information Review -->
                                <div class="bg-gray-50 rounded-lg p-8">
                                    <h3 class="text-xl font-semibold text-gray-900 mb-6">Basic Information</h3>
                                    <div class="grid grid-cols-2 gap-x-12 gap-y-6">
                                        <div>
                                            <p class="text-sm font-medium text-gray-500">Shop Name</p>
                                            <p class="mt-2 text-lg" x-text="formData.shop_name"></p>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-500">Shop Type</p>
                                            <p class="mt-2 text-lg" x-text="formData.shop_type === 'veterinary' ? 'Veterinary Clinic' : 'Grooming Shop'"></p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Contact Information Review -->
                                <div class="bg-gray-50 rounded-lg p-8">
                                    <h3 class="text-xl font-semibold text-gray-900 mb-6">Contact Information</h3>
                                    <div class="grid grid-cols-2 gap-x-12 gap-y-6">
                                        <div>
                                            <p class="text-sm font-medium text-gray-500">Phone Number</p>
                                            <p class="mt-2 text-lg" x-text="formData.phone"></p>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-500">Address</p>
                                            <p class="mt-2 text-lg" x-text="address"></p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Business Information Review -->
                                <div class="bg-gray-50 rounded-lg p-8">
                                    <h3 class="text-xl font-semibold text-gray-900 mb-6">Business Information</h3>
                                    <div class="grid grid-cols-2 gap-x-12 gap-y-6">
                                        <div>
                                            <p class="text-sm font-medium text-gray-500">TIN</p>
                                            <p class="mt-2 text-lg" x-text="formData.tin"></p>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-500">VAT Status</p>
                                            <p class="mt-2 text-lg" x-text="formData.vat_status === 'registered' ? 'VAT Registered' : 'Non-VAT Registered'"></p>
                                        </div>
                                        <div class="col-span-2">
                                            <p class="text-sm font-medium text-gray-500">BIR Certificate</p>
                                            <p class="mt-2 text-lg" x-text="formData.bir_certificate || 'No file selected'"></p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Terms and Conditions -->
                                <div class="bg-gray-50 rounded-lg p-8">
                                    <label class="flex items-start">
                                        <input type="checkbox" 
                                               name="terms" 
                                               class="form-checkbox h-5 w-5 text-custom-blue mt-1">
                                        <span class="ml-3 text-base text-gray-600 flex-1">
                                               I confirm that all the information provided is accurate and I agree to the 
                                            <a href="{{ route('terms') }}" class="text-custom-blue hover:underline" target="_blank">Terms and Conditions</a>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Navigation Buttons -->
                        <div class="flex justify-between gap-4 mt-6">
                            <button type="button" 
                                    x-show="currentStep > 1"
                                    @click="prevStep()"
                                    class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-custom-blue">
                                Back
                            </button>
                            
                            <button type="button" 
                                    x-show="currentStep < 4"
                                    @click="nextStep()"
                                    class="ml-auto px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-custom-blue hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-custom-blue">
                                Continue
                            </button>

                            <button type="submit" 
                                    x-show="currentStep === 4"
                                    class="ml-auto px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-custom-blue hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-custom-blue">
                                Complete Registration
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Help Text -->
                <p class="text-center text-xs sm:text-sm text-gray-600 mt-4">
                    Need help? 
                    <a href="#" class="text-custom-blue hover:underline">
                        Contact Support
                    </a>
                </p>
            </div>
        </div>

        <script>
            function getStepName(step) {
                const steps = {
                    1: 'Basic Info',
                    2: 'Contact',
                    3: 'Services',
                    4: 'Review'
                };
                return steps[step] || '';
            }

            document.addEventListener('DOMContentLoaded', function() {
                console.log('Leaflet loaded:', typeof L !== 'undefined');
            });
        </script>
    </body>
    </html>    