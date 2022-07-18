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
                    <td>{{ $d->number }}</td>
                    <td>{{ $d->registration }}</td>
                    <td>{{ $d->name }}</td>
                    <td>{{ $d->address }}</td>
                    <td>{{ $d->model }}</td>
                    <td>{{ $d->type }}</td>
                    <td>{{ $d->desc }}</td>
                    <td>
                        <a href="#" class="btn btn-warning"><i class="bi bi-pen"></i></a>
                        <a href="/device/delete/{{ $d->device_id }}" class="btn btn-danger"><i
                                class="bi bi-trash"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        var d = <?php echo json_encode($devices); ?>;

        var map = L.map('map').setView([d[0].latitude, d[0].longitude], 12);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© Web GIS 2022'
        }).addTo(map);


        for (let i = 0; i < d.length; i++) {
            console.log(d[i].latitude);
            var marker = L.marker([d[i].latitude, d[i].longitude]).addTo(map);
        }
    </script>
@endsection
