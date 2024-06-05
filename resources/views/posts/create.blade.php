@extends('layouts.app')

@section('content')
    <h1>新規投稿</h1>
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="price">価格</label>
            <input id="price" name="price" type="price">
        </div>
        <div>
            <label for="is_soldout">売り切れてました</label>
            <input id="is_soldout" name="is_soldout" type="checkbox" value=1>
        </div>
        <div>
            <label for="description">コメント</label>
            <textarea id="description" name="description"></textarea>
        </div>
        <div>
            <label for="description">画像</label>
            <input name="image" type="file">
        </div>
        <div>
            <label for="is_anonymous">匿名にしない</label>
            <input id="is_anonymous" name="is_anonymous" type="checkbox" value=1>
        </div>
        <br>
        <button type="submit">投稿</button>
    </form>
@endsection
