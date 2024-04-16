@extends('dashboard.core.app')
@section('title', __('titles.Create') . " " . __('titles.Banks'))

@section('css_addons')
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@endsection


@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.banks')</h1>
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
                        <form action="{{ route('banks.update' , $bank['id']) }}" method="post" autocomplete="off" enctype="multipart/form-data">
                            <div class="card-header">
                                <h3 class="card-title">{{__('titles.Edit') . " " . __('titles.Banks')}}</h3>
                            </div>
                            <div class="card-body">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="exampleInputName1">@lang('dashboard.Name') @lang('dashboard.ar')</label>
                                        <input name="name_ar" type="text" class="form-control" id="exampleInputName1" value="{{ old('name_ar') ?? $bank['name_ar'] }}" placeholder="">
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="exampleInputName1">@lang('dashboard.Name') @lang('dashboard.en')</label>
                                        <input name="name_en" type="text" class="form-control" id="exampleInputName1" value="{{ old('name_en') ?? $bank['name_en'] }}" placeholder="">
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="form-group col-6">
                                        <label for="exampleInputName1">@lang('dashboard.account_number')</label>
                                        <input name="account_number" type="text" class="form-control" id="exampleInputName1" value="{{old('account_number') ?? $bank['account_number']}}">
                                    </div>


                                    <div class="form-group col-6">
                                        <label for="exampleInputName1">@lang('dashboard.iban_number')</label>
                                        <input name="iban_number" type="text" class="form-control" id="exampleInputName1" value="{{old('iban_number') ?? $bank['iban_number']}}">
                                    </div>


                                    <div class="form-group col-6">
                                        <label for="exampleInputName1">@lang('dashboard.account_name_ar')</label>
                                        <input name="account_name_ar" type="text" class="form-control" id="exampleInputName1" value="{{old('account_name_ar') ?? $bank['account_name_ar']}}">
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="exampleInputName1">@lang('dashboard.account_name_en')</label>
                                        <input name="account_name_en" type="text" class="form-control" id="exampleInputName1" value="{{old('account_name_en') ?? $bank['account_name_en']}}">
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="exampleInputName1">@lang('dashboard.Image')</label>
                                        <input name="image" type="file" class="form-control" id="exampleInputName1" placeholder="">
                                    </div>
                                    <div class="col-2"><img src="{{ $bank->image }}" width="100px" /></div>



                                </div>





                                <div class="form-group clearfix col-12">
                                    <div class="icheck-wetasphalt d-inline">
                                        <input name="is_active" type="checkbox" id="checkboxPrimary3" {{ old('is_active') == 'on' ? 'checked' : ($bank->is_active ? 'checked' : '') }}>
                                        <label for="checkboxPrimary3">@lang('dashboard.Activate')</label>
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
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
