@extends('layouts.app')

@section('content')
    <h1>投稿一覧</h1>
    @if (session('flash_message'))
        <p>{{ session('flash_message') }}</p>
    @endif

    @if($posts->isNotEmpty())
        @foreach($posts as $post)
            <article>
                @if ($post->is_soldout == 1)
                    <p style="color: red;">売り切れです！</p>
                @endif

                <h2>{{ $post->price }}円</h2>

                @if ($post->image !== "")
                    <img src="{{ asset('/images/post_images/'. $post->image) }}" style="width: 250;">
                @endif

                <p>{{ $post->description }}</p>

                <p>{{ $post->created_at}}</p>

                @if ($post->is_anonymous !== 1)
                    <p>by 匿名ユーザー</p>
                @else
                    <p>by {{ $post->user->name }}</p>
                @endif

                @if(Auth::user()->favorite_posts()->where('post_id', $post->id)->exists())
                    <form action="{{ route('favorite.destroy', $post->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit">♡</button>
                    </form>
                @else
                    <form action="{{ route('favorite.store', $post->id) }}" method="post">
                        @csrf
                        <button type="submit">♥</button>
                    </form>
                @endif
                <hr>
            </article>
        @endforeach
    @else
        <p>投稿はありません。</p>
    @endif
@endsection
