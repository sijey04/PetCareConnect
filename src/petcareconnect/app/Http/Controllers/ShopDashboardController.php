<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', \App\Http\Middleware\HasShop::class]);
    }

    public function index()
    {
        $shop = auth()->user()->shop;
        session(['shop_mode' => true]);
        
        return view('shop.dashboard', compact('shop'));
    }

    public function switchToCustomerMode()
    {
        session()->forget('shop_mode');
        return redirect()->route('home');
    }
} 