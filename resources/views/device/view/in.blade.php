@extends('layouts.main') @section('content')
    @if (auth()->user()->role == 'team-field')
        <a href="/device/create" class="btn btn-success mt-4"><i class="bi bi-plus-square"></i> Tambah Perangkat</a>
    @endif
    <table class="table table-striped table-bordered mt-4">
        <thead>
            <tr class="text-center bg-success text-white">
                <th scope="col">No</th>
                <th scope="col">Foto Perangkat</th>
                <th scope="col">Foto Kunjungan</th>
                <th scope="col">Serial Number</th>
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
                <tr class="text-center align-middle">
                    <th scope="row">{{ $i + 1 }}</th>
                    <td>
                        <img src="{{ asset('storage/' . $d->picture) }}" width="100" class="img-thumbnail" />
                    </td>
                    <td>
                        <img src="{{ asset('storage/' . $d->mandatory) }}" width="100" class="img-thumbnail" />
                    </td>
                    <td>{{ $d->number }}</td>
                    <td>{{ $d->model }}</td>
                    <td>{{ $d->type }}</td>
                    <td>{{ $d->desc }}</td>
                    @if (auth()->user()->role == 'field-manager')
                        <td>
                            <a href="/device/edit/{{ $d->device_id }}" class="btn btn-warning"><i
                                    class="bi bi-pen"></i></a>
                            <a href="/device/delete/{{ $d->device_id }}" class="btn btn-danger"><i
                                    class="bi bi-trash"></i></a>
                            <a href="/device/verify/{{ $d->device_id }}" class="btn btn-success"><i
                                    class="bi bi-check2-circle"></i></a>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
