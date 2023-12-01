@extends('admin.layouts.app')

@section('content')
<main class="h-full overflow-y-auto">
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
           Tổng quan
        </h2>

        <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
            <!-- Card -->
            <div
                class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
            >
                <div
                    class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500"
                >
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"
                        ></path>
                    </svg>
                </div>
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                        Khách hàng
                    </p>
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                        {{$userCount}}
                    </p>
                </div>
            </div>
            <!-- Card -->
            <div
                class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
            >
                <div
                    class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500"
                >
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            fill-rule="evenodd"
                            d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
                            clip-rule="evenodd"
                        ></path>
                    </svg>
                </div>
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                        Doanh thu tháng {{$month}}
                    </p>
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                      {{ CurrencyHelper::format($monthlyRevenue) }}
                    </p>
                </div>
            </div>
            <!-- Card -->
            <div
                class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
            >
                <div
                    class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500"
                >
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"
                        ></path>
                    </svg>
                </div>
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                       Đơn hàng mới
                    </p>
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                        {{$newOrders}}
                    </p>
                </div>
            </div>
            <!-- Card -->
            <div
                class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
            >
                <div
                    class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500"
                >
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            fill-rule="evenodd"
                            d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z"
                            clip-rule="evenodd"
                        ></path>
                    </svg>
                </div>
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                       Phần trăm đơn hàng thành công
                    </p>
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                        {{$bounceRate}} %
                    </p>
                </div>
            </div>
        </div>
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Charts
        </h2>
        <div class="flex justify-center">
            <div class="mr-4">
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Từ ngày</span>
                    <input id="startDate" name="startDate" type="date" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Jane Doe">
                </label>
            </div>
            <div>
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Đến ngày</span>
                    <input id="endDate" name="endDate" type="date" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Jane Doe">
                </label>
            </div>
            <button type="submit" id="filterBtn" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Lọc
            </button>
        </div>
<br>

        <div class="grid gap-6 mb-8 md:grid-cols-6">
            <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
                    Bảng thống kê phần trăm 3 sản phẩm bán chạy
                </h4>
                <canvas id="chartTopSellingProducts" style="display: block; height: 280px; width: 560px;" width="840px" height="420px" class="chartjs-render-monitor"></canvas>
            </div>
            <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"><div class="chartjs-size-monitor">
                    <div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
                    Bảng thống kê doanh thu theo tháng
                </h4>
                <canvas id="ChartOnlyMonth" style="display: block; height: 280px; width: 560px;" width="840px" height="420px" class="chartjs-render-monitor"> </canvas>
            </div>
            <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"><div class="chartjs-size-monitor">
                    <div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
                    Bảng thống kê trạng thái đơn hàng
                </h4>
                <canvas id="ChartStatusOrder" style="display: block; height: 280px; width: 560px;" width="840px" height="420px" class="chartjs-render-monitor"> </canvas>
            </div>
        </div>
    </div>
</main>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var getId = document.getElementById('ChartOnlyMonth');

            var chart = new Chart(getId, {
                type: 'line',
                data: {
                    labels: [],
                    datasets: [{
                        label: 'Doanh thu',
                        data: [],
                        fill: false,
                        borderColor: 'rgb(128, 42, 247)',
                        tension: 0.1
                    }]
                },
            });

            function loadChart(startDate, endDate) {
                $.ajax({
                    type: 'GET',
                    dataType: 'json',
                    url: '{{ route('getChartOnlyMonth-revenue') }}',
                    data: {
                        startDate: startDate,
                        endDate: endDate
                    },
                    success: function(response) {
                        console.log(response)
                        chart.data.labels = response.labels
                        chart.data.datasets[0].data = response.data;
                        chart.update();
                    }
                });
            }

            $('#filterBtn').click(function(e) {
                e.preventDefault();

                var startAt = $('#startDate').val();
                var endAt = $('#endDate').val();
                console.log(startAt)
                console.log(endAt)

                $.ajax({
                    type: 'GET',
                    dataType: 'json',
                    url: '{{ route('filterGetChartOnlyMonth-revenue') }}',
                    data: {
                        startDate: startAt,
                        endDate: endAt,
                    },
                    success: function(response) {
                        console.log(response)
                        chart.data.labels = response.labels
                        chart.data.datasets[0].data = response.data;
                        chart.update();
                    },
                    error: function (err) {
                        console.log(err)
                    }
                });
            });
            loadChart();
        });
    </script>

{{--    <script>--}}
{{--        $(document).ready(function() {--}}
{{--            $.ajax({--}}
{{--                type: 'GET',--}}
{{--                dataType: 'json',--}}
{{--                url: '{{ route('ChartStatusOrder-revenue') }}',--}}
{{--                success: function(response) {--}}
{{--                    const ctx = document.getElementById('ChartStatusOrder');--}}

{{--                    new Chart(ctx, {--}}
{{--                        type: 'doughnut',--}}
{{--                        data: {--}}
{{--                            labels: response.labels,--}}
{{--                            datasets: [{--}}
{{--                                label: 'Phần trăm',--}}
{{--                                data: response.data,--}}
{{--                                backgroundColor: [--}}
{{--                                    'rgb(255, 99, 132)',--}}
{{--                                    'rgb(54, 162, 235)',--}}
{{--                                    'rgb(255, 205, 86)',--}}
{{--                                ],--}}
{{--                            }]--}}
{{--                        },--}}
{{--                        options: {--}}
{{--                            scales: {--}}
{{--                                y: {--}}
{{--                                    beginAtZero: true--}}
{{--                                }--}}
{{--                            }--}}
{{--                        }--}}
{{--                    });--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}

    <script>
        $(document).ready(function() {
            var getId = document.getElementById('chartTopSellingProducts');

            var chart = new Chart(getId, {
                type: 'doughnut',
                data: {
                    labels: [],
                    datasets: [{
                        label: 'Phần trăm',
                        data: [],
                        backgroundColor: [
                            'rgb(255, 99, 132)',
                            'rgb(54, 162, 235)',
                            'rgb(255, 205, 86)',
                        ],
                    }]
                },
            });

            function loadChart(startDate, endDate) {
                $.ajax({
                    type: 'GET',
                    dataType: 'json',
                    url: '{{ route('topSellingProducts-revenue') }}',
                    data: {
                        startDate: startDate,
                        endDate: endDate
                    },
                    success: function(response) {
                        console.log(response)
                        chart.data.labels = response.labels
                        chart.data.datasets[0].data = response.data;
                        chart.update();
                    }
                });
            }

            $('#filterBtn').click(function(e) {
                e.preventDefault();

                var startAt = $('#startDate').val();
                var endAt = $('#endDate').val();
                console.log(startAt)
                console.log(endAt)

                $.ajax({
                    type: 'GET',
                    dataType: 'json',
                    url: '{{ route('chartTopSellingProductOnlyMonth-revenue') }}',
                    data: {
                        startDate: startAt,
                        endDate: endAt,
                    },
                    success: function(response) {
                        console.log(response)
                        chart.data.labels = response.labels
                        chart.data.datasets[0].data = response.data;
                        chart.update();
                    },
                    error: function (err) {
                        console.log(err)
                    }
                });
            });
            loadChart();
        });
    </script>

    <script>
        $(document).ready(function() {
            var getId = document.getElementById('ChartStatusOrder');

            var chart = new Chart(getId, {
                type: 'pie',
                data: {
                    labels: [],
                    datasets: [{
                        label: 'Phần trăm',
                        data: [],
                        backgroundColor: [
                            'rgb(255, 99, 132)',
                            'rgb(54, 162, 235)',
                            'rgb(255, 205, 86)',
                            'rgb(74, 212, 32)',
                            'rgb(195, 33, 217)',
                        ],
                    }]
                },
            });

            function loadChart(startDate, endDate) {
                $.ajax({
                    type: 'GET',
                    dataType: 'json',
                    url: '{{ route('ChartStatusOrder-revenue') }}',
                    data: {
                        startDate: startDate,
                        endDate: endDate
                    },
                    success: function(response) {
                        console.log(response)
                        chart.data.labels = response.labels
                        chart.data.datasets[0].data = response.data;
                        chart.update();
                    }
                });
            }

            $('#filterBtn').click(function(e) {
                e.preventDefault();

                var startAt = $('#startDate').val();
                var endAt = $('#endDate').val();
                console.log(startAt)
                console.log(endAt)

                $.ajax({
                    type: 'GET',
                    dataType: 'json',
                    url: '{{ route('chartStatusOrderOnlyMonth-revenue') }}',
                    data: {
                        startDate: startAt,
                        endDate: endAt,
                    },
                    success: function(response) {
                        console.log(response)
                        chart.data.labels = response.labels
                        chart.data.datasets[0].data = response.data;
                        chart.update();
                    },
                    error: function (err) {
                        console.log(err)
                    }
                });
            });
            loadChart();
        });
    </script>
@endsection
