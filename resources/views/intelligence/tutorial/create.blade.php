@extends('layouts.app')

@section('css')
    <link href="/vid/node_modules/video.js/dist/video-js.min.css" rel="stylesheet">
    <link href="/vid/src/css/videojs.record.css" rel="stylesheet">
    <link href="/vid/examples/assets/css/style.css" rel="stylesheet">
    <style>
        /* change player background color */
        #myVideo {
            background-color: #E8E884;
        }
        /* hide file upload button */
        #fileupload {
            display: none;
        }
    </style>
@stop
@section('js')
    <script src="/vid/node_modules/video.js/dist/video.min.js"></script>
    <script src="/vid/node_modules/recordrtc/RecordRTC.js"></script>
    <script src="/vid/node_modules/wavesurfer.js/dist/wavesurfer.min.js"></script>
    <script src="/vid/node_modules/wavesurfer.js/dist/plugin/wavesurfer.microphone.min.js"></script>
    <script src="/vid/node_modules/videojs-wavesurfer/dist/videojs.wavesurfer.min.js"></script>
    <script src="/vid/src/js/videojs.record.js"></script>

    <script src="/vid/node_modules/blueimp-file-upload/js/vendor/jquery.ui.widget.js"></script>
    <script src="/vid/node_modules/blueimp-file-upload/js/jquery.iframe-transport.js"></script>
    <script src="/vid/node_modules/blueimp-file-upload/js/jquery.fileupload.js"></script>

    <script>
    $(function () {
        // Initialize the jQuery File Upload widget
        $('#fileupload').fileupload({
            url: '{{ route('tutorial.store.video', $intelligence->slug) }}',
            done: function (e, data) {
                $.each(data.files, function (index, file) {
                    var message = 'Upload complete: ' + file.name + ' (' +
                        file.size + ' bytes)';
                    $('<p/>').text(message).appendTo(document.body);
                    console.log(message);
                     $("#create-tutorial").prop('disabled', false);
                });
            }
        });

        var player = videojs("myVideo", {
            controls: true,
            width: 320,
            height: 240,
            plugins: {
                record: {
                    audio: true,
                    video: true,
                    maxLength: 600,
                    debug: true
                }
            }
        });

        // player error handling
        player.on('deviceError', function()
        {
            console.warn('device error:', player.deviceErrorCode);
        });
        player.on('error', function(error)
        {
            console.log('error:', error);
        });

        // data is available
        player.on('finishRecord', function()
        {
            // the blob object contains the audio data
            var videoFile = player.recordedData;

            console.log('finished recording: ', videoFile.video);

            // upload data to server
            var filesList = [videoFile.video];
            $('#fileupload').fileupload('add', {files: filesList});
        });
    });
    </script>
@stop

@section('content')
    <div class="container spark-screen">
        <div class="row">
            <div class="col-xs-12">
                <h2>
                    Crear tutorial
                </h2>

                <ol class="breadcrumb">
                    <li><a href="{{ route('intelligence.index') }}">Inteligencias</a></li>
                    <li><a href="{{ route('intelligence.show',$intelligence->slug) }}"> {{ $intelligence->name }}</a></li>
                    <li class="active"> Crear tutorial</li>
                </ol>
            </div>
        </div>
        <br>
        <br>
        <div class="form-group">
            <video id="myVideo" class="video-js vjs-default-skin"></video>
            <input id="fileupload" type="file" name="files[]" multiple>
        </div>
        <form action="{{ route('tutorial.store',$intelligence->slug) }}" role="form" method="POST">
            <div class="form-group">
                <input name="title" type="text" required="required" class="form-control"
                       placeholder="Titulo del tutorial">
            </div>

            {{ csrf_field() }}
            <div class="form-group">
                <button id="create-tutorial" type="submit" class="btn btn-primary pull-right" disabled>Crear tutorial</button>
            </div>
        </form>
    </div>
@endsection
