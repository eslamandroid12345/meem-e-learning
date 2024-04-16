@extends('dashboard.core.app')
@section('title', __('titles.Create') . " " . __('dashboard.bag_books'))

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
                    <h1>@lang('dashboard.bag_books')</h1>
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
                        <form action="{{route('parts.store')}}" method="POST" autocomplete="off" enctype="multipart/form-data">
                            <div class="card-header">
                                <h3 class="card-title">{{__('titles.Create') . " " . __('dashboard.bag_books')}}</h3>
                            </div>
                            <div class="card-body">
                                @csrf
                                <input name="book_id" type="hidden" value="{{$book_id}}">
                                <div class="row" id="content">
                                    <div class="form-group col-6">
                                        <label class="ml-3 mr-3" for="exampleInputName1">@lang('dashboard.Name') @lang('dashboard.ar')</label>
                                        <input value="{{old('name_ar')}}"  name="name_ar" type="text" class="form-control" id="exampleInputName1" placeholder="">
                                    </div>

                                    <div class="form-group col-6">
                                        <label class="ml-3 mr-3" for="exampleInputName1">@lang('dashboard.Name') @lang('dashboard.en')</label>
                                        <input value="{{old('name_en')}}"  name="name_en" type="text" class="form-control" id="exampleInputName1" placeholder="">
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="exampleInputName1">@lang('dashboard.book_pdf')</label>
                                        <input  name="pdf_file" accept="application/pdf" type="file" class="form-control" id="exampleInputName1" placeholder="" required>
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
