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
                                    <th style="width: 5%">SubCategories ID</th>
                                    <th style="width: 5%"></th>
                                    <th style="width: 5%"></th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($categories as $categoryItem)
                                <tr>
                                    <th>{{$categoryItem->id}}</th>
                                    <th>{{$categoryItem->name}}</th>
                                    <th>
                                        <button type="button" class="btn btn-primary btn-rounded btn-fw" data-toggle="modal" data-target="#subCategoryModal{{$categoryItem->id}}">
                                            Open List
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="subCategoryModal{{$categoryItem->id}}" tabindex="-1" role="dialog" aria-labelledby="subCategoryModalTitle" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="subCategoryModalTitle">Manage {{$categoryItem->name}} SubCategories</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        @foreach($subCategories as $subCategoryItem)
                                                            @if($subCategoryItem->category_id == $categoryItem->id)
                                                                <div class="row mt-3">
                                                                    <div class="col-md-1">
                                                                        {{$subCategoryItem->id}}
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        {{$subCategoryItem->name}}
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <a href="{{url('editsubcategory/'.$subCategoryItem->id)}}" type="button" class="btn btn-warning">Edit</a>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <form action="{{url('deletesubcategory/'.$subCategoryItem->id)}}" method="POST">
                                                                            @csrf
                                                                            {{method_field('DELETE')}}
                                                                            <button type="submit" class="btn btn-danger">
                                                                                Delete
                                                                            </button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </th>
                                    <th>
                                        <a href="{{url('editcategory/'.$categoryItem->id)}}" type="button" class="btn btn-warning btn-rounded btn-fw">Edit</a>
                                    </th>
                                    <th>
                                        <button type="button" class="btn btn-danger btn-rounded btn-fw" data-toggle="modal" data-target="#exampleModalLong{{$categoryItem->id}}">
                                            <i class="fa fa-trash"></i> Delete
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModalLong{{$categoryItem->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Deletion</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure, you want to delete this category?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <form action="{{url('deletecategory/'.$categoryItem->id)}}" method="POST">
                                                            @csrf
                                                            {{method_field('DELETE')}}
                                                            <button type="submit" class="btn btn-danger">
                                                                <i class="fa fa-trash"></i> Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
