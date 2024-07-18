@extends('layouts.app')

@section('content')
<div class="col-sm-10">
    {{-- <a href="{{ route('mypage') }}">マイページ</a>
    <a href="{{ route('mypage.edit') }}">マイページ編集</a>
    <a href="{{ route('items.index') }}">食材の選択</a>
    <a href="{{ route('admin.login') }}">管理画面にログイン</a> --}}
</div>
<div class="col-sm-2">
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
                    <td>{{ $weather->Rainfall }} mm</td>
                </tr>
        @endforeach
    </table>
    @else
        <p>気象情報を取得できませんでした。</p>
    @endif
</div>
@endsection
