@extends('layouts.app')

@section('content')
    <div class="col-10 mb-5">
        <form action="{{ route('admin.stores.index') }}" method="GET" class="row align-items-center">
            <div class="col-9">
                <input class="form-control" name="keyword" placeholder="店舗名やキーワードを入力">
            </div>
            <div class="col-3 d-flex justify-content-between">
                <button class="btn" type="submit">検索</button>
                <a href="{{ route('admin.stores.create') }}" class="btn">＋新規店舗登録</a>
            </div>
        </form>
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
                        <td><a href="{{ route('admin.stores.show', $store) }}" class="green-link">詳細</a></td>
                        <td><a href="{{ route('admin.stores.edit', $store) }}" class="green-link">編集</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div>
            Sort By
            @sortablelink('id', 'ID', null, ['style' => 'color: green;'])
        </div>
    </div>
@endsection

