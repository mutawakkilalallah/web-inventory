@extends('layouts.main')

@section('content')
    <div class="row mt-3">
        <div class="col-md-3">
            <div class="card" style="width: 18rem;">
                <div class="card-body  bg-success text-white">
                    <h5 class="card-title">Perangkat dari Pelanggan Lama</h5>
                    <p class="card-text">{{ $deviceIn }} Unit</p>
                </div>
            </div>
        </div>
        @if (auth()->user()->role != 'team-field')
            <div class="col-md-3">
                <div class="card" style="width: 18rem;">
                    <div class="card-body  bg-danger text-white">
                        <h5 class="card-title">Perangkat On Stock (Bagus)</h5>
                        <p class="card-text">{{ $deviceOnHandGood }} Unit</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card" style="width: 18rem;">
                    <div class="card-body  bg-dark text-white">
                        <h5 class="card-title">Perangkat On Stock (Rusak)</h5>
                        <p class="card-text">{{ $deviceOnHandBad }} Unit</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card" style="width: 18rem;">
                    <div class="card-body  bg-info text-white">
                        <h5 class="card-title">Perangkat ke Pelanggan Baru</h5>
                        <p class="card-text">{{ $deviceOut }} Unit</p>
                    </div>
                </div>
            </div>
        @endif
    </div>
    @if (auth()->user()->role != 'team-field')
        <div class="row mt-3">
            <div class="col-md-3">
                <div class="card" style="width: 18rem;">
                    <div class="card-body  bg-warning text-dark">
                        <h5 class="card-title">Team Field</h5>
                        <p class="card-text">{{ $userTF }} User</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card" style="width: 18rem;">
                    <div class="card-body  bg-light text-dark">
                        <h5 class="card-title">Field Manager</h5>
                        <p class="card-text">{{ $userFM }} User</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card" style="width: 18rem;">
                    <div class="card-body  bg-secondary text-dark">
                        <h5 class="card-title">Manager</h5>
                        <p class="card-text">{{ $userM }} User</p>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
