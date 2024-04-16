@php use Illuminate\Support\Facades\Gate; @endphp

@extends('dashboard.core.app')
@section('title', __('titles.Courses'))
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.courses')</h1>
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
                            <h3 class="card-title">@lang('dashboard.courses')</h3>
                            <div class="card-tools">
                                @if(auth()->user()->hasPermission('courses-create'))
                                    <a href="{{route('courses.create')}}" class="btn  btn-dark">@lang('dashboard.Create')</a>
                                @endif
                                <a  href="{{ route('courses.export', ['excel', ...request()->query()]) }}" class="btn  btn-success">@lang('dashboard.Excel Export')</a>
                                <a  href="{{ route('courses.export', ['pdf', ...request()->query()]) }}" class="btn  btn-danger">@lang('dashboard.PDF Export')</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{route('courses.index')}}">
                                <div class="row">

                                    <div class="form-group col-6">
                                        <select id="type" name="field" class="form-control">
                                            <option value="ALL">@lang('dashboard.all_items')</option>
                                            @foreach($fields as $field)
                                                <option @selected(request('field') == $field['id']) value="{{$field['id']}}">{{$field->t('name')}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-4">
                                        <button type="submit" class="btn btn-dark">@lang('dashboard.filter')</button>
                                    </div>
                                </div>
                            </form>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>@lang('dashboard.Image')</th>
                                    <th>@lang('dashboard.Name')</th>
                                    <th>@lang('dashboard.price')</th>
                                    <th>@lang('dashboard.app_price')</th>
                                    <th>@lang('dashboard.category') </th>
                                    <th>@lang('dashboard.Activation')</th>
                                    <th>@lang('dashboard.Registration_status')</th>
                                    <th>@lang('dashboard.Operations')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($courses as $key => $course)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td><img src="{{ !is_null($course->image) ? $course->image : '' }}" style="width: 100px;" /></td>
                                        <td>{{$course->t('name')}}</td>
                                        <td>{{$course->price}} @lang('dashboard.riyal')</td>
                                        <td>{{$course->app_price}} @lang('dashboard.riyal')</td>
                                        <td><a href="{{route('categories.show' , $course->category_id)}}">{{$course->category?->t('name') ?? __('dashboard.none')}}</a></td>
                                        <td>{{$course->is_active ? __('dashboard.active') : __('dashboard.in_active')}}</td>
                                        <td>{{$course->registration_status ? __('dashboard.open') : __('dashboard.closed')}}</td>

                                        <td>
                                            <div class="operations-btns" style="">
                                                @if(auth()->user()->hasPermission('courses-update'))
                                                    <a href="{{ route('courses.edit', $course['id']) }}" class="btn  btn-dark">@lang('dashboard.Edit')</a>
                                                @endif
                                                    <a href="{{ route('courses.show', $course['id']) }}" class="btn  btn-dark">@lang('dashboard.Show')</a>

                                                @if(Gate::allows('delete-course' , $course) && auth()->user()->hasPermission('courses-delete'))
                                                        <button class="btn btn-dark waves-effect waves-light" data-toggle="modal" data-target="#delete-modal{{$key}}">@lang('dashboard.Delete')</button>
                                                        <div id="delete-modal{{$key}}" class="modal fade modal2 " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">                                                    <div class="modal-dialog">
                                                                <div class="modal-content float-left">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">تأكيد الحذف</h5>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>@lang('dashboard.sure_delete')</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" data-dismiss="modal" class="btn btn-dark waves-effect waves-light m-l-5 mr-1 ml-1">
                                                                            @lang('dashboard.close')
                                                                        </button>
                                                                        <form action="{{route('courses.destroy' , $course['id'])}}" method="post">
                                                                            @csrf
                                                                            {{method_field('DELETE')}}
                                                                            <button type="submit" class="btn btn-danger">@lang('dashboard.Delete')</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                @endif
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
                            {{ $courses->appends(request()->all())->links() }}
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
