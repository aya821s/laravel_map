@extends('layouts.app')

@section('content')
    <h1>食材一覧</h1>

    <form action="{{ route('admin.items.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-5">
                <input class="form-control"type="text" id="name" name="name"  placeholder="食材名">
            </div>
            <div class="col-5">
                <input class="form-control" name="image" type="file">
            </div>
            <div class="col-2">
                <button class="btn unfollow-btn" type="submit">新規登録</button>
            </div>
        </div>
    </form>


    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">食材名</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr>
            <td>{{$item->id}}</td>
            <td>{{$item->name}}</td>
            <td>
                <a href="{{ route('admin.items.edit', $item) }}">編集</a>
            </td>
            <td>
                <form action="{{ route('admin.items.destroy', $item) }}" method="POST" onsubmit="return confirm('本当に削除してもよろしいですか？');">
                    @csrf
                    @method('DELETE')
                    <button type="submit">削除</button>
                </form>
            </td>
    @endforeach
    </tbody>
    </table>
@endsection
