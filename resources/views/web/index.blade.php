@extends('layouts.app')

@section('content')
    <a href="{{ route('mypage') }}">マイページ</a>
    <br>
    <a href="{{ route('mypage.edit') }}">マイページ編集</a>
    <br>
    <a href="{{ route('items.index') }}">食材の選択</a>
    <br>
    <a href="{{ route('stores.index') }}">（店舗一覧）</a>
    <br>
    <a href="{{ route('posts.index') }}">（投稿一覧）</a>

    <br>
    <a href="{{ route('admin.login') }}">管理画面にログイン</a>
@endsection
