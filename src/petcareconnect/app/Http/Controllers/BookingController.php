<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function show(Shop $shop)
    {
        return view('booking.book', compact('shop'));
    }
} 