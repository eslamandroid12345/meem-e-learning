@extends('dashboard.core.app')
@section('title', __('titles.About Us Content'))

@section('css_addons')
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
@endsection

@section('content')


    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.About Us')</h1>
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
                        <form action="{{route('about-us.store')}}" method="post" autocomplete="off" enctype="multipart/form-data">
                            <div class="card-header">
                                <h3 class="card-title">@lang('dashboard.Publish About Us Content')</h3>
                            </div>
                            <div class="card-body">
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputMainTitle2">@lang('dashboard.Title') @lang('dashboard.Section 1') @lang('dashboard.ar')</label>
                                            <input required name="ar[section1][title]" value="{{$content['ar']['section1']['title']}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputMainTitle1"> @lang('dashboard.Title') @lang('dashboard.Section 1') @lang('dashboard.en')</label>
                                            <input name="en[section1][title]" value="{{$content['en']['section1']['title']}}" type="text" class="form-control" id="exampleInputMainTitle1" placeholder="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputMainTitle2">@lang('dashboard.Description') @lang('dashboard.Section 1') @lang('dashboard.ar')</label>
                                            <textarea required name="ar[section1][description]" rows="3" class="form-control" id="exampleInputMainTitle2" placeholder="">{{$content['ar']['section1']['description']}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputMainTitle1"> @lang('dashboard.Description') @lang('dashboard.Section 1') @lang('dashboard.en')</label>
                                            <textarea name="en[section1][description]" rows="3" class="form-control" id="exampleInputMainTitle1" placeholder="">{{$content['en']['section1']['description']}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-10">
                                        <div class="form-group" style="width: 100%;">
                                            <label for="exampleInputFile">@lang('dashboard.Section 1 Image')</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input name="en[section1][image]" type="hidden" value="file_1">
                                                    <input name="ar[section1][image]" type="hidden" value="file_1">
                                                    <input name="file[1]" type="file" class="custom-file-input" id="exampleInputFile">
                                                    <input name="old_file[1]" type="hidden" value="{{ $content['en']['section1']['image'] }}">
                                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <img src="{{ $content['en']['section1']['image'] }}" style="width: 60%">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputMainTitle2">@lang('dashboard.Title') @lang('dashboard.Section 2') @lang('dashboard.ar')</label>
                                            <input required name="ar[section2][title]" value="{{$content['ar']['section2']['title']}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputMainTitle1"> @lang('dashboard.Title') @lang('dashboard.Section 2') @lang('dashboard.en')</label>
                                            <input name="en[section2][title]" value="{{$content['en']['section2']['title']}}" type="text" class="form-control" id="exampleInputMainTitle1" placeholder="">
                                        </div>
                                    </div>
                                </div>

                                <div class="row partners">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-11"></div>
                                            <div class="col-1">
                                                <div id="add_partner" style="cursor: pointer;"><i style="color: green" class="nav-icon fas fa-plus-circle"></i></div>
                                            </div>
                                        </div>
                                    </div>



{{--                                    @if($content->en->section2->partners !== null)--}}
{{--                                        @foreach($content->en->section2->partners as $i => $partner)--}}
{{--                                            <div class="col-2 partner">--}}
{{--                                                <div class="row">--}}
{{--                                                    <div class="col-11">--}}
{{--                                                        <div class="form-group" style="width: 100%;">--}}
{{--                                                            <label for="exampleInputFile">@lang('dashboard.Partner Image')</label>--}}
{{--                                                            <div class="input-group">--}}
{{--                                                                <div class="custom-file">--}}
{{--                                                                    <input name="en[section2][partners][{{$i}}][image]" type="hidden" value="file_2">--}}
{{--                                                                    <input name="ar[section2][partners][{{$i}}][image]" type="hidden" value="file_2">--}}
{{--                                                                    <input name="file[2]" type="file" class="custom-file-input" id="exampleInputFile">--}}
{{--                                                                    <input name="old_file[2]" type="hidden" value="{{ $content->en->section2->partners[0]->image }}">--}}
{{--                                                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="col-1">--}}
{{--                                                        <div class="delete_partner" style="cursor: pointer;"><i style="color:red" class="nav-icon fas fa-minus-circle"></i></div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        @endforeach--}}
{{--                                    @endif--}}






                                </div>
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
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script>
        $(function () {
            bsCustomFileInput.init();
        });
    </script>

    <script>
        $('.row').on('click', '.delete_partner', function (e) {
            $(this).parent().parent().parent().remove();
        });

        let index = 1;
        let file = 2;

        @if($content['en']['section2']['partners'] !== null)
            @foreach($content['en']['section2']['partners'] as $partner)
                $(function () {

                    const content = '' +
                        '<div class="col-3 partner">' +
                        '    <div class="row">' +
                        '        <div class="col-11">' +
                        '           <img src="{{$partner['image']}}" style="width: 30%;display: block;margin: auto;">' +
                        '        </div>' +
                        '        <div class="col-1">' +
                        '           <div class="delete_partner" style="cursor: pointer;"><i style="color:red" class="nav-icon fas fa-minus-circle"></i></div>' +
                        '        </div>' +
                        '    </div>' +
                        '    <div class="row">' +
                        '        <div class="col-12">' +
                        '            <div class="form-group" style="width: 100%;">' +
                        '                <label for="exampleInputFile">@lang("dashboard.Partner Image")</label>' +
                        '                <div class="input-group">' +
                        '                    <div class="custom-file">' +
                        '                        <input name="en[section2][partners][' + index + '][image]" type="hidden" value="file_' + file + '">' +
                        '                        <input name="ar[section2][partners][' + index + '][image]" type="hidden" value="file_' + file + '">' +
                        '                        <input name="file[' + file + ']" type="file" class="custom-file-input" id="exampleInputFile">' +
                        '                        <input name="old_file[' + file + ']" type="hidden" value="{{$partner['image']}}">' +
                        '                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>' +
                        '                    </div>' +
                        '                </div>' +
                        '            </div>' +
                        '        </div>' +
                        '        <div class="col-12">' +
                        '            <div class="form-group" style="width: 100%;">' +
                        '                <label for="exampleInputFile">@lang("dashboard.URL")</label>' +
                        '                <input required name="all[section2][partners][' + index + '][url]" value="{{$partner['url']}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">' +
                        '            </div>' +
                        '        </div>' +
                        '    </div>' +
                        '</div>' +
                        '';
                    $('.partners').append(content);
                    index++;
                    file++;
                });
            @endforeach
        @endif
        $('#add_partner').on('click' , function (){
            const content = '' +
                '<div class="col-3 partner">' +
                '    <div class="row">' +
                '        <div class="col-11">' +
                '        </div>' +
                '        <div class="col-1">' +
                '           <div class="delete_partner" style="cursor: pointer;"><i style="color:red" class="nav-icon fas fa-minus-circle"></i></div>' +
                '        </div>' +
                '    </div>' +
                '    <div class="row">' +
                '        <div class="col-12">' +
                '            <div class="form-group" style="width: 100%;">' +
                '                <label for="exampleInputFile">@lang("dashboard.Partner Image")</label>' +
                '                <div class="input-group">' +
                '                    <div class="custom-file">' +
                '                        <input name="en[section2][partners][' + index + '][image]" type="hidden" value="file_' + file + '">' +
                '                        <input name="ar[section2][partners][' + index + '][image]" type="hidden" value="file_' + file + '">' +
                '                        <input name="file[' + file + ']" type="file" class="custom-file-input" id="exampleInputFile">' +
                '                        <input name="old_file[' + file + ']" type="hidden" value="{{$partner['image']}}">' +
                '                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>' +
                '                    </div>' +
                '                </div>' +
                '            </div>' +
                '        </div>' +
                '        <div class="col-12">' +
                '            <div class="form-group" style="width: 100%;">' +
                '                <label for="exampleInputFile">@lang("dashboard.URL")</label>' +
                '                <input required name="all[section2][partners][' + index + '][url]" value="" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">' +
                '            </div>' +
                '        </div>' +
                '    </div>' +
                '</div>' +
                '';
            $('.partners').append(content);
            index++;
            file++;
        });

    </script>
@endsection
