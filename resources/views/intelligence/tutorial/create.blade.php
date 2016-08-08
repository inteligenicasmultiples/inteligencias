@extends('layouts.app')

@section('js')
    <script src="//cdn.ckeditor.com/4.5.8/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('body');
    </script>
    <script language="JavaScript" src="//ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script>
    <script language="JavaScript" src="/libs/script_cam/scriptcam.min.js"></script>
    <script>
        $(document).ready(function() {
        	$("#webcam").scriptcam({
        		showMicrophoneErrors:false,
        		onError:onError,
        		cornerRadius:20,
        		disableHardwareAcceleration:1,
        		cornerColor:'e3e5e2',
        		onWebcamReady:onWebcamReady,
        		uploadImage:'upload.gif',
        		onPictureAsBase64:base64_tofield_and_image,
                path: '/libs/script_cam/'

        	});
        });
        function base64_tofield() {
        	$('#formfield').val($.scriptcam.getFrameAsBase64());
        };
        function base64_toimage() {
        	$('#image').attr("src","data:image/png;base64,"+$.scriptcam.getFrameAsBase64());
        };
        function base64_tofield_and_image(b64) {
        	$('#formfield').val(b64);
        	$('#image').attr("src","data:image/png;base64,"+b64);
        };
        function changeCamera() {
        	$.scriptcam.changeCamera($('#cameraNames').val());
        }
        function onError(errorId,errorMsg) {
        	$( "#btn1" ).attr( "disabled", true );
        	$( "#btn2" ).attr( "disabled", true );
        	alert(errorMsg);
        }
        function onWebcamReady(cameraNames,camera,microphoneNames,microphone,volume) {
        	$.each(cameraNames, function(index, text) {
        		$('#cameraNames').append( $('<option></option>').val(index).html(text) )
        	});
        	$('#cameraNames').val(camera);
        }
     </script>
@stop

@section('content')
    <div class="container spark-screen">
        <div class="row">
            <div class="col-xs-12">
                <h2>
                    Crear tutorial
                </h2>
                <div id="webcam">
                </div>

                <ol class="breadcrumb">
                    <li><a href="{{ route('intelligence.index') }}">Inteligencias</a></li>
                    <li><a href="{{ route('intelligence.show',$intelligence->slug) }}"> {{ $intelligence->name }}</a></li>
                    <li class="active"> Crear tutorial</li>
                </ol>
            </div>
        </div>
        <br>
        <form action="{{ route('tutorial.store',$intelligence->slug) }}" role="form" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                <input name="title" type="text" required="required" class="form-control"
                       placeholder="Titulo del tutorial">
            </div>
            <div class="form-group">
                <textarea id="body" name="body" required="required"></textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary pull-right">Crear tutorial</button>
            </div>
        </form>
    </div>
@endsection
