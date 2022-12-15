@extends('layouts.app')
@section('content')

<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Manage FilterSubcategories </h3>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"> Add a FilterSubcategory </h4>

                        @if(session()->has('error'))
                            <div class="alert alert-danger">
                                {{session()->get('error')}}
                            </div>
                        @endif
                        <form action="{{url('addfiltersubcategory')}}" method="POST" class="mdi-format-horizontal-align-left">
                            @csrf

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
                                <label for="subcategory" class="col-sm-4 ">Subcategory</label>
                                <div class="col-sm-4">
                                    <select name="subcategory" class="form-control" style="appearance: none">
                                        @foreach($subcategories as $subcategory)
                                            <option value="{{$subcategory->id}}">
                                                {{$subcategory->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <button type="submit" class="btn btn-primary mr-2">Add FilterSubcategory</button>
                            <a href="{{url('filtersubcategoriesadmin')}}" class="btn btn-dark">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
