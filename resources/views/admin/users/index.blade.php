@extends('layouts.app')

@section('content')
    <div class="col-10">
        <form action="{{ route('admin.users.index') }}" method="GET" class="row g-1">
            <div class="col-auto">
                <input class="form-control" name="keyword">
            </div>
            <div class="col-auto">
                <button class="btn" type="submit">検索</button>
            </div>
        </form>

        @if ($keyword !== null)
            <p>"{{ $keyword }}"の検索結果{{$total_count}}件</p>
        @endif

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">氏名</th>
                    <th scope="col">メールアドレス</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td><a href="{{ route('admin.users.show', $user) }}">詳細</a></td>
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
