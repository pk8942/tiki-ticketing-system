<!-- resources/views/trips/_form.blade.php -->

<form action="{{ isset($trip) ? route('trips.update', $trip->id) : route('trips.store') }}" method="POST">
    @csrf

    @if(isset($trip))
        @method('PUT')
    @endif

    <label for="location_id">Select Location:</label>
    <select name="location_id" id="location_id" required>
        @foreach($locations as $location)
            <option value="{{ $location->id }}" {{ (isset($trip) && $trip->location_id == $location->id) ? 'selected' : '' }}>{{ $location->name }}</option>
        @endforeach
    </select>

    <label for="departure_date">Departure Date:</label>
    <input type="date" name="departure_date" id="departure_date" value="{{ isset($trip) ? $trip->departure_date : '' }}" required>

    <button type="submit">{{ isset($trip) ? 'Update' : 'Create' }} Trip</button>
</form>
