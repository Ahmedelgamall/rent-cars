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
    
@endsection

@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-4 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="{{ asset('new_assets/img/icons/unicons/chart-success.png') }}"
                                            alt="chart success" class="rounded" />
                                    </div>
                                    
                                    

                                </div>
                                <span class="fw-semibold d-block mb-1">{{ getTranslatedWords('orders') }}</span>
                                <h3 class="card-title mb-2 orders_count">{{ App\Models\CarOrder::count() }}
                                </h3>
                                {{--<small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i>
                                    {{ getTranslatedWords('this month') }}
                                    {{ App\Models\Order::whereMonth('created_at', Carbon\Carbon::now()->month)->count() }}</small>--}}
                            </div>
                        </div>
                    </div>
            <div class="col-lg-6 col-md-12 col-4 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="{{ asset('new_assets/img/icons/unicons/chart.png') }}"
                                            alt="chart success" class="rounded" />
                                    </div>
                                    

                                </div>
                                <span class="fw-semibold d-block mb-1">{{ getTranslatedWords('cars') }}</span>
                                <h3 class="card-title mb-2 customers_count">{{ App\Models\Car::count() }}
                                </h3>
                                {{--<small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i>
                                    {{ getTranslatedWords('this month') }}
                                    {{ App\Models\Order::whereMonth('created_at', Carbon\Carbon::now()->month)->count() }}</small>--}}
                            </div>
                        </div>
                    </div>
           
            <!-- Total Revenue -->
           
            <!--/ Total Revenue -->

        </div>


        <div class="row">
            

            <!-- Expense Overview -->
            <div class="col-md-12 order-1 mb-4">
                <div class="card">
                    <h5 class="card-header">{{getTranslatedWords('latest orders')}}</h5>
                    <div class="table-responsive text-nowrap">
                        <table class="table" id="datatables">
                            <thead>
                                <tr>
                                   
                                    <th>{{getTranslatedWords('name')}}</th>
                                    <th>{{getTranslatedWords('phone')}}</th>
                                    <th>{{getTranslatedWords('email')}}</th>
                                    <th>{{getTranslatedWords('car')}}</th>
                                    <th>{{getTranslatedWords('date')}}</th>
                                   
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach (App\Models\CarOrder::latest()->take(15)->get() as $query)
                                    <tr>
                                        <td>{{ $query->name }}</td>
                                        <td>{{ $query->phone }}</td>
                                        <td>{{ $query->email }}</td>
                                        <td>{{ $query->car->title }}</td>
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
