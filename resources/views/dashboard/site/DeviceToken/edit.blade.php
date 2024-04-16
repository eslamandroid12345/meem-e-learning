@extends('dashboard.core.app')
@section('title', __('dashboard.devicetokens'))

@section('css_addons')
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

@endsection

@section('content')


    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.devicetokens')</h1>
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
                        <form action="{{route('devicetokens.sendsubscribe')}}" method="post" autocomplete="off" enctype="multipart/form-data">
                            <div class="card-header">
                                <h3 class="card-title">@lang('dashboard.suscribed')</h3>
                            </div>
                            <div class="card-body">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="exampleInputMainTitle2">@lang('dashboard.suscribed')</label>
                                            <select name="course_id"  class="form-control" id="exampleInputName1" required >
                                            <option selected disabled value="">Choose type</option>
                                                @foreach($courseshasusers as $courseshasuser)
                                                    @if(app()->getLocale() == 'en')
                                                        <option value="{{ $courseshasuser->id }}">{{ $courseshasuser->name_en }}</option>
                                                    @else
                                                        <option value="{{ $courseshasuser->id }}">{{ $courseshasuser->name_ar }}</option>
                                                    @endif
                                                @endforeach
                                        </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputMainTitle2">@lang('dashboard.title')</label>
                                            <input name="title" type="text" class="form-control" id="exampleInputName1" value="{{ old('title') }}" placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputMainTitle2">@lang('dashboard.content')</label>
                                            <textarea id="summernote1" class="form-control" name="content" required>{{old('content')}}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <hr>

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

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form action="{{route('devicetokens.sendnotsubscribe')}}" method="post" autocomplete="off" enctype="multipart/form-data">
                            <div class="card-header">
                                <h3 class="card-title">@lang('dashboard.notsuscribed')</h3>
                            </div>
                            <div class="card-body">
                                @csrf
{{--                                <div class="row">--}}
{{--                                    <div class="col-12">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label for="exampleInputMainTitle2">@lang('dashboard.suscribed')</label>--}}
{{--                                            <select name="course_id"  class="form-control" id="exampleInputName1"  >--}}
{{--                                            <option selected disabled value="">Choose type</option>--}}
{{--                                                @foreach($allcourses as $course)--}}
{{--                                                    @if(app()->getLocale() == 'en')--}}
{{--                                                        <option value="{{ $course->id }}">{{ $course->name_en }}</option>--}}
{{--                                                    @else--}}
{{--                                                        <option value="{{ $course->id }}">{{ $course->name_ar }}</option>--}}
{{--                                                    @endif--}}
{{--                                                @endforeach--}}
{{--                                        </select>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputMainTitle2">@lang('dashboard.title')</label>
                                            <input name="title" type="text" class="form-control" id="exampleInputName1" value="{{ old('title') }}" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputMainTitle2">@lang('dashboard.content')</label>
                                            <textarea id="summernote1" class="form-control" name="content">{{old('content')}}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <hr>

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


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form action="{{route('devicetokens.sendnotregister')}}" method="post" autocomplete="off" enctype="multipart/form-data">
                            <div class="card-header">
                                <h3 class="card-title">@lang('dashboard.notregistered')</h3>
                            </div>
                            <div class="card-body">
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputMainTitle2">@lang('dashboard.title')</label>
                                            <input name="title" type="text" class="form-control" id="exampleInputName1" value="{{ old('title') }}" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputMainTitle2">@lang('dashboard.content')</label>
                                            <textarea id="summernote1" class="form-control" name="content">{{old('content')}}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <hr>

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
        });
    </script>
        @endsection
