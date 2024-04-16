@extends('dashboard.core.app')
@section('title', __('titles.t-Details', ['t' => $currentRole->t('display_name')]))

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ $currentRole->t('display_name') }}</h1>
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
                            <h3 class="card-title">{{ __('titles.t-Details', ['t' => $currentRole->t('display_name')]) }}</h3>
                        </div>
                        <div class="card-body">
                            <div class="col-12 mt-3 row">


                                <div class="card card-dark col-12">
                                    <div class="card-header">
                                        <h3 class="card-title">@lang('dashboard.details')</h3>
                                    </div>

                                    <div class="card-body row">

                                        @if($manager->image)
                                            <div class="col-1 mt-3">
                                                <img class='img-fluid img-thumbnail' src="{{ $manager->image ?? '' }}" />
                                            </div>
                                        @endif
                                        <div class="col-10 row mt-3">
                                            <div class="col-6">
                                                <strong><i class="fas fa-user ml-1 mr-1"></i>{{$manager->name}}</strong>
                                            </div>
                                            <div class="col-6">
                                                <strong><i class="fas fa-envelope ml-1 mr-1"></i>{{$manager->email}}</strong>
                                            </div>
                                            <div class="col-6">
                                                <strong><i class="fas fa-phone ml-1 mr-1"></i>{{$manager->phone ?? __('dashboard.none')}}</strong>
                                            </div>

                                            <div class="col-6">
                                                <strong><i class="fas fa-male ml-1 mr-1"></i>@lang('db.gender.'.$manager->gender)</strong>
                                            </div>
                                        </div>



                                    </div>

                                </div>

                            </div>

                            @if($manager->cv_pdf !== null)
                                <div class="col-4">
                                    <h6>@lang('dashboard.cv_pdf')</h6>
                                    <a download="" href="{{ $manager->cv_pdf }}" width="200px" ><button class="btn btn-success"><i class="fa fa-file-download"></i></button></a>
                                </div>
                            @endif
                            <div class="col-4">
                                <h6>@lang('dashboard.cv_description')</h6>
                                <p>
                                    {!! $manager->cv_description !!}
                                </p>
                            </div>
                        </div>
                    </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
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
