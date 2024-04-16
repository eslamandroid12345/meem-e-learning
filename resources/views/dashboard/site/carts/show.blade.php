@extends('dashboard.core.app')
@section('title', __('titles.Cart Details'))

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.carts')</h1>
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
                            <h3 class="card-title">@lang('titles.Cart Details')</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-dark">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center">@lang('dashboard.student')</span>
                                            <span class="info-box-number text-center mb-0">{{$cart->user?->name}}</span>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-dark">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center">@lang('dashboard.created_at')</span>
                                            <span class="info-box-number text-center mb-0">{{$cart->created_at->diffForHumans()}}</span>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-dark">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center">@lang('dashboard.items_count')</span>
                                            <span class="info-box-number text-center mb-0">{{$cart->items?->count()}}</span>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-dark">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center">@lang('dashboard.total_amount')</span>
                                            <span class="info-box-number text-center mb-0">{{$cart->items->sum('amount')}}</span>

                                        </div>
                                    </div>
                                </div>
                            </div>

                                <div class="row">

                                    <div class="col-6">
                                        <h4>@lang('dashboard.courses')</h4>
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th style="width: 10px">#</th>
                                                <th>@lang('dashboard.Course')</th>
                                                <th>@lang('dashboard.Coupon')</th>
                                                <th>@lang('dashboard.amount')</th>
                                                <th>@lang('dashboard.created_at')</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($cart->items->where('cartable_type' , 'App\Models\Course') as $key => $item)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td><a target="_blank" href="{{route('courses.show' , $item['cartable_id'])}}">{{$item->cartable->t('name')}}</a></td>
                                                    <td>{{$item->coupon->coupon ?? __('dashboard.none')}}</td>
                                                    <td>{{$item->amount}} @lang('dashboard.riyal')</td>
                                                    <td>{{$item->created_at->diffForHumans()}}</td>
                                                </tr>
                                            @empty
                                                @include('dashboard.core.includes.no-entries', ['columns' => 6])
                                            @endforelse
                                            </tbody>
                                        </table>

                                    </div>

                                    <div class="col-6">
                                        <h4>@lang('dashboard.books')</h4>
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th style="width: 10px">#</th>
                                                <th>@lang('dashboard.Book')</th>
                                                <th>@lang('dashboard.Coupon')</th>
                                                <th>@lang('dashboard.amount')</th>
                                                <th>@lang('dashboard.created_at')</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($cart->items->where('cartable_type' ,'App\Models\CourseBook') as $key => $item)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td><p>{{$item->cartable->course?->t('name')}} - {{ $item->cartable->id}}</p></td>
                                                    <td>{{$item->coupon->coupon ?? __('dashboard.none')}}</td>
                                                    <td>{{$item->amount}} @lang('dashboard.riyal')</td>

                                                    <td>{{$item->created_at->diffForHumans()}}</td>
                                                </tr>
                                            @empty
                                                @include('dashboard.core.includes.no-entries', ['columns' => 6])
                                            @endforelse
                                            </tbody>
                                        </table>

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
