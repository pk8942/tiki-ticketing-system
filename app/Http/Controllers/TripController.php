<?php

// app/Http/Controllers/TripController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Trip;

class TripController extends Controller
{
    public function index()
    {
        $trips = Trip::with('location')->get();
        return view('trips.index', compact('trips'));
    }


    public function create()
    {
        $locations = Location::all();
        return view('trips.create', compact('locations'));
    }

    public function store(Request $request)
    {
        // Validation rules
        $rules = [
            'departure_date' => 'required|date',
            'location_id' => 'required|exists:locations,id',
        ];

        // Validate the request
        $request->validate($rules);

        // Store the trip
        Trip::create([
            'departure_date' => $request->input('departure_date'),
            'location_id' => $request->input('location_id'),
        ]);

        return redirect()->route('trips.index')->with('success', 'Trip created successfully!');
    }

    public function edit($id)
    {
        $trip = Trip::findOrFail($id);
        $locations = Location::all();
        return view('trips.edit', compact('trip', 'locations'));
    }

    public function update(Request $request, $id)
    {
        // Validation rules
        $rules = [
            'departure_date' => 'required|date',
            'location_id' => 'required|exists:locations,id',
        ];

        // Validate the request
        $request->validate($rules);

        // Update the trip
        $trip = Trip::findOrFail($id);
        $trip->update([
            'departure_date' => $request->input('departure_date'),
            'location_id' => $request->input('location_id'),
        ]);

        return redirect()->route('trips.index')->with('success', 'Trip updated successfully!');
    }

    public function destroy($id)
    {
        $trip = Trip::findOrFail($id);
        $trip->delete();

        return redirect()->route('trips.index')->with('success', 'Trip deleted successfully!');
    }
}

