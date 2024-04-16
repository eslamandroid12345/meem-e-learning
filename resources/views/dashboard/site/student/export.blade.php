@php use Carbon\Carbon; @endphp
<table>
    <thead>
    <tr>
        <th style="width: 250px">@lang('dashboard.Name')</th>
        <th style="width: 250px">@lang('dashboard.Email')</th>
        <th style="width: 250px">@lang('dashboard.Phone')</th>
        <th style="width: 250px">@lang('dashboard.Joining Date')</th>
    </tr>
    </thead>
    <tbody>
    @foreach($students as $student)
        <tr>
            <td>{{ $student->name }}</td>
            <td>{{ $student->email }}</td>
            <td>{!! $student->phone !!}</td>
            <td>{{ Carbon::parse($student->created_at)->format('Y-m-d h:iA') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
