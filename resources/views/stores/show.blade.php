@extends('layouts.app')

@section('content')

<h1>{{ $store->name }}の価格推移</h1>
{{-- <h1>{{ $store->name }}の{{ $item->name }}の価格推移</h1> --}}
  <canvas id="myLineChart"></canvas>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>

    @php
        $store_json = json_encode($store);
        $post_json = json_encode($posts);
    @endphp

  <script>
    const store = JSON.parse('<?php echo $store_json; ?>');
    const posts = JSON.parse('<?php echo $post_json; ?>');
    const storePosts = posts.filter(post => post.store_id === store.id);
    var prices = [];
    var days =  [];
    for(let i = 0; i < storePosts.length; i++) {
        const eachPost = Object.values(storePosts[i]);
        const price = eachPost[2];
        prices.push(price)

        const date = new Date(eachPost[5]);
        const m = date.getMonth() + 1;
        const d = date.getDate();
        const dateString = m + '/' + d;
        days.push(dateString)
        console.log(dateString);
    }

    var ctx = document.getElementById("myLineChart");
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: days,
            datasets: [
                {
                label: '価格(円）',
                data: prices,
                borderColor: "green",
                backgroundColor: "rgba(0,0,0,0)"
                }
      ],
    },
    options: {
      title: {
        display: true,
        text: '価格推移'
      },
      scales: {
        yAxes: [{
          ticks: {
            suggestedMax: 40,
            suggestedMin: 0,
            stepSize: 10,
            callback: function(value, index, values){
              return  value +  '円'
            }
          }
        }]
      },
    }
  });
  </script>
    {{-- <h1> {{$store->name}}</h1>

    @if ($store->image !== "")
        <img src="{{ asset('/storage/store_images/'. $store->image) }}" width="200">

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
    </div> --}}
@endsection
