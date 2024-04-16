@php use Carbon\Carbon; @endphp
<table>
    <thead>
    <tr>
        <th style="width: 250px">@lang('dashboard.Name')</th>
        <th style="width: 250px">@lang('dashboard.categories')</th>
        <th style="width: 250px">@lang('dashboard.Activation')</th>
    </tr>
    </thead>
    <tbody>
    @foreach($fields as $field)
        <tr>
            <td>{{ $field->t('name') }}</td>
            <td>
                @forelse($field->categories as $category)
                    {{$category->t('name')}} {{ !$loop->last ? ', ' : '' }}
                @empty
                    @lang('dashboard.none')
                @endforelse
            </td>
            <td>{{ $field->is_active ? __('dashboard.Yes') : __('dashboard.No') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
