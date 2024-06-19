@extends('layouts.app')

@section('content')
<div class="text-center d-block mx-auto admin-items">
    @if ($item->image !== "")
        <img class="d-block mx-auto my-3" src="{{ asset('/storage/item_images/'. $item->image) }}" style="height: 200;">
    @endif
    <form action="{{ route('admin.items.update', $item) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="row py-1">
            <div class="col-4">食材名</div>
            <div class="col-8">
                <input class="form-control" type="text" id="name" name="name" value="{{ old('name', $item->name) }}">
            </div>
        <div>
        <div class="row py-1">
            <div class="col-4">
                <label for="image">画像</label>
            </div>
            <div class="col-8">
                <input class="form-control"  name="image" type="file">
            </div>
        </div>
        <button class="btn green-btn my-2" type="submit">更新</button>
    </form>
</div>
@endsection
