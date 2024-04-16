@extends('dashboard.core.app')
@section('title', __('titles.Coupon Details'))

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.coupons')</h1>
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
                            <h3 class="card-title">@lang('titles.Coupon Details')</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-dark">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center">@lang('dashboard.Coupon')</span>
                                            <span class="info-box-number text-center mb-0">{{$coupon->coupon}}</span>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-dark">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center">@lang('dashboard.discount')</span>
                                            <span class="info-box-number text-center mb-0">{{$coupon->discount}} %</span>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-dark">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center">@lang('dashboard.max_uses')</span>
                                            <span class="info-box-number text-center mb-0">{{$coupon->max_uses}}</span>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-dark">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center">@lang('dashboard.type')</span>
                                            <span class="info-box-number text-center mb-0">
                                                {{$coupon->couponable_type == null ? __('dashboard.all_items') : __('dashboard.one_item')}}
                                            </span>

                                        </div>
                                    </div>
                                </div>

                                @if($coupon->couponable_type != null)
                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-dark">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center">{{$coupon->couponable_type == "App\Models\Course" ? __('dashboard.course') : __('dashboard.Book')}}</span>
                                            <span class="info-box-number text-center mb-0">
                                                   {{$coupon->couponable->t('name')}}
                                            </span>

                                        </div>
                                    </div>
                                </div>
                                @endif

                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-dark">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center">@lang('dashboard.used_time_count')</span>
                                            <span class="info-box-number text-center mb-0">
                                                {{$coupon->carts->count() + $coupon->cartItems->count()}}
                                            </span>

                                        </div>
                                    </div>
                                </div>






                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <div class="col-12">
                        <h3>@lang('dashboard.coupon_uses')</h3>
                        <div class="col-12 mt-5">
                            <table class="table table-bordered">
                                <thead class="table-dark">


                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>@lang('dashboard.student')</th>
                                    <th>@lang('dashboard.use_date')</th>
                                    <th>@lang('dashboard.status')</th>
                                </tr>
                                </thead>
                                <tbody>


                                    @forelse(collect($coupon->carts)->merge($coupon->cartItems) as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{$item->cart?->user->name ?? $item->user?->name}}</td>
                                            <td>{{$item->updated_at->diffForHumans()}}</td>
                                            <td>
                                                {{$item->cart?->deleted_at != null || $item->deleted_at != null ? __('dashboard.not_paid') : __('dashboard.paid') }}
                                            </td>

                                        </tr>
                                    @empty
                                        @include('dashboard.core.includes.no-entries', ['columns' => 6])
                                    @endforelse
                                </tbody>
                            </table>

                        </div>

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
