@php use Illuminate\Support\Facades\Gate; @endphp
@extends('dashboard.core.app')
@section('title', __('titles.t-Details', ['t' => __('titles.Course')]))

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.Course')</h1>
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
                            <h3 class="card-title">{{__('titles.t-Details', ['t' => __('titles.Course')])}}</h3>

                        </div>


                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12 col-md-12 order-2 order-md-1">
                                                <div class="row">
                                                    <div class="col-12 col-sm-4">
                                                        <div class="info-box bg-dark">
                                                            <div class="info-box-content">
                                                                <span class="info-box-text text-center">@lang('dashboard.course_name')</span>
                                                                <span class="info-box-number text-center mb-0">{{$course->t('name')}}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-4">
                                                        <div class="info-box bg-dark">
                                                            <div class="info-box-content">
                                                                <span class="info-box-text text-center">@lang('dashboard.price')</span>
                                                                <span class="info-box-number text-center mb-0">{{$course->price}} $</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-sm-4">
                                                        <div class="info-box bg-dark">
                                                            <div class="info-box-content">
                                                                <span class="info-box-text text-center">@lang('dashboard.app_price')</span>
                                                                <span class="info-box-number text-center mb-0">{{$course->app_price}} $</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-4">
                                                        <div class="info-box bg-dark">
                                                            <div class="info-box-content">
                                                                <span class="info-box-text text-center">@lang('dashboard.category')</span>
                                                                <span class="info-box-number text-center mb-0">{{$course->category->t('name')}}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-4">
                                                        <div class="info-box bg-dark">
                                                            <div class="info-box-content">
                                                                <span class="info-box-text text-center">@lang('dashboard.duration')</span>
                                                                <span class="info-box-number text-center mb-0">{{$course->duration}}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-4">
                                                        <div class="info-box bg-dark">
                                                            <div class="info-box-content">
                                                                <span class="info-box-text text-center">@lang('dashboard.start_date')</span>
                                                                <span class="info-box-number text-center mb-0">{{$course->start_date ?? __('dashboard.none')}}</span>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-4">
                                                        <div class="info-box bg-dark">
                                                            <div class="info-box-content">
                                                                <span class="info-box-text text-center">@lang('dashboard.end_date')</span>
                                                                <span class="info-box-number text-center mb-0">{{$course->end_date ?? __('dashboard.none')}}</span>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-4">
                                                        <div class="info-box bg-dark">
                                                            <div class="info-box-content">
                                                                <span class="info-box-text text-center">@lang('dashboard.whatsapp_link')</span>
                                                                <span class="info-box-number text-center mb-0">{{$course->whatsapp_link ?? __('dashboard.none')}}</span>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-4">
                                                        <div class="info-box bg-dark">
                                                            <div class="info-box-content">
                                                                <span class="info-box-text text-center">@lang('dashboard.telegram_link')</span>
                                                                <span class="info-box-number text-center mb-0">{{$course->telegram_link ?? __('dashboard.none')}}</span>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6">
                                                        <div class="info-box bg-dark">
                                                            <div class="info-box-content">
                                                                <span class="info-box-text text-center">@lang('dashboard.telegram_channel_link')</span>
                                                                <span class="info-box-number text-center mb-0">{{$course->telegram_channel_link ?? __('dashboard.none')}}</span>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6">
                                                        <div class="info-box bg-dark">
                                                            <div class="info-box-content">
                                                                <span class="info-box-text text-center">@lang('dashboard.Description')</span>
                                                                <p class="info-box-number text-center mb-0">{{strip_tags($course->t('description'))}}</p>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6">
                                                        <div class="info-box bg-dark">
                                                            <div class="info-box-content">
                                                                <span class="info-box-text text-center">@lang('dashboard.goals')</span>
                                                                @if($course->goals)
                                                                    @foreach(json_decode($course->goals) as $goal)
                                                                        <p class="info-box-number text-center mb-0">{{$goal->{"goal_" . app()->getLocale()} }}</p><br>
                                                                    @endforeach
                                                                @else
                                                                    @lang('dashboard.none')
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>


{{--                                                    <div class="col-12 col-sm-6">--}}
{{--                                                        <div class="info-box bg-dark">--}}
{{--                                                            <div class="info-box-content">--}}
{{--                                                                <span class="info-box-text text-center">@lang('dashboard.teachers')</span>--}}
{{--                                                                    @foreach($course->teachers as $teacher)--}}
{{--                                                                        <p class="info-box-number text-center mb-0">{{$teacher->name}} -  {{$teacher->roles[0]->t('display_name')}} </p><br>--}}
{{--                                                                    @endforeach--}}

{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}


                                                    <div class="col-12 col-sm-6">
                                                        <div class="info-box bg-dark">
                                                            <div class="info-box-content">
                                                                <span class="info-box-text text-center">@lang('dashboard.dayNumbers')</span>
                                                                    <p class="info-box-number text-center mb-0">{{ $course->dayNumbers }} </p><br>
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                <!-- /.card -->
                </div>

                <!-- Standards -->
                @if(auth()->user()->hasPermission('standards-read'))
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">@lang('dashboard.Standards')</h3>
                            <div class="card-tools">
                                @if(auth()->user()->hasPermission('standards-create'))
                                    <a href="{{route('standards.create', ['course_id' => $course->id])}}" class="btn  btn-dark">@lang('dashboard.Create')</a>
                                @endif
                            </div>
                        </div>
                        <div class="card-body">


                            @foreach($course->standards as $key => $standard)
                                <div class="card card-dark collapsed-card">
                                    <div class="card-header">
                                        <h3 class="card-title">{{ $standard->t('name') }}</h3>
                                        <div class="card-tools">
                                                @if(auth()->user()->hasPermission('standards-update'))
                                                    <a href="{{ route('standards.edit', $standard['id']) }}" class="btn  btn-dark">@lang('dashboard.Edit')</a>
                                                @endif
                                                @if(auth()->user()->hasPermission('standards-read'))
                                                    <a href="{{ route('standards.show', $standard['id']) }}" class="btn  btn-dark">@lang('dashboard.Show')</a>
                                                @endif
                                                @if(Gate::allows('delete-standard', $standard) && auth()->user()->hasPermission('standards-delete'))
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
                                                                    <form action="{{route('standards.destroy' , $standard['id'])}}" method="post">
                                                                        @csrf
                                                                        {{method_field('DELETE')}}
                                                                        <button type="submit" class="btn btn-danger">@lang('dashboard.Delete')</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                    <button type="button" class="btn btn-dark" data-card-widget="collapse">@lang('dashboard.lectures')</button>

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
                                </div>
                            @endforeach

                            {{--                            <div class="card card-primary collapsed-card">--}}
{{--                                <div class="card-header">--}}
{{--                                    <h3 class="card-title">Expandable</h3>--}}
{{--                                    <div class="card-tools">--}}
{{--                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>--}}
{{--                                        </button>--}}
{{--                                    </div>--}}

{{--                                </div>--}}

{{--                                <div class="card-body">--}}
{{--                                    The body of the card--}}
{{--                                </div>--}}
{{--                            </div>--}}




{{--                            <table class="table table-bordered">--}}
{{--                                <thead>--}}
{{--                                <tr>--}}
{{--                                    <th style="width: 10px">#</th>--}}
{{--                                    <th>@lang('dashboard.Name Ar')</th>--}}
{{--                                    <th>@lang('dashboard.Name En')</th>--}}
{{--                                    <th>@lang('dashboard.Operations')</th>--}}
{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                                <tbody>--}}
{{--                                @forelse($course->standards as $key => $standard)--}}
{{--                                    <tr>--}}
{{--                                        <td>{{ $loop->iteration }}</td>--}}
{{--                                        <td>{{$standard->name_ar}}</td>--}}
{{--                                        <td>{{$standard->name_en}}</td>--}}
{{--                                        <td>--}}
{{--                                            <div class="operations-btns" style="">--}}
{{--                                                @if(auth()->user()->hasPermission('standards-update'))--}}
{{--                                                    <a href="{{ route('standards.edit', $standard['id']) }}" class="btn  btn-dark">@lang('dashboard.Edit')</a>--}}
{{--                                                @endif--}}
{{--                                                @if(auth()->user()->hasPermission('standards-read'))--}}
{{--                                                    <a href="{{ route('standards.show', $standard['id']) }}" class="btn  btn-dark">@lang('dashboard.Show')</a>--}}
{{--                                                @endif--}}
{{--                                                @if(Gate::allows('delete-standard', $standard) && auth()->user()->hasPermission('standards-delete'))--}}
{{--                                                    <button class="btn btn-dark waves-effect waves-light" data-toggle="modal" data-target="#delete-modal{{$key}}">@lang('dashboard.Delete')</button>--}}
{{--                                                    <div id="delete-modal{{$key}}" class="modal fade modal2 " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">--}}
{{--                                                        <div class="modal-dialog">--}}
{{--                                                            <div class="modal-content float-left">--}}
{{--                                                                <div class="modal-header">--}}
{{--                                                                    <h5 class="modal-title">@lang('dashboard.confirm_delete')</h5>--}}
{{--                                                                </div>--}}
{{--                                                                <div class="modal-body">--}}
{{--                                                                    <p>@lang('dashboard.sure_delete')</p>--}}
{{--                                                                </div>--}}
{{--                                                                <div class="modal-footer">--}}
{{--                                                                    <button type="button" data-dismiss="modal" class="btn btn-dark waves-effect waves-light m-l-5 mr-1 ml-1">--}}
{{--                                                                        @lang('dashboard.close')--}}
{{--                                                                    </button>--}}
{{--                                                                    <form action="{{route('standards.destroy' , $standard['id'])}}" method="post">--}}
{{--                                                                        @csrf--}}
{{--                                                                        {{method_field('DELETE')}}--}}
{{--                                                                        <button type="submit" class="btn btn-danger">@lang('dashboard.Delete')</button>--}}
{{--                                                                    </form>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                @endif--}}
{{--                                            </div>--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                @empty--}}
{{--                                    @include('dashboard.core.includes.no-entries', ['columns' => 4])--}}
{{--                                @endforelse--}}
{{--                                </tbody>--}}
{{--                            </table>--}}

                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                @endif
                <!-- Standards -->
        <div class="row">
            <!-- Books -->
            @if(auth()->user()->hasPermission('books-read'))
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">@lang('dashboard.training_bags')</h3>
                            <div class="card-tools">
                                @if(auth()->user()->hasPermission('books-create'))
                                    <a href="{{route('bags.create' , ['course_id' => $course['id']])}}" class="btn  btn-dark">@lang('dashboard.Create')</a>
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>@lang('dashboard.Name')</th>
                                    <th>@lang('dashboard.bag_books')</th>
                                    <th>@lang('dashboard.price')</th>
                                    <th>@lang('dashboard.Operations')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($course->books as $key => $book)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $book->t('name') }}</td>
                                        <td>
                                            @forelse($book->parts as $i => $part)
                                                <a download href="{{$part->pdf_file}}">
                                                    <button class="btn btn-success">
                                                        <span>{{$part->t('name')}}</span>
                                                        <i class="fa fa-file-download"></i>
                                                    </button>
                                                </a>

                                                <a href="{{route('parts.edit' , $part['id'])}}">
                                                    <button class="btn btn-dark">
                                                        <i class="fa fa-pen"></i>
                                                    </button>
                                                </a>

                                                <button class="btn btn-danger waves-effect waves-light" data-toggle="modal" data-target="#delete-modal{{$i}}"><i class="fa fa-trash"></i></button>
                                                <div id="delete-modal{{$i}}" class="modal fade modal2 " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">                                                    <div class="modal-dialog">
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
                                                                <form action="{{route('parts.destroy' , $part['id'])}}" method="post">
                                                                    @csrf
                                                                    {{method_field('DELETE')}}
                                                                    <button type="submit" class="btn btn-danger">@lang('dashboard.Delete')</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            @empty
                                                <span>@lang('dashboard.none')</span>
                                            @endforelse
                                            <div class="mt-3">
                                                <a href="{{route('parts.create' , $book['id'])}}">
                                                    <button class="btn btn-success"><i class="fa fa-plus"></i></button>
                                                </a>
                                            </div>

                                        </td>
                                        <td>{{$book->price}} @lang('dashboard.riyal')</td>
                                        <td>
                                            <div class="operations-btns" style="">
                                                @if(auth()->user()->hasPermission('books-update'))
                                                    <a href="{{ route('bags.edit', $book->id) }}" class="btn btn-dark">@lang('dashboard.Edit')</a>
                                                @endif
                                                @if(Gate::allows('delete-book', $book) && auth()->user()->hasPermission('books-delete'))
                                                    <button class="btn btn-dark waves-effect waves-light" data-toggle="modal" data-target="#delete-modal{{$key}}">@lang('dashboard.Delete')</button>
                                                    <div id="delete-modal{{$key}}" class="modal fade modal2 " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">                                                    <div class="modal-dialog">
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
                                                                    <form action="{{route('books.destroy' ,$book->id)}}" method="post">
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
                    </div>
                </div>
            @endif
        <!-- Books -->

            <!-- Attachments -->
            @if(auth()->user()->hasPermission('attachments-read'))
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">@lang('dashboard.attachments')</h3>
                            <div class="card-tools">
                                @if(auth()->user()->hasPermission('attachments-create'))
                                    <a href="{{route('attachments.create' , $course['id'])}}" class="btn  btn-dark">@lang('dashboard.Create')</a>
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>@lang('dashboard.Name')</th>
                                    <th>@lang('dashboard.file')</th>
                                    <th>@lang('dashboard.Activation')</th>
                                    <th>@lang('dashboard.Operations')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($course->attachments as $key => $attachment)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{$attachment->t('name')}}</td>
                                        <td>@if($attachment->file !== null) <a download href="{{url($attachment->file)}}">@lang('dashboard.download_file')</a> @endif</td>
                                        <td>{{$attachment->is_active ? __('dashboard.active') : __('dashboard.in_active')}}</td>

                                        <td>
                                            <div class="operations-btns" style="">
                                                @if(auth()->user()->hasPermission('attachments-update'))
                                                    <a href="{{ route('attachments.edit', [$attachment->course_id, $attachment['id']]) }}" class="btn  btn-dark">@lang('dashboard.Edit')</a>
                                                @endif
                                                @if(auth()->user()->hasPermission('attachments-delete'))
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
                                                                    <form action="{{route('attachments.destroy' , [$attachment->course_id, $attachment['id']])}}" method="post">
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
                    </div>
                </div>
            @endif

        <!-- Attachments -->

            <!-- Books -->
            @if(auth()->user()->hasPermission('solutions-read'))
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">@lang('dashboard.book_solutions')</h3>
                            <div class="card-tools">
                                @if(auth()->user()->hasPermission('solutions-create'))
                                    <a href="{{route('solutions.create' , $course['id'])}}" class="btn  btn-dark">@lang('dashboard.Create')</a>
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>@lang('dashboard.Name')</th>
                                    <th>@lang('dashboard.solution_video')</th>
                                    <th>@lang('dashboard.Operations')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($course->solutions as $key => $solution)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $solution->t('name') }}</td>
                                        <td><a target="_blank" href="{{$solution->solution_video_link}}">@lang('dashboard.solution_video_link')</a></td>
                                        <td>
                                            <div class="operations-btns" style="">
                                                @if(auth()->user()->hasPermission('solutions-update'))
                                                    <a href="{{ route('solutions.edit', [$solution->course_id, $solution['id']])}}" class="btn  btn-dark">@lang('dashboard.Edit')</a>
                                                @endif
                                                @if(auth()->user()->hasPermission('solutions-delete'))
                                                    <button class="btn btn-dark waves-effect waves-light" data-toggle="modal" data-target="#delete-modal{{$solution->id}}">@lang('dashboard.Delete')</button>
                                                    <div id="delete-modal{{$solution->id}}" class="modal fade modal2 " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">                                                    <div class="modal-dialog">
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
                                                                    <form action="{{route('solutions.destroy' , [$solution->course_id, $solution['id']])}}" method="post">
                                                                        @csrf
                                                                        @method('delete')
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
                    </div>
                </div>
        @endif
        <!-- Books -->




            <!-- Course Bank Questions  -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">بنك الاسئله</h3>
                            <div class="card-tools">
                                    <a href="{{route('course_bank_questions.create', $course->id)}}" class="btn  btn-dark">@lang('dashboard.Create')</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>السؤال</th>
                                    <th>@lang('dashboard.Operations')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($course_bank_questions as $key => $course_bank_question)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{\Illuminate\Support\Str::limit(strip_tags($course_bank_question->content) , 100)}}</td>
                                        <td>
                                            <div class="operations-btns" style="">

                                                    <a href="{{route('course_bank_questions.edit',[$course['id'] ,$course_bank_question['id'] ] )}}" class="btn  btn-dark">@lang('dashboard.Edit')</a>

                                                    <button class="btn btn-dark waves-effect waves-light" data-toggle="modal" data-target="#delete-modal{{$course_bank_question->id}}">@lang('dashboard.Delete')</button>
                                                    <div id="delete-modal{{$course_bank_question->id}}" class="modal fade modal2 " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">                                                    <div class="modal-dialog">
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
                                                                    <form action="{{route('course_bank_questions.destroy',[$course['id'],$course_bank_question['id'] ] )}}" method="post">
                                                                        @csrf
                                                                        @method('delete')
                                                                        <button type="submit" class="btn btn-danger">@lang('dashboard.Delete')</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

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
                    </div>
                </div>
            <!-- Course Bank Questions -->




        </div>



                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->



    </section>
    <!-- /.content -->
@endsection
