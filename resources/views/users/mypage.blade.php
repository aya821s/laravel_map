@extends('layouts.app')

@section('content')
<div class="mypage-container">
    <h1 class="text-center">マイページ</h1>
    @if (session('flash_message'))
        <div class="alert alert-warning" role="alert">
            <p class="mb-0">{{ session('flash_message') }}</p>
        </div>
    @endif

    @if (session('error_message'))
        <div class="alert alert-danger" role="alert">
            <p class="mb-0">{{ session('error_message') }}</p>
        </div>
    @endif

    <div class="mb-4">
        @if ($user->image !== "")
            <img src="{{ asset('/storage/user_images/'. $user->image) }}" style="height: 100;" class="d-block mx-auto">
        @endif
    </div>
    <div class="row pb-2 mb-2 border-bottom">
        <span class="col-md-4 col-form-label text-md-left fw-bold">氏名</span>
        <span class="col-md-8">{{ $user->name }}</span>
    </div>
    <div class="row pb-2 mb-2 border-bottom">
        <span class="col-md-4 col-form-label text-md-left fw-bold">メールアドレス</span>
        <span class="col-md-8">{{ $user->email }}</span>
    </div>
    <div class="row pb-2 mb-2 border-bottom">
        <span class="col-md-4 col-form-label text-md-left fw-bold">自己紹介</span>
        <span class="col-md-8">
            @if ($user->description !== null)
                {{ $user->description }}
            @else
                未設定
            @endif
        </span>
    </div>
    <div class="text-center">
        <div class="mb-3">
            <a class="text-reset text-decoration-none" href="{{route('mypage.edit')}}" >マイページ編集</a>
        </div>

        <div class="mb-3">
            <a class="text-reset text-decoration-none" href="{{ route('items.follow') }}">フォロー食材一覧</a>
        </div>

        <div class="mb-3">
            <a class="text-reset text-decoration-none" href="{{ route('users.favorite') }}">お気に入り投稿一覧</a>
        </div>

        <div  class="mb-3">
            <a class="text-reset text-decoration-none" href="{{ route('users.delete') }}">アカウント削除</a>
        </div>
    </div>
</div>
@endsection
