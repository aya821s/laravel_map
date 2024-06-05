@extends('layouts.app')

@section('content')
    <div>
    <a href="{{ route('admin.users.index') }}">会員一覧</a>
    <br>
    <a href="{{ route('admin.stores.index') }}">店舗一覧</a>
    <br>
    <a href="{{ route('admin.items.index') }}">食材一覧</a>
    <br>
    <a href="{{ route('admin.posts.index') }}">投稿一覧</a>
    </div>
@endsection
