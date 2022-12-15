@extends('layouts.app')
@section('content')

<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Manage Users </h3>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"> Add a User </h4>

                        @if(session()->has('error'))
                            <div class="alert alert-danger">
                                {{session()->get('error')}}
                            </div>
                        @endif
                        <form action="{{url('adduser')}}" method="POST" class="mdi-format-horizontal-align-left">
                            @csrf

                            <div class="form-group">
                                <label for="name" class="col-sm-4 ">User Name</label>
                                <div class="col-sm-4">
                                    <input type="text" name="name" id="name" class="form-control" value="" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-sm-4 ">Email</label>
                                <div class="col-sm-4">
                                    <input type="text" name="email" id="email" class="form-control" value="" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="role" class="col-sm-4 ">Role</label>
                                <div class="col-sm-4">
                                    <select name="role" class="form-control" style="appearance: none">
                                        @foreach($roles as $roleItem)
                                        <option value="{{$roleItem->id}}">
                                            {{$roleItem->name}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-sm-4 ">Password</label>
                                <div class="col-sm-4">
                                    <input type="password" name="password" id="password" class="form-control" value="" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="confpassword" class="col-sm-4 ">Password Confirmation</label>
                                <div class="col-sm-4">
                                    <input type="password" name="confpassword" id="confpassword" class="form-control" value="" required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary mr-2">Add User</button>
                            <a href="{{url('users')}}" class="btn btn-dark">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
