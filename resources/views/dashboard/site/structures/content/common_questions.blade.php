@extends('dashboard.core.app')
@section('title', __('titles.Common Questions Content Content'))

@section('css_addons')
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
@endsection

@section('content')


    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.common_questions')</h1>
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
                        <form action="{{route('common-questions.store')}}" method="post" autocomplete="off" enctype="multipart/form-data">
                            <div class="card-header">
                                <h3 class="card-title">@lang('dashboard.Publish Common Questions Content')</h3>
                            </div>
                            <div class="card-body">
                                @csrf

                                <div class="row">

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputMainTitle1">@lang('dashboard.main_page_title_ar')</label>
                                            <input required name="ar[title]" value="{{$content['ar']['title']}}" type="text" class="form-control" id="exampleInputMainTitle1" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputMainTitle2">@lang('dashboard.main_page_title_en')</label>
                                            <input name="en[title]" value="{{$content['en']['title']}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                        </div>
                                    </div>

                                </div>

                                <!-- Questions -->

                                <div id="questions">
                                    @foreach($content['en']['questions'] as $key => $question)
                                        <div class="question">
                                            <div class="row">

                                                <div class="col-5">
                                                    <div class="form-group">
                                                        <label for="exampleInputMainTitle2">@lang('dashboard.question_ar')</label>
                                                        <input required name="ar[questions][{{$key}}][question]" value="{{$content['ar']['questions'][$key]['question']}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="col-5">
                                                    <div class="form-group">
                                                        <label for="exampleInputMainTitle2">@lang('dashboard.question_en')</label>
                                                        <input name="en[questions][{{$key}}][question]" value="{{$question['question']}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                                    </div>
                                                </div>


                                                <div class="col-5">
                                                    <div class="form-group">
                                                        <label for="exampleInputMainTitle2">@lang('dashboard.answer_ar')</label>
                                                        <textarea required name="ar[questions][{{$key}}][answer]" class="form-control" id="exampleInputMainTitle2">{{$content['ar']['questions'][$key]['answer']}}</textarea>

                                                    </div>
                                                </div>
                                                <div class="col-5">
                                                    <div class="form-group">
                                                        <label for="exampleInputMainTitle2">@lang('dashboard.answer_en')</label>
                                                        <textarea name="en[questions][{{$key}}][answer]" class="form-control" id="exampleInputMainTitle2">{{$question['answer']}}</textarea>
                                                    </div>
                                                </div>

                                                <div class="col-1">
                                                    <div class="delete_content" style="cursor: pointer;"><i style="color:red" class="nav-icon fas fa-minus-circle"></i></div>
                                                </div>
                                            </div>


                                        </div>

                                    @endforeach

                                </div>

                                <div class="col-1">
                                    <div id="add_question" style="cursor: pointer;"><i style="color: green" class="nav-icon fas fa-plus-circle"></i></div>
                                </div>

                                <!-- Questions -->

                                <hr>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-dark">@lang('dashboard.Publish')</button>
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
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script>
        $(function () {
            $('#summernote').summernote();
            $('#summernote2').summernote();
            $('#summernote3').summernote();
            $('#summernote4').summernote();
            bsCustomFileInput.init();
        });
    </script>

    <script>
        $('.row').on('click', '.delete_content', function (e) {
            $(this).parent().parent().remove();
        });

        let index = {{ max(array_keys($content['en']['questions'])) ?? 0 }};
        $('#add_question').on('click' , function (){
            index++;
            const content = '' +
                '<div class="question">' +
                '<div class="row">' +
                '<div class="col-5">' +
                '<div class="form-group">' +
                '<label for="exampleInputMainTitle2">@lang('dashboard.question_ar')</label>' +
                '<input required name="ar[questions][' + index  + '][question]"  type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">' +
                '</div>' +
                '</div>' +
                '<div class="col-5">' +
                '<div class="form-group">' +
                '<label for="exampleInputMainTitle2">@lang('dashboard.question_en')</label>' +
                '<input  name="en[questions][' + index  + '][question]"  type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">' +
                '</div>' +
                '</div>' +
                '<div class="col-5">' +
                '<div class="form-group">' +
                '<label for="exampleInputMainTitle2">@lang('dashboard.answer_ar')</label>' +
                '<textarea required name="ar[questions][' + index  + '][answer]" class="form-control" id="exampleInputMainTitle2"></textarea>' +
                '</div>' +
                '</div>'+
                '<div class="col-5">' +
                '<div class="form-group">' +
                '<label for="exampleInputMainTitle2">@lang('dashboard.answer_en')</label>' +
                '<textarea  name="en[questions][' + index  + '][answer]" class="form-control" id="exampleInputMainTitle2"></textarea>' +
                '</div>' +
                '</div>' +
                '<div class="col-1">' +
                '<div class="delete_content" style="cursor: pointer;"><i style="color:red" class="nav-icon fas fa-minus-circle"></i></div>' +
                '</div>' +
                '</div>'+
                '</div>'
            $('#questions').append(content);
        });
    </script>


@endsection
