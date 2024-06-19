@extends('layouts.app')

@section('content')
    <a href="{{ route('mypage') }}">マイページ</a>
    <a href="{{ route('mypage.edit') }}">マイページ編集</a>
    <a href="{{ route('items.index') }}">食材の選択</a>
    <a href="{{ route('admin.login') }}">管理画面にログイン</a>
@endsection
