<?php

// app/Http/Controllers/HomeController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trip;

class HomeController extends Controller
{
    public function index()
    {
        // Example: Fetching the latest trips from the database
        $latestTrips = Trip::orderBy('departure_date', 'desc')->take(5)->get();

        // You can add more logic here based on your requirements

        // Passing data to the view
        return view('home', ['latestTrips' => $latestTrips]);
    }
}
