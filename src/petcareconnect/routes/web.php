<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ShopRegistrationController;
use App\Http\Controllers\ShopDashboardController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// Authentication routes
Auth::routes();

// Protected routes
Route::middleware(['auth'])->group(function () {
    
    Route::resource('appointments', AppointmentController::class);
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile/update-info', [ProfileController::class, 'updatePersonalInfo'])->name('profile.update-info');
    Route::post('/profile/update-photo', [ProfileController::class, 'updateProfilePhoto'])->name('profile.update-photo');
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::post('/profile/update-location', [ProfileController::class, 'updateLocation'])->name('profile.update-location');
    Route::post('/profile/pets', [ProfileController::class, 'storePet'])->name('profile.pets.store');
    Route::put('/profile/pets/{pet}', [ProfileController::class, 'updatePet'])->name('profile.pets.update');
    Route::delete('/profile/pets/{pet}', [ProfileController::class, 'deletePet'])->name('profile.pets.delete');
});

Route::get('/terms', function () {
    return view('pages.terms');
})->name('terms');

Route::get('/privacy', function () {
    return view('pages.privacy');
})->name('privacy');

// Add this route with your existing routes
Route::get('/book/{shop}', [BookingController::class, 'show'])->name('booking.show');

// Shop Registration Routes
Route::prefix('shop')->name('shop.')->group(function () {
    // Pre-registration routes
    Route::get('/pre-register', [ShopRegistrationController::class, 'showPreRegistration'])->name('pre.register');
    Route::post('/pre-register', [ShopRegistrationController::class, 'handlePreRegistration'])->name('pre.register.submit');
    
    // Main registration routes - ensure these are protected by auth middleware
    Route::middleware(['auth'])->group(function () {
        Route::get('/register', [ShopRegistrationController::class, 'showRegistrationForm'])->name('register.form');
        Route::post('/register', [ShopRegistrationController::class, 'register'])->name('register');
    });
});

Route::middleware(['auth', \App\Http\Middleware\HasShop::class])->group(function () {
    Route::get('/shop/dashboard', [ShopDashboardController::class, 'index'])->name('shop.dashboard');
    Route::post('/shop/mode/customer', [ShopDashboardController::class, 'switchToCustomerMode'])->name('shop.mode.customer');
});
