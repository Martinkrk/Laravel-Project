@extends('layouts.app')
@section('content')

<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Manage Products </h3>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"> Product List</h4>
                        <a href="{{url('addproduct')}}"> <i class="mdi mdi-plus-circle"></i>New Product</a>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th style="width: 5%">ID</th>
                                    <th style="width: 25%">Name</th>
                                    <th style="width: 5%">Price</th>
                                    <th style="width: 5%">Stock</th>
                                    <th style="width: 5%">Discount</th>
                                    <th style="width: 5%">Bought</th>
                                    <th style="width: 5%">Subcategory</th>
                                    <th style="width: 5%"></th>
                                    <th style="width: 5%"></th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($products as $productItem)
                                <tr>
                                    <th>{{$productItem->id}}</th>
                                    <th>{{$productItem->name}}</th>
                                    <th>{{$productItem->price}}</th>
                                    <th>{{$productItem->stock}}</th>
                                    <th>{{$productItem->discount}}</th>
                                    <th>{{$productItem->bought}}</th>
                                    <th>
                                        @foreach($subcategories as $subcategoryItem)
                                            @if($subcategoryItem->id == $productItem->subcategory_id)
                                                {{$subcategoryItem->name}}
                                            @endif
                                        @endforeach
                                    </th>
                                    <th>
                                        <a href="{{url('editproduct/'.$productItem->id)}}" type="button" class="btn btn-warning btn-rounded btn-fw">Edit</a>
                                    </th>
                                    <th>
                                        <button type="button" class="btn btn-danger btn-rounded btn-fw" data-toggle="modal" data-target="#exampleModalLong{{$productItem->id}}">
                                            <i class="fa fa-trash"></i> Delete
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModalLong{{$productItem->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Deletion</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure, you want to delete this Product?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <form action="{{url('deleteproduct/'.$productItem->id)}}" method="POST">
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
