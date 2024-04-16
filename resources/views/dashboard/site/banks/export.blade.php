<table class="table table-bordered">
    <thead>
    <tr>
        <th style="width: 250px">@lang('dashboard.Name')</th>
        <th style="width: 250px">@lang('dashboard.account_number')</th>
    </tr>
    </thead>
    <tbody>
    @forelse($banks as $key => $bank)
        <tr>
            <td>{{ $bank->t('name') }}</td>
            <td>{{ $bank->account_number }}</td>
        </tr>
    @empty
        @include('dashboard.core.includes.no-entries', ['columns' => 6])
    @endforelse
    </tbody>
</table>
