@extends('layouts.app')
@section('content')

    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title"> Manage Filters </h3>
            </div>
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Edit a Filter - {{$filter->name}}</h4>
                            @if(session()->has('error'))
                                <div class="alert alert-danger">
                                    {{session()->get('error')}}
                                </div>
                            @endif
                            <form action="{{url('editfilter/'.$filter->id)}}" method="POST" class="mdi-format-horizontal-align-left">
                                @csrf
                                <div class="form-group">
                                    <label for="name" class="col-sm-4 ">Filter Name</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="name" id="name" class="form-control" value="{{$filter->name}}">
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary mr-2">Edit Filter</button>
                                <a href="{{url('filtersadmin')}}" class="btn btn-dark">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
