@extends('layouts.app')

@section('content')
    <div class="container spark-screen">
        <div class="row">
            <div class="col-xs-12">
                <h1>Inteligencias Multiples</h1>
            </div>
        </div>
        @foreach ($intelligences->chunk(4) as $chunk)
            <div class="row">
                @foreach ($chunk as $intelligence)
                    <div class="col-sm-3">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title">{{ $intelligence->name }}</h3>
                            </div>
                            <div class="panel-body">
                                <p>{{ $intelligence->description }}</p>

                                <div class="row">
                                    <div class="col-xs-12">
                                        <a class="btn btn-success btn-sm btn-block" href="{{ route('intelligence.show',$intelligence->slug) }}">Entrar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
@endsection
