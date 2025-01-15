<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        /* Sidebar styles */
        .dashboard-container {
            display: flex;
            {{--  Fixed height . WIthout height it can be responsive  --}} {{--  height: 100vh;   --}}
        }

        .sidebar {
            width: 250px;
            background-color: #ffffff;
            color: rgb(6, 6, 6);
            padding-top: 20px;
            flex-shrink: 0;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar ul li {
            margin: 0;
            padding: 10px 20px;
            border-bottom: 1px solid #000000;
            cursor: pointer;
        }

        .sidebar ul li:hover {
            background-color: #a4c4e4;

        }

        .sidebar ul li.active {
            background-color: #d0d3d6;
        }

        .sidebar ul li a {
            color: white;
            text-decoration: none;
            display: block;
        }

        /* Content styles */
        .content {
            flex-grow: 1;
            padding: 20px;
        }

        .content h2 {
            margin-bottom: 10px;
            color: #161718;
        }

        .content p {
            color: #34373a;
        }

        .logout {
            text-align: center;
            margin-top: auto;
            padding: 10px 20px;
            background-color: #dc3545;
            cursor: pointer;
        }

        .logout:hover {
            background-color: #25e22b;
        }

        .order-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .order-table th,
        .order-table td {
            padding: 15px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .order-table th {
            background-color: #f8f9fa;
            font-weight: bold;
        }

        .order-title {
            font-size: 24px;
            font-weight: bold;
            color: crimson;
            margin-bottom: 20px;
        }

        .product-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 5px;
        }

        {{--  Address Box  --}}

        .address-box {
            border: 1px solid #ccc;
            padding: 15px;
            border-radius: 8px;
            background-color: #f9f9f9;
            max-width: 400px;
            margin: 20px auto;
        }
    
        .address-box h3 {
            margin-bottom: 10px;
            font-size: 18px;
            color: #333;
        }
    
        .address-box p {
            margin: 0 0 15px;
            line-height: 1.6;
            color: #555;
        }
    
        .address-box a.edit-button {
            display: inline-block;
            padding: 8px 12px;
            font-size: 14px;
            color: #fff;
            background-color: #007bff;
            text-decoration: none;
            border-radius: 4px;
        }
    
        .address-box a.edit-button:hover {
            background-color: #0056b3;
        }
        {{--  Address Box End --}}
    </style>
</head>




<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-lg-3 col-sm-6">
            <div class="card gradient-1">
                <div class="card-body">
                    <h3 class="card-title text-white">Your Cart </h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">0</h2>
                        <p class="text-white mb-0">Jan - March 2019</p>
                    </div>
                    <a class="btn btn-danger" href="{{ url('mycart') }}"
                        style="background-color: #25e22b">Details</a>
                    {{--  <span class="float-right display-5 opacity-5"><i
                                class="fa fa-shopping-cart"></i></span>  --}}
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card gradient-2">
                <div class="card-body">
                    <h3 class="card-title text-white">Total Order</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">4</h2>
                        <p class="text-white mb-0">Jan - March 2019</p>
                    </div>
                    <a class="btn btn-danger" href="{{ url('myorders') }}"
                        style="background-color: #25e22b">Details</a>
                    {{--  <span class="float-right display-5 opacity-5"><i
                            class="fa fa-shopping-cart"></i></span>  --}}
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card gradient-3">
                <div class="card-body">
                    <h3 class="card-title text-white">Coupon</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">0</h2>
                        <p class="text-white mb-0">Jan - March 2019</p>
                    </div>
                    <a class="btn btn-danger" style="background-color: #25e22b">Details</a>
                    {{--  <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>  --}}
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card gradient-4">
                <div class="card-body" style="" href="/login">
                    <h3 class="card-title text-white"> Returns</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">99%</h2>
                        <p class="text-white mb-0">Jan - March 2019</p>

                    </div>
                    <a class="btn " style="background-color: #25e22b">Details</a>
                    {{--  <span class="float-right display-5 opacity-5"><i class="fa fa-heart"></i></span>  --}}
                </div>
            </div>
        </div>
    </div>

</div>