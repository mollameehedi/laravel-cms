@extends('admin.layouts.app')

@section('content')
    <div class="content-inner container-fluid pb-0" id="page_layout">
        <div class="d-flex justify-content-between align-items-center flex-wrap mb-4 gap-3">
            <div class="d-flex flex-column">
                <h3>Welcome To Dashboard</h3>
                <p class="text-primary mb-0">Dashboard</p>
            </div>
            <div class="d-flex justify-content-between align-items-center rounded flex-wrap gap-3">
                <div class="form-group mb-0">
                    <select class="select2-basic-single js-states form-control" name="state" style="width: 100%;">
                        <option>Past 30 Days</option>
                        <option>Past 60 Days</option>
                        <option>Past 90 Days</option>
                        <option>Past 1 year</option>
                        <option>Past 2 year</option>
                    </select>
                </div>
                <div class="form-group mb-0">
                    <input type="text" name="start" class="form-control range_flatpicker flatpickr-input active"
                        placeholder="24 Jan 2022 to 23 Feb 2022" readonly="readonly">
                </div>
                <button type="button" class="btn btn-primary">Analytics</button>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-2">
                        <div class="card bg-soft-danger">
                            <div class="card-body  p-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="bg-danger text-white rounded p-3">
                                        <svg class="icon-15" width="15" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.997 15.1746C7.684 15.1746 4 15.8546 4 18.5746C4 21.2956 7.661 21.9996 11.997 21.9996C16.31 21.9996 19.994 21.3206 19.994 18.5996C19.994 15.8786 16.334 15.1746 11.997 15.1746Z"
                                                fill="currentColor"></path>
                                            <path opacity="0.4"
                                                d="M11.9971 12.5838C14.9351 12.5838 17.2891 10.2288 17.2891 7.29176C17.2891 4.35476 14.9351 1.99976 11.9971 1.99976C9.06008 1.99976 6.70508 4.35476 6.70508 7.29176C6.70508 10.2288 9.06008 12.5838 11.9971 12.5838Z"
                                                fill="currentColor"></path>
                                        </svg>
                                    </div>
                                    <div class="text-end">
                                        <h4 class="counter">4500</h4>
                                        Click
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="card bg-soft-warning">
                            <div class="card-body  p-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="bg-warning text-white  rounded p-3">
                                        <svg class="icon-15" width="15" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.997 15.1746C7.684 15.1746 4 15.8546 4 18.5746C4 21.2956 7.661 21.9996 11.997 21.9996C16.31 21.9996 19.994 21.3206 19.994 18.5996C19.994 15.8786 16.334 15.1746 11.997 15.1746Z"
                                                fill="currentColor"></path>
                                            <path opacity="0.4"
                                                d="M11.9971 12.5838C14.9351 12.5838 17.2891 10.2288 17.2891 7.29176C17.2891 4.35476 14.9351 1.99976 11.9971 1.99976C9.06008 1.99976 6.70508 4.35476 6.70508 7.29176C6.70508 10.2288 9.06008 12.5838 11.9971 12.5838Z"
                                                fill="currentColor"></path>
                                        </svg>
                                    </div>
                                    <div class="text-end">
                                        <h4 class="counter">4500</h4>
                                        Unick Click
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-2">
                        <div class="card bg-soft-secondary">
                            <div class="card-body  p-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="bg-secondary text-white  rounded p-3">
                                        <svg class="icon-15" width="15" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.997 15.1746C7.684 15.1746 4 15.8546 4 18.5746C4 21.2956 7.661 21.9996 11.997 21.9996C16.31 21.9996 19.994 21.3206 19.994 18.5996C19.994 15.8786 16.334 15.1746 11.997 15.1746Z"
                                                fill="currentColor"></path>
                                            <path opacity="0.4"
                                                d="M11.9971 12.5838C14.9351 12.5838 17.2891 10.2288 17.2891 7.29176C17.2891 4.35476 14.9351 1.99976 11.9971 1.99976C9.06008 1.99976 6.70508 4.35476 6.70508 7.29176C6.70508 10.2288 9.06008 12.5838 11.9971 12.5838Z"
                                                fill="currentColor"></path>
                                        </svg>
                                    </div>
                                    <div class="text-end">
                                        <h4 class="counter">4500</h4>
                                        Conversation
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="card bg-soft-primary">
                            <div class="card-body  p-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="bg-primary text-white rounded p-3">
                                        <svg class="icon-15" width="15" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.997 15.1746C7.684 15.1746 4 15.8546 4 18.5746C4 21.2956 7.661 21.9996 11.997 21.9996C16.31 21.9996 19.994 21.3206 19.994 18.5996C19.994 15.8786 16.334 15.1746 11.997 15.1746Z"
                                                fill="currentColor"></path>
                                            <path opacity="0.4"
                                                d="M11.9971 12.5838C14.9351 12.5838 17.2891 10.2288 17.2891 7.29176C17.2891 4.35476 14.9351 1.99976 11.9971 1.99976C9.06008 1.99976 6.70508 4.35476 6.70508 7.29176C6.70508 10.2288 9.06008 12.5838 11.9971 12.5838Z"
                                                fill="currentColor"></path>
                                        </svg>
                                    </div>
                                    <div class="text-end">
                                        <h4 class="counter">4500</h4>
                                        Revenue
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="card bg-soft-info">
                            <div class="card-body p-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="bg-info text-white  rounded p-3">
                                        <svg class="icon-15" width="15" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.997 15.1746C7.684 15.1746 4 15.8546 4 18.5746C4 21.2956 7.661 21.9996 11.997 21.9996C16.31 21.9996 19.994 21.3206 19.994 18.5996C19.994 15.8786 16.334 15.1746 11.997 15.1746Z"
                                                fill="currentColor"></path>
                                            <path opacity="0.4"
                                                d="M11.9971 12.5838C14.9351 12.5838 17.2891 10.2288 17.2891 7.29176C17.2891 4.35476 14.9351 1.99976 11.9971 1.99976C9.06008 1.99976 6.70508 4.35476 6.70508 7.29176C6.70508 10.2288 9.06008 12.5838 11.9971 12.5838Z"
                                                fill="currentColor"></path>
                                        </svg>
                                    </div>
                                    <div class="text-end">
                                        <h4 class="counter">4500</h4>
                                        Payout
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="card bg-soft-success">
                            <div class="card-body  p-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="bg-success text-white  rounded p-3">
                                        <svg class="icon-15" width="15" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.997 15.1746C7.684 15.1746 4 15.8546 4 18.5746C4 21.2956 7.661 21.9996 11.997 21.9996C16.31 21.9996 19.994 21.3206 19.994 18.5996C19.994 15.8786 16.334 15.1746 11.997 15.1746Z"
                                                fill="currentColor"></path>
                                            <path opacity="0.4"
                                                d="M11.9971 12.5838C14.9351 12.5838 17.2891 10.2288 17.2891 7.29176C17.2891 4.35476 14.9351 1.99976 11.9971 1.99976C9.06008 1.99976 6.70508 4.35476 6.70508 7.29176C6.70508 10.2288 9.06008 12.5838 11.9971 12.5838Z"
                                                fill="currentColor"></path>
                                        </svg>
                                    </div>
                                    <div class="text-end">
                                        <h4 class="counter">4500</h4>
                                        Profit
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-8">

                        <div class="card">
                            <div class="card-header">
                                <div class="text-center">
                                    <h4 class="card-title text-center">30 Days Performance</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="admin-chart-01" class="admin-chart-01"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class=" bg-soft-success rounded p-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="35px" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 8h6m-5 0a3 3 0 110 6H9l3 3m-3-6h6m6 1a9 9 0 11-18 0 9 9 0 0118 0z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h1 class="text-success counter">250M</h1>
                                        <p class="text-success mb-0">Total Earning</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <div class="text-center">
                                    <h4 class="card-title text-center">Device</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="device"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Top Country</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="fancy-table table-responsive rounded">
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Click</th>
                                        <th scope="col">Conversion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($top_countries as $country)
                                        <tr>

                                            <td class="text-dark">
                                                <span class="badge badge-info"><i
                                                        class="fi fi-{{ Str::lower($country->country->code) }}"></i></span>
                                                {{ $country->country->name }}
                                            </td>
                                            <td class="text-dark">{{ $country->click }}</td>
                                            <td class="text-dark">{{ $country->conversion }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Top Affiliate</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="fancy-table table-responsive rounded">
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Affiliate</th>
                                        <th scope="col">Click</th>
                                        <th scope="col">Conversion</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($top_affiliates as $top_affiliate)
                                        <tr>
                                            <td class="text-dark">{{ $top_affiliate->id }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img class="rounded img-fluid avatar-60 me-3"
                                                        src="{{ $top_affiliate->user->getFirstMediaUrl('avatar') }}"
                                                        alt="" loading="lazy" />
                                                    <div class="media-support-info">
                                                        <h5 class="iq-sub-label">
                                                            {{ $top_affiliate->user->first_name . ' ' . $top_affiliate->user->last_name }}
                                                        </h5>
                                                        <p class="mb-0">{{ $top_affiliate->user->name }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-dark">{{ $top_affiliate->click }}</td>
                                            <td class="text-dark">{{ $top_affiliate->conversion }}</td>
                                            <td class="text-dark">
                                                <a href="" class="btn btn-primary btn-sm">

                                                    <svg class="icon-20" width="20" viewBox="0 0 24 24"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path opacity="0.4"
                                                            d="M7.29639 6.446C7.29639 3.995 9.35618 2 11.8878 2H16.9201C19.4456 2 21.5002 3.99 21.5002 6.436V17.552C21.5002 20.004 19.4414 22 16.9098 22H11.8775C9.35205 22 7.29639 20.009 7.29639 17.562V16.622V6.446Z"
                                                            fill="currentColor"></path>
                                                        <path
                                                            d="M16.0374 11.4538L13.0695 8.54482C12.7627 8.24482 12.2691 8.24482 11.9634 8.54682C11.6587 8.84882 11.6597 9.33582 11.9654 9.63582L13.5905 11.2288H3.2821C2.85042 11.2288 2.5 11.5738 2.5 11.9998C2.5 12.4248 2.85042 12.7688 3.2821 12.7688H13.5905L11.9654 14.3628C11.6597 14.6628 11.6587 15.1498 11.9634 15.4518C12.1168 15.6028 12.3168 15.6788 12.518 15.6788C12.717 15.6788 12.9171 15.6028 13.0695 15.4538L16.0374 12.5448C16.1847 12.3998 16.268 12.2038 16.268 11.9998C16.268 11.7948 16.1847 11.5988 16.0374 11.4538Z"
                                                            fill="currentColor"></path>
                                                    </svg>

                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Top Offers</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="fancy-table table-responsive rounded">
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">Offer</th>
                                        <th scope="col">Country</th>
                                        <th scope="col">Revenue</th>
                                        <th scope="col">Payout</th>
                                        <th scope="col">Click</th>
                                        <th scope="col">Conversion</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($top_offers as $offer)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img class="rounded img-fluid avatar-60 me-3"
                                                        src="{{ $offer->offer->getFirstMediaUrl('photo') ? $offer->offer->getFirstMediaUrl('photo') : env('APP_URL') . '/backend/assets/img/users/2.jpg' }}"
                                                        alt="" loading="lazy" />
                                                    <div class="media-support-info">
                                                        <h5 class="iq-sub-label">{{ $offer->offer->name }}</h5>
                                                        <p class="mb-0">{{ $offer->name }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-dark">
                                                @foreach ($offer->offer->countries as $country)
                                                    <span class="badge badge-info"><i
                                                            class="fi fi-{{ Str::lower($country->code) }}"></i></span>
                                                @endforeach
                                            </td>
                                            <td class="text-dark">{{ $offer->revenue }}</td>
                                            <td class="text-dark">{{ $offer->payout }}</td>
                                            <td class="text-dark">{{ $offer->click }}</td>
                                            <td class="text-dark">{{ $offer->conversion }}</td>
                                            <td class="text-dark">
                                                <a href="" class="btn btn-primary btn-sm">

                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon-20"
                                                        width="32" viewBox="0 0 24 24" fill="none">
                                                        <path
                                                            d="M22.4541 11.3918C22.7819 11.7385 22.7819 12.2615 22.4541 12.6082C21.0124 14.1335 16.8768 18 12 18C7.12317 18 2.98759 14.1335 1.54586 12.6082C1.21811 12.2615 1.21811 11.7385 1.54586 11.3918C2.98759 9.86647 7.12317 6 12 6C16.8768 6 21.0124 9.86647 22.4541 11.3918Z"
                                                            stroke="currentColor"></path>
                                                        <path
                                                            d="M12 17C14.7614 17 17 14.7614 17 12C17 9.23858 14.7614 7 12 7C9.23858 7 7 9.23858 7 12C7 14.7614 9.23858 17 12 17Z"
                                                            stroke="currentColor"></path>
                                                        <path
                                                            d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z"
                                                            fill="currentColor"></path>
                                                        <mask id="mask0_18_1038" style="mask-type:alpha"
                                                            maskUnits="userSpaceOnUse" x="9" y="9"
                                                            width="6" height="6">
                                                            <path
                                                                d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z"
                                                                fill="currentColor"></path>
                                                        </mask>
                                                        <g mask="url(#mask0_18_1038)">
                                                            <path opacity="0.89"
                                                                d="M13.5 12C14.3284 12 15 11.3284 15 10.5C15 9.67157 14.3284 9 13.5 9C12.6716 9 12 9.67157 12 10.5C12 11.3284 12.6716 12 13.5 12Z"
                                                                fill="white"></path>
                                                        </g>
                                                    </svg>

                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        var options = {
            colors: ['#4d3a96', '#4576b5', '#21618C', '#A569BD', '#16A085'],
            series: [{
                name: 'Click',
                data: [30, 250, 200, 210, 150, 109, 50]
            }, {
                name: 'Conversion',
                data: [29, 200, 185, 155, 130, 100, 40]
            }, {
                name: 'Payout',
                data: [25, 125, 150, 130, 110, 95, 35]
            }, {
                name: 'Profit',
                data: [20, 117, 125, 115, 80, 90, 20]
            }, {
                name: 'Revenu',
                data: [15, 90, 105, 100, 55, 70, 15]
            }],
            chart: {
                height: 350,
                type: 'area',
                toolbar: {
                    show: false
                },
            },
            yaxis: {
                title: {
                    text: 'Amount',
                },
                labels: {
                    formatter: function(value) {
                        return "$" + value;
                    }
                },
                min: 0
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth'
            },
            xaxis: {
                type: 'date',
                categories: ["2018-09-19", "2018-09-19", "2018-09-19",
                    "2018-09-19", "2018-09-19", "2018-09-19",
                    "2018-09-19"
                ],
                dataLabels: {
                    enabled: true
                },
            },
            tooltip: {
                x: {
                    format: 'dd/mm/yy',
                    dataLabels: {
                        enabled: true,
                        enabledOnSeries: [1]
                    },
                    stroke: {
                        curve: 'smooth'
                    }
                },
            },
        };

        var chart = new ApexCharts(document.querySelector("#admin-chart-01"), options);
        chart.render();
    </script>
    <script>
        var options = {
            series: [44, 55, 41],
            labels: ['Desktop', 'Tabs', 'Mobile'],
            colors: ['#4d3a96', '#4576b5', '#21618C'],
            chart: {
                type: 'donut',
            },
            dataLabels: {
                enabled: true,
                formatter: function(val) {
                    return val.toFixed(2);
                },
                formatter: function(val) {
                    return parseInt(val);
                },
                floating: false,
            },
            legend: {
                show: true,
                position: 'bottom',
                floating: false,
                verticalAlign: 'bottom',
                align: 'center'
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };

        var chart = new ApexCharts(document.querySelector("#device"), options);
        chart.render();
    </script>
@endsection
