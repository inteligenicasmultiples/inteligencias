@extends('layouts.app')

@section('js')
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
        <div class="form-group">
            <input name="url" type="text" required="required" class="form-control"
                   placeholder="Url del tutorial">
        </div>
        {{ csrf_field() }}
        <div class="form-group">
            <button type="submit" class="btn btn-primary pull-right">Crear tutorial</button>
        </div>
        </form>
    </div>
@endsection
