@extends('layouts.app')

@section('content')
<form action="{{ route('admin.items.update', $item) }}" method="POST">
    @csrf
    @method('PATCH')
    <div>
        <input type="text" id="name" name="name" value="{{ old('name', $item->name) }}">
    </div>
    <button type="submit">更新</button>
</form>
@endsection
