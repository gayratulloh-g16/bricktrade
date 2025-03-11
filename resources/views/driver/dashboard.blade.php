<x-layouts.driver>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('driver.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-8">
                    <div class="row">

                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card sales-card">
                                <div class="filter">
                                    <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                            class="bi bi-three-dots"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li class="dropdown-header text-start">
                                            <h6>Filter</h6>
                                        </li>
                                        <li><a class="dropdown-item filter-option" href="#"
                                                data-filter="today">Today</a></li>
                                        <li><a class="dropdown-item filter-option" href="#"
                                                data-filter="this_month">This Month</a></li>
                                        <li><a class="dropdown-item filter-option" href="#"
                                                data-filter="this_year">This Year</a></li>
                                    </ul>

                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Sales <span id="salesPeriod">| Today</span></h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-cart"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>Orders: <span id="orderCount">0</span></h6>
                                            <span class="text-success small pt-1 fw-bold" id="salesPercent">0%</span>
                                            <span class="text-muted small pt-2 ps-1" id="salesTrend">increase</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>


                        <!-- Revenue Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card sales-card">
                                <div class="filter">
                                    <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                            class="bi bi-three-dots"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li class="dropdown-header text-start">
                                            <h6>Filter</h6>
                                        </li>
                                        <li>
                                            <a class="dropdown-item filter-option" href="#"
                                                data-filter="today">Today</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item filter-option" href="#"
                                                data-filter="this_month">This Month</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item filter-option" href="#"
                                                data-filter="this_year">This Year</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">
                                        Revenue <span id="revenuePeriod">| This Month</span>
                                    </h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-currency-dollar"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h5 id="revenueAmount" style="color: coral"></h5>
                                            <span class="text-success small pt-1 fw-bold" id="revenuePercent">8%</span>
                                            <span class="text-muted small pt-2 ps-1" id="revenueTrend">increase</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Customers Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card sales-card">
                                <div class="filter">
                                    <a class="icon" href="#" data-bs-toggle="dropdown">
                                        <i class="bi bi-three-dots"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li class="dropdown-header text-start">
                                            <h6>Filter</h6>
                                        </li>
                                        <li>
                                            <a class="dropdown-item customer-filter-option" href="#"
                                                data-filter="today">Today</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item customer-filter-option" href="#"
                                                data-filter="this_month">This Month</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item customer-filter-option" href="#"
                                                data-filter="this_year">This Year</a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title">Customers <span id="customerPeriod">| This Year</span></h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-people"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6 id="customerCount">0</h6>
                                            <span class="text-success small pt-1 fw-bold" id="customerPercent">0%</span>
                                            <span class="text-muted small pt-2 ps-1"
                                                id="customerTrend">increase</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Reports Section -->
                        <div class="col-12">
                            <div class="card">
                                <!-- Filter Dropdown -->
                                <div class="filter">
                                    <a class="icon" href="#" data-bs-toggle="dropdown">
                                        <i class="bi bi-three-dots"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li class="dropdown-header text-start">
                                            <h6>Filter</h6>
                                        </li>
                                        <li>
                                            <a class="dropdown-item report-filter-option" href="#"
                                                data-filter="today">Today</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item report-filter-option" href="#"
                                                data-filter="this_month">This Month</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item report-filter-option" href="#"
                                                data-filter="this_year">This Year</a>
                                        </li>
                                    </ul>
                                </div>

                                <!-- Card Body -->
                                <div class="card-body">
                                    <h5 class="card-title">Reports <span id="reportPeriod">/ Today</span></h5>

                                    <!-- Line Chart Container -->
                                    <div id="reportsChart"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Include jQuery (if not already included) -->
                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                        <!-- Include ApexCharts -->
                        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

                        <script>
                            document.addEventListener("DOMContentLoaded", () => {

                                // Chart options with empty data (to be updated via AJAX)
                                let chartOptions = {
                                    series: [{
                                            name: 'Sales',
                                            data: []
                                        },
                                        {
                                            name: 'Revenue',
                                            data: []
                                        },
                                        {
                                            name: 'Customers',
                                            data: []
                                        }
                                    ],
                                    chart: {
                                        height: 350,
                                        type: 'area',
                                        toolbar: {
                                            show: false
                                        },
                                    },
                                    markers: {
                                        size: 4
                                    },
                                    colors: ['#4154f1', '#2eca6a', '#ff771d'],
                                    fill: {
                                        type: 'gradient',
                                        gradient: {
                                            shadeIntensity: 1,
                                            opacityFrom: 0.3,
                                            opacityTo: 0.4,
                                            stops: [0, 90, 100]
                                        }
                                    },
                                    dataLabels: {
                                        enabled: false
                                    },
                                    stroke: {
                                        curve: 'smooth',
                                        width: 2
                                    },
                                    xaxis: {
                                        type: 'datetime',
                                        categories: [] // to be filled dynamically
                                    },
                                    tooltip: {
                                        x: {
                                            format: 'dd/MM/yy HH:mm'
                                        }
                                    }
                                };

                                // Create the chart
                                let reportsChart = new ApexCharts(document.querySelector("#reportsChart"), chartOptions);
                                reportsChart.render();

                                // Function to fetch and update report data dynamically
                                function fetchReportData(filter) {
                                    $.ajax({
                                        url: "{{ route('reports.data') }}",
                                        method: "GET",
                                        data: {
                                            filter: filter
                                        },
                                        dataType: "json",
                                        success: function(response) {
                                            // Update x-axis categories
                                            reportsChart.updateOptions({
                                                xaxis: {
                                                    categories: response.labels
                                                }
                                            });
                                            // Update series data
                                            reportsChart.updateSeries([{
                                                    name: 'Sales',
                                                    data: response.salesData
                                                },
                                                {
                                                    name: 'Revenue',
                                                    data: response.revenueData
                                                },
                                                {
                                                    name: 'Customers',
                                                    data: response.customerData
                                                }
                                            ]);
                                            // Update filter text in the card title
                                            document.getElementById('reportPeriod').textContent = "/ " + response.period;
                                        },
                                        error: function(xhr) {
                                            console.error("Error fetching report data:", xhr.responseText);
                                        }
                                    });
                                }

                                // Attach click events to filter options
                                document.querySelectorAll('.report-filter-option').forEach(function(el) {
                                    el.addEventListener('click', function(e) {
                                        e.preventDefault();
                                        let filter = this.getAttribute('data-filter');
                                        fetchReportData(filter);
                                    });
                                });

                                // Initial data fetch with default filter "today"
                                fetchReportData('today');
                            });
                        </script>

                        <!-- Recent Sales -->
                        <div class="col-12">
                            <div class="card recent-sales overflow-auto">
                                <div class="filter">
                                    <a class="icon" href="#" data-bs-toggle="dropdown">
                                        <i class="bi bi-three-dots"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li class="dropdown-header text-start">
                                            <h6>Filter</h6>
                                        </li>
                                        <li>
                                            <a class="dropdown-item sales-filter-option" href="#"
                                                data-filter="today">Today</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item sales-filter-option" href="#"
                                                data-filter="this_month">This Month</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item sales-filter-option" href="#"
                                                data-filter="this_year">This Year</a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title">Recent Sales <span id="salesPeriod">| Today</span></h5>
                                    <!-- Container for the dynamic sales table -->
                                    <div id="recentSalesContainer">
                                        @include('partials.recent-sales', ['sales' => $sales])
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Top Selling -->
                        <div class="col-12">
                            <div class="card top-selling overflow-auto">
                                <div class="filter">
                                    <a class="icon" href="#" data-bs-toggle="dropdown">
                                        <i class="bi bi-three-dots"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li class="dropdown-header text-start">
                                            <h6>Filter</h6>
                                        </li>
                                        <li>
                                            <a class="dropdown-item top-selling-filter-option" href="#"
                                                data-filter="today">Today</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item top-selling-filter-option" href="#"
                                                data-filter="this_month">This Month</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item top-selling-filter-option" href="#"
                                                data-filter="this_year">This Year</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body pb-0">
                                    <h5 class="card-title">Top Selling <span id="topSellingPeriod">| Today</span></h5>
                                    <div id="topSellingContainer">
                                        {{-- Optionally, pass initial data if available. Otherwise, it will be loaded via AJAX. --}}
                                        @include('partials.top-selling', [
                                            'bricks' => $bricks ?? collect([]),
                                            'period' => 'Today',
                                        ])
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div><!-- End Left side columns -->

                <!-- Right side columns -->
                <div class="col-lg-4">

                    {{-- <!-- Recent Activity -->
                    <div class="card">
                        <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                    class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start">
                                    <h6>Filter</h6>
                                </li>

                                <li><a class="dropdown-item" href="#">Today</a></li>
                                <li><a class="dropdown-item" href="#">This Month</a></li>
                                <li><a class="dropdown-item" href="#">This Year</a></li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title">Recent Activity <span>| Today</span></h5>

                            <div class="activity">

                                <div class="activity-item d-flex">
                                    <div class="activite-label">32 min</div>
                                    <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                                    <div class="activity-content">
                                        Quia quae rerum <a href="#" class="fw-bold text-dark">explicabo
                                            officiis</a> beatae
                                    </div>
                                </div><!-- End activity item-->

                                <div class="activity-item d-flex">
                                    <div class="activite-label">56 min</div>
                                    <i class='bi bi-circle-fill activity-badge text-danger align-self-start'></i>
                                    <div class="activity-content">
                                        Voluptatem blanditiis blanditiis eveniet
                                    </div>
                                </div><!-- End activity item-->

                                <div class="activity-item d-flex">
                                    <div class="activite-label">2 hrs</div>
                                    <i class='bi bi-circle-fill activity-badge text-primary align-self-start'></i>
                                    <div class="activity-content">
                                        Voluptates corrupti molestias voluptatem
                                    </div>
                                </div><!-- End activity item-->

                                <div class="activity-item d-flex">
                                    <div class="activite-label">1 day</div>
                                    <i class='bi bi-circle-fill activity-badge text-info align-self-start'></i>
                                    <div class="activity-content">
                                        Tempore autem saepe <a href="#" class="fw-bold text-dark">occaecati
                                            voluptatem</a> tempore
                                    </div>
                                </div><!-- End activity item-->

                                <div class="activity-item d-flex">
                                    <div class="activite-label">2 days</div>
                                    <i class='bi bi-circle-fill activity-badge text-warning align-self-start'></i>
                                    <div class="activity-content">
                                        Est sit eum reiciendis exercitationem
                                    </div>
                                </div><!-- End activity item-->

                                <div class="activity-item d-flex">
                                    <div class="activite-label">4 weeks</div>
                                    <i class='bi bi-circle-fill activity-badge text-muted align-self-start'></i>
                                    <div class="activity-content">
                                        Dicta dolorem harum nulla eius. Ut quidem quidem sit quas
                                    </div>
                                </div><!-- End activity item-->

                            </div>

                        </div>
                    </div><!-- End Recent Activity -->

                    <!-- Budget Report -->
                    <div class="card">
                        <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                    class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start">
                                    <h6>Filter</h6>
                                </li>

                                <li><a class="dropdown-item" href="#">Today</a></li>
                                <li><a class="dropdown-item" href="#">This Month</a></li>
                                <li><a class="dropdown-item" href="#">This Year</a></li>
                            </ul>
                        </div>

                        <div class="card-body pb-0">
                            <h5 class="card-title">Budget Report <span>| This Month</span></h5>

                            <div id="budgetChart" style="min-height: 400px;" class="echart"></div>

                            <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                    var budgetChart = echarts.init(document.querySelector("#budgetChart")).setOption({
                                        legend: {
                                            data: ['Allocated Budget', 'Actual Spending']
                                        },
                                        radar: {
                                            // shape: 'circle',
                                            indicator: [{
                                                    name: 'Sales',
                                                    max: 6500
                                                },
                                                {
                                                    name: 'Administration',
                                                    max: 16000
                                                },
                                                {
                                                    name: 'Information Technology',
                                                    max: 30000
                                                },
                                                {
                                                    name: 'Customer Support',
                                                    max: 38000
                                                },
                                                {
                                                    name: 'Development',
                                                    max: 52000
                                                },
                                                {
                                                    name: 'Marketing',
                                                    max: 25000
                                                }
                                            ]
                                        },
                                        series: [{
                                            name: 'Budget vs spending',
                                            type: 'radar',
                                            data: [{
                                                    value: [4200, 3000, 20000, 35000, 50000, 18000],
                                                    name: 'Allocated Budget'
                                                },
                                                {
                                                    value: [5000, 14000, 28000, 26000, 42000, 21000],
                                                    name: 'Actual Spending'
                                                }
                                            ]
                                        }]
                                    });
                                });
                            </script>

                        </div>
                    </div><!-- End Budget Report -->

                    <!-- Website Traffic -->
                    <div class="card">
                        <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                    class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start">
                                    <h6>Filter</h6>
                                </li>

                                <li><a class="dropdown-item" href="#">Today</a></li>
                                <li><a class="dropdown-item" href="#">This Month</a></li>
                                <li><a class="dropdown-item" href="#">This Year</a></li>
                            </ul>
                        </div>

                        <div class="card-body pb-0">
                            <h5 class="card-title">Website Traffic <span>| Today</span></h5>

                            <div id="trafficChart" style="min-height: 400px;" class="echart"></div>

                            <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                    echarts.init(document.querySelector("#trafficChart")).setOption({
                                        tooltip: {
                                            trigger: 'item'
                                        },
                                        legend: {
                                            top: '5%',
                                            left: 'center'
                                        },
                                        series: [{
                                            name: 'Access From',
                                            type: 'pie',
                                            radius: ['40%', '70%'],
                                            avoidLabelOverlap: false,
                                            label: {
                                                show: false,
                                                position: 'center'
                                            },
                                            emphasis: {
                                                label: {
                                                    show: true,
                                                    fontSize: '18',
                                                    fontWeight: 'bold'
                                                }
                                            },
                                            labelLine: {
                                                show: false
                                            },
                                            data: [{
                                                    value: 1048,
                                                    name: 'Search Engine'
                                                },
                                                {
                                                    value: 735,
                                                    name: 'Direct'
                                                },
                                                {
                                                    value: 580,
                                                    name: 'Email'
                                                },
                                                {
                                                    value: 484,
                                                    name: 'Union Ads'
                                                },
                                                {
                                                    value: 300,
                                                    name: 'Video Ads'
                                                }
                                            ]
                                        }]
                                    });
                                });
                            </script>

                        </div>
                    </div><!-- End Website Traffic --> --}}

                    <!-- News & Updates -->
                    <div class="col-12">
                        <div class="card recent-sales overflow-auto">
                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown">
                                    <i class="bi bi-three-dots"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>
                                    <li>
                                        <a class="dropdown-item news-filter-option" href="#"
                                            data-filter="today">Today</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item news-filter-option" href="#"
                                            data-filter="this_month">This Month</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item news-filter-option" href="#"
                                            data-filter="this_year">This Year</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body pb-0">
                                <h5 class="card-title">News & Updates <span id="newsPeriod">| Today</span></h5>
                                <!-- Container where the news posts will be loaded dynamically -->
                                <div class="news" id="newsContainer">
                                    @include('partials.news', ['blogs' => $blogs])
                                </div>
                            </div>
                        </div>
                    </div>


                </div><!-- End Right side columns -->

            </div>
        </section>

    </main><!-- End #main -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            // Function to fetch sales data with a given filter
            function fetchSalesData(filter) {
                $.ajax({
                    url: "{{ route('sales.data') }}",
                    method: "GET",
                    data: {
                        filter: filter
                    },
                    dataType: "json",
                    success: function(response) {
                        // Update your UI elements with the response data
                        $('#salesCount').text(response.sales + " So'm");
                        $('#orderCount').text(response.order_count);
                        $('#salesPercent').text(response.percent + "%");
                        $('#salesTrend').text(response.trend);
                        $('#salesPeriod').text("| " + response.period);
                    },
                    error: function(xhr) {
                        console.error("Error fetching sales data:", xhr.responseText);
                    }
                });
            }

            // Example: When clicking filter buttons (you need to add these in your HTML)
            $('.filter-option').on('click', function(e) {
                e.preventDefault();
                let filter = $(this).data('filter');
                fetchSalesData(filter);
            });

            // Initial fetch for default filter ("today")
            fetchSalesData('today');
        });

        $(document).ready(function() {

            // Function to fetch revenue data based on filter
            function fetchRevenueData(filter) {
                $.ajax({
                    url: "{{ route('sales.data') }}",
                    method: "GET",
                    data: {
                        filter: filter
                    },
                    dataType: "json",
                    success: function(response) {
                        // Update revenue card
                        $('#revenueAmount').text(response.sales + "So'm"); // sales holds revenue total
                        $('#revenuePercent').text(response.percent + "%");
                        $('#revenueTrend').text(response.trend);
                        $('#revenuePeriod').text("| " + response.period);
                    },
                    error: function(xhr) {
                        console.error("Error fetching revenue data:", xhr.responseText);
                    }
                });
            }

            // Filter option click handler
            $('.filter-option').on('click', function(e) {
                e.preventDefault();
                let filter = $(this).data('filter');
                fetchRevenueData(filter);
            });

            fetchRevenueData('this_month');

            setInterval(function() {
                let currentPeriod = $('#revenuePeriod').text().replace("| ", "");
                fetchRevenueData(currentPeriod.toLowerCase());
            }, 30000);
        });

        $(document).ready(function() {

            // Function to fetch customer data based on the selected filter
            function fetchCustomerData(filter) {
                $.ajax({
                    url: "{{ route('customers.data') }}",
                    method: "GET",
                    data: {
                        filter: filter
                    },
                    dataType: "json",
                    success: function(response) {
                        // Update UI elements with the response data
                        $('#customerCount').text(response.count);
                        $('#customerPercent').text(response.percent + "%");
                        $('#customerTrend').text(response.trend);
                        $('#customerPeriod').text("| " + response.period);
                    },
                    error: function(xhr) {
                        console.error("Error fetching customer data:", xhr.responseText);
                    }
                });
            }

            // Handler for filter option clicks
            $('.customer-filter-option').on('click', function(e) {
                e.preventDefault();
                var filter = $(this).data('filter');
                fetchCustomerData(filter);
            });

            // Initial fetch with default filter ("this_year")
            fetchCustomerData('this_year');

            // Optional: Auto-poll every 30 seconds (if you want live updates)
            setInterval(function() {
                // Get current filter from the displayed period text (in lowercase, remove "| ")
                var currentFilter = $('#customerPeriod').text().replace("| ", "").toLowerCase();
                fetchCustomerData(currentFilter);
            }, 30000);
        });
    </script>
    <script>
        $(document).ready(function() {
            // Function to fetch recent sales data
            function fetchRecentSales(filter) {
                $.ajax({
                    url: "{{ route('sales.recent') }}",
                    method: "GET",
                    data: {
                        filter: filter
                    },
                    dataType: "html",
                    success: function(response) {
                        // Update the sales container with the returned HTML
                        $('#recentSalesContainer').html(response);
                        // Update the filter label in the card title
                        let periodText = filter.replace('_', ' ');
                        periodText = periodText.charAt(0).toUpperCase() + periodText.slice(1);
                        $('#salesPeriod').text("| " + periodText);
                    },
                    error: function(xhr) {
                        console.error("Error fetching recent sales:", xhr.responseText);
                    }
                });
            }

            // Attach click event to filter options
            $('.sales-filter-option').on('click', function(e) {
                e.preventDefault();
                let filter = $(this).data('filter');
                fetchRecentSales(filter);
            });

            // Optionally, set an interval to auto-refresh the sales data every 30 seconds
            setInterval(function() {
                let currentFilter = $('.sales-filter-option.active').data('filter') || 'today';
                fetchRecentSales(currentFilter);
            }, 30000);
        });
    </script>

    <script>
        $(document).ready(function() {
            // Function to fetch top selling data based on filter
            function fetchTopSelling(filter) {
                $.ajax({
                    url: "{{ route('top-selling') }}",
                    method: "GET",
                    data: {
                        filter: filter
                    },
                    dataType: "html",
                    success: function(response) {
                        $('#topSellingContainer').html(response);
                        // Update the period text in the card title
                        let periodText = filter.replace('_', ' ');
                        periodText = periodText.charAt(0).toUpperCase() + periodText.slice(1);
                        $('#topSellingPeriod').text("| " + periodText);
                    },
                    error: function(xhr) {
                        console.error("Error fetching top selling data:", xhr.responseText);
                    }
                });
            }

            // Attach click event to filter options
            $('.top-selling-filter-option').on('click', function(e) {
                e.preventDefault();
                let filter = $(this).data('filter');
                fetchTopSelling(filter);
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Function to fetch news data based on filter
            function fetchNewsData(filter) {
                $.ajax({
                    url: "{{ route('news.recent') }}",
                    method: "GET",
                    data: {
                        filter: filter
                    },
                    dataType: "html",
                    success: function(response) {
                        // Update the news container with the new HTML
                        $('#newsContainer').html(response);
                        // Update the filter text in the title
                        let periodText = filter.replace('_', ' ');
                        periodText = periodText.charAt(0).toUpperCase() + periodText.slice(1);
                        $('#newsPeriod').text("| " + periodText);
                    },
                    error: function(xhr) {
                        console.error("Error fetching news data:", xhr.responseText);
                    }
                });
            }

            // Attach click handler to filter options
            $('.news-filter-option').on('click', function(e) {
                e.preventDefault();
                let filter = $(this).data('filter');
                fetchNewsData(filter);
            });
        });
    </script>


</x-layouts.driver>
