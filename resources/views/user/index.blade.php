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
                                <tr>
                                    <th scope="row">{{ $i + 1 }}</th>
                                    <td>{{ $u->name }}</td>
                                    <td>{{ $u->username }}</td>
                                    <td>{{ $u->role }}</td>
                                    @if (auth()->user()->role == 'field-manager')
                                        <td>
                                            <a href="user/edit/{{ $u->id }}" class="btn btn-warning"><i
                                                    class="bi bi-pen"></i></a>
                                            <a href="/user/delete/{{ $u->id }}" class="btn btn-danger"><i
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
@endsection
