@php use Illuminate\Support\Facades\Gate; @endphp
@extends('dashboard.core.app')
@section('title', __('titles.Exams'))
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.Exams')</h1>
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
                            <h3 class="card-title">@lang('dashboard.Exams')</h3>
                            <div class="card-tools">
                                @if(auth()->user()->hasPermission('exams-create'))
                                    <a href="{{route('exams.create')}}" class="btn  btn-dark">@lang('dashboard.Create')</a>
                                @endif
                                <a  href="{{ route('exams.export', ['excel', ...request()->query()]) }}" class="btn  btn-success">@lang('dashboard.Excel Export')</a>
                                <a  href="{{ route('exams.export', ['pdf', ...request()->query()]) }}" class="btn  btn-danger">@lang('dashboard.PDF Export')</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{route('exams.index')}}">
                                <div class="row">

                                    <div class="form-group col-4">
                                        <select name="type" class="form-control">
                                            <option @selected(request('type') == "ALL") value="ALL">@lang('dashboard.all_items')</option>
                                            <option @selected(request('type') == "COURSE") value="COURSE">@lang('dashboard.course_exam')</option>
                                            <option @selected(request('type') == "STANDARD") value="STANDARD">@lang('dashboard.standard_exam')</option>
                                            <option @selected(request('type') == "LECTURE") value="LECTURE">@lang('dashboard.lecture_exam')</option>
                                        </select>
                                    </div>


                                    <div class="form-group col-4">
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
                                    <th>@lang('dashboard.title')</th>
                                    <th>@lang('dashboard.exam_type')</th>
                                    <th>@lang('dashboard.COURSE')</th>
                                    <th>@lang('dashboard.duration')</th>
{{--                                    <th>@lang('dashboard.max_attempts')</th>--}}
                                    <th>@lang('dashboard.solution_video_link')</th>
                                    <th>@lang('dashboard.Operations')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($exams as $key => $exam)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{__('db.exam_type.'.$exam?->type) . ': ' . $exam?->{strtolower($exam?->type)}->t('name')}}</td>
                                        <td>{{__('dashboard.' . $exam->type)}}</td>
                                        <td>{{$exam->course->t('name')}}</td>
                                        <td>{{$exam->duration}}
                                            @if($exam->duration == 1)
                                                @lang('dashboard.one_minute')
                                            @elseif($exam->duration > 1 && $exam->duration < 11)
                                                @lang('dashboard.minutes')
                                            @else
                                                @lang('dashboard.minute')
                                            @endif
                                        </td>
{{--                                        <td>{{$exam->attempts}}</td>--}}
                                        <td>
                                           @if($exam['solution_video_link'])
                                               <a target="_blank" href="{{$exam['solution_video_link']}}">
                                                   <button class="btn btn-success">
                                                       @lang('dashboard.watch')
                                                       <i class="fa fa-video"></i>
                                                   </button>
                                               </a>
                                            @else
                                               @lang('dashboard.none')
                                            @endif
                                        </td>
                                        <td>
                                            <div class="operations-btns" style="">
                                                @if(auth()->user()->hasPermission('exams-update'))
                                                    <a href="{{ route('exams.edit', $exam['id']) }}" class="btn  btn-dark">@lang('dashboard.Edit')</a>
                                                @endif
                                                @if(auth()->user()->hasPermission('exams-read'))
                                                    <a href="{{ route('exams.show', $exam['id']) }}" class="btn  btn-dark">@lang('dashboard.details')</a>
                                                @endif
                                                @if(Gate::allows('delete-exam', $exam) && auth()->user()->hasPermission('exams-delete'))
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
                                                                    <form action="{{route('exams.destroy' , $exam['id'])}}" method="post">
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
                            {{ $exams->appends(request()->all())->links() }}
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
