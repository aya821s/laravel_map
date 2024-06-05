@extends('layouts.app')

@section('content')
    @if (session('flash_message'))
        <div class="alert alert-warning" role="alert">
            <p class="mb-0">{{ session('flash_message') }}</p>
        </div>
    @endif

    @if (session('error_message'))
        <div class="alert alert-danger" role="alert">
            <p class="mb-0">{{ session('error_message') }}</p>
        </div>
    @endif

    <div>
        <div>
            <span>ID</span>
            <span>{{ $store->id }}</span>
        </div>
        @if ($store->image !== "")
            <img src="{{ asset('/storage/user_images/'. $user->image) }}" style="width: 250;">
        @endif
        <div>
            <span>店舗名</span>
            <span>{{ $store->name }}</span>
        </div>
            <span>住所</span>
            <span>{{ $store->address }}</span>
        </div>
        <div>
            <span>説明</span>
            <span>
                @if ($store->description !== null)
                    {{ $store->description }}
                @else
                    未設定
                @endif
            </span>
        </div>

        <div>
            <span>営業時間</span>
            <span>{{ date('G:i', strtotime($store->opening_time)) }}〜{{ date('G:i', strtotime($store->closing_time)) }}</span>
        </div>

        <div>
            <span>郵便番号</span>
            〒{{ substr($store->postal_code, 0, 3) . '-' . substr($store->postal_code, 3) }}
        </div>

        <div>
            <span>電話番号</span>
            <span>{{ substr($store->phone_number, 0, 2) . '-' . substr($store->phone_number, 2, 4) . '-' . substr($store->phone_number, 6) }}</span>
        </div>


        <div>
            <span>定休日</span>
            <span>{{ $store->holidays }}</span>
        </div>

        <div>
            <span>ホームページ</span>
            <span>{{ $store->homepage }}</span>
        </div>

        <div>
            <span>緯度</span>
            <span>{{ $store->latitude }}</span>
        </div>

        <div>
            <span>経度</span>
            <span>{{ $store->longitude }}</span>
        </div>


        <div><a href="{{ route('admin.stores.edit', $store) }}">編集</a></div>
        <form class="text-center" method="POST" action="{{ route('admin.stores.destroy') }}" onsubmit="return confirm('本当に削除しますか？');">
            @csrf
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit">削除</button>
        </form>
    </div>
@endsection
