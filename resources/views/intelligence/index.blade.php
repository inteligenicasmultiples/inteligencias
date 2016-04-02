@extends('layouts.app')

@section('content')
    <div class="container spark-screen">
        <div class="row">
            <div class="col-xs-12">
                <h1>Inteligencias Multiples</h1>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-xs-12">
                @foreach($intelligences as $intelligence)
                    <a href="{{ route('intelligence.show',$intelligence->id) }}"
                       class="btn btn-primary">{{ $intelligence->name }}</a>
                @endforeach
            </div>
        </div>
    </div>
@endsection
