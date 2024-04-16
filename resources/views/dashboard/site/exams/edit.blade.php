@extends('dashboard.core.app')
@section('title', __('titles.Edit') . " " . __('titles.Exam'))

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
                        <form action="{{ route('exams.update' , $exam['id']) }}" method="post" autocomplete="off" enctype="multipart/form-data">
                            <div class="card-header">
                                <h3 class="card-title">{{__('titles.Edit') . " " . __('titles.Exam')}}</h3>
                            </div>
                            <div class="card-body">
                                @csrf
                                @method('PUT')


                                <div class="row">
                                    <div class="col-6">
                                        <label for="duration">@lang('dashboard.duration_in_minutes')</label>
                                        <input value="{{old('duration') ?? $exam['duration']}}" id="duration" type="number" step=".5" name="duration" class="form-control">
                                    </div>
{{--                                    <div class="col-6">--}}
{{--                                        <label for="attempts">@lang('dashboard.max_attempts')</label>--}}
{{--                                        <input id="attempts" value="{{old('attempts') ?? $exam['attempts']}}" type="number"  name="attempts" class="form-control">--}}
{{--                                    </div>--}}


                                    <div class="col-2">
                                        <label
                                            for="platform_type">@lang('dashboard.link_platform')</label>
                                        <select id="platform_type" class="form-control" name="solution_video_platform">
                                            <option @selected($exam->solution_video_platform == "YOUTUBE") value="YOUTUBE">@lang('dashboard.youtube')</option>
                                            <option @selected($exam->solution_video_platform == "VIMEO") value="VIMEO">@lang('dashboard.vimeo')</option>
                                            <option @selected($exam->solution_video_platform == "SWARMIFY") value="SWARMIFY">@lang('dashboard.swarmify')</option>
                                        </select>
                                    </div>

                                    <div class="col-8">
                                        <label for="solution_video_link">@lang('dashboard.solution_video_link') <span class="optional">@lang('dashboard.optional')</span></label>
                                        <input id="solution_video_link" value="{{old('solution_video_link') ?? $exam['solution_video_link'] ?? ""}}" type="text" name="solution_video_link" class="form-control">
                                    </div>

                                    <div class="form-group clearfix col-6 mt-2">
                                        <input name="is_active" type="hidden" value="off">
                                        <div class="icheck-wetasphalt d-inline">
                                            <input name="is_active" type="checkbox" id="checkboxPrimary3" @checked($exam->is_active == 1) >
                                            <label for="checkboxPrimary3">@lang('dashboard.Activate')</label>
                                        </div>
                                    </div>

                                    <div class="form-group clearfix col-6 mt-2">
                                        <div class="icheck-wetasphalt d-inline">
                                            <input name="is_free" type="checkbox" id="free_exam" @checked($exam->is_free == 1)>
                                            <label for="free_exam">@lang('dashboard.free_exam')</label>
                                        </div>
                                    </div>
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

@endsection
