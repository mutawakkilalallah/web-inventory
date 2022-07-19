@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <form action="/device/update/{{ $device->device_id }}" method="POST">
                @csrf
                @method('PUT')

                @if ($device->device_status == 'out')
                    <div class="mb-3">
                        <label for="number" class="form-label">Serial Number</label>
                        <input type="text" class="form-control" id="number" name="number"
                            value="{{ $device->number }}" autofocus>
                    </div>
                    <div class="mb-3">
                        <label for="type_id" class="form-label">Model</label>
                        <select class="form-select" name="type_id" id="type_id">
                            <option selected value="{{ $device->type_id }}">
                                {{ $device->model . ' - ' . $device->type . ' - ' . $device->desc }}</option>
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}">
                                    {{ $type->model . ' - ' . $type->type . ' - ' . $type->desc }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="registration" class="form-label">Nomer Registrasi</label>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">SO</span>
                        <input type="text" class="form-control" id="registration" value="{{ $device->registration }}"
                            name="registration" aria-describedby="basic-addon1" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="name" value="{{ $device->name }}"
                            name="name" required autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="address" value="{{ $device->address }}"
                            name="address" required autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="district" class="form-label">Kecamatan</label>
                        <input type="text" class="form-control" id="district" value="{{ $device->district }}"
                            name="district" required autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="latitude" class="form-label">Latitude</label>
                        <input type="text" class="form-control" id="latitude" value="{{ $device->latitude }}"
                            name="latitude" data-lat="{{ $device->latitude }}">
                    </div>
                    <div class="mb-3">
                        <label for="longitude" class="form-label">Longitude</label>
                        <input type="text" class="form-control" id="longitude" value="{{ $device->longitude }}"
                            name="longitude" data-long="{{ $device->longitude }}">
                    </div>
                    <div id="map" style="height: 500px;"></div>
                    <input type="hidden" name="customer_id" value="{{ $device->customer_id }}">
                @elseif ($device->device_status == 'in')
                    <div class="mb-3">
                        <label for="number" class="form-label">Serial Number</label>
                        <input type="text" class="form-control" id="number" name="number"
                            value="{{ $device->number }}" autofocus>
                    </div>
                    <div class="mb-3">
                        <label for="type_id" class="form-label">Model</label>
                        <select class="form-select" name="type_id" id="type_id">
                            <option selected value="{{ $device->type_id }}">
                                {{ $device->model . ' - ' . $device->type . ' - ' . $device->desc }}</option>
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}">
                                    {{ $type->model . ' - ' . $type->type . ' - ' . $type->desc }}</option>
                            @endforeach
                        </select>
                    </div>
                @elseif ($device->device_status == 'onHand')
                    <input type="hidden" name="number" value="{{ $device->number }}">
                    <input type="hidden" name="type_id" value="{{ $device->type_id }}">
                    <div class="mb-3">
                        <label for="condition" class="form-label">Model</label>
                        <select class="form-select" id="condition" name="condition" required>
                            <option selected value="{{ $device->condition }}">{{ $device->condition }}</option>
                            <option value="good">good</option>
                            <option value="bad">bad</option>
                        </select>
                    </div>
                @endif
                <input type="hidden" name="device_status" value="{{ $device->device_status }}">
                <button type="submit" class="btn btn-success mt-3">Simpan</button>
            </form>
        </div>

        <script>
            var latitude = document.getElementById("latitude");
            var longitude = document.getElementById("longitude");

            var currentLocation = [latitude.dataset.lat, longitude.dataset.long];
            var map = L.map('map').setView(currentLocation, 13);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© WEB GIS 2022'
            }).addTo(map);

            document.getElementById("latitude").value = currentLocation[0];
            document.getElementById("longitude").value = currentLocation[1];

            map.attributionControl.setPrefix(false);

            var marker = new L.marker(currentLocation, {
                draggable: 'true'
            });

            marker.on('dragend', function(event) {
                var position = marker.getLatLng();
                marker.setLatLng(position, {
                    draggable: 'true'
                }).bindPopup(position).update();
                document.getElementById("latitude").value = position.lat;
                document.getElementById("longitude").value = position.lng;
            });

            map.addLayer(marker);
        </script>
    @endsection
