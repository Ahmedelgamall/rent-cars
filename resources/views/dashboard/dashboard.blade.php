@extends('dashboard.layouts.app')
@section('title', content: getTranslatedWords('home'))
@section('js')
    <script src="{{ asset('assets/extra-libs/DataTables/datatables.min.js') }}"></script>
    <script>
        let table = $('#datatables').DataTable({

            order: [
                [0, "desc"]
            ],
            @if (App::getLocale() == 'ar')
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json"
                },
            @endif

            responsive: true,
        });
    </script>
    <script>
        $(document).on('click', '.change_profits_count', function() {
            var data = $(this).attr('data-show');
            var action = "{{ route('change_profits_stats_counter') }}";
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: action,
                type: 'POST',
                data: {
                    data: data
                },


                success: function(data) {
                    $('.profits_count').text(data);


                },

            });
        })

        $(document).on('click', '.change_orders_count', function() {
            var data = $(this).attr('data-show');

            var action = "{{ route('change_orders_stats_counter') }}";
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: action,
                type: 'POST',
                data: {
                    data: data
                },


                success: function(data) {
                    $('.orders_count').text(data);


                },

            });
        })

        $(document).on('click', '.change_customers_count', function() {
            var data = $(this).attr('data-show');

            var action = "{{ route('change_customers_stats_counter') }}";
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: action,
                type: 'POST',
                data: {
                    data: data
                },


                success: function(data) {
                    $('.customers_count').text(data);


                },

            });
        })

        let chartOrderStatistics = document.querySelector('#orderStatisticsChart2'),
            orderChartConfig = {
                chart: {
                    height: 165,
                    width: 130,
                    type: 'donut'
                },
                labels: {!! json_encode($categories) !!},
                series: {!! json_encode($fetch_categories) !!},
                colors: {!! json_encode($fetch_colors) !!},
                stroke: {
                    width: 5,
                    colors: "#D69C4F"
                },
                dataLabels: {
                    enabled: false,
                    formatter: function(val, opt) {
                        return parseInt(val);
                    }
                },
                legend: {
                    show: false
                },
                grid: {
                    padding: {
                        top: 0,
                        bottom: 0,
                        right: 15
                    }
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '75%',
                            labels: {
                                show: true,
                                value: {
                                    fontSize: '1.5rem',
                                    fontFamily: 'Public Sans',
                                    color: "#D69C4F",
                                    offsetY: -15,
                                    formatter: function(val) {
                                        return parseInt(val);
                                    }
                                },
                                name: {
                                    offsetY: 20,
                                    fontFamily: 'Public Sans'
                                },
                                total: {
                                    show: true,
                                    fontSize: '0.8125rem',
                                    color: "#D69C4F",
                                    label: "{{ getTranslatedWords('total') }}",
                                    formatter: function(w) {
                                        return '{{ App\Models\Order::count() }}';
                                    }
                                }
                            }
                        }
                    }
                }
            };
        //if (typeof chartOrderStatistics !== undefined && chartOrderStatistics !== null) {
        let statisticsChart = new ApexCharts(chartOrderStatistics, orderChartConfig);
        statisticsChart.render();
        //}

        function destroyChart() {
            statisticsChart.destroy();
        }

        $(document).on('click', '.change_categories_count', function() {
            var data = $(this).attr('data-show');

            var action = "{{ route('change_categories_count') }}";
            /*if (statisticsChart) {
                statisticsChart.destory();
            }*/
            destroyChart();



            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: action,
                type: 'POST',
                data: {
                    data: data
                },


                success: function(res) {

                    $('.changed_content').html(res.success);
                    var orderChartConfig2 = {
                        chart: {
                            height: 165,
                            width: 130,
                            type: 'donut'
                        },
                        labels: res.data.categories,
                        series: res.data.fetch_categories,
                        colors: res.data.fetch_colors,
                        stroke: {
                            width: 5,
                            colors: "#D69C4F"
                        },
                        dataLabels: {
                            enabled: false,
                            formatter: function(val, opt) {
                                return parseInt(val);
                            }
                        },
                        legend: {
                            show: false
                        },
                        grid: {
                            padding: {
                                top: 0,
                                bottom: 0,
                                right: 15
                            }
                        },
                        plotOptions: {
                            pie: {
                                donut: {
                                    size: '75%',
                                    labels: {
                                        show: true,
                                        value: {
                                            fontSize: '1.5rem',
                                            fontFamily: 'Public Sans',
                                            color: "#D69C4F",
                                            offsetY: -15,
                                            formatter: function(val) {
                                                return parseInt(val);
                                            }
                                        },
                                        name: {
                                            offsetY: 20,
                                            fontFamily: 'Public Sans'
                                        },
                                        total: {
                                            show: true,
                                            fontSize: '0.8125rem',
                                            color: "#D69C4F",
                                            label: "{{ getTranslatedWords('total') }}",
                                            formatter: function(w) {
                                                return res.data.total;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    };
                    statisticsChart = new ApexCharts(chartOrderStatistics, orderChartConfig2);
                    statisticsChart.render();
                    $('.orders_products_count').text(res.data.total)

                },

            });
        })
        var options = {
            series: [{
                name: "{{ getTranslatedWords('profit in month') }}",
                data: {!! json_encode($fetch_orders) !!}
            }],
            chart: {
                height: 350,
                type: 'bar',
            },
            plotOptions: {
                bar: {
                    borderRadius: 10,
                    dataLabels: {
                        position: 'top', // top, center, bottom
                    },
                }
            },
            colors: ["#D69C4F"],
            dataLabels: {
                enabled: true,
                formatter: function(val) {
                    return val + "{{ getTranslatedWords('' . settings('currency_code')) }}";
                },
                offsetY: -20,
                style: {
                    fontSize: '12px',
                    colors: ["#D69C4F"]
                }
            },

            xaxis: {
                categories: ["{{ getTranslatedWords('Jan') }}", "{{ getTranslatedWords('Feb') }}",
                    "{{ getTranslatedWords('Mar') }}", "{{ getTranslatedWords('Apr') }}",
                    "{{ getTranslatedWords('May') }}", "{{ getTranslatedWords('Jun') }}",
                    "{{ getTranslatedWords('Jul') }}", "{{ getTranslatedWords('Aug') }}",
                    "{{ getTranslatedWords('Sep') }}", "{{ getTranslatedWords('Oct') }}",
                    "{{ getTranslatedWords('Nov') }}", "{{ getTranslatedWords('Dec') }}"
                ],
                position: 'top',
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                },
                crosshairs: {
                    fill: {
                        type: 'gradient',
                        gradient: {
                            colorFrom: 'rgba(250, 246, 236, 1)',
                            colorTo: 'rgba(250, 246, 236, 1)',
                            stops: [0, 100],
                            opacityFrom: 0.4,
                            opacityTo: 0.5,
                        }
                    }
                },
                tooltip: {
                    enabled: true,
                }
            },
            yaxis: {
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false,
                },
                labels: {
                    show: false,
                    formatter: function(val) {
                        return val + "{{ getTranslatedWords('' . settings('currency_code')) }}";
                    }
                }

            },
            title: {
                text: '{{ getTranslatedWords('profits during the current year') }}',
                floating: true,
                offsetY: 330,
                align: 'center',
                style: {
                    color: '#444'
                }
            }
        };
        let chart;
        chart = new ApexCharts(document.querySelector("#totalProfit"), options);
        chart.render();

        $(document).on('click', '.profits_year', function() {
            var data = $(this).attr('data-year');

            var action = "{{ route('change_year_profit_report') }}";
            chart.destroy();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: action,
                type: 'POST',
                data: {
                    data: data
                },



                success: function(res) {


                    var options2 = {
                        series: [{
                            name: "{{ getTranslatedWords('profit in month') }}",
                            data: res
                        }],
                        chart: {
                            height: 350,
                            type: 'bar',
                        },
                        plotOptions: {
                            bar: {
                                borderRadius: 10,
                                dataLabels: {
                                    position: 'top', // top, center, bottom
                                },
                            }
                        },
                        colors: ["#D69C4F"],
                        dataLabels: {
                            enabled: true,
                            formatter: function(val) {
                                return val +
                                    "{{ getTranslatedWords('' . settings('currency_code')) }}";
                            },
                            offsetY: -20,
                            style: {
                                fontSize: '12px',
                                colors: ["#D69C4F"]
                            }
                        },

                        xaxis: {
                            categories: ["{{ getTranslatedWords('Jan') }}",
                                "{{ getTranslatedWords('Feb') }}",
                                "{{ getTranslatedWords('Mar') }}",
                                "{{ getTranslatedWords('Apr') }}",
                                "{{ getTranslatedWords('May') }}",
                                "{{ getTranslatedWords('Jun') }}",
                                "{{ getTranslatedWords('Jul') }}",
                                "{{ getTranslatedWords('Aug') }}",
                                "{{ getTranslatedWords('Sep') }}",
                                "{{ getTranslatedWords('Oct') }}",
                                "{{ getTranslatedWords('Nov') }}",
                                "{{ getTranslatedWords('Dec') }}"
                            ],
                            position: 'top',
                            axisBorder: {
                                show: false
                            },
                            axisTicks: {
                                show: false
                            },
                            crosshairs: {
                                fill: {
                                    type: 'gradient',
                                    gradient: {
                                        colorFrom: 'rgba(250, 246, 236, 1)',
                                        colorTo: 'rgba(250, 246, 236, 1)',
                                        stops: [0, 100],
                                        opacityFrom: 0.4,
                                        opacityTo: 0.5,
                                    }
                                }
                            },
                            tooltip: {
                                enabled: true,
                            }
                        },
                        yaxis: {
                            axisBorder: {
                                show: false
                            },
                            axisTicks: {
                                show: false,
                            },
                            labels: {
                                show: false,
                                formatter: function(val) {
                                    return val +
                                        "{{ getTranslatedWords('' . settings('currency_code')) }}";
                                }
                            }

                        },
                        title: {
                            text: '{{ getTranslatedWords('profits in year') }}' + ' ' +
                                data,
                            floating: true,
                            offsetY: 330,
                            align: 'center',
                            style: {
                                color: '#444'
                            }
                        }
                    };
                    if (chart) {

                        chart = new ApexCharts(document.querySelector("#totalProfit"), options2);
                        chart.render();
                    } else {
                        console.error("Chart instance is not initialized!");
                    }






                },

            });
        })
    </script>
@endsection

@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-4 col-md-12 col-4 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="{{ asset('new_assets/img/icons/unicons/chart-success.png') }}"
                                            alt="chart success" class="rounded" />
                                    </div>
                                    
                                     <div class="dropdown">
                              <button
                                class="btn p-0"
                                type="button"
                                id="cardOpt3"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                <a class="dropdown-item change_orders_count" data-show="all" href="javascript:void(0);">{{getTranslatedWords('all')}}</a>
                                <a class="dropdown-item change_orders_count" data-show="day" href="javascript:void(0);">{{getTranslatedWords('this day')}}</a>
                                <a class="dropdown-item change_orders_count" data-show="week" href="javascript:void(0);">{{getTranslatedWords('this week')}}</a>
                                <a class="dropdown-item change_orders_count" data-show="month" href="javascript:void(0);">{{getTranslatedWords('this month')}}</a>
                                <a class="dropdown-item change_orders_count" data-show="year" href="javascript:void(0);">{{getTranslatedWords('this year')}}</a>
                              </div>
                            </div>

                                </div>
                                <span class="fw-semibold d-block mb-1">{{ getTranslatedWords('orders') }}</span>
                                <h3 class="card-title mb-2 orders_count">{{ App\Models\Order::count() }}
                                </h3>
                                {{--<small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i>
                                    {{ getTranslatedWords('this month') }}
                                    {{ App\Models\Order::whereMonth('created_at', Carbon\Carbon::now()->month)->count() }}</small>--}}
                            </div>
                        </div>
                    </div>
            <div class="col-lg-4 col-md-12 col-4 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="{{ asset('new_assets/img/icons/unicons/chart.png') }}"
                                            alt="chart success" class="rounded" />
                                    </div>
                                    
                                     <div class="dropdown">
                              <button
                                class="btn p-0"
                                type="button"
                                id="cardOpt3"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                   <a class="dropdown-item change_customers_count" data-show="all" href="javascript:void(0);">{{getTranslatedWords('all')}}</a>
                                <a class="dropdown-item change_customers_count" data-show="day" href="javascript:void(0);">{{getTranslatedWords('this day')}}</a>
                                <a class="dropdown-item change_customers_count" data-show="week" href="javascript:void(0);">{{getTranslatedWords('this week')}}</a>
                                <a class="dropdown-item change_customers_count" data-show="month" href="javascript:void(0);">{{getTranslatedWords('this month')}}</a>
                                <a class="dropdown-item change_customers_count" data-show="year" href="javascript:void(0);">{{getTranslatedWords('this year')}}</a>
                              </div>
                            </div>

                                </div>
                                <span class="fw-semibold d-block mb-1">{{ getTranslatedWords('customers') }}</span>
                                <h3 class="card-title mb-2 customers_count">{{ App\Models\Customer::count() }}
                                </h3>
                                {{--<small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i>
                                    {{ getTranslatedWords('this month') }}
                                    {{ App\Models\Order::whereMonth('created_at', Carbon\Carbon::now()->month)->count() }}</small>--}}
                            </div>
                        </div>
                    </div>
            <div class="col-lg-4 col-md-12 col-4 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="{{ asset('new_assets/img/icons/unicons/wallet-info.png') }}"
                                            alt="Credit Card" class="rounded" />
                                    </div>
                                    
                                    <div class="dropdown">
                              <button
                                class="btn p-0"
                                type="button"
                                id="cardOpt3"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                <a class="dropdown-item change_profits_count" data-show="day" href="javascript:void(0);">{{getTranslatedWords('this day')}}</a>
                                <a class="dropdown-item change_profits_count" data-show="week" href="javascript:void(0);">{{getTranslatedWords('this week')}}</a>
                                <a class="dropdown-item change_profits_count" data-show="month" href="javascript:void(0);">{{getTranslatedWords('this month')}}</a>
                                <a class="dropdown-item change_profits_count" data-show="year" href="javascript:void(0);">{{getTranslatedWords('this year')}}</a>
                              </div>
                            </div>

                                </div>
                                <span>{{ getTranslatedWords('profits') }}</span>
                                <h3 class="card-title mb-1 profits_count">{{ App\Models\Order::sum('total_price') }}
                                    {{ getTranslatedWords('L.E') }}</h3>
                                {{--<small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i>
                                    {{ getTranslatedWords('this month') }}
                                    {{ App\Models\Order::whereMonth('created_at', Carbon\Carbon::now()->month)->sum('total') }}</small> --}}
                            </div>
                        </div>
                    </div>
            <!-- Total Revenue -->
            <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
                <div class="card">
                    <div class="row row-bordered g-0">
                        <div class="col-md-12">
                            
                            <h5 class="card-header m-0 me-2 pb-3 d-flex align-items-start justify-content-between">
                                <span>{{ getTranslatedWords('profits in year') }} <span class="profits_year">{{date('Y')}}</span></span>
                                
                                <div class="text-center">
                            <div class="dropdown">
                              <button
                                class="btn btn-sm btn-outline-primary dropdown-toggle"
                                type="button"
                                id="growthReportId"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                              >
                                {{date('Y')}}
                              </button>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="growthReportId">
                                 @foreach($years as $y)
                                <a class="dropdown-item profits_year" data-year="{{$y}}" href="javascript:void(0);">{{$y}}</a>
                                @endforeach
                              </div>
                            </div>
                          </div>
                            </h5>
                            <div id="totalProfit" class="px-2"></div>
                        </div>

                    </div>
                </div>
            </div>
            <!--/ Total Revenue -->

        </div>


        <div class="row">
            <!-- Order Statistics -->
            <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between pb-0">
                        <div class="card-title mb-0">
                            <h5 class="m-0 me-2">{{ getTranslatedWords('Order Statistics') }}</h5>
                            <small class="text-muted"><span class="orders_products_count">{{ App\Models\Order::count() }}</span>
                                {{ getTranslatedWords('total orders') }}</small>
                        </div>
                        
                        <div class="dropdown">
                              <button
                                class="btn p-0"
                                type="button"
                                id="cardOpt3"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                <a class="dropdown-item change_categories_count" data-show="day" href="javascript:void(0);">{{getTranslatedWords('this day')}}</a>
                                <a class="dropdown-item change_categories_count" data-show="week" href="javascript:void(0);">{{getTranslatedWords('this week')}}</a>
                                <a class="dropdown-item change_categories_count" data-show="month" href="javascript:void(0);">{{getTranslatedWords('this month')}}</a>
                                <a class="dropdown-item change_categories_count" data-show="year" href="javascript:void(0);">{{getTranslatedWords('this year')}}</a>
                              </div>
                            </div>

                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex flex-column align-items-center gap-1">
                                <h2 class="mb-2 orders_products_count">{{ App\Models\Order::count() }}</h2>
                                <span>{{ getTranslatedWords('total orders') }}</span>
                            </div>
                            
                            
                                     
                            
                           
                            <div id="orderStatisticsChart2"></div>
                        </div>
                         <h5 class="mb-2">{{ getTranslatedWords('products orders in categories') }}</h5>
                        <ul class="p-0 m-0 changed_content">
                            @foreach (App\Models\Category::take(6)->get() as $key=> $category)
                                <li class="d-flex mb-4 pb-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded"
                                        style="background-color: {{ $fetch_colors[$key] }}"
                                        >
                                        <img class="img-fluid" src="{{ route('file_show', [$category->image, 'categories']) }}" alt="">
                                    </span>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">{{ $category->name }}</h6>
                                        </div>
                                        <div class="user-progress">
                                            <small class="fw-semibold">
                                                {{ App\Models\OrderProduct::whereHas('product', function ($q) use ($category) {
                                                    $q->whereJsonContains('categories', $category->id);
                                                })->count() }}
                                            </small>
                                        </div>
                                    </div>
                                </li>
                            @endforeach


                        </ul>
                    </div>
                </div>
            </div>
            <!--/ Order Statistics -->

            <!-- Expense Overview -->
            <div class="col-md-6 col-lg-8 order-1 mb-4">
                <div class="card">
                    <h5 class="card-header">{{getTranslatedWords('latest orders')}}</h5>
                    <div class="table-responsive text-nowrap">
                        <table class="table" id="datatables">
                            <thead>
                                <tr>
                                   
                                    <th>{{getTranslatedWords('customer')}}</th>
                                    <th>{{getTranslatedWords('phone')}}</th>
                                    <th>{{getTranslatedWords('address')}}</th>
                                    <th>{{getTranslatedWords('date')}}</th>
                                   
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach (App\Models\Order::latest()->take(15)->get() as $query)
                                    <tr>
                                        <td>{{ $query->customer->name }}</td>
                                        <td>{{ $query->customer->phone }}</td>
                                        <td>{{ $query->customer->address }}</td>
                                        <td>{{ $query->created_at->format('Y-m-d') }}</td>
                                       
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--/ Expense Overview -->


        </div>
    </div>
    <!-- / Content -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->


    


@endsection
