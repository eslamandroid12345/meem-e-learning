@php use Illuminate\Support\Facades\Gate; @endphp
@extends('dashboard.core.app')
@section('title', __('titles.Fields'))
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.fields')</h1>
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
                            <h3 class="card-title">@lang('dashboard.fields')</h3>
                            <div class="card-tools">
                                @if(auth()->user()->hasPermission('fields-create'))
                                    <a href="{{route('fields.create')}}" class="btn  btn-dark">@lang('dashboard.Create')</a>
                                @endif
                                <a  href="{{ route('fields.export', ['excel', ...request()->query()]) }}" class="btn  btn-success">@lang('dashboard.Excel Export')</a>
                                <a  href="{{ route('fields.export', ['pdf', ...request()->query()]) }}" class="btn  btn-danger">@lang('dashboard.PDF Export')</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>@lang('dashboard.Name')</th>
                                    <th>@lang('dashboard.Image')</th>
                                    <th>@lang('dashboard.categories')</th>
                                    <th>@lang('dashboard.Activation')</th>
                                    <th>@lang('dashboard.Operations')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($fields as $key => $field)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{$field->t('name')}}</td>
                                        <td><img src="{{ !is_null($field->image) ? $field->image : '' }}" style="width: 100px;" /></td>
                                        <td>
                                            @forelse($field->categories as $category)
                                                <a href="{{route('categories.show' , $category->id)}}">{{$category->t('name')}}</a> {{ !$loop->last ? ', ' : '' }}
                                            @empty
                                                @lang('dashboard.none')
                                            @endforelse
                                        </td>
                                        <td>{{$field->is_active ? __('dashboard.active') : __('dashboard.in_active')}}</td>
                                        <td>
                                            <div class="operations-btns" style="">
                                                @if(auth()->user()->hasPermission('fields-update'))
                                                    <a href="{{ route('fields.edit', $field['id']) }}" class="btn  btn-dark">@lang('dashboard.Edit')</a>
                                                @endif
                                                    <a href="{{ route('fields.show', $field['id']) }}" class="btn  btn-dark">@lang('dashboard.Show')</a>

                                                @if(Gate::allows('delete-field', $field) && auth()->user()->hasPermission('fields-delete'))
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
                                                                    <form action="{{route('fields.destroy' , $field['id'])}}" method="post">
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
                                    @include('dashboard.core.includes.no-entries', ['columns' => 6])
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            {{ $fields->links() }}
                        </div>
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
