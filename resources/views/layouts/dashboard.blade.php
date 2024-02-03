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
            <div class="analytics-section-one">
                <div class="total-analytics-container">
                    <div class="glass-effect">
                        <div class="analytics-header">
                            <div>
                                <i class="fa-solid fa-users"></i>
                                <h2>Users</h2>
                            </div>
                            <h2 class="analytics-amount">100</h2>
                        </div>
                        <div>
                            <div class="analytics-body">
                                <div>
                                    <h3>Influences</h3>
                                    <h4>500</h4>
                                </div>
                                <div>
                                    <h3>Businesses</h3>
                                    <h4>500</h4>
                                </div>
                            </div>
                            <div id="piechart_users" class="piechart"></div>
                        </div>
                    </div>
                </div>
                <div class="total-analytics-container">
                    <div class="glass-effect">
                        <div class="analytics-header">
                            <div>
                                <i class="fa-solid fa-handshake"></i>
                                <h2>Collaborations</h2>
                            </div>
                            <h2 class="analytics-amount">100</h2>
                        </div>
                        <div>
                            <div class="analytics-body">
                                <div>
                                    <h3>Ongoing</h3>
                                    <h4>500</h4>
                                </div>
                                <div>
                                    <h3>Completed</h3>
                                    <h4>500</h4>
                                </div>
                            </div>
                            <div id="piechart_collaborations" class="piechart"></div>
                        </div>
                    </div>
                </div>
                <div class="total-analytics-container">
                    <div class="glass-effect">
                        <div class="analytics-header">
                            <div>
                                <i class="fa-solid fa-file-import"></i>
                                <h2>Proposals</h2>
                            </div>
                            <h2 class="analytics-amount">100</h2>
                        </div>
                        <div class="analytics-body-content">
                            <div class="analytics-body">
                                <div>
                                    <h3>Pending</h3>
                                    <h4>500</h4>
                                </div>
                                <div>
                                    <h3>Accepted</h3>
                                    <h4>500</h4>
                                </div>
                                <div>
                                    <h3>Rejected</h3>
                                    <h4>500</h4>
                                </div>
                            </div>
                            <div id="piechart_proposals" class="piechart"></div>
                        </div>
                    </div>
                </div>
                <div class="total-analytics-container">
                    <div class="glass-effect">
                        <div class="analytics-header">
                            <div>
                                <i class="fa-solid fa-sack-dollar"></i>
                                <h2>Payments</h2>
                            </div>
{{--                            <h2 class="analytics-amount">100</h2>--}}
                        </div>
                        <div>
                            <div class="analytics-body">
                                <div>
                                    <h3>Money/LKR</h3>
                                    <h4>10,000</h4>
                                </div>
                                <div>
                                    <h3>Transactions</h3>
                                    <h4>500</h4>
                                </div>
                            </div>
                            <div id="piechart_transactions" class="piechart"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="analytics-section-two">
                <div class="growth-chart">
                    <div class="glass-effect">
                        <div class="chart-header">
                            <i class="fa-solid fa-users"></i>
                            <h2>User Growth by Month</h2>
                        </div>
                        <div id="chartone"></div>
                    </div>
                </div>
                <div class="growth-chart">
                    <div class="glass-effect">
                        <div class="chart-header">
                            <i class="fa-solid fa-users"></i>
                            <h2>User Growth by Month</h2>
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
    let piechart_users_options = {
        series: [46, 12],
        colors: ["#16BDCA", "#9061F9"],
        chart: {
            height: 300,
            width: 250,
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
        labels: ["Influencers", "Businesses"],
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

    let piechart_users = new ApexCharts(document.querySelector("#piechart_users"), piechart_users_options);
    piechart_users.render();

    let piechart_collaborations_options = {
        series: [46, 12],
        colors: ["#16BDCA", "#9061F9"],
        chart: {
            height: 300,
            width: 250,
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
        labels: ["Influencers", "Businesses"],
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

    let piechart_collaborations = new ApexCharts(document.querySelector("#piechart_collaborations"), piechart_collaborations_options);
    piechart_collaborations.render();

    let piechart_proposals_options = {
        series: [46, 12],
        colors: ["#16BDCA", "#9061F9"],
        chart: {
            height: 300,
            width: 250,
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
        labels: ["Influencers", "Businesses"],
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

    let piechart_proposals = new ApexCharts(document.querySelector("#piechart_proposals"), piechart_proposals_options);
    piechart_proposals.render();

    let piechart_transactions_options = {
        series: [46, 12],
        colors: ["#16BDCA", "#9061F9"],
        chart: {
            height: 300,
            width: 250,
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
        labels: ["Influencers", "Businesses"],
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

    let piechart_transactions = new ApexCharts(document.querySelector("#piechart_transactions"), piechart_transactions_options);
    piechart_transactions.render();

    let options1 = {
        series: [{
            name: "Desktops",
            data: [10, 41, 35, 51, 49, 62, 69, 91, 148, 150, 178, 190]
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
            colors: ['#FF5D26']
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
            colors: ['#000000'], // Change the color of the markers here
        },
        tooltip: {
            marker: {
                fillColors: ['#FF5D26'] // Change the color of the marker here
            },
        },
    };

    let chart1 = new ApexCharts(document.querySelector("#chartone"), options1);
    chart1.render();

    let options2 = {
        series: [{
            name: "Desktops",
            data: [10, 41, 35, 51, 49, 62, 69, 91, 148, 150, 178, 190]
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
            colors: ['#FF5D26']
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
            colors: ['#000000'], // Change the color of the markers here
        },
        tooltip: {
            marker: {
                fillColors: ['#FF5D26'] // Change the color of the marker here
            },
        },
    };

    let chart2 = new ApexCharts(document.querySelector("#charttwo"), options2);
    chart2.render();
</script>
