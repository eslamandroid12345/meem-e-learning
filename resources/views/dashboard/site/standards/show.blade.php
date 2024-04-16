@extends('dashboard.core.app')
@section('title', __('titles.t-Details', ['t' => __('titles.Standard')]))

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
                        <div class="card-header">
                            <h3 class="card-title">{{__('titles.t-Details', ['t' => __('titles.Standard')])}}</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-4">
                                            <h3>@lang('dashboard.Name Ar')</h3>
                                            <h5>{{$standard->name_ar}}</h5>
                                        </div>
                                        <div class="col-4">
                                            <h3>@lang('dashboard.Name En')</h3>
                                            <h5>{{$standard->name_en}}</h5>
                                        </div>
                                        <div class="col-4">
                                            <h3>@lang('dashboard.Course')</h3>
                                            <p>{{ $standard->course->t('name') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">@lang('dashboard.Lectures')</h3>
                            <div class="card-tools">
                                @if(auth()->user()->hasPermission('lectures-create'))
                                    <a href="{{route('lectures.create', ['standard_id' => $standard->id])}}" class="btn  btn-dark">@lang('dashboard.Create')</a>
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>@lang('dashboard.Name')</th>
                                    <th>@lang('dashboard.Operations')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($standard->lectures as $key => $lecture)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{$lecture->t('name')}}</td>
                                        <td>
                                            <div class="operations-btns" style="">
                                                @if(auth()->user()->hasPermission('lectures-update'))
                                                    <a href="{{ route('lectures.edit', $lecture['id']) }}" class="btn  btn-dark">@lang('dashboard.Edit')</a>
                                                @endif
                                                <a href="{{ route('lectures.show', $lecture['id']) }}" class="btn  btn-dark">@lang('dashboard.Show')</a>

                                                @if(Gate::allows('delete-lecture', $lecture) && auth()->user()->hasPermission('lectures-delete'))
                                                    <button class="btn btn-dark waves-effect waves-light" data-toggle="modal" data-target="#delete-modal{{$key}}">@lang('dashboard.Delete')</button>
                                                    <div id="delete-modal{{$key}}" class="modal fade modal2 " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content float-left">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">@lang('dashboard.confirm_delete')</h5>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>@lang('dashboard.sure_delete')</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" data-dismiss="modal" class="btn btn-dark waves-effect waves-light m-l-5 mr-1 ml-1">
                                                                        @lang('dashboard.close')
                                                                    </button>
                                                                    <form action="{{route('lectures.destroy' , $lecture['id'])}}" method="post">
                                                                        @csrf
                                                                        {{method_field('DELETE')}}
                                                                        <button type="submit" class="btn btn-danger">@lang('dashboard.Delete')</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    @include('dashboard.core.includes.no-entries', ['columns' => 3])
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
