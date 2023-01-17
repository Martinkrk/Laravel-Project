@extends('layouts.appMain')
@section('content')

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
                <form action="{{url('catalog/'. $subCategory->id)}}" method="GET">
        <!-- row -->
        <div class="row">
            <!-- ASIDE -->
            <div id="aside" class="col-md-3">

                    <div class="aside">
                        <button type="submit" class="primary-btn btn-sm order-submit">Apply Filters</button>
                        <button type="reset" class="secondary-btn btn-sm order-submit">Clear</button>
                    </div>
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
                        @foreach($filters as $filter)


                            @foreach($filterValues as $filterValueHeading)
                                @if($filter->id == $filterValueHeading->filter_id)
                                    <h3 class="aside-title">{{$filter->name}}</h3>
                                    @break
                                @endif
                            @endforeach


                            @foreach($filterValues as $filterValue)
                                @if($filter->id == $filterValue->filter_id)
                                <div class="checkbox-filter">
                                    <div class="input-checkbox">
                                        <input type="checkbox" id="{{$filterValue->filter_id}}{{$filterValue->filtervalue}}" name="filters[]" value="{{$filterValue->filter_id}}*{{$filterValue->filtervalue}}"
                                        @if($checkedfilters != null)
                                            @foreach($checkedfilters as $checkedfilter)
                                                @if($checkedfilter == $filterValue->filter_id.'*'.$filterValue->filtervalue)
                                                    checked
                                                    @endif
                                                @endforeach
                                            @endif
                                        >
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
{{--                </form>--}}
            </div>
            <!-- /ASIDE -->

            <!-- STORE -->
            <div id="store" class="col-md-9">
                <!-- store top filter -->
                <div class="store-filter clearfix">
                    <div class="store-sort">
                        <label>
                            Sort By:
                            <select name="sort" class="input-select"onchange="submit();">
                                @foreach($sorts as $sortItem)
                                    <option value="{{$sortItem}}" @if($sortItem == $selectedsort) selected @endif>{{$sortItem}}</option>
                                @endforeach
                            </select>
                        </label>

                            <label>
                                Show:
                                <select name="show" class="input-select" onchange="submit();">
                                    @foreach($shows as $showItem)
                                        <option value="{{$showItem}}" @if($showItem == $selectedshow) selected @endif>{{$showItem}}</option>
                                    @endforeach
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
                                <h3 class="product-name"><a href="{{url('view/'.$productItem->id)}}">{{$productItem->name}}</a></h3>
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
                                    <button class="quick-view"><a href="{{url('view/'.$productItem->id)}}" class="fa fa-eye"></a><span class="tooltipp">view</span></button>
                                </div>
                            </div>
                            <div class="add-to-cart">

                                <a href="{{url('addtocart/'.$productItem->id)}}" class="btn add-to-cart-btn"><i class="fa fa-shopping-cart"></i>add to cart</a>
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
                        {{$products->links()}}
                </div>
                <!-- /store bottom filter -->
            </div>
            <!-- /STORE -->
        </div>
        <!-- /row -->
</form>
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

@endsection
