@extends('layouts.app')

@section('js')
    <script src="//cdn.ckeditor.com/4.5.8/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('body');
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
                    <li><a href="{{ route('intelligence.show',$intelligence->id) }}"> {{ $intelligence->name }}</a></li>
                    <li class="active"> Crear tutorial</li>
                </ol>
            </div>
        </div>
        <br>
        <form action="{{ route('tutorial.store',$intelligence->id) }}" role="form" method="POST">
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
