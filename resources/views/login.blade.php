@extends('layouts.appLogin')
@section('content')

<div class="card col-lg-4 mx-auto">
    <div class="card-body px-5 py-5">
        <h3 class="card-title text-left mb-3">Login</h3>
        <form action="{{url('login')}}" method="POST">
            @csrf
            <div class="form-group">
                <label>Email *</label>
                <input type="email" name="email" class="form-control p_input" required>
            </div>
            <div class="form-group">
                <label>Password *</label>
                <input type="password" name="password" class="form-control p_input" required>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-danger btn-block enter-btn">Sign In</button>
            </div>

            <p class="sign-up">Don't have an Account?<a href="{{url('signup')}}"> <span class="text-danger">Sign Up</span></a></p>
        </form>
    </div>
</div>

@endsection
