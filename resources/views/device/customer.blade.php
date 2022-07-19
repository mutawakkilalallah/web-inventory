@extends('layouts.main')

@section('content')
    <table class="table table-striped table-bordered mt-4">
        <thead>
            <tr class="text-center bg-success text-white">
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
@endsection
