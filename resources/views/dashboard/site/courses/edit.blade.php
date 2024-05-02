@extends('dashboard.core.app')
@section('title', __('titles.Edit') . " " . __('titles.Course'))

@section('css_addons')
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
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
                        <form  action="{{ route('courses.update' , $course['id']) }}" method="post" autocomplete="off" enctype="multipart/form-data">
                            <div class="card-header">
                                <h3 class="card-title">@section('title', __('titles.Edit') . " " . __('titles.Courses'))</h3>
                            </div>
                            <div class="card-body">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="exampleInputName1">@lang('dashboard.Name') @lang('dashboard.ar')</label>
                                        <input required name="name_ar" type="text" class="form-control" id="exampleInputName1" value="{{ $course['name_ar'] }}" placeholder="">
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="exampleInputName1">@lang('dashboard.Name') @lang('dashboard.en')</label>
                                        <input  name="name_en" type="text" class="form-control" id="exampleInputName1" value="{{ $course['name_en'] }}" placeholder="">
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="summernote">@lang('dashboard.Description') @lang('dashboard.ar')</label>
                                        <textarea  name="description_ar" type="text" class="form-control" id="summernote">{{ $course['description_ar'] }}</textarea>
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="summernote2">@lang('dashboard.Description') @lang('dashboard.en')</label>
                                        <textarea  name="description_en" type="text" class="form-control" id="summernote2">{{ $course['description_en'] }}</textarea>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="form-group col-3">
                                        <label for="price">@lang('dashboard.price')</label>
                                        <input name="price" type="number" class="form-control" id="exampleInputName1" placeholder="" value="{{$course['price']}}">
                                    </div>

                                    <div class="form-group col-3">
                                        <label for="price">@lang('dashboard.app_price')</label>
                                        <input name="app_price" type="number" class="form-control" id="exampleInputName1" placeholder="" value="{{$course['app_price']}}">
                                    </div>
                                    <div class="form-group col-3">
                                        <label for="exampleInputName1">@lang('dashboard.Image')</label>
                                        <input name="image" type="file" class="form-control" id="exampleInputName1" placeholder="">
                                        <div class="col-2"><img src="{{ $course->image ?? '' }}" width="100px" /></div>

                                    </div>


                                    <div class="form-group col-3">
                                        <label
                                            for="platform_type">@lang('dashboard.link_platform')</label>
                                        <select id="platform_type" class="form-control" name="explanation_video_platform">
                                            <option @if($course['explanation_video_platform'] == "YOUTUBE") selected @endif value="YOUTUBE">@lang('dashboard.youtube')</option>
                                            <option @if($course['explanation_video_platform'] == "VIMEO") selected @endif value="VIMEO">@lang('dashboard.vimeo')</option>
                                            <option @if($course['explanation_video_platform'] == "SWARMIFY") selected @endif value="SWARMIFY">@lang('dashboard.swarmify')</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-4">
                                        <label for="exampleInputName1">@lang('dashboard.explanation_video')</label>
                                        <input name="explanation_video" value="{{ $course->explanation_video }}" type="text" class="form-control" id="exampleInputName1" placeholder="">
                                    </div>

                                    <div class="form-group col-4">
                                        <label for="exampleInputName1">@lang('dashboard.course_plan')</label>
                                        <input accept="application/pdf" name="profile_file" type="file" class="form-control" id="exampleInputName1" placeholder="">
                                        @isset($course->profile_file)
                                            <div class="col-2"><a download href="{{url($course->profile_file)}}" >@lang('dashboard.download_file')</a></div>
                                        @endisset

                                    </div>

                                    <div class="form-group col-4">
                                        <label for="category">@lang('dashboard.category')</label>
                                        <select id="category" name="category_id"  class="form-control">
                                            @foreach($categories as $category)
                                                <option @selected($course->category_id == $category['id']) value="{{$category['id']}}">{{$category->t('name')}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-4">
                                        <label for="exampleInputName1">@lang('dashboard.start_date')</label>
                                        <input required name="start_date" type="date" class="form-control" id="exampleInputName1" placeholder="" value="{{$course['start_date']}}">
                                    </div>

                                    <div class="form-group col-4">
                                        <label for="exampleInputName1">@lang('dashboard.end_date') <span class="optional">@lang('dashboard.optional')</span></label>
                                        <input name="end_date" type="date" class="form-control" id="exampleInputName1" placeholder="" value="{{$course['end_date']}}">
                                    </div>

                                    <div class="form-group col-4">
                                        <label for="exampleInputName1">@lang('dashboard.duration') <span class="optional">@lang('dashboard.optional')</span></label>
                                        <input name="duration" type="number" class="form-control" id="exampleInputName1" placeholder="" value="{{$course['duration']}}">
                                    </div>

                                    <div class="form-group col-4">
                                        <label for="exampleInputName1">@lang('dashboard.whatsapp_link') <span class="optional">@lang('dashboard.optional')</span></label>
                                        <input name="whatsapp_link" type="text" class="form-control" id="exampleInputName1" placeholder="" value="{{$course['whatsapp_link']}}">
                                    </div>

                                    <div class="form-group col-4">
                                        <label for="exampleInputName1">@lang('dashboard.telegram_link') <span class="optional">@lang('dashboard.optional')</span></label>
                                        <input name="telegram_link" type="text" class="form-control" id="exampleInputName1" placeholder="" value="{{$course['telegram_link']}}">
                                    </div>

                                    <div class="form-group col-4">
                                        <label for="exampleInputName1">@lang('dashboard.telegram_channel_link') <span class="optional">@lang('dashboard.optional')</span></label>
                                        <input name="telegram_channel_link" type="text" class="form-control" id="exampleInputName1" placeholder="" value="{{$course['telegram_channel_link']}}">
                                    </div>


                                    <div class="form-group col-4">
                                        <label for="select">@lang('dashboard.teachers')</label>
                                        <select id="select" name="teachers[]" class="select2 select2-hidden-accessible" multiple="" data-placeholder="Select a State" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                            @foreach($teachers as $teacher)
                                                <option @selected(in_array($teacher['id'] , $course->teachers->pluck('id')->toArray())) value="{{$teacher['id']}}" >{{$teacher['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                    <div class="form-group col-4">
                                        <label for="active">@lang('dashboard.show_teacher_names')</label>
                                        <select required id="active" name="show_teacher_names"  class="form-control">
                                            <option value="1" @selected($course->show_teacher_names == true)>@lang('dashboard.show')</option>
                                            <option value="0" @selected($course->show_teacher_names == false)>@lang('dashboard.hide')</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-4">
                                        <label for="select1">@lang('dashboard.cooperators') <span class="optional">@lang('dashboard.optional')</span></label>
                                        <select id="select1" name="teachers[]" class="select2 select2-hidden-accessible" multiple="" data-placeholder="Select a State" style="width: 100%;" data-select2-id="2" tabindex="-1" aria-hidden="true">
                                            @foreach($cooperators as $cooperator)
                                                <option @selected(in_array($cooperator['id'] , $course->teachers->pluck('id')->toArray())) value="{{$cooperator['id']}}" > {{$cooperator['name']}} ( {{$cooperator->roles[0]->t('display_name')}} )</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-4">

                                        <div class="icheck-wetasphalt d-inline">
                                            <input name="certificate_available" type="checkbox" id="check_certificate" @if(isset($course->certificate_price)) checked @endif>
                                            <label for="check_certificate">@lang('dashboard.available?')</label>
                                        </div>


                                        <input name="request_certificate_available" type="hidden" value="off">
                                        <div class="icheck-wetasphalt d-inline">
                                            <input name="request_certificate_available" type="checkbox" id="request_certificate_available"  @if($course->request_certificate_available) checked @endif>
                                            <label for="request_certificate_available">@lang('dashboard.request_certificate_available')</label>
                                        </div>


                                        <label for="exampleInputName1">@lang('dashboard.certificate_price')</label>
                                        <input @if(!isset($course->certificate_price)) disabled @endif name="certificate_price" type="number" class="form-control" id="certificatePrice" placeholder="" value="{{$course['certificate_price'] ?? 0}}">
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-4">
                                            <label for="exampleInputName1">@lang('dashboard.sort')</label>
                                            <input name="sort" type="number" min="1" step="1" class="form-control" id="exampleInputName1" placeholder="" value="{{$course->sort}}">
                                        </div>
                                        <div class="form-group col-4" id="special">
                                            <label for="exampleInputName1">@lang('dashboard.Not_Continue')</label>
                                            <input name="notcontinue" type="checkbox" class="form-control" id="exampleInputName1" @if($course->notcontinue == 1) checked @endif>
                                        </div>
                                        <div class="form-group col-4" id="specialcommission">
                                            <label for="exampleInputName1">@lang('dashboard.dayNumbers')</label>
                                            <input name="dayNumbers" type="number" min="1" step="1" class="form-control" id="exampleInputName1" placeholder="" value="{{ $course->dayNumbers }}">
                                        </div>
                                    </div>



                                    <div class="form-group clearfix col-4">
                                        <input name="is_active" type="hidden" value="off">
                                        <div class="icheck-wetasphalt d-inline">
                                            <input name="is_active" type="checkbox" id="checkboxPrimary3" @checked($course->is_active == 1)>
                                            <label for="checkboxPrimary3">@lang('dashboard.Activate')</label>
                                        </div>
                                    </div>

                                    <div class="form-group clearfix col-3">
                                        <input name="registration_status" type="hidden" value="off">
                                        <div class="icheck-wetasphalt d-inline">
                                            <input name="registration_status" type="checkbox" id="registration_status" @checked($course->registration_status == 1)>
                                            <label for="registration_status">@lang('dashboard.open_registration')</label>
                                        </div>
                                    </div>

                                    <div class="form-group clearfix col-3">
                                        <input name="is_ratable" type="hidden" value="off">
                                        <div class="icheck-wetasphalt d-inline">
                                            <input name="important_flag" type="checkbox" id="checkboxPrimary4" @checked($course->is_ratable == 1)>
                                            <label for="checkboxPrimary4">@lang('dashboard.is_ratable')</label>
                                        </div>
                                    </div>

                                    <div class="form-group clearfix col-3">
                                        <input name="important_flag" type="hidden" value="off">
                                        <div class="icheck-wetasphalt d-inline">
                                            <input name="important_flag" type="checkbox" id="checkboxPrimary8" @checked($course->important_flag == 1)>
                                            <label for="checkboxPrimary8">@lang('dashboard.important_flag')</label>
                                        </div>
                                    </div>
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
                                    @if($course->goals)
                                        @foreach(json_decode($course->goals , true) as $key => $goal)
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
                                        @endforeach
                                    @endif
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
    <script>
        $(function () {
            $('#summernote').summernote();
            $('#summernote2').summernote();
            $('#summernote3').summernote();
            $('#summernote4').summernote();
        });
    </script>
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
            bsCustomFileInput.init();
            $('.select2').select2({
                language: {
                    searching: function() {}
                },
            });
        });

        $('#check_certificate').on('change' , function (){
            if(this.checked) {
                $('#certificatePrice').removeAttr('disabled');
            }else {
                $('#certificatePrice').attr('disabled' , true);
            }
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
                    '     <input required name="goals[' + index + '][goal_en]" type="text" class="form-control" id="exampleInputName1" placeholder="">' +
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
@endsection


