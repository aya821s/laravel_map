<!DOCTYPE html>
<html>
<head>
    <title>新しい口コミが投稿されました</title>
</head>
<body>
    <h1>{{ $post->item->name }}に関する、新しい口コミが投稿されました</h1>
    @if ($post->is_soldout == 1)
        <p>{{ $post->store->name }}の{{ $post->item->name }}は売り切れです。</p>
    @else
        <p>{{ $post->store->name }}の{{ $post->item->name }}は{{ $post->price }}円です。</p>
        <p>コメント：{{ $post->description }}</p>
    @endif

    <p>{{ $post->created_at}}
        @if ($post->is_anonymous !== 1)
            <p>by匿名ユーザー</p>
        @else
            <p>by{{ $post->user->name }}</p>
    </p>
    @endif

    {{-- itemページのURLを追加する --}}
</body>
</html>
