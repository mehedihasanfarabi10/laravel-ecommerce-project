<head>
    <!-- Slick CSS -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />

    <style>
        .product-box {
            border: 1px solid #ddd;
            border-radius: 5px;
            overflow: hidden;
            padding: 15px;
            background: #fff;
            transition: box-shadow 0.3s;
        }

        .product-box:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .img-box {
            position: relative;
        }

        .img-box img {
            width: 100%;
            height: auto;
        }

        .badge-danger {
            position: absolute;
            top: 10px;
            left: 10px;
            background: #db4566;
            color: #fff;
            padding: 5px 10px;
            font-size: 12px;
            border-radius: 3px;
        }

        .detail-box {
            text-align: center;
            margin-top: 10px;
        }

        .detail-box h6 {
            margin: 5px 0;
        }

        .product-image {
            width: 100%;
            height: 160px;
            /* Set a default height for all images */
            object-fit: cover;
            /* Ensures the image covers the space without distortion */
            object-position: center;
            /* Keeps the focus of the image centered */
        }

        .featured-products-carousel {
            margin: 20px 0;
        }

        .slick-slide {
            margin: 0 10px;
        }

        .slick-prev,
        .slick-next {
            background: #db4566;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            z-index: 1;
        }
    </style>
</head>

<section class="shop_section layout_padding">
    <div class="container">
        <!-- Latest Products -->
        @if ($latestProducts->isNotEmpty())
            <div class="heading_container heading_center" style="margin-top: 25px">
                <h2>Latest Products</h2>
            </div>
            <div class="row">
                @foreach ($latestProducts as $product)
                    <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                        <div class="product-box"
                            style="border: 1px solid #ddd; border-radius: 5px; overflow: hidden; transition: box-shadow 0.3s; padding: 15px; background: #fff;">
                            <a href="{{ url('product_details', $product->id) }}"
                                style="text-decoration: none; color: inherit;">
                                <div class="img-box text-center" style="position: relative;">
                                    <img src="products/{{ $product->image }}" alt="{{ $product->title }}"
                                        style="width: 100%; height: 200px;">

                                    <span class="badge badge-danger"
                                        style="position: absolute; top: 10px; left: 10px; background: #db4566; color: #fff; padding: 5px 10px; font-size: 12px; border-radius: 3px;">
                                        {{ $product->discount }}30% OFF
                                    </span>

                                </div>
                                <div class="detail-box mt-3" style="text-align: center;">
                                    <h6 style="font-size: 16px; font-weight: bold;">{{ $product->title }}</h6>
                                    <h6 style="font-size: 14px; color: #db4566;">
                                        <span
                                            style="text-decoration: line-through; color: #999;">$450{{ $product->original_price }}</span>
                                        <span>${{ $product->price }}</span>
                                    </h6>
                                </div>
                            </a>
                            <div class="text-center mt-3">
                                <a class="btn btn-sm btn-primary"
                                    style="background-color: #db4566; color: white; margin-right: 5px;"
                                    href="{{ url('product_details', $product->id) }}">
                                    View Product
                                </a>
                                <a class="btn btn-sm btn-success" style="background-color: #5ecdec; color: white;"
                                    href="{{ url('add_to_cart', $product->id) }}">
                                    Add to Cart
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Optionally, show a message if no products in latest products -->
            <div class="text-center" style="margin-top: 50px;">
                <p style="font-size: 18px; color: #999;">No latest products available at the moment.</p>
            </div>
        @endif



        <!-- Featured Products -->
        @if ($featuredProducts->isNotEmpty())
            <div class="heading_container heading_center" style="margin-top: 25px">
                <h2>Featured Products</h2>
            </div>
            <div id="main-content">
                <div class="row">
                    @foreach ($featuredProducts as $product)
                        <div class="featured-products-carousel col-sm-6 col-md-4 col-lg-3 mb-4">
                            <div class="product-box "
                                style="border: 1px solid #ddd; border-radius: 5px; overflow: hidden; transition: box-shadow 0.3s; padding: 15px; background: #fff;">
                                <a href="{{ url('product_details', $product->id) }}"
                                    style="text-decoration: none; color: inherit;">
                                    <div class="img-box text-center" style="position: relative;">
                                        <img src="products/{{ $product->image }}" alt="{{ $product->title }}"
                                            style="width: 100%; height: 200px;">

                                        <span class="badge badge-danger"
                                            style="position: absolute; top: 10px; left: 10px; background: #db4566; color: #fff; padding: 5px 10px; font-size: 12px; border-radius: 3px;">
                                            {{ $product->discount }}25% OFF
                                        </span>

                                    </div>
                                    <div class="detail-box mt-3" style="text-align: center;">
                                        <h6 style="font-size: 16px; font-weight: bold;">{{ $product->title }}</h6>
                                        <h6 style="font-size: 14px; color: #db4566;">
                                            <span
                                                style="text-decoration: line-through; color: #999;">$775{{ $product->original_price }}</span>
                                            <span>${{ $product->price }}</span>
                                        </h6>
                                    </div>
                                </a>
                                <div class="text-center mt-3">
                                    <a class="btn btn-sm btn-primary view-product-btn"
                                        style="background-color: #db4566; color: white; margin-right: 5px;"
                                        data-id="{{ $product->id }}">
                                        View Product
                                    </a>

                                    {{--  <a class="btn btn-sm btn-primary"
                                        style="background-color: #db4566; color: white; margin-right: 5px;"
                                        href="{{ url('product_details', $product->id) }}">
                                        View Product
                                    </a>  --}}
                                    <a class="btn btn-sm btn-success" style="background-color: #5ecdec; color: white;"
                                        href="{{ url('add_to_cart', $product->id) }}">
                                        Add to Cart
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Women's Collection -->
        @if ($womensCollection->isNotEmpty())
            <div class="heading_container heading_center" style="margin-top: 25px">
                <h2>Women's Collection</h2>
            </div>
            <div class="row">
                @foreach ($womensCollection as $product)
                    <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                        <div class="product-box"
                            style="border: 1px solid #ddd; border-radius: 5px; overflow: hidden; transition: box-shadow 0.3s; padding: 15px; background: #fff;">
                            <a href="{{ url('product_details', $product->id) }}"
                                style="text-decoration: none; color: inherit;">
                                <div class="img-box text-center" style="position: relative;">
                                    <img src="products/{{ $product->image }}" alt="{{ $product->title }}"
                                        style="width: 100%; height: 200px;">
                                    @if ($product->discount)
                                        <span class="badge badge-danger"
                                            style="position: absolute; top: 10px; left: 10px; background: #db4566; color: #fff; padding: 5px 10px; font-size: 12px; border-radius: 3px;">
                                            {{ $product->discount }}20% OFF
                                        </span>
                                    @endif
                                </div>
                                <div class="detail-box mt-3" style="text-align: center;">
                                    <h6 style="font-size: 16px; font-weight: bold;">{{ $product->title }}</h6>
                                    <h6 style="font-size: 14px; color: #db4566;">
                                        <span
                                            style="text-decoration: line-through; color: #999;">${{ $product->original_price }}</span>
                                        <span>${{ $product->price }}</span>
                                    </h6>
                                </div>
                            </a>
                            <div class="text-center mt-3">
                                <a class="btn btn-sm btn-primary view-product-btn"
                                    style="background-color: #db4566; color: white; margin-right: 5px;"
                                    data-id="{{ $product->id }}">
                                    View Product
                                </a>

                                {{--  <a class="btn btn-sm btn-primary"
                                    style="background-color: #db4566; color: white; margin-right: 5px;"
                                    href="{{ url('product_details', $product->id) }}">
                                    View Product
                                </a>  --}}
                                <a class="btn btn-sm btn-success" style="background-color: #5ecdec; color: white;"
                                    href="{{ url('add_to_cart', $product->id) }}">
                                    Add to Cart
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Optionally, show a message if no products in women's collection -->
            <div class="text-center" style="margin-top: 50px;">
                <p style="font-size: 18px; color: #999;">No women's collection available at the moment.</p>
            </div>
        @endif




        <!-- Hot Deals -->
        {{-- Logic set visibe and Non visible  --}}


        <!-- Hot Deals -->
        @if ($hotDeals->isNotEmpty())
            <div class="heading_container heading_center" style="margin-top: 25px">
                <h2>Hot Deals</h2>
            </div>

            <div id="main-content" direction="row">
                <div class="row">
                    @foreach ($hotDeals as $product)
                        <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                            <div class="product-box"
                                style="border: 1px solid #ddd; border-radius: 5px; overflow: hidden; transition: box-shadow 0.3s; padding: 15px; background: #fff;">
                                <a href="{{ url('product_details', $product->id) }}"
                                    style="text-decoration: none; color: inherit;">
                                    <div class="img-box text-center" style="position: relative;">
                                        <img src="products/{{ $product->image }}" alt="{{ $product->title }}"
                                            style="width: 100%; height: 200px;">
                                        @if ($product->discount)
                                            <span class="badge badge-danger"
                                                style="position: absolute; top: 10px; left: 10px; background: #db4566; color: #fff; padding: 5px 10px; font-size: 12px; border-radius: 3px;">
                                                {{ $product->discount }}% OFF
                                            </span>
                                        @endif
                                    </div>
                                    <div class="detail-box mt-3" style="text-align: center;">
                                        <h6 style="font-size: 16px; font-weight: bold;">{{ $product->title }}</h6>
                                        <h6 style="font-size: 14px; color: #db4566;">
                                            <span
                                                style="text-decoration: line-through; color: #999;">$750{{ $product->original_price }}</span>
                                            <span>${{ $product->price }}</span>
                                        </h6>
                                    </div>
                                </a>
                                <div class="text-center mt-3">
                                    {{--  <a class="btn btn-sm btn-primary"
                                style="background-color: #db4566; color: white; margin-right: 5px;"
                                href="{{ url('product_details', $product->id) }}">
                                View Product
                            </a>  --}}
                                    <a class="btn btn-sm btn-primary view-product-btn"
                                        style="background-color: #db4566; color: white; margin-right: 5px;"
                                        data-id="{{ $product->id }}">
                                        View Product
                                    </a>

                                    <a class="btn btn-sm btn-success" style="background-color: #5ecdec; color: white;"
                                        href="{{ url('add_to_cart', $product->id) }}">
                                        Add to Cart
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <!-- Optional message -->
            <div class="text-center" style="margin-top: 50px;">
                <p style="font-size: 18px; color: #999;">No hot deals available at the moment.</p>
            </div>
        @endif

    </div>
</section>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Slick JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

    <script>
    $(document).on('click', '.view-product-btn', function(e) {
        e.preventDefault();
        const productId = $(this).data('id');

        $.ajax({
            url: `/product_details/${productId}`, // Adjust route as needed
            type: 'GET',
            success: function(response) {
                // Assuming the server returns a partial HTML view
                $('#main-content').html(
                    response); // Replace #main-content with your target container

                // Update the browser URL
                history.pushState(null, '', `/product_details/${productId}`);
            },
            error: function(xhr) {
                console.error('Error fetching product details:', xhr.responseText);
                alert('Unable to load product details. Please try again.');
            }
        });
    });

    // Handle browser back/forward navigation
    $(window).on('popstate', function() {
        location.reload(); // Reload the page to handle the new URL state
    });
</script>

    {{--  <script>
        $(document).on('click','view-details-button',function(e){
            e.preventDefault();

            const url = $(this).data('id');
            $.ajax({
                url:`/product_details/${url}`,
                type:'GET',
                success:function(response){
                    $('#main-content').html(response);

                    history.pushState(null,'',`/product_details/${url}`);
                },
                error:function(xhr){
                    console.error('Error fetching product details:', xhr.responseText);
                alert('Unable to load product details. Please try again.');
                }
            })
        })

        $(window).on('popstate',function(){
            location.reload();
        })
    </script>  --}}
