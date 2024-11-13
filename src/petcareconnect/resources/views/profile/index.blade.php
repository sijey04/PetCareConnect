@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('home') }}" class="flex items-center text-gray-600 hover:text-gray-900">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Back
        </a>
    </div>

    <!-- Profile Header -->
    <div class="flex flex-col items-center mb-8">
        <div class="relative">
            <img src="{{ $user->profile_photo_url }}" alt="Profile Photo" class="w-32 h-32 rounded-full object-cover">
            <form action="{{ route('profile.update-photo') }}" method="POST" enctype="multipart/form-data" class="absolute bottom-0 right-0">
                @csrf
                <label for="profile_photo" class="cursor-pointer bg-white rounded-full p-2 shadow-md">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </label>
                <input type="file" id="profile_photo" name="profile_photo" class="hidden" onchange="this.form.submit()">
            </form>
        </div>
        <h1 class="text-2xl font-bold mt-4">{{ $user->first_name }} {{ $user->last_name }}</h1>
    </div>

    <!-- Personal Info Section -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">Personal Info</h2>
            <button type="submit" form="personal-info-form" class="bg-teal-500 text-white px-4 py-2 rounded-md hover:bg-teal-600">
                Save Changes
            </button>
        </div>
        <form id="personal-info-form" action="{{ route('profile.update-info') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">First Name</label>
                    <input type="text" name="first_name" value="{{ $user->first_name }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Last Name</label>
                    <input type="text" name="last_name" value="{{ $user->last_name }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Phone</label>
                    <input type="text" name="phone" value="{{ $user->phone }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                </div>
            </div>
        </form>
    </div>

    <!-- Location Section -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8 relative" x-data="{ isEditing: false }">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">Location</h2>
            <button type="button" 
                    @click="isEditing = !isEditing" 
                    class="text-teal-500 hover:text-teal-600">
                <span x-text="isEditing ? 'Cancel' : 'Edit'"></span>
            </button>
        </div>
        <!-- Location Display -->
        <div x-show="!isEditing" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             class="min-h-[24px]">
            <p class="text-gray-600">{{ $user->address ?? 'No address set' }}</p>
        </div>
        <!-- Location Edit Form -->
        <div x-show="isEditing"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform scale-y-0"
             x-transition:enter-end="opacity-100 transform scale-y-100"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100 transform scale-y-100"
             x-transition:leave-end="opacity-0 transform scale-y-0">
            <form action="{{ route('profile.update-location') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Address</label>
                        <input type="text" 
                               name="address" 
                               value="{{ $user->address }}" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                    </div>
                    <div class="flex justify-end space-x-3">
                        <button type="button" 
                                @click="isEditing = false" 
                                class="text-teal-500 hover:text-teal-600">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="px-4 py-2 bg-teal-500 text-white rounded-md hover:bg-teal-600">
                            Save Changes
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Registered Pets Section -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8 relative" 
         x-data="{ 
            showAddForm: false,
            editingPet: null,
            toggleEdit(petId) {
                this.editingPet = this.editingPet === petId ? null : petId;
            },
            deletePet(petId) {
                if (confirm('Are you sure you want to delete this pet?')) {
                    document.getElementById(`delete-pet-form-${petId}`).submit();
                }
            }
         }">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">Registered Pets</h2>
            <div class="flex items-center space-x-4">
                <input type="text" placeholder="Filter" class="border rounded-md px-3 py-1">
                <button @click="showAddForm = !showAddForm" 
                        class="bg-teal-500 text-white p-2 rounded-full hover:bg-teal-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Add Pet Form -->
        <div x-show="showAddForm" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform scale-y-0"
             x-transition:enter-end="opacity-100 transform scale-y-100"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100 transform scale-y-100"
             x-transition:leave-end="opacity-0 transform scale-y-0"
             class="mb-6 bg-gray-50 p-4 rounded-lg border border-gray-200">
            <form action="{{ route('profile.pets.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pet Name</label>
                        <input type="text" name="name" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Type</label>
                        <select name="type" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                            <option value="">Select Type</option>
                            <option value="Dog">Dog</option>
                            <option value="Cat">Cat</option>
                            <option value="Bird">Bird</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Breed</label>
                        <input type="text" name="breed" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Weight</label>
                        <input type="text" name="weight" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Height</label>
                        <input type="text" name="height" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                    </div>
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" 
                            @click="showAddForm = false" 
                            class="text-teal-500 hover:text-teal-600">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 bg-teal-500 text-white rounded-md hover:bg-teal-600">
                        Add Pet
                    </button>
                </div>
            </form>
        </div>

        <!-- Pets Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="text-left text-gray-500">
                        <th class="pb-4">Name</th>
                        <th class="pb-4">Type</th>
                        <th class="pb-4">Breed</th>
                        <th class="pb-4">Weight</th>
                        <th class="pb-4">Height</th>
                        <th class="pb-4"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pets as $pet)
                    <tr class="border-t" :class="{ 'opacity-50': editingPet === {{ $pet->id }} }">
                        <td class="py-4">{{ $pet->name }}</td>
                        <td class="py-4">{{ $pet->type }}</td>
                        <td class="py-4">{{ $pet->breed }}</td>
                        <td class="py-4">{{ $pet->weight }}</td>
                        <td class="py-4">{{ $pet->height }}</td>
                        <td class="py-4">
                            <div class="flex space-x-2">
                                <button @click="toggleEdit({{ $pet->id }})" 
                                        class="text-blue-500 hover:text-blue-700">
                                    Edit
                                </button>
                                <button @click="deletePet({{ $pet->id }})" 
                                        class="text-red-500 hover:text-red-700">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <!-- Edit Pet Form Row -->
                    <tr x-show="editingPet === {{ $pet->id }}"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform scale-y-0"
                        x-transition:enter-end="opacity-100 transform scale-y-100"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 transform scale-y-100"
                        x-transition:leave-end="opacity-0 transform scale-y-0"
                        class="border-t bg-gray-50">
                        <td colspan="6" class="py-4">
                            <form action="{{ route('profile.pets.update', $pet) }}" method="POST" class="p-4">
                                @csrf
                                @method('PUT')
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Pet Name</label>
                                        <input type="text" name="name" value="{{ $pet->name }}" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Type</label>
                                        <select name="type" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                                            <option value="Dog" {{ $pet->type == 'Dog' ? 'selected' : '' }}>Dog</option>
                                            <option value="Cat" {{ $pet->type == 'Cat' ? 'selected' : '' }}>Cat</option>
                                            <option value="Bird" {{ $pet->type == 'Bird' ? 'selected' : '' }}>Bird</option>
                                            <option value="Other" {{ $pet->type == 'Other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Breed</label>
                                        <input type="text" name="breed" value="{{ $pet->breed }}" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Weight</label>
                                        <input type="text" name="weight" value="{{ $pet->weight }}" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Height</label>
                                        <input type="text" name="height" value="{{ $pet->height }}" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                                    </div>
                                </div>
                                <div class="flex justify-end space-x-3">
                                    <button type="button" 
                                            @click="editingPet = null" 
                                            class="text-teal-500 hover:text-teal-600">
                                        Cancel
                                    </button>
                                    <button type="submit" 
                                            class="px-4 py-2 bg-teal-500 text-white rounded-md hover:bg-teal-600">
                                        Save Changes
                                    </button>
                                </div>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Recent Transactions Section -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">Recent Transactions</h2>
            <input type="text" placeholder="Filter" class="border rounded-md px-3 py-1">
        </div>
        <div class="space-y-4">
            @foreach($recentTransactions as $transaction)
            <div class="flex justify-between items-center">
                <span>{{ $transaction['service'] }}</span>
                <span class="text-gray-500">{{ $transaction['date'] }}</span>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Recent Visits Section -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">Recent Visits</h2>
            <input type="text" placeholder="Filter" class="border rounded-md px-3 py-1">
        </div>
        <div class="space-y-4">
            @foreach($recentVisits as $visit)
            <div class="flex items-center space-x-4">
                <img src="{{ asset($visit['image']) }}" alt="{{ $visit['name'] }}" class="w-16 h-16 object-cover rounded-lg">
                <div>
                    <h3 class="font-semibold">{{ $visit['name'] }}</h3>
                    <div class="flex items-center text-yellow-400">
                        <span>★★★★★</span>
                        <span class="ml-1 text-gray-600">{{ $visit['rating'] }}</span>
                    </div>
                    <p class="text-gray-600 text-sm">{{ $visit['address'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    
</div>
@endsection 