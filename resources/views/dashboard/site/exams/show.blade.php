@extends('dashboard.core.app')
@section('title', __('titles.t-Details', ['t' => __('titles.Exam')]))

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
                            <h3 class="card-title">{{__('titles.t-Details', ['t' => __('titles.Exam')])}}</h3>
                            <a href="{{route('exams.preview' , $exam->id)}}"><button class="btn btn-dark mr-3 ml-3">@lang('dashboard.preview_exam')</button></a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-12 col-sm-4">
                                            <div class="info-box bg-dark">
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-center">@lang('dashboard.exam_type')</span>
                                                    <span class="info-box-number text-center mb-0">{{__('dashboard.' . $exam->type )}}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-4">
                                            <div class="info-box bg-dark">
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-center">@lang('dashboard.duration_in_minutes')</span>
                                                    <span class="info-box-number text-center mb-0">{{$exam->duration}}
                                                        @if($exam->duration == 1)
                                                            @lang('dashboard.one_minute')
                                                        @elseif($exam->duration > 1 && $exam->duration < 11)
                                                            @lang('dashboard.minutes')
                                                        @else
                                                            @lang('dashboard.minute')
                                                        @endif</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-4">
                                            <div class="info-box bg-dark">
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-center">@lang('dashboard.Course')</span>
                                                    <span class="info-box-number text-center mb-0"><a style="color: #FFF" target="_blank" href="{{route('courses.show' , $exam->course->id)}}">{{ $exam->course->t('name') }}</a></span>
                                                </div>
                                            </div>
                                        </div>

                                        @if($exam->type == "STANDARD" || $exam->type == "LECTURE")
                                            <div class="col-12 col-sm-4">
                                                <div class="info-box bg-dark">
                                                    <div class="info-box-content">
                                                        <span class="info-box-text text-center">@lang('dashboard.Standard')</span>
                                                        <span class="info-box-number text-center mb-0"> <a style="color: #FFF" target="_blank" href="{{route('standards.show' , $exam->standard->id)}}">{{ $exam->standard->t('name') }}</a></span>
                                                    </div>
                                                </div>
                                            </div>

                                        @endif

                                        @if($exam->type == "LECTURE")

                                            <div class="col-12 col-sm-4">
                                                <div class="info-box bg-dark">
                                                    <div class="info-box-content">
                                                        <span class="info-box-text text-center">@lang('dashboard.Lecture')</span>
                                                        <span class="info-box-number text-center mb-0"><a style="color: #FFF" target="_blank" href="{{route('lectures.show' , $exam->lecture->id)}}">{{ $exam->lecture->t('name') }}</a></span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

{{--                                        <div class="col-12 col-sm-4">--}}
{{--                                            <div class="info-box bg-dark">--}}
{{--                                                <div class="info-box-content">--}}
{{--                                                    <span class="info-box-text text-center">@lang('dashboard.max_attempts')</span>--}}
{{--                                                    <span class="info-box-number text-center mb-0">{{  $exam->attempts }}</span>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}


                                        <div class="col-12 col-sm-4">
                                            <div class="info-box bg-dark">
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-center">@lang('dashboard.solution_video_link')</span>
                                                    <span class="info-box-number text-center mb-0"><a style="color: #FFF" target="_blank" href="{{$exam->solution_video_link}}">@lang('dashboard.watch')</a></span>
                                                </div>
                                            </div>
                                        </div>

                                            <div class="col-12 col-sm-4">
                                                <div class="info-box bg-dark">
                                                    <div class="info-box-content">
                                                        <span class="info-box-text text-center">@lang('dashboard.total_students_attended_exam')</span>
                                                        <span class="info-box-number text-center mb-0">
                                                            {{$examNumbers['max'] > 0 ? $examNumbers['total'] : 0 }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                        <div class="col-12 col-sm-4">
                                            <div class="info-box bg-dark">
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-center">@lang('dashboard.exam_max_degree')</span>
                                                    <span class="info-box-number text-center mb-0">
                                                            {{number_format($examNumbers['max']['degree'] ?? 0)}} %
                                                        </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-4">
                                            <div class="info-box bg-dark">
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-center">@lang('dashboard.students_had_max_degree')</span>
                                                    <span class="info-box-number text-center mb-0">
                                                            {{$examNumbers['max']['count'] ?? 0}}
                                                        </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-4">
                                            <div class="info-box bg-dark">
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-center">@lang('dashboard.students_had_max_degree_percentage')</span>
                                                    <span class="info-box-number text-center mb-0">
                                                            {{$examNumbers['total'] !== 0 ? (number_format(($examNumbers['max']['count'] ?? 0 / $examNumbers['total']  * 100)  )) : 0}} %
                                                        </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-4">
                                            <div class="info-box bg-dark">
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-center">@lang('dashboard.exam_min_degree')</span>
                                                    <span class="info-box-number text-center mb-0">
                                                            {{$examNumbers['min']['degree'] ?? 0}} %
                                                        </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-4">
                                            <div class="info-box bg-dark">
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-center">@lang('dashboard.students_had_min_degree')</span>
                                                    <span class="info-box-number text-center mb-0">
                                                            {{$examNumbers['min']['count'] ?? 0}}
                                                        </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-4">
                                            <div class="info-box bg-dark">
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-center">@lang('dashboard.students_had_min_degree_percentage')</span>
                                                    <span class="info-box-number text-center mb-0">
                                                            {{$examNumbers['total'] !== 0 ? number_format(($examNumbers['min']['count'] ?? 0 / $examNumbers['total']  * 100)) : 0 }} %
                                                        </span>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">@lang('dashboard.Questions')</h3>
                                    <div class="card-tools">
                                        @if(auth()->user()->hasPermission('exams-create'))
                                            <a href="{{route('questions.create', $exam['id'])}}" class="btn  btn-dark">@lang('dashboard.Create')</a>
                                        @endif

                                            <a href="{{route('exam-bank-questions.create',$exam->id)}}" class="btn  btn-dark">اضافه من بنك الاسئله</a>

                                    </div>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>@lang('dashboard.Question Content')</th>
                                            <th>@lang('dashboard.Question_correct_percentage')</th>
                                            <th>@lang('dashboard.Question_wrong_percentage')</th>
                                            <th>@lang('dashboard.Activation')</th>
                                            <th>@lang('dashboard.Operations')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($exam->questions as $key => $question)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{\Illuminate\Support\Str::limit(strip_tags($question->content) , 100)}}</td>
{{--                                                <td>{!! $question->content !!}</td>--}}
                                                <td>{{$question->allAnswers() > 0 ? number_format( $question->correctAnswers() / $question->allAnswers() * 100) : 0}} %</td>
                                                <td>{{$question->allAnswers() > 0 ? number_format(($question->allAnswers() - $question->correctAnswers()) / $question->allAnswers() * 100 ) : 0}} %</td>
                                                <td>{{ $question->is_active ? __('dashboard.active') : __('dashboard.in_active') }}</td>
                                                <td>
                                                    <div class="operations-btns" style="">
                                                        @if(auth()->user()->hasPermission('exams-update'))
                                                            <a href="{{ route('questions.edit', [$exam->id , $question->id ] ) }}" class="btn  btn-dark">@lang('dashboard.Edit')</a>
                                                        @endif
                                                        @if(auth()->user()->hasPermission('exams-update'))
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
                                                                            <form action="{{route('questions.destroy' , [$exam['id'] , $question['id'] ])}}" method="post">
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
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.card-body -->
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
