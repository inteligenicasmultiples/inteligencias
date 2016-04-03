@extends('layouts.app')

@section('content')
    <div class="container spark-screen">
        <div class="row">
            <div class="col-xs-12">
                <h2>
                    {{ $intelligence->name }}
                    <a class="btn btn-primary pull-right" href="{{ route('tutorial.create',$intelligence->slug) }}">Crear
                        tutorial</a>
                </h2>
            </div>
        </div>
        <ol class="breadcrumb">
            <li><a href="{{ route('intelligence.index') }}">Inteligencias</a></li>
            <li class="active"> {{ $intelligence->name }}</li>
        </ol>
        <br>
        @foreach($tutorials as $tutorial)
            <div class="row">
                <div class="col-xs-12">
                    <div> <a href="{{ route('tutorial.show',[$intelligence->slug,$tutorial->id]) }}">{{ $tutorial->title }}</a> </div>
                    <div> {!! $tutorial->body !!}</div>
                    <hr>
                </div>
            </div>
        @endforeach
        {!! $tutorials->render() !!}
    </div>
@endsection
