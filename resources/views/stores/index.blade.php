@extends('layouts.app')

@section('content')
    @foreach($stores as $store)
        <div>
            <h2>{{$store->name}}</h2>
            <a href="{{ route('stores.show', $store) }}">店舗詳細</a>
        </div>
    @endforeach
@endsection
