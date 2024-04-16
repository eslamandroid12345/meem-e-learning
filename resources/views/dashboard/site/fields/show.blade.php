@extends('dashboard.core.app')
@section('title', __('titles.Field Details'))

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.fields')</h1>
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
                            <h3 class="card-title">@lang('titles.Field Details')</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">



                                <div class="col-md-10">
                                    <div class="row">
                                        <div class="col-12 col-sm-4">
                                            <div class="info-box bg-dark">
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-center">@lang('dashboard.Name')</span>
                                                    <span class="info-box-number text-center mb-0">
                                                           {{ $field->t('name') }}
                                                        </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-4">
                                            <div class="info-box bg-dark">
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-center">@lang('dashboard.categories')</span>
                                                    <span class="info-box-number text-center mb-0">
                                                            @forelse($field->categories as $category)
                                                            <a href="{{route('categories.show' , $category->id)}}">{{$category->t('name')}}</a> {{ !$loop->last ? ', ' : '' }}
                                                        @empty
                                                            @lang('dashboard.none')
                                                        @endforelse
                                                        </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-4">
                                            <div class="info-box bg-dark">
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-center">@lang('dashboard.Activation')</span>
                                                    <span class="info-box-number text-center mb-0">
                                                           {{ $field->is_active ? __('dashboard.active') : __('dashboard.in_active')}}
                                                        </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <img src="{{ $field->image }}" width="200px" />
                                        </div>



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
