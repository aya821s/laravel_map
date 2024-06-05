@extends('layouts.app')

@section('content')
    <h1> {{$store->name}}</h1>

    @if ($store->image !== "")
        <img src="{{ asset($store->image) }}" width="200" height="150">
    @endif

    <div>
        {{$store->description}}
    </div>

    <div>
        <strong>営業時間</strong>
        <div>
            <span>
                {{ date('G:i', strtotime($store->opening_time)) }}〜{{ date('G:i', strtotime($store->closing_time)) }}
            </span>
        </div>
    </div>

    <div>
        <strong>住所</strong>
        <div>
            <span>
                〒{{ substr($store->postal_code, 0, 3) . '-' . substr($store->postal_code, 3) }}
                <br>
                {{ $store->address }}
            </span>
        </div>
    </div>

    <div>
        <strong>電話番号</strong>
        <div>
            <span>
                {{ $store->phone_number }}
            </span>
        </div>
    </div>

    <div>
        <strong>定休日</strong>
        <div>
            <span>
                {{ $store->holidays }}
            </span>
        </div>
    </div>

    <div>
        <strong>ホームページ</strong>
        <div>
            <span>
                {{ $store->homepage }}
            </span>
        </div>
    </div>
@endsection
