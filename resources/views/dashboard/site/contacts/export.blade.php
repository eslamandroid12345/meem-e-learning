<table class="table table-bordered">
    <thead>
    <tr>
        <th style="width: 250px">@lang('dashboard.Name')</th>
        <th style="width: 250px">@lang('dashboard.Email')</th>
        <th style="width: 250px">@lang('dashboard.Phone')</th>
        <th style="width: 250px">@lang('dashboard.created_at')</th>
    </tr>
    </thead>
    <tbody>
    @forelse($contacts as $key => $contact)
        <tr>
            <td>{{$contact['name']}}</td>
            <td>{{$contact['email']}}</td>
            <td>{{$contact['phone_number']}}</td>
            <td>{{$contact->created_at->diffForHumans()}}</td>
        </tr>
    @empty
        @include('dashboard.core.includes.no-entries', ['columns' => 6])
    @endforelse
    </tbody>
</table>
