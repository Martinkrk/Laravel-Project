@extends('layouts.appMain')
@section('content')

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- ASIDE -->
            <div id="aside" class="col-md-3">

                <!-- aside Widget -->
                <div class="aside">
                    <h3 class="aside-title">Price</h3>
                    <div class="price-filter">
                        <div id="price-slider"></div>
                        <div class="input-number price-min">
                            <input id="price-min" type="number">
                            <span class="qty-up">+</span>
                            <span class="qty-down">-</span>
                        </div>
                        <span>-</span>
                        <div class="input-number price-max">
                            <input id="price-max" type="number">
                            <span class="qty-up">+</span>
                            <span class="qty-down">-</span>
                        </div>
                    </div>
                </div>
                <!-- /aside Widget -->

                <!-- aside Widget -->
                <div class="aside">
                    <form action="{{url('catalog')}}" method="GET">
                        <button type="submit" class="search-btn">Apply Filters</button>
                        @foreach($filters as $filter)
                        <h3 class="aside-title">{{$filter->name}}</h3>
                        @foreach($filterValues as $filterValue)
                            @if($filter->id == $filterValue->filter_id)
                            <div class="checkbox-filter">
                                <div class="input-checkbox">
                                    <input type="checkbox" id="{{$filterValue->filter_id}}{{$filterValue->filtervalue}}" name="filters[]" value="{{$filterValue->filter_id}}*{{$filterValue->filtervalue}}">
                                    <label for="{{$filterValue->filter_id}}{{$filterValue->filtervalue}}">
                                        <span></span>
                                        {{$filterValue->filtervalue}}
                                        <small></small>
                                    </label>
                                </div>
                            </div>
                                @endif
                            @endforeach
                        @endforeach
                    </div>
                    <!-- /aside Widget -->

                </form>
            </div>
            <!-- /ASIDE -->

            <!-- STORE -->
            <div id="store" class="col-md-9">
                <!-- store top filter -->
                <div class="store-filter clearfix">
                    <div class="store-sort">
                        <label>
                            Sort By:
                            <select class="input-select">
                                <option value="0">Popular</option>
                                <option value="1">Position</option>
                            </select>
                        </label>

                        <label>
                            Show:
                            <select class="input-select">
                                <option value="0">20</option>
                                <option value="1">50</option>
                            </select>
                        </label>
                    </div>
                </div>
                <!-- /store top filter -->

                <!-- store products -->
                <div class="row">
                    <!-- product -->
                    @foreach($products as $productItem)
                    <div class="col-md-4 col-xs-6">
                        <div class="product">
                            <div class="product-img">
                                <img src="{{asset('../images/'.$productItem->image)}}" alt="">
                                @if($productItem->discount)
                                    <div class="product-label">
                                        <span class="sale">-{{$productItem->discount}}%</span>
                                    </div>
                                @endif
                            </div>
                            <div class="product-body">
                                <h3 class="product-name"><a href="#">{{$productItem->name}}</a></h3>
                                @if($productItem->discount)
                                    <h4 class="product-price">{{$productItem->price * (1 - $productItem->discount / 100)}} <del class="product-old-price">{{$productItem->price}}</del></h4>
                                @else
                                    <h4 class="product-price">{{$productItem->price}}</h4>
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
                    </div>
                    <!-- /product -->

                    @if(($loop->index + 1) % 3 == 0)
                    <div class="clearfix visible-lg visible-md"></div>
                        @endif
                    @endforeach

                </div>
                <!-- /store products -->

                <!-- store bottom filter -->
                <div class="store-filter clearfix">
                    <span class="store-qty">Showing 20-100 products</span>
                    <ul class="store-pagination">
                        <li class="active">1</li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                    </ul>
                </div>
                <!-- /store bottom filter -->
            </div>
            <!-- /STORE -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

@endsection
