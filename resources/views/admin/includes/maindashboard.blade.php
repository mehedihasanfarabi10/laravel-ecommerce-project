<style>
    .page-content {
        width: 100%;
        margin: 0;
        padding: 0;
        background-color: #fff;
    }

    .container-fluid {
        padding: 0;
        /* Remove default padding */
    }

    .row {
        width: 100%;
        /* Ensure row stretches fully */
    }
</style>


<div class="page-content">
    {{-- <div class="page-header">
        <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">Dashboard</h2>
        </div>
    </div>  --}}


    <section class="no-padding-top no-padding-bottom">
        <div class="container-fluid">
            <div class="row">
                <!-- User -->
                <div class="col-md-3 col-sm-6">
                    <div class="statistic-block block">
                        <div class="progress-details d-flex align-items-end justify-content-between">
                            <div class="title">
                                <div class="icon"><i class="icon-user-1"></i></div><strong>Total
                                    Clients</strong>
                            </div>
                            <div class="number dashtext-1">{{ $user }}</div>
                        </div>
                        <div class="progress progress-template">
                            <div role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0"
                                aria-valuemax="100" class="progress-bar progress-bar-template dashbg-1"></div>
                        </div>
                        <div class="" style="padding: 7px;">
                            <a href="{{route('users.details')}}" class="btn btn-success">User Details</a>

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
                <!-- Seller -->
                <div class="col-md-3 col-sm-6">
                    <div class="statistic-block block">
                        <div class="progress-details d-flex align-items-end justify-content-between">
                            <div class="title">
                                <div class="icon"><i class="icon-writing-whiteboard"></i></div><strong>All
                                    Seller</strong>
                            </div>
                            <div class="number dashtext-4">{{ $seller }}</div>
                        </div>

                        <div class="progress progress-template">
                            <div role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0"
                                aria-valuemax="100" class="progress-bar progress-bar-template dashbg-4"></div>

                        </div>
                        <div class="" style="padding: 7px;">
                            <a href="{{route('seller.details')}}" class="btn btn-danger">Seller Details</a>

                        </div>

                    </div>

                </div>

            </div>
        </div>
    </section>


</div>