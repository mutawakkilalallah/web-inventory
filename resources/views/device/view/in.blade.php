@extends('layouts.main')

@section('content')
        <a href="/device/create" class="btn btn-success mt-4"><i class="bi bi-plus-square"></i> Tambah Perangkat</a>
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
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($devices as $i => $d)
                <tr class="text-center align-middle">
                    <th scope="row">{{ $i + 1 }}</th>
                    <td><img src="https://source.unsplash.com/100x100/?router" width="100" class="img-thumbnail"></td>
                    <td><img src="https://source.unsplash.com/100x100/?customer" width="100" class="img-thumbnail"></td>
                    {{-- <td><img src="{{ $d->picture }}" width="100" class="img-thumbnail"></td>
                    <td><img src="{{ $d->mandatory }}" width="100" class="img-thumbnail"></td> --}}
                    <td>{{ $d->number }}</td>
                    <td>{{ $d->model }}</td>
                    <td>{{ $d->type }}</td>
                    <td>{{ $d->desc }}</td>
                    <td>
                        <a href="#" class="btn btn-warning"><i class="bi bi-pen"></i></a>
                        <a href="#" class="btn btn-danger"><i class="bi bi-trash"></i></a>
                        <a href="#" class="btn btn-success"><i class="bi bi-check2-circle"></i></a>
                    </td>
                </tr>    
            @endforeach
            </tbody>
          </table>
@endsection