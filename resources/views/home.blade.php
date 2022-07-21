@extends('layouts.main')

@section('content')
    <div class="row">

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-inbox"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Perangkat Masuk</span>
                    <span class="info-box-number">
                        {{ $deviceIn }}
                        <small>Unit</small>
                    </span>
                </div>
            </div>
        </div>

        {{-- Menu dibawah ini khusus untuk selain team field --}}

        @if (auth()->user()->role != 'team-field')
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-check-double"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Perangkat Bagus</span>
                        <span class="info-box-number">
                            {{ $deviceOnHandGood }}
                            <small>Unit</small>
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-times-circle"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Perangkat Rusak</span>
                        <span class="info-box-number">
                            {{ $deviceOnHandBad }}
                            <small>Unit</small>
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-shopping-cart"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Perangkat Terjual</span>
                        <span class="info-box-number">
                            {{ $deviceOut }}
                            <small>Unit</small>
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-navy elevation-1"><i class="fas fa-users"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Team Field</span>
                        <span class="info-box-number">
                            {{ $userTF }}
                            <small>User</small>
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-maroon elevation-1"><i class="fas fa-user"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Field Manager</span>
                        <span class="info-box-number">
                            {{ $userFM }}
                            <small>User</small>
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-olive elevation-1"><i class="fas fa-user-tie"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Manager</span>
                        <span class="info-box-number">
                            {{ $userM }}
                            <small>User</small>
                        </span>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
