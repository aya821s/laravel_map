<div>
    <h1>マイページ</h1>
    @if (session('flash_message'))
        <div class="alert alert-warning" role="alert">
            <p class="mb-0">{{ session('flash_message') }}</p>
        </div>
    @endif

    @if (session('error_message'))
        <div class="alert alert-danger" role="alert">
            <p class="mb-0">{{ session('error_message') }}</p>
        </div>
    @endif

    <div>
        <div>
            <span>氏名</span>
            <span>{{ $user->name }}</span>
        </div>
            <span>メールアドレス</span>
            <span>{{ $user->email }}</span>
        </div>
        <div>
            <span>自己紹介</span>
            <span>
                @if ($user->description !== null)
                    {{ $user->description }}
                @else
                    未設定
                @endif
            </span>
        </div>
    </div>
    <div>
        <a href="{{route('mypage.edit')}}">マイページ編集</a>
    </div>
</div>
