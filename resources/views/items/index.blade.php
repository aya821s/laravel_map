<div>
    @foreach($items as $item)
        <div>
            <h2>{{$item->name}}</h2>
            <a href="{{ route('items.show', $item) }}"></a>
        </div>
    @endforeach
</div>
