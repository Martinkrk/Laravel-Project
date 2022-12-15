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
                        <h4 class="card-title"> FilterSubcategory List</h4>
                        <a href="{{url('addfiltersubcategory')}}"> <i class="mdi mdi-plus-circle"></i>New FilterSubcategory</a>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th style="width: 5%">filter ID</th>
                                    <th style="width: 25%">filter name</th>
                                    <th style="width: 5%">subcategory ID</th>
                                    <th style="width: 25%">subcategory name</th>
                                    <th style="width: 5%"></th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($filtersubcategories as $filtersubcategoryItem)
                                    @foreach($filters as $filterItem)
                                        @foreach($subcategories as $subcategoryItem)
                                            @if($filtersubcategoryItem->filter_id == $filterItem->id && $filtersubcategoryItem->subcategory_id == $subcategoryItem->id)
                                                <tr>
                                                    <th>{{$filterItem->id}}</th>
                                                    <th>{{$filterItem->name}}</th>
                                                    <th>{{$subcategoryItem->id}}</th>
                                                    <th>{{$subcategoryItem->name}}</th>
                                                    <th>
                                                        <button type="button" class="btn btn-danger btn-rounded btn-fw" data-toggle="modal" data-target="#exampleModalLong{{$filtersubcategoryItem->id}}">
                                                            <i class="fa fa-trash"></i> Delete
                                                        </button>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="exampleModalLong{{$filtersubcategoryItem->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLongTitle">Deletion</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Are you sure, you want to delete this filtersubcategory?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <form action="{{url('deletefiltersubcategory/'.$filtersubcategoryItem->id)}}" method="POST">
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
                                            @endif
                                        @endforeach
                                    @endforeach
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
