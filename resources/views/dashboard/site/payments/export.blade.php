<table class="table table-bordered">
    <thead>
    <tr>
        <th style="width: 250px">@lang('dashboard.Payment Type')</th>
        <th style="width: 250px">@lang('dashboard.Buyer Name')</th>
        <th style="width: 250px">@lang('dashboard.Total Amount')</th>
        <th style="width: 250px">@lang('dashboard.status')</th>
    </tr>
    </thead>
    <tbody>
    @forelse($payments as $key => $payment)
        <tr>
            <td>{{__('db.payment_type.'.$payment->payment_type)}}</td>
            <td>{{$payment->user?->name}}</td>
            <td>{{$payment->amount}}</td>
            <td>{{ $payment->is_declined ? __('dashboard.Declined') : __('db.payment_confirmation.'.$payment->is_confirmed) }}</td>
        </tr>
    @empty
        @include('dashboard.core.includes.no-entries', ['columns' => 6])
    @endforelse
    </tbody>
</table>
