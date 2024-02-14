<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Influencer Connect') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/sass/dashboard.scss', 'resources/sass/dashboard-edit.scss', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script defer src="https://kit.fontawesome.com/582a81fd83.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css">
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body id="body">
<div id="dashboard">
    @include('components.dashboard-navbar')
</div>
<main class="dashboard-body">
    <div class="dashboard-header">
        <a href="{{ url('/') }}">
            <img src="/images/influencer_connect_logo.png" alt="Influencer Connect" class="dashboard-header-logo">
        </a>
        <h2>{{ Auth::user()->name }}</h2>
    </div>
    <div class="dashboard-content">
        @section('content')
{{--            @dd($totalInfluencers, $totalBusinesses)--}}
            <div class="analytics-section-one">
                <div class="total-analytics-container">
                    <div class="glass-effect-analytics">
                        <div class="analytics-header">
                            <div>
                                <i class="fa-solid fa-users"></i>
                                <h2>Users</h2>
                            </div>
                            <h2 class="analytics-amount">{{ $totalUsers }}</h2>
                        </div>
                        <div class="piechart-container">
                            <div id="piechart_users" class="piechart"></div>
                        </div>
                    </div>
                </div>
                <div class="total-analytics-container">
                    <div class="glass-effect-analytics">
                        <div class="analytics-header">
                            <div>
                                <i class="fa-solid fa-handshake"></i>
                                <h2>Collaborations</h2>
                            </div>
                            <h2 class="analytics-amount">{{ $totalCollaborations }}</h2>
                        </div>
                        <div class="piechart-container">
                            <div id="piechart_collaborations" class="piechart"></div>
                        </div>
                    </div>
                </div>
                <div class="total-analytics-container">
                    <div class="glass-effect-analytics">
                        <div class="analytics-header">
                            <div>
                                <i class="fa-solid fa-file-import"></i>
                                <h2>Proposals</h2>
                            </div>
                            <h2 class="analytics-amount">{{ $totalProposals }}</h2>
                        </div>
                        <div class="piechart-container">
                            <div id="piechart_proposals" class="piechart"></div>
                        </div>
                    </div>
                </div>
                <div class="total-analytics-container">
                    <div class="glass-effect-analytics">
                        <div class="analytics-header">
                            <div>
                                <i class="fa-solid fa-check"></i>
                                <h2>Verifications</h2>
                            </div>
                        </div>
                        <div class="piechart-container">
                            <div id="piechart_verifications" class="piechart"></div>
                        </div>
                    </div>
                </div>
                <div class="total-analytics-container">
                    <div class="glass-effect-analytics">
                        <div class="analytics-header">
                            <div>
                                <i class="fa-solid fa-headset"></i>
                                <h2>Support Tickets</h2>
                            </div>
                        </div>
                        <div class="piechart-container">
                            <div id="piechart_tickets" class="piechart"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="analytics-section-two">
                <div class="growth-chart">
                    <div class="glass-effect-analytics-graphs">
                        <div class="chart-header">
                            <i class="fa-solid fa-users"></i>
                            <h2>User Growth by Month</h2>
                        </div>
                        <div id="chartone"></div>
                    </div>
                </div>
                <div class="growth-chart">
                    <div class="glass-effect-analytics-graphs">
                        <div class="chart-header">
                            <i class="fa-solid fa-sack-dollar"></i>
                            <h2>Payments & Transactions by Month</h2>
                            <p>Coming Soon</p>
                        </div>
                        <div id="charttwo"></div>
                    </div>
                </div>
            </div>
        @show
    </div>

</main>
<!-- Success Message -->
<div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
     class="fixed bottom-0 right-0 bg-green-500 text-white p-4 rounded m-4  feedback-popup" style="display: none;">
    <p>
        @if (session('success'))
            {{ session('success') }}
        @endif
    </p>
</div>
<!-- Error Message -->
@if ($errors->any())
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
         class="fixed bottom-0 right-0 bg-red-500 text-white p-4 rounded m-4  feedback-popup" style="display: none;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
</body>

</html>

<script>
    function generatePieChartOptions(series, colors, width, labels) {
        return {
            series: series,
            colors: colors,
            chart: {
                height: 250,
                width: width,
                type: "pie",
            },
            stroke: {
                colors: ["black"],
                lineCap: "",
            },
            plotOptions: {
                pie: {
                    labels: {
                        show: true,
                    },
                    size: "100%",
                    dataLabels: {
                        offset: -25
                    }
                },
            },
            labels: labels,
            dataLabels: {
                enabled: true,
                style: {
                    fontFamily: "tripsansbold, sans-serif",
                    colors: ["black"],
                },
            },
            legend: {
                position: "bottom",
                fontFamily: "tripsansbold, sans-serif",
            },
            yaxis: {
                labels: {
                    formatter: function (value) {
                        return value
                    },
                },
            },
            xaxis: {
                labels: {
                    formatter: function (value) {
                        return value + "%"
                    },
                },
                axisTicks: {
                    show: false,
                },
                axisBorder: {
                    show: false,
                },
            },
        }
    }

    function renderPieChart(elementId, options) {
        let chart = new ApexCharts(document.querySelector(elementId), options);
        chart.render();
    }

    let piechart_users_options = generatePieChartOptions([{{ $totalInfluencers }}, {{ $totalBusinesses }}], ["#9061F9", "#1C64F2"], 200, ["Influencers", "Businesses"]);
    renderPieChart("#piechart_users", piechart_users_options);

    let piechart_collaborations_options = generatePieChartOptions([{{ $totalPendingCollaborations }}, {{ $totalActiveCollaborations }}, {{ $totalCompletedCollaborations }} ], ["#9061F9", "#1C64F2", "#16BDCA"], 250, ["Pending", "Active", "Completed"]);
    renderPieChart("#piechart_collaborations", piechart_collaborations_options);

    let piechart_proposals_options = generatePieChartOptions([{{ $totalPendingProposals }}, {{ $totalAcceptedProposals }}, {{ $totalRejectedProposals }}], ["#9061F9", "#1C64F2", "#16BDCA"], 250, ["Pending", "Accepted", "Rejected"]);
    renderPieChart("#piechart_proposals", piechart_proposals_options);

    let piechart_transactions_options = generatePieChartOptions([46, 12], ["#16BDCA", "#9061F9"], 200, ["Influencers", "Businesses"]);
    renderPieChart("#piechart_transactions", piechart_transactions_options);

    let piechart_coming_soon_options = generatePieChartOptions([1], ["rgba(255,93,38,0.5)"], 200, ["Coming Soon"]);
    renderPieChart("#piechart_verifications", piechart_coming_soon_options);

    renderPieChart("#piechart_tickets", piechart_coming_soon_options);

    let options1 = {
        series: [{
            name: "Users",
            data: @json($userGrowthByMonth)
        }],
        chart: {
            height: 350,
            type: 'line',
            zoom: {
                enabled: false
            },
            fontFamily: 'tripsansbold, sans-serif',
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'straight',
            colors: ['#16BDCA']
        },
        grid: {
            row: {
                colors: ['#f3f3f3', 'transparent'],
                opacity: 0.5
            },
        },
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            axisBorder: {
                show: true,
                color: '#000000',
            },
        },
        markers: {
            size: 4,
            colors: ['#1C64F2'], // Change the color of the markers here
        },
        tooltip: {
            marker: {
                fillColors: ['#1C64F2'] // Change the color of the marker here
            },
        },
    };

    let chart1 = new ApexCharts(document.querySelector("#chartone"), options1);
    chart1.render();

    let options2 = {
        series: [{
            name: "Coming Soon",
            data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
        }],
        chart: {
            height: 350,
            type: 'line',
            zoom: {
                enabled: false
            },
            fontFamily: 'tripsansbold, sans-serif',
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'straight',
            colors: ['#16BDCA']
        },
        grid: {
            row: {
                colors: ['#f3f3f3', 'transparent'],
                opacity: 0.5
            },
        },
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            axisBorder: {
                show: true,
                color: '#000000',
            },
        },
        markers: {
            size: 4,
            colors: ['#1C64F2'], // Change the color of the markers here
        },
        tooltip: {
            marker: {
                fillColors: ['#1C64F2'] // Change the color of the marker here
            },
        },
    };

    let chart2 = new ApexCharts(document.querySelector("#charttwo"), options2);
    chart2.render();
</script>
