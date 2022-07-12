@extends('layouts.main')

@section('content')

<div class="row">
    <div class="col-md-6">
        <form>
            <div class="mb-3">
              <label for="number" class="form-label">Serial Number</label>
              <input type="text" class="form-control"  autocomplete="off" autofocus>
            </div>
            <div class="mb-3">
              <label for="type_id" class="form-label">Model</label>
              <select class="form-select" id="type_id" name="type_id">
                <option selected>-- Pilih Model --</option>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}">{{ $type->model . " - " . $type->type . " - " . $type->desc }}</option>
                @endforeach
              </select>
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
</div>
    
@endsection
