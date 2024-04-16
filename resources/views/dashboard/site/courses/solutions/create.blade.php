@extends('dashboard.core.app')
@section('title', __('titles.Create') . " " . __('titles.books_solutions'))

@section('css_addons')
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
    <style>
        .optional{
            opacity: .5;
            font-size: 13px;
        }
        .hide{
            display: none;
        }
    </style>
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.book_solutions')</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card p-1">
                        <form action="{{route('solutions.store' , $course_id)}}" method="post" autocomplete="off" enctype="multipart/form-data">
                            <div class="card-header">
                                <h3 class="card-title">{{__('titles.Create') . " " . __('dashboard.book_solutions')}}</h3>
                            </div>
                            <div class="card-body">
                                @csrf
                                <div class="row" id="content">
                                    <div class="form-group col-6">
                                        <label class="ml-3 mr-3" for="exampleInputName1">@lang('dashboard.Name') @lang('dashboard.ar')</label>
                                        <input value="{{old('name_ar')}}"  name="name_ar" type="text" class="form-control" id="exampleInputName1" placeholder="">
                                    </div>

                                    <div class="form-group col-6">
                                        <label class="ml-3 mr-3" for="exampleInputName1">@lang('dashboard.Name') @lang('dashboard.en')</label>
                                        <input value="{{old('name_en')}}"  name="name_en" type="text" class="form-control" id="exampleInputName1" placeholder="">
                                    </div>

                                    <div class="form-group col-6">
                                        <label class="ml-3 mr-3" for="exampleInputName1">@lang('dashboard.solution_video_platform')</label>
                                        <select id="platform_type" class="form-control" name="solution_video_platform">
                                            <option @if(old('solution_video_platform' == "YOUTUBE")) selected @endif value="YOUTUBE">@lang('dashboard.youtube')</option>
                                            <option @if(old('solution_video_platform' == "VIMEO")) selected @endif value="VIMEO">@lang('dashboard.vimeo')</option>
                                            <option @if(old('solution_video_platform' == "SWARMIFY")) selected @endif value="SWARMIFY">@lang('dashboard.swarmify')</option>
                                        </select>
{{--                                        <input value="{{old('solution_video_platform')}}"  name="solution_video_platform" type="text" class="form-control" id="exampleInputName1" placeholder="">--}}
                                    </div>

                                    <div class="form-group col-6">
                                        <label class="ml-3 mr-3" for="exampleInputName1">@lang('dashboard.solution_video_link')</label>
                                        <input value="{{old('solution_video_link')}}" name="solution_video_link" type="text" class="form-control" id="exampleInputName1" placeholder="">
                                    </div>
                                    <input type="hidden" name="course_id" value="{{$course_id}}">

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
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function () {
            $('#summernote').summernote();
            $('#summernote1').summernote();

            bsCustomFileInput.init();
            $('.select2').select2({
                language: {
                    searching: function() {}
                },
            });
        });
    </script>


@endsection
