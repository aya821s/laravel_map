@extends('layouts.app')

@section('content')
    <h1>会員情報の編集</h1>
    <form method="POST" action="{{ route('mypage') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_method" value="PUT">
        <div class="form-group">
            <div>
                <label for="name">氏名</label>
            </div>
            <div>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>氏名を入力してください</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <div>
                <label for="email">メールアドレス</label>
            </div>
            <div>
                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email" autofocus>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>メールアドレスを入力してください</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <div>
                <label for="description">自己紹介</label>
            </div>
            <div>
                <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ $user->description }}">
                @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>自己紹介を入力してください</strong>
                </span>
                @enderror
            </div>
        </div>

        <div>
            <label for="image">画像</label>
            <input name="image" type="file">
        </div>

        <button type="submit">
            保存
        </button>
    </form>
@endsection
