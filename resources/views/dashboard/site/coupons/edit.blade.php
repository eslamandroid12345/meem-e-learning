@php use Carbon\Carbon; @endphp
@extends('dashboard.core.app')
@section('title', __('titles.Edit') . " " . __('titles.Coupon'))

@section('css_addons')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <style>
        .optional{
            opacity: .5;
            font-size: 13px;
        }
    </style>
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.Coupons')</h1>
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
                        <form action="{{ route('coupons.update' , $coupon['id']) }}" method="post" autocomplete="off"
                              enctype="multipart/form-data">
                            <div class="card-header">
                                <h3 class="card-title">{{__('titles.Edit') . " " . __('titles.Coupon')}}</h3>
                            </div>
                            <div class="card-body">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="form-group col-4">
                                        <label for="exampleInputName1">@lang('dashboard.Coupon')</label>
                                        <input required name="coupon" type="text" class="form-control" id="exampleInputName1"
                                               value="{{ old('coupon') ?? $coupon['coupon'] }}" placeholder="">
                                    </div>
                                    <div class="form-group col-4">
                                        <label for="exampleInputName1">@lang('dashboard.discount') %</label>
                                        <input required name="discount" type="number" min="1" max="100" step=".5" class="form-control" id="exampleInputName1"
                                               value="{{ old('discount') ?? $coupon['discount'] }}" placeholder="">
                                    </div>

                                    <div class="form-group col-4">
                                        <label for="exampleInputName1">@lang('dashboard.max_uses') <span class="optional">@lang('dashboard.optional')</span></label>
                                        <input name="max_uses" type="number" min="1"  class="form-control" id="exampleInputName1"
                                               value="{{ old('max_uses') ?? $coupon['max_uses'] }}" placeholder="">
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="type">@lang('dashboard.type')</label>
                                        <select id="type" class="form-control">
                                            <option  value="All">@lang('dashboard.all_items')</option>
                                            <option @if($coupon->couponable_type != null) selected @endif value="SPECIAL">@lang('dashboard.one_item')</option>
                                        </select>
                                    </div>

                                    <input id="couponable_type" type="hidden" name="couponable_type">
                                    <div id="selectItem" class="form-group col-6 @if($coupon->couponable_type == null) d-none @endif">
                                        <label for="exampleInputName1">@lang('dashboard.the_item')</label>
                                        <select name="couponable_id"  id="items" class="form-control">
                                            <optgroup data-name="App\Models\Course" label="@lang('dashboard.courses')">
                                                @foreach($courses as $course)
                                                    <option @if($coupon->couponable_type == "App\Models\Course" && $coupon->couponable_id == $course['id'] ) selected @endif value="{{$course['id']}}">{{$course->t('name')}}</option>
                                                @endforeach
                                            </optgroup>

                                            <optgroup data-name="App\Models\CourseBook" label="@lang('dashboard.books')">
                                                @foreach($books as $book)
                                                    <option @if($coupon->couponable_type == "App\Models\CourseBook" && $coupon->couponable_id == $course['id'] ) selected @endif value="{{$book['id']}}">{{$book->t('name')}}</option>
                                                @endforeach
                                            </optgroup>

                                        </select>
                                    </div>

                                    <div class="row">
                                        <div class="form-group clearfix col-6">
                                            <input name="is_active" type="hidden" value="off">
                                            <div class="icheck-wetasphalt d-inline">
                                                <input name="is_active" type="checkbox" id="checkboxPrimary3" @checked($coupon->is_active == true)>
                                                <label for="checkboxPrimary3">@lang('dashboard.Activate')</label>
                                            </div>
                                        </div>
                                        <div class="form-group clearfix col-6">
                                            <div class="icheck-wetasphalt d-inline">
                                                <input name="mobile_only" type="checkbox" id="checkboxPrimary5" @checked($coupon->mobile_only == true)>
                                                <label for="checkboxPrimary5">@lang('dashboard.mobile_only')</label>
                                            </div>
                                        </div>
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

@section('js_addons')
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function () {
            bsCustomFileInput.init();
            $('.select2').select2({
                language: {
                    searching: function () {
                    }
                },
            });
        });
    </script>
    <script>
        $('#type').on('change' , function (){
            if($(this).val() === 'BOOK') {
                $('#book_select').removeClass('d-none');
                var course_id = $('#course').val();
                $('.course-' + course_id).removeClass('d-none');

            }else{
                $('.books').addClass('d-none')
                $('#book_select').addClass('d-none')
            }

        })

        $('#course').on('change' , function (){
            var course_id = $('#course').val();
            $('.books').addClass('d-none')
            $('.course-' + course_id).removeClass('d-none');
            $('.books').removeAttr('selected')
            $('.course-' + course_id).first().attr('selected' , 'selected');

        })
    </script>

    <script>
        $('#type').on('change' , function (){
            $('#selectItem').toggleClass('d-none');
        });

        $('#items').on('change' , function (){
            var type = $('#items :selected').parent().data('name');
            $('#couponable_type').val(type);
        });
    </script>
@endsection
