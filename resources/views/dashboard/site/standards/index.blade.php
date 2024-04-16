@php use Illuminate\Support\Facades\Gate; @endphp
@extends('dashboard.core.app')
@section('title', __('titles.Standards'))
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.Standards')</h1>
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
                            <h3 class="card-title">@lang('dashboard.Standards')</h3>
                            <div class="card-tools">
                                @if(auth()->user()->hasPermission('standards-create'))
                                    <a href="{{route('standards.create')}}" class="btn  btn-dark">@lang('dashboard.Create')</a>
                                @endif
                                <a  href="{{ route('standards.export', ['excel', ...request()->query()]) }}" class="btn  btn-success">@lang('dashboard.Excel Export')</a>
                                <a  href="{{ route('standards.export', ['pdf', ...request()->query()]) }}" class="btn  btn-danger">@lang('dashboard.PDF Export')</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{route('standards.index')}}">
                                <div class="row">

                                    <div class="form-group col-6">
                                        <select name="course" class="form-control">
                                            <option value="ALL">@lang('dashboard.all_items')</option>
                                            @foreach($fields as $field)
                                                <optgroup label="{{$field->t('name')}}">
                                                    @foreach($field->categories as $category)
                                                        @foreach($category->courses as $course)
                                                            <option @selected(request('course') == $course->id) value="{{$course->id}}">{{$course->t('name')}}</option>
                                                        @endforeach
                                                    @endforeach
                                                </optgroup>
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
                                    <th>@lang('dashboard.Name Ar')</th>
                                    <th>@lang('dashboard.Name En')</th>
                                    <th>@lang('dashboard.Course')</th>
                                    <th>@lang('dashboard.Operations')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($standards as $key => $standard)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{$standard->name_ar}}</td>
                                        <td>{{$standard->name_en}}</td>
                                        <td>{{$standard->course->t('name')}}</td>
                                        <td>
                                            <div class="operations-btns" style="">
                                                @if(auth()->user()->hasPermission('standards-update'))
                                                    <a href="{{ route('standards.edit', $standard['id']) }}" class="btn  btn-dark">@lang('dashboard.Edit')</a>
                                                @endif
                                                @if(auth()->user()->hasPermission('standards-read'))
                                                    <a href="{{ route('standards.show', $standard['id']) }}" class="btn  btn-dark">@lang('dashboard.Show')</a>
                                                @endif
                                                @if(Gate::allows('delete-standard', $standard) && auth()->user()->hasPermission('standards-delete'))
                                                    <button class="btn btn-dark waves-effect waves-light" data-toggle="modal" data-target="#delete-modal{{$key}}">@lang('dashboard.Delete')</button>
                                                    <div id="delete-modal{{$key}}" class="modal fade modal2 " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content float-left">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">@lang('dashboard.confirm_delete')</h5>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>@lang('dashboard.sure_delete')</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" data-dismiss="modal" class="btn btn-dark waves-effect waves-light m-l-5 mr-1 ml-1">
                                                                        @lang('dashboard.close')
                                                                    </button>
                                                                    <form action="{{route('standards.destroy' , $standard['id'])}}" method="post">
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
                                    @include('dashboard.core.includes.no-entries', ['columns' => 4])
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            {{ $standards->appends(request()->all())->links() }}
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
