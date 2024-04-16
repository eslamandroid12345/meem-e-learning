<table>
    <thead>
    <tr>
        <th style="width: 250px">@lang('dashboard.Student')</th>
        <th style="width: 250px">@lang('dashboard.Book')</th>
        <th style="width: 250px">@lang('dashboard.Activation')</th>
    </tr>
    </thead>
    <tbody>
    @foreach($sells as $sell)
        <tr>
            <td>{{ $sell->user?->name }}</td>
            <td>{{ $sell->book?->t('name') }}</td>
            <td>{{ $sell->is_active ? __('dashboard.Yes') : __('dashboard.No') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
