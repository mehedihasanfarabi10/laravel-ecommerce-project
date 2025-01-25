<head>
    <!-- Custom Stylesheet -->
    <link href="{{ asset('sellers/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<header class="header_section">
    <nav class="navbar navbar-expand-lg custom_nav-container ">
        {{--  <a class="navbar-brand" href="/">
            <span>
                Amazon Pro
            </span>
        </a>  --}}
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav  ">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('/') }}">Home
                        {{--  <span class="sr-only">(current)</span>  --}}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('shop') }}">
                        Shop
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('why') }}">
                        Why Us
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('testimonial') }}">
                        Testimonial
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contact') }}">Contact Us</a>
                </li>
            </ul>
            <div class="user_option">

                @if (Route::has('login'))
                    @auth


                        <ul class="navbar-nav">

                            <li class="nav-item active">
                                <a href="{{ url('mycart') }}" style="color: white!important">
                                    <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                                    {{ $count ?? 0 }}
                                </a>
                            </li>
                            <li class="nav-item active">
                                <a href="{{ route('wishlist.view') }}" style="color: white!important">
                                    <i class="fas fa-heart" style="color: #ffffff; font-size: 20px; cursor: pointer;"></i>

                                    {{ $counts ?? 0 }}
                                </a>
                            </li>
                            <li class="nav-item active">
                                <a href="{{ route('seller.login') }}" style="color: white!important">
                                    Become Seller
                                </a>
                            </li>
                        </ul>



                        {{--   Search   --}}

                        <form style="padding: 10px" action="{{ url('product_search2') }}" method="get">
                            @csrf
                            <input width="200px" height="30px" style="margin-bottom: 10px;" type="search" name="search"
                                value="{{ request()->search }}">
                            <input style="padding: 4" type="submit" class="btn btn-danger " value="search">
                        </form>


                        {{--  Logout  --}}

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <input type="submit" style="padding: 10px;" class="btn btn-success" value="logout">
                        </form>

                        <li class="icons dropdown">
                            <div class="user-img c-pointer position-relative" data-toggle="dropdown">
                                <span class="activity active"></span>
                                <img src="{{ asset('sellers/images/user/1.png') }}" height="40" width="40"
                                    alt="">
                            </div>
                            <div class="drop-down dropdown-profile animated fadeIn dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li>
                                            <a href="{{ route('user.profile') }}"><i class="icon-user"></i>
                                                <span>Profile</span></a>
                                        </li>

                                        <li>
                                            <a href="{{ route('chat.index') }}"><i class="icon-user"></i>
                                                <span>Chat</span></a>
                                        </li>

                                        <li>
                                            <a href="{{ url('myorders') }}">
                                                <i class="fa-solid fa-signal"></i><span>My Order</span>
                                                <div class="badge gradient-3 badge-pill gradient-2">1</div>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{ route('track.order') }}">
                                                <i class="fa-brands fa-apple"></i> <span>Track Order</span>
                                                <div class="badge gradient-3 badge-pill gradient-1">3</div>
                                            </a>
                                        </li>



                                        {{--  <hr class="my-2">
                                        <li>
                                            <a href="page-lock.html"><i class="icon-lock"></i> <span>Lock
                                                    Screen</span></a>
                                        </li>
                                        <li><a href="page-login.html"><i class="icon-key"></i> <span>Logout</span></a>
                                        </li>  --}}
                                    </ul>
                                </div>
                            </div>
                        </li>
                    @else
                        {{--   Search   --}}



                        <form style="padding: 10px" action="{{ url('product_search2') }}" method="get">
                            @csrf
                            <input width="200px" height="30px" style="margin-bottom: 10px;" type="search" name="search"
                                value="{{ request()->search }}">
                            <input style="padding: 4" type="submit" class="btn btn-danger" value="search">
                        </form>

                        <!-- LogIn -->
                        <a href="{{ url('/login') }}" style="color: white!important">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <span>
                                Login
                            </span>
                        </a>
                        <!-- Register -->
                        <a href="{{ url('/register') }}" style="color: white!important">
                            <i class="fa fa-vcard" aria-hidden="true"></i>
                            <span>
                                Register
                            </span>
                        </a>



                    @endauth
                @endif



                <!-- <form class="form-inline ">
            <button class="btn nav_search-btn" type="submit">
              <i class="fa fa-search" aria-hidden="true"></i>
            </button>
          </form> -->
            </div>
        </div>
    </nav>
</header>
