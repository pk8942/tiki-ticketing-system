<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trip;
use App\Models\SeatAllocation;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        $trips = Trip::with('location', 'seatAllocations.user')->get();

        return view('tickets.index', compact('trips'));
    }

    public function purchase(Request $request)
    {
        // Validation rules
        $rules = [
            'trip_id' => 'required|exists:trips,id',
            'seat_number' => 'required|integer|min:1|max:36',
        ];

        // Validate the request
        $request->validate($rules);

        // Check if the seat is available
        $trip = Trip::findOrFail($request->input('trip_id'));
        $isSeatAvailable = !$trip->seatAllocations()->where('seat_number', $request->input('seat_number'))->exists();

        if (!$isSeatAvailable) {
            return redirect()->route('tickets.index')->with('error', 'Selected seat is not available.');
        }

        // Allocate the seat to the user
        $user = auth()->user(); // Assuming you are using authentication
        SeatAllocation::create([
            'user_id' => $user->id,
            'trip_id' => $trip->id,
            'seat_number' => $request->input('seat_number'),
        ]);

        return redirect()->route('tickets.index')->with('success', 'Ticket purchased successfully!');
    }
}
