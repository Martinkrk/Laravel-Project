@extends('layouts.app')
@section('content')

<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Manage Roles </h3>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"> Roles List</h4>
                        <a href="{{url('addrole')}}"> <i class="mdi mdi-plus-circle"></i>New Role</a>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th style="width: 5%">ID</th>
                                    <th style="width: 25%">Name</th>
                                    <th style="width: 5%"></th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($roles as $roleItem)
                                <tr>
                                    <th>{{$roleItem->id}}</th>
                                    <th>{{$roleItem->name}}</th>
                                    <th>
                                        <button type="button" class="btn btn-danger btn-rounded btn-fw" data-toggle="modal" data-target="#exampleModalLong{{$roleItem->id}}">
                                            <i class="fa fa-trash"></i> Delete
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModalLong{{$roleItem->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Deletion</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure, you want to delete this role?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <form action="{{url('deleterole/'.$roleItem->id)}}" method="POST">
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
