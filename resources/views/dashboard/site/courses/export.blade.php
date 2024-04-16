@php use Carbon\Carbon; @endphp
<table>
    <thead>
    <tr>
        <th style="width: 250px">@lang('dashboard.Name')</th>
        <th style="width: 250px">@lang('dashboard.Price')</th>
        <th style="width: 250px">@lang('dashboard.category')</th>
        <th style="width: 250px">@lang('dashboard.Activation')</th>
    </tr>
    </thead>
    <tbody>
    @foreach($courses as $course)
        <tr>
            <td>{{ $course->t('name') }}</td>
            <td>{{ $course->price }} @lang('dashboard.riyal')</td>
            <td>{{ $course->category?->t('name') }}</td>
            <td>{{ $course->is_active ? __('dashboard.Yes') : __('dashboard.No') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
