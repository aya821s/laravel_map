@extends('layouts.app')

@section('content')

バッチ処理されたグラフ
  <canvas id="myLineChart"></canvas>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>

    <script>
    var avaragePrices = [];
    var highPrices = [];
    var lowPrices = [];

    days = Array.from(days);

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
