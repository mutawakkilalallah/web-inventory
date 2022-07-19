@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <form action="/device/sell/{{ $device->device_id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="number" class="form-label">Serial Number</label>
                    <input type="text" class="form-control" id="number" value="{{ $device->number }}" disabled
                        autofocus>
                </div>
                <div class="mb-3">
                    <label for="type_id" class="form-label">Model</label>
                    <select class="form-select" id="type_id" disabled>
                        <option selected>{{ $device->model . ' - ' . $device->type . ' - ' . $device->desc }}</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="registration" class="form-label">Nomer Registrasi</label>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">SO</span>
                    <input type="text" class="form-control" id="registration" name="registration"
                        aria-describedby="basic-addon1" autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" required autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Alamat</label>
                    <input type="text" class="form-control" id="address" name="address" required autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="district" class="form-label">Kecamatan</label>
                    <input type="text" class="form-control" id="district" name="district" required autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="latitude" class="form-label">Latitude</label>
                    <input type="text" class="form-control" id="latitude" name="latitude" id="latitude">
                </div>
                <div class="mb-3">
                    <label for="longitude" class="form-label">Longitude</label>
                    <input type="text" class="form-control" id="longitude" name="longitude" id="longitude">
                </div>
                <div id="map" style="height: 500px;"></div>
                <button type="submit" class="btn btn-success mt-3">Simpan</button>
            </form>
        </div>

        <script>
            var currentLocation = [-8.67267677869868, 115.21350373400978];
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
