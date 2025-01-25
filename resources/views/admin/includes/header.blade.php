<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Add these in your <head> or before the closing </body> tag -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <style>
        .dropdown-menu {
            box-shadow: 0 4px 6px rgba(164, 58, 58, 0.1);
            border: none;
            padding: 0.5rem;
        }

        .dropdown-item {
            font-size: 0.9rem;
            padding: 0.5rem 1rem;
            transition: background-color 0.3s ease;
            /* Smooth hover effect */
        }



        .badge {
            position: absolute;
            top: -5px;
            right: -5px;
        }

        /* Change background color to blue when hovered */
        .dropdown-item:hover {
            background-color: #007bff;
            /* Bootstrap's primary blue color */
            color: #fff;
            /* Optional: Set text color to white for contrast */
        }
    </style>

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
        <div class="container-fluid d-flex align-items-center justify-content-between" {{--  style="background-color: #ffffff;"  --}}>
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
            <div class="right-menu list-inline no-margin-bottom" style="background-color: #e8e8e8;">
                <div class="list-inline-item">
                    <a href="#" class="search-open nav-link">
                        <i class="icon-magnifying-glass-browser"></i>
                    </a>
                </div>
                {{--  Chat  --}}

                
                


                {{--  Notification  --}}


                <div class="list-inline-item dropdown">
                    <a id="notificationDropdown" href="#" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false" class="nav-link messages-toggle">
                        <i class="fa-solid fa-bell fa-lg" style="color: #42e90f;"></i>
                        <span id="notificationCount" class="badge badge-pill badge-success">0</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" id="notificationList" style="min-width: 300px;">
                        <h6 class="dropdown-header">Notifications</h6>
                        <div id="notifications"></div>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item text-center ">View all notifications</a>
                        <a href="{{route('notification.clear')}}" class="dropdown-item text-center">Clear all</a>
                        <a href="{{route('dd.chat.ddd')}}" class="dropdown-item text-center">All Chats</a>
                        
                    </div>
                </div>


                {{--  Old  --}}
                {{--  <div class="list-inline-item dropdown">
                    <a id="navbarDropdownMenuLink1" href="#" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false" class="nav-link messages-toggle">
                        <i class="fa-solid fa-bell fa-lg" style="color: #42e90f;"></i>
                        <span class="badge badge-pill badge-success">5</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink1"
                        style="min-width: 300px;">
                        <h6 class="dropdown-header">Notifications</h6>
                        <div class="dropdown-item bg-white">New message from John Doe</div>
                        <div class="dropdown-item bg-white">Your order has been shipped</div>
                        <div class="dropdown-item bg-white">Server status: All systems operational</div>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item text-center">View all notifications</a>
                    </div>
                </div>  --}}

                {{--  Notification End  --}}
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

        $(document).ready(function () {
            function fetchNotifications() {
                $.ajax({
                    url: '/admin/notifications',
                    method: 'GET',
                    success: function (data) {
                        let notificationCount = data.length;
                        let notificationsHtml = '';
        
                        if (notificationCount > 0) {
                            data.forEach(function (notification) {
                                notificationsHtml += `
                                    <div class="dropdown-item bg-white">
                                        ${notification.message}
                                    </div>
                                `;
                            });
                        } else {
                            notificationsHtml = `
                                <div class="dropdown-item bg-white">No new notifications</div>
                            `;
                        }
        
                        $('#notificationCount').text(notificationCount);
                        $('#notifications').html(notificationsHtml);
                    },
                });
            }
        
            // Fetch notifications on page load
            fetchNotifications();
        
            // Optional: Refresh notifications every 30 seconds
            setInterval(fetchNotifications, 30000);
        });
        

    </script>

    <script>
    // When the sidebar toggle button is clicked, toggle the sidebar visibility
    document.querySelector('.sidebar-toggle').addEventListener('click', function() {
        // Toggle sidebar class to show or hide it
        document.querySelector('#sidebar').classList.toggle(
            'active');
    });
    </script>
