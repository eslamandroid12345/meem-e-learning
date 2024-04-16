@extends('dashboard.core.app')
@section('title', __('titles.Edit') . " " . __('titles.Standards'))


@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.Standards')</h1>
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
                        <form action="{{ route('standards.update' , $standard['id']) }}" method="post" autocomplete="off" enctype="multipart/form-data">
                            <div class="card-header">
                                <h3 class="card-title">@lang('titles.Edit') @lang('titles.Standard')</h3>
                            </div>
                            <div class="card-body">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="exampleInputName1">@lang('dashboard.Name Ar')</label>
                                        <input name="name_ar" type="text" class="form-control" id="exampleInputName1" value="{{ old('name_ar') ?? $standard->name_ar }}" placeholder="">
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="exampleInputName1">@lang('dashboard.Name En')</label>
                                        <input name="name_en" type="text" class="form-control" id="exampleInputName1" value="{{ old('name_en') ?? $standard->name_en }}" placeholder="">
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="active">@lang('dashboard.Course')</label>
                                        <select id="course" name="course_id" class="form-control">
                                            @foreach($courses as $course)
                                                <option @selected(old('course_id') !== null ? old('course_id') == $course->id : $standard->course_id == $course->id) value="{{$course->id}}">{{$course->t('name')}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="exampleInputName1">@lang('dashboard.sort')</label>
                                        <input name="sort" type="number" min="1" step="1" class="form-control" id="exampleInputName1" placeholder="" value="{{$standard->sort}}">
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


