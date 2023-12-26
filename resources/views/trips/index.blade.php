<!-- resources/views/trips/index.blade.php -->

@extends('layouts.app')

@section('content')
    <h2>Trips</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Location</th>
                <th>Departure Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($trips as $trip)
                <tr>
                    <td>{{ $trip->id }}</td>
                    <td>{{ $trip->location->name }}</td>
                    <td>{{ $trip->departure_date }}</td>
                    <td>
                        <a href="{{ route('trips.edit', $trip->id) }}">Edit</a>
                        <form action="{{ route('trips.destroy', $trip->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
