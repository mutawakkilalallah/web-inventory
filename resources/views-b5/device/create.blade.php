@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <form action="/device/create" method="POST" enctype="multipart/form-data">
                @csrf
                @foreach ($errors->all() as $error)
                    <script>
                        alert('File harus berupa gambar')
                    </script>
                @endforeach
                <div class="mb-3">
                    <label for="picture" class="form-label">Foto Perangkat</label>
                    <input class="form-control" type="file" id="picture" name="picture" required>
                </div>
                <div class="mb-3">
                    <label for="mandatory" class="form-label">Foto Kunjungan</label>
                    <input class="form-control" type="file" id="mandatory" name="mandatory" required>
                </div>
                <div class="mb-3">
                    <label for="number" class="form-label">Serial Number</label>
                    <input type="text" class="form-control" id="number" name="number" required autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="type_id" class="form-label">Model</label>
                    <select class="form-select" id="type_id" name="type_id" required>
                        <option selected value="">-- Pilih Model --</option>
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}">
                                {{ $type->model . ' - ' . $type->type . ' - ' . $type->desc }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="registration" class="form-label">Nomer Registrasi</label>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">SO</span>
                    <input type="text" class="form-control" id="registration" name="registration"
                        aria-describedby="basic-addon1" autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" required autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Alamat</label>
                    <input type="text" class="form-control" id="address" name="address" required autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="district" class="form-label">Kecamatan</label>
                    <input type="text" class="form-control" id="district" name="district" required autocomplete="off">
                </div>
                <button type="submit" class="btn btn-success">Simpan</button>
            </form>
        </div>
    </div>
@endsection
