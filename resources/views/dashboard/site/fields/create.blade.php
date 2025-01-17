@extends('dashboard.core.app')
@section('title', __('titles.Create') . " " . __('titles.Fields'))

@section('css_addons')
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.fields')</h1>
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
                        <form action="{{ route('fields.store') }}" method="post" autocomplete="off" enctype="multipart/form-data">
                            <div class="card-header">
                                <h3 class="card-title">{{__('titles.Create') . " " . __('titles.Field')}}</h3>
                            </div>
                            <div class="card-body">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="exampleInputName1">@lang('dashboard.Name') @lang('dashboard.ar')</label>
                                        <input name="name_ar" type="text" class="form-control" id="exampleInputName1" value="{{ old('name_ar') }}" placeholder="">
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="exampleInputName1">@lang('dashboard.Name') @lang('dashboard.en')</label>
                                        <input name="name_en" type="text" class="form-control" id="exampleInputName1" value="{{ old('name_en') }}" placeholder="">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-4">
                                        <label for="exampleInputName1">@lang('dashboard.Image')</label>
                                        <input name="image" type="file" class="form-control" id="exampleInputName1" placeholder="">
                                    </div>
                                    <div class="form-group col-4">
                                        <label for="exampleInputName1">@lang('dashboard.color_code')</label>
                                        <input name="color_code" type="color" class="form-control" id="exampleInputName1" value="#2062B3">
                                    </div>
                                    <div class="form-group col-4">
                                        <label for="exampleInputName1">@lang('dashboard.sort')</label>
                                        <input name="sort" type="number" min="1" step="1" class="form-control" id="exampleInputName1">
                                    </div>
                                </div>

                                <div class="form-group clearfix col-6">
                                    <div class="icheck-wetasphalt d-inline">
                                        <input name="is_active" type="checkbox" id="checkboxPrimary3" checked="">
                                        <label for="checkboxPrimary3">@lang('dashboard.Activate')</label>
                                    </div>
                                </div>
                                <div class="form-group clearfix col-6">
                                    <div class="icheck-wetasphalt d-inline">
                                        <input name="show_in_navbar" type="checkbox" id="checkboxPrimary55">
                                        <label for="checkboxPrimary55">@lang('dashboard.Show in navbar')</label>
                                    </div>
                                </div>
                                <div class="form-group clearfix col-6">
                                    <div class="icheck-wetasphalt d-inline">
                                        <input name="show_department" type="checkbox" id="checkboxPrimary4" checked="">
                                        <label for="checkboxPrimary4">@lang('dashboard.show_department')</label>
                                    </div>
                                </div>
                                <hr>
                                <div id="common_questions">
                                    <div class="row" style="height: 50px">
                                        <div class="col-5">
                                            <label for="exampleInputName1">@lang('dashboard.Common Questions')</label>
                                        </div>
                                        <div class="col-1">
                                            <div id="add_content" style="cursor: pointer;"><i style="color: green" class="nav-icon fas fa-plus-circle"></i></div>
                                        </div>
                                    </div>
                                    @if(old('common_questions') !== null)
                                        @foreach(old('common_questions') as $key => $commonQuestion)
                                            <div class="row">
                                                <div class="col-5 common_question">
                                                    <div class="row">
                                                        <div class="col-11 row">
                                                            <div class="form-group col-6">
                                                                <label for="commonQuestion{{$key}}Title">@lang('dashboard.Question') @lang("dashboard.ar")</label>
                                                                <input name="common_questions[{{$key}}][title_ar]" type="text" class="form-control" id="commonQuestion{{$key}}Title" value="{{ $commonQuestion['title_ar'] }}" placeholder="">
                                                            </div>
                                                            <div class="form-group col-6">
                                                                <label for="commonQuestion{{$key}}Title">@lang('dashboard.Question') @lang("dashboard.en")</label>
                                                                <input name="common_questions[{{$key}}][title_en]" type="text" class="form-control" id="commonQuestion{{$key}}Title" value="{{ $commonQuestion['title_en'] }}" placeholder="">
                                                            </div>
                                                            <div class="form-group col-6">
                                                                <label for="commonQuestion{{$key}}Content">@lang('dashboard.Answer') @lang("dashboard.ar")</label>
                                                                <textarea name="common_questions[{{$key}}][content_ar]" class="form-control" id="commonQuestion{{$key}}Content" rows="3">{{ $commonQuestion['content_ar'] }}</textarea>
                                                            </div>
                                                            <div class="form-group col-6">
                                                                <label for="commonQuestion{{$key}}Content">@lang('dashboard.Answer') @lang("dashboard.en")</label>
                                                                <textarea name="common_questions[{{$key}}][content_en]" class="form-control" id="commonQuestion{{$key}}Content" rows="3">{{ $commonQuestion['content_en'] }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-1">
                                                            <div class="delete_question" style="cursor: pointer;">
                                                                <i style="color:red" class="nav-icon fas fa-minus-circle"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
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
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function () {
            bsCustomFileInput.init();
            $('.select2').select2({
                language: {
                    searching: function() {}
                },
            });
        });
    </script>
    <script>
        $(function () {
            let index = {{old('common_questions') !== null ? count(old('common_questions')) : 0 }}
            $('#add_content').on('click', function (e) {
                const content = '' +
                    '<div class="row">' +
                    '    <div class="col-12 common_question">' +
                    '        <div class="row">' +
                    '            <div class="col-11 row">' +
                    '                <div class="form-group col-6">' +
                    '                    <label for="commonQuestion'+index+'Title">@lang("dashboard.Question") @lang("dashboard.ar")</label>' +
                    '                    <input name="common_questions['+index+'][title_ar]" type="text" class="form-control" id="commonQuestion'+index+'Title" placeholder="">' +
                    '                </div>' +
                    '                <div class="form-group col-6">' +
                    '                    <label for="commonQuestion'+index+'Title">@lang("dashboard.Question") @lang("dashboard.en")</label>' +
                    '                    <input name="common_questions['+index+'][title_en]" type="text" class="form-control" id="commonQuestion'+index+'Title" placeholder="">' +
                    '                </div>' +
                    '                <div class="form-group col-6">' +
                    '                    <label for="commonQuestion'+index+'Content">@lang("dashboard.Answer") @lang("dashboard.ar")</label>' +
                    '                    <textarea name="common_questions['+index+'][content_ar]" class="form-control" id="commonQuestion'+index+'Content" rows="3"></textarea>' +
                    '                </div>' +
                    '                <div class="form-group col-6">' +
                    '                    <label for="commonQuestion'+index+'Content">@lang("dashboard.Answer") @lang("dashboard.en")</label>' +
                    '                    <textarea name="common_questions['+index+'][content_en]" class="form-control" id="commonQuestion'+index+'Content" rows="3"></textarea>' +
                    '                </div>' +
                    '            </div>' +
                    '            <div class="col-1">' +
                    '                <div class="delete_question" style="cursor: pointer;">' +
                    '                    <i style="color:red" class="nav-icon fas fa-minus-circle"></i>' +
                    '                </div>' +
                    '            </div>' +
                    '        </div>' +
                    '        <hr>' +
                    '    </div>' +
                    '</div>' +
                    '';
                index++;
                $('#common_questions').append(content);
            });
            $('.row').on('click', '.delete_question', function (e) {
                $(this).parent().parent().parent().remove();
            });
        });
    </script>
@endsection
