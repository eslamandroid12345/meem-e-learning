@php use Carbon\Carbon; @endphp
<table>
    <thead>
    <tr>
        <th style="width: 250px">@lang('dashboard.Name')</th>
        <th style="width: 250px">@lang('dashboard.Field')</th>
        <th style="width: 250px">@lang('dashboard.Activation')</th>
    </tr>
    </thead>
    <tbody>
    @foreach($categories as $category)
        <tr>
            <td>{{ $category->t('name') }}</td>
            <td>{{ $category->field->t('name') }}</td>
            <td>{{ $category->is_active ? __('dashboard.Yes') : __('dashboard.No') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
