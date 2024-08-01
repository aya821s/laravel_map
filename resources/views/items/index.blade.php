@extends('layouts.app')

@section('content')
    <div class="text-center mb-5">
        <h1>気になる食材を、フォローしよう！</h1>
        <div class="row">
            @foreach($items as $item)
                <div class="col-3 p-1">
                    <div class="item-card px-1 py-3">
                        <a class="text-reset text-decoration-none" href="{{ route('items.show', $item) }}">
                            @if ($item->image !== "")
                                <img class="d-block mx-auto" src="{{ asset('/images/item_images/'. $item->image) }}" style="height: 100;">
                            @endif
                            <p>{{$item->name}}</p>
                        </a>
                        @if(Auth::user()->follow_items()->where('item_id', $item->id)->exists())
                            <form action="{{ route('follows.destroy', $item->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn unfollow-btn" type="submit">フォロー解除</button>
                            </form>
                        @else
                            <form action="{{ route('follows.store', $item->id) }}" method="post">
                                @csrf
                                <button class="btn follow-btn" type="submit">フォローする</button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
            <div class="col-3 p-1">
                <div class="item-card px-1 py-3">
                    <div class="text-center">
                        <p>食材追加</p>
                        <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="pb-1">
                                <input class="form-control item-form" type="text" id="name" name="name" placeholder="食材名">
                            </div>
                            <div class="py-1">
                                <input class="form-control item-form" name="image" type="file">
                            </div>
                            <div class="py-1">
                                <button class="btn unfollow-btn" type="submit">新規登録</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
