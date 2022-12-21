@extends('layouts.app')
@section('content')

    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-xl-12 col-sm-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="mb-0">Welcome to DashBoard</h1>
                            <div>
                                <br>
                                @can('isAdmin')
                                    <div class="btn btn-danger">You have Admin access</div>
                                @elsecan('isManager')
                                    <div class="btn btn-warning">You have Manager access</div>
                                @else
                                    <div class="btn btn-secondary">Access Error</div>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
