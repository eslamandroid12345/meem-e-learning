<table class="table table-bordered">
    <thead>
    <tr>
        <th style="width: 250px">@lang('dashboard.Name')</th>
        <th style="width: 250px">@lang('dashboard.price')</th>
    </tr>
    </thead>
    <tbody>
    @forelse($books as $key => $book)
        <tr>
            <td>{{ $book->t('name') }}</td>
            <td>{{ $book->price }} @lang('dashboard.riyal')</td>
        </tr>
    @empty
        @include('dashboard.core.includes.no-entries', ['columns' => 6])
    @endforelse
    </tbody>
</table>
