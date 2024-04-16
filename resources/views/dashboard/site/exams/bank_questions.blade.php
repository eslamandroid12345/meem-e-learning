@extends('dashboard.core.app')
@section('title', __('titles.Create') . " " . __('titles.Question'))

@section('css_addons')
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.Questions')</h1>
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
                        <form action="{{route('exam-bank-questions.store',$exam->id)}}" method="post" autocomplete="off" enctype="multipart/form-data">
                            <div class="card-header">
                                <h3 class="card-title">{{__('titles.Create') . " " . __('titles.Question')}}</h3>
                            </div>
                            <div class="card-body">
                                @csrf
                                @if($exam->questions_type !== null)
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label for="type">@lang('dashboard.'.ucfirst($exam->questions_type).' Name')</label>
                                            <select id="type" name="{{ $exam->questions_type }}_id" class="form-control">
                                                @foreach($exam->{strtolower($exam->type)}->{$exam->questions_type.'s'} as $type)
                                                    <option @selected(old('question.'.$exam->questions_type.'_id') == $type->id ) value="{{$type->id}}">{{$type->t('name')}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif


                                <div class="row">
                                    <div class="form-group col-12 mb-5">
                                        <label for="type">@lang('dashboard.courses_selected')</label>
                                        <select id="type" name="course_id" class="form-control">
                                            <option value="" selected>@lang('dashboard.courses_selected')</option>
                                            @foreach($courses as $course)
                                                <option  value="{{$course->id}}">{{app()->getLocale() == 'ar' ? $course->name_ar : $course->name_en}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                    <div id="questions">

                                    </div>


                            </div>

                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-dark">@lang('dashboard.Create')</button>


                            </div>

                        </form>

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
        //get all questions by exam
        $(document).ready(function () {
            $('select[name="course_id"]').on('change', function () {

                let course_id =   $(this).val();

                    $.ajax({
                        url: "{{ route('getBankQuestionsByCourse')}}",
                        type: "GET",
                        dataType: "json",
                        data: {
                            "course_id": course_id,

                        },

                        success: function (data) {

                            $('#questions').empty();

                            $.each(data, function (key, value) {
                                var html = `
                                    <div class="form-group clearfix col-12" id="checkboxContainer${key}">
                                        <div class="icheck-wetasphalt d-inline">
                                            <input name="questions[]" type="checkbox" id="checkboxPrimary${key}" value="${value.id}">
                                            <label for="checkboxPrimary${key}">${value.content}</label>
                                        </div>
                                    <a href="{{url('/courses')}}/${value.course_id}/course_bank_questions/${value.id}/edit" target="_blank">{{__('dashboard.go_to_question')}}</a>
                                    </div>

                                `;
                                $("#questions").append(html);
                            });


                        },

                        error: function (){

                            $("#questions").append('');

                        }
                    });

            });
        });
    </script>
@endsection
