@extends('layouts.app')

@section('content')
<div class="pb-5">
    <p class="text-black-50 text-right">更新：{{ ($created_at) }}</p>
    <canvas id="dailyChart"></canvas>
    <canvas id="monthlyChart"></canvas>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>

@php
    $average_price = json_encode($average_price);
    $high_price = json_encode($high_price);
    $low_price = json_encode($low_price);
    $days = json_encode($days);
@endphp

<script>
    const avaragePrices = JSON.parse('<?php echo $average_price; ?>');
    const highPrices = JSON.parse('<?php echo $high_price; ?>');
    const lowPrices = JSON.parse('<?php echo $low_price; ?>');
    const days = JSON.parse('<?php echo $days; ?>');

    var ctx = document.getElementById("dailyChart");
    var dailyChart = new Chart(ctx, {
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
            suggestedMax: 380,
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


//月別のグラフ
const monthly_data = JSON.parse('<?php echo $monthly_data_json; ?>');
const formatted_data = monthly_data.map(data => {
    return {
        year_month: `${data.year}/${('0' + data.month).slice(-2)}`,
        average_price: data.average_price,
        high_price: data.high_price,
        low_price: data.low_price,
    };
});

const y_m = formatted_data.map(data => data.year_month);
const m_average = formatted_data.map(data => data.average_price);
const m_high = formatted_data.map(data => data.high_price);
const m_low = formatted_data.map(data => data.low_price);

  var ctx = document.getElementById("monthlyChart");
    var monthlyChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: y_m,
            datasets: [
                {
                label: '平均価格(円）',
                data: m_average,
                borderColor: "green",
                backgroundColor: "rgba(0,0,0,0)"
                },
                {
                label: '最高価格(円）',
                data: m_high,
                borderColor: "red",
                backgroundColor: "rgba(0,0,0,0)"
                },
                {
                label: '最低価格(円）',
                data: m_low,
                borderColor: "blue",
                backgroundColor: "rgba(0,0,0,0)"
                }
      ],
    },
    options: {
      title: {
        display: true,
        text: '{{ $item->name }}の価格推移（月別）'
      },
      scales: {
        yAxes: [{
          ticks: {
            suggestedMax: 380,
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
