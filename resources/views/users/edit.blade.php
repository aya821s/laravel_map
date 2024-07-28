@extends('layouts.app')

@section('content')
<div class="mb-1">
    <a href="{{ route('top') }}" class="green-link">トップ</a> > <a href="{{ route('mypage') }}" class="green-link">マイページ</a> > マイページ編集
</div>
<div class="mypage-container">
    <div class="text-center">
        <h1>会員情報の編集</h1>
        <div class="mb-3">
            @if ($user->image !== "")
                <img src="{{ asset('/storage/user_images/'. $user->image) }}" style="height: 100px; width: auto;" class="d-block mx-auto">
            @endif
        </div>
        <form method="POST" action="{{ route('mypage') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group row mb-3">
                <label for="name" class="col-md-4 col-form-label text-md-left fw-bold">氏名</label>
                <div class="col-md-8">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>氏名を入力してください</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="email" class="col-md-4 col-form-label text-md-left fw-bold">メールアドレス</label>
                <div class="col-md-8">
                    <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email" autofocus>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>メールアドレスを入力してください</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="description" class="col-md-4 col-form-label text-md-left fw-bold">自己紹介</label>
                <div class="col-md-8">
                    <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" required autocomplete="description" autofocus>{{ $user->description }}</textarea>
                    @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>自己紹介を入力してください</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="image" class="col-md-4 col-form-label text-md-left fw-bold">画像</label>
                <div class="col-md-8">
                    <input name="image" type="file" class="form-control">
                </div>
            </div>
            <button type="submit" class="btn unfollow-btn mt-2">
                保存
            </button>
        </form>
    </div>
</div>
@endsection
