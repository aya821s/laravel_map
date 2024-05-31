@if (session('flash_message'))
        <div role="alert">
             <p>{{ session('flash_message') }}</p>
        </div>
@endif

@if ($follow_items->isEmpty())
    <a href="{{ route('items.index') }}">
        食材をフォローしよう！
    </a>
@else

    @foreach ($follow_items as $follow_item)
        <a href="{{ route('items.show', $follow_item) }}">
            {{ $follow_item->name }}
        </a>
        <form action="{{ route('follows.destroy', $follow_item->id) }}" method="post">
            @csrf
            @method('delete')
            <button type="submit">フォロー解除</button>
        </form>
    @endforeach
@endif
