@extends('layouts.app')

@section('content')
    <div class="container text-center">
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
            <div class="row">
                @foreach ($follow_items as $follow_item)
                    <div class="col-3 p-1">
                        <div class="item-card px-1 py-3">
                            <a class="text-reset text-decoration-none" href="{{ route('items.show', $follow_item) }}">
                                @if ($follow_item->image !== "")
                                    <img class="d-block mx-auto" src="{{ asset('/storage/item_images/'. $follow_item->image) }}" style="height: 100;">
                                @endif
                                <p>{{$follow_item->name}}</p>
                            </a>
                            <form action="{{ route('follows.destroy', $follow_item->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn unfollow-btn">フォロー解除</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
