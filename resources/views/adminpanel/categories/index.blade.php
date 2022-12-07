@extends('layouts.app')
@section('content')

<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Manage Categories </h3>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"> Categories List</h4>
                        <a href="{{url('addcategory')}}"> <i class="mdi mdi-plus-circle"></i>New Category</a>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th style="width: 5%">ID</th>
                                    <th style="width: 25%">Name</th>
                                    <th style="width: 5%">SubCategories</th>
                                    <th style="width: 5%"></th>
                                    <th style="width: 5%"></th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($categories as $categoryItem)
                                <tr>
                                    <th>{{$categoryItem->id}}</th>
                                    <th>{{$categoryItem->name}}</th>
                                    <th></th>
                                    <th>
                                        <button href="{{url('editcategory/'.$categoryItem->id)}}" title="edit" type="button" class="btn btn-warning btn-rounded btn-fw">Edit</button>
                                    </th>
                                    <th>
                                        <button href="{{url('deletecategory/'.$categoryItem->id)}}" title="delete" type="button" class="btn btn-danger btn-rounded btn-fw">Delete</button>
                                    </th>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
