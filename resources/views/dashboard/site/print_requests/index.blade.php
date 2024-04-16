@extends('dashboard.core.app')
@section('title', __('dashboard.' . $type . 'S_print_requests'))
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.' . $type . 'S_print_requests')</h1>
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
                            <h3 class="card-title">@lang('dashboard.' . $type . 'S_print_requests')</h3>
                            <div class="card-tools">
                                @if($type == "BOOK")
                                    <a  href="{{ route('requests.exportBooks', ['excel', ...request()->query()]) }}" class="btn  btn-success">@lang('dashboard.Excel Export')</a>
                                    <a  href="{{ route('requests.exportBooks', ['pdf', ...request()->query()]) }}" class="btn  btn-danger">@lang('dashboard.PDF Export')</a>
                                @else
                                    <a  href="{{ route('requests.exportCertificates', ['excel', ...request()->query()]) }}" class="btn  btn-success">@lang('dashboard.Excel Export')</a>
                                    <a  href="{{ route('requests.exportCertificates', ['pdf', ...request()->query()]) }}" class="btn  btn-danger">@lang('dashboard.PDF Export')</a>
                                @endif
                                 </div>
                        </div>
                        <div class="card-body">

                            <form action="@if($type == "BOOK") {{route('requests.books.index')}} @else {{route('requests.certificates.index')}} @endif">
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
                                    @if($type == 'BOOK')
                                        <th>@lang('dashboard.Book\Bag')</th>
                                    @else
                                        <th>@lang('dashboard.Certificate of Course')</th>
                                    @endif
                                    <th>@lang('dashboard.status')</th>
                                    <th>@lang('dashboard.Operations')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($requests as $key => $request)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td><a target="_blank" href="{{route('student.show' , $request->user->id)}}">{{$request->user->name}}</a></td>
                                        @if($request->book)
                                            <td>{{$request->book->t('name')}}</td>
                                        @else
                                            <td>{{$request->course?->t('name')}}</td>
                                        @endif

                                        <td>

                                            <select data-id="{{$request->id}}" class="form-control w-50 text-center status" name="status">
                                                <option value="ORDERED"   @selected($request->status == "ORDERED")>@lang('dashboard.ORDERED')</option>
                                                <option value="APPROVED"  @selected($request->status == "APPROVED")>@lang('dashboard.APPROVED')</option>
                                                <option value="DELIVERED" @selected($request->status == "DELIVERED")>@lang('dashboard.DELIVERED')</option>
                                                <option value="CANCELED"  @selected($request->status == "CANCELED")>@lang('dashboard.CANCELED')</option>
                                            </select>

{{--                                            <button class="btn btn-{{$request->btnColor}}">@lang('dashboard.' . $request['status'])</button>--}}
                                        </td>
                                        <td>
                                            <div class="operations-btns" style="">
                                                @if(auth()->user()->hasPermission('standards-update'))
                                                    <a href="{{ route('requests.show', $request['id'])}}" class="btn  btn-dark">@lang('dashboard.Show')</a>
                                                @endif

                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    @include('dashboard.core.includes.no-entries', ['columns' => 7])
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            {{ $requests->appends(request()->all())->links() }}
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

@section('js_addons')
    <script>
        $('.status').on('change' , function (){
            const status = $('.status :selected').val();
            const id = $(this).data('id');
            $.ajax({
                url: "{{ route('requests.changeStatus') }}/" + id,
                type: "POST",
                data: {
                    status: status,
                    _token: '{!! csrf_token() !!}',
                    _method : "PUT"
                },

            });
        })
    </script>

@endsection
