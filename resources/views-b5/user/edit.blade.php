@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <form action="/user/update/{{ $user->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}"
                        autocomplete="off" required>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username"
                        value="{{ $user->username }}" autocomplete="off" required>
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Hak Akses</label>
                    <select class="form-select" id="role" name="role" required>
                        <option selected value="{{ $user->role }}">{{ $user->role }}</option>
                        <option value="team-field">team-field</option>
                        <option value="field-manager">field-manager</option>
                        <option value="manager">manager</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Simpan</button>
            </form>
        </div>
        <div class="col-md-4">
            <form action="/user/updatePassword/{{ $user->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="********"
                        autocomplete="off" required>
                </div>
                <button type="submit" class="btn btn-success">Update Password</button>
            </form>
        </div>
    </div>
@endsection
