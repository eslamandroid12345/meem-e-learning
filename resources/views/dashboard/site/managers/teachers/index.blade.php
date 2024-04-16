@extends('dashboard.core.app')
@section('title', __('titles.Teachers'))
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.teachers')</h1>
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
                            <h3 class="card-title">@lang('dashboard.teachers')</h3>
                            <div class="card-tools">
                                @if(auth()->user()->hasPermission('teachers-create'))
                                    <a href="{{route('teachers.create')}}" class="btn  btn-dark">@lang('dashboard.Create')</a>
                                @endif
                                <a  href="{{ route('teachers.export', ['excel', ...request()->query()]) }}" class="btn  btn-success">@lang('dashboard.Excel Export')</a>
                                <a  href="{{ route('teachers.export', ['pdf', ...request()->query()]) }}" class="btn  btn-danger">@lang('dashboard.PDF Export')</a>
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
                                    <th>@lang('dashboard.current_courses')</th>
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
                                            @forelse($manager->courses as $course)
                                                <a target="_blank" href="{{route('courses.show' , $course['id'])}}">{{$course->t('name')}}</a> |
                                            @empty
                                                @lang('dashboard.none')
                                            @endforelse
                                        </td>
                                        <td>
                                            <div class="operations-btns" style="">
                                                <a href="{{ route('teachers.show', $manager->id) }}" class="btn  btn-dark">@lang('dashboard.Show')</a>
                                                @if(auth()->user()->hasPermission('teachers-update'))
                                                    <a href="{{ route('teachers.edit', $manager->id) }}" class="btn  btn-dark">@lang('dashboard.Edit')</a>
                                                @endif
                                                @if(auth()->user()->hasPermission('teachers-delete'))
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
                                                                    <form action="{{route('teachers.destroy' , $manager['id'])}}" method="post">
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
