@extends('layouts.app')

@section('content')
<div class="pb-5">
    <p class="text-black-50 text-right">更新：{{ ($created_at) }}</p>
    <canvas id="dailyChart" class="pb-5"></canvas>
    <canvas id="monthlyChart" class="pb-3"></canvas>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>

@php
    $average_price = json_encode($average_price);
    $high_price = json_encode($high_price);
    $low_price = json_encode($low_price);
    $days = json_encode($days);
    $m_average_price = json_encode($m_average_price);
    $m_high_price = json_encode($m_high_price);
    $m_low_price = json_encode($m_low_price);
    $month = json_encode($month);
@endphp

<script>
    const averagePrices = JSON.parse('<?php echo $average_price; ?>');
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
                data: averagePrices,
                borderColor: "#00B555",
                backgroundColor: "rgba(0,0,0,0)"
                },
                {
                label: '最高価格(円）',
                data: highPrices,
                borderColor: "#E61466",
                backgroundColor: "rgba(0,0,0,0)"
                },
                {
                label: '最低価格(円）',
                data: lowPrices,
                borderColor: "#007EFF",
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
    const m_average = JSON.parse('<?php echo $m_average_price; ?>');
    const m_high = JSON.parse('<?php echo $m_high_price; ?>');
    const m_low = JSON.parse('<?php echo $m_low_price; ?>');
    const month = JSON.parse('<?php echo $month; ?>');

    var ctx = document.getElementById("monthlyChart");
    var monthlyChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: month,
            datasets: [
                {
                label: '平均価格(円）',
                data: m_average,
                borderColor: "#00B555",
                backgroundColor: "rgba(0,0,0,0)"
                },
                {
                label: '最高価格(円）',
                data: m_high,
                borderColor: "#E61466",
                backgroundColor: "rgba(0,0,0,0)"
                },
                {
                label: '最低価格(円）',
                data: m_low,
                borderColor: "#007EFF",
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
