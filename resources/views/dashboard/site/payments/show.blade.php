@php use App\Models\Course;use App\Models\CourseBook;use Carbon\Carbon; @endphp
@extends('dashboard.core.app')
@section('title', __('titles.t-Details', ['t' => __('titles.Payment')]))

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.Payments')</h1>
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
                            <h3 class="card-title">{{__('titles.t-Details', ['t' => __('titles.Payment')])}}</h3>
                        </div>
                        <div class="card-body">
{{--                            <table class="table table-bordered">--}}
{{--                                <tbody>--}}
{{--                                <tr>--}}
{{--                                    <td></td>--}}
{{--                                    <td></td>--}}
{{--                                    <td></td>--}}
{{--                                    <td></td>--}}
{{--                                </tr>--}}
{{--                                </tbody>--}}
{{--                            </table>--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-12 col-sm-4">--}}
{{--                                    <div class="info-box bg-dark">--}}
{{--                                        <div class="info-box-content">--}}
{{--                                            <span--}}
{{--                                                class="info-box-text text-center">@lang('dashboard.Payment Type')</span>--}}
{{--                                            <span--}}
{{--                                                class="info-box-number text-center mb-0">@lang('db.payment_type.'.$payment->payment_type)</span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-12 col-sm-4">--}}
{{--                                    <div class="info-box bg-dark">--}}
{{--                                        <div class="info-box-content">--}}
{{--                                            <span--}}
{{--                                                class="info-box-text text-center">@lang('dashboard.Buyer Name')</span>--}}
{{--                                            <span--}}
{{--                                                class="info-box-number text-center mb-0">{{$payment->user?->name}}</span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-12 col-sm-4">--}}
{{--                                    <div class="info-box bg-dark">--}}
{{--                                        <div class="info-box-content">--}}
{{--                                            <span--}}
{{--                                                class="info-box-text text-center">@lang('dashboard.Total Amount')</span>--}}
{{--                                            <span--}}
{{--                                                class="info-box-number text-center mb-0">{{ $payment->amount }}</span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-12 col-sm-4">--}}
{{--                                    <div class="info-box bg-dark">--}}
{{--                                        <div class="info-box-content">--}}
{{--                                            <span--}}
{{--                                                class="info-box-text text-center">@lang('dashboard.Activate')</span>--}}
{{--                                            <span--}}
{{--                                                class="info-box-number text-center mb-0">{{ $payment->is_declined ? __('dashboard.Declined') : __('db.payment_confirmation.'.$payment->is_confirmed) }}</span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                @if($payment->payable_type == "App\Models\CertificateUser")--}}
{{--                                    <div class="col-12 col-sm-4">--}}
{{--                                        <div class="info-box bg-dark">--}}
{{--                                            <div class="info-box-content">--}}
{{--                                                <span--}}
{{--                                                    class="info-box-text text-center">@lang('dashboard.Certificate of Course')</span>--}}
{{--                                                <span--}}
{{--                                                    class="info-box-number text-center mb-0">{{ $payment->payable?->course?->t('name') }}</span>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                @else--}}
{{--                                    <div class="col-12 col-sm-4">--}}
{{--                                        <div class="info-box bg-dark">--}}
{{--                                            <div class="info-box-content">--}}
{{--                                                <span--}}
{{--                                                    class="info-box-text text-center">@lang('dashboard.Used Coupon')</span>--}}
{{--                                                <span--}}
{{--                                                    class="info-box-number text-center mb-0">{{ $payment->payable()?->withTrashed()?->coupon()?->withTrashed()?->first()->coupon->coupon ?? '-' }}</span>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                @endif--}}

{{--                                @if($payment->transfer_image)--}}
{{--                                    <!-- Button trigger modal -->--}}
{{--                                    <button class="btn waves-effect waves-light" data-toggle="modal"--}}
{{--                                            data-target="#delete-modal60">--}}
{{--                                        <img width="150px" class='img-fluid img-thumbnail'--}}
{{--                                             src="{{ url($payment->transfer_image) }}"/>--}}
{{--                                    </button>--}}
{{--                                    <div id="delete-modal60" class="modal fade modal2 " tabindex="-1" role="dialog"--}}
{{--                                         aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">--}}
{{--                                        <div class="modal-dialog">--}}
{{--                                            <div class="modal-content float-left">--}}
{{--                                                <div class="modal-header">--}}
{{--                                                    <h5 class="modal-title"></h5>--}}
{{--                                                </div>--}}
{{--                                                <div class="modal-body text-center">--}}
{{--                                                    <img style="width: 100%" class='img-fluid img-thumbnail'--}}
{{--                                                         src="{{ url($payment->transfer_image) }}"/>--}}
{{--                                                </div>--}}
{{--                                                <div class="modal-footer">--}}
{{--                                                    <button type="button" data-dismiss="modal"--}}
{{--                                                            class="btn btn-dark waves-effect waves-light m-l-5 mr-1 ml-1">--}}
{{--                                                        @lang('dashboard.close')--}}
{{--                                                    </button>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                @endif--}}


{{--                                @if($payment->bank_account_name)--}}
{{--                                    <div class="col-12 col-sm-4">--}}
{{--                                        <div class="info-box bg-dark">--}}
{{--                                            <div class="info-box-content">--}}
{{--                                                <span--}}
{{--                                                    class="info-box-text text-center">@lang('dashboard.bank_account_name')</span>--}}
{{--                                                <span--}}
{{--                                                    class="info-box-number text-center mb-0">{{ $payment->bank_account_name }}</span>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                @endif--}}

{{--                                @if($payment->bank_account_number)--}}
{{--                                    <div class="col-12 col-sm-4">--}}
{{--                                        <div class="info-box bg-dark">--}}
{{--                                            <div class="info-box-content">--}}
{{--                                                <span--}}
{{--                                                    class="info-box-text text-center">@lang('dashboard.bank_account_number')</span>--}}
{{--                                                <span--}}
{{--                                                    class="info-box-number text-center mb-0">{{ $payment->bank_account_number }}</span>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                @endif--}}

{{--                                @if($payment->from_bank)--}}
{{--                                    <div class="col-12 col-sm-4">--}}
{{--                                        <div class="info-box bg-dark">--}}
{{--                                            <div class="info-box-content">--}}
{{--                                                <span--}}
{{--                                                    class="info-box-text text-center">@lang('dashboard.from_bank')</span>--}}
{{--                                                <span--}}
{{--                                                    class="info-box-number text-center mb-0">{{ $payment->from_bank }}</span>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                @endif--}}

{{--                                @if($payment->to_bank)--}}
{{--                                    <div class="col-12 col-sm-4">--}}
{{--                                        <div class="info-box bg-dark">--}}
{{--                                            <div class="info-box-content">--}}
{{--                                                <span--}}
{{--                                                    class="info-box-text text-center">@lang('dashboard.to_bank')</span>--}}
{{--                                                <span--}}
{{--                                                    class="info-box-number text-center mb-0">{{ $payment->to_bank }}</span>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                @endif--}}

{{--                                @if($payment->transfer_amount)--}}
{{--                                    <div class="col-12 col-sm-4">--}}
{{--                                        <div class="info-box bg-dark">--}}
{{--                                            <div class="info-box-content">--}}
{{--                                                <span--}}
{{--                                                    class="info-box-text text-center">@lang('dashboard.transfer_amount')</span>--}}
{{--                                                <span--}}
{{--                                                    class="info-box-number text-center mb-0">{{ $payment->transfer_amount }}</span>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                @endif--}}


{{--                                @if($payment->transfer_date)--}}
{{--                                    <div class="col-12 col-sm-4">--}}
{{--                                        <div class="info-box bg-dark">--}}
{{--                                            <div class="info-box-content">--}}
{{--                                                <span--}}
{{--                                                    class="info-box-text text-center">@lang('dashboard.transfer_date')</span>--}}
{{--                                                <span--}}
{{--                                                    class="info-box-number text-center mb-0">{{ $payment->transfer_date }}</span>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                @endif--}}

{{--                                @if($payment->transfer_time)--}}
{{--                                    <div class="col-12 col-sm-4">--}}
{{--                                        <div class="info-box bg-dark">--}}
{{--                                            <div class="info-box-content">--}}
{{--                                                <span--}}
{{--                                                    class="info-box-text text-center">@lang('dashboard.transfer_time')</span>--}}
{{--                                                <span class="info-box-number text-center mb-0">{{ Carbon::parse($payment->transfer_time)->format('h:iA') }}</span>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                @endif--}}


{{--                            </div>--}}



                            <div class="row">
                                <div class="col-md-6 offset-md-6 text-center m-auto">
                                    <!-- Table -->
                                    <table class="table table-bordered">
                                        @if($payment->transfer_image)
                                            <tr>
                                                <td colspan="2">
                                                    <button class="btn waves-effect waves-light" data-toggle="modal"
                                                            data-target="#delete-modal60">
                                                        <img width="150px" class='img-fluid img-thumbnail'
                                                             src="{{ url($payment->transfer_image) }}"/>
                                                    </button>
                                                    <div id="delete-modal60" class="modal fade modal2 " tabindex="-1" role="dialog"
                                                         aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content float-left">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"></h5>
                                                                </div>
                                                                <div class="modal-body text-center">
                                                                    <img style="width: 100%" class='img-fluid img-thumbnail'
                                                                         src="{{ url($payment->transfer_image) }}"/>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" data-dismiss="modal"
                                                                            class="btn btn-dark waves-effect waves-light m-l-5 mr-1 ml-1">
                                                                        @lang('dashboard.close')
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif

                                        <tr>
                                            <th>@lang('dashboard.Payment Type')</th>
                                            <td style="width: 66%">@lang('db.payment_type.'.$payment->payment_type)</td>
                                        </tr>
                                        <tr>
                                            <th>@lang('dashboard.Buyer Name')</th>
                                            <td style="width: 66%">{{ $payment->user?->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>@lang('dashboard.Total Amount')</th>
                                            <td style="width: 66%">{{ $payment->amount }}</td>
                                        </tr>
                                        <tr>
                                            <th>@lang('dashboard.Activate')</th>
                                            <td style="width: 66%">{{ $payment->is_declined ? __('dashboard.Declined') : __('db.payment_confirmation.'.$payment->is_confirmed) }}</td>
                                        </tr>
                                        @if($payment->payable_type == "App\Models\CertificateUser")
                                            <tr>
                                                <th>@lang('dashboard.Certificate of Course')</th>
                                                <td style="width: 66%">{{ $payment->payable?->course?->t('name') }}</td>
                                            </tr>
                                        @else
                                            <tr>
                                                <th>@lang('dashboard.Used Coupon')</th>
                                                <td style="width: 66%">{{ $payment->payable()?->withTrashed()?->coupon()?->withTrashed()?->first()->coupon->coupon ?? '-' }}</td>
                                            </tr>
                                        @endif
                                        @if($payment->bank_account_name)
                                            <tr>
                                                <th>@lang('dashboard.bank_account_name')</th>
                                                <td style="width: 66%">{{ $payment->bank_account_name }}</td>
                                            </tr>
                                        @endif
                                        @if($payment->bank_account_number)
                                            <tr>
                                                <th>@lang('dashboard.bank_account_number')</th>
                                                <td style="width: 66%">{{ $payment->bank_account_number }}</td>
                                            </tr>
                                        @endif
                                        @if($payment->from_bank)
                                            <tr>
                                                <th>@lang('dashboard.from_bank')</th>
                                                <td style="width: 66%">{{ $payment->from_bank }}</td>
                                            </tr>
                                        @endif
                                        @if($payment->to_bank)
                                            <tr>
                                                <th>@lang('dashboard.to_bank')</th>
                                                <td style="width: 66%">{{ $payment->to_bank }}</td>
                                            </tr>
                                        @endif
                                        @if($payment->transfer_amount)
                                            <tr>
                                                <th>@lang('dashboard.transfer_amount')</th>
                                                <td style="width: 66%">{{ $payment->transfer_amount }}</td>
                                            </tr>
                                        @endif
                                        @if($payment->transfer_date)
                                            <tr>
                                                <th>@lang('dashboard.transfer_date')</th>
                                                <td style="width: 66%">{{ $payment->transfer_date }}</td>
                                            </tr>
                                        @endif
                                        @if($payment->transfer_time)
                                            <tr>
                                                <th>@lang('dashboard.transfer_time')</th>
                                                <td style="width: 66%">{{ Carbon::parse($payment->transfer_time)->format('h:iA') }}</td>
                                            </tr>
                                        @endif
                                    </table>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <div class="card-footer">
                        @if(Gate::allows('confirm-payment', $payment) && auth()->user()->hasPermission('payments-update'))
                            <button class="btn btn-dark waves-effect waves-light" data-toggle="modal" data-target="#confirm-modal">@lang('dashboard.Confirm Payment')</button>
                            <div id="confirm-modal" class="modal fade modal2 " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog">
                                    <div class="modal-content float-left">
                                        <div class="modal-header">
                                            <h5 class="modal-title">@lang('dashboard.Confirm Payment')</h5>
                                        </div>
                                        <div class="modal-body">
                                            <p>{{ __('dashboard.Are you sure you want to confirm this payment?', ['amount' => $payment->amount, 'user_name' => $payment->user?->name]) }}</p>
                                            <p class="text-danger font-weight-bold text-sm">@lang('dashboard.By confirming this payment, you will not be able to undo this action')</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" data-dismiss="modal" class="btn btn-dark waves-effect waves-light m-l-5 mr-1 ml-1">
                                                @lang('dashboard.close')
                                            </button>
                                            <form action="{{route('payments.confirm' , $payment['id'])}}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-success">@lang('dashboard.Confirm')</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if(Gate::allows('decline-payment', $payment) && auth()->user()->hasPermission('payments-update'))
                            <button class="btn btn-danger waves-effect waves-light" data-toggle="modal" data-target="#decline-modal">@lang('dashboard.Decline Payment')</button>
                            <div id="decline-modal" class="modal fade modal2 " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog">
                                    <div class="modal-content float-left">
                                        <div class="modal-header">
                                            <h5 class="modal-title">@lang('dashboard.Decline Payment')</h5>
                                        </div>
                                        <div class="modal-body">
                                            <p>{{ __('dashboard.Are you sure you want to decline this payment?', ['amount' => $payment->amount, 'user_name' => $payment->user?->name]) }}</p>
                                            <p class="text-danger font-weight-bold text-sm">@lang('dashboard.By declining this payment, you will not be able to undo this action')</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" data-dismiss="modal" class="btn btn-dark waves-effect waves-light m-l-5 mr-1 ml-1">
                                                @lang('dashboard.close')
                                            </button>
                                            <form action="{{route('payments.decline' , $payment['id'])}}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-danger">@lang('dashboard.Decline')</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                            @if( $payment->payment_type == 'CASH')

                                <a href="{{ url('bank-transfers') }}" class="btn btn-dark">@lang('dashboard.back')</a>

                            @else
                                <a href="{{ url('payments') }}" class="btn btn-dark">@lang('dashboard.back')</a>

                            @endif

                    </div>
                </div>
                @if($payment->payable_type == "App\Models\Cart")


                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">@lang('dashboard.Cart Content')</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>@lang('dashboard.Name')</th>
                                        <th>@lang('dashboard.Quantity')</th>
                                        <th>@lang('dashboard.price_before_discount')</th>
                                        <th>@lang('dashboard.Amount')</th>
                                        <th>@lang('dashboard.Activation')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($payment->payable()->withTrashed()->first()?->items()->withTrashed()->get() !== null)
                                        @forelse($payment->payable()->withTrashed()->first()?->items()->withTrashed()->get() as $key => $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    @if($item->cartable_type == Course::class)
                                                        @lang('dashboard.Course'): {{ $item->cartable?->t('name') }}
                                                    @elseif($item->cartable_type == CourseBook::class)
                                                        {{--                                                        @lang('dashboard.Book of Course'): {{ $item->cartable?->course?->t('name') }} - #{{ $item->cartable_id }}--}}
                                                        {{$item->cartable?->t('name')  . ($item->option !== null ? ' (' . __('dashboard.'.$item->option) . ')' : '')}}
                                                    @endif
                                                </td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>{{$item->amount }}</td>
                                                @if($payment->payable()->withTrashed()->first()?->coupon)
                                                    <td>{{(( 1 - ($payment->payable()->withTrashed()->first()?->coupon->discount / 100) ) * $item->amount) }}</td>
                                                @else
                                                    <td>{{$item->amount }}</td>
                                                @endif
                                                @if($item->cartable_type == \App\Models\Course::class)
                                                    <td>
                                                        @if($payment->user->subscriptions->contains('course_id' , $item->cartable_id))

                                                            @if(!$payment->user->subscriptions()->where('course_id' , $item->cartable_id)->first()->is_active)

                                                                <button
                                                                    class="btn btn-success waves-effect waves-light"
                                                                    data-toggle="modal"
                                                                    data-target="#delete-modal{{$key}}">@lang('dashboard.Activate')</button>
                                                                <div id="delete-modal{{$key}}"
                                                                     class="modal fade modal2 " tabindex="-1"
                                                                     role="dialog" aria-labelledby="myModalLabel"
                                                                     aria-hidden="true" style="display: none;">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content float-left">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title">@lang('dashboard.Activate')</h5>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <p>@lang('dashboard.Are You Sure You Want To Activate This Subscription')</p>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                        data-dismiss="modal"
                                                                                        class="btn btn-dark waves-effect waves-light m-l-5 mr-1 ml-1">
                                                                                    @lang('dashboard.close')
                                                                                </button>
                                                                                <form
                                                                                    action="{{route('subscription.toggle' ,$payment->user->subscriptions()->where('course_id' , $item->cartable_id)->where('is_active' , false)->first()->id ) }}"
                                                                                    method="post">
                                                                                    @csrf
                                                                                    {{method_field('PUT')}}
                                                                                    <button type="submit"
                                                                                            class="btn btn-success">@lang('dashboard.Activate')</button>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            @else

                                                                <button
                                                                    class="btn btn-danger waves-effect waves-light"
                                                                    data-toggle="modal"
                                                                    data-target="#delete-modal{{$key}}">@lang('dashboard.deActivate')</button>
                                                                <div id="delete-modal{{$key}}"
                                                                     class="modal fade modal2 " tabindex="-1"
                                                                     role="dialog" aria-labelledby="myModalLabel"
                                                                     aria-hidden="true" style="display: none;">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content float-left">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title">@lang('dashboard.deActivate')</h5>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <p>@lang('dashboard.Are You Sure You Want To De Activate This Subscription')</p>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                        data-dismiss="modal"
                                                                                        class="btn btn-dark waves-effect waves-light m-l-5 mr-1 ml-1">
                                                                                    @lang('dashboard.close')
                                                                                </button>

                                                                                <form
                                                                                    action="{{route('subscription.toggle' ,$payment->user->subscriptions()->where('course_id' , $item->cartable_id)->where('is_active' , true)->first()->id )}}"
                                                                                    method="post">
                                                                                    @csrf
                                                                                    {{method_field('PUT')}}
                                                                                    <button type="submit"
                                                                                            class="btn btn-danger">@lang('dashboard.deActivate')</button>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            @endif
                                                        @else
                                                            <button class="btn btn-success waves-effect waves-light"
                                                                    data-toggle="modal"
                                                                    data-target="#delete-modal{{$key}}">@lang('dashboard.Activate')</button>
                                                            <div id="delete-modal{{$key}}"
                                                                 class="modal fade modal2 " tabindex="-1"
                                                                 role="dialog" aria-labelledby="myModalLabel"
                                                                 aria-hidden="true" style="display: none;">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content float-left">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">@lang('dashboard.Activate')</h5>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <p>@lang('dashboard.Are You Sure You Want To Activate This Subscription')</p>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button"
                                                                                    data-dismiss="modal"
                                                                                    class="btn btn-dark waves-effect waves-light m-l-5 mr-1 ml-1">
                                                                                @lang('dashboard.close')
                                                                            </button>
                                                                            <form
                                                                                action="{{route('payments.confirmCourse')}}"
                                                                                method="post">
                                                                                @csrf
                                                                                <input type="hidden"
                                                                                       name="payment_id"
                                                                                       value="{{$payment->id}}">
                                                                                <input type="hidden"
                                                                                       name="course_id"
                                                                                       value="{{$item->cartable_id}}">
                                                                                <input type="hidden" name="user_id"
                                                                                       value="{{$payment->user_id}}">
                                                                                <button type="submit"
                                                                                        class="btn btn-success">@lang('dashboard.Activate')</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif

                                                    </td>
                                                @else

                                                    @if($item->option == "PDF")
                                                        <td>
                                                            @if($payment->user->booksUsers->contains('course_book_id' , $item->cartable_id))

                                                                @if(!$payment->user->booksUsers()->where('course_book_id' , $item->cartable_id)->first()->is_active)

                                                                    <button
                                                                        class="btn btn-success waves-effect waves-light"
                                                                        data-toggle="modal"
                                                                        data-target="#delete-modal{{$key}}">@lang('dashboard.Activate')</button>
                                                                    <div id="delete-modal{{$key}}"
                                                                         class="modal fade modal2 " tabindex="-1"
                                                                         role="dialog"
                                                                         aria-labelledby="myModalLabel"
                                                                         aria-hidden="true" style="display: none;">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content float-left">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title">@lang('dashboard.Activate')</h5>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <p>@lang('dashboard.Are You Sure You Want To Activate This Subscription')</p>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button"
                                                                                            data-dismiss="modal"
                                                                                            class="btn btn-dark waves-effect waves-light m-l-5 mr-1 ml-1">
                                                                                        @lang('dashboard.close')
                                                                                    </button>
                                                                                    <form
                                                                                        action="{{route('book_store.toggle' ,$payment->user->booksUsers()->where('course_book_id' , $item->cartable_id)->where('is_active' , false)->first()->id ) }}"
                                                                                        method="post">
                                                                                        @csrf
                                                                                        {{method_field('PUT')}}
                                                                                        <button type="submit"
                                                                                                class="btn btn-success">@lang('dashboard.Activate')</button>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                @else

                                                                    <button
                                                                        class="btn btn-danger waves-effect waves-light"
                                                                        data-toggle="modal"
                                                                        data-target="#delete-modal{{$key}}">@lang('dashboard.deActivate')</button>
                                                                    <div id="delete-modal{{$key}}"
                                                                         class="modal fade modal2 " tabindex="-1"
                                                                         role="dialog"
                                                                         aria-labelledby="myModalLabel"
                                                                         aria-hidden="true" style="display: none;">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content float-left">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title">@lang('dashboard.deActivate')</h5>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <p>@lang('dashboard.Are You Sure You Want To De Activate This Subscription')</p>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button"
                                                                                            data-dismiss="modal"
                                                                                            class="btn btn-dark waves-effect waves-light m-l-5 mr-1 ml-1">
                                                                                        @lang('dashboard.close')
                                                                                    </button>

                                                                                    <form
                                                                                        action="{{route('book_store.toggle' ,$payment->user->booksUsers()->where('course_book_id' , $item->cartable_id)->where('is_active' , true)->first()->id )}}"
                                                                                        method="post">
                                                                                        @csrf
                                                                                        {{method_field('PUT')}}
                                                                                        <button type="submit"
                                                                                                class="btn btn-danger">@lang('dashboard.deActivate')</button>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                @endif
                                                            @else
                                                                <button
                                                                    class="btn btn-success waves-effect waves-light"
                                                                    data-toggle="modal"
                                                                    data-target="#delete-modal{{$key}}">@lang('dashboard.Activate')</button>
                                                                <div id="delete-modal{{$key}}"
                                                                     class="modal fade modal2 " tabindex="-1"
                                                                     role="dialog" aria-labelledby="myModalLabel"
                                                                     aria-hidden="true" style="display: none;">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content float-left">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title">@lang('dashboard.Activate')</h5>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <p>@lang('dashboard.Are You Sure You Want To Activate This Subscription')</p>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                        data-dismiss="modal"
                                                                                        class="btn btn-dark waves-effect waves-light m-l-5 mr-1 ml-1">
                                                                                    @lang('dashboard.close')
                                                                                </button>
                                                                                <form
                                                                                    action="{{route('payments.confirmBook')}}"
                                                                                    method="post">
                                                                                    @csrf
                                                                                    <input type="hidden"
                                                                                           name="payment_id"
                                                                                           value="{{$payment->id}}">
                                                                                    <input type="hidden"
                                                                                           name="book_id"
                                                                                           value="{{$item->cartable_id}}">
                                                                                    <input type="hidden"
                                                                                           name="user_id"
                                                                                           value="{{$payment->user_id}}">
                                                                                    <input type="hidden" name="type"
                                                                                           value="PDF">
                                                                                    <button type="submit"
                                                                                            class="btn btn-success">@lang('dashboard.Activate')</button>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif

                                                        </td>
                                                    @else

                                                        <td>
                                                            @if($payment->user->printRequests->contains('book_id' , $item->cartable_id))
                                                                <button
                                                                    class="btn btn-danger waves-effect waves-light"
                                                                    data-toggle="modal"
                                                                    data-target="#delete-modal{{$key}}">@lang('dashboard.deActivate')</button>
                                                                <div id="delete-modal{{$key}}"
                                                                     class="modal fade modal2 " tabindex="-1"
                                                                     role="dialog" aria-labelledby="myModalLabel"
                                                                     aria-hidden="true" style="display: none;">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content float-left">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title">@lang('dashboard.deActivate')</h5>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <p>@lang('dashboard.Are You Sure You Want To De Activate This Subscription')</p>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                        data-dismiss="modal"
                                                                                        class="btn btn-dark waves-effect waves-light m-l-5 mr-1 ml-1">
                                                                                    @lang('dashboard.close')
                                                                                </button>
                                                                                <form
                                                                                    action="{{route('requests.destroy' ,$payment->user->printRequests()->where('book_id' , $item->cartable_id)->first()->id ) }}"
                                                                                    method="post">
                                                                                    @csrf
                                                                                    {{method_field('delete')}}
                                                                                    <button type="submit"
                                                                                            class="btn btn-success">@lang('dashboard.Activate')</button>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            @else

                                                                <button
                                                                    class="btn btn-success waves-effect waves-light"
                                                                    data-toggle="modal"
                                                                    data-target="#delete-modal{{$key}}">@lang('dashboard.Activate')</button>
                                                                <div id="delete-modal{{$key}}"
                                                                     class="modal fade modal2 " tabindex="-1"
                                                                     role="dialog" aria-labelledby="myModalLabel"
                                                                     aria-hidden="true" style="display: none;">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content float-left">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title">@lang('dashboard.Activate')</h5>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <p>@lang('dashboard.Are You Sure You Want To  Activate This Subscription')</p>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                        data-dismiss="modal"
                                                                                        class="btn btn-dark waves-effect waves-light m-l-5 mr-1 ml-1">
                                                                                    @lang('dashboard.close')
                                                                                </button>

                                                                                <form
                                                                                    action="{{route('payments.confirmBook')}}"
                                                                                    method="POST">
                                                                                    @csrf
                                                                                    <input type="hidden"
                                                                                           name="payment_id"
                                                                                           value="{{$payment->id}}">
                                                                                    <input type="hidden"
                                                                                           name="book_id"
                                                                                           value="{{$item->cartable_id}}">
                                                                                    <input type="hidden"
                                                                                           name="user_id"
                                                                                           value="{{$payment->user_id}}">
                                                                                    <input type="hidden" name="type"
                                                                                           value="PRINT">
                                                                                    <button type="submit"
                                                                                            class="btn btn-success">@lang('dashboard.Activate')</button>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            @endif

                                                        </td>

                                                    @endif

                                                @endif

                                            </tr>
                                        @empty
                                            @include('dashboard.core.includes.no-entries', ['columns' => 4])
                                        @endforelse
                                    @else

                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>


                @else

                    <div class="operations-btns" style="">

                        @if(!$payment->printRequests->contains('payment_id' , $payment->id))

                            <button class="btn btn-dark waves-effect waves-light" data-toggle="modal"
                                    data-target="#confirm-modal-0">@lang('dashboard.Activate Certificate Request')</button>
                            <div id="confirm-modal-0" class="modal fade modal2 " tabindex="-1" role="dialog"
                                 aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog">
                                    <div class="modal-content float-left">
                                        <div class="modal-header">
                                            <h5 class="modal-title">@lang('dashboard.Activate Certificate Request')</h5>
                                        </div>
                                        <div class="modal-body">
                                            {{--                                            <p>{{ __('dashboard.Are you sure you want to confirm this payment?', ['amount' => $payment->amount, 'user_name' => $payment->user->name]) }}</p>--}}
                                            <p class="text-danger font-weight-bold text-sm">@lang('dashboard.Activate Certificate Request')</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" data-dismiss="modal"
                                                    class="btn btn-dark waves-effect waves-light m-l-5 mr-1 ml-1">
                                                @lang('dashboard.close')
                                            </button>
                                            <form action="{{route('payments.confirm' , $payment['id'])}}"
                                                  method="post">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit"
                                                        class="btn btn-success">@lang('dashboard.Activate Certificate Request')</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else


                            <button class="btn btn-danger waves-effect waves-light" data-toggle="modal"
                                    data-target="#confirm-modal-12">@lang('dashboard.De Activate Certificate Request')</button>
                            <div id="confirm-modal-12" class="modal fade modal2 " tabindex="-1" role="dialog"
                                 aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog">
                                    <div class="modal-content float-left">
                                        <div class="modal-header">
                                            <h5 class="modal-title">@lang('dashboard.De Activate Certificate Request')</h5>
                                        </div>
                                        <div class="modal-body">
                                            {{--                                            <p>{{ __('dashboard.Are you sure you want to decline this payment?', ['amount' => $payment->amount, 'user_name' => $payment->user->name]) }}</p>--}}
                                            <p class="text-danger font-weight-bold text-sm">@lang('dashboard.De Activate Certificate Request')</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" data-dismiss="modal"
                                                    class="btn btn-dark waves-effect waves-light m-l-5 mr-1 ml-1">
                                                @lang('dashboard.close')
                                            </button>
                                            <form action="{{route('payments.decline' , $payment['id'])}}"
                                                  method="post">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit"
                                                        class="btn btn-danger">@lang('dashboard.De Activate Certificate Request')</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @endif
                    </div>


                    @if($payment->address)

                        <div class="col-12 col-sm-12">
                            <h2 class="text-center mb-4">@lang('dashboard.delivery_data')</h2>
                            <div class="info-box bg-dark">
                                <div class="info-box-content">
                                    <span
                                        class="info-box-number text-center mb-0">@lang('dashboard.Name') : {{$payment->name}}</span>
                                    <span
                                        class="info-box-number text-center mb-0">@lang('dashboard.Email') : {{$payment->email}}</span>
                                    <span
                                        class="info-box-number text-center mb-0">@lang('dashboard.Phone') : {{$payment->phone}}</span>
                                    {{--                                <span class="info-box-number text-center mb-0">@lang('dashboard.Nationality') : {{$payment->nationality}}</span>--}}
                                    {{--                                <span class="info-box-number text-center mb-0">@lang('dashboard.national_id') : {{$payment->national_id}}</span>--}}
                                    @if($payment->qualification)
                                        <span class="info-box-number text-center mb-0">@lang('dashboard.Qualification') : {{$payment->qualification}}</span>
                                    @endif
                                    <span
                                        class="info-box-number text-center mb-0">@lang('dashboard.Address') : {{$payment->address}}</span>
                                </div>
                            </div>
                        </div>
                    @endif





                    <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
