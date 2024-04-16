@extends('dashboard.core.app')
@section('title', __('titles.t-Details', ['t' => __('titles.Lecture')]))

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.Lectures')</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{__('titles.t-Details', ['t' => __('titles.Lecture')])}}</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-4">
                                            <h6>@lang('dashboard.Lecture Current Type')</h6>
                                            <h5>@lang('db.lecture_type.'.$lecture->type)</h5>
                                        </div>
                                        <div class="col-4">
                                            <h6>@lang('dashboard.Name Ar')</h6>
                                            <h5>{{ $lecture->name_ar }}</h5>
                                        </div>
                                        <div class="col-4">
                                            <h6>@lang('dashboard.Name En')</h6>
                                            <h5>{{ $lecture->name_en }}</h5>
                                        </div>
                                    </div>
                                    @isset($lecture->live_link)
                                        <div class="row">
                                            <div class="col-6">
                                                <h6>@lang('dashboard.Live Lecture Link')</h6>
                                                <h5><a href="{{ $lecture->live_link }}">{{ $lecture->live_link }}</a></h5>
                                            </div>
                                            <div class="col-3">
                                                <h6>@lang('dashboard.Starts At')</h6>
                                                <h5>{{ $lecture->starts_at }}</h5>
                                            </div>
                                            <div class="col-3">
                                                <h6>@lang('dashboard.Ends At')</h6>
                                                <h5>{{ $lecture->ends_at }}</h5>
                                            </div>
                                        </div>
                                    @endisset
                                    @isset($lecture->record_link)
                                        <div class="row">
                                            <div class="col-4">
                                                <h6>@lang('dashboard.Recorded Lecture Link')</h6>
                                                <h5><a href="{{ $lecture->record_link }}">{{ $lecture->record_link }}</a></h5>
                                            </div>
                                            <div class="col-4">
                                                <h6>@lang('dashboard.Publish At')</h6>
                                                <h5>{{ $lecture->publish_at }}</h5>
                                            </div>
                                        </div>
                                    @endisset
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    @isset($lecture->pins)
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{__('dashboard.Lecture Pins')}}</h3>
                            </div>
                            <div class="card-body">
                                @foreach($lecture->pins as $pin)
                                    <div class="row">
                                        <div class="col-4">
                                            <h6>@lang('dashboard.Pin Name')</h6>
                                            <h5>{{ $pin->t('name') }}</h5>
                                        </div>
                                        <div class="col-4">
                                            <h6>@lang('dashboard.Pin Description')</h6>
                                            <h5>{{ $pin->t('description') }}</h5>
                                        </div>
                                        <div class="col-4">
                                            <h6>@lang('dashboard.Pin Time')</h6>
                                            <h5>{{ $pin->time }}</h5>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endisset
                    @isset($lecture->pins)
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{__('dashboard.Lecture Indicators')}}</h3>
                            </div>
                            <div class="card-body">
                                @isset($lecture->indicators)
                                    @foreach($lecture->indicators as $indicator)
                                        <div class="row">
                                            <div class="col-1"><h6>@lang('dashboard.Indicator Name')</h6></div>
                                            <div class="col-11"><h5>{{ $indicator->t('name') }}</h5></div>
                                        </div>
                                    @endforeach
                                @endisset
                            </div>
                        </div>
                    @endisset

                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
