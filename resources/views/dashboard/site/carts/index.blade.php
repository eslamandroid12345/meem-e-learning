@extends('dashboard.core.app')
@section('title', __('titles.Carts'))
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.carts')</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">@lang('dashboard.carts')</h3>
                            <div class="card-tools">
                                <a  href="{{ route('carts.export', ['excel', ...request()->query()]) }}" class="btn  btn-success">@lang('dashboard.Excel Export')</a>
                                <a  href="{{ route('carts.export', ['pdf', ...request()->query()]) }}" class="btn  btn-danger">@lang('dashboard.PDF Export')</a>
                            </div>

                        </div>
                        <div class="card-body">

                            <form action="{{route('carts.index')}}">
                                <div class="row">

                                    <div class="form-group col-2">
                                        <select name="course"  id="items" class="form-control">
                                            <option value="ALL">@lang('dashboard.all_items')</option>
                                            <optgroup label="@lang('dashboard.courses')">
                                                @foreach($courses as $course)
                                                    <option @selected(request('course') == $course->id) value="{{$course['id']}}">{{$course->t('name')}}</option>
                                                @endforeach
                                            </optgroup>


                                        </select>
                                    </div>
                                    <div class="form-group col-3">
                                        <input value="{{request('search') ?? ""}}" name="search" type="search" class="form-control" placeholder="@lang('dashboard.search_with_phone_number')">
                                    </div>


                                    <div class="form-group col-2">
                                        <input value="{{request('from_date') ?? ""}}" name="from_date" type="date" class="form-control" placeholder="@lang('dashboard.search_with_phone_number_or_name_or_email')">
                                    </div>
                                    <p class="mt-2">@lang('dashboard.to')</p>

                                    <div class="form-group col-2">
                                        <input value="{{request('to_date') ?? ""}}" name="to_date" type="date" class="form-control" placeholder="@lang('dashboard.search_with_phone_number_or_name_or_email')">
                                    </div>


                                    <div class="form-group col-2">
                                        <button type="submit" class="btn btn-dark">@lang('dashboard.filter')</button>
                                    </div>
                                </div>
                            </form>

                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>@lang('dashboard.student')</th>
                                    <th>@lang('dashboard.items_count')</th>
                                    <th>@lang('dashboard.created_at')</th>
                                    <th>@lang('dashboard.Operations')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($carts as $key => $cart)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td><a target="_blank" href="{{route('student.show' , $cart->user->id)}}">{{$cart->user->name}}</a> </td>
                                        <td>{{count($cart->items)}}</td>
                                        <td>{{$cart->created_at->diffForHumans()}}</td>
                                        <td>
                                            <div class="operations-btns" style="">
                                                    <a href="{{ route('carts.show', $cart['id']) }}" class="btn  btn-dark">@lang('dashboard.Show')</a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    @include('dashboard.core.includes.no-entries', ['columns' => 6])
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            {{ $carts->appends(request()->all())->links() }}
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
