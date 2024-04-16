<table class="table table-bordered">
    <thead>
    <tr>
        <th style="width: 250px">@lang('dashboard.Type')</th>
        <th style="width: 250px">@lang('dashboard.Question')</th>
        <th style="width: 250px">@lang('dashboard.Course')</th>
        <th style="width: 250px">@lang('dashboard.Student')</th>
        <th style="width: 250px">@lang('dashboard.Is Answered')</th>
        <th style="width: 250px">@lang('dashboard.Is Public')</th>
    </tr>
    </thead>
    <tbody>
    @forelse($inquiries as $key => $inquiry)
        <tr>
            <td>{{ __('db.inquiries.'.$inquiry->type) }}</td>
            <td>{{ Str::limit($inquiry->question, 200) }}</td>
            <td>{{$inquiry->course->t('name')}}</td>
            <td>{{$inquiry->user->name}}</td>
            <td>{{$inquiry->is_answered ? __('dashboard.Yes') : __('dashboard.No')}}</td>
            <td>{{$inquiry->is_public ? __('dashboard.Yes') : __('dashboard.No')}}</td>
        </tr>
    @empty
        @include('dashboard.core.includes.no-entries', ['columns' => 8])
    @endforelse
    </tbody>
</table>
