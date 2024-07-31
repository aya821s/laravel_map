@extends('layouts.app')

@section('content')
<div class="col-10">
    <h1>店舗情報の編集</h1>
    <form method="POST" action="{{ route('admin.stores.update', $store) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <div>
                <label for="name">店舗名</label>
            </div>
            <div>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $store->name }}" required autocomplete="name" autofocus>
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>店舗名を入力してください</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <div>
                <label for="description">説明</label>
            </div>
            <div>
                <input id="description" type="text" class="form-control" @error('description') is-invalid @enderror" name="description" value="{{ $store->description }}">
                @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>説明を入力してください</strong>
                </span>
                @enderror
            </div>
        </div>

        <div>
            <label for="opening_time">営業時間</label>
            <input id="opening_time" name="opening_time" type="text" class="form-control" value="{{ $store->opening_time }}">〜<input id="closing_time" name="closing_time" type="text" class="form-control" value="{{ $store->closing_time }}">
        </div>

        <div>
            <label for="postal_code">郵便番号</label>
            <input id="postal_code" name="postal_code" type="text" class="form-control" value="{{ $store->postal_code }}">
        </div>

        <div>
            <label for="address">住所</label>
            <input id="address" name="address" type="text" class="form-control" value="{{ $store->address }}">
        </div>

        <div>
            <label for="phone_number">電話番号</label>
            <input id="phone_number" name="phone_number" type="text" class="form-control" value="{{ $store->phone_number }}">
        </div>

        <div>
            <label for="holidays">定休日</label>
            <input id="holidays" name="holidays" type="text" class="form-control" value="{{ $store->holidays}}">
        </div>

        <div>
            <label for="homepage">ホームページ</label>
            <input id="homepage" name="homepage" type="text" class="form-control" value="{{ $store->homepage}}">
        </div>

        <div>
            <label for="latitude">緯度</label>
            <input id="latitude" name="latitude" type="text" class="form-control" value="{{ $store->latitude}}">
        </div>


        <div>
            <label for="longitude">経度</label>
            <input id="longitude" name="longitude" type="text" class="form-control" value="{{ $store->longitude}}">
        </div>

        <div>
            <label for="image">画像</label>
            <input name="image" type="file" class="form-control">
        </div>

        <button type="submit" class="btn mb-5">
            保存
        </button>
    </form>
</div>
@endsection
