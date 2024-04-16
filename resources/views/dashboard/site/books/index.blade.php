@php use Illuminate\Support\Facades\Gate; @endphp
@extends('dashboard.core.app')
@section('title', __('titles.Books'))
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.books')</h1>
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
                            <h3 class="card-title">@lang('dashboard.books')</h3>
                            <div class="card-tools">
                                @if(auth()->user()->hasPermission('books-create'))
                                    <a href="{{route('books.create')}}" class="btn  btn-dark">@lang('dashboard.Create')</a>
                                @endif
                                    <a  href="{{ route('books.export', ['excel', ...request()->query()]) }}" class="btn  btn-success">@lang('dashboard.Excel Export')</a>
                                    <a  href="{{ route('books.export', ['pdf', ...request()->query()]) }}" class="btn  btn-danger">@lang('dashboard.PDF Export')</a>
                            </div>
                        </div>
                        <div class="card-body">
{{--                            <form action="{{route('books.index')}}">--}}
{{--                                <div class="row">--}}

{{--                                    <div class="form-group col-4">--}}
{{--                                        <select name="store" class="form-control">--}}
{{--                                            <option @selected(request('store') == "ALL") value="ALL">@lang('dashboard.all_items')</option>--}}
{{--                                            <option @selected(request('store') == "1") value="1">@lang('dashboard.exists_in_store')</option>--}}
{{--                                            <option @selected(request('store') == "0") value="0">@lang('dashboard.not_in_store')</option>--}}

{{--                                        </select>--}}
{{--                                    </div>--}}


{{--                                    <div class="form-group col-4">--}}
{{--                                        <select name="course" class="form-control">--}}
{{--                                            <option value="ALL">@lang('dashboard.all_items')</option>--}}
{{--                                            @foreach($fields as $field)--}}
{{--                                                <optgroup label="{{$field->t('name')}}">--}}
{{--                                                    @foreach($field->categories as $category)--}}
{{--                                                        @foreach($category->courses as $course)--}}
{{--                                                            <option @selected(request('course') == $course->id) value="{{$course->id}}">{{$course->t('name')}}</option>--}}
{{--                                                        @endforeach--}}
{{--                                                    @endforeach--}}
{{--                                                </optgroup>--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}
{{--                                    </div>--}}

{{--                                    <div class="form-group col-4">--}}
{{--                                        <button type="submit" class="btn btn-dark">@lang('dashboard.filter')</button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </form>--}}

                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>@lang('dashboard.Name')</th>
                                    <th>@lang('dashboard.price')</th>
                                    <th>@lang('dashboard.file')</th>
{{--                                    <th>@lang('dashboard.show_in_store')</th>--}}
                                    <th>@lang('dashboard.Operations')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($books as $key => $book)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $book->t('name') }}</td>
                                        <td>{{ $book->price }} @lang('dashboard.riyal')</td>
                                        <td><a download href="{{$book->book_pdf}}">
                                                <button class="btn btn-success">
                                                    <i class="fa fa-file-download"></i>
                                                </button></a>
                                        </td>
                                        <td>
                                            @if(auth()->user()->hasPermission('books-update'))
                                                <a href="{{ route('books.edit', $book['id']) }}" class="btn  btn-dark">@lang('dashboard.Edit')</a>
                                            @endif
                                            @if(Gate::allows('delete-book', $book) && auth()->user()->hasPermission('books-delete'))
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
                                                                <form action="{{route('books.destroy' , $book['id'])}}" method="post">
                                                                    @csrf
                                                                    {{method_field('DELETE')}}
                                                                    <button type="submit" class="btn btn-danger">@lang('dashboard.Delete')</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
                        <div class="card-footer">
                            {{ $books->appends(request()->all())->links() }}
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
