<!-- resources/views/home.blade.php -->

@extends('layouts.app')

@section('content')
    <h2>Welcome to the Tiki Online Ticketing System</h2>

    @if(count($latestTrips) > 0)
        <h3>Latest Trips:</h3>
        <ul>
            @foreach($latestTrips as $trip)
            <li>{{ optional($trip->location)->name }} - {{ $trip->departure_date }}</li>

            @endforeach
        </ul>
    @else
        <p>No trips available at the moment.</p>
    @endif
@endsection
