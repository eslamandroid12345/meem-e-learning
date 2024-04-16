
@extends('dashboard.core.app')
@section('title', __('dashboard.courses_subscriptions'))
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.courses_subscriptions')</h1>
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
                            <h3 class="card-title">@lang('dashboard.courses_subscriptions')</h3>
                            <div class="card-tools">
                                <a  href="{{ route('courses_subscriptions.export', ['excel', ...request()->query()]) }}" class="btn  btn-success">@lang('dashboard.Excel Export')</a>
                                <a  href="{{ route('courses_subscriptions.export', ['pdf', ...request()->query()]) }}" class="btn  btn-danger">@lang('dashboard.PDF Export')</a>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-body">
                            <form action="{{route('courses_subscriptions.index')}}">
                                <div class="row">

                                    <div class="form-group col-2">
                                        <select name="course" class="form-control">
                                            <option value="ALL">@lang('dashboard.all_items')</option>
                                            @foreach($fields as $field)
                                                <optgroup label="{{$field->t('name')}}">
                                                    @foreach($field->categories as $category)
                                                        @foreach($category->courses as $course)
                                                            <option @selected(request('course') == $course->id) value="{{$course->id}}">{{$course->t('name')}}</option>
                                                        @endforeach
                                                    @endforeach
                                                </optgroup>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-3">
                                        <input value="{{request('search') ?? ""}}" name="search" type="search" class="form-control" placeholder="@lang('dashboard.search_with_phone_number_or_name_or_email')">
                                    </div>


                                    <div class="form-group col-2">
                                        <input value="{{request('from_date') ?? ""}}" name="from_date" type="date" class="form-control" placeholder="@lang('dashboard.search_with_phone_number_or_name_or_email')">
                                    </div>
                                    <p class="mt-2">@lang('dashboard.to')</p>

                                    <div class="form-group col-2">
                                        <input value="{{request('to_date') ?? ""}}" name="to_date" type="date" class="form-control" placeholder="@lang('dashboard.search_with_phone_number_or_name_or_email')">
                                    </div>


                                    <div class="form-group col-2">
                                        <button type="submit" class="btn btn-dark">@lang('dashboard.filter')</button>
                                    </div>
                                </div>
                            </form>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>@lang('dashboard.Student')</th>
                                    <th>@lang('dashboard.Course')</th>
                                    <th>@lang('dashboard.Activation')</th>
{{--                                    <th>@lang('dashboard.Operations')</th>--}}
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($subscriptions as $key => $subscription)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{$subscription->user?->name}}</td>
                                        <td>{{$subscription->course?->t('name')}}</td>
                                        <td>
                                            @if($subscription->is_active)
                                                <button class="btn btn-danger waves-effect waves-light" data-toggle="modal" data-target="#delete-modal{{$key}}">@lang('dashboard.deActivate')</button>
                                                <div id="delete-modal{{$key}}" class="modal fade modal2 " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content float-left">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">@lang('dashboard.deActivate')</h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>@lang('dashboard.Are You Sure You Want To De Activate This Subscription')</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" data-dismiss="modal" class="btn btn-dark waves-effect waves-light m-l-5 mr-1 ml-1">
                                                                    @lang('dashboard.close')
                                                                </button>
                                                                <form action="{{route('subscription.toggle' , $subscription['id'])}}" method="post">
                                                                    @csrf
                                                                    {{method_field('PUT')}}
                                                                    <button type="submit" class="btn btn-danger">@lang('dashboard.deActivate')</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <button class="btn btn-dark waves-effect waves-light" data-toggle="modal" data-target="#delete-modal{{$key}}">@lang('dashboard.Activate')</button>
                                                <div id="delete-modal{{$key}}" class="modal fade modal2 " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content float-left">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">@lang('dashboard.Activate')</h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>@lang('dashboard.Are You Sure You Want To Activate This Subscription')</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" data-dismiss="modal" class="btn btn-dark waves-effect waves-light m-l-5 mr-1 ml-1">
                                                                    @lang('dashboard.close')
                                                                </button>
                                                                <form action="{{route('subscription.toggle' , $subscription['id'])}}" method="post">
                                                                    @csrf
                                                                    {{method_field('PUT')}}
                                                                    <button type="submit" class="btn btn-danger">@lang('dashboard.Activate')</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                                <button class="btn btn-dark waves-effect waves-light" data-toggle="modal" data-target="#delete-modal11{{$key}}">@lang('dashboard.delete_subscription')</button>
                                                <div id="delete-modal11{{$key}}" class="modal fade modal2 " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content float-left">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">@lang('dashboard.delete_subscription')</h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>@lang('dashboard.Are You Sure You Want To Delete This Subscription')</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" data-dismiss="modal" class="btn btn-dark waves-effect waves-light m-l-5 mr-1 ml-1">
                                                                    @lang('dashboard.close')
                                                                </button>
                                                                <form action="{{route('subscription.destroy' , $subscription['id'])}}" method="post">
                                                                    @csrf
                                                                    {{method_field('DELETE')}}
                                                                    <button type="submit" class="btn btn-danger">@lang('dashboard.delete_subscription')</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </td>

                                    </tr>
                                @empty
                                    @include('dashboard.core.includes.no-entries', ['columns' => 6])
                                @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="card-footer">
                            {{ $subscriptions->appends(request()->all())->links() }}
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
