<div>
    <div>
    <form action="{{ route('admin.stores.index') }}" method="GET">
        <input class="form-control" name="keyword">
        <button type="submit">検索</button>
    </form>
    </div>
    <a href="{{ route('admin.stores.create') }}">＋新規登録</a>


    @if ($keyword !== null)
        <p>"{{ $keyword }}"の検索結果{{$total_count}}件</p>
    @endif

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">店舗名</th>
                <th scope="col">住所</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($stores as $store)
                <tr>
                    <td>{{$store->id}}</td>
                    <td>{{$store->name}}</td>
                    <td>{{$store->address}}</td>
                    <td><a href="{{ route('admin.stores.show', $store) }}">詳細</a></td>
                    <td><a href="{{ route('admin.stores.edit', $store) }}">編集</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div>
        Sort By
        @sortablelink('id', 'ID')
    </div>
</div>

