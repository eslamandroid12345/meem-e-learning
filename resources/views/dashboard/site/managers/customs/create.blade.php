@extends('dashboard.core.app')
@section('title', __('titles.t-Create', ['t' => $currentRole->t('display_name')]))
@section('css_addons')

@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ $currentRole->t('display_name') }}</h1>
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
                        <form action="{{ route('customs.store', request('role')) }}" method="post" autocomplete="off" enctype="multipart/form-data">
                            <div class="card-header">
                                <h3 class="card-title">{{ __('dashboard.t-Create', ['t' => $currentRole->t('display_name')]) }}</h3>
                            </div>
                            <div class="card-body ">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputFile">@lang('dashboard.Image')</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input name="image" type="file" class="custom-file-input" id="exampleInputFile">
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="exampleInputName1">@lang('dashboard.Name')</label>
                                        <input name="name" type="text" class="form-control" id="exampleInputName1" value="{{ old('name') }}" placeholder="">
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="exampleInputEmail1">@lang('dashboard.Email')</label>
                                        <input name="email" type="email" class="form-control" id="exampleInputEmail1" value="{{ old('email') }}" placeholder="">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="exampleInputPassword1">@lang('dashboard.Password')</label>
                                        <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="">
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="exampleInputPassword2">@lang('dashboard.Confirm Password')</label>
                                        <input name="password_confirmation" type="password" class="form-control" id="exampleInputPassword2" placeholder="">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-4">
                                        <label for="exampleInputPhone1">@lang('dashboard.Phone')</label>
                                        <input name="phone" type="number" class="form-control" id="exampleInputPhone1" value="{{ old('phone') }}" placeholder="">
                                    </div>
                                    <div class="form-group col-4">
                                        <label for="gender">@lang('dashboard.Gender')</label>
                                        <select id="gender" name="gender" class="form-control" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                            <option @selected(old('gender') == 'MALE') value="MALE">@lang('dashboard.Male')</option>
                                            <option @selected(old('gender') == 'FEMALE') value="FEMALE">@lang('dashboard.Female')</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-4">
                                        <label for="exampleInputPhone1">@lang('dashboard.birthdate')</label>
                                        <input name="birth_date" type="date"  class="form-control" id="exampleInputPhone1" value="{{ old('birth_date') }}" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">@lang('dashboard.cv_pdf')</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input name="cv_pdf" type="file" class="custom-file-input" id="exampleInputFile"
                                                   accept="application/msword, application/vnd.ms-excel
                                                   , application/vnd.ms-powerpoint,text/plain,
                                                    application/pdf,">
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="summernote">@lang('dashboard.cv_description')</label>
                                    <textarea id="summernote" name="cv_description">{{ old('cv_description')}}</textarea>
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
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function () {
            $('#summernote').summernote();
            bsCustomFileInput.init();
            $('.select2').select2({
                language: {
                    searching: function() {}
                },
            });
        });
    </script>
@endsection
