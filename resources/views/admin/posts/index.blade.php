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
                        <img src="{{ asset('/storage/post_images/'. $post->image) }}" style="width: 250;">
                    @endif

                    <p>{{ $post->description }}</p>

                    <p>{{ $post->created_at}}</p>

                    @if ($post->is_anonymous !== 1)
                        <p> {{ $post->user->name }}（匿名）</p>
                    @else
                        <p>by {{ $post->user->name }}</p>
                    @endif

                    <a href="{{ route('admin.posts.edit', $post) }}">編集</a>

                    <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" onsubmit="return confirm('本当に削除してもよろしいですか？');">
                        @csrf
                        @method('DELETE')
                        <button type="submit">削除</button>
                    </form>
                    <hr>
                </article>
            @endforeach
        @else
             <p>投稿はありません。</p>
        @endif
@endsection
