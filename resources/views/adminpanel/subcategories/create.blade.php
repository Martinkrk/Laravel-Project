@extends('layouts.app')
@section('content')

<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Manage SubCategories </h3>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"> Add a SubCategory </h4>

                        @if(session()->has('error'))
                            <div class="alert alert-danger">
                                {{session()->get('error')}}
                            </div>
                        @endif
                        <form action="{{url('addsubcategory')}}" method="POST" class="mdi-format-horizontal-align-left">
                            @csrf

                            <div class="form-group">
                                <label for="name" class="col-sm-4 ">SubCategory Name</label>
                                <div class="col-sm-4">
                                    <input type="text" name="name" id="name" class="form-control" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-4 ">Parent Category</label>
                                <div class="col-sm-4">
                                    <select name="category" class="form-control" style="appearance: none">
                                        @foreach($categories as $category)
                                        <option value="{{$category->id}}">
                                            {{$category->name}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary mr-2">Add SubCategory</button>
                            <a href="{{url('subcategoriesadmin')}}" class="btn btn-dark">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
