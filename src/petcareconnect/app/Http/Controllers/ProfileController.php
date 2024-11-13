<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();
        $pets = $user->pets;
        $recentTransactions = [
            [
                'service' => 'DELUXE FUR CARE',
                'date' => '10/5/24'
            ],
            [
                'service' => 'DELUXE FUR CARE',
                'date' => '10/5/24'
            ]
        ];
        
        $recentVisits = [
            [
                'name' => 'Paws and Claws',
                'rating' => 5.0,
                'address' => 'Don Alfaro St, Zamboanga, 7000 Zamboanga del Sur',
                'image' => 'images/shops/shop1.png'
            ]
        ];

        return view('profile.index', compact('user', 'pets', 'recentTransactions', 'recentVisits'));
    }

    public function updatePersonalInfo(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        $user = auth()->user();
        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
        ]);

        return back()->with('success', 'Personal information updated successfully');
    }

    public function updateProfilePhoto(Request $request)
    {
        $request->validate([
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $user = auth()->user();

        if ($request->hasFile('profile_photo')) {
            // Delete old profile photo if exists
            if ($user->profile_photo_path) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }

            // Store new profile photo
            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $user->profile_photo_path = $path;
            $user->save();
        }

        return back()->with('success', 'Profile photo updated successfully');
    }

    public function updateLocation(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255',
        ]);

        $user = auth()->user();
        $user->update([
            'address' => $request->address,
        ]);

        return back()->with('success', 'Location updated successfully');
    }

    public function storePet(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'breed' => 'required|string|max:255',
            'weight' => 'required|string|max:255',
            'height' => 'required|string|max:255',
        ]);

        auth()->user()->pets()->create($request->all());

        return back()->with('success', 'Pet added successfully');
    }

    public function updatePet(Request $request, Pet $pet)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'breed' => 'required|string|max:255',
            'weight' => 'required|string|max:255',
            'height' => 'required|string|max:255',
        ]);

        $pet->update($request->all());

        return back()->with('success', 'Pet updated successfully');
    }

    public function deletePet(Pet $pet)
    {
        $pet->delete();
        return back()->with('success', 'Pet deleted successfully');
    }
} 