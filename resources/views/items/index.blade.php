<div>
    <h1>食材一覧（→ フォローできるようにする）</h1>
    @foreach($items as $item)
        <div>
            <a href="{{ route('items.show', $item) }}"><h2>{{$item->name}}</h2></a>
        </div>
    @endforeach
</div>
