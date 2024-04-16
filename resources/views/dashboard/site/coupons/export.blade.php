<table class="table table-bordered">
    <thead>
    <tr>
        <th style="width: 250px">@lang('dashboard.Coupon')</th>
        <th style="width: 250px">@lang('dashboard.discount')</th>
        <th style="width: 250px">@lang('dashboard.use_times')</th>
        <th style="width: 250px">@lang('dashboard.max_uses')</th>
    </tr>
    </thead>
    <tbody>
    @forelse($coupons as $key => $coupon)
        <tr>
            <td>{{$coupon->coupon}}</td>
            <td>{{$coupon->discount }} %</td>
            <td>{{$coupon->uses()->count() }}</td>
            <td>{{$coupon->max_uses ?? __('dashboard.none') }}</td>
        </tr>
    @empty
        @include('dashboard.core.includes.no-entries', ['columns' => 4])
    @endforelse
    </tbody>
</table>
