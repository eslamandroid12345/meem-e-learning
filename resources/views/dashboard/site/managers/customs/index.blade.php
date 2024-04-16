@extends('dashboard.core.app')
@section('title', $currentRole->t('display_name'))
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
                        <div class="card-header">
                            <h3 class="card-title">{{ $currentRole->t('display_name') }}</h3>
                            <div class="card-tools">
                                @if(auth()->user()->hasPermission('customs-create'))
                                    <a href="{{route('customs.create', $currentRole->name)}}" class="btn  btn-dark">@lang('dashboard.Create')</a>
                                @endif
                                <a  href="{{ route('customs.export', [$currentRole->name, 'excel', ...request()->query()]) }}" class="btn  btn-success">@lang('dashboard.Excel Export')</a>
                                <a  href="{{ route('customs.export', [$currentRole->name, 'pdf', ...request()->query()]) }}" class="btn  btn-danger">@lang('dashboard.PDF Export')</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th style="width: 50px;">@lang('dashboard.Image')</th>
                                    <th>@lang('dashboard.Name')</th>
                                    <th>@lang('dashboard.Email')</th>
                                    <th>@lang('dashboard.Operations')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($managers as $manager)
                                    <tr>
                                        <td>{{ $manager->id }}</td>
                                        <td><img src="{{ $manager->image ?? '' }}" style="width: 50px;" /></td>
                                        <td>{{ $manager->name }}</td>
                                        <td>{{ $manager->email }}</td>
                                        <td>
                                            <div class="operations-btns" style="">
                                                <a href="{{ route('customs.show', [$currentRole->name, $manager->id]) }}" class="btn  btn-dark">@lang('dashboard.Show')</a>
                                                @if(auth()->user()->hasPermission('customs-update'))
                                                    <a href="{{ route('customs.edit', [$currentRole->name, $manager->id]) }}" class="btn  btn-dark">@lang('dashboard.Edit')</a>
                                                @endif
                                                @if(auth()->user()->hasPermission('customs-delete'))
                                                    <button class="btn btn-dark waves-effect waves-light" data-toggle="modal" data-target="#delete-modal{{$loop->iteration}}">@lang('dashboard.Delete')</button>
                                                    <div id="delete-modal{{$loop->iteration}}" class="modal fade modal2 " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
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
                                                                    <form action="{{route('customs.destroy' , [$currentRole->name, $manager->id])}}" method="post">
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
                            {{ $managers->links() }}
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
