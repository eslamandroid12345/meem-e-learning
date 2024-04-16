@php use Carbon\Carbon; @endphp
<table>
    <thead>
    <tr>
        <th style="width: 250px">@lang('dashboard.Name')</th>
        <th style="width: 250px">@lang('dashboard.Course')</th>
    </tr>
    </thead>
    <tbody>
    @foreach($standards as $standard)
        <tr>
            <td>{{ $standard->t('name') }}</td>
            <td>{{ $standard->course->t('name') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
