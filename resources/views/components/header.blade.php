<nav class="navbar navbar-expand-md navbar-light header-bg">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">ログイン</a>
                    </li>
                    <li class="nav-item">
                         <a class="nav-link" href="{{ route('register') }}">登録</a>
                    </li>
                @elseif (Auth::guard('admin')->check())
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            管理者メニュー
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('admin.home') }}">ホーム</a>
                            <a class="dropdown-item" href="{{ route('admin.users.index') }}">会員一覧</a>
                            <a class="dropdown-item" href="{{ route('admin.stores.index') }}">店舗一覧</a>
                            <a class="dropdown-item" href="{{ route('admin.items.index') }}">食材一覧</a>
                            <a class="dropdown-item" href="{{ route('admin.posts.index') }}">投稿一覧</a>
                            <a class="dropdown-item" href="#">会社概要</a>
                            <a class="dropdown-item" href="#">利用規約</a>
                        <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('admin.logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                ログアウト
                            </a>
                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('mypage')}}">マイページ</a>
                            <a class="dropdown-item" href="{{route('mypage.edit')}}">マイページ編集</a>
                            <a class="dropdown-item" href="{{ route('items.follow') }}">フォロー食材一覧</a>
                            <a class="dropdown-item" href="{{ route('users.favorite') }}">お気に入り投稿一覧</a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                ログアウト
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
