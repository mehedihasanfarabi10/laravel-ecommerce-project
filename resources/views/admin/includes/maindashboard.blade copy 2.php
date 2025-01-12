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
            padding: 0;
            background-color: #fff;
        }

        .container-fluid {
            padding: 0;
        }

        .row {
            width: 100%;
        }

        .dynamic-content {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="page-content">
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
                            <button class="btn btn-success" id="user-details-btn">User Details</button>
                        </div>
                    </div>
                </div>
                <!-- Seller -->
                <div class="col-md-3 col-sm-6">
                    <div class="statistic-block block">
                        <div class="progress-details d-flex align-items-end justify-content-between">
                            <div class="title">
                                <div class="icon"><i class="icon-writing-whiteboard"></i></div><strong>All Sellers</strong>
                            </div>
                            <div class="number dashtext-4">{{ $seller }}</div>
                        </div>
                        <div class="progress progress-template">
                            <div role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0"
                                 aria-valuemax="100" class="progress-bar progress-bar-template dashbg-4"></div>
                        </div>
                        <div class="" style="padding: 7px;">
                            <button class="btn btn-danger" id="seller-details-btn">Seller Details</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dynamic-content" id="dynamic-content">
                <!-- Dynamic content will be loaded here -->
            </div>
        </div>
    </section>
</div>

<script>
    $(document).ready(function () {
        // Load User Details dynamically
        $('#user-details-btn').on('click', function () {
            $.ajax({
                url: '{{ route("users.details") }}',
                type: 'GET',
                success: function (data) {
                    $('#dynamic-content').html(data);
                },
                error: function () {
                    alert('Failed to load User Details.');
                }
            });
        });

        // Load Seller Details dynamically
        $('#seller-details-btn').on('click', function () {
            $.ajax({
                url: '{{ route("seller.details") }}',
                type: 'GET',
                success: function (data) {
                    $('#dynamic-content').html(data);
                },
                error: function () {
                    alert('Failed to load Seller Details.');
                }
            });
        });
    });
</script>
</body>
</html>
