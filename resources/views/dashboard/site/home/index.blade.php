@extends('dashboard.core.app')
@section('title', __('titles.Home'))
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    {{--                    <h1>@lang('dashboard.Home')</h1>--}}
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                @if(auth()->user()->hasPermission('courses-read'))
                    <div class=" col-4">
                        <div class="small-box bg-dark text-center">
                            <div class="inner p-3">
                                <h2 class="mb-3">@lang('dashboard.courses')</h2>
                                <h3>{{$coursesCount}}</h3>

                            </div>
                            <a href="{{route('courses.index')}}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                @endif

                @if(auth()->user()->hasPermission('students-read'))
                    <div class=" col-4">
                        <div class="small-box bg-dark text-center">
                            <div class="inner p-3">
                                <h2 class="mb-3">@lang('dashboard.students')</h2>
                                <h3>{{$studentsCount}}</h3>

                            </div>
                            <a href="{{route('student.index')}}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                @endif

                @if(auth()->user()->hasPermission('teachers-read'))
                    <div class=" col-4">
                        <div class="small-box bg-dark text-center">
                            <div class="inner p-3">
                                <h2 class="mb-3">@lang('dashboard.teachers')</h2>
                                <h3>{{$teachersCount}}</h3>

                            </div>
                            <a href="{{route('teachers.index')}}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                @endif

                @if(auth()->user()->hasPermission('exams-read'))
                    <div class=" col-4">
                        <div class="small-box bg-dark text-center">
                            <div class="inner p-3">
                                <h2 class="mb-3">@lang('dashboard.exams')</h2>
                                <h3>{{$examsCount}}</h3>

                            </div>
                            <a href="{{route('exams.index')}}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                @endif

                @if(auth()->user()->hasPermission('payments-read'))
                    <div class=" col-4">
                        <div class="small-box bg-dark text-center">
                            <div class="inner p-3">
                                <h2 class="mb-3">@lang('dashboard.payments')</h2>
                                <h3>{{$paymentsCount}}</h3>

                            </div>
                            <a href="{{route('payments.index')}}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                @endif

                @if(auth()->user()->hasPermission('printRequests-read'))
                    <div class=" col-4">
                        <div class="small-box bg-dark text-center">
                            <div class="inner p-3">
                                <h2 class="mb-3">@lang('dashboard.waiting_print_requests')</h2>
                                <h3>{{$waitingPrintOrdersCount}}</h3>

                            </div>
                            <a href="{{route('requests.books.index')}}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                @endif

                @if(auth()->user()->hasPermission('payments-read'))
                    <div class="container">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">@lang('dashboard.Payers Count')</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>@lang('dashboard.Name')</th>
                                        <th>@lang('dashboard.Total Count')</th>
                                        <th>@lang('dashboard.Electronic Count')</th>
                                        <th>@lang('dashboard.Tamara Count')</th>
                                        <th>@lang('dashboard.Bank Transfer Count')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($courses as $key => $course)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{$course->t('name')}}</td>
                                            <td>{{$course->paymentsCount()}}</td>
                                            <td>{{$course->paymentsCount('EPAYMENT')}}</td>
                                            <td>{{$course->paymentsCount('TAMARA')}}</td>
                                            <td>{{$course->paymentsCount('CASH')}}</td>
                                        </tr>
                                    @empty
                                        @include('dashboard.core.includes.no-entries', ['columns' => 6])
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                    {{--                    <div class="chart" style="width: 100%; height: 500px">--}}
                    {{--                        <canvas id="areaChart7"></canvas>--}}
                    {{--                    </div>--}}
                @endif
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('js_addons')
{{--    <script>--}}
{{--        $(function () {--}}
{{--            /* ChartJS--}}
{{--             * ---------}}
{{--             * Here we will create a few charts using ChartJS--}}
{{--             */--}}

{{--            //----------------}}
{{--            //- AREA CHART ---}}
{{--            //----------------}}

{{--            // Get context with jQuery - using jQuery's .get() method.--}}

{{--            const courses = [];--}}
{{--            const cashPayments = [];--}}
{{--            const ePyaments = [];--}}
{{--            @foreach($courses as $course)--}}
{{--            courses.push("{{$course->t('name') }}")--}}
{{--            cashPayments.push({{ $course->paymentsCount("CASH")  }})--}}
{{--            ePyaments.push({{ $course->paymentsCount("EPAYMENT")  }})--}}
{{--            @endforeach--}}
{{--            var areaChartData = {--}}
{{--                labels: courses,--}}
{{--                datasets: [--}}
{{--                    {--}}
{{--                        label: 'Electronic Payment',--}}
{{--                        backgroundColor: 'rgba(60,141,188,0.9)',--}}
{{--                        borderColor: 'rgba(60,141,188,0.8)',--}}
{{--                        pointRadius: false,--}}
{{--                        pointColor: '#3b8bba',--}}
{{--                        pointStrokeColor: 'rgba(60,141,188,1)',--}}
{{--                        pointHighlightFill: '#fff',--}}
{{--                        pointHighlightStroke: 'rgba(60,141,188,1)',--}}
{{--                        data: ePyaments--}}
{{--                    },--}}
{{--                    {--}}
{{--                        label: 'Cash Payment',--}}
{{--                        backgroundColor: 'rgba(210, 214, 222, 1)',--}}
{{--                        borderColor: 'rgba(210, 214, 222, 1)',--}}
{{--                        pointRadius: false,--}}
{{--                        pointColor: 'rgba(210, 214, 222, 1)',--}}
{{--                        pointStrokeColor: '#c1c7d1',--}}
{{--                        pointHighlightFill: '#fff',--}}
{{--                        pointHighlightStroke: 'rgba(220,220,220,1)',--}}
{{--                        data: cashPayments--}}
{{--                    },--}}
{{--                ]--}}
{{--            }--}}


{{--            //---------------}}
{{--            //- BAR CHART ---}}
{{--            //---------------}}
{{--            var barChartData = $.extend(true, {}, areaChartData)--}}
{{--            var temp0 = areaChartData.datasets[0]--}}
{{--            var temp1 = areaChartData.datasets[1]--}}
{{--            barChartData.datasets[0] = temp1--}}
{{--            barChartData.datasets[1] = temp0--}}


{{--            //-----------------------}}
{{--            //- STACKED BAR CHART ---}}
{{--            //-----------------------}}
{{--            var stackedBarChartCanvas = $('#areaChart7').get(0).getContext('2d')--}}
{{--            var stackedBarChartData = $.extend(true, {}, barChartData)--}}

{{--            var stackedBarChartOptions = {--}}
{{--                responsive: true,--}}
{{--                maintainAspectRatio: false,--}}
{{--                scales: {--}}
{{--                    xAxes: [{--}}
{{--                        stacked: true,--}}
{{--                    }],--}}
{{--                    yAxes: [{--}}
{{--                        stacked: true--}}
{{--                    }]--}}
{{--                }--}}
{{--            }--}}

{{--            new Chart(stackedBarChartCanvas, {--}}
{{--                type: 'bar',--}}
{{--                data: stackedBarChartData,--}}
{{--                options: stackedBarChartOptions--}}
{{--            })--}}
{{--        })--}}
{{--    </script>--}}
@endsection
