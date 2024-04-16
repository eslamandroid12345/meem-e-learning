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
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <h3>{{__('db.exam_type.'.$exam->type) . ': ' . $exam->{strtolower($exam->type)}->t('name')}}</h3>
                                </div>
                                <div class="col-4">
                                    <h3>@lang('dashboard.questions_count') : {{$exam->questions->count()}}</h3>
                                </div>
                                <div class="col-4">
                                    <h3>@lang('dashboard.duration') : {{$exam->duration}} @lang('dashboard.minutes')</h3>
                                </div>
                            </div>
                            <hr>
                            <div class="row mt-4">
                                @forelse($exam->questions as $question)
                                    <div class="col-12 text-center ml-5">----------------------------------------------------------------------------------------------------------------</div>
                                    <div class="col-12 row">
                                        <h3> {!! $question->content !!}</h3>

                                        @forelse($question->answers as $answer)
                                            <div class="col-12 row">
                                                <div class="col-8">
                                                    <h5> {!! $answer->content !!}  </h5>

                                                </div>
                                                <div class="col-4">

                                                    <p style="font-size: 20px "> @if($answer->is_correct) <i style="color: green" class="fa fa-check"></i> @endif {{$answer->comment}} </p>

                                                </div>
                                            </div>
                                        @empty
                                            @lang('dashboard.none')
                                        @endforelse
                                    </div>


                                @empty
                                    @lang('dashboard.none')
                                @endforelse
                            </div>
                            <hr>
                            <div>
                                <a href="{{route('exams.edit' , $exam->id)}}"><button class="btn btn-dark">@lang('dashboard.Edit')</button></a>
                                <a href="{{route('exams.show' , $exam->id)}}"><button class="btn btn-dark">@lang('dashboard.back')</button></a>
{{--                                @if(Gate::allows('delete-exam', $exam) && auth()->user()->hasPermission('exams-delete'))--}}
{{--                                    <button class="btn btn-dark waves-effect waves-light" data-toggle="modal" data-target="#delete-modal0">@lang('dashboard.delete_exam')</button>--}}
{{--                                    <div id="delete-modal0" class="modal fade modal2 " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">--}}
{{--                                        <div class="modal-dialog">--}}
{{--                                            <div class="modal-content float-left">--}}
{{--                                                <div class="modal-header">--}}
{{--                                                    <h5 class="modal-title">@lang('dashboard.confirm_delete')</h5>--}}
{{--                                                </div>--}}
{{--                                                <div class="modal-body">--}}
{{--                                                    <p>@lang('dashboard.sure_delete')</p>--}}
{{--                                                </div>--}}
{{--                                                <div class="modal-footer">--}}
{{--                                                    <button type="button" data-dismiss="modal" class="btn btn-dark waves-effect waves-light m-l-5 mr-1 ml-1">--}}
{{--                                                        @lang('dashboard.close')--}}
{{--                                                    </button>--}}
{{--                                                    <form action="{{route('exams.destroy' , $exam['id'])}}" method="post">--}}
{{--                                                        @csrf--}}
{{--                                                        {{method_field('DELETE')}}--}}
{{--                                                        <button type="submit" class="btn btn-danger">@lang('dashboard.Delete')</button>--}}
{{--                                                    </form>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                @endif--}}

                            </div>
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
