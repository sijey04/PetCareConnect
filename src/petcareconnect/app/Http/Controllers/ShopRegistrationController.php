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
            return redirect()->route('dashboard')
                           ->with('error', 'You already have a registered shop.');
        }

        return view('shopRegistration.register');
    }

    public function showPreRegistration()
    {
        if (auth()->check() && auth()->user()->shop) {
            return redirect()->route('dashboard')
                           ->with('error', 'You already have a registered shop.');
        }

        return view('shopRegistration.pre-register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'shop_name' => 'required|string|max:255|unique:shops,name',
            'shop_type' => 'required|in:veterinary,grooming',
            'description' => 'nullable|string',
            'address' => 'required|string',
            'shop_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'terms' => 'required|accepted',
            'tin' => 'required|string|max:255',
            'vat_status' => 'required|in:registered,non_registered',
            'bir_certificate' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048'
        ]);

        try {
            DB::beginTransaction();

            $imagePath = $request->file('shop_image')->store('shop-images', 'public');

            $shop = Shop::create([
                'name' => $request->shop_name,
                'type' => $request->shop_type,
                'description' => $request->description,
                'address' => $request->address,
                'image' => $imagePath,
                'rating' => 0.0,
                'user_id' => auth()->id()
            ]);

            DB::commit();

            return redirect()->route('dashboard')
                           ->with('success', 'Shop registered successfully! Welcome to Pet Care Connect.');

        } catch (\Exception $e) {
            DB::rollBack();
            
            if (isset($imagePath) && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }

            return back()->withInput()
                        ->withErrors(['error' => 'An error occurred during registration. Please try again.']);
        }
    }
} 