@extends('layouts.app')

@section('content')
<div class="col-10">
    <h1>投稿編集</h1>
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('admin.posts.edit', $post) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div>
            <label for="price">価格</label>
            <input id="price" name="price" type="price" value="{{ old('price', $post->price) }}">
        </div>
        <div>
            <label for="is_soldout">売り切れてました</label>
            <input id="is_soldout" name="is_soldout" type="checkbox" value=1  value="{{ old('is_soldout', $post->is_soldout) }}">
        </div>
        <div>
            <label for="description">コメント</label>
            <textarea id="description" name="description" value="{{ old('description', $post->description) }}"></textarea>
        </div>
        <div>
            <label for="image">画像</label>
            <input name="image" type="file">
        </div>
        <div>
            <label for="is_anonymous">匿名にしない</label>
            <input id="is_anonymous" name="is_anonymous" type="checkbox" value=1  value="{{ old('is_anonymous', $post->is_anonymous) }}">
        </div>
        <br>
        <button type="submit" class="btn">編集</button>
    </form>
</div>
@endsection
