@extends('dashboard.core.app')
@section('title', __('titles.Edit') . " " . __('titles.Category'))
@section('css_addons')
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@endsection


@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.categories')</h1>
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
                        <form action="{{ route('categories.update' , $category['id']) }}" method="post" autocomplete="off" enctype="multipart/form-data">
                            <div class="card-header">
                                <h3 class="card-title">@lang('titles.Edit') @lang('titles.Category')</h3>
                            </div>
                            <div class="card-body">
                                @csrf
                                @method('PUT')


                                <div class="form-group">
                                    <label for="exampleInputFile">@lang('dashboard.Image')</label>
                                    <div class="row">
                                        <div class="col-10">
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input name="image" type="file" class="custom-file-input" id="exampleInputFile">
                                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2"><img src="{{ $category->image }}" width="100px" /></div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="form-group col-6">
                                        <label for="exampleInputName1">@lang('dashboard.Name') @lang('dashboard.ar')</label>
                                        <input name="name_ar" type="text" class="form-control" id="exampleInputName1" value="{{ $category['name_ar'] ?? old('name_ar') }}" placeholder="">
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="exampleInputName1">@lang('dashboard.Name') @lang('dashboard.en')</label>
                                        <input name="name_en" type="text" class="form-control" id="exampleInputName1" value="{{ $category['name_en'] ?? old('name_en')}}" placeholder="">
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="field">@lang('dashboard.Field')</label>
                                        <select id="field" name="field_id"  class="form-control">
                                            @foreach($fields as $field)
                                                <option value="{{$field->id}}" @selected($category->field_id == $field->id)>{{$field->t('name')}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="exampleInputName1">@lang('dashboard.sort')</label>
                                        <input name="sort" type="number" class="form-control" id="exampleInputName1" value="{{old('sort') ?? $category['sort']}}">
                                    </div>
                                    <div class="form-group clearfix col-12">
                                        <input name="is_active" type="hidden" value="off">
                                        <div class="icheck-wetasphalt d-inline">
                                            <input name="is_active" type="checkbox" id="checkboxPrimary3" $field {{ old('is_active') == 'on' ? 'checked' : ($category->is_active ? 'checked' : '') }} >
                                            <label for="checkboxPrimary3">@lang('dashboard.Activate')</label>
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


