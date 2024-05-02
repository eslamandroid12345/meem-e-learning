@extends('dashboard.core.app')
@section('title', __('titles.Create') . " " . __('titles.Course'))

@section('css_addons')
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
    <style>
        .optional{
            opacity: .5;
            font-size: 13px;
        }
    </style>
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.courses')</h1>
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
                        <form  action="{{ route('courses.store') }}" method="post" autocomplete="off" enctype="multipart/form-data">
                            <div class="card-header">
                                <h3 class="card-title">@lang('titles.Create') @lang('titles.Course')</h3>
                            </div>
                            <div class="card-body">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="exampleInputName1">@lang('dashboard.Name') @lang('dashboard.ar')</label>
                                        <input required name="name_ar" type="text" class="form-control" id="exampleInputName1" value="{{ old('name_ar') }}" placeholder="">
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="exampleInputName1">@lang('dashboard.Name') @lang('dashboard.en')</label>
                                        <input  name="name_en" type="text" class="form-control" id="exampleInputName1" value="{{ old('name_en') }}" placeholder="">
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="summernote">@lang('dashboard.Description') @lang('dashboard.ar')</label>
                                        <textarea  name="description_ar" type="text" class="form-control" id="summernote">{{ old('description_ar') }}</textarea>
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="summernote2">@lang('dashboard.Description') @lang('dashboard.en')</label>
                                        <textarea  name="description_en" type="text" class="form-control" id="summernote2">{{ old('description_en') }}</textarea>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="form-group col-3">
                                        <label for="price">@lang('dashboard.price')</label>
                                        <input name="price" type="number" class="form-control" id="exampleInputName1" placeholder="" value="{{old('price')}}">
                                    </div>

                                    <div class="form-group col-3">
                                        <label for="price">@lang('dashboard.app_price')</label>
                                        <input name="app_price" type="number" class="form-control" id="exampleInputName1" placeholder="" value="{{old('app_price')}}">
                                    </div>


                                    <div class="form-group col-3">
                                        <label for="exampleInputName1">@lang('dashboard.Image')</label>
                                        <input name="image" type="file" class="form-control" id="exampleInputName1" placeholder="">
                                    </div>


                                    <div class="form-group col-3">
                                            <label
                                                for="platform_type">@lang('dashboard.explanation_video_platform')</label>
                                            <select id="platform_type" class="form-control" name="explanation_video_platform">
                                                <option @if(old('link_platform' == "YOUTUBE")) selected @endif value="YOUTUBE">@lang('dashboard.youtube')</option>
                                                <option @if(old('link_platform' == "VIMEO")) selected @endif value="VIMEO">@lang('dashboard.vimeo')</option>
                                                <option @if(old('link_platform' == "SWARMIFY")) selected @endif value="SWARMIFY">@lang('dashboard.swarmify')</option>
                                            </select>
                                    </div>

                                    <div class="form-group col-4">
                                        <label for="exampleInputName1">@lang('dashboard.explanation_video')</label>
                                        <input name="explanation_video" type="text" class="form-control" id="exampleInputName1" placeholder="" value="{{old('explanation_video')}}">
                                    </div>


                                    <div class="form-group col-4">
                                        <label for="exampleInputName1">@lang('dashboard.course_plan')</label>
                                        <input name="profile_file" type="file"  class="form-control" id="exampleInputName1" placeholder="">
                                    </div>
                                    <div class="form-group col-4">
                                        <label for="category">@lang('dashboard.category')</label>
                                        <select id="category" name="category_id"  class="form-control">
                                            @foreach($categories as $category)
                                                <option @selected(request('category_id') == $category['id']) value="{{$category['id']}}">{{$category->t('name')}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-4">
                                        <label for="exampleInputName1">@lang('dashboard.start_date')</label>
                                        <input required name="start_date" type="date" class="form-control" id="exampleInputName1" placeholder="" value="{{old('start_date')}}">
                                    </div>

                                    <div class="form-group col-4">
                                        <label for="exampleInputName1">@lang('dashboard.end_date') <span class="optional">@lang('dashboard.optional')</span></label>
                                        <input name="end_date" type="date" class="form-control" id="exampleInputName1" placeholder="" value="{{old('end_date')}}">
                                    </div>

                                    <div class="form-group col-4">
                                        <label for="exampleInputName1">@lang('dashboard.duration') <span class="optional">@lang('dashboard.optional')</span></label>
                                        <input name="duration" type="number" class="form-control" id="exampleInputName1" placeholder="" value="{{old('duration')}}">
                                    </div>

                                    <div class="form-group col-4">
                                        <label for="exampleInputName1">@lang('dashboard.whatsapp_link') <span class="optional">@lang('dashboard.optional')</span></label>
                                        <input name="whatsapp_link" type="text" class="form-control" id="exampleInputName1" placeholder="" value="{{old('whatsapp_link')}}">
                                    </div>

                                    <div class="form-group col-4">
                                        <label for="exampleInputName1">@lang('dashboard.telegram_link') <span class="optional">@lang('dashboard.optional')</span></label>
                                        <input name="telegram_link" type="text" class="form-control" id="exampleInputName1" placeholder="" value="{{old('telegram_link')}}">
                                    </div>

                                    <div class="form-group col-4">
                                        <label for="exampleInputName1">@lang('dashboard.telegram_channel_link') <span class="optional">@lang('dashboard.optional')</span></label>
                                        <input name="telegram_channel_link" type="text" class="form-control" id="exampleInputName1" placeholder="" value="{{old('telegram_channel_link')}}">
                                    </div>

                                    <div class="form-group col-4">
                                        <label for="select">@lang('dashboard.teachers')</label>
                                        <select id="select" name="teachers[]" class="select2 select2-hidden-accessible" multiple="" data-placeholder="Select a State" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                            @foreach($teachers as $teacher)
                                                <option @if( old('teachers') !== null && in_array($teacher['id'] , old('teachers'))) selected  @endif value="{{$teacher['id']}}" >{{$teacher['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-4">
                                        <label for="active">@lang('dashboard.show_teacher_names')</label>
                                        <select required id="active" name="show_teacher_names"  class="form-control">
                                            <option value="1" @selected(old('show_teacher_names' == true))>@lang('dashboard.show')</option>
                                            <option value="0" @selected(old('show_teacher_names' == false))>@lang('dashboard.hide')</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-4">
                                        <label for="select">@lang('dashboard.cooperators') <span class="optional">@lang('dashboard.optional')</span></label>
                                        <select id="select" name="teachers[]" class="select2 select2-hidden-accessible" multiple="" data-placeholder="Select a State" style="width: 100%;" data-select2-id="2" tabindex="-1" aria-hidden="true">
                                            @foreach($cooperators as $cooperator)
                                                <option @if( old('cooperators') !== null && in_array($cooperator['id'] , old('cooperators'))) selected  @endif value="{{$cooperator['id']}}" > {{$cooperator['name']}} ( {{$cooperator->roles[0]->t('display_name')}} )</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-4">

                                        <div class="icheck-wetasphalt d-inline">
                                            <input name="certificate_available" type="checkbox" id="check_certificate" checked="">
                                            <label for="check_certificate">@lang('dashboard.available?')</label>
                                        </div>

                                        <input name="request_certificate_available" type="hidden" value="off">
                                        <div class="icheck-wetasphalt d-inline">
                                            <input name="request_certificate_available" type="checkbox" id="request_certificate_available" checked="">
                                            <label for="request_certificate_available">@lang('dashboard.request_certificate_available')</label>
                                        </div>


                                        <label for="exampleInputName1">@lang('dashboard.certificate_price')</label>
                                        <input name="certificate_price" type="number" class="form-control" id="certificatePrice" placeholder="" value="{{old('certificate_price') ?? 0}}">

                                    </div>
                                    <div class="form-group col-4">
                                        <label for="exampleInputName1">@lang('dashboard.sort')</label>
                                        <input name="sort" type="number" min="1" step="1" class="form-control" id="exampleInputName1" placeholder="" value="{{old('sort')}}">
                                    </div>
                                    <div class="form-group col-4" id="special">
                                        <label for="exampleInputName1">@lang('dashboard.Not_Continue')</label>
                                        <input name="notcontinue" type="checkbox" class="form-control" id="exampleInputName1" >
                                    </div>
                                    <div class="form-group col-4" id="specialcommission">
                                        <label for="exampleInputName1">@lang('dashboard.dayNumbers')</label>
                                        <input name="dayNumbers" type="number" min="1" step="1" class="form-control" id="exampleInputName1" placeholder="" value="{{old('dayNumbers')}}">
                                    </div>
                                    <div class="form-group clearfix col-12">

                                    </div>


                                    <div class="form-group clearfix col-3">
                                        <div class="icheck-wetasphalt d-inline">
                                            <input name="is_active" type="checkbox" id="checkboxPrimary3" checked="">
                                            <label for="checkboxPrimary3">@lang('dashboard.Activate')</label>
                                        </div>
                                    </div>

                                    <div class="form-group clearfix col-3">
                                        <div class="icheck-wetasphalt d-inline">
                                            <input name="registration_status" type="checkbox" id="registration_status" checked="">
                                            <label for="registration_status">@lang('dashboard.open_registration')</label>
                                        </div>
                                    </div>

                                    <div class="form-group clearfix col-3">
                                        <div class="icheck-wetasphalt d-inline">
                                            <input name="is_ratable" type="checkbox" id="checkboxPrimary2" checked="">
                                            <label for="checkboxPrimary2">@lang('dashboard.is_ratable')</label>
                                        </div>
                                    </div>

                                    <div class="form-group clearfix col-3">
                                        <div class="icheck-wetasphalt d-inline">
                                            <input name="important_flag" type="checkbox" id="checkboxPrimary15" checked="">
                                            <label for="checkboxPrimary15">@lang('dashboard.important_flag')</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row col-12">
                                    <div id="content" class="form-group col-6">
                                        <div class="row col-12" style="height: 50px">
                                            <div class="col-5">
                                                <label for="exampleInputName1">@lang('dashboard.training_bags')</label>
                                            </div>
                                            <div class="col-1">
                                                <div id="add_content" style="cursor: pointer;"><i style="color: green" class="nav-icon fas fa-plus-circle"></i></div>
                                            </div>
                                        </div>
                                        <!-- Course Books Section -->
                                        @if(old('books') !== null)
                                            @foreach(old('books') as $key => $book)
                                                <div class="book-div row col-12">

                                                      <div class="form-group col-3">
                                                             <label for="exampleInputName1">@lang("dashboard.Name") @lang("dashboard.ar")</label>
                                                             <input required name="books[{{$key}}][name_ar]" type="text" class="form-control" id="exampleInputName1" placeholder=""  value="{{old('books')[$key]['name_ar']}}">
                                                           </div>
                                                      <div class="form-group col-3">
                                                             <label for="exampleInputName1">@lang("dashboard.Name") @lang("dashboard.en")</label>
                                                             <input name="books[{{$key}}][name_en]" type="text" class="form-control" id="exampleInputName1" placeholder=""  value="{{old('books')[$key]['name_en']}}">
                                                           </div>

                                                        <div class="form-group col-2">
                                                            <label for="exampleInputName1">@lang('dashboard.Image')</label>
                                                            <input  required name="books[{{$key}}][image]" type="file" class="form-control" id="exampleInputName1" placeholder="">
                                                        </div>

                                                          <div class="form-group col-3"> +
                                                              <label for="exampleInputName1">@lang("dashboard.price")</label>' +
                                                              <input name="books[{{$key}}][price]" type="text" class="form-control" id="exampleInputName1" placeholder="">' +
                                                          </div>

{{--                                                    <div class="form-group col-4">--}}
{{--                                                        <input name="books[{{$key}}][is_bw]" type="checkbox" class="form-check-input is_check" placeholder="" @if( isset($book['is_bw'])) checked @endif>--}}
{{--                                                        <label class=" mr-3 ml-3" for="exampleInputName1">@lang('dashboard.bw_price')</label>--}}
{{--                                                        <input @if( !isset($book['is_bw'])) disabled @endif required name="books[{{$key}}][bw_price]" type="number" class="form-control" id="exampleInputName1" placeholder="" value="{{old('books')[$key]['bw_price'] ?? 0}}">--}}
{{--                                                    </div>--}}

{{--                                                    <div class="form-group col-3">--}}
{{--                                                        <input  name="books[{{$key}}][is_coloured]" type="checkbox" class="form-check-input is_check" placeholder="" @if( isset($book['is_coloured'])) checked @endif>--}}
{{--                                                        <label class=" mr-3 ml-3" for="exampleInputName1">@lang('dashboard.coloured_price')</label>--}}
{{--                                                        <input @if( !isset($book['is_coloured'])) disabled @endif required name="books[{{$key}}][coloured_price]" type="number" class="form-control" id="exampleInputName1" placeholder="" value="{{old('books')[$key]['coloured_price'] ?? 0}}">--}}
{{--                                                    </div>--}}
                                                    <input name="books[{{$key}}][sent]" class="col-12" type="hidden" id="checkboxPrimary3" value="{{$key}}">
                                                    <div class="col-1">
                                                        <div class="delete_content" style="cursor: pointer;">
                                                            <i style="color:red" class="nav-icon fas fa-minus-circle"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-12"><hr></div>
                                                </div>

                                        @endforeach
                                    @endif

                                    <!-- Course Books Section -->





                                    </div>
                                    <div id="content_attachment" class="form-group col-6">
                                        <div class="row" style="height: 50px">
                                            <div class="col-5">
                                                <label for="exampleInputName1">@lang('dashboard.attachments') <span class="optional">@lang('dashboard.optional')</span> </label>
                                            </div>
                                            <div class="col-1">
                                                <div id="add_content_attachments" style="cursor: pointer;"><i style="color: green" class="nav-icon fas fa-plus-circle"></i></div>
                                            </div>
                                        </div>



                                        <!-- Course Attachments Section -->


                                        @if(old('attachments') !== null)
                                            @foreach(old('attachments') as $key => $attachment)
                                                <div class="book-div row">
                                                    <div class="form-group col-3">
                                                        <label for="exampleInputName1">@lang('dashboard.file')</label>
                                                        <input  required name="attachments[{{$key}}][file]" type="file" class="form-control" id="exampleInputName1" placeholder="">
                                                    </div>

                                                    <div class="form-group col-3">
                                                        <label class=" mr-3 ml-3" for="exampleInputName1">@lang('dashboard.Name') @lang('dashboard.ar')</label>
                                                        <input  name="attachments[{{$key}}][name_ar]" type="text" class="form-control " id="exampleInputName1" value="{{$attachment['name_ar']}}">
                                                    </div>

                                                    <div class="form-group col-3">
                                                        <label class=" mr-3 ml-3" for="exampleInputName1">@lang('dashboard.Name') @lang('dashboard.en')</label>
                                                        <input  name="attachments[{{$key}}][name_en]" type="text" class="form-control " id="exampleInputName1" value="{{$attachment['name_en']}}">
                                                    </div>

                                                    <div class="form-group clearfix col-2">
                                                        <div class="icheck-wetasphalt d-inline">
                                                            <input  name="is_active" type="checkbox" id="checkboxPrimary{{$key}}" checked="">
                                                            <label for="checkboxPrimary{{$key}}">@lang('dashboard.Activate')</label>
                                                        </div>
                                                    </div>
                                                    <input name="attachments[{{$key}}][sent]" class="col-12" type="hidden" id="checkboxPrimary3" value="{{$key}}">

                                                    <div class="col-1">
                                                        <div class="delete_content" style="cursor: pointer;"><i style="color:red" class="nav-icon fas fa-minus-circle"></i></div>
                                                    </div>
                                                    <div class="col-12"><hr></div>
                                                </div>
                                            @endforeach
                                        @endif

                                    <!-- Course Attachments Section -->




                                    </div>
                                    <div id="content_goals" class="form-group col-12">
                                        <div class="row">
                                            <div class="col-5">
                                                <label for="exampleInputName1">@lang('dashboard.course_goals') <span class="optional">@lang('dashboard.optional')</span> </label>
                                            </div>
                                            <div class="col-1">
                                                <div id="add_content_goals" style="cursor: pointer;"><i style="color: green" class="nav-icon fas fa-plus-circle"></i></div>
                                            </div>
                                        </div>
                                        @if(old('goals') !== null)
                                            @foreach(old('goals') as $key => $goal)
                                                <div class="book-div row">
                                                     <div class="form-group col-5">
                                                             <label class="ml-3 mr-3" for="exampleInputName1">@lang("dashboard.goal") @lang('dashboard.ar')</label>
                                                             <input name="goals[{{$key}}][goal_ar]" type="text" class="form-control" id="exampleInputName1" value="{{$goal['goal_ar']}}">
                                                          </div>
                                                      <div class="form-group col-5">
                                                            <label class="ml-3 mr-3" for="exampleInputName1">@lang("dashboard.goal") @lang('dashboard.en')</label>
                                                             <input name="goals[{{$key}}][goal_en]" type="text" class="form-control" id="exampleInputName1" placeholder="" value="{{$goal['goal_en']}}">
                                                          </div>

                                                       <div class="col-1">
                                                             <div class="delete_content" style="cursor: pointer;"><i style="color:red" class="nav-icon fas fa-minus-circle"></i></div>
                                                          </div>
                                                   <div class="col-12"><hr></div>
                                                </div>
{{----}}
                                            @endforeach
                                        @endif
{{----}}
                                    </div>


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
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            var specialcommission = $('#specialcommission');
            var special = $('#special').find(':checked');
            var special_val = special.val();
            if (special_val == 'on')
            {
                specialcommission.show();
            }
            else
            {
                specialcommission.hide();
            }

            $('#special').on('change', function() {
                var special = $(this).find(':checked');
                var special_val = special.val();
                if (special_val == 'on')
                {
                    specialcommission.show();
                }
                else
                {
                    specialcommission.hide();
                }
            });

        });
    </script>

    <script>
        $(function () {
            $('#summernote').summernote();
            $('#summernote2').summernote();
            $('#summernote3').summernote();
            $('#summernote4').summernote();
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
            let index = {{old('books') !== null ? count(old('books')) : 0 }}
            $('#add_content').on('click', function (e) {
                 index++;
                const content = '' +
                    '<div class="book-div row col-12">' +
                    '  <div class="form-group col-3">' +
                    '     <label for="exampleInputName1">@lang("dashboard.Name") @lang("dashboard.ar")</label>' +
                    '     <input name="books[' + index + '][name_ar]" type="text" class="form-control" id="exampleInputName1" placeholder="">' +
                    '   </div>' +
                    '  <div class="form-group col-3">' +
                    '     <label for="exampleInputName1">@lang("dashboard.Name") @lang("dashboard.en")</label>' +
                    '     <input name="books[' + index + '][name_en]" type="text" class="form-control" id="exampleInputName1" placeholder="">' +
                    '   </div>' +
                    '  <div class="form-group col-2">' +
                    '     <label for="exampleInputName1">@lang("dashboard.price")</label>' +
                    '     <input name="books[' + index + '][price]" type="text" class="form-control" id="exampleInputName1" placeholder="">' +
                    '   </div>' +
                    '  <div class="form-group col-3">' +
                    '     <label for="exampleInputName1">@lang("dashboard.Image")</label>' +
                    '     <input  required name="books[' + index + '][image]" type="file" class="form-control" id="exampleInputName1" placeholder="">' +
                    '   </div>' +
                    '    <div class="col-1">' +
                    '        <div class="delete_content" style="cursor: pointer;"><i style="color:red" class="nav-icon fas fa-minus-circle"></i></div>' +
                    '    </div>' +
                    '' +
                    ' <input name="books[' + index + '][sent]" class="col-12" type="hidden" id="checkboxPrimary3" value='+ index + '>' +
                    '<div class="col-12"><hr></div>' +
                    '</div>' +

                    '';
                $('#content').append(content);
            });
            $('.row').on('click', '.delete_content', function (e) {
                $(this).parent().parent().remove();
            });
        });
    </script>
    <script>

        $(function () {
            let index = 0;
            $('#add_content_attachments').on('click', function (e) {
                index++;

                const content_attachments = '' +
                    '<div class="book-div row">' +
                    '  <div class="form-group col-3">' +
                    '     <label for="exampleInputName1">@lang("dashboard.file")</label>' +
                    '     <input required name="attachments[' + index + '][file]" type="file" class="form-control" id="exampleInputName1" placeholder="">' +
                    '   </div>' +
                    '' +
                    '  <div class="form-group col-3">' +
                    '     <label class="ml-3 mr-3" for="exampleInputName1">@lang("dashboard.Name") @lang('dashboard.ar')</label>' +
                    '     <input name="attachments[' + index + '][name_ar]" type="text" class="form-control" id="exampleInputName1" placeholder="">' +
                    '  </div>' +

                    '  <div class="form-group col-3">' +
                    '     <label class="ml-3 mr-3" for="exampleInputName1">@lang("dashboard.Name") @lang('dashboard.en')</label>' +
                    '     <input name="attachments[' + index + '][name_en]" type="text" class="form-control" id="exampleInputName1" placeholder="">' +
                    '  </div>' +
                    '' +
                    '  <div class="form-group clearfix col-2 "> ' +
                    '       <div class="icheck-wetasphalt d-inline d-flex "> ' +
                    '       <input name="attachments['+ index + '][is_active]" class="col-12" type="checkbox" id="checkboxPrimary' + index + '" checked="">' +
                    '        <label for="checkboxPrimary' + index + '">@lang('dashboard.Activate')</label>' +

                    '</div>' +
            '</div>' +
                    ' <input name="attachments[' + index + '][sent]" class="col-12" type="hidden" id="checkboxPrimary3" value='+ index + '>' +

                    '    <div class="col-1">' +
                    '        <div class="delete_content" style="cursor: pointer;"><i style="color:red" class="nav-icon fas fa-minus-circle"></i></div>' +
                    '    </div>' +
                    '<div class="col-12"><hr></div>' +
                    '</div>' +
                    '';
                $('#content_attachment').append(content_attachments);
            });
            $('.row').on('click', '.delete_content', function (e) {
                $(this).parent().parent().remove();
            });
        });
    </script>

    <script>
        $(function () {
            let index = 0;
            $('#add_content_goals').on('click', function (e) {
                index++;

                const content_goals = '' +
                    '<div class="book-div row">' +
                    '' +
                    '  <div class="form-group col-5">' +
                    '     <label class="ml-3 mr-3" for="exampleInputName1">@lang("dashboard.goal") @lang('dashboard.ar')</label>' +
                    '     <input required name="goals[' + index + '][goal_ar]" type="text" class="form-control" id="exampleInputName1" placeholder="">' +
                    '  </div>' +

                    '  <div class="form-group col-5">' +
                    '     <label class="ml-3 mr-3" for="exampleInputName1">@lang("dashboard.goal") @lang('dashboard.en')</label>' +
                    '     <input name="goals[' + index + '][goal_en]" type="text" class="form-control" id="exampleInputName1" placeholder="">' +
                    '  </div>' +
                    '' +
                    '    <div class="col-1">' +
                    '        <div class="delete_content" style="cursor: pointer;"><i style="color:red" class="nav-icon fas fa-minus-circle"></i></div>' +
                    '    </div>' +
                    '<div class="col-12"><hr></div>' +
                    '</div>' +
                    '';
                $('#content_goals').append(content_goals);
            });
            $('.row').on('click', '.delete_content', function (e) {
                $(this).parent().parent().remove();
            });
        });
    </script>

    <script>
        $('#content').on('change' , '.is_check' , function (){
            if (this.checked) {
                $(this).next().next().removeAttr("disabled");
            } else {
                $(this).next().next().attr("disabled", true);
                $(this).next().next().val(0);
            }
        });

        $('#check_certificate').on('change' , function (){
           if(this.checked) {
               $('#certificatePrice').removeAttr('disabled');
           }else {
               $('#certificatePrice').attr('disabled' , true);
           }
        });
    </script>

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


@endsection
