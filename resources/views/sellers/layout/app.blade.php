<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <!-- theme meta -->
    <meta name="theme-name" content="quixlab" />

    <title>Quixlab - Bootstrap Admin Dashboard Template by Themefisher.com</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('sellers/images/favicon.png') }}">
    <!-- Pignose Calender -->
    <link href="{{ asset('sellers/plugins/pg-calendar/css/pignose.calendar.min.css') }}" rel="stylesheet">
    <!-- Chartist -->
    <link rel="stylesheet" href="{{ asset('sellers/plugins/chartist/css/chartist.min.css') }}">
    <link rel="stylesheet" href="{{ asset('sellers/plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Custom Stylesheet -->
    <link href="{{ asset('sellers/css/style.css') }}" rel="stylesheet">
</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3"
                    stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        @include('sellers.partials.navheader')
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        @include('sellers.partials.header')
        <!--**********************************
            Header end
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        @include('sellers.partials.sidebar')
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        {{--  @include('sellers.partials.body')  --}}
        <!--**********************************
            Content body end
        ***********************************-->
        <!--**********************************
            Main Content start
        ***********************************-->
        @yield('content')
        <!--**********************************
            Main Content end
        ***********************************-->


        <!--**********************************
            Footer start
        ***********************************-->
        @include('sellers.partials.footer')
        <!--**********************************
            Footer end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="{{ asset('sellers/plugins/common/common.min.js') }}"></script>
    <script src="{{ asset('sellers/js/custom.min.js') }}"></script>
    <script src="{{ asset('sellers/js/settings.js') }}"></script>
    <script src="{{ asset('sellers/js/gleek.js') }}"></script>
    <script src="{{ asset('sellers/js/styleSwitcher.js') }}"></script>

    <!-- Chartjs -->
    <script src="{{ asset('sellers/plugins/chart.js/Chart.bundle.min.js') }}"></script>
    <!-- Circle progress -->
    <script src="{{ asset('sellers/plugins/circle-progress/circle-progress.min.js') }}"></script>
    <!-- Datamap -->
    <script src="{{ asset('sellers/plugins/d3v3/index.js') }}"></script>
    <script src="{{ asset('sellers/plugins/topojson/topojson.min.js') }}"></script>
    <script src="{{ asset('sellers/plugins/datamaps/datamaps.world.min.js') }}"></script>
    <!-- Morrisjs -->
    <script src="{{ asset('sellers/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('sellers/plugins/morris/morris.min.js') }}"></script>
    <!-- Pignose Calender -->
    <script src="{{ asset('sellers/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('sellers/plugins/pg-calendar/js/pignose.calendar.min.js') }}"></script>
    <!-- ChartistJS -->
    <script src="{{ asset('sellers/plugins/chartist/js/chartist.min.js') }}"></script>
    <script src="{{ asset('sellers/plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js') }}"></script>

    <script src="{{ asset('sellers/js/dashboard/dashboard-1.js') }}"></script>

</body>

</html>
