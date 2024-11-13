<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ShopRegistrationController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// Authentication routes
Auth::routes();

// Protected routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('appointments', AppointmentController::class);
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
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
    Route::get('/register', [ShopRegistrationController::class, 'showPreRegistration'])->name('register');
    Route::get('/register/form', [ShopRegistrationController::class, 'showRegistrationForm'])->name('register.form')->middleware('auth');
    Route::post('/register', [ShopRegistrationController::class, 'register'])->name('register.store')->middleware('auth');
});

Route::get('/shop/pre-register', [ShopRegistrationController::class, 'showPreRegistration'])->name('shop.register');
Route::get('/shop/register', [ShopRegistrationController::class, 'showRegistrationForm'])->name('shop.register.form');
Route::post('/shop/register', [ShopRegistrationController::class, 'register']);
