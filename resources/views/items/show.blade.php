<div>
    <h1>{{$item->name}}の価格マップ</h1>
    @foreach($stores as $store)
        <div>
            <a href="{{ route('stores.show', $store) }}"><h2>{{$store->name}}</h2></a>
        </div>
        <div>
            @foreach($posts as $post)
                @if  ($post->item_store_id == $store->id)
                    <div style="background: lightgrey;">
                    @if ($post->is_soldout == 1)
                        <p style="color: red;">売り切れです！</p>
                    @endif

                    <h2>{{ $post->price }}円</h2>

                    @if ($post->image !== "")
                        <img src="{{ asset('/storage/post_images/'. $post->image) }}" style="width: 250;">
                    @endif

                    <p>{{ $post->description }}</p>

                    <p>{{ $post->created_at}}</p>

                    @if ($post->is_anonymous !== 1)
                        <p>by 匿名ユーザー</p>
                    @else
                        <p>by {{ $post->user->name }}</p>
                    @endif
                    </div>
                @endif
            @endforeach
            <hr>
        </div>
    @endforeach
</div>
