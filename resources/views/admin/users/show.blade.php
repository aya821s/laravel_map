<div>
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
            <span>ID</span>
            <span>{{ $user->id }}</span>
        </div>
        @if ($user->image !== "")
            <img src="{{ asset('/storage/user_images/'. $user->image) }}" style="width: 250;">
        @endif
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
        <form class="text-center" method="POST" action="{{ route('admin.users.destroy') }}" onsubmit="return confirm('本当に削除しますか？');">
            @csrf
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit" >削除</button>
        </form>
    </div>
</div>
