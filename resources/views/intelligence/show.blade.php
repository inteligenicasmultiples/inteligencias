@extends('layouts.app')


@section('content')
    <div class="container spark-screen">
        <div class="row">
            <div class="col-xs-12">
                <h2>
                    {{ $intelligence->name }}
                    <a class="btn btn-primary pull-right" href="{{ route('tutorial.create',$intelligence->id) }}">Crear tutorial</a>
                </h2>
            </div>
        </div>
        <ol class="breadcrumb">
            <li><a href="{{ route('intelligence.index') }}">Inteligencias</a></li>
            <li class="active"> {{ $intelligence->name }}</li>
        </ol>
        <br>
        @forelse($intelligence->tutorials as $tutorial)
            <div class="row">
                <div class="col-xs-12">
                    <div> {{ $tutorial->name }}</div>
                    <div> {{ $tutorial->body }}</div>
                </div>
            </div>
        @empty
            <div class="row">
                <div class="col-xs-12">
                    <div class=" alert alert-info">
                        No hay ningun tutorial aun. Se el primero en crear uno
                    </div>
                </div>
            </div>
        @endforelse
    </div>
@endsection
