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
				fileReady:fileReady,
				cornerRadius:20,
				cornerColor:'e3e5e2',
				onError:onError,
				promptWillShow:promptWillShow,
				showMicrophoneErrors:false,
				showDebug:true,
				onWebcamReady:onWebcamReady,
				setVolume:setVolume,
				timeLeft:timeLeft,
				fileName:'demo895342',
				connected:showRecord,
                path: '/libs/script_cam/'
			});
			setVolume(0);

		});
		function showRecord() {
			$( "#recordStartButton" ).attr( "disabled", false );
		}
		function startRecording() {
			$( "#recordStartButton" ).attr( "disabled", true );
			$( "#recordStopButton" ).attr( "disabled", false );
			$( "#recordPauseResumeButton" ).attr( "disabled", false );
			$.scriptcam.startRecording();
		}
		function closeCamera() {
			$("#recordPauseResumeButton" ).attr( "disabled", true );
			$("#recordStopButton" ).attr( "disabled", true );
			$.scriptcam.closeCamera();
			$('#message').html('Please wait for the file conversion to finish...');
		}
		function pauseResumeCamera() {
			if ($( "#recordPauseResumeButton" ).html() == 'Pause Recording') {
				$( "#recordPauseResumeButton" ).html( "Resume Recording" );
				$.scriptcam.pauseRecording();
			}
			else {
				$( "#recordPauseResumeButton" ).html( "Pause Recording" );
				$.scriptcam.resumeRecording();
			}
		}
		function fileReady(fileName) {
			$('#recorder').hide();
			fileName2=fileName.replace('mp4','gif');
			$('#message').html('The MP4 file is now dowloadable for five minutes over <a href="'+fileName+'">here</a>. The animated GIF can be downloaded <a href="'+fileName2+'">here</a>.');
			var fileNameNoExtension=fileName.replace(".mp4", "");
			jwplayer("mediaplayer").setup({
				width:320,
				height:240,
				file: fileName,
				image: fileNameNoExtension+'_0000.jpg',
				tracks: [{
					file: fileNameNoExtension+'.vtt',
					kind: 'thumbnails'
				}]
			});
			$('#mediaplayer').show();
		}
		function onError(errorId,errorMsg) {
			alert(errorMsg);
		}
		function onWebcamReady(cameraNames,camera,microphoneNames,microphone,volume) {
			$.each(cameraNames, function(index, text) {
				$('#cameraNames').append( $('<option></option>').val(index).html(text) )
			});
			$('#cameraNames').val(camera);
			$.each(microphoneNames, function(index, text) {
				$('#microphoneNames').append( $('<option></option>').val(index).html(text) )
			});
			$('#microphoneNames').val(microphone);
		}
		function promptWillShow() {
			alert('A security dialog will be shown. Please click on ALLOW.');
		}
		function setVolume(value) {
			value=parseInt(32 * value / 100) + 1;
			for (var i=1; i < value; i++) {
				$('#LedBar' + i).css('visibility','visible');
			}
			for (i=value; i < 33; i++) {
				$('#LedBar' + i).css('visibility','hidden');
			}
		}
		function timeLeft(value) {
			$('#timeLeft').val(value);
		}
		function changeCamera() {
			$.scriptcam.changeCamera($('#cameraNames').val());
		}
		function changeMicrophone() {
			$.scriptcam.changeMicrophone($('#microphoneNames').val());
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

                <ol class="breadcrumb">
                    <li><a href="{{ route('intelligence.index') }}">Inteligencias</a></li>
                    <li><a href="{{ route('intelligence.show',$intelligence->slug) }}"> {{ $intelligence->name }}</a></li>
                    <li class="active"> Crear tutorial</li>
                </ol>
            </div>
        </div>
        <br>
        <br>
        <form action="{{ route('tutorial.store',$intelligence->slug) }}" role="form" method="POST">
        <div class="form-group">
            <input name="title" type="text" required="required" class="form-control"
                   placeholder="Titulo del tutorial">
        </div>
        <div class="row">
            <div class="col-sm-7">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <textarea id="body" name="body" required="required"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary pull-right">Crear tutorial</button>
                    </div>
            </div>
            <div class="col-sm-5">
                <div class="text-center">
                    <div id="webcam">
                    </div>
                    <div id="setupPanel">
                        <select id="cameraNames" size="1" onChange="changeCamera()" style="width:145px;font-size:10px;height:25px;">
                        </select>
                        <select id="microphoneNames" size="1" onChange="changeMicrophone()" style="width:128px;font-size:10px;height:25px;">
                        </select>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
@endsection
