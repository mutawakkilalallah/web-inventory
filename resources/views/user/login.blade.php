@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-4">
            @if (session()->has('invalidLogin'))
                <script>
                    alert('Username atau Password Salah')
                </script>
            @endif
            <form action="/login" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" autocomplete="off" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" autocomplete="off" required>
                </div>
                <button type="submit" class="btn btn-success">Login</button>
            </form>
        </div>
    </div>
@endsection
