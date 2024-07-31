@extends('layouts.app')

@section('content')
    <div class="main-container">
        <div class="auth-container">
            <h1 class="text-center">ログイン</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="py-2">
                    <input class="form-control" type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="メールアドレス" autofocus>
                </div>

                <!-- Password -->
                <div class="py-2">
                    <input class="form-control" type="password" id="password" name="password" required autocomplete="new-password" placeholder="パスワード">
                </div>

                <!-- Remember Me -->
                <div class="pt-1 pb-2">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                        <span class="ms-2 text-sm text-gray-600">{{ __('次回から自動的にログインする') }}</span>
                    </label>
                </div>

                <div class="py-2 auth-contents">
                    <button type="submit" class="btn text-white green-btn">ログイン</button>
                </div>
            </form>

            <!-- Register -->

            <div class="auth-contents py-2">
                <a class="green-link" href="{{ route('register') }}">新規会員登録はこちら</a>
            </div>

            @if (Route::has('password.request'))
                <div class="auth-contents py-2">
                    <a class="green-link" href="{{ route('password.request') }}">{{ __('パスワードをお忘れの方はこちら') }}</a>
                </div>
            @endif

            <div class="auth-contents py-2">
                <a class="text-secondary text-decoration-none" href="{{ route('admin.login') }}">管理者はこちら</a>
            </div>
        </div>
    </div>
@endsection


