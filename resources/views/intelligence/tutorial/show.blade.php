@extends('layouts.app')

@section('js')
    <script src="//cdn.ckeditor.com/4.5.8/standard/ckeditor.js"></script>
    <script></script>
@stop

@section('content')
    <div class="container spark-screen">
        <div class="row">
            <div class="col-xs-12">
                <h1>{{ $intelligence->name }}</h1>
            </div>
        </div>
        @forelse($intelligence->posts as $post)
            <div class="row">
                <div class="col-xs-12">
                    <div> {{ $post->name }}</div>
                    <div> {{ $post->body }}</div>
                </div>
            </div>
        @empty
            <div class="row">
                <div class="col-xs-12">
                   asd
                </div>
            </div>
        @endforelse
    </div>
@endsection
