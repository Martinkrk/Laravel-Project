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
                        <h4 class="card-title"> ProductFilter List</h4>
                        <a href="{{url('addproductfilter')}}"> <i class="mdi mdi-plus-circle"></i>New ProductFilter</a>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th style="width: 5%">Product ID</th>
                                    <th style="width: 20%">Product name</th>
                                    <th style="width: 5%">Filter ID</th>
                                    <th style="width: 20%">Filter name</th>
                                    <th style="width: 20%">Value</th>
                                    <th style="width: 5%"></th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($productfilters as $productfilterItem)
                                    @foreach($filters as $filterItem)
                                        @foreach($products as $productItem)
                                            @if($productfilterItem->filter_id == $filterItem->id && $productfilterItem->product_id == $productItem->id)
                                                <tr>
                                                    <th>{{$productItem->id}}</th>
                                                    <th>{{$productItem->name}}</th>
                                                    <th>{{$filterItem->id}}</th>
                                                    <th>{{$filterItem->name}}</th>
                                                    <th>{{$productfilterItem->value}}</th>
                                                    <th>
                                                        <button type="button" class="btn btn-danger btn-rounded btn-fw" data-toggle="modal" data-target="#exampleModalLong{{$productfilterItem->id}}">
                                                            <i class="fa fa-trash"></i> Delete
                                                        </button>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="exampleModalLong{{$productfilterItem->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLongTitle">Deletion</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Are you sure, you want to delete this productfilter?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <form action="{{url('deleteproductfilter/'.$productfilterItem->id)}}" method="POST">
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
