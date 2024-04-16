@extends('dashboard.core.app')
@section('title', __('titles.Edit') . " " . __('titles.TrainingBag'))

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
                    <h1>@lang('dashboard.training_bags')</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card p-1">
                        <form action="{{route('bags.update' , $bag['id'])}}" method="post" autocomplete="off" enctype="multipart/form-data">
                            <div class="card-header">
                                <h3 class="card-title">{{__('titles.Edit') . " " . __('titles.TrainingBag')}}</h3>
                            </div>
                            <div class="card-body">
                                @csrf
                                @method('PUT')
                                <div class="row" id="content">
                                    <div class="form-group col-6">
                                        <label class="ml-3 mr-3" for="exampleInputName1">@lang('dashboard.Name') @lang('dashboard.ar')</label>
                                        <input value="{{$bag['name_ar']}}"  name="name_ar" type="text" class="form-control" id="exampleInputName1" placeholder="">
                                    </div>

                                    <div class="form-group col-6">
                                        <label class="ml-3 mr-3" for="exampleInputName1">@lang('dashboard.Name') @lang('dashboard.en')</label>
                                        <input value="{{$bag['name_ar']}}"  name="name_en" type="text" class="form-control" id="exampleInputName1" placeholder="">
                                    </div>

                                    <div class="form-group col-6">
                                        <label class="ml-3 mr-3" for="summernote">@lang('dashboard.Description') @lang('dashboard.ar')</label>
                                        <textarea id="summernote" class="form-control" name="description_ar">{{$bag['description_ar']}}</textarea>
                                    </div>

                                    <div class="form-group col-6">
                                        <label class="ml-3 mr-3" for="summernote1">@lang('dashboard.Description') @lang('dashboard.en')</label>
                                        <textarea id="summernote1" class="form-control" name="description_en">{{$bag['description_en']}}</textarea>
                                    </div>

                                    <div class="form-group col-6">
                                        <label class="ml-3 mr-3" for="exampleInputName1">@lang('dashboard.price')</label>
                                        <input value="{{$bag['price']}}"  name="price" type="number" class="form-control" id="exampleInputName1" placeholder="">
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="course">@lang('dashboard.Course')</label>
                                        <select id="course" name="course_id" class="select2 select2-hidden-accessible" data-placeholder="Select a State" style="width: 100%;" data-select2-id="2" tabindex="-1" aria-hidden="true">
                                            <option value="{{null}}">@lang('dashboard.none')</option>
                                            @foreach($courses as $course)
                                                <option @if($bag['course_id'] == $course['id']) selected @endif
                                                    value="{{$course['id']}}">{{$course->t('name')}}</option>
                                            @endforeach
                                        </select>
                                    </div>



                                    <div class="form-group col-6">
                                        <label for="exampleInputName1">@lang('dashboard.Image')</label>
                                        <input  name="image" type="file" class="form-control" id="exampleInputName1" placeholder="">
                                    </div>

                                    <div class="col-md-2">
                                        <img src="{{ $bag->image }}" width="200px" />
                                    </div>
                                    <div class="form-group clearfix col-4">
                                        <div class="icheck-wetasphalt d-inline">
                                            <input name="is_printable" type="checkbox" id="checkboxPrimary3" {{ old('is_printable') == 'on' || $bag->is_printable ? 'checked' : '' }}>
                                            <label for="checkboxPrimary3">@lang('dashboard.is_printable')</label>
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
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function () {
            $('#summernote').summernote();
            $('#summernote1').summernote();

            bsCustomFileInput.init();
            $('.select2').select2({
                language: {
                    searching: function() {}
                },
            });
        });
    </script>


@endsection
