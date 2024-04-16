<table>
    <thead>
    <tr>
        <th style="width: 250px">@lang('dashboard.Name')</th>
        <th style="width: 250px">@lang('dashboard.Email')</th>
        <th style="width: 250px">@lang('dashboard.Phone')</th>
    </tr>
    </thead>
    <tbody>
    @foreach($managers as $manager)
        <tr>
            <td>{{ $manager->name }}</td>
            <td>{{ $manager->email }}</td>
            <td>{{ $manager->phone }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
