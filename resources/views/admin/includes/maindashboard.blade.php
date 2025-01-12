<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .page-content {
            width: 100%;
            margin: 0;
            padding: 20px;
            background-color: #ffffff;
        }

        .container-fluid {
            padding: 0;
        }

        .row {
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="page-content" id="main-content">
        <section class="no-padding-top no-padding-bottom">
            <div class="container-fluid">
                <div class="row">
                    <!-- User -->
                    <div class="col-md-3 col-sm-6">
                        <div class="statistic-block block">
                            <div class="progress-details d-flex align-items-end justify-content-between">
                                <div class="title">
                                    <div class="icon"><i class="icon-user-1"></i></div><strong>Total Clients</strong>
                                </div>
                                <div class="number dashtext-1">{{ $user }}</div>
                            </div>
                            <div class="progress progress-template">
                                <div role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0"
                                    aria-valuemax="100" class="progress-bar progress-bar-template dashbg-1"></div>
                            </div>
                            <div class="" style="padding: 7px;">
                                <button class="btn btn-success ajax-link" data-url="{{ route('users.details') }}"
                                    data-title="User Details">
                                    User Details
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- Seller -->
                    <div class="col-md-3 col-sm-6">
                        <div class="statistic-block block">
                            <div class="progress-details d-flex align-items-end justify-content-between">
                                <div class="title">
                                    <div class="icon"><i class="icon-writing-whiteboard"></i></div><strong>All
                                        Sellers</strong>
                                </div>
                                <div class="number dashtext-4">{{ $seller }}</div>
                            </div>
                            <div class="progress progress-template">
                                <div role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0"
                                    aria-valuemax="100" class="progress-bar progress-bar-template dashbg-4"></div>
                            </div>
                            <div class="" style="padding: 7px;">
                                <button class="btn btn-danger ajax-link" data-url="{{ route('seller.details') }}"
                                    data-title="Seller Details">
                                    Seller Details
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- Products -->
                    <div class="col-md-3 col-sm-6">
                        <div class="statistic-block block">
                            <div class="progress-details d-flex align-items-end justify-content-between">
                                <div class="title">
                                    <div class="icon"><i class="icon-contract"></i></div><strong>Total
                                        Products</strong>
                                </div>
                                <div class="number dashtext-2">{{ $product }}</div>
                            </div>
                            <div class="progress progress-template">
                                <div role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0"
                                    aria-valuemax="100" class="progress-bar progress-bar-template dashbg-2"></div>
                            </div>
                        </div>
                    </div>
                    <!-- Orders -->
                    <div class="col-md-3 col-sm-6">
                        <div class="statistic-block block">
                            <div class="progress-details d-flex align-items-end justify-content-between">
                                <div class="title">
                                    <div class="icon"><i class="icon-paper-and-pencil"></i></div><strong>New
                                        Total Order</strong>
                                </div>
                                <div class="number dashtext-3">{{ $order }}</div>
                            </div>
                            <div class="progress progress-template">
                                <div role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0"
                                    aria-valuemax="100" class="progress-bar progress-bar-template dashbg-3"></div>
                            </div>
                        </div>
                    </div>
                    <!-- Delivered -->
                    <div class="col-md-3 col-sm-6">
                        <div class="statistic-block block">
                            <div class="progress-details d-flex align-items-end justify-content-between">
                                <div class="title">
                                    <div class="icon"><i class="icon-writing-whiteboard"></i></div><strong>All
                                        Delivered</strong>
                                </div>
                                <div class="number dashtext-4">{{ $delivered }}</div>
                            </div>
                            <div class="progress progress-template">
                                <div role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0"
                                    aria-valuemax="100" class="progress-bar progress-bar-template dashbg-4"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        $(document).ready(function() {
            $('.ajax-link').on('click', function(e) {
                e.preventDefault();

                let url = $(this).data('url');
                let title = $(this).data('title');

                // Update the browser URL
                history.pushState(null, title, url);

                // Fetch content dynamically
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(data) {
                        $('#main-content').html(data); // Replace main content
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
                        $('#main-content').html(data);
                    },
                    error: function() {
                        alert('Failed to load data. Please try again.');
                    }
                });
            };
        });
    </script>
</body>

</html>
