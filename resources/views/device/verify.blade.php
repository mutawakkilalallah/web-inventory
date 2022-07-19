@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <form action="/device/verify/{{ $id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="condition" class="form-label">Model</label>
                    <select class="form-select" id="condition" name="condition" required>
                        <option selected value="">-- Pilih Kondisi --</option>
                        <option value="good">good</option>
                        <option value="bad">bad</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Simpan</button>
            </form>
        </div>
    </div>
@endsection
