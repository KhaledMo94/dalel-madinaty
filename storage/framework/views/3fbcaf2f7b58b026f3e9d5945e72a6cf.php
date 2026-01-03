<?php if (isset($component)) { $__componentOriginal5be5918a4b8edd99a309dbd2815ca889 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5be5918a4b8edd99a309dbd2815ca889 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dashboard.main-layout','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dashboard.main-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>

    <div class="row">
        <div class="mb-2 col-xl-12 col-md-12">
            <h1 class="mb-4 text-gray-800 h3"><?php echo e(__('Dashboard')); ?></h1>
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
                                <?php echo e(__('Total Users')); ?>

                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e(number_format($totalUsers)); ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <?php if($recentUsers > 0): ?>
                    <div class="mt-2 text-xs text-muted">
                        <i class="fas fa-arrow-up text-success"></i> <?php echo e($recentUsers); ?> <?php echo e(__('new in last 30 days')); ?>

                    </div>
                    <?php endif; ?>
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
                                <?php echo e(__('Total Listings')); ?>

                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e(number_format($totalListings)); ?></div>
                            <div class="text-xs text-muted mt-1">
                                <?php echo e(number_format($totalBranches)); ?> <?php echo e(__('Branches')); ?>

                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <?php if($recentListings > 0): ?>
                    <div class="mt-2 text-xs text-muted">
                        <i class="fas fa-arrow-up text-success"></i> <?php echo e($recentListings); ?> <?php echo e(__('new in last 30 days')); ?>

                    </div>
                    <?php endif; ?>
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
                                <?php echo e(__('Total Offers')); ?>

                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e(number_format($totalOffers)); ?></div>
                            <div class="text-xs text-muted mt-1">
                                <span class="text-success"><?php echo e(number_format($activeOffers)); ?> <?php echo e(__('Active')); ?></span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-gift fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <?php if($recentOffers > 0): ?>
                    <div class="mt-2 text-xs text-muted">
                        <i class="fas fa-arrow-up text-success"></i> <?php echo e($recentOffers); ?> <?php echo e(__('new in last 30 days')); ?>

                    </div>
                    <?php endif; ?>
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
                                <?php echo e(__('Categories')); ?>

                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e(number_format($totalCategories)); ?></div>
                            <div class="text-xs text-muted mt-1">
                                <?php echo e(number_format($totalMainCategories)); ?> <?php echo e(__('Main Categories')); ?>

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
                                <?php echo e(__('Ratings')); ?>

                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e(number_format($totalRatings)); ?></div>
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
                                <?php echo e(__('Comments')); ?>

                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e(number_format($totalComments)); ?></div>
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
                                <?php echo e(__('Banners')); ?>

                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e(number_format($totalBanners)); ?></div>
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
                                <?php echo e(__('This Month')); ?>

                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php echo e(number_format($thisMonthUsers)); ?> <?php echo e(__('Users')); ?>

                            </div>
                            <div class="text-xs text-muted mt-1">
                                <?php echo e(number_format($thisMonthListings)); ?> <?php echo e(__('Listings')); ?>

                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chart-line fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <?php if($userGrowth != 0): ?>
                    <div class="mt-2 text-xs">
                        <?php if($userGrowth > 0): ?>
                            <span class="text-success"><i class="fas fa-arrow-up"></i> <?php echo e(abs($userGrowth)); ?>% <?php echo e(__('growth')); ?></span>
                        <?php else: ?>
                            <span class="text-danger"><i class="fas fa-arrow-down"></i> <?php echo e(abs($userGrowth)); ?>% <?php echo e(__('decrease')); ?></span>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="row mt-4">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('Activity Overview - Last 6 Months')); ?></h6>
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
    <script src="<?php echo e(asset('backend/vendor/chart.js/Chart.min.js')); ?>"></script>
    <script>
        // Chart data
        const chartLabels = <?php echo json_encode($chartLabels, 15, 512) ?>;
        const chartUsersData = <?php echo json_encode($chartUsersData, 15, 512) ?>;
        const chartListingsData = <?php echo json_encode($chartListingsData, 15, 512) ?>;
        const chartOffersData = <?php echo json_encode($chartOffersData, 15, 512) ?>;

        // Area Chart
        const ctx = document.getElementById("activityChart");
        const activityChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: chartLabels,
                datasets: [
                    {
                        label: "<?php echo e(__('Users')); ?>",
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
                        label: "<?php echo e(__('Listings')); ?>",
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
                        label: "<?php echo e(__('Offers')); ?>",
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

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5be5918a4b8edd99a309dbd2815ca889)): ?>
<?php $attributes = $__attributesOriginal5be5918a4b8edd99a309dbd2815ca889; ?>
<?php unset($__attributesOriginal5be5918a4b8edd99a309dbd2815ca889); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5be5918a4b8edd99a309dbd2815ca889)): ?>
<?php $component = $__componentOriginal5be5918a4b8edd99a309dbd2815ca889; ?>
<?php unset($__componentOriginal5be5918a4b8edd99a309dbd2815ca889); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\dalel-madinaty\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>