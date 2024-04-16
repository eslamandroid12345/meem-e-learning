@extends('dashboard.core.app')
@section('title', __('titles.Contact Us Content'))

@section('css_addons')
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
@endsection

@section('content')


    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.Contact Us')</h1>
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
                        <form action="{{route('contact-us.store')}}" method="post" autocomplete="off" enctype="multipart/form-data">
                            <div class="card-header">
                                <h3 class="card-title">@lang('dashboard.Publish Contact Us Content')</h3>
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
                                            <input  name="en[title]" value="{{$content['en']['title']}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                        </div>
                                    </div>
                                </div>
                                <hr>
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
                                            <input  name="en[section1][title]" value="{{$content['en']['section1']['title']}}" type="text" class="form-control" id="exampleInputMainTitle1" placeholder="">
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
                                            <textarea  name="en[section1][description]" rows="3" class="form-control" id="exampleInputMainTitle1" placeholder="">{{$content['en']['section1']['description']}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-4 border-right border-left">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label> @lang('dashboard.Icon')</label>
                                                    <select class="form-control" name="all[section2][0][icon]">
                                                        <option @selected($content['en']['section2'][0]['icon'] == 'address') value="address">@lang('dashboard.Address')</option>
                                                        <option @selected($content['en']['section2'][0]['icon'] == 'email') value="email">@lang('dashboard.Email')</option>
                                                        <option @selected($content['en']['section2'][0]['icon'] == 'phone') value="phone">@lang('dashboard.Phone')</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="exampleInputMainTitle1"> @lang('dashboard.Name') @lang('dashboard.ar')</label>
                                                    <input required name="ar[section2][0][title]" value="{{$content['ar']['section2'][0]['title']}}" type="text" class="form-control" id="exampleInputMainTitle1" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="exampleInputMainTitle1"> @lang('dashboard.Name') @lang('dashboard.en')</label>
                                                    <input  name="en[section2][0][title]" value="{{$content['en']['section2'][0]['title']}}" type="text" class="form-control" id="exampleInputMainTitle1" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="exampleInputMainTitle1"> @lang('dashboard.Description') @lang('dashboard.ar')</label>
                                                    <input required name="ar[section2][0][description]" value="{{$content['ar']['section2'][0]['description']}}" type="text" class="form-control" id="exampleInputMainTitle1" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="exampleInputMainTitle1"> @lang('dashboard.Description') @lang('dashboard.en')</label>
                                                    <input  name="en[section2][0][description]" value="{{$content['en']['section2'][0]['description']}}" type="text" class="form-control" id="exampleInputMainTitle1" placeholder="">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-4 border-right border-left">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label> @lang('dashboard.Icon')</label>
                                                    <select class="form-control" name="all[section2][1][icon]">
                                                        <option @selected($content['en']['section2'][1]['icon'] == 'address') value="address">@lang('dashboard.Address')</option>
                                                        <option @selected($content['en']['section2'][1]['icon'] == 'email') value="email">@lang('dashboard.Email')</option>
                                                        <option @selected($content['en']['section2'][1]['icon'] == 'phone') value="phone">@lang('dashboard.Phone')</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="exampleInputMainTitle1"> @lang('dashboard.Name') @lang('dashboard.ar')</label>
                                                    <input required name="ar[section2][1][title]" value="{{$content['ar']['section2'][1]['title']}}" type="text" class="form-control" id="exampleInputMainTitle1" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="exampleInputMainTitle1"> @lang('dashboard.Name') @lang('dashboard.en')</label>
                                                    <input  name="en[section2][1][title]" value="{{$content['en']['section2'][1]['title']}}" type="text" class="form-control" id="exampleInputMainTitle1" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="exampleInputMainTitle1"> @lang('dashboard.Description') @lang('dashboard.ar')</label>
                                                    <input required name="ar[section2][1][description]" value="{{$content['ar']['section2'][1]['description']}}" type="text" class="form-control" id="exampleInputMainTitle1" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="exampleInputMainTitle1"> @lang('dashboard.Description') @lang('dashboard.en')</label>
                                                    <input  name="en[section2][1][description]" value="{{$content['en']['section2'][1]['description']}}" type="text" class="form-control" id="exampleInputMainTitle1" placeholder="">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-4 border-right border-left">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label> @lang('dashboard.Icon')</label>
                                                    <select class="form-control" name="all[section2][2][icon]">
                                                        <option @selected($content['en']['section2'][2]['icon'] == 'address') value="address">@lang('dashboard.Address')</option>
                                                        <option @selected($content['en']['section2'][2]['icon'] == 'email') value="email">@lang('dashboard.Email')</option>
                                                        <option @selected($content['en']['section2'][2]['icon'] == 'phone') value="phone">@lang('dashboard.Phone')</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="exampleInputMainTitle1"> @lang('dashboard.Name') @lang('dashboard.ar')</label>
                                                    <input required name="ar[section2][2][title]" value="{{$content['ar']['section2'][2]['title']}}" type="text" class="form-control" id="exampleInputMainTitle1" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="exampleInputMainTitle1"> @lang('dashboard.Name') @lang('dashboard.en')</label>
                                                    <input  name="en[section2][2][title]" value="{{$content['en']['section2'][2]['title']}}" type="text" class="form-control" id="exampleInputMainTitle1" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="exampleInputMainTitle1"> @lang('dashboard.Description') @lang('dashboard.ar')</label>
                                                    <input required name="ar[section2][2][description]" value="{{$content['ar']['section2'][2]['description']}}" type="text" class="form-control" id="exampleInputMainTitle1" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="exampleInputMainTitle1"> @lang('dashboard.Description') @lang('dashboard.en')</label>
                                                    <input  name="en[section2][2][description]" value="{{$content['en']['section2'][2]['description']}}" type="text" class="form-control" id="exampleInputMainTitle1" placeholder="">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
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
@endsection
