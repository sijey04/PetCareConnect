<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ShopRegistrationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['showPreRegistration']);
    }

    public function showRegistrationForm()
    {
        if (auth()->user()->shop) {
            return redirect()->route('home')
                           ->with('error', 'You already have a registered shop.');
        }

        return view('shopRegistration.register');
    }

    public function showPreRegistration()
    {
        if (auth()->check() && auth()->user()->shop) {
            return redirect()->route('home')
                           ->with('error', 'You already have a registered shop.');
        }

        return view('shopRegistration.pre-register');
    }

    public function handlePreRegistration(Request $request)
    {
        if (auth()->check() && auth()->user()->shop) {
            return redirect()->route('home')
                           ->with('error', 'You already have a registered shop.');
        }

        if (!auth()->check()) {
            return redirect()->route('login')
                           ->with('message', 'Please login or create an account to register your shop.');
        }

        return redirect()->route('shop.register.form');
    }

    public function register(Request $request)
    {
        \Log::info('Session ID: ' . session()->getId());
        \Log::info('Auth check: ' . (auth()->check() ? 'true' : 'false'));
        \Log::info('User ID: ' . (auth()->id() ?? 'null'));
        
        if (!auth()->check()) {
            \Log::error('User not authenticated');
            return redirect()->route('login')
                            ->with('error', 'Please login to register your shop.');
        }

        \Log::info('Starting shop registration process');
        
        $validated = $request->validate([
            'shop_name' => 'required|string|max:255|unique:shops,name',
            'shop_type' => 'required|in:veterinary,grooming',
            'phone' => 'required|string|max:20',
            'description' => 'nullable|string',
            'address' => 'required|string',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'shop_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'tin' => 'required|string|max:255',
            'vat_status' => 'required|in:registered,non_registered',
            'bir_certificate' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'terms' => 'required|accepted'
        ]);

        \Log::info('Validation passed', $validated);

        try {
            DB::beginTransaction();

            // Store the files
            $imagePath = $request->file('shop_image')->store('shop-images', 'public');
            $birCertificatePath = $request->file('bir_certificate')->store('bir-certificates', 'public');

            \Log::info('Files stored successfully', [
                'image' => $imagePath,
                'certificate' => $birCertificatePath
            ]);

            // Create the shop with correct field mapping
            $shop = Shop::create([
                'user_id' => auth()->id(),
                'name' => $request->shop_name,
                'type' => $request->shop_type,
                'phone' => $request->phone,
                'description' => $request->description ?? '',
                'address' => $request->address,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'image' => $imagePath,
                'tin' => $request->tin,
                'vat_status' => $request->vat_status,
                'bir_certificate' => $birCertificatePath,
                'rating' => 0.0,
                'terms_accepted' => true
            ]);

            \Log::info('Shop created successfully', $shop->toArray());

            DB::commit();

            return redirect()->route('home')
                           ->with('success', 'Shop registered successfully! Welcome to Pet Care Connect.');

        } catch (\Exception $e) {
            DB::rollBack();
            
            \Log::error('Shop registration failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            // Clean up stored files if they exist
            if (isset($imagePath) && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }

            if (isset($birCertificatePath) && Storage::disk('public')->exists($birCertificatePath)) {
                Storage::disk('public')->delete($birCertificatePath);
            }

            return back()->withInput()
                        ->withErrors(['error' => 'An error occurred during registration. Please try again. ' . $e->getMessage()]);
        }
    }
} 