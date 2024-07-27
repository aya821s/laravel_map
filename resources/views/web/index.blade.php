@extends('layouts.app')

@section('content')
<div class="col-sm-6">
    {{-- <a href="{{ route('mypage') }}">マイページ</a>
    <a href="{{ route('mypage.edit') }}">マイページ編集</a>
    <a href="{{ route('items.index') }}">食材の選択</a>
    <a href="{{ route('admin.login') }}">管理画面にログイン</a> --}}
    <div class="container">
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
            <p>フォローしている食材</p>
            <div class="row text-center">
                @foreach ($follow_items as $follow_item)
                    <div class="col-3 p-1">
                        <div class="item-card px-1 py-3">
                            <a class="text-reset text-decoration-none" href="{{ route('items.show', $follow_item) }}">
                                @if ($follow_item->image !== "")
                                    <img class="d-block mx-auto" src="{{ asset('/storage/item_images/'. $follow_item->image) }}" style="height: 100;">
                                @endif
                                <p>{{$follow_item->name}}</p>
                            </a>
                            {{-- <form action="{{ route('follows.destroy', $follow_item->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn unfollow-btn">フォロー解除</button>
                            </form> --}}
                        </div>
                    </div>
                @endforeach
                <div class="col-3 p-1">
                    <div class="item-card">
                        <div class="text-center py-5">
                            <a class="text-reset text-decoration-none" href="{{ route('items.index') }}">他の食材を<br>フォローする</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
<div class="col-sm-6 text-center">
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
                                <i class="far fa-smile" style="color: rgb(239, 21, 178);"></i>
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
