@extends('layouts.app')

@section('content')
<div class="col-10">
<h1>新規登録</h1>
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="name">店舗名</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" autofocus>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>店舗名を入力してください</strong>
                </span>
            @enderror
        </div>

        <div>
            <label for="description">説明</label>
            <textarea id="description" name="description" type="text" class="form-control"></textarea>
        </div>

        <div>
            <label for="opening_time">営業時間</label>
            <input id="opening_time" name="opening_time" type="text" class="form-control">〜<input id="closing_time" name="closing_time" type="text" class="form-control">
        </div>

        <div>
            <label for="postal_code">郵便番号</label>
            <input id="postal_code" name="postal_code" type="text" class="form-control">
        </div>

        <div>
            <label for="address">住所</label>
            <input id="address" name="address" type="text" class="form-control">
        </div>

        <div>
            <label for="phone_number">電話番号</label>
            <input id="phone_number" name="phone_number" type="text" class="form-control">
        </div>

        <div>
            <label for="holidays">定休日</label>
            <input id="holidays" name="holidays" type="text" class="form-control">
        </div>

        <div>
            <label for="homepage">ホームページ</label>
            <input id="homepage" name="homepage" type="text" class="form-control">
        </div>

        <div>
            <label for="latitude">経度</label>
            <input id="latitude" name="latitude" type="text" class="form-control">
        </div>


        <div>
            <label for="longitude">緯度</label>
            <input id="longitude" name="longitude" type="text" class="form-control">
        </div>

        <div>
            <label for="image">画像</label>
            <input name="image" type="file" class="form-control">
        </div>

        <button type="submit" class="btn">
            保存
        </button>
    </form>
</div>
@endsection
