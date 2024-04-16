@extends('dashboard.core.app')
@section('title', __('titles.Home Content'))

@section('css_addons')
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
@endsection

@section('content')


    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.Home')</h1>
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
                        <form action="{{route('home.store')}}" method="post" autocomplete="off" enctype="multipart/form-data">
                            <div class="card-header">
                                <h3 class="card-title">@lang('dashboard.Publish Home Content')</h3>
                            </div>
                            <div class="card-body">
                                @csrf

                                <!-- Section 1 -->
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
                                            <label for="exampleInputContent2">@lang('dashboard.Description') @lang('dashboard.Section 1') @lang('dashboard.ar')</label>
                                            <input required name=ar[section1][description]" value="{{$content['ar']['section1']['description']}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputContent1">@lang('dashboard.Description') @lang('dashboard.Section 1') @lang('dashboard.en')</label>
                                            <input name=en[section1][description]" value="{{$content['en']['section1']['description']}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputContent2">@lang('dashboard.Button Text') @lang('dashboard.Section 1') @lang('dashboard.ar')</label>
                                            <input required name="ar[section1][button]" value="{{$content['ar']['section1']['button']}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputContent1">@lang('dashboard.Button Text') @lang('dashboard.Section 1') @lang('dashboard.en')</label>
                                            <input name="en[section1][button]" value="{{$content['en']['section1']['button']}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-10" style="align-content: center;display: grid;">
                                        <div class="form-group" style="width: 100%;">
                                            <label for="exampleInputFile">@lang('dashboard.Section 1 Image')</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input name="en[section1][image]" type="hidden" value="file_100">
                                                    <input name="ar[section1][image]" type="hidden" value="file_100">
                                                    <input name="file[100]" type="file" class="custom-file-input" id="exampleInputFile">
                                                    <input name="old_file[100]" type="hidden" value="{{ $content['en']['section1']['image'] }}">
                                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <img src="{{ $content['en']['section1']['image'] }}" style="width: 60%">
                                    </div>
                                </div>

                                <!-- Section 1 -->

                                <hr>

                                <!-- Section 2 -->
                                <div class="row">

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputMainTitle2">@lang('dashboard.Title') @lang('dashboard.Section 2') @lang('dashboard.ar')</label>
                                            <input name="ar[section2][title]" value="{{$content['ar']['section2']['title']}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputMainTitle1">@lang('dashboard.Title') @lang('dashboard.Section 2') @lang('dashboard.en')</label>
                                            <input name="en[section2][title]" value="{{$content['en']['section2']['title']}}" type="text" class="form-control" id="exampleInputMainTitle1" placeholder="">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputMainTitle2">@lang('dashboard.More') @lang('dashboard.Section 2') @lang('dashboard.ar')</label>
                                            <input required name="ar[section2][more]" value="{{$content['ar']['section2']['more']}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputMainTitle1">@lang('dashboard.More') @lang('dashboard.Section 2') @lang('dashboard.en')</label>
                                            <input  name="en[section2][more]" value="{{$content['en']['section2']['more']}}" type="text" class="form-control" id="exampleInputMainTitle1" placeholder="">
                                        </div>
                                    </div>
                                </div>

                                <!-- Section 2 -->
                                    <hr>

                                <!-- Section 3 -->
                                <div class="row">

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputMainTitle2">@lang('dashboard.Title') @lang('dashboard.Section 3') @lang('dashboard.ar') </label>
                                            <input required name="ar[section3][title]" value="{{$content['ar']['section3']['title']}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputMainTitle1">@lang('dashboard.Title') @lang('dashboard.Section 3') @lang('dashboard.en')</label>
                                            <input  name="en[section3][title]" value="{{$content['en']['section3']['title']}}" type="text" class="form-control" id="exampleInputMainTitle1" placeholder="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputContent2">@lang('dashboard.description') @lang('dashboard.Section 3') @lang('dashboard.ar')</label>
                                            <input required name="ar[section3][description]" value="{{$content['ar']['section3']['description']}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputContent1">@lang('dashboard.description') @lang('dashboard.Section 3') @lang('dashboard.en')</label>
                                            <input name="en[section3][description]" value="{{$content['en']['section3']['description']}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                        </div>
                                    </div>
                                </div>

                                        <!-- Features -->

                                        <div class="feature">
                                            <div class="row">
                                                <div class="col-10" style="align-content: center;display: grid;">
                                                    <div class="form-group" style="width: 100%;">
                                                        <label for="exampleInputFile">@lang('dashboard.Feature 1 Image')</label>
                                                        <div class="input-group">
                                                            <div class="custom-file">
                                                                <input name="en[section3][features][0][image]" type="hidden" value="file_201">
                                                                <input name="ar[section3][features][0][image]" type="hidden" value="file_201">
                                                                <input name="file[201]" type="file" class="custom-file-input" id="exampleInputFile">
                                                                <input name="old_file[201]" type="hidden" value="{{$content['en']['section3']['features'][0]['image']}}">
                                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <img src="{{$content['en']['section3']['features'][0]['image']}}" style="width: 60%">
                                                </div>
                                            </div>
                                            <div class="row">


                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputContent2">@lang('dashboard.Title') @lang('dashboard.Feature 1') @lang('dashboard.ar')</label>
                                                        <input required name="ar[section3][features][0][title]" value="{{$content['ar']['section3']['features'][0]['title']}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputContent1">@lang('dashboard.Title') @lang('dashboard.Feature 1') @lang('dashboard.en')</label>
                                                        <input name="en[section3][features][0][title]" value="{{$content['en']['section3']['features'][0]['title']}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">


                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputContent2">@lang('dashboard.description') @lang('dashboard.Feature 1') @lang('dashboard.ar')</label>
                                                        <input required name="ar[section3][features][0][description]" value="{{$content['ar']['section3']['features'][0]['description']}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputContent1">@lang('dashboard.description') @lang('dashboard.Feature 1') @lang('dashboard.en')</label>
                                                        <input  name="en[section3][features][0][description]" value="{{$content['en']['section3']['features'][0]['description']}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="feature" >
                                            <div class="row">
                                                <div class="col-10" style="align-content: center;display: grid;">
                                                    <div class="form-group" style="width: 100%;">
                                                        <label for="exampleInputFile">@lang('dashboard.Feature 2 Image')</label>
                                                        <div class="input-group">
                                                            <div class="custom-file">
                                                                <input name="en[section3][features][1][image]" type="hidden" value="file_202">
                                                                <input name="ar[section3][features][1][image]" type="hidden" value="file_202">
                                                                <input name="file[202]" type="file" class="custom-file-input" id="exampleInputFile">
                                                                <input name="old_file[202]" type="hidden" value="{{$content['en']['section3']['features'][1]['image']}}">
                                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <img src="{{$content['en']['section3']['features'][1]['image']}}" style="width: 60%">
                                                </div>
                                            </div>
                                            <div class="row">


                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputContent2">@lang('dashboard.Title') @lang('dashboard.Feature 2') @lang('dashboard.ar')</label>
                                                        <input required name="ar[section3][features][1][title]" value="{{$content['ar']['section3']['features'][1]['title']}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputContent1">@lang('dashboard.Title') @lang('dashboard.Feature 2') @lang('dashboard.en')</label>
                                                        <input name="en[section3][features][1][title]" value="{{$content['en']['section3']['features'][1]['title']}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">


                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputContent2">@lang('dashboard.description') @lang('dashboard.Feature 2') @lang('dashboard.ar')</label>
                                                        <input required name="ar[section3][features][1][description]" value="{{$content['ar']['section3']['features'][1]['description']}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputContent1">@lang('dashboard.description') @lang('dashboard.Feature 2') @lang('dashboard.en')</label>
                                                        <input name="en[section3][features][1][description]" value="{{$content['en']['section3']['features'][1]['description']}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="feature">
                                            <div class="row">
                                                <div class="col-10" style="align-content: center;display: grid;">
                                                    <div class="form-group" style="width: 100%;">
                                                        <label for="exampleInputFile">@lang('dashboard.Feature 3 Image')</label>
                                                        <div class="input-group">
                                                            <div class="custom-file">
                                                                <input name="en[section3][features][2][image]" type="hidden" value="file_203">
                                                                <input name="ar[section3][features][2][image]" type="hidden" value="file_203">
                                                                <input name="file[203]" type="file" class="custom-file-input" id="exampleInputFile">
                                                                <input name="old_file[203]" type="hidden" value="{{$content['en']['section3']['features'][2]['image']}}">
                                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <img src="{{$content['en']['section3']['features'][2]['image']}}" style="width: 60%">
                                                </div>
                                            </div>
                                            <div class="row">


                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputContent2">@lang('dashboard.Title') @lang('dashboard.Feature 3') @lang('dashboard.ar')</label>
                                                        <input required name="ar[section3][features][2][title]" value="{{$content['ar']['section3']['features'][2]['title']}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputContent1">@lang('dashboard.Title') @lang('dashboard.Feature 3') @lang('dashboard.en')</label>
                                                        <input name="en[section3][features][2][title]" value="{{$content['en']['section3']['features'][2]['title']}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">


                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputContent2">@lang('dashboard.description') @lang('dashboard.Feature 3') @lang('dashboard.ar')</label>
                                                        <input required name="ar[section3][features][2][description]" value="{{$content['ar']['section3']['features'][2]['description']}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputContent1">@lang('dashboard.description') @lang('dashboard.Feature 3') @lang('dashboard.en')</label>
                                                        <input  name="en[section3][features][2][description]" value="{{$content['en']['section3']['features'][2]['description']}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="feature">
                                            <div class="row">
                                                <div class="col-10" style="align-content: center;display: grid;">
                                                    <div class="form-group" style="width: 100%;">
                                                        <label for="exampleInputFile">@lang('dashboard.Feature 4 Image')</label>
                                                        <div class="input-group">
                                                            <div class="custom-file">
                                                                <input name="en[section3][features][3][image]" type="hidden" value="file_204">
                                                                <input name="ar[section3][features][3][image]" type="hidden" value="file_204">
                                                                <input name="file[204]" type="file" class="custom-file-input" id="exampleInputFile">
                                                                <input name="old_file[204]" type="hidden" value="{{$content['en']['section3']['features'][3]['image']}}">
                                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <img src="{{$content['en']['section3']['features'][3]['image']}}" style="width: 60%">
                                                </div>
                                            </div>
                                            <div class="row">


                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputContent2">@lang('dashboard.Title') @lang('dashboard.Feature 4') @lang('dashboard.ar')</label>
                                                        <input required name="ar[section3][features][3][title]" value="{{$content['ar']['section3']['features'][3]['title']}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputContent1">@lang('dashboard.Title') @lang('dashboard.Feature 4') @lang('dashboard.en')</label>
                                                        <input name="en[section3][features][3][title]" value="{{$content['en']['section3']['features'][3]['title']}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">


                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputContent2">@lang('dashboard.description') @lang('dashboard.Feature 4') @lang('dashboard.ar')</label>
                                                        <input required name="ar[section3][features][3][description]" value="{{$content['ar']['section3']['features'][3]['description']}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputContent1">@lang('dashboard.description') @lang('dashboard.Feature 4') @lang('dashboard.en')</label>
                                                        <input name="en[section3][features][3][description]" value="{{$content['en']['section3']['features'][3]['description']}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <!-- Features -->


                                    <!-- Section 3 -->

                                    <hr>

                                <!-- Section 4 -->

                                    <div class="row">


                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="exampleInputContent1">@lang('dashboard.Title') @lang('dashboard.Section 4') @lang('dashboard.ar')</label>
                                                <input required name="ar[section4][title]" value="{{$content['ar']['section4']['title']}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="exampleInputContent1">@lang('dashboard.Title') @lang('dashboard.Section 4') @lang('dashboard.en')</label>
                                                <input name="en[section4][title]" value="{{$content['en']['section4']['title']}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                            </div>
                                        </div>
                                    </div>

                                <!-- Section 4 -->

                                <hr>

                                <!-- Section 5 -->

                                    <div class="row">


                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="exampleInputContent1">@lang('dashboard.Title') @lang('dashboard.Section 5') @lang('dashboard.ar')</label>
                                                <input required name="ar[section5][title]" value="{{$content['ar']['section5']['title']}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="exampleInputContent1">@lang('dashboard.Title') @lang('dashboard.Section 5') @lang('dashboard.en')</label>
                                                <input name="en[section5][title]" value="{{$content['en']['section5']['title']}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                <div id="section5_images">

                                @foreach($content['en']['section5']['images'] as $i => $image)
                                    <div class="row">
                                        <div class="col-8" style="align-content: center;display: grid;">
                                            <div class="form-group" style="width: 100%;">
                                                <label for="exampleInputFile">@lang('dashboard.Section 5 Image')</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input name="en[section5][images][{{$i}}][id]" type="hidden" value="{{$image['id']}}">
                                                        <input name="en[section5][images][{{$i}}][image]" type="hidden" value="file_{{$image['id']}}">
                                                        <input name="ar[section5][images][{{$i}}][image]" type="hidden" value="file_{{$image['id']}}">
                                                        <input name="file[{{$image['id']}}]" type="file" class="custom-file-input" id="exampleInputFile">
                                                        <input name="old_file[{{$image['id']}}]" type="hidden" value="{{$image['image']}}">
                                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <img src="{{$image['image']}}" style="width: 60%">
                                        </div>
                                        <div class="col-1">
                                            <div class="delete_content" style="cursor: pointer;"><i style="color:red" class="nav-icon fas fa-minus-circle"></i></div>
                                        </div>
                                    </div>
                                @endforeach
                                    </div>

                                    <div class="col-1">
                                        <div id="add_image" style="cursor: pointer;"><i style="color: green" class="nav-icon fas fa-plus-circle"></i></div>
                                    </div>
                                <!-- Section 5 -->

                                    <hr>
                                <!-- Section 6 -->

                                <div class="row">


                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputContent1">@lang('dashboard.Title') @lang('dashboard.Section 6') @lang('dashboard.ar')</label>
                                            <input required name="ar[section6][title]" value="{{$content['ar']['section6']['title']}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputContent1">@lang('dashboard.Title') @lang('dashboard.Section 6') @lang('dashboard.en')</label>
                                            <input name="en[section6][title]" value="{{$content['en']['section6']['title']}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                        </div>
                                    </div>
                                </div>

                                <div id="social_accounts">
                                    @foreach($content['en']['section6']['accounts'] as $key => $account)
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <input name="en[section6][accounts][{{$key}}][icon]" type="hidden" value="file_{{ 500 + $key }}">
                                                    <input name="ar[section6][accounts][{{$key}}][icon]" type="hidden" value="file_{{ 500 + $key }}">
                                                    <input name="file[{{ 500 + $key }}]" type="file" class="custom-file-input" id="exampleInputFile">
                                                    <input name="old_file[{{ 500 + $key }}]" type="hidden" value="{{$account['icon'] ?? ''}}">
                                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                    {{--                                                        <select class="form-control" name="all[section6][accounts][{{$key}}][platform]">--}}
                                                    {{--                                                            <option value="FACEBOOK" @selected($account['platform'] == "FACEBOOK")>Facebook</option>--}}
                                                    {{--                                                            <option value="TWITTER" @selected($account['platform'] == "TWITTER")>Twitter</option>--}}
                                                    {{--                                                            <option value="TIKTOK" @selected($account['platform'] == "TIKTOK")>Tiktok</option>--}}
                                                    {{--                                                            <option value="INSTAGRAM" @selected($account['platform'] == "INSTAGRAM")>Instagram</option>--}}
                                                    {{--                                                            <option value="SNAPCHAT" @selected($account['platform'] == "SNAPCHAT")>Snapchat</option>--}}
                                                    {{--                                                            <option value="GMAIL" @selected($account['platform'] == "GMAIL")>Gmail</option>--}}
                                                    {{--                                                            <option value="LINKEDIN" @selected($account['platform'] == "LINKEDIN")>Linkedin</option>--}}
                                                    {{--                                                        </select>--}}
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <input required name="all[section6][accounts][{{$key}}][account]" value="{{$account['account']}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                            </div>
                                            <div class="col-1">
                                                <img src="{{$account['icon'] ?? ''}}" style="width: 60%">
                                            </div>
                                            <div class="col-1">
                                                <div class="delete_content" style="cursor: pointer;"><i style="color:red" class="nav-icon fas fa-minus-circle"></i></div>
                                            </div>
                                        </div>

                                    @endforeach

                                </div>
                                <div class="col-1">
                                    <div id="add_account" style="cursor: pointer;"><i style="color: green" class="nav-icon fas fa-plus-circle"></i></div>
                                </div>

                                <!-- Section 6 -->


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

//        $('.delete_content').on('click' , function (){
//          $(this).parent().parent().remove();
//        });

        $('.row').on('click', '.delete_content', function (e) {
            $(this).parent().parent().remove();
        });

        let index = {{ max(array_keys($content['en']['section5']['images'])) ?? 0 }};
        $('#add_image').on('click' , function (){
            index++;
            const content = '' +
                '<div class="row"> '  +
                    '<div class="col-8"> ' +
                        '<div class="form-group" style="width: 100%;">' +
                            '<label for="exampleInputFile">@lang('dashboard.Section 5 Image')</label>' +
                            '<div class="input-group">' +
                                '<div class="custom-file">' +
                                    '<input name="en[section5][images][' + index + '][id]" type="hidden" value="' + index + '">' +
                                    '<input name="en[section5][images][' + index + '][image]" type="hidden" value="file_' + index + '">' +
                                        '<input name="ar[section5][images][' + index + '][image]" type="hidden" value="file_' + index + '">' +
                                            '<input required name="file[' + index + ']" type="file" class="custom-file-input" id="exampleInputFile">' +
                                                '<input name="old_file[' + index + ']" type="hidden">' +
                                                    '<label class="custom-file-label" for="exampleInputFile">Choose file</label> ' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                    '</div>' +
                    '<div class="col-1"> ' +
                        '<div class="delete_content" style="cursor: pointer;"><i style="color:red" class="nav-icon fas fa-minus-circle"></i></div>' +
                    '</div>' +
                '</div>'
            $('#section5_images').append(content);
        });


        let key = {{ max(array_keys($content['en']['section6']['accounts'])) ?? 0 }} + 900;
        $('#add_account').on('click', function () {
            key++;
            const content = '' +
                '<div class="row">' +
                '<div class="col-4">' +
                '<div class="form-group">' +
                '<input name="en[section6][accounts][' + key + '][icon]" type="hidden" value="file_' + key + '">' +
                '<input name="ar[section6][accounts][{{$key}}][icon]" type="hidden" value="file_' + key + '">' +
                '<input name="file[' + key + ']" type="file" class="custom-file-input" id="exampleInputFile">' +
                '<input name="old_file[' + key + ']" type="hidden">' +
                '<label class="custom-file-label" for="exampleInputFile">Choose file</label>' +
                // '<select class="form-control" name="all[section6][accounts]['+ key +'][platform]">' +
                //     '<option value="FACEBOOK">Facebook</option>' +
                //     '<option value="TWITTER">Twitter</option>' +
                //     '<option value="TIKTOK">Tiktok</option>' +
                //     '<option value="INSTAGRAM">Instagram</option>' +
                //     '<option value="SNAPCHAT">Snapchat</option>' +
                //     '<option value="GMAIL">Gmail</option>' +
                //     '<option value="LINKEDIN">Linkedin</option>' +
                // '</select>' +
                '</div>' +
                '</div>' +
                '<div class="col-6">' +
                '<input required name="all[section6][accounts][' + key + '][account]"  type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">' +
                '</div>' +
                '<div class="col-1"></div>' +
                '<div class="col-1">' +
                '<div class="delete_content" style="cursor: pointer;"><i style="color:red" class="nav-icon fas fa-minus-circle"></i></div>' +
                '</div>' +
                '</div>';

            $('#social_accounts').append(content);

        });
    </script>
@endsection
