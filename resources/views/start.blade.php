@extends('layouts.appMain')
@section('content')

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- shop -->
            <div class="col-md-4 col-xs-6">
                <div class="shop">
                    <div class="shop-img">
                        <img src="{{asset('main/img/shop01.png')}}" alt="">
                    </div>
                    <div class="shop-body">
                        <h3>Laptop<br>Collection</h3>
                        <a href="{{url('catalog/2')}}" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- /shop -->

            <!-- shop -->
            <div class="col-md-4 col-xs-6">
                <div class="shop">
                    <div class="shop-img">
                        <img src="{{asset('main/img/shop03.png')}}" alt="">
                    </div>
                    <div class="shop-body">
                        <h3>Accessories<br>Collection</h3>
                        <a href="{{url('catalog/8')}}" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- /shop -->

            <!-- shop -->
            <div class="col-md-4 col-xs-6">
                <div class="shop">
                    <div class="shop-img">
                        <img src="{{asset('main/img/shop02.png')}}" alt="">
                    </div>
                    <div class="shop-body">
                        <h3>Cameras<br>Collection</h3>
                        <a href="{{url('catalog/11')}}" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- /shop -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">

            <!-- section title -->
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title">Top selling</h3>
                </div>
            </div>
            <!-- /section title -->

            <!-- Products tab & slick -->
            <div class="col-md-12">
                <div class="row">
                    <div class="products-tabs">
                        <!-- tab -->
                        <div id="tab2" class="tab-pane fade in active">
                            <div class="products-slick" data-nav="#slick-nav-2">
                                @foreach($topproducts as $topproductItem)
                                <!-- products -->
                                <div class="product">
                                    <div class="product-img">
                                        <img src="{{asset('../images/'.$topproductItem->image)}}" alt="">
                                        @if($topproductItem->discount)
                                        <div class="product-label">
                                            <span class="sale">-{{$topproductItem->discount}}%</span>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="product-body">
                                        <p class="product-category">
                                            @foreach($subcategories as $subcategoryItem)
                                                @if($subcategoryItem->id == $topproductItem->subcategory_id)
                                                    {{$subcategoryItem->name}}
                                                @endif
                                            @endforeach
                                        </p>
                                        <h3 class="product-name"><a href="#">{{$topproductItem->name}}</a></h3>
                                        @if($topproductItem->discount)
                                            <h4 class="product-price">{{$topproductItem->price * (1 - $topproductItem->discount / 100)}} <del class="product-old-price">{{$topproductItem->price}}</del></h4>
                                        @else
                                            <h4 class="product-price">{{$topproductItem->price}}</h4>
                                        @endif
                                        <div class="product-rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="product-btns">
                                            <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
                                            <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">view</span></button>
                                        </div>
                                    </div>
                                    <div class="add-to-cart">
                                        <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
                                    </div>
                                </div>
                                <!-- /product -->
                                    @endforeach
                            </div>
                            <div id="slick-nav-2" class="products-slick-nav"></div>
                        </div>
                        <!-- /tab -->
                    </div>
                </div>
            </div>
            <!-- /Products tab & slick -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">

            <!-- section title -->
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title">New Products</h3>
                </div>
            </div>
            <!-- /section title -->

            <!-- Products tab & slick -->
            <div class="col-md-12">
                <div class="row">
                    <div class="products-tabs">
                        <!-- tab -->
                        <div id="tab2" class="tab-pane fade in active">
                            <div class="products-slick" data-nav="#slick-nav-3">
                            @foreach($newproducts as $newproductItem)
                                <!-- products -->
                                    <div class="product">
                                        <div class="product-img">
                                            <img src="{{asset('../images/'.$newproductItem->image)}}" alt="">
                                            @if($newproductItem->discount)
                                                <div class="product-label">
                                                    <span class="sale">-{{$newproductItem->discount}}%</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">
                                                @foreach($subcategories as $subcategoryItem)
                                                    @if($subcategoryItem->id == $newproductItem->subcategory_id)
                                                        {{$subcategoryItem->name}}
                                                    @endif
                                                @endforeach
                                            </p>
                                            <h3 class="product-name"><a href="#">{{$newproductItem->name}}</a></h3>
                                            @if($newproductItem->discount)
                                                <h4 class="product-price">{{$newproductItem->price * (1 - $newproductItem->discount / 100)}} <del class="product-old-price">{{$newproductItem->price}}</del></h4>
                                            @else
                                                <h4 class="product-price">{{$newproductItem->price}}</h4>
                                            @endif
                                            <div class="product-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <div class="product-btns">
                                                <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
                                                <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">view</span></button>
                                            </div>
                                        </div>
                                        <div class="add-to-cart">
                                            <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
                                        </div>
                                    </div>
                                    <!-- /product -->
                                @endforeach
                            </div>
                            <div id="slick-nav-3" class="products-slick-nav"></div>
                        </div>
                        <!-- /tab -->
                    </div>
                </div>
            </div>
            <!-- /Products tab & slick -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->


@endsection
