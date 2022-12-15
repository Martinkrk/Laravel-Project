@extends('layouts.app')
@section('content')

<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Manage ProductFilters </h3>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"> Add a ProductFilter </h4>

                        @if(session()->has('error'))
                            <div class="alert alert-danger">
                                {{session()->get('error')}}
                            </div>
                        @endif
                        <form action="{{url('addproductfilter')}}" method="POST" class="mdi-format-horizontal-align-left">
                            @csrf

                            <div class="form-group">
                                <label for="product" class="col-sm-4 ">Product</label>
                                <div class="col-sm-4">
                                    <select name="product" class="form-control" style="appearance: none">
                                        @foreach($products as $productItem)
                                            <option value="{{$productItem->id}}">
                                                {{$productItem->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="filter" class="col-sm-4 ">Filter</label>
                                <div class="col-sm-4">
                                    <select name="filter" class="form-control" style="appearance: none">
                                        @foreach($filters as $filterItem)
                                        <option value="{{$filterItem->id}}">
                                            {{$filterItem->name}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="value" class="col-sm-4 ">Filter Value</label>
                                <div class="col-sm-4">
                                    <input type="text" name="value" id="value" class="form-control" value="">
                                </div>
                            </div>


                            <button type="submit" class="btn btn-primary mr-2">Add ProductFilter</button>
                            <a href="{{url('productfiltersadmin')}}" class="btn btn-dark">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
