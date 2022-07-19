@extends('layouts.main')

@section('content')
    <a href="/user/create" class="btn btn-success mt-4"><i class="bi bi-plus-square"></i> Tambah User</a>
    <table class="table table-striped table-bordered mt-4">
        <thead>
            <tr class="text-center bg-success text-white">
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Username</th>
                <th scope="col">Role</th>
                @if (auth()->user()->role == 'field-manager')
                    <th scope="col">Action</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $i => $u)
                <tr class="text-center align-middle">
                    <th scope="row">{{ $i + 1 }}</th>
                    <td>{{ $u->name }}</td>
                    <td>{{ $u->username }}</td>
                    <td>{{ $u->role }}</td>
                    @if (auth()->user()->role == 'field-manager')
                        <td>
                            <a href="user/edit/{{ $u->id }}" class="btn btn-warning"><i class="bi bi-pen"></i></a>
                            <a href="/user/delete/{{ $u->id }}" class="btn btn-danger"><i
                                    class="bi bi-trash"></i></a>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
