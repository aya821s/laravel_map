@extends('layouts.app')

@section('content')
    <div class="auth-container">
        <h1 class="text-center">新規会員登録</h1>
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="py-1">
                <label for="name">氏名（必須）</label>
                <input class="form-control" type="text" id="name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="価格 太郎">
            </div>

            <!-- Email Address -->
            <div class="py-1">
                <label for="email">メールアドレス（必須）</label>
                <input class="form-control" type="email" id="email" name="email" :value="old('email')" required autocomplete="email" placeholder="taro.kakaku@example.com" />
            </div>

            <!-- Password -->
            <div class="py-1">
                <label for="password">パスワード（必須）</label>
                <input class="form-control"  id="password" type="password" name="password" required autocomplete="new-password">
            </div>

            <!-- Confirm Password -->
            <div class="py-1">
                <label for="password_confirmation">パスワードを再入力（必須）</label>
                <input class="form-control" id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">
            </div>

            <!-- Already Registered -->
            <div class="auth-contents py-1">
                <a class="green-link" href="{{ route('login') }}">すでに登録済みの方はこちら</a>
            </div>

            <!-- Register -->
            <div class="py-1">
                <button type="submit" class="btn text-white w-100 green-btn">登録</button>
            </div>
        </form>
    </div>
@endsection
