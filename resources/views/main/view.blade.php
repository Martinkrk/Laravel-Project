@extends('layouts.appMain')
@section('content')

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- Product main img -->
            <div class="col-md-5 col-md-push-2">
                <div id="product-main-img">
                    <div class="product-preview">
                        <img src="{{asset('../images/'.$product->image)}}" alt="Product Image">
                    </div>
                    @foreach($images as $imageItem)
                        <div class="product-preview">
                            <img src="{{asset('../images/'.$imageItem->image)}}" alt="Product Image">
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- /Product main img -->

            <!-- Product thumb imgs -->
            <div class="col-md-2  col-md-pull-5">
                <div id="product-imgs">
                    <div class="product-preview">
                        <img src="{{asset('../images/'.$product->image)}}" alt="Product Image">
                    </div>
                    @foreach($images as $imageItem)
                        <div class="product-preview">
                            <img src="{{asset('../images/'.$imageItem->image)}}" alt="Product Image">
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- /Product thumb imgs -->

            <!-- Product details -->
            <div class="col-md-5">
                <div class="product-details">
                    <h2 class="product-name">{{$product->name}}</h2>
                    <div>
                        <div class="product-rating">
                            <?php $sum = 0; $one = 0; $two = 0; $three = 0; $four = 0; $five = 0; ?>
                            @foreach($ratings as $ratingItemCalc)
                                <?php $sum += $ratingItemCalc->rating ?>
                                @if($ratingItemCalc->rating == 1) <?php $one++ ?> @endif
                                @if($ratingItemCalc->rating == 2) <?php $two++ ?> @endif
                                @if($ratingItemCalc->rating == 3) <?php $three++ ?> @endif
                                @if($ratingItemCalc->rating == 4) <?php $four++ ?> @endif
                                @if($ratingItemCalc->rating == 5) <?php $five++ ?> @endif
                            @endforeach
                            @if($sum > 0)
                            <?php $avg = round($sum/count($ratings), 1) ?>
                            @else
                                <?php $avg = 0 ?>
                            @endif

                            @for($i = 0; $i < 5; $i++)
                                @if($avg > $i)
                                    <i class="fa fa-star"></i>
                                @else
                                    <i class="fa fa-star-o"></i>
                                @endif
                            @endfor
                        </div>
                        @if($ratings != null)
                            @if(count($ratings) < 1)
                                <a class="review-link">No reviews</a>
                            @else
                                <a class="review-link">{{count($ratings)}} Review(s)</a>
                            @endif
                        @endif
                    </div>
                    <div>
                        @if($product->discount)
                            <h4 class="product-price">{{$product->price * (1 - $product->discount / 100)}}€ <del class="product-old-price">{{$product->price}}€</del></h4>
                        @else
                            <h4 class="product-price">{{$product->price}}€</h4>
                        @endif
                        @if($product->stock < 1)
                            <span class="product-available">Sold Out</span>
                        @else
                            <span class="product-available">In Stock</span>
                        @endif
                    </div>

                    <div class="add-to-cart">
                        <a href="{{url('addtocart/'.$product->id)}}" class="btn add-to-cart-btn"><i class="fa fa-shopping-cart"></i>add to cart</a>
                    </div>

                    <ul class="product-btns">
                        <li><a href="#"><i class="fa fa-heart-o"></i> add to wishlist</a></li>
                    </ul>

                    <ul class="product-links">
                        <li>Category:</li>
                        <li><a href="{{url('catalog/'.$productsubcategory->id)}}">{{$productsubcategory->name}}</a></li>
                    </ul>

                </div>
            </div>
            <!-- /Product details -->

            <!-- Product tab -->
            <div class="col-md-12">
                <div id="product-tab">
                    <!-- product tab nav -->
                    <ul class="tab-nav">
                        <li class="active"><a data-toggle="tab" href="#tab1">Details</a></li>
                        <li><a data-toggle="tab" href="#tab2">Reviews
                                @if($ratings != null and count($ratings) > 0)
                                    ({{count($ratings)}})
                                @endif
                            </a></li>
                    </ul>
                    <!-- /product tab nav -->

                    <!-- product tab content -->
                    <div class="tab-content">
                        <!-- tab1  -->
                        <div id="tab1" class="tab-pane fade in active">
                            <h4>Features</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <ul class="list-group">
                                            @foreach($productfilters as $productfilterItem)
                                                @foreach($filters as $filterItem)
                                                    @if($productfilterItem->filter->id == $filterItem->id)
                                                        @if($loop->parent->index+1 == $productfilterhalf)
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <ul class="list-group">
                                                        @endif
                                                        <li class="list-group-item @if($loop->parent->index % 2 == 0) active @endif">
                                                            <b>{{$filterItem->name}}</b> - {{$productfilterItem->filtervalue}}
                                                        </li>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>

                            @if($product->description != null)
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4>Description</h4>
                                        <p>{{$product->description}}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <!-- /tab1  -->

                        <!-- tab2  -->
                        <div id="tab2" class="tab-pane fade in">
                            <div class="row">
                                <!-- Rating -->
                                <div class="col-md-3">
                                    <div id="rating">
                                        <div class="rating-avg">
                                            <span>
                                            </span>
                                            <div class="rating-stars">
                                                @for($i = 0; $i < 5; $i++)
                                                    @if($avg > $i)
                                                        <i class="fa fa-star"></i>
                                                    @else
                                                        <i class="fa fa-star-o empty"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                        </div>
                                        <ul class="rating">
                                            <li>
                                                <div class="rating-stars">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                                <div class="rating-progress">
                                                    <div style="width:
                                                    @if($five > 0)
                                                    {{($five / ($one+$two+$three+$four+$five))*100}}
                                                    @else
                                                    0
                                                    @endif
                                                    %;"></div>
                                                </div>
                                                <span class="sum">{{$five}}</span>
                                            </li>
                                            <li>
                                                <div class="rating-stars">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                </div>
                                                <div class="rating-progress">
                                                    <div style="width:
                                                    @if($four > 0)
                                                    {{($four / ($one+$two+$three+$four+$five))*100}}
                                                    @else
                                                    0
                                                    @endif
                                                    %;"></div>
                                                </div>
                                                <span class="sum">{{$four}}</span>
                                            </li>
                                            <li>
                                                <div class="rating-stars">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                </div>
                                                <div class="rating-progress">
                                                    <div style="width:
                                                    @if($three > 0)
                                                    {{($three / ($one+$two+$three+$four+$five))*100}}
                                                    @else
                                                    0
                                                    @endif
                                                    %;"></div>
                                                </div>
                                                <span class="sum">{{$three}}</span>
                                            </li>
                                            <li>
                                                <div class="rating-stars">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                </div>
                                                <div class="rating-progress">
                                                    <div style="width:
                                                    @if($two > 0)
                                                    {{($two / ($one+$two+$three+$four+$five))*100}}
                                                    @else
                                                    0
                                                    @endif
                                                    %;"></div>
                                                </div>
                                                <span class="sum">{{$two}}</span>
                                            </li>
                                            <li>
                                                <div class="rating-stars">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                </div>
                                                <div class="rating-progress">
                                                    <div style="width:
                                                    @if($one > 0)
                                                    {{($one / ($one+$two+$three+$four+$five))*100}}
                                                    @else
                                                    0
                                                    @endif
                                                    %;"></div>
                                                </div>
                                                <span class="sum">{{$one}}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- /Rating -->

                                <!-- Reviews -->
                                <div class="col-md-6">
                                    <div id="reviews">
                                        <ul class="reviews">
                                            @foreach($ratings as $ratingItem)
                                                @if($ratingItem->user_id == Auth::user()->id)
                                                    <?php $yourRating = $ratingItem->rating ?>
                                                @endif
                                                <li>
                                                    <div class="review-heading">
                                                        @foreach($users as $userItem)
                                                            @if($ratingItem->user_id == $userItem->id)
                                                                <h5 class="name">{{$userItem->name}}</h5>
                                                            @endif
                                                        @endforeach
                                                        <p class="date">{{$ratingItem->updated_at}}</p>
                                                        <div class="review-rating">
                                                            @for($i = 0; $i < 5; $i++)
                                                                @if($ratingItem->rating > $i)
                                                                    <i class="fa fa-star"></i>
                                                                @else
                                                                    <i class="fa fa-star-o empty"></i>
                                                                @endif
                                                            @endfor
                                                        </div>
                                                    </div>
                                                    <div class="review-body">
                                                        <p>{{$ratingItem->message}}</p>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <ul class="reviews-pagination">
                                            {{$ratings->links()}}
                                        </ul>
                                    </div>
                                </div>
                                <!-- /Reviews -->

                                <!-- Review Form -->
                                <div class="col-md-3">
                                    <div id="review-form">
                                        @if(Auth::check())
                                            <?php $ratingExists = false ?>
                                            @foreach($users as $userItem)
                                                @if(Auth::user()->id == $userItem->id)
                                                    <?php $ratingExists = true ?>
                                                    @break
                                                @endif
                                            @endforeach

                                            @if($ratingExists)
                                                <b>You've already left a review!</b>
                                                <ul class="rating">
                                                    <div class="rating-stars">
                                                        @for($i = 0; $i < 5; $i++)
                                                            @if($yourRating > $i)
                                                                <i class="fa fa-star"></i>
                                                            @else
                                                                <i class="fa fa-star-o empty"></i>
                                                            @endif
                                                        @endfor
                                                    </div>
                                                </ul>
                                                <br><br>
                                                <a href="{{url('resetreview/'.$product->id.'/'.Auth::user()->id)}}" class="primary-btn">Reset review<review></review></a></a>

                                            @else

                                            @if(session()->has('error'))
                                                <div class="alert alert-danger">
                                                    {{session()->get('error')}}
                                                </div>
                                            @endif
                                            <form action="{{url('addrating')}}" method="POST" class="review-form">
                                                @csrf
                                                <input class="input" type="hidden" name="product_id" value="{{$product->id}}" readonly>
                                                <textarea class="input" name="message" placeholder="Your Review" required></textarea>
                                                <div class="input-rating">
                                                    <span>Your Rating: </span>
                                                    <div class="stars">
                                                        <input id="star5" name="rating" value="5" type="radio"><label for="star5"></label>
                                                        <input id="star4" name="rating" value="4" type="radio"><label for="star4"></label>
                                                        <input id="star3" name="rating" value="3" type="radio"><label for="star3"></label>
                                                        <input id="star2" name="rating" value="2" type="radio"><label for="star2"></label>
                                                        <input id="star1" name="rating" value="1" type="radio" checked><label for="star1"></label>
                                                    </div>
                                                </div>
                                                <button class="primary-btn">Submit</button>
                                            </form>
                                            @endif
                                        @else
                                            <b>Only registered users may leave reviews</b>
                                            <br><br>
                                            <a href="{{url('login')}}" class="primary-btn">Log in</a></a>
                                            <a href="{{url('signup')}}" class="primary-btn">Sign up</a>
                                        @endif
                                    </div>
                                </div>
                                <!-- /Review Form -->
                            </div>
                        </div>
                        <!-- /tab2  -->
                    </div>
                    <!-- /product tab content  -->
                </div>
            </div>
            <!-- /product tab -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

@endsection
