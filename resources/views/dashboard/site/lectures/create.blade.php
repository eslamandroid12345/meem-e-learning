@php use Carbon\Carbon; @endphp
@extends('dashboard.core.app')
@section('title', __('titles.Create') . " " . __('titles.Lecture'))

@section('css_addons')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.Lectures')</h1>
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
                        <form action="{{ route('lectures.store') }}" method="post" autocomplete="off"
                              enctype="multipart/form-data" novalidate>
                            <div class="card-header">
                                <h3 class="card-title">{{__('titles.Create') . " " . __('titles.Lecture')}}</h3>
                            </div>
                            <div class="card-body">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="exampleInputName1">@lang('dashboard.Lecture Current Type')</label>
                                        <select id="type" name="type" class="form-control">
                                            <option
                                                @selected(old('type') == 'RECORDED') value="RECORDED">@lang('db.lecture_type.RECORDED')</option>
                                            <option
                                                @selected(old('type') == 'LIVE') value="LIVE">@lang('db.lecture_type.LIVE')</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-3">
                                        <label for="course">@lang('dashboard.Course')</label>
                                        <select id="course" name="course_id" class="select2 select2-hidden-accessible" data-placeholder="Select a State" style="width: 100%;" data-select2-id="2" tabindex="-1" aria-hidden="true">
                                            <option value="0" id="initOptionStandard">@lang('dashboard.none')</option>
                                            @foreach($courses as $course)
                                                <option @selected(old('course_id') == $course['id']) value="{{$course['id']}}">{{$course->t('name')}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-3">
                                        <label for="standard">@lang('dashboard.Standard')</label>
                                        <select id="standard" name="standard_id" class="form-control">
{{--                                            <option value="0" id="initOptionStandard">@lang('dashboard.none')</option>--}}

{{--                                            @foreach($standards as $standard)--}}
{{--                                                <option @selected(old('standard_id') == $standard['id']) hidden class="course-{{$standard['course_id']}} standard" value="{{$standard['id']}}">{{$standard->t('name')}}</option>--}}
{{--                                            @endforeach--}}

                                        </select>
                                    </div>
{{--                                    <div class="form-group col-6">--}}
{{--                                        <label for="standard">@lang('dashboard.Standard')</label>--}}
{{--                                        <select id="standard" name="standard_id"--}}
{{--                                                class="form-control select2 select2-hidden-accessible"--}}
{{--                                                style="width: 100%;">--}}
{{--                                            <option value=""></option>--}}
{{--                                            @foreach($courses as $course)--}}
{{--                                                <optgroup label="{{ $course->t('name') }}">--}}
{{--                                                    @foreach($course->standards as $standard)--}}
{{--                                                        <option--}}
{{--                                                            @selected(old('standard_id') !== null ? old('standard_id') == $standard['id'] : request('standard_id') == $standard['id']) value="{{$standard['id']}}">{{$standard->t('name')}}</option>--}}
{{--                                                    @endforeach--}}
{{--                                                </optgroup>--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
                                </div>
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="exampleInputName1">@lang('dashboard.Name Ar')</label>
                                        <input name="name_ar" type="text" class="form-control" id="exampleInputName1"
                                               value="{{ old('name_ar') }}" placeholder="">
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="exampleInputName1">@lang('dashboard.Name En')</label>
                                        <input name="name_en" type="text" class="form-control" id="exampleInputName1"
                                               value="{{ old('name_en') }}" placeholder="">
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="summernote">@lang('dashboard.Description') @lang('dashboard.ar')</label>
                                        <textarea name="description_ar" type="text" class="form-control" id="summernote">{{ old('description_ar') }}</textarea>
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="summernote2">@lang('dashboard.Description') @lang('dashboard.en')</label>
                                        <textarea  name="description_en" type="text" class="form-control" id="summernote2">{{ old('description_en') }}</textarea>
                                    </div>
                                </div>

                                    <div class="row">
                                        @if(auth()->user()->hasPermission('lectures-links'))
                                            <div class="col-2">
                                                <label
                                                    for="platform_type">@lang('dashboard.link_platform')</label>
                                                <select id="platform_type" class="form-control" name="link_platform">
                                                    <option @if(old('link_platform' == "YOUTUBE")) selected @endif value="YOUTUBE">@lang('dashboard.youtube')</option>
                                                    <option @if(old('link_platform' == "VIMEO")) selected @endif value="VIMEO">@lang('dashboard.vimeo')</option>
                                                    <option @if(old('link_platform' == "SWARMIFY")) selected @endif value="SWARMIFY">@lang('dashboard.swarmify')</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-6">
                                            <label
                                                for="exampleInputRecordedLink">@lang('dashboard.Recorded Lecture Link')</label>
                                            <input name="record_link" type="text" class="form-control"
                                                   id="exampleInputRecordedLink" value="{{ old('record_link') }}"
                                                   placeholder="">
                                        </div>
                                        @endif
                                        <div class="form-group col-4">
                                            <label for="publish_at">@lang('dashboard.Publish At')</label>
                                            <input name="publish_at" type="datetime-local" class="form-control" id="publish_at"
                                                   value="{{ old('publish_at') ?? Carbon::now() }}"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        @if(auth()->user()->hasPermission('lectures-links'))
                                            <div class="form-group col-6">
                                            <label
                                                for="exampleInputLiveLink">@lang('dashboard.Live Lecture Link')</label>
                                            <input name="live_link" type="text" class="form-control"
                                                   id="exampleInputLiveLink" value="{{ old('live_link') }}"
                                                   placeholder="">
                                        </div>
                                        @endif
                                        <div class="form-group col-3">
                                            <label for="starts_at">@lang('dashboard.Starts At')</label>
                                            <input name="starts_at" type="datetime-local" class="form-control" id="starts_at"
                                                   value="{{ old('starts_at') ?? Carbon::now() }}"/>
                                        </div>
                                        <div class="form-group col-3">
                                            <label for="ends_at">@lang('dashboard.Ends At')</label>
                                            <input name="ends_at" type="datetime-local" class="form-control" id="ends_at"
                                                   value="{{ old('ends_at') ?? Carbon::now() }}"/>
                                        </div>
                                    </div>
                                <div class="row">
                                    <div class="form-group clearfix col-3">
                                        <label for="duration">@lang('dashboard.duration') @lang('dashboard.in_minutes')</label>
                                        <input name="duration" type="number" step="1" min="0" class="form-control" id="duration"
                                               value="{{ old('duration') }}"/>
                                    </div>
                                    <div class="form-group clearfix col-3">
                                        <label for="duration">@lang('dashboard.sort')</label>
                                        <input name="sort" type="number" min="1" step="1" class="form-control" id="exampleInputName1" placeholder="" value="{{old('sort')}}">
                                    </div>
                                    <div class="clearfix col-3" style="display: grid;">
                                        <div class="row align-items-end">
                                            <div class="form-group col-6 m-0">
                                                <div class="icheck-wetasphalt d-inline">
                                                    <input name="is_free" type="checkbox" id="checkboxPrimary3" @checked(old('is_free') == 'on')>
                                                    <label for="checkboxPrimary3">@lang('dashboard.Free Lecture')</label>
                                                </div>
                                            </div>
                                            <div class="form-group col-6 m-0">
                                                <div class="icheck-wetasphalt d-inline">
                                                    <input name="is_active" type="checkbox" id="checkboxPrimary4" @checked(old('is_active') == 'on')>
                                                    <label for="checkboxPrimary4">@lang('dashboard.Activate')</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-4">
                                        <div id="add_indicator" style="cursor: pointer;"><i
                                                class="nav-icon fas fa-plus-circle"></i> @lang('dashboard.Create New Indicator')
                                        </div>
                                        <br>
                                        <div class="indicators"></div>
                                    </div>
                                    <div class="col-8">
                                        <div id="add_pin" style="cursor: pointer;"><i
                                                class="nav-icon fas fa-plus-circle"></i> @lang('dashboard.Create New Pin')
                                        </div>
                                        <br>
                                        <div class="pins"></div>
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
                    searching: function () {
                    }
                },
            });
        });
    </script>
    <script>
        $(function () {
            let pin_count = 0;
            @if(old('pins') !== null)
                @foreach(old('pins') as $key => $pin)
                    const old_pin_{{$key}} = '' +
                        '<div class="row pin">' +
                        '    <div class="form-group col-2">' +
                        '        <label for="exampleInputName1">@lang("dashboard.Pin Time")</label>' +
                        '        <input name="pins[' + pin_count + '][time]" type="text" class="form-control" id="exampleInputName1" value="{{ old('pins.'.$key.'.time') }}" placeholder="hh:mm:ss">' +
                        '    </div>' +
                        '    <div class="form-group col-2">' +
                        '        <label for="exampleInputName1">@lang("dashboard.Pin Name Ar")</label>' +
                        '        <input name="pins[' + pin_count + '][name_ar]" type="text" class="form-control" id="exampleInputName1" value="{{ old('pins.'.$key.'.name_ar') }}" placeholder="">' +
                        '    </div>' +
                        '    <div class="form-group col-2">' +
                        '        <label for="exampleInputName1">@lang("dashboard.Pin Name En")</label>' +
                        '        <input name="pins[' + pin_count + '][name_en]" type="text" class="form-control" id="exampleInputName1" value="{{ old('pins.'.$key.'.name_en') }}" placeholder="">' +
                        '    </div>' +
                        '    <div class="col-1">' +
                        '        <div class="delete_pin" style="cursor: pointer;"><i class="nav-icon fas fa-minus-circle"></i></div>' +
                        '    </div>' +
                        '</div>' +
                        '';
                    $('.pins').append(old_pin_{{$key}});
                    pin_count++;
                @endforeach
            @endif
            $('#add_pin').on('click', function (e) {
                const pin = '' +
                    '<div class="row pin">' +
                    '    <div class="form-group col-2">' +
                    '        <label for="exampleInputName1">@lang("dashboard.Pin Time")</label>' +
                    '        <input name="pins[' + pin_count + '][time]" type="text" class="form-control" id="exampleInputName1" placeholder="hh:mm:ss">' +
                    '    </div>' +
                    '    <div class="form-group col-2">' +
                    '        <label for="exampleInputName1">@lang("dashboard.Pin Name Ar")</label>' +
                    '        <input name="pins[' + pin_count + '][name_ar]" type="text" class="form-control" id="exampleInputName1" placeholder="">' +
                    '    </div>' +
                    '    <div class="form-group col-2">' +
                    '        <label for="exampleInputName1">@lang("dashboard.Pin Name En")</label>' +
                    '        <input name="pins[' + pin_count + '][name_en]" type="text" class="form-control" id="exampleInputName1" placeholder="">' +
                    '    </div>' +
                    '    <div class="col-1">' +
                    '        <div class="delete_pin" style="cursor: pointer;"><i class="nav-icon fas fa-minus-circle"></i></div>' +
                    '    </div>' +
                    '</div>' +
                    '';
                $('.pins').append(pin);
                pin_count++;
            });
            $('.row').on('click', '.delete_pin', function (e) {
                $(this).parent().parent().remove();
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function () {
            $('#summernote').summernote();
            $('#summernote2').summernote();

        });
    </script>
    <script>
        $(function () {
            let indicator_count = 0;
            @if(old('indicators') !== null)
                @foreach(old('indicators') as $key => $indicator)
                    const old_indicator_{{$key}} = '' +
                        '<div class="row indicator">' +
                        '    <div class="form-group col-5">' +
                        '        <label for="exampleInputName1">@lang("dashboard.Indicator Name Ar")</label>' +
                        '        <input name="indicators[' + indicator_count + '][name_ar]" type="text" class="form-control" id="exampleInputName1" value="{{ old('indicators.'.$key.'.name_ar') }}" placeholder="">' +
                        '    </div>' +
                        '    <div class="form-group col-5">' +
                        '        <label for="exampleInputName1">@lang("dashboard.Indicator Name En")</label>' +
                        '        <input name="indicators[' + indicator_count + '][name_en]" type="text" class="form-control" id="exampleInputName1" value="{{ old('indicators.'.$key.'.name_en') }}" placeholder="">' +
                        '    </div>' +
                        '    <div class="col-2">' +
                        '        <div class="delete_indicator" style="cursor: pointer;"><i class="nav-icon fas fa-minus-circle"></i></div>' +
                        '    </div>' +
                        '</div>' +
                        '';
                    $('.indicators').append(old_indicator_{{$key}});
                    indicator_count++;
                @endforeach
            @endif
            $('#add_indicator').on('click', function (e) {
                const indicator = '' +
                    '<div class="row indicator">' +
                    '    <div class="form-group col-5">' +
                    '        <label for="exampleInputName1">@lang("dashboard.Indicator Name Ar")</label>' +
                    '        <input name="indicators[' + indicator_count + '][name_ar]" type="text" class="form-control" id="exampleInputName1" placeholder="">' +
                    '    </div>' +
                    '    <div class="form-group col-5">' +
                    '        <label for="exampleInputName1">@lang("dashboard.Indicator Name En")</label>' +
                    '        <input name="indicators[' + indicator_count + '][name_en]" type="text" class="form-control" id="exampleInputName1" placeholder="">' +
                    '    </div>' +
                    '    <div class="col-2">' +
                    '        <div class="delete_indicator" style="cursor: pointer;"><i class="nav-icon fas fa-minus-circle"></i></div>' +
                    '    </div>' +
                    '</div>' +
                    '';
                $('.indicators').append(indicator);
                indicator_count++;
            });
            $('.row').on('click', '.delete_indicator', function (e) {
                $(this).parent().parent().remove();
            });
        });
    </script>

    <script>
        if($('#type').val() === "RECORDED"){
            $('#exampleInputLiveLink').attr('disabled' , true);
            $('#platform_type').attr('disabled' , false);

        }else{
            $('#exampleInputRecordedLink').attr('disabled' , true);
            $('#platform_type').attr('disabled' , true);
        }
        $('#type').on('change' , function (){
            if($(this).val() === 'RECORDED') {
                $('#exampleInputRecordedLink').attr('disabled' , false);
                $('#exampleInputLiveLink').attr('disabled' , true);
                $('#platform_type').attr('disabled' , false);

            }else{
                $('#exampleInputRecordedLink').attr('disabled' , true);
                $('#exampleInputLiveLink').attr('disabled' , false);
                $('#platform_type').attr('disabled' , true);

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
                    {{--$('#standard').append('<option value="0">@lang('dashboard.none')</option>');--}}

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

        // Trigger the change event of the "course" select box on page load
        $('#course').trigger('change');

        // filterStandards($('#course').val());
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
