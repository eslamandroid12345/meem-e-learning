<table class="table table-bordered">
    <thead>
    <tr>
        <th style="width: 250px">@lang('dashboard.student')</th>
        <th style="width: 250px">@lang('dashboard.items_count')</th>
        <th style="width: 250px">@lang('dashboard.created_at')</th>
    </tr>
    </thead>
    <tbody>
    @forelse($carts as $key => $cart)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td><a target="_blank" href="{{route('student.show' , $cart->user->id)}}">{{$cart->user->name}}</a> </td>
            <td>{{count($cart->items)}}</td>
            <td>{{$cart->created_at->diffForHumans()}}</td>
        </tr>
    @empty
        @include('dashboard.core.includes.no-entries', ['columns' => 6])
    @endforelse
    </tbody>
</table>
