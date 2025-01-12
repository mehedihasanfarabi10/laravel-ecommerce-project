<!DOCTYPE html>
<html lang="en">

<head>
    {{-- Include common head content --}}
    @include('home.partials.head')
    <style>
        .carousel_section {
            width: 80%;
            height: 200px;
            /* Adjust the height to your preference */
            overflow: hidden;
            position: relative;
            justify-content: center;
            align-items: center;
        }

        .carousel-inner {
            width: 100%;
            height: 100%;
        }

        .carousel-item {
            height: 80%;
        }

        .banner-image {
            width: 80%;
            height: 100%;
            position: relative;
            justify-content: center;
            align-items: center;
            object-fit: cover;
            /* Ensures the image covers the entire space without stretching */
        }

        .carousel-control-prev,
        .carousel-control-next {
            background-color: rgba(0, 0, 0, 0.5);
            /* Semi-transparent background for controls */
            border-radius: 30%;
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: white;
            /* White color for the navigation icons */
        }

        /* Optional: Adding shadow to make the carousel stand out */
        .carousel-inner {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    {{--  <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}" />  --}}
    <link rel="stylesheet"
        href="https://cdn.ckeditor.com/ckeditor5-premium-features/43.0.0/ckeditor5-premium-features.css" />
</head>

<body>
    <div class="hero_area">
        {{-- Header Section --}}
        @include('home.partials.header')
        {{--  {!! Flasher\Support\Laravel\Facade\Flasher::render() !!}  --}}



        {{-- Slider Section --}}
        @yield('slider')
        {{-- Slider Section --}}
        @yield('slider-carousel')
    </div>

    {{-- Main Content Section --}}




    <div class="main-content" id="main-content">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @yield('content')
    </div>

    {{-- Footer Section --}}
    @include('home.partials.footer')

    @yield('script')

    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    {{--  CKE Editor  --}}
    {{--  <script src="https://cdn.ckeditor.com/ckeditor5/43.0.0/ckeditor5.umd.js"></script>  --}}

    {{-- Ckeditor --}}
    <script src="{{ asset('ckeditor5/ckeditor.js') }}"></script>

    {{-- JS Scripts --}}
    <!-- Include Select2 JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    {{--  <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>  --}}

    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <!-- Add Bootstrap JS (if not already included) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


    {{--  CKE Script  --}}

</body>

</html>
