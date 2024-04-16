@extends('dashboard.core.app')
@section('title', __('titles.Edit') . " " . __('titles.Attachments'))

@section('css_addons')
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.attachments')</h1>
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
                        <form action="{{route('attachments.update' , [$attachment->course_id, $attachment['id']])}}" method="post" autocomplete="off" enctype="multipart/form-data">
                            <div class="card-header">
                                <h3 class="card-title">{{__('titles.Edit') . " " . __('titles.Attachment')}}</h3>
                            </div>
                            <div class="card-body">
                                @csrf
                                @method('PUT')
                                <div class="row" id="content">
                                    <div class="form-group col-6">
                                        <label class="ml-3 mr-3" for="exampleInputName1">@lang('dashboard.Name') @lang('dashboard.ar')</label>
                                        <input name="attachments[0][name_ar]"  value="{{$attachment->name_ar}}" type="text" class="form-control" id="exampleInputName1" placeholder="">
                                    </div>
                                    <div class="form-group col-6">
                                        <label class="ml-3 mr-3" for="exampleInputName1">@lang('dashboard.Name') @lang('dashboard.en')</label>
                                        <input name="attachments[0][name_en]" value="{{$attachment->name_en}}" type="text" class="form-control" id="exampleInputName1" placeholder="">
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="exampleInputName1">@lang('dashboard.file')</label>
                                        <div class="mt-2 mb-3">
                                            @if($attachment->file !== null)
                                                <a download href="{{url($attachment->file)}}">@lang('dashboard.download_file')</a>
                                            @endif
                                        </div>
                                        <input name="attachments[0][file]" type="file" class="form-control" id="exampleInputName1" placeholder="">
                                    </div>

                                    <div class="form-group clearfix col-6">
                                        <input name="attachments[0][is_active]" type="hidden" value="off">
                                        <div class="icheck-wetasphalt d-inline">
                                            <input name="attachments[0][is_active]" type="checkbox" id="checkboxPrimary3" @checked($attachment->is_active == 1)>
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

@section('js_addons')
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

@endsection
