<header class="header_section">
    <nav class="navbar navbar-expand-lg custom_nav-container ">
        <a class="navbar-brand" href="/">
            <span>
                Amazon Pro
            </span>
        </a>
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
                            <a href="{{ url('myorders') }}" style="color: white!important">
                                My Order
                            </a>
                        </li>
                        <li class="nav-item active">
                            <a href="{{ url('mycart') }}" style="color: white!important">
                                <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                                {{ $count ?? 0 }}
                            </a>
                        </li>
                        <li class="nav-item active">
                            <a href="{{ route('seller.login') }}" style="color: white!important">
                                Become Seller
                            </a>
                        </li>
                    </ul>
                    
                        
                        
                      

                        <!--  -->
                        



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
