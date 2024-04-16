<table class="table table-bordered">
    <thead>
    <tr>
        <th style="width: 250px;">@lang('dashboard.student')</th>
        @if($type == 'BOOK')
            <th style="width: 250px;">@lang('dashboard.Book\Bag')</th>
        @else
            <th style="width: 250px">@lang('dashboard.Certificate of Course')</th>
        @endif
        <th style="width: 250px;">@lang('dashboard.status')</th>
    </tr>
    </thead>
    <tbody>
    @forelse($requests as $key => $request)
        <tr>
            <td>{{$request->user->name}}</td>
            @if($request->book)
                <td>{{$request->book->t('name')}}</td>
            @else
                <td>{{$request->course?->t('name')}}</td>
            @endif

            <td>@lang('dashboard.'.$request->status)</td>
        </tr>
    @empty
        @include('dashboard.core.includes.no-entries', ['columns' => 7])
    @endforelse
    </tbody>
</table>
