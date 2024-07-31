@extends('layouts.app')

@section('content')
<div class="col-10">
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

                <p>{{ $post->description }}</p>

                @if ($post->image !== "")
                    <img src="{{ asset('/storage/post_images/'. $post->image) }}" style="width: 250;">
                @endif

                <div class="row">
                    <div class="col-auto">
                        <p>{{ $post->created_at->format('Y/m/d H:i:s')}}</p>
                    </div>
                    <div class="col-auto">
                        @if ($post->is_anonymous !== 1)
                            <p> {{ $post->user->name }}（匿名）</p>
                        @else
                            <p>by {{ $post->user->name }}</p>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-auto">
                        <a href="{{ route('admin.posts.edit', $post) }}" class="green-link">編集</a>
                    </div>
                    <div class="col-auto">
                        <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" onsubmit="return confirm('本当に削除してもよろしいですか？');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="green-link">削除</button>
                        </form>
                    </div>
                </div>
                <hr>
            </article>
        @endforeach
    @else
            <p>投稿はありません。</p>
    @endif
</div>
@endsection
