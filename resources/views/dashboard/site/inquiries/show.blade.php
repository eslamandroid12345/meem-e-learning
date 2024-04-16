@extends('dashboard.core.app')
@section('title', __('titles.Create') . " " . __('dashboard.Inquiry'))

@section('css_addons')
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.Inquiries')</h1>
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
                        <form action="{{ route('inquiries.update', $inquiry->id) }}" method="post" autocomplete="off" id="myForm" enctype="multipart/form-data">
                            <div class="card-header">
                                    <h3 class="card-title">{{__('titles.Edit') . " " . __('dashboard.Inquiry')}}</h3>
                            </div>

                            <div class="card-body">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-{{ $inquiry->attachment !== null ? '8' : '12' }}">
                                        <h5>@lang('db.inquiries.'.$inquiry->type) @lang('dashboard.from student') {{ $inquiry->user->name }}</h5>
                                        <h3>- {{ $inquiry->question }}</h3>
                                    </div>

                                    @empty(!$inquiry->attachment)
                                        <div class="col-4">
                                            <a target="_blank" href="{{$inquiry->attachment}}">@lang('dashboard.view_attachment')</a>
                                        </div>
                                    @endempty
                                    <div class="form-group col-12">
                                        <label for="summernote">@lang('dashboard.Answer')</label>
                                        <textarea name="answer" type="text" class="form-control" id="summernote">{{ old('answer') ?? $inquiry->answer }}</textarea>
                                    </div>

                                    <div class="form-group col-12">
                                        <label>@lang('dashboard.attach_voice')</label>

                                            <div>
                                             <button style="border-radius: 50%;width: 20px ;height: 20px;background: red;margin-top: 10px" id="record"></button>
                                            </div>

{{--                                        <audio src="{{url($inquiry->ans)}}"--}}

                                        <audio id="recordedAudio"></audio>

                                        @if($inquiry->answer_voice)
                                            <audio id="oldAudio" controls="true" src="{{url($inquiry->answer_voice)}}"></audio>
                                        @endif

                                        <input name="answer_voice" type="file" class="d-none" id="audioFile"/>

                                    </div>
                                    @if($inquiry->type == "EDUCATIONAL")
                                        <div class="form-group clearfix col-12">
                                            <input name="is_public" type="hidden" value="off">
                                            <div class="icheck-wetasphalt d-inline">
                                                <input name="is_public" type="checkbox" id="checkboxPrimary3" @checked(old('is_public') != null ? old('is_public') == 'on' : $inquiry->is_public)>
                                                <label for="checkboxPrimary3">@lang('dashboard.Post it publicly')</label>
                                            </div>
                                        </div>
                                    @endif
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
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function () {
            $('#summernote').summernote();
            bsCustomFileInput.init();
            $('.select2').select2({
                language: {
                    searching: function() {}
                },
            });
        });
    </script>
    <script>
        navigator.mediaDevices.getUserMedia({audio:true})
            .then(stream => {handlerFunction(stream)})


        function handlerFunction(stream) {
            rec = new MediaRecorder(stream);
            rec.ondataavailable = e => {
                audioChunks.push(e.data);
                if (rec.state == "inactive"){
                    let blob = new Blob(audioChunks,{type:'audio/mpeg-3'});
                    recordedAudio.src = URL.createObjectURL(blob);
                    recordedAudio.controls=true;
                    recordedAudio.autoplay=true;
                    sendData(blob);
                    const input = document.getElementById('oldAudio');
                    input.style.display = "none";
                }
            }
        }
        function sendData(data) {
            const input = document.getElementById('audioFile');
            let file = new File([data] , 'myaudio.mp3',{type:data.type, lastModified:new Date().getTime()});
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);
            input.files = dataTransfer.files;

        }

        record.onclick = e => {
            e.preventDefault();
            if(record.style.backgroundColor == "red"){
                e.preventDefault();
                console.log('I was clicked')
                record.style.backgroundColor = "blue"
                audioChunks = [];
                rec.start();
            } else{
                e.preventDefault();
                console.log("I was clicked")
                record.style.backgroundColor = "red"
                rec.stop();
            }

        }

    </script>
@endsection
