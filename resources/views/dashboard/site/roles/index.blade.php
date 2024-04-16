@extends('dashboard.core.app')
@section('title', __('titles.Roles'))
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.roles_and_permissions')</h1>
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
                            <h3 class="card-title">@lang('dashboard.roles_and_permissions')</h3>
                            <div class="card-tools">
                                <a href="{{route('roles.create')}}" class="btn  btn-dark">@lang('dashboard.Create')</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>@lang('dashboard.Name')</th>
                                    <th>@lang('dashboard.Managers_Count')</th>
                                    <th>@lang('dashboard.Operations')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($roles as $key => $role)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{$role->t('display_name')}}</td>
                                        <td>{{ $role->managersCount()}}</td>
                                        <td>
                                            @if($role->is_deletable == 1)
                                            <div class="operations-btns" style="">
                                                <a href="{{ route('roles.edit', $role['id']) }}" class="btn  btn-dark">@lang('dashboard.Edit')</a>

                                                @if($role->managersCount() == 0)
                                                        <button class="btn btn-dark waves-effect waves-light" data-toggle="modal" data-target="#delete-modal{{$key}}">@lang('dashboard.Delete')</button>
                                                        <div id="delete-modal{{$key}}" class="modal fade modal2 " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">                                                    <div class="modal-dialog">
                                                                <div class="modal-content float-left">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">تأكيد الحذف</h5>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>@lang('dashboard.sure_delete')</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" data-dismiss="modal" class="btn btn-dark waves-effect waves-light m-l-5 mr-1 ml-1">
                                                                            @lang('dashboard.close')
                                                                        </button>
                                                                        <form action="{{route('roles.destroy' , $role['id'])}}" method="post">
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
                                            @else
                                            <button disabled class="btn btn-dark">@lang('dashboard.not_editable')</button>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    @include('dashboard.core.includes.no-entries', ['columns' => 6])
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
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
