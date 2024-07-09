@extends('layouts.app')

@section('content')


  <canvas id="myLineChart"></canvas>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>

    @php
        $post_json = json_encode($posts);
    @endphp

  <script>
    const posts = JSON.parse('<?php echo $post_json; ?>');
    var avaragePrices = [];
    var highPrices = [];
    var lowPrices = [];

    var days = new Set(); // Set を使用して重複のない日付を保持する

    // 日付ごとに価格を集計するためのオブジェクト
    var dailyPrices = {};

    for (let i = 0; i < posts.length; i++) {
        const eachPost = Object.values(posts[i]);
        const price = eachPost[2];
        const date = new Date(eachPost[5]);
        const m = date.getMonth() + 1;
        const d = date.getDate();
        const dateString = m + '/' + d;

        // 日付ごとに価格を集計する
        if (!dailyPrices[dateString]) {
            dailyPrices[dateString] = {
                prices: [],
                high: -Infinity,
                low: Infinity,
                count: 0
            };
        }

        if (price > dailyPrices[dateString].high) {
            dailyPrices[dateString].high = price;
        }
        if (price < dailyPrices[dateString].low) {
            dailyPrices[dateString].low = price;
        }

        dailyPrices[dateString].prices.push(price);
        dailyPrices[dateString].count++;

        // 日付をSetに追加することで重複を避ける
        days.add(dateString);
    }
    // console.log(dailyPrices);

    for (const day in dailyPrices) {
        if (dailyPrices.hasOwnProperty(day)) {
            const total = dailyPrices[day].prices.reduce((acc, curr) => acc + curr, 0);
            const averagePrice = total / dailyPrices[day].count;
            const roundedAveragePrice = Math.round(averagePrice);
            avaragePrices.push(roundedAveragePrice);
        }
    }

    for (const day in dailyPrices) {
        if (dailyPrices.hasOwnProperty(day)) {
            highPrices.push(dailyPrices[day].high);
        }
        if (dailyPrices.hasOwnProperty(day)) {
            lowPrices.push(dailyPrices[day].low);
        }
    }

    // Set を配列に変換して日付の配列を完成させる
    days = Array.from(days);
    // console.log(highPrices);

    var ctx = document.getElementById("myLineChart");
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: days,
            datasets: [
                {
                label: '平均価格(円）',
                data: avaragePrices,
                borderColor: "green",
                backgroundColor: "rgba(0,0,0,0)"
                },
                {
                label: '最高価格(円）',
                data: highPrices,
                borderColor: "red",
                backgroundColor: "rgba(0,0,0,0)"
                },
                {
                label: '最低価格(円）',
                data: lowPrices,
                borderColor: "blue",
                backgroundColor: "rgba(0,0,0,0)"
                }
      ],
    },
    options: {
      title: {
        display: true,
        text: '{{ $item->name }}の価格推移'
      },
      scales: {
        yAxes: [{
          ticks: {
            suggestedMax: 450,
            suggestedMin: 80,
            stepSize: 20,
            callback: function(value, index, values){
              return  value +  '円'
            }
          }
        }]
      },
    }
  });
  </script>
@endsection
