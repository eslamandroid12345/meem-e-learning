@php use Carbon\Carbon; @endphp
<table>
    <thead>
    <tr>
        <th style="width: 250px">@lang('dashboard.Name')</th>
        <th style="width: 250px">@lang('dashboard.Course')</th>
    </tr>
    </thead>
    <tbody>
    @foreach($lectures as $lecture)
        <tr>
            <td>{{ $lecture->t('name') }}</td>
            <td>{{ $lecture->standard->course->t('name') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
