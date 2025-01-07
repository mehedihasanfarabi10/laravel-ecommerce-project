<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>
<header class="header">
    <nav class="navbar navbar-expand-lg">
        <div class="search-panel">
            <div class="search-inner d-flex align-items-center justify-content-center">
                <div class="close-btn">Close <i class="fa fa-close"></i></div>
                <form id="searchForm" action="#">
                    <div class="form-group">
                        <input type="search" name="search" placeholder="What are you searching for...">
                        <button type="submit" class="submit">Search</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="container-fluid d-flex align-items-center justify-content-between">
            <div class="navbar-header">
                <!-- Navbar Header--><a href="/admin/dashboard/" class="navbar-brand">
                    <div class="brand-text brand-big visible text-uppercase"><strong
                            class="text-primary">Mehedi</strong><strong>Hasan</strong></div>
                    <div class="brand-text brand-sm"><strong class="text-primary">Amazon</strong><strong>Pro</strong>
                    </div>
                </a>
                <!-- Sidebar Toggle Btn-->
                <button class="sidebar-toggle">
                    <i class="fas fa-arrow-alt-circle-left"></i>
                </button>

            </div>
            <div class="right-menu list-inline no-margin-bottom">
                <div class="list-inline-item"><a href="#" class="search-open nav-link"><i
                            class="icon-magnifying-glass-browser"></i></a></div>
                <div class="list-inline-item dropdown"><a id="navbarDropdownMenuLink1" href="http://example.com"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                        class="nav-link messages-toggle"><i class="icon-email"></i><span
                            class="badge dashbg-1">5</span></a>
                    <div aria-labelledby="navbarDropdownMenuLink1" class="dropdown-menu messages"><a href="#"
                            class="dropdown-item message d-flex align-items-center">

                            <div class="content"> <strong class="d-block">Sara Wood</strong><span class="d-block">lorem
                                    ipsum dolor sit amit</span><small class="date d-block">10:30pm</small></div>
                        </a><a href="#" class="dropdown-item text-center message"> <strong>See All Messages <i
                                    class="fa fa-angle-right"></i></strong></a></div>
                </div>


                <!-- Log out               -->
                <div class="list-inline-item logout">
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <input type="submit" value="logout">
                        <!--
                        <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>  -->
                    </form>
                </div>
            </div>
        </div>
    </nav>
</header>

<script>
    // When the sidebar toggle button is clicked, toggle the sidebar visibility
    document.querySelector('.sidebar-toggle').addEventListener('click', function() {
        // Toggle sidebar class to show or hide it
        document.querySelector('#sidebar').classList.toggle(
        'active'); 
    });
</script>
