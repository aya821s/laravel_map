@extends('layouts.app')

@section('content')
<div class="row p-5">
    <div class="col-sm-7 pt-5">
        <div class="fs-1">
            <p>普段の買い物を、スマートに</p>
        </div>
        <div class="pe-5 top_text">
            <p>食品の高騰に困っているあなたに、ぴったりのSNS。<br>お肉や野菜の価格を他のユーザーと共有し、いつもの買い物がさらに楽しくお得になります。登録ボタンをクリックして、今すぐ始めましょう！</p>
        </div>
        <a href="{{ route('register') }}" class="btn register_btn">今すぐ登録</a>
    </div>
    <div class="col-sm-5 pt3">
        <img src="{{asset('/images/top.jpg')}}" style="height: 450px;">
    </div>
</div>
@endsection
