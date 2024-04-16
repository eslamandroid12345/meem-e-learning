<table>
    <thead>
    <tr>
        <th style="width: 250px">@lang('dashboard.Student')</th>
        <th style="width: 250px">@lang('dashboard.Course')</th>
        <th style="width: 250px">@lang('dashboard.Activation')</th>
    </tr>
    </thead>
    <tbody>
    @foreach($subscriptions as $subscription)
        <tr>
            <td>{{ $subscription->user?->name }}</td>
            <td>{{ $subscription->course?->t('name') }}</td>
            <td>{{ $subscription->is_active ? __('dashboard.Yes') : __('dashboard.No') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
