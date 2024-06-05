@extends('layouts.app')

@section('content')
    <h1>食材一覧</h1>
    <form action="{{ route('items.store') }}" method="POST">
        @csrf
        <div>
            <input type="text" id="name" name="name">
            <button type="submit">＋新規登録</button>
        </div>
    </form>
    @foreach($items as $item)
        <div>
            <a href="{{ route('items.show', $item) }}"><h2>{{$item->name}}</h2></a>

            @if(Auth::user()->follow_items()->where('item_id', $item->id)->exists())
                <form action="{{ route('follows.destroy', $item->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit">フォロー解除</button>
                </form>
            @else
                <form action="{{ route('follows.store', $item->id) }}" method="post">
                    @csrf
                    <button type="submit">フォローする</button>
                </form>
            @endif

        </div>
    @endforeach
@endsection
