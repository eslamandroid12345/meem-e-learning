@extends('dashboard.core.app')
@section('title', __('titles.t-Details', ['t' => __('dashboard.print_requests')]))

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.print_requests')</h1>
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
                            <h3 class="card-title">{{__('titles.t-Details', ['t' => __('dashboard.print_requests')])}}</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-12 col-sm-4">
                                            <div class="info-box bg-dark">
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-center">@lang('dashboard.student')</span>
                                                    <span class="info-box-text text-center"><a style="color: #FFF" target="_blank" href="{{route('student.show' , $request->user->id)}}">{{$request->user->name}}</a></span>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-12 col-sm-4">
                                            <div class="info-box bg-dark">
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-center">@lang('dashboard.created_at')</span>
                                                    <span class="info-box-text text-center">{{$request->created_at->diffForHumans()}}</span>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-12 col-sm-4">
                                            <div class="info-box bg-dark">
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-center">@lang('dashboard.type')</span>
                                                    <span class="info-box-text text-center">{{__('dashboard.' . $request->type)}}</span>
                                                </div>
                                            </div>
                                        </div>

                                        @if($request->type == 'BOOK')

                                            <div class="col-12 col-sm-4">
                                                <div class="info-box bg-dark">
                                                    <div class="info-box-content">
                                                        <span class="info-box-text text-center">@lang('dashboard.Book')</span>
                                                        <span class="info-box-text text-center">{{$request->book->t('name')}}</span>
                                                        <span class="info-box-text text-center"><a style="color: #FFF" download href="{{$request->book->book_pdf}}">@lang('dashboard.download_book')</a></span>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="col-12 col-sm-4">
                                                <div class="info-box bg-dark">
                                                    <div class="info-box-content">
                                                        <span class="info-box-text text-center">@lang('dashboard.Certificate of Course')</span>
                                                        <span class="info-box-text text-center"><a style="color: #FFF" target="_blank" href="{{route('courses.show' , $request->course_id)}}">{{$request->course->t('name')}}</a></span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        @if($request->type == "BOOK")
                                        <div class="col-12 col-sm-4">
                                            <div class="info-box bg-dark">
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-center">@lang('dashboard.Quantity')</span>
                                                    <span class="info-box-text text-center">{{ $request->quantity ?? '-' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="info-box bg-dark">
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-center">@lang('dashboard.Used Coupon')</span>
                                                    <span class="info-box-text text-center">{{ $request->payment?->payable()?->withTrashed()?->coupon()?->withTrashed()?->first()->coupon->coupon ?? '-' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        @endif

                                        @if($request->payment?->address)

                                            <div class="col-12 col-sm-12">
                                                <h2 class="text-center mb-4">@lang('dashboard.delivery_data')</h2>
                                                <div class="info-box bg-dark">
                                                    <div class="info-box-content">
                                                        <span class="info-box-number text-center mb-0">@lang('dashboard.Name') : {{$request->payment->name}}</span>
                                                        <span class="info-box-number text-center mb-0">@lang('dashboard.Email') : {{$request->payment?->email}}</span>
                                                        <span class="info-box-number text-center mb-0">@lang('dashboard.Phone') : {{$request->payment?->phone}}</span>
{{--                                                        <span class="info-box-number text-center mb-0">@lang('dashboard.Nationality') : {{$request->payment?->nationality}}</span>--}}
{{--                                                        <span class="info-box-number text-center mb-0">@lang('dashboard.national_id') : {{$request->payment?->national_id}}</span>--}}
                                                        @if($request->payment->qualification)
                                                            <span class="info-box-number text-center mb-0">@lang('dashboard.Qualification') : {{$request->payment?->qualification}}</span>
                                                        @endif
                                                        <span class="info-box-number text-center mb-0">@lang('dashboard.Address') : {{$request->payment?->address}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif


                                        <div>
                                            <h6>@lang('dashboard.status')</h6>
                                                <form action="{{route('requests.changeStatus' , $request['id'])}}" method="post" class="col-12 row">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="col-8">
                                                        <select class="form-control" name="status">
                                                            <option value="ORDERED"   @selected($request->status == "ORDERED")>@lang('dashboard.ORDERED')</option>
                                                            <option value="APPROVED"  @selected($request->status == "APPROVED")>@lang('dashboard.APPROVED')</option>
                                                            <option value="DELIVERED" @selected($request->status == "DELIVERED")>@lang('dashboard.DELIVERED')</option>
                                                            <option value="CANCELED"  @selected($request->status == "CANCELED")>@lang('dashboard.CANCELED')</option>
                                                        </select>
                                                    </div>
                                                    @if(auth()->user()->hasPermission('printRequests-update'))
                                                    <div class="col-2">
                                                        <button class="btn btn-dark " type="submit">@lang('dashboard.change')</button>
                                                    </div>
                                                    @endif

                                                </form>

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
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
