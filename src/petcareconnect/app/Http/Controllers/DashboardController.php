<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $popularShops = collect([
            [
                'name' => 'Cassa De Perro Veterinary Clinic',
                'type' => 'Veterinary',
                'image' => 'images/shops/shop1.png',
                'rating' => '5.0',
                'address' => 'Tumaga- Lurawan Rd, Zamboanga, Zamboanga del Sur'
            ],
            [
                'name' => 'Paws and Claws',
                'type' => 'Grooming',
                'image' => 'images/shops/shop2.png',
                'rating' => '5.0',
                'address' => 'San Alfaro St, Zamboanga, 7000 Zamboanga del Sur'
            ],
            [
                'name' => 'Waltec',
                'type' => 'Veterinary',
                'image' => 'images/shops/shop3.png',
                'rating' => '5.0',
                'address' => 'Nuñez Ext. St, Zamboanga, Zamboanga del Sur'
            ]
        ])->map(function ($shop) {
            return (object) $shop;
        });

        return view('dashboard', compact('popularShops'));
    }
} 