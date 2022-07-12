@extends('layouts.main')

@section('content')
        <div id="map" style="height: 500px;"></div>
        
        <form class="row g-3 mt-3">
          <div class="col-auto">
            <label for="address" class="visually-hidden">Alamat</label>
            <input type="text" class="form-control" id="address" placeholder="masukkan alamat ..">
          </div>
          <div class="col-auto">
            <button type="submit" class="btn btn-success mb-3"><i class="bi bi-search"></i> Cari</button>
          </div>
        </form>
        
        <table class="table table-striped table-bordered mt-4">
            <thead>
              <tr class="text-center bg-success text-white">
                <th scope="col">No</th>
                <th scope="col">Serial Number</th>
                <th scope="col">No. Pelanggan</th>
                <th scope="col">Nama</th>
                <th scope="col">Alamat</th>
                <th scope="col">Model</th>
                <th scope="col">Tipe</th>
                <th scope="col">Deskripsi</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($devices as $i => $d)
                <tr class="text-center align-middle">
                    <th scope="row">{{ $i + 1 }}</th>
                    <td>{{ $d->serial_number }}</td>
                    <td>{{ $d->number }}</td>
                    <td>{{ $d->name }}</td>
                    <td>{{ $d->address }}</td>
                    <td>{{ $d->model }}</td>
                    <td>{{ $d->type }}</td>
                    <td>{{ $d->desc }}</td>
                    <td>
                        <a href="#" class="btn btn-warning"><i class="bi bi-pen"></i></a>
                        <a href="#" class="btn btn-danger"><i class="bi bi-trash"></i></a>
                    </td>
                </tr>    
            @endforeach
            </tbody>
          </table>

          <script>
            var map = L.map('map').setView([-8.669505485174772, 115.21521735465888], 14);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap'
            }).addTo(map);

            var marker = L.marker([-8.669505485174772, 115.21521735465888]).addTo(map);
            var marker = L.marker([-8.677452169993265, 115.21525141658987]).addTo(map);
            var marker = L.marker([-8.678192954077026, 115.22468657148244]).addTo(map);
            var marker = L.marker([-8.676846072837467, 115.20629312873162]).addTo(map);
            var marker = L.marker([-8.681156075792323, 115.21521735465888]).addTo(map);
            var marker = L.marker([-8.665734118312331, 115.22887618899789]).addTo(map);
            var marker = L.marker([-8.666643290571193, 115.21794230914047]).addTo(map);
            var marker = L.marker([-8.67125646406696, 115.20435159866346]).addTo(map);
            var marker = L.marker([-8.666104522090643, 115.22022445851881]).addTo(map);
            var marker = L.marker([-8.678933736698943, 115.2258106152061]).addTo(map);
          </script>
@endsection