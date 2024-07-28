@extends('layouts.app')

@section('content')
<div class="mb-1">
    <a href="{{ route('top') }}" class="green-link">トップ</a> > <a href="{{ route('mypage') }}" class="green-link">マイページ</a> > アカウント削除
</div>
<div class="my-3 text-center">
    <h1>退会の確認</h1>
    <p class="my-4">一度退会するとデータはすべて削除され、復旧はできません。</p>
    <form method="POST" action="{{ route('mypage.destroy') }}" onsubmit="return confirm('本当に退会しますか？');">
        @csrf
        <input type="hidden" name="_method" value="DELETE">
        <button type="submit" class="btn green-btn">退会する</button>
    </form>
</div>
@endsection
