@extends('dashboard.core.app')
@section('title', __('titles.Contact Details'))

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.contacts')</h1>
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
                            <h3 class="card-title">@lang('titles.Contact Details')</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-dark">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center">@lang('dashboard.Name')</span>
                                            <span class="info-box-number text-center mb-0">{{$contact->name}}</span>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-dark">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center">@lang('dashboard.created_at')</span>
                                            <span class="info-box-number text-center mb-0">{{$contact->created_at->diffForHumans()}}</span>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-dark">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center">@lang('dashboard.Phone')</span>
                                            <span class="info-box-number text-center mb-0">{{$contact->phone_number}}</span>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-dark">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center">@lang('dashboard.Email')</span>
                                            <span class="info-box-number text-center mb-0"><a href="mailto:{{$contact->email}}">{{$contact->email}}</a></span>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-dark">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center">@lang('dashboard.message')</span>
                                            <span class="info-box-number text-center mb-0">{{$contact->message}}</span>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-dark">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center">@lang('dashboard.is_readed')</span>
                                            <span class="info-box-number text-center mb-0">{{$contact->is_readed}}</span>

                                        </div>
                                    </div>
                                </div>


                            </div>



                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            @if(app()->getLocale() == 'ar')
            @if($contact->is_readed !== 'تم الرد')
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">@lang('dashboard.thereply')</h3>
                        </div >
                            <div class="card-tools">
                                <div class="card-body">
                                    <form action="{{ route('contacts.update',$contact->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="exampleInputName1"> @lang('dashboard.thereply')</label>
                                                <textarea name="content" class="form-control" id="exampleInputName1" required></textarea>
                                        </div>
                                    </div>
                                        <button type="submit" class="btn btn-dark">@lang('dashboard.Send')</button>
                                </form>
                                </div>
                            </div>

                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            @endif
            @else
            @if($contact->is_readed !== 'Reply')
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">@lang('dashboard.thereply')</h3>
                        </div >
                            <div class="card-tools">
                                <div class="card-body">
                                    <form action="{{ route('contacts.update',$contact->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="exampleInputName1"> @lang('dashboard.thereply')</label>
                                                <textarea name="content" class="form-control" id="exampleInputName1" required></textarea>
                                        </div>
                                    </div>
                                        <button type="submit" class="btn btn-dark">@lang('dashboard.Send')</button>
                                </form>
                                </div>
                            </div>

                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            @endif
            @endif

        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
