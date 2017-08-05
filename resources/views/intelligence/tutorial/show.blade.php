@extends('layouts.app')

@section('js')
    <script src="//cdn.ckeditor.com/4.5.8/standard/ckeditor.js"></script>
    <script>

    var likePostPath = '{{ route('post.like',[$intelligence->slug, $tutorial->id]) }}';
    var unlikePostPath = '{{ route('post.unlike',[$intelligence->slug, $tutorial->id]) }}';
    var whoLikePostPath = '{{ route('post.like.who',[$intelligence->slug, $tutorial->id]) }}';

    $(document).on("click", '.like:not(.disabled)', function () {
        $(".like-icon").popover('destroy');
        var link = $(this);
        link.removeClass('like').addClass('unlike disabled').html('Ya no me gusta');
        if ($(this).attr('data-type') == 'tutorial') {
            var type = 'tutorial';
            var postId = $(this).attr('data-tutorial-id');
        } else {
            var type = 'comment';
            var postId = $(this).attr('data-comment-id');
        }
        $.ajax({
            url: likePostPath,
            method: 'POST',
            data: {
                _token: _token,
                type: type,
                postId: postId,
            }
        }).done(function (data) {

            link.parent().find('.counter').html(data);
            link.parent().find('.fa-thumbs-o-up').addClass("like-icon");
            link.removeClass('disabled');
        }).fail(function (data) {
            console.log('Error');
        });
    });

    $(document).on("click", '.unlike:not(.disabled)', function () {
        var link = $(this);
        link.removeClass('unlike disabled').addClass('like').html('Me gusta');
        if ($(this).attr('data-type') == 'tutorial') {
            var type = 'tutorial';
            var postId = $(this).attr('data-tutorial-id');
        } else {
            var type = 'comment';
            var postId = $(this).attr('data-comment-id');
        }
        $.ajax({
            url: unlikePostPath,
            method: 'POST',
            data: {
                _token: _token,
                type: type,
                postId: postId,
            }
        }).done(function (data) {
            if (data == 0) {
                $(".like-icon").popover('destroy');
                link.parent().find('.fa-thumbs-o-up').removeClass("like-icon");
            }
            link.parent().find('.counter').html(data);
            link.removeClass('disabled');
        }).fail(function (data) {
            console.log('Error');
        });
    });

    $(document).on("click", '.like-icon', function () {
        var likeIcon = $(this);
        if ($(this).attr('data-type') == 'tutorial') {
            var type = 'tutorial';
            var postId = $(this).attr('data-tutorial-id');
        } else {
            var type = 'comment';
            var postId = $(this).attr('data-comment-id');
        }
        $.ajax({
            url: whoLikePostPath,
            method: 'GET',
            dataType: 'json',
            data: {
                type: type,
                postId: postId,
            }
        }).done(function (data) {
            var userList = "<ul class='user-list'>";
            $.each(data, function (index, like) {
                userList += "<li>" + like.user.name  + "</li>"
            });
            userList += "</ul>";

            $(".like-icon").popover('destroy');

            var genericCloseBtnHtml = '<button onclick="$(this).closest(\'div.popover\').popover(\'hide\');" type="button" class="close" aria-hidden="true">&times;</button>';
            likeIcon.popover({
                html: true,
                content: userList,
                title: 'Usuarios ' + genericCloseBtnHtml,
                placement: 'top'
            }).popover('show');

        }).fail(function (data) {
            console.log('Error');
        });
    });

    </script>
@stop

@section('content')
    <div class="container js-like-container">
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
                        <div class="text-center">
                            <video  controls >
                                  <source src="{{ $tutorial->getVideoPath() }}" type="video/mp4">
                                Your browser does not support the video tag.
                                </video>

                        </div>
                        <div class="clearfix"></div>
                        <span title="{{ $tutorial->created_at }}">{{ $tutorial->created_at->diffForHumans() }}<span>
                        @if (Auth::check())
                            <div class="likes-div">
                                    @if( $tutorial->myLikes->count())
                                        <a class="link unlike" data-type="tutorial" data-tutorial-id="{{ $tutorial->id }}">Ya
                                            no me gusta </a>
                                    @else
                                        <a class="link like" data-type="tutorial" data-tutorial-id="{{ $tutorial->id }}"> Me
                                            gusta </a>
                                    @endif
                                    <i class="fa fa-thumbs-o-up {{ $tutorial->likes->count() ? "like-icon" :"" }}"
                                       data-type="tutorial" data-tutorial-id="{{ $tutorial->id }}"></i>
                                    <span class="counter">{{ $tutorial->likes->count() }} </span>
                            </div>
                        @endif
                    </div>
                </div>

                <br>

                <form action="{{ route('comment.store',[$intelligence->slug,$tutorial->id]) }}" role="form" method="POST">
                    {{ csrf_field() }}
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
                                @if ($comment->has_video)
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6 col-md-4">
                                            <div class="">
                                                <video  controls width="300">
                                                      <source src="{{ $comment->getVideoPath() }}" type="video/mp4">
                                                    Your browser does not support the video tag.
                                                    </video>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-xs-12">
                                        {!! $comment->message !!}
                                        <div class="clearfix"></div>
                                        <span title="{{ $tutorial->created_at }}">{{ $comment->created_at->diffForHumans() }}<span>
                                        @if (Auth::check())
                                            <div class="likes-div">
                                                    @if( $comment->myLikes->count())
                                                        <a class="link unlike" data-type="comment" data-comment-id="{{ $comment->id }}">Ya
                                                            no me gusta </a>
                                                    @else
                                                        <a class="link like" data-type="comment" data-comment-id="{{ $comment->id }}"> Me
                                                            gusta </a>
                                                    @endif
                                                    <i class="fa fa-thumbs-o-up {{ $comment->likes->count() ? "like-icon" :"" }}"
                                                       data-type="comment" data-comment-id="{{ $comment->id }}"></i>
                                                    <span class="counter">{{ $comment->likes->count() }} </span>
                                            </div>
                                        @endif
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
