<head>
    <style>
        /* Sidebar Base Styling */
        #sidebar {
            background-color: #fff;
            /* Sidebar background */
            color: #000;
            /* Default text color */
            font-family: 'Roboto', sans-serif;
            width: 250px;
        }

        #sidebar .sidebar-header {
            padding: 20px;
            text-align: center;
            background-color: #f4f4f4;
        }

        #sidebar .sidebar-header h1,
        #sidebar .sidebar-header p {
            margin: 0;
            color: #000;
        }

        #sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        #sidebar ul li {
            position: relative;
        }

        #sidebar ul li a {
            display: block;
            padding: 10px 15px;
            text-decoration: none;
            color: #000;
            /* Default link color */
            transition: background-color 0.3s, color 0.3s;
        }

        /* Hover Effect */
        #sidebar ul li a:hover {
            background-color: #ff6600;
            /* Orange background on hover */
            color: #fff;
            /* White text on hover */
        }

        /* Active Link Styling */
        #sidebar ul li.active>a,
        #sidebar ul li a[aria-expanded="true"] {
            background-color: #007bff;
            /* Blue background for active link */
            color: #fff;
            /* White text for active link */
            font-weight: bold;
        }

        /* Dropdown Items Styling */
        #sidebar ul ul {
            display: none;
            padding-left: 20px;
        }

        #sidebar ul li a[aria-expanded="true"]+ul {
            display: block;
            background-color: white;
        }

        /* Base Sidebar Styling */
        #sidebar ul ul li a {
            display: block;
            padding: 8px 15px;
            text-decoration: none;
            color: #000;
            /* Default text color */
            background-color: white;
            /* Default background color */
            transition: background-color 0.3s, color 0.3s;
        }

        /* Hover Effect for Dropdown Links */
        #sidebar ul ul li a:hover {
            background-color: #ff6600 !important;
            /* Force orange background on hover */
            color: #fff !important;
            /* Force white text on hover */
        }

        /* Active Dropdown Link */
        #sidebar ul ul li.active>a {
            background-color: #007bff !important;
            /* Force blue background for active dropdown item */
            color: #fff !important;
            /* Force white text for active dropdown item */
        }

        /* Add explicit rule for text visibility */
        #sidebar ul ul li a {
            color: #000 !important;
            /* Ensure text is visible by default */
        }
    </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<nav id="sidebar">
    <!-- Sidebar Header -->
    <div class="sidebar-header d-flex align-items-center">
        <div class="avatar">
            <img src="{{ asset('admincss/img/mehedi.jpg') }}" alt="..." class="img-fluid rounded-circle">
        </div>
        <div class="title">
            <h1 class="h5">Amazon Pro</h1>
            <p>Software Developer</p>
        </div>
    </div>
    <!-- Sidebar Navigation Menus -->
    <span class="heading">Main</span>
    <ul class="list-unstyled">
        <li class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
            <a href="{{ url('admin/dashboard/') }}">
                <i class="fas fa-home"></i> Home
            </a>
        </li>

        <li class="{{ request()->is('brand.index') ? 'active' : '' }}">
            <a class="" href="{{ route('brand.index') }}">
                <i class="fas fa-box"></i> Brand
            </a>
        </li>

        <!-- Category Dropdown -->
        <!-- <li class="{{ request()->is('view_category') ? 'active' : '' }}">
            <a href="{{ url('view_category') }}">
                <i class="fas fa-th"></i> Category
            </a>
        </li> -->

        <!-- Dropdown for Categories -->
        <li class="{{ request()->is('add_category') || request()->is('view_category') ? 'active' : '' }}">
            <a href="#categoryDropdown"
                aria-expanded="{{ request()->is('add_category') || request()->is('view_category') ? 'true' : 'false' }}"
                data-toggle="collapse">
                <i class="fas fa-cogs"></i> Categories
            </a>
            <ul id="categoryDropdown"
                class="collapse list-unstyled {{ request()->is('add_category') || request()->is('view_category') ? 'show' : '' }}">

                <li class="{{ request()->is('view_category') ? 'active' : '' }}">
                    <a href="{{ url('view_category') }}">View Categories</a>
                </li>


                <li class="{{ request()->is('add_category') ? 'active' : '' }}">
                    <a href="{{ route('subcategory.index') }}">Subcategory</a>
                </li>


                <li class="{{ request()->is('add_childcategory') ? 'active' : '' }}">
                    <a href="{{ route('childcategory.index') }}">Child Category</a>
                </li>


            </ul>
        </li>

        <!-- Example of a category dropdown with subcategories -->






        <!-- Category Dropdown End -->
        <li
            class="{{ request()->is('add_product') || request()->is('view_product') || request()->is('view_size') || request()->is('view_color') ? 'active' : '' }}">
            <a href="#exampledropdownDropdown"
                aria-expanded="{{ request()->is('add_product') || request()->is('view_product') || request()->is('view_size') || request()->is('view_color') ? 'true' : 'false' }}"
                data-toggle="collapse">
                <i class="fas fa-cogs"></i> Products
            </a>
            <ul id="exampledropdownDropdown"
                class="collapse list-unstyled {{ request()->is('add_product') || request()->is('view_product') || request()->is('view_size') || request()->is('view_color') ? 'show' : '' }}">
                <li class="{{ request()->is('add_product') ? 'active' : '' }}">


                    <a href="{{ url('add_product') }}">Add Product</a>
                </li>


                <li class="{{ request()->is('view_product') ? 'active' : '' }}">
                    <a href="{{ url('view_product') }}">View Product</a>
                </li>

                <li class="{{ request()->is('view_size') ? 'active' : '' }}">
                    <a href="{{ route('view_size') }}">Product Size</a>
                </li>


                <li class="{{ request()->is('view_color') ? 'active' : '' }}">
                    <a href="{{ route('view_color') }}">Product Color</a>
                </li>


            </ul>
        </li>
        <li class="{{ request()->is('view_orders') ? 'active' : '' }}">
            <a class="ajax-link" data-url="{{ url('view_orders') }}">
                <i class="fas fa-box"></i> Orders
            </a>
        </li>

        <li class="{{ request()->is('customer/support') ? 'active' : '' }}">
            <a  href="{{ route('customer.contact') }}">
                <i class="fas fa-box"></i> Customer Contact
            </a>
        </li>
        <li>
            <a href="#">
                <i class="fas fa-sign-out-alt"></i> Login page
            </a>
        </li>
    </ul>



</nav>

<body>



    <script>
        $(document).ready(function() {
            $('.ajax-link').on('click', function(e) {
                e.preventDefault();

                let url = $(this).data('url');
                let title = $(this).data('title');

                // Update the browser URL
                history.pushState(null, title, url);

                // Fetch only the main content dynamically
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(data) {
                        $('#main-content').html(data); // Replace only the content section
                    },
                    error: function() {
                        alert('Failed to load data. Please try again.');
                    }
                });
            });

            // Handle browser back/forward navigation
            window.onpopstate = function() {
                let currentUrl = window.location.href;

                $.ajax({
                    url: currentUrl,
                    type: 'GET',
                    success: function(data) {
                        $('#main-content').html(data); // Replace only the content section
                    },
                    error: function() {
                        alert('Failed to load data. Please try again.');
                    }
                });
            };
        });
    </script>
</body>
