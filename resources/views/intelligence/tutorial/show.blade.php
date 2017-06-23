@extends('layouts.app')

@section('js')
    <script src="//cdn.ckeditor.com/4.5.8/standard/ckeditor.js"></script>
    <script></script>
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-xs-12">
                        <h2>{{ $tutorial->title }}</h2>
                        <ol class="breadcrumb">
                            <li><a href="{{ route('intelligence.index') }}">Inteligencias</a></li>
                            <li>
                                <a href="{{ route('intelligence.show',$intelligence->slug) }}"> {{ $intelligence->name }}</a>
                            </li>
                            <li class="active"> {{ $tutorial->title }} </li>
                        </ol>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="//www.youtube.com/embed/{{ $tutorial->getYoutubeId() }}"></iframe>
                        </div>
                    </div>
                </div>

                <br>

                <form action="{{ route('comment.store',[$intelligence->slug,$tutorial->id]) }}" role="form" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input name="url" placeholder="Url vdel video" class="form-control" required="required">
                    </div>
                    <div class="form-group">
                        <textarea id="message" name="message" placeholder="Mensaje" class="form-control" required="required"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary pull-right">Enviar comentario</button>
                    </div>
                </form>

                <br>

                <h3>Comentarios</h3>

                <table class="table">
                    @foreach($comments as $comment)
                        <tr>
                            <td>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-4">
                                        <div class="embed-responsive embed-responsive-16by9">
                                            <iframe class="embed-responsive-item" src="//www.youtube.com/embed/{{ $comment->getYoutubeId() }}"></iframe>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        {!! $comment->message !!}
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </table>
                {!! $comments->render() !!}
            </div>
        </div>
    </div>
@endsection
