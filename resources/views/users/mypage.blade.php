@extends('layouts.app')

@section('content')
<div class="mb-1">
    <a href="{{ route('top') }}" class="green-link">トップ</a> > マイページ
</div>
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
            <img src="{{ asset('/images/user_images/'. $user->image) }}" style="height: 100px;" class="d-block mx-auto">
        @endif
    </div>
    <div class="row pb-2 mb-2 border-bottom d-flex align-items-center">
        <div class="col-md-4 col-form-label text-md-left fw-bold">氏名</div>
        <div class="col-md-8">{{ $user->name }}</div>
    </div>
    <div class="row pb-2 mb-2 border-bottom d-flex align-items-center">
        <div class="col-md-4 col-form-label text-md-left fw-bold">メールアドレス</div>
        <div class="col-md-8">{{ $user->email }}</div>
    </div>
    <div class="row pb-2 mb-2 border-bottom d-flex align-items-center">
        <div class="col-md-4 col-form-label text-md-left fw-bold">自己紹介</div>
        <div class="col-md-8">
            @if ($user->description !== null)
                {{ $user->description }}
            @else
                未設定
            @endif
        </div>
    </div>
    <div class="text-center green-link">
        <div class="m-4">
            <a class="text-reset text-decoration-none" href="{{route('mypage.edit')}}" >マイページ編集</a>
        </div>
        <div class="mb-4">
            <a class="text-reset text-decoration-none" href="{{ route('users.favorite') }}">お気に入り投稿一覧</a>
        </div>
        <div  class="mb-2">
            <a class="text-reset text-decoration-none" href="{{ route('users.delete') }}">アカウント削除</a>
        </div>
    </div>
</div>
@endsection
