@extends('layouts.app')

@section('content')
<div class="mb-1">
    <a href="{{ route('top') }}" class="green-link">トップ</a> > <a href="{{ route('mypage') }}" class="green-link">マイページ</a> > お気に入り投稿一覧
</div>
@if (session('flash_message'))
        <div role="alert">
             <p>{{ session('flash_message') }}</p>
        </div>
@endif

<div class="fav_container mt-2 mb-5">
    @if ($favorite_posts->isEmpty())
        <p>お気に入りの投稿はありません。</p>
    @else
        @foreach ($favorite_posts as $post)
        <div class="card mb-2 main-card-bg">
            <div class="row mt-2 mx-2">
                <div class="col-sm-3 d-flex align-items-center">
                    <div class="card-img flex-shrink-0">
                        @if ($post->image !== "")
                            <img src="{{ asset('/images/post_images/'. $post->image) }}">
                        @else ($post->store->image !== "")
                            <img src="{{ asset('/images/store_images/'. $post->store->image) }}">
                        @endif
                    </div>
                </div>
                <div class="col-sm-9 text-center">
                        <div class="card-title">
                            {{ $post->store->name }}の{{ $post->item->name }}
                        </div>
                    <div class="d-flex justify-content-center">
                        <h2>{{ $post->price }}<span class="fs-6">円</span></h2>
                        @if ($post->is_soldout == 1)
                            <p style="color: red;">　売り切れです！</p>
                        @endif
                    </div>
                    <div class="card-text">
                        <p>{{ $post->description }}</p>
                    </div>
                    <div class="d-flex justify-content-center text-secondary">
                        <p>{{ $post->created_at->format('Y/m/d H:i') }}</p>
                        @if ($post->is_anonymous !== 1)
                            <p>　by 匿名ユーザー</p>
                        @else
                            <p>　by {{ $post->user->name }}</p>
                        @endif
                    </div>
                    <div class="text-right mb-2">
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
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    @endif
</div>
@endsection
