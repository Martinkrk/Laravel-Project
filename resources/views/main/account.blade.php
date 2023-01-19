@extends('layouts.appMain')
@section('content')

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <h1>Your account</h1>
        <hr>
        <!-- Contact form -->
        <div class="billing-details">
            <div class="section-title">
                <h3 class="title">Your information</h3>
            </div>
            <form action="{{url('changepassword')}}" method="POST">
                @csrf
                <div class="form-group">
                    <input class="input" type="text" name="name" value="{{Auth::user()->name}}" readonly>
                </div>
                <div class="form-group">
                    <input class="input" type="email" name="email" value="{{Auth::user()->email}}" readonly>
                </div>
                <div class="form-group">
                    <input class="input" type="password" name="password" placeholder="Change password">
                </div>
                <div class="form-group">
                    <input class="input" type="password" name="password_confirmation" placeholder="Confirm password">
                </div>
                <div class="form-group">
                    <input class="primary-btn" type="submit" value="Change Password">
                </div>
            </form>
        </div>
        <div class="billing-details">
            <div class="section-title">
                <h3 class="title">Your message</h3>
            </div>
            <div class="order-notes">
                <textarea class="input" placeholder="Enter here"></textarea>
            </div>
        </div>
        <!-- /Contact Form -->

    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

@endsection
