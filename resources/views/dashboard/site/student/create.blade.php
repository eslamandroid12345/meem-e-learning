@extends('dashboard.core.app')
@section('title', __('titles.Create Student'))

@section('css_addons')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.Students')</h1>
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
                        <form action="{{ route('student.store') }}" method="post" autocomplete="off" enctype="multipart/form-data">
                            <div class="card-header">
                                <h3 class="card-title">@lang('titles.Create Student')</h3>
                            </div>
                            <div class="card-body">
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
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputName1">@lang('dashboard.Name')</label>
                                            <input name="name" type="text" class="form-control" id="exampleInputName1" value="{{ old('name') }}" placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">@lang('dashboard.Email')</label>
                                            <input name="email" type="email" class="form-control" id="exampleInputEmail1" value="{{ old('email') }}" placeholder="" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">@lang('dashboard.Password')</label>
                                            <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputPassword2">@lang('dashboard.Confirm Password')</label>
                                            <input name="password_confirmation" type="password" class="form-control" id="exampleInputPassword2" placeholder="" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="exampleInputPhone1">@lang('dashboard.Phone')</label>
                                            <input name="phone" type="number" class="form-control" id="exampleInputPhone1" value="{{ old('phone') }}" placeholder="" required>
                                        </div>
                                    </div>
{{--                                    <div class="col-4">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label for="exampleInputName1">@lang('dashboard.Gender')</label>--}}
{{--                                            <select name="gender" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">--}}
{{--                                                <option @selected(old('gender') == 'MALE') value="MALE">@lang('dashboard.Male')</option>--}}
{{--                                                <option @selected(old('gender') == 'FEMALE') value="FEMALE">@lang('dashboard.Female')</option>--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>@lang('dashboard.Birthdate')</label>
                                            <input name="birth_date" value="{{ old('birth_date') }}" type="date" class="form-control datetimepicker-input" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputAddress1">@lang('dashboard.Address 1')</label>
                                            <textarea name="address[]" class="form-control" id="exampleInputAddress1" rows="3">{{ old('address.0') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputAddress1">@lang('dashboard.Address 2')</label>
                                            <textarea name="address[]" class="form-control" id="exampleInputAddress1" rows="3">{{ old('address.1') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input name="is_active" type="checkbox" id="checkboxPrimary1" {{ old('is_active') == 'on' ? 'checked' : '' }}>
                                        <label for="checkboxPrimary1">@lang('dashboard.Activate')</label>
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
                    searching: function() {}
                },
            });
        });
    </script>
@endsection
