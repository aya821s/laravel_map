@extends('layouts.app')

@section('content')
    <div class="col-10">
            <form action="{{ route('admin.stores.index') }}" method="GET" class="row">
                <div class="col-9">
                    <input class="form-control" name="keyword">
                </div>
                <div class="col-3">
                    <button class="btn" type="submit">検索</button>
                </div>
            </form>
            <div class="my-2">
                <a href="{{ route('admin.stores.create') }}" class="text-reset text-decoration-none">＋新規店舗登録</a>
            </div>
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
@endsection

