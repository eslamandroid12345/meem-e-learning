@php use Illuminate\Support\Facades\Gate;use Illuminate\Support\Str; @endphp
@extends('dashboard.core.app')
@section('title', __('titles.Inquiries'))
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.Inquiries')</h1>
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
                            <h3 class="card-title">@lang('dashboard.Inquiries')</h3>
                            <div class="card-tools">
                                <a  href="{{ route('inquiries.export', ['excel', ...request()->query()]) }}" class="btn  btn-success">@lang('dashboard.Excel Export')</a>
                                <a  href="{{ route('inquiries.export', ['pdf', ...request()->query()]) }}" class="btn  btn-danger">@lang('dashboard.PDF Export')</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{route('inquiries.index')}}">
                                <div class="row">
                                    <div class="form-group col-2">
                                        <select name="course" id="items" class="form-control">
                                            <option value="ALL">@lang('dashboard.all_items')</option>
                                            <optgroup label="@lang('dashboard.courses')">
                                                @foreach($courses as $course)
                                                    <option @selected(request('course') == $course['id']) value="{{$course['id']}}">{{$course->t('name')}}</option>
                                                @endforeach
                                            </optgroup>

                                        </select>
                                    </div>


                                    <div class="form-group col-2">
                                        <select id="type" name="type" class="form-control">
                                            <option @selected(request('type') == "ALL") value="ALL">@lang('dashboard.Is Answered') (@lang('dashboard.all_items'))</option>
                                            <option @selected(request('type') == "0")  value="0">@lang('dashboard.not_answered_yet')</option>
                                            <option @selected(request('type') == "1")  value="1">@lang('dashboard.is_answered')</option>
                                        </select>
                                    </div>


                                    <div class="form-group col-2">
                                        <select id="type" name="questions_type" class="form-control">
                                            <option @selected(request('questions_type') == "ALL") value="ALL">@lang('dashboard.Type') (@lang('dashboard.all_items'))</option>
                                            <option @selected(request('questions_type') == "EDUCATIONAL")  value="EDUCATIONAL">@lang('db.inquiries.EDUCATIONAL')</option>
                                            <option @selected(request('questions_type') == "TECHNICAL")  value="TECHNICAL">@lang('db.inquiries.TECHNICAL')</option>
                                        </select>
                                    </div>


                                    <div class="form-group col-2">
                                        <select id="type" name="is_public" class="form-control">
                                            <option @selected(request('is_public') == "ALL") value="ALL">@lang('dashboard.Is Public')؟ (@lang('dashboard.all_items'))</option>
                                            <option @selected(request('is_public') == "1")  value="1">@lang('dashboard.Yes')</option>
                                            <option @selected(request('is_public') == "0")  value="0">@lang('dashboard.No')</option>
                                        </select>
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
                                    <th>@lang('dashboard.Type')</th>
                                    <th>@lang('dashboard.Question')</th>
                                    <th>@lang('dashboard.Course')</th>
                                    <th>@lang('dashboard.Student')</th>
                                    <th>@lang('dashboard.Is Answered')</th>
                                    <th>@lang('dashboard.Is Public')</th>
                                    <th>@lang('dashboard.Operations')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($inquiries as $key => $inquiry)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ __('db.inquiries.'.$inquiry->type) }}</td>
                                        <td>{{ Str::limit($inquiry->question, 200) }}</td>
                                        <td>{{$inquiry->course->t('name')}}</td>
                                        <td>{{$inquiry->user?->name}}</td>
                                        <td>{{$inquiry->is_answered ? __('dashboard.Yes') : __('dashboard.No')}}</td>
                                        <td>{{$inquiry->is_public ? __('dashboard.Yes') : __('dashboard.No')}}</td>
                                        <td>
                                            <div class="operations-btns" style="">
                                                @if(auth()->user()->hasPermission('inquiries-update'))
                                                    <a href="{{ route('inquiries.show', $inquiry['id']) }}"
                                                       class="btn  btn-dark">@lang('dashboard.Show')</a>
                                                @endif
                                                @if(Gate::allows('operate-inquiry', $inquiry) && auth()->user()->hasPermission('inquiries-delete'))
                                                    <button class="btn btn-dark waves-effect waves-light"
                                                            data-toggle="modal"
                                                            data-target="#delete-modal{{$key}}">@lang('dashboard.Delete')</button>
                                                    <div id="delete-modal{{$key}}" class="modal fade modal2 "
                                                         tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                                         aria-hidden="true" style="display: none;">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content float-left">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">@lang('dashboard.confirm_delete')</h5>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>@lang('dashboard.sure_delete')</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" data-dismiss="modal"
                                                                            class="btn btn-dark waves-effect waves-light m-l-5 mr-1 ml-1">
                                                                        @lang('dashboard.close')
                                                                    </button>
                                                                    <form
                                                                        action="{{route('inquiries.destroy' , $inquiry['id'])}}"
                                                                        method="post">
                                                                        @csrf
                                                                        {{method_field('DELETE')}}
                                                                        <button type="submit"
                                                                                class="btn btn-danger">@lang('dashboard.Delete')</button>
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
                                    @include('dashboard.core.includes.no-entries', ['columns' => 8])
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            {{ $inquiries->appends(request()->all())->links() }}
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
