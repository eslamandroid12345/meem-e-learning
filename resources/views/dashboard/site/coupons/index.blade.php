@php use Illuminate\Support\Facades\Gate; @endphp
@extends('dashboard.core.app')
@section('title', __('titles.Coupons'))
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.Coupons')</h1>
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
                            <h3 class="card-title">@lang('dashboard.Coupons')</h3>
                            <div class="card-tools">
                                @if(auth()->user()->hasPermission('coupons-create'))
                                    <a href="{{route('coupons.create')}}" class="btn  btn-dark">@lang('dashboard.Create')</a>
                                @endif
                                    <a  href="{{ route('coupons.export', ['excel', ...request()->query()]) }}" class="btn  btn-success">@lang('dashboard.Excel Export')</a>
                                    <a  href="{{ route('coupons.export', ['pdf', ...request()->query()]) }}" class="btn  btn-danger">@lang('dashboard.PDF Export')</a>

                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>@lang('dashboard.Coupon')</th>
                                    <th>@lang('dashboard.discount')</th>
                                    <th>@lang('dashboard.use_times')</th>
                                    <th>@lang('dashboard.max_uses')</th>
{{--                                    <th>@lang('dashboard.Course') / @lang('dashboard.Book')</th>--}}
                                    <th>@lang('dashboard.Operations')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($coupons as $key => $coupon)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{$coupon->coupon}}</td>
                                        <td>{{$coupon->discount }} %</td>
                                        <td>{{$coupon->uses()->count() }}</td>
                                        <td>{{$coupon->max_uses ?? __('dashboard.none') }}</td>
{{--                                        <td>--}}
{{--                                            @if($coupon->couponable_type == 'App\Models\Course')--}}
{{--                                                <a target="_blank" href="{{route('courses.show' , $coupon->couponable_id)}}">{{$coupon->couponable->t('name')}}</a>--}}
{{--                                            @else--}}
{{--                                                <p>{{$coupon->couponable->course->t('name')}} - {{ $coupon->couponable->id}}</p>--}}
{{--                                            @endif--}}
{{--                                        </td>--}}
                                        <td>
                                            <div class="operations-btns" style="">
                                                @if(auth()->user()->hasPermission('coupons-update'))
                                                    <a href="{{ route('coupons.edit', $coupon['id']) }}" class="btn  btn-dark">@lang('dashboard.Edit')</a>
                                                @endif
{{--                                                <a href="{{ route('coupons.show', $coupon['id']) }}" class="btn  btn-dark">@lang('dashboard.Show')</a>--}}

                                                @if(auth()->user()->hasPermission('coupons-delete'))
                                                    <button class="btn btn-dark waves-effect waves-light" data-toggle="modal" data-target="#delete-modal{{$key}}">@lang('dashboard.Delete')</button>
                                                    <div id="delete-modal{{$key}}" class="modal fade modal2 " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content float-left">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">@lang('dashboard.confirm_delete')</h5>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>@lang('dashboard.sure_delete')</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" data-dismiss="modal" class="btn btn-dark waves-effect waves-light m-l-5 mr-1 ml-1">
                                                                        @lang('dashboard.close')
                                                                    </button>
                                                                    <form action="{{route('coupons.destroy' , $coupon['id'])}}" method="post">
                                                                        @csrf
                                                                        {{method_field('DELETE')}}
                                                                        <button type="submit" class="btn btn-danger">@lang('dashboard.Delete')</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    @include('dashboard.core.includes.no-entries', ['columns' => 4])
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            {{ $coupons->links() }}
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
