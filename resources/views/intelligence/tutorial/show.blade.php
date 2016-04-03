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
                        {!! $tutorial->body !!}
                    </div>
                </div>

                <br>

                <form action="{{ route('comment.store',[$intelligence->slug,$tutorial->id]) }}" role="form" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <textarea id="message" name="message" class="form-control" required="required"></textarea>
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
                            <td>{!! $comment->message !!}</td>
                        </tr>
                    @endforeach
                </table>
                {!! $comments->render() !!}
            </div>
        </div>
    </div>
@endsection
