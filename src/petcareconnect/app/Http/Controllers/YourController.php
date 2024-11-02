<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class YourController extends Controller
{
    public function index()
    {
        $services = Service::all(); // Assuming you have a Service model
        return view('your-view-name', compact('services'));
    }
} 