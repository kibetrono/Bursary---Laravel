 {{-- /Address Information --}}
 <div class="form-section">
    <div class="row">
        <div class="col-md-12 m-1">
            <h5 class="text-center text-bold">Address Information</h5>
        </div>

        <div class="col-md-4">
            <div class="form-group ward required">
                <label class="control-label" for="ward">Ward:</label>
                <select id="ward"
                    class="form-control @error('ward') is-invalid @enderror"
                    name="ward" aria-required="true" required>
                    <option value="">Select a ward</option>
                    @foreach ($wards as $ward)
                        <option value="{{ $ward->name }}"
                            {{ $bursaryapplied->ward == $ward->name ? 'selected' : '' }}>
                            {{ $ward->name }}
                        </option>
                    @endforeach
                </select>
                @error('ward')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>


        <div class="col-md-4">
            <div class="form-group location required">
                <label class="control-label" for="location">Location:</label>
                <select id="location"
                    class="form-control @error('location') is-invalid @enderror"
                    name="location" aria-required="true" required>
                    <option value="">Select a location</option>
                    @foreach ($locations as $location)
                        <option value="{{ $location->name }}"
                            {{ $bursaryapplied->location == $location->name ? 'selected' : '' }}>
                            {{ $location->name }}
                        </option>
                    @endforeach
                </select>
                @error('location')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group sub_location required">
                <label class="control-label" for="sub_location">Sub Location:</label>
                <select id="sub_location"
                    class="form-control @error('sub_location') is-invalid @enderror"
                    name="sub_location" aria-required="true" required>
                    <option value="">Select a sub location</option>
                    @foreach ($subLocations as $subLocation)
                        <option value="{{ $subLocation->name }}"
                            {{ $bursaryapplied->sub_location == $subLocation->name ? 'selected' : '' }}>
                            {{ $subLocation->name }}
                        </option>
                    @endforeach
                </select>
                @error('sub_location')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>


        <div class="col-md-4">
            <div class="form-group polling_station required">
                <label class="control-label" for="polling_station">Polling
                    Station:</label>
                <select id="polling_station"
                    class="form-control @error('polling_station') is-invalid @enderror"
                    name="polling_station" aria-required="true" required>
                    <option value="">Select a polling station</option>
                    @foreach ($pollingStations as $pollingStation)
                        <option value="{{ $pollingStation->name }}"
                            {{ $bursaryapplied->polling_station == $pollingStation->name ? 'selected' : '' }}>
                            {{ $pollingStation->name }}
                        </option>
                    @endforeach
                </select>
                @error('polling_station')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

    </div>
</div>
{{-- /Address Information --}}