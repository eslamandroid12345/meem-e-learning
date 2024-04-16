@php use Carbon\Carbon; @endphp
<table>
    <thead>
    <tr>
        <th style="width: 250px">@lang('dashboard.exam_type')</th>
        <th style="width: 250px">@lang('dashboard.COURSE')</th>
        <th style="width: 250px">@lang('dashboard.duration')</th>
        <th style="width: 250px">@lang('dashboard.max_attempts')</th>
    </tr>
    </thead>
    <tbody>
    @foreach($exams as $exam)
        <tr>
            <td>{{__('dashboard.' . $exam->type)}}</td>
            <td>{{$exam->course->t('name')}}</td>
            <td>{{$exam->duration}}
                @if($exam->duration == 1)
                    @lang('dashboard.one_minute')
                @elseif($exam->duration > 1 && $exam->duration < 11)
                    @lang('dashboard.minutes')
                @else
                    @lang('dashboard.minute')
                @endif
            </td>
            <td>{{$exam->attempts}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
