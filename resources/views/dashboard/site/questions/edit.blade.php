@php use Illuminate\Support\Facades\Gate; @endphp
@extends('dashboard.core.app')
@section('title', __('titles.Edit') . " " . __('titles.Question'))

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
                        <form action="{{ route('questions.update', [$exam->id, $question->id]) }}" method="post" autocomplete="off" enctype="multipart/form-data">
                            <div class="card-header">
                                <h3 class="card-title">{{__('titles.Edit') . " " . __('titles.Question')}}</h3>
                            </div>
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row">
                                    @if($question->userAnswers->count() > 0)
                                        <div class="col-12">
                                            <p class="text-danger">@lang('dashboard.Editing this question will create it again and deactivate the old one so that it does not affect the previous statistics data')</p>
                                        </div>
                                    @endif
                                    @if($exam->question_type !== null)
                                        <div class="form-group col-12">
                                            <label for="type">@lang('dashboard.'.ucfirst($exam->question_type).' Name')</label>
                                            @if(Gate::allows('edit-exam-type', $exam))
                                                <select id="type" name="question[{{ $exam->question_type }}_id]" class="form-control">
                                                    @foreach($exam->{strtolower($exam->type)}->{$exam->question_type.'s'} as $type)
                                                        <option @selected(old('question.'.$exam->question_type.'_id') !== null ? old('question.'.$exam->question_type.'_id') == $type->id : $question->{$exam->question_type.'_id'} ==  $type->id) value="{{$type->id}}">{{$type->t('name')}}</option>
                                                    @endforeach
                                                </select>
                                            @else
                                                {{ $type->t('name') }}
                                            @endif
                                        </div>
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label for="exampleInputName1">@lang('dashboard.Question Content')</label>
                                        <textarea name="question[content]" type="text" class="form-control" id="summernote">{{ old('question.content') ?? $question->content }}</textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-10"></div>
                                    <div class="col-2">
                                        <div id="add_answer" style="cursor: pointer;"><i class="nav-icon fas fa-plus-circle"></i> @lang('dashboard.Add Answer')</div>
                                    </div>
                                </div>
                                <div class="row answers"></div>
                                <div class="form-group clearfix col-12">
                                    <input name="question[is_active]" type="hidden" value="off">
                                    <div class="icheck-wetasphalt d-inline">
                                        <input name="question[is_active]" type="checkbox" id="checkboxPrimary3" @checked(old('is_active') != null ? old('is_active') == 'on' : $question->is_active)>
                                        <label for="checkboxPrimary3">@lang('dashboard.Activate')</label>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-dark">@lang('dashboard.Edit')</button>
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
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function () {
            bsCustomFileInput.init();
            $('#summernote').summernote();
            $('.select2').select2({
                language: {
                    searching: function() {}
                },
            });
        });
    </script>
    <script>
        $(function () {
            let answer_count = 0;

            @foreach(old('answers') ?? $question->answers as $key => $answer)
            const old_answer_{{$key}} = '' +
                '<div class="col-6 answer">' +
                '    <div class="form-group clearfix">' +
                '        <div class="row">' +
                '            <div class="col-10">' +
                '                <label for="exampleInputName1">@lang('dashboard.Answer')</label>' +
                '            </div>' +
                '            <div class="col-2">' +
                '                <div class="delete_answer" style="cursor: pointer;color: #ff0000;"><i class="nav-icon fas fa-minus-circle"></i></div>' +
                '            </div>' +
                '        </div>' +
                '        <div class="icheck-wetasphalt d-inline">' +
                '            <input type="radio" id="radioPrimary'+ answer_count +'" name="answers[' + answer_count + '][is_correct]" @checked(old('answers.'.$key.'.is_correct') !== null ? old('answers.'.$key.'.is_correct') == 'on' : $answer->is_correct ?? false)>' +
                '            <label for="radioPrimary'+ answer_count +'" class="w-100">' +
                '            </label>' +
                '            <textarea name="answers[' + answer_count + '][content]" type="text" class="form-control summernote" id="exampleInputName1"> {{ old('answers.'.$key.'.content') ?? $answer->content ?? '' }}</textarea>' +
                '            <input name="answers[' + answer_count + '][comment]" type="text" class="form-control" id="exampleInputName1" value="{{ old('answers.'.$key.'.comment') ?? $answer->comment ?? '' }}" placeholder="">' +

                '</div>' +
                '    </div>' +
                '</div>' +
                '';
            $('.answers').append(old_answer_{{$key}});
            answer_count++;
            $('.summernote').summernote();


            $("input[type=radio]").click(function(event) {
                $("input[type=radio]").prop("checked", false);
                $(this).prop("checked", true);
            });
            @endforeach
            $('#add_answer').on('click', function (e) {
                const answer = '' +
                    '<div class="col-6 answer">' +
                    '    <div class="form-group clearfix">' +
                    '        <div class="row">' +
                    '            <div class="col-10">' +
                    '                <label for="exampleInputName1">@lang('dashboard.Answer')</label>' +
                    '            </div>' +
                    '            <div class="col-2">' +
                    '                <div class="delete_answer" style="cursor: pointer;color: #ff0000;"><i class="nav-icon fas fa-minus-circle"></i></div>' +
                    '            </div>' +
                    '        </div>' +
                    '        <div class="icheck-wetasphalt d-inline">' +
                    '            <input type="radio" id="radioPrimary'+ answer_count +'" name="answers[' + answer_count + '][is_correct]">' +
                    '            <label for="radioPrimary'+ answer_count +'" class="w-100">' +
                    '            </label>' +
                    '            <textarea name="answers[' + answer_count + '][content]" type="text" class="form-control summernote" id="exampleInputName1" value="" placeholder=""></textarea>' +
                    '            <input name="answers[' + answer_count + '][comment]" type="text" class="form-control" id="exampleInputName1" value="" placeholder="اضافة تعليق للسؤال">' +

                    '        </div>' +
                    '    </div>' +
                    '</div>' +
                    '';
                $('.answers').append(answer);

                answer_count++;
                $('.summernote').summernote();

                // $("input[type=radio]").prop("checked", false);
                // $("input[type=radio]:first").prop("checked", true);

                $("input[type=radio]").click(function(event) {
                    $("input[type=radio]").prop("checked", false);
                    $(this).prop("checked", true);
                });
            });
            $('.row').on('click', '.delete_answer', function (e) {
                $(this).parent().parent().parent().parent().remove();
            });
        });
    </script>
@endsection
