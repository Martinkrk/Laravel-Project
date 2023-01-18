@extends('layouts.appMain')
@section('content')

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                <!-- Order Details -->
                <div class="col-md-6 order-details">
                    <div class="section-title text-center">
                        <h3 class="title">Your Order</h3>
                    </div>
                    <div class="order-summary">
                        <div class="order-col">
                            <div><strong>PRODUCT</strong></div>
                            <div><strong>TOTAL</strong></div>
                        </div>
                        <div class="order-products">

                            <?php $total = 0 ?>
                            @if(session('cart'))
                                @foreach(session('cart') as $product => $details)
                                    <?php $total += $details['price'] * $details['quantity'] ?>
                                    <div class="order-col">
                                        <div><b>{{$details['quantity']}}x</b> {{$details['name']}}</div>
                                        <div>{{$details['price']}}€</div>
                                        <div class="product-details">
                                            <div class="add-to-cart">
                                                <div class="qty-label">
                                                    <div class="input-number">
                                                        <form action="{{url('updatecart')}}" method="POST">
                                                            @csrf
                                                            <input type="hidden" value="{{$product}}" name="product" readonly>
                                                            <input type="number" value="{{$details['quantity']}}" name="quantity" onchange="submit();">
                                                            <span class="qty-up">+</span>
                                                            <span class="qty-down">-</span>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <form action="{{url('removefromcart/'.$product)}}" method="POST">
                                            @csrf
                                            <input type="submit" class="primary-btn" value="X" name="id">
                                        </form>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="order-col">
                            <div>Shipping</div>
                            <div><strong>FREE</strong></div>
                        </div>
                        <div class="order-col">
                            <div><strong>TOTAL</strong></div>
                            <div><strong class="order-total">${{$total}}</strong></div>
                        </div>
                    </div>

                    <a href="{{url('checkout')}}" class="primary-btn order-submit">Place order</a>
                </div>
                <!-- /Order Details -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

@endsection
