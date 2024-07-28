@extends('layouts.app')

@section('content')
<div class="col-sm-4 text-center px-4">
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
        <h3>フォローしている食材</h3>
        <div class="row text-center">
            @foreach ($follow_items as $follow_item)
                <div class="p-1">
                    <div class="main-item-card px-1 py-3">
                        <a class="text-reset text-decoration-none" href="{{ route('items.show', $follow_item) }}">
                            @if ($follow_item->image !== "")
                                <img class="d-block mx-auto" src="{{ asset('/storage/item_images/'. $follow_item->image) }}" style="height: 100;">
                            @endif
                            <p class="my-2">{{$follow_item->name}}</p>
                        </a>
                    </div>
                </div>
            @endforeach
            <div class="p-1">
                <a class="text-reset text-decoration-none" href="{{ route('items.index') }}">
                    <div class="main-item-card px-1 py-3 align-items-center d-flex justify-content-center">
                        <div class="text-center">
                            <div class="d-flex flex-column align-items-center">
                                <span>他の食材を</span>
                                <span>フォローする</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    @endif
</div>
<div class="col-sm-6 text-center px-4">
    <h3 class="pb-1">最新の投稿</h3>
    @if ($posts->isEmpty())
        <p>投稿はありません。</p>
    @else
        @foreach ($posts as $post)
            <div class="card mb-2 main-card-bg">
                <div class="row mt-2 mx-2">
                    <div class="col-sm-3 d-flex align-items-center">
                        <div class="card-img flex-shrink-0">
                            @if ($post->image !== "")
                                <img src="{{ asset('/storage/post_images/'. $post->image) }}">
                            @else ($post->store->image !== "")
                                <img src="{{ asset('/storage/store_images/'. $post->store->image) }}">
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <div class="card-title">
                            {{ $post->store->name }}の{{ $post->item->name }}
                        </div>
                        <div class="d-flex justify-content-center">
                            <h2>{{ $post->price }}<span class="fs-6">円</span></h2>
                            @if ($post->is_soldout == 1)
                                <p style="color: red;">　売り切れです！</p>
                            @endif
                        </div>
                        <div class="card-text">
                            <p>{{ $post->description }}</p>
                        </div>
                        <div class="d-flex justify-content-center text-secondary">
                            <p>{{ $post->created_at->format('Y/m/d H:i') }}</p>
                            @if ($post->is_anonymous !== 1)
                                <p>　by 匿名ユーザー</p>
                            @else
                                <p>　by {{ $post->user->name }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
<div class="col-sm-2 text-center">
    @if(isset($weatherData->Feature))
    <?php
    // 開始時間をCarbonオブジェクトに変換
    $startDateTime = \Carbon\Carbon::createFromFormat('YmdHi', $weatherData->Feature->Property->WeatherList->Weather[0]->Date);
    // 終了時間を計算してCarbonオブジェクトに変換
    $endDateTime = $startDateTime->copy()->addMinutes(60);
    ?>

    <p>{{ $startDateTime->format('n/j G:i') }}から<br>60分間の降水量予報</p>
    <table class="table table-bordered">
        @foreach($weatherData->Feature->Property->WeatherList->Weather as $weather)
                <?php
                    // 日付をCarbonオブジェクトにパースする
                    $dateTime = \Carbon\Carbon::createFromFormat('YmdHi', $weather->Date);
                ?>

                <tr>
                    <td>{{ $dateTime->format('H:i') }}</td>
                    <td>{{ $weather->Rainfall }} mm　
                        <span>
                            @if ($weather->Rainfall > 0)
                                <i class="fas fa-umbrella" style="color: blue;"></i>
                            @else
                                <i class="far fa-smile" style="color: rgb(239, 112, 21);"></i>
                            @endif
                        </span>
                    </td>
                </tr>
        @endforeach
    </table>
    @else
        <p>気象情報を取得できませんでした。</p>
    @endif
</div>
@endsection
