@extends('dashboard.core.app')
@section('title', __('titles.Privacy Policy Content Content'))

@section('css_addons')
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
@endsection

@section('content')


    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.privacy_and_policy')</h1>
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
                        <form action="{{route('privacy.store')}}" method="post" autocomplete="off" enctype="multipart/form-data">
                            <div class="card-header">
                                <h3 class="card-title">@lang('dashboard.Publish PrivacyPolicy Content')</h3>
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

                                <!-- Section 1 -->

                                <div class="row">

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputContent2">@lang('dashboard.Title') @lang('dashboard.Section 1') @lang('dashboard.ar')</label>
                                            <input required name="ar[section1][title]" value="{{$content['ar']['section1']['title']}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputContent1">@lang('dashboard.Title') @lang('dashboard.Section 1') @lang('dashboard.en')</label>
                                            <input name="en[section1][title]" value="{{$content['en']['section1']['title']}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                        </div>
                                    </div>



                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="summernote2">@lang('dashboard.description') @lang('dashboard.Section 1') @lang('dashboard.ar')</label>
                                            <textarea required name="ar[section1][description]" class="form-control" id="summernote2" placeholder="">
                                                {!! $content['ar']['section1']['description'] !!}
                                            </textarea>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="summernote">@lang('dashboard.description') @lang('dashboard.Section 1') @lang('dashboard.en')</label>
                                            <textarea name="en[section1][description]" class="form-control" id="summernote" placeholder="">
                                                {!! $content['en']['section1']['description'] !!}
                                            </textarea>
                                        </div>
                                    </div>

                                </div>
                                <!-- Section 1 -->

                                <hr>

                                <!-- Section 2 -->

                                <div class="row">

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputContent2">@lang('dashboard.Title') @lang('dashboard.Section 2') @lang('dashboard.ar')</label>
                                            <input required name="ar[section2][title]" value="{{$content['ar']['section2']['title']}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputContent1">@lang('dashboard.Title') @lang('dashboard.Section 2') @lang('dashboard.en')</label>
                                            <input name="en[section2][title]" value="{{$content['en']['section2']['title']}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                        </div>
                                    </div>


                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="summernote4">@lang('dashboard.description') @lang('dashboard.Section 2') @lang('dashboard.ar')</label>
                                            <textarea required name="ar[section2][description]" class="form-control" id="summernote4" placeholder="">
                                                {!! $content['ar']['section2']['description'] !!}
                                            </textarea>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="summernote3">@lang('dashboard.description') @lang('dashboard.Section 2') @lang('dashboard.en')</label>
                                            <textarea name="en[section2][description]" class="form-control" id="summernote3" placeholder="">
                                                {!! $content['en']['section2']['description'] !!}
                                            </textarea>
                                        </div>
                                    </div>


                                </div>
                                <!-- Section 2 -->


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


@endsection
