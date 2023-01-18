<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>Voltaic - Online Store</title>

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="{{asset('main/css/bootstrap.min.css')}}"/>

    <!-- Slick -->
    <link type="text/css" rel="stylesheet" href="{{asset('main/css/slick.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('main/css/slick-theme.css')}}"/>

    <!-- nouislider -->
    <link type="text/css" rel="stylesheet" href="{{asset('main/css/nouislider.min.css')}}"/>

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="{{asset('main/css/font-awesome.min.css')}}">

    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="{{asset('main/css/style.css')}}"/>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
<!-- HEADER -->
<header>
    <!-- TOP HEADER -->
    <div id="top-header">
        <div class="container">
            <ul class="header-links pull-left">
                <li><a href="#"><i class="fa fa-phone"></i> 57865775</a></li>
                <li><a href="#"><i class="fa fa-envelope-o"></i> Martin.Gerstman@ivkhk.ee</a></li>
                <li><a href="#"><i class="fa fa-facebook"></i>Facebook</a></li>
                <li><a href="#"><i class="fa fa-wordpress"></i>Wordpress</a></li>
            </ul>
            <ul class="header-links pull-right">
                @if(Auth::check())
                    @if(Auth::user()->role_id == 0 || Auth::user()->role_id == 1)
                        <li><a href="{{url('dashboard')}}"><i class="fa fa-columns"></i>Admin Panel</a></li>
                    @endif
                    <li><a href="{{url('profile/'.Auth::user()->id)}}"><i class="fa fa-user-o"></i>{{Auth::user()->name}}</a></li>
                        <li><a href="{{url('logout')}}"><i class="fa fa-sign-out"></i>Log Out</a></li>
                @else
                    <li><a href="{{url('login')}}"><i class="fa fa-user-o"></i>Log In</a></li>
                    <li><a href="{{url('signup')}}"><i class="fa fa-user-o"></i>Sign Up</a></li>
                @endif
            </ul>
        </div>
    </div>
    <!-- /TOP HEADER -->

    <!-- MAIN HEADER -->
    <div id="header">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- LOGO -->
                <div class="col-md-3">
                    <div class="header-logo">
                        <a href="{{url('/')}}" class="logo">
                            <img src="{{asset('main/img/logo.png')}}" alt="">
                        </a>
                    </div>
                </div>
                <!-- /LOGO -->

                <!-- SEARCH BAR -->
                <div class="col-md-6">
                    <div class="header-search">
                        <form action="{{url('search')}}" method="GET">
                            <input name="search" class="input-select col-md-9" placeholder="Search here" required>
                            <button type="submit" class="search-btn">Search</button>
                        </form>
                    </div>
                </div>
                <!-- /SEARCH BAR -->

                <!-- ACCOUNT -->
                <div class="col-md-3 clearfix">
                    <div class="header-ctn">
                        <!-- Wishlist -->
                        <div>
                            <a href="#">
                                <i class="fa fa-heart-o"></i>
                                <span>Your Wishlist</span>
                                <div class="qty">2</div>
                            </a>
                        </div>
                        <!-- /Wishlist -->

                        <!-- Cart -->
                        <div>
                            <a href="{{url('cart')}}">
                                <i class="fa fa-shopping-cart"></i>
                                <span>Your Cart</span>
                                @if(Session::get('cart') != null)
                                    <div class="qty">{{count(Session::get('cart'))}}</div>
                                @endif
                            </a>
                        </div>
                        <!-- /Cart -->

                        <!-- Menu Toogle -->
                        <div class="menu-toggle">
                            <a href="#">
                                <i class="fa fa-bars"></i>
                                <span>Menu</span>
                            </a>
                        </div>
                        <!-- /Menu Toogle -->
                    </div>
                </div>
                <!-- /ACCOUNT -->
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </div>
    <!-- /MAIN HEADER -->
</header>
<!-- /HEADER -->

<!-- NAVIGATION -->
<nav id="navigation">
    <!-- container -->
    <div class="container">
        <!-- responsive-nav -->
        <div id="responsive-nav">
            <!-- NAV -->
            <ul class="main-nav nav navbar-nav">
                @foreach($categories as $categoryItem)
                    <li class="nav-item menu-items">
                        <div class="dropdownOnHover">
                            <button href="#" class="dropbtnOnHover">{{$categoryItem->name}}
                            </button>
                            <div class="dropdownOnHover-content">
                                @foreach($subcategories as $subcategoryItem)
                                    @if($subcategoryItem->category_id == $categoryItem->id)
                                        <a href="{{url('catalog/'.$subcategoryItem->id)}}">{{$subcategoryItem->name}}</a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
            <!-- /NAV -->
        </div>
        <!-- /responsive-nav -->
    </div>
    <!-- /container -->
</nav>
<!-- /NAVIGATION -->

@yield('content')

<!-- FOOTER -->
<footer id="footer" class="mt-2">
    <!-- top footer -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-3 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-title">About Us</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.</p>
                        <ul class="footer-links">
                            <li><a href="#"><i class="fa fa-phone"></i>57865775</a></li>
                            <li><a href="#"><i class="fa fa-envelope-o"></i>Martin.Gerstman@ivkhk.ee</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-3 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-title">Categories</h3>
                        <ul class="footer-links">
                            <li><a href="#">Laptops</a></li>
                            <li><a href="#">Smartphones</a></li>
                            <li><a href="#">Cameras</a></li>
                            <li><a href="#">Accessories</a></li>
                        </ul>
                    </div>
                </div>

                <div class="clearfix visible-xs"></div>

                <div class="col-md-3 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-title">Information</h3>
                        <ul class="footer-links">
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Contact Us</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-3 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-title">Service</h3>
                        <ul class="footer-links">
                            <li><a href="#">My Account</a></li>
                            <li><a href="#">View Cart</a></li>
                            <li><a href="#">Wishlist</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /top footer -->

    <!-- bottom footer -->
    <div id="bottom-footer" class="section">
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12 text-center">

							<span class="copyright">
								<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
								Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Martin Gerstman JKTV21
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
							</span>

                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /bottom footer -->
</footer>
<!-- /FOOTER -->

<!-- jQuery Plugins -->
<script src="{{asset('main/js/jquery.min.js')}}"></script>
<script src="{{asset('main/js/bootstrap.min.js')}}"></script>
<script src="{{asset('main/js/slick.min.js')}}"></script>
<script src="{{asset('main/js/nouislider.min.js')}}"></script>
<script src="{{asset('main/js/jquery.zoom.min.js')}}"></script>
<script src="{{asset('main/js/main.js')}}"></script>

</body>
</html>
