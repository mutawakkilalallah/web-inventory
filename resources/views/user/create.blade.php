@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <form action="/user/create" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" autocomplete="off" required>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" autocomplete="off" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" autocomplete="off" required>
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Hak Akses</label>
                    <select class="form-select" id="role" name="role" required>
                        <option selected value="">-- Pilih Hak Akses --</option>
                        <option value="admin-field">admin-field</option>
                        <option value="field-manager">field-manager</option>
                        <option value="manager">manager</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Simpan</button>
            </form>
        </div>
    </div>
@endsection
