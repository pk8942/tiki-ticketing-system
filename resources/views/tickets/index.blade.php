<!-- resources/views/tickets/index.blade.php -->

@extends('layouts.app')
@section('content')
    <h2>Available Seats</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @foreach($trips as $trip)
        <h3>Available Seats for {{ $trip->location->name }} - {{ $trip->departure_date }}</h3>

        @if($trip->seatAllocations->isEmpty())
            <p>No seats allocated yet.</p>
        @else
            <ul>
                @foreach($trip->seatAllocations as $seatAllocation)
                    <li>
                        Seat {{ $seatAllocation->seat_number }} -
                        @if($seatAllocation->user)
                        {{ $seatAllocation->user->name }}
                        @else
                        <form action="{{ route('tickets.purchase') }}" method="POST">
                            @csrf
                            <input type="hidden" name="trip_id" value="{{ $trip->id }}">
                            <input type="hidden" name="seat_number" value="{{ $seatAllocation->seat_number }}">
                            <button type="submit" class="btn btn-primary">Purchase</button>
                        </form>
                    @endif

                    </li>
                @endforeach
            </ul>
        @endif
    @endforeach
@endsection
