<div>
    <h1>食材一覧</h1>

    <form action="{{ route('admin.items.store') }}" method="POST">
        @csrf
        <div>
            <input type="text" id="name" name="name">
            <button type="submit">＋新規登録</button>
        </div>
    </form>

    @foreach($items as $item)
        <div>
            <p>{{$item->id}}</p>
            <p>{{$item->name}}</p>
            <a href="{{ route('admin.items.edit', $item) }}">編集</a>

            <form action="{{ route('admin.items.destroy', $item) }}" method="POST" onsubmit="return confirm('本当に削除してもよろしいですか？');">
                @csrf
                @method('DELETE')
                <button type="submit">削除</button>
            </form>
        </div>
    @endforeach
</div>
