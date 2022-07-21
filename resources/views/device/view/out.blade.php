@extends('layouts.main')

@section('content')
    <div id="map" style="height: 500px;"></div>

    <form class="row g-3 mt-3" action="/device/out">
        <div class="col-md-6">
            <input type="text" class="form-control" id="district" name="district" placeholder="masukkan kecamatan .."
                value="{{ request('district') }}">
        </div>
        <div class="col-md-6">
            <button type="submit" class="btn btn-success mb-3"><i class="bi bi-search"></i> Cari</button>
        </div>
    </form>

    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Serial Number</th>
                                <th scope="col">No. Pelanggan</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">Kecamatan</th>
                                <th scope="col">Model</th>
                                <th scope="col">Tipe</th>
                                <th scope="col">Deskripsi</th>
                                @if (auth()->user()->role == 'field-manager')
                                    <th scope="col">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($devices as $i => $d)
                                <tr>
                                    <th scope="row">{{ $i + 1 }}</th>
                                    <td>{{ $d->number }}</td>
                                    <td>{{ $d->registration }}</td>
                                    <td>{{ $d->name }}</td>
                                    <td>{{ $d->address }}</td>
                                    <td>{{ $d->district }}</td>
                                    <td>{{ $d->model }}</td>
                                    <td>{{ $d->type }}</td>
                                    <td>{{ $d->desc }}</td>
                                    @if (auth()->user()->role == 'field-manager')
                                        <td>
                                            <a href="/device/edit/{{ $d->device_id }}" class="btn btn-warning"><i
                                                    class="bi bi-pen"></i></a>
                                            <a href="/device/delete/{{ $d->device_id }}" class="btn btn-danger"><i
                                                    class="bi bi-trash"></i></a>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

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
