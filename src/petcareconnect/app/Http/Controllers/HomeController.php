<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('dashboard');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Get popular shops for both guests and authenticated users
        $popularShops = Shop::withAvg('ratings', 'rating')
            ->orderBy('ratings_avg_rating', 'desc')
            ->take(6)
            ->get();

        $services = [
            (object)[
                'name' => 'Dog Grooming',
                'description' => 'Professional grooming services for all breeds'
            ],
            (object)[
                'name' => 'Dog Walking',
                'description' => 'Regular exercise and outdoor activities'
            ],
            (object)[
                'name' => 'Pet Sitting',
                'description' => 'In-home care when you\'re away'
            ]
        ];

        // Use the same home view for both guests and authenticated users
        return view('home', compact('popularShops', 'services'));
    }

    public function dashboard()
    {
        $popularShops = Shop::withAvg('ratings', 'rating')
            ->orderBy('ratings_avg_rating', 'desc')
            ->take(6)
            ->get();
            
        $services = [
            (object)[
                'name' => 'Dog Grooming',
                'description' => 'Professional grooming services for all breeds'
            ],
            (object)[
                'name' => 'Dog Walking',
                'description' => 'Regular exercise and outdoor activities'
            ],
            (object)[
                'name' => 'Pet Sitting',
                'description' => 'In-home care when you\'re away'
            ]
        ];
        
        return view('dashboard', compact('services', 'popularShops'));
    }
} 