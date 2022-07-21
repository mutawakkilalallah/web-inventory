@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">No. Registrasi</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">Kecamatan</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $i => $c)
                                <tr class="text-center align-middle">
                                    <th scope="row">{{ $i + 1 }}</th>
                                    <td>{{ $c->registration }}</td>
                                    <td>{{ $c->name }}</td>
                                    <td>{{ $c->address }}</td>
                                    <td>{{ $c->district }}</td>
                                    <td>{{ $c->status }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
