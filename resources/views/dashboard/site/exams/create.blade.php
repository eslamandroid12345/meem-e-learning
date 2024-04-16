@extends('dashboard.core.app')
@section('title', __('titles.Create') . " " . __('titles.Exam'))

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
                    <h1>@lang('dashboard.Exams')</h1>
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
                        <form action="{{ route('exams.store') }}" method="post" autocomplete="off" enctype="multipart/form-data">
                            <div class="card-header">
                                <h3 class="card-title">{{__('titles.Create') . " " . __('titles.Exam')}}</h3>
                            </div>
                            <div class="card-body">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="type">@lang('dashboard.exam_type')</label>
                                        <select id="type" name="type" class="select2 select2-hidden-accessible" data-placeholder="Select a State" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                            <option value="COURSE" >@lang('dashboard.course_exam')</option>
                                            <option value="STANDARD" >@lang('dashboard.standard_exam')</option>
                                            <option value="LECTURE" >@lang('dashboard.lecture_exam')</option>
                                        </select>
                                    </div>

                                    <div class="col-6">
                                        <label for="duration">@lang('dashboard.duration_in_minutes')</label>
                                        <input value="{{old('duration')}}" id="duration" type="number" step=".5" name="duration" class="form-control">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-4">
                                        <label for="course">@lang('dashboard.Course')</label>
                                        <select id="course" name="course_id" class="select2 select2-hidden-accessible" data-placeholder="Select a State" style="width: 100%;" data-select2-id="2" tabindex="-1" aria-hidden="true">
                                            @foreach($courses as $course)
                                                <option value="{{$course['id']}}">{{$course->t('name')}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-4">
                                        <label for="standard">@lang('dashboard.Standard')</label>
                                        <select disabled id="standard" name="standard_id" class="form-control">
{{--                                            <option value="0" id="initOptionStandard">@lang('dashboard.none')</option>--}}

{{--                                            @foreach($standards as $standard)--}}
{{--                                                <option hidden class="course-{{$standard['course_id']}} standard" value="{{$standard['id']}}">{{$standard->t('name')}}</option>--}}
{{--                                            @endforeach--}}

                                        </select>
                                    </div>

                                    <div class="form-group col-4">
                                        <label for="lecture">@lang('dashboard.Lecture')</label>
                                        <select disabled id="lecture" name="lecture_id" class="form-control">
                                            <option id="initOptionLecture">@lang('dashboard.none')</option>
{{--                                            @foreach($lectures as $lecture)--}}
{{--                                                <option hidden class="lectures standard-{{$lecture['standard_id']}}" value="{{$lecture['id']}}">{{$lecture->t('name')}}</option>--}}
{{--                                            @endforeach--}}
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
{{--                                    <div class="col-6">--}}
{{--                                        <label for="attempts">@lang('dashboard.max_attempts')</label>--}}
{{--                                        <input id="attempts" value="{{old('attempts')}}" type="number"  name="attempts" class="form-control">--}}
{{--                                    </div>--}}


                                    <div class="col-4">
                                        <label
                                            for="platform_type">@lang('dashboard.link_platform') <span class="optional">@lang('dashboard.optional')</span></label>
                                        <select id="solution_video_platform" class="form-control" name="solution_video_platform">
                                            <option @if(old('solution_video_platform' == "YOUTUBE")) selected @endif value="YOUTUBE">@lang('dashboard.youtube')</option>
                                            <option @if(old('solution_video_platform' == "VIMEO")) selected @endif value="VIMEO">@lang('dashboard.vimeo')</option>
                                            <option @if(old('solution_video_platform' == "SWARMIFY")) selected @endif value="SWARMIFY">@lang('dashboard.swarmify')</option>
                                        </select>
                                    </div>
                                    <div class="col-8">
                                        <label for="solution_video_link">@lang('dashboard.solution_video_link') <span class="optional">@lang('dashboard.optional')</span></label>
                                        <input id="solution_video_link" value="{{old('solution_video_link')}}" type="text" name="solution_video_link" class="form-control">
                                    </div>

                                    <div class="form-group clearfix col-6 mt-2">
                                        <div class="icheck-wetasphalt d-inline">
                                            <input name="is_active" type="checkbox" id="checkboxPrimary3" @checked(old('is_active') == 'on')>
                                            <label for="checkboxPrimary3">@lang('dashboard.Activate')</label>
                                        </div>
                                    </div>

                                    <div class="form-group clearfix col-6 mt-2">
                                        <div class="icheck-wetasphalt d-inline">
                                            <input name="is_free" type="checkbox" id="free_exam" @checked(old('is_free') == 'on')>
                                            <label for="free_exam">@lang('dashboard.free_exam')</label>
                                        </div>
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
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function () {
            bsCustomFileInput.init();
            $('.select2').select2({
                language: {
                    searching: function() {
                    }
                },
                minimumResultsForSearch: -1
            });
        });

    </script>

    <script>

        $('#type').on('change' , function (){
            if($(this).val() === 'COURSE') {
                $('#standard').val("");
                $('#standard').attr('disabled', 'disabled');
                $('#lecture').val("");
                $('#lecture').attr('disabled', 'disabled');

            }else if ($(this).val() === 'STANDARD'){
                $('#standard').removeAttr('disabled');
                $('#lecture').attr('disabled' , 'disabled');
                var course_id = $('#course').find(":selected").val();
                // filterStandards(course_id);
            } else {
                $('#standard').removeAttr('disabled');
                var course_id = $('#course').find(":selected").val();
                $('.standard').attr('hidden' , 'hidden');
                $('.course-' + course_id).removeAttr('hidden');

                $('#lecture').removeAttr('disabled');
                var standard_id = $('#standard').find(":selected").val();
                // filterLectures(standard_id);

            }
        });



        $('#course').change(function () {
            var course_id = $(this).val();

            // Send an AJAX request to fetch standards for the selected course
            $.ajax({
                url: '{{ route('ajax.standards.fetch') }}',
                type: 'POST',
                data: {
                    course_id: course_id,
                    _token: '{{ csrf_token() }}', // Add CSRF token if needed
                },
                success: function (data) {
                    // Clear existing options in the "standard" select box
                    $('#standard').empty();

                    // Add the "none" option
                    $('#standard').append('<option value="0">@lang('dashboard.none')</option>');

                    // Add the fetched standards to the "standard" select box
                    $.each(data, function (key, value) {
                        $('#standard').append('<option '+ ({{ old('standard_id') ?? 0 }} === value.id ? ' selected ' : '') +' value="' + value.id + '">' + value.name_{{app()->getLocale()}} + '</option>');
                    });
                },
                error: function (data) {
                    // Handle errors if necessary
                }
            });
        });
        $('#course').trigger('change');

        $('#standard').change(function () {
            var standard_id = $(this).val();

            // Send an AJAX request to fetch standards for the selected standard
            $.ajax({
                url: '{{ route('ajax.lectures.fetch') }}',
                type: 'POST',
                data: {
                    standard_id: standard_id,
                    _token: '{{ csrf_token() }}', // Add CSRF token if needed
                },
                success: function (data) {
                    // Clear existing options in the "standard" select box
                    $('#lecture').empty();

                    // Add the "none" option
                    $('#lecture').append('<option value="0">@lang('dashboard.none')</option>');

                    // Add the fetched standards to the "standard" select box
                    $.each(data, function (key, value) {
                        $('#lecture').append('<option '+ ({{ old('lecture_id') ?? 0 }} === value.id ? ' selected ' : '') +' value="' + value.id + '">' + value.name_{{app()->getLocale()}} + '</option>');
                    });
                },
                error: function (data) {
                    // Handle errors if necessary
                }
            });
        });
        $('#standard').trigger('change');




        //
        // $('#course').on('change' , function (){
        //     var course_id = $('#course').find(":selected").val();
        //     $('#standard').val("");
        //     $('#lecture').val("");
        //     filterStandards(course_id);
        // })
        //
        // $('#standard').on('change' , function (){
        //     var standard_id = $('#standard').find(":selected").val();
        //     $('#lecture').val("");
        //     filterLectures(standard_id);
        // })
        //
        //
        // function filterStandards(courseId){
        //     $('.standard').attr('hidden' , 'hidden');
        //     $('.course-' + courseId).removeAttr('hidden');
        //     $('.course-' + courseId).first().attr('selected' , 'selected');
        // }
        //
        // function filterLectures(standard_id){
        //     $('.lecture').attr('hidden' , 'hidden');
        //     $('.lectures').attr('hidden' , 'hidden');
        //     if(standard_id !== 0){
        //         $('.standard-' + standard_id).removeAttr('hidden');
        //         $('.standard-' + standard_id).first().attr('selected' , 'selected');
        //     }
        // }
    </script>
@endsection
