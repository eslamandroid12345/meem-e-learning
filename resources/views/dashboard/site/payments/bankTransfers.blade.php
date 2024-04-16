@php use App\Models\Cart;use App\Models\CertificateUser;use Illuminate\Support\Facades\Gate; @endphp
@extends('dashboard.core.app')
@section('title', __('dashboard.bank_transfers'))
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.bank_transfers')</h1>
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
                            <h3 class="card-title">@lang('dashboard.bank_transfers')</h3>
                            <div class="card-tools">
                                <a  href="{{ route('payments.exportTransfers', ['excel', ...request()->query()]) }}" class="btn  btn-success">@lang('dashboard.Excel Export')</a>
                                <a  href="{{ route('payments.exportTransfers', ['pdf', ...request()->query()]) }}" class="btn  btn-danger">@lang('dashboard.PDF Export')</a>
                            </div>
                        </div>


                        <div class="card-body">

                            <form action="{{route('bank_transfers.index')}}">
                                <div class="row">

                                    <div class="form-group col-2">
                                        <select id="type" name="type" class="form-control">
                                            <option @selected(request('type') == "ALL") value="ALL">@lang('dashboard.all_items')</option>
                                            <option @selected(request('type') == "COURSE") value="COURSE">@lang('dashboard.courses')</option>
                                            <option @selected(request('type') == "BOOK")  value="BOOK">@lang('dashboard.books')</option>
                                            <option @selected(request('type') == "CERTIFICATE") value="CERTIFICATE">@lang('dashboard.certificates')</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-2">
                                        <input value="{{request('search') ?? ""}}" name="search" type="search" class="form-control" placeholder="@lang('dashboard.search_with_phone_number')">
                                    </div>


                                    <div class="form-group col-2">
                                        <input value="{{request('from_date') ?? ""}}" name="from_date" type="date" class="form-control" placeholder="@lang('dashboard.search_with_phone_number_or_name_or_email')">
                                    </div>
                                    <p class="mt-2">@lang('dashboard.to')</p>

                                    <div class="form-group col-2">
                                        <input value="{{request('to_date') ?? ""}}" name="to_date" type="date" class="form-control" placeholder="@lang('dashboard.search_with_phone_number_or_name_or_email')">
                                    </div>


                                    <div class="form-group col-1">
                                        <button type="submit" class="btn btn-dark">@lang('dashboard.filter')</button>
                                    </div>
                                </div>
                            </form>

                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>@lang('dashboard.Payment Type')</th>
                                    <th>@lang('dashboard.Buyer Name')</th>
                                    <th>@lang('dashboard.Purchases')</th>
                                    <th>@lang('dashboard.Total Amount')</th>
                                    <th>@lang('dashboard.status')</th>
                                    <th>@lang('dashboard.Operations')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($payments as $key => $payment)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{__('db.payment_type.'.$payment->payment_type)}}</td>
                                        <td>{{$payment->user?->name}}</td>
                                        <td>
                                            @if($payment->payable_type == Cart::class)
                                                @if($payment->payable()->withTrashed()->first()?->items?->count() == 1)
                                                    @lang('db.cart_item_type.' . $payment->payable()->withTrashed()->first()?->items->first()->cartable_type)
                                                    : {{ $payment->payable()->withTrashed()->first()?->items?->first()->cartable?->t('name') }}
                                                @elseif($payment->payable()->withTrashed()->first()?->items?->count() == 0)
                                                    @lang('dashboard.none')
                                                @else
                                                    @lang('dashboard.Multi')
                                                @endif
                                            @elseif($payment->payable_type == CertificateUser::class)
                                                @lang('dashboard.CERTIFICATE') : {{ $payment->payable()->withTrashed()->first()?->course?->t('name') }}
                                            @endif
                                        </td>
                                        <td>{{$payment->amount}}</td>
                                        <td>{{ $payment->is_declined ? __('dashboard.Declined') : __('db.payment_confirmation.'.$payment->is_confirmed) }}</td>
                                        <td>
                                            <div class="operations-btns" style="">
                                                @if(auth()->user()->hasPermission('payments-read'))
                                                    <a href="{{ route('payments.show', $payment['id']) }}" class="btn  btn-dark">@lang('dashboard.Show')</a>
                                                @endif
                                                @if(Gate::allows('confirm-payment', $payment) && auth()->user()->hasPermission('payments-update'))
                                                    <button class="btn btn-dark waves-effect waves-light" data-toggle="modal" data-target="#confirm-modal-{{$key}}">@lang('dashboard.Confirm Payment')</button>
                                                    <div id="confirm-modal-{{$key}}" class="modal fade modal2 " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
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
                                                    <button class="btn btn-danger waves-effect waves-light" data-toggle="modal" data-target="#decline-modal-{{$key}}">@lang('dashboard.Decline Payment')</button>
                                                    <div id="decline-modal-{{$key}}" class="modal fade modal2 " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
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
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    @include('dashboard.core.includes.no-entries', ['columns' => 6])
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            {{ $payments->appends(request()->all())->links() }}
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
