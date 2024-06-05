@extends('layouts.app')

@section('content')
@if (session('flash_message'))
        <div role="alert">
             <p>{{ session('flash_message') }}</p>
        </div>
@endif

@if ($favorite_posts->isEmpty())
        お気に入りの投稿はありません。
    </a>
@else

    @foreach ($favorite_posts as $favorite_post)
    <article>
        @if ($favorite_post->is_soldout == 1)
            <p style="color: red;">売り切れです！</p>
        @endif

        <h2>{{ $favorite_post->price }}円</h2>

        @if ($favorite_post->image !== "")
            <img src="{{ asset('/storage/post_images/'. $favorite_post->image) }}" style="width: 250;">
        @endif

        <p>{{ $favorite_post->description }}</p>

        <p>{{ $favorite_post->created_at}}</p>

        @if ($favorite_post->is_anonymous !== 1)
            <p>by 匿名ユーザー</p>
        @else
            <p>by {{ $favorite_post->user->name }}</p>
        @endif
        <hr>
    @endforeach
@endif
@endsection
