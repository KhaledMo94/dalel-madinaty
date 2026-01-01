<x-dashboard.main-layout>

    <div class="row">
        <div class="mb-2 col-xl-12 col-md-12">
            <h1 class="mb-4 text-gray-800 h3">{{ __('Dashboard') }}</h1>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row">
        <!-- Total Users Card -->
        <div class="mb-4 col-xl-3 col-md-6">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                {{ __('Total Users') }}
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($totalUsers) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    @if($recentUsers > 0)
                    <div class="mt-2 text-xs text-muted">
                        <i class="fas fa-arrow-up text-success"></i> {{ $recentUsers }} {{ __('new in last 30 days') }}
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Total Listings Card -->
        <div class="mb-4 col-xl-3 col-md-6">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                {{ __('Total Listings') }}
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($totalListings) }}</div>
                            <div class="text-xs text-muted mt-1">
                                {{ number_format($totalBranches) }} {{ __('Branches') }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    @if($recentListings > 0)
                    <div class="mt-2 text-xs text-muted">
                        <i class="fas fa-arrow-up text-success"></i> {{ $recentListings }} {{ __('new in last 30 days') }}
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Total Offers Card -->
        <div class="mb-4 col-xl-3 col-md-6">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                {{ __('Total Offers') }}
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($totalOffers) }}</div>
                            <div class="text-xs text-muted mt-1">
                                <span class="text-success">{{ number_format($activeOffers) }} {{ __('Active') }}</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-gift fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    @if($recentOffers > 0)
                    <div class="mt-2 text-xs text-muted">
                        <i class="fas fa-arrow-up text-success"></i> {{ $recentOffers }} {{ __('new in last 30 days') }}
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Categories Card -->
        <div class="mb-4 col-xl-3 col-md-6">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                {{ __('Categories') }}
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($totalCategories) }}</div>
                            <div class="text-xs text-muted mt-1">
                                {{ number_format($totalMainCategories) }} {{ __('Main Categories') }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-folder fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Second Row Statistics -->
    <div class="row">
        <!-- Ratings Card -->
        <div class="mb-4 col-xl-3 col-md-6">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                {{ __('Ratings') }}
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($totalRatings) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-star fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Comments Card -->
        <div class="mb-4 col-xl-3 col-md-6">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                {{ __('Comments') }}
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($totalComments) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Banners Card -->
        <div class="mb-4 col-xl-3 col-md-6">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                {{ __('Banners') }}
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($totalBanners) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-image fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Monthly Growth Card -->
        <div class="mb-4 col-xl-3 col-md-6">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                {{ __('This Month') }}
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ number_format($thisMonthUsers) }} {{ __('Users') }}
                            </div>
                            <div class="text-xs text-muted mt-1">
                                {{ number_format($thisMonthListings) }} {{ __('Listings') }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chart-line fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    @if($userGrowth != 0)
                    <div class="mt-2 text-xs">
                        @if($userGrowth > 0)
                            <span class="text-success"><i class="fas fa-arrow-up"></i> {{ abs($userGrowth) }}% {{ __('growth') }}</span>
                        @else
                            <span class="text-danger"><i class="fas fa-arrow-down"></i> {{ abs($userGrowth) }}% {{ __('decrease') }}</span>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="row mt-4">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">{{ __('Activity Overview - Last 6 Months') }}</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="activityChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .border-left-primary {
            border-left: 0.25rem solid #4e73df !important;
        }
        .border-left-success {
            border-left: 0.25rem solid #1cc88a !important;
        }
        .border-left-info {
            border-left: 0.25rem solid #36b9cc !important;
        }
        .border-left-warning {
            border-left: 0.25rem solid #f6c23e !important;
        }
        .chart-area {
            position: relative;
            height: 350px;
            width: 100%;
        }
    </style>

    <!-- Chart.js -->
    <script src="{{ asset('backend/vendor/chart.js/Chart.min.js') }}"></script>
    <script>
        // Chart data
        const chartLabels = @json($chartLabels);
        const chartUsersData = @json($chartUsersData);
        const chartListingsData = @json($chartListingsData);
        const chartOffersData = @json($chartOffersData);

        // Area Chart
        const ctx = document.getElementById("activityChart");
        const activityChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: chartLabels,
                datasets: [
                    {
                        label: "{{ __('Users') }}",
                        lineTension: 0.3,
                        backgroundColor: "rgba(78, 115, 223, 0.05)",
                        borderColor: "rgba(78, 115, 223, 1)",
                        pointRadius: 3,
                        pointBackgroundColor: "rgba(78, 115, 223, 1)",
                        pointBorderColor: "rgba(78, 115, 223, 1)",
                        pointHoverRadius: 3,
                        pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                        pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                        pointHitRadius: 10,
                        pointBorderWidth: 2,
                        data: chartUsersData,
                    },
                    {
                        label: "{{ __('Listings') }}",
                        lineTension: 0.3,
                        backgroundColor: "rgba(28, 200, 138, 0.05)",
                        borderColor: "rgba(28, 200, 138, 1)",
                        pointRadius: 3,
                        pointBackgroundColor: "rgba(28, 200, 138, 1)",
                        pointBorderColor: "rgba(28, 200, 138, 1)",
                        pointHoverRadius: 3,
                        pointHoverBackgroundColor: "rgba(28, 200, 138, 1)",
                        pointHoverBorderColor: "rgba(28, 200, 138, 1)",
                        pointHitRadius: 10,
                        pointBorderWidth: 2,
                        data: chartListingsData,
                    },
                    {
                        label: "{{ __('Offers') }}",
                        lineTension: 0.3,
                        backgroundColor: "rgba(54, 185, 204, 0.05)",
                        borderColor: "rgba(54, 185, 204, 1)",
                        pointRadius: 3,
                        pointBackgroundColor: "rgba(54, 185, 204, 1)",
                        pointBorderColor: "rgba(54, 185, 204, 1)",
                        pointHoverRadius: 3,
                        pointHoverBackgroundColor: "rgba(54, 185, 204, 1)",
                        pointHoverBorderColor: "rgba(54, 185, 204, 1)",
                        pointHitRadius: 10,
                        pointBorderWidth: 2,
                        data: chartOffersData,
                    }
                ],
            },
            options: {
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                    }
                },
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'month'
                        },
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            maxTicksLimit: 6
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            min: 0,
                            maxTicksLimit: 5,
                            padding: 10,
                            callback: function(value, index, values) {
                                return value;
                            }
                        },
                        gridLines: {
                            color: "rgb(234, 236, 244)",
                            zeroLineColor: "rgb(234, 236, 244)",
                            drawBorder: false,
                            borderDash: [2],
                            zeroLineBorderDash: [2]
                        }
                    }],
                },
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        usePointStyle: true,
                        padding: 15
                    }
                },
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    titleMarginBottom: 10,
                    titleFontColor: '#6e707e',
                    titleFontSize: 14,
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: true,
                    intersect: false,
                    mode: 'index',
                    caretPadding: 10,
                }
            }
        });
    </script>

</x-dashboard.main-layout>
