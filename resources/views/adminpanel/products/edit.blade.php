@extends('layouts.app')
@section('content')

<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Manage Products </h3>
        </div>
        <div class="row">
            <div class="col-lg-10 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"> Edit a Product </h4>

                        @if(session()->has('error'))
                            <div class="alert alert-danger">
                                {{session()->get('error')}}
                            </div>
                        @endif
                        <form action="{{url('editproduct/'.$product->id)}}" method="POST" enctype="multipart/form-data"  class="mdi-format-horizontal-align-left">
                            @csrf

                            <div class="form-group">
                                <label for="name" class="col-sm-12 ">Product Name</label>
                                <div class="col-sm-12">
                                    <input type="text" name="name" id="name" class="form-control" value="{{$product->name}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description" class="col-sm-12">Description</label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" name="description" id="description" rows="4">{{$product->description}}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="price" class="col-sm-12 ">Price</label>
                                <div class="col-sm-12">
                                    <input type="text" name="price" id="price" class="form-control" value="{{$product->price}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="stock" class="col-sm-12 ">Stock</label>
                                <div class="col-sm-12">
                                    <input type="text" name="stock" id="stock" class="form-control" value="{{$product->stock}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="discount" class="col-sm-12 ">Discount (If any)</label>
                                <div class="col-sm-12">
                                    <input type="text" name="discount" id="discount" class="form-control" value="{{$product->discount}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="subcategory" class="col-sm-12 ">Subcategory</label>
                                <div class="col-sm-12">
                                    <select name="subcategory_id" class="form-control" style="appearance: none">
                                        @foreach($subcategories as $subcategoryItem)
                                        <option value="{{$subcategoryItem->id}}" @if($subcategoryItem->id == $product->subcategory_id) selected @endif>
                                            {{$subcategoryItem->name}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="image" class="col-sm-12 ">Image</label>
                                <div class="col-sm-12">
                                    <img class="thumbnail" style="width: 200px" src="{{'/images/'.$product->image}}">
                                    <input type="file" name="image" class="">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary mr-2">Edit Product</button>
                            <a href="{{url('productsadmin')}}" class="btn btn-dark">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
