@extends('home.layouts.app')

@section('content')
    {{-- Testimonial  --}}


    <!-- client section -->
    <section class="client_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>Testimonial</h2>
            </div>
        </div>
        <div class="container px-0">
            <div id="customCarousel2" class="carousel  carousel-fade" data-ride="carousel">
                <div class="carousel-inner">

                    <div class="carousel-item active">
                        <div class="box">
                            <div class="client_info">
                                <div class="client_name">
                                    <h5>Sarah Johnson</h5>
                                </div>
                                <i class="fa fa-quote-left" aria-hidden="true"></i>
                            </div>
                            <p>
                                "Amazing shopping experience! The website is user-friendly, and the customer support
                                team is very responsive. Highly recommend for quality products at great prices!"
                            </p>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <div class="box">
                            <div class="client_info">
                                <div class="client_name">
                                    <h5>David Martinez</h5>
                                </div>
                                <i class="fa fa-quote-left" aria-hidden="true"></i>
                            </div>
                            <p>
                                "Fast shipping and excellent product quality. I was pleasantly surprised by the seamless
                                checkout process. Definitely coming back for more!"
                            </p>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <div class="box">
                            <div class="client_info">
                                <div class="client_name">
                                    <h5>Emily Carter</h5>
                                </div>
                                <i class="fa fa-quote-left" aria-hidden="true"></i>
                            </div>
                            <p>
                                "This is my go-to online store! The variety of products and competitive pricing keep me
                                coming back. Five stars for customer service too!"
                            </p>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <div class="box">
                            <div class="client_info">
                                <div class="client_name">
                                    <h5>James Smith</h5>
                                </div>
                                <i class="fa fa-quote-left" aria-hidden="true"></i>
                            </div>
                            <p>
                                "I love how easy it is to find what I need. The product descriptions are clear, and the
                                delivery is always on time. A trustworthy eCommerce platform!"
                            </p>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <div class="box">
                            <div class="client_info">
                                <div class="client_name">
                                    <h5>Laura Adams</h5>
                                </div>
                                <i class="fa fa-quote-left" aria-hidden="true"></i>
                            </div>
                            <p>
                                "The quality exceeded my expectations. Shopping here is always a pleasure due to the
                                well-organized categories and helpful customer reviews."
                            </p>
                        </div>
                    </div>

                </div>
                <div class="carousel_btn-box">
                    <a class="carousel-control-prev" href="#customCarousel2" role="button" data-slide="prev">
                        <i class="fa fa-angle-left" aria-hidden="true"></i>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#customCarousel2" role="button" data-slide="next">
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- end client section -->
@endsection
