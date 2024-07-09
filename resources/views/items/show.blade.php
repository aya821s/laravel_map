@extends('layouts.app')

@section('content')
<head>
    <meta charset="utf-8" />
    <title>Add custom markers in Mapbox GL JS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link
      href="https://fonts.googleapis.com/css?family=Open+Sans"
      rel="stylesheet"
    />
    <script src="https://api.tiles.mapbox.com/mapbox-gl-js/v3.3.0/mapbox-gl.js"></script>
    <link
      href="https://api.tiles.mapbox.com/mapbox-gl-js/v3.3.0/mapbox-gl.css"
      rel="stylesheet"
    />
    {{-- Chart.jsのスクリプト --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>
    <style>
        body {
          margin: 0;
          padding: 0;
          position: relative;
        }

        #map {
          position: absolute;
          top: 100px;
          bottom: 0;
          width: 80%;
          height: 80%;
        }

        .marker {
            display: flex;
            justify-content: center;
            align-items: center;
            bottom: -8px;
            width: 60px;
            height: 30px;
            background-color: #60a144;
            padding: 10px;
            border-radius: 5px;
            white-space: nowrap;
            z-index: 1000;
            pointer-events: none;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
        }

        .price-marker {
            position: absolute;
            color: white;
        }

        .marker::before{
            content: '';
            position: absolute;
            display: block;
            width: 0;
            height: 0;
            bottom: -12px;
            border-top: 15px solid #60a144;
            border-right: 5px solid transparent;
            border-left: 5px solid transparent;
        }
    </style>
</head>
<body>
    <h1>{{ $item->name }}の価格マップ</h1>

   <div id="map"></div>
    @php
        $store_json = json_encode($stores);
        $post_json = json_encode($posts);
    @endphp

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        mapboxgl.accessToken = 'pk.eyJ1IjoiYXlhODIxIiwiYSI6ImNsd2lvaGJrOTAwOTYybXJ5cm03YWp2b2MifQ.FZRb0fWgupxl2fsvEPn_pA';
        const stores = JSON.parse('<?php echo $store_json; ?>');
        const posts = JSON.parse('<?php echo $post_json; ?>');

        const features = [];
        for(let i = 0; i < stores.length; i++) {
            const store = stores[i];

            const allPosts = Object.values(posts);
            const storePosts = allPosts.filter(post => post.store_id === store.id);
            const latestPost = storePosts.length > 0
                ? storePosts.slice().sort((a, b) => new Date(b.created_at) - new Date(a.created_at))[0]
                : null;


            // グラフ用
            var prices = [];
            var days = new Set(); // Set を使用して重複のない日付を保持する

            // 日付ごとに価格を集計するためのオブジェクト
            var dailyPrices = {};

            for (let j = 0; j < storePosts.length; j++) {
                const eachPost = Object.values(storePosts[j]);
                const price = eachPost[2];
                const date = new Date(eachPost[5]);
                const m = date.getMonth() + 1;
                const d = date.getDate();
                const dateString = m + '/' + d;

                // 日付ごとに価格を集計する
                if (!dailyPrices[dateString]) {
                    dailyPrices[dateString] = {
                        prices: [],
                        count: 0
                    };
                }
                dailyPrices[dateString].prices.push(price);
                dailyPrices[dateString].count++;

                // 日付をSetに追加することで重複を避ける
                days.add(dateString);
            }

            // 平均価格の配列を作成する
            for (const day in dailyPrices) {
                if (dailyPrices.hasOwnProperty(day)) {
                    const total = dailyPrices[day].prices.reduce((acc, curr) => acc + curr, 0);
                    const averagePrice = total / dailyPrices[day].count;
                    const roundedAveragePrice = Math.round(averagePrice);
                    prices.push(roundedAveragePrice);
                }
                console.log(prices);
            }

            // Set を配列に変換して日付の配列を完成させる
            days = Array.from(days);

            const feature = {
                type: 'Feature',
                properties: {
                        id: store.id,
                        name: store.name,
                        description: store.description,
                        imageId: store.image,
                        openingTime: store.opening_time,
                        closingTime: store.closing_time,
                        postalCode: store.postal_code,
                        address: store.address,
                        phoneNumber: store.phone_number,
                        holidays: store.holidays,
                        homepage: store.homepage,
                        iconSize: [60, 60],
                        posts: storePosts,
                        price: latestPost ? latestPost.price : null,
                         // グラフ用
                        prices: prices,
                        days: days,
                    },
                geometry: {
                    type: 'Point',
                    coordinates: [store.longitude, store.latitude]
                },
            };
            features.push(feature);
        }

        const geojson = {
            type: 'FeatureCollection',
            features: features
        }

        const map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/aya821/clwt63wof011v01pp4xq8dixe',
            center: [135.487196, 34.673307],
            zoom: 14
        });

        // Add markers to the map.
        for (const marker of geojson.features) {
            // Create a DOM element for each marker.
            const el = document.createElement('div');
            const width = marker.properties.iconSize[0];
            const height = marker.properties.iconSize[1];
            el.className = 'marker';

            // Create a price marker element
            const priceMarker = document.createElement('div');
            priceMarker.className = 'price-marker';
            priceMarker.textContent = `${marker.properties.price}円`;

            el.appendChild(priceMarker);

            el.addEventListener('click', () => {
                // モーダルにお店の情報をセットjQuery
                $('#storeId').val(marker.properties.id);
                $('#storeName').text(marker.properties.name);
                $('#storeImage').attr('src', `../../../laravel-map/public/storage/store_images/${marker.properties.imageId}`);
                $('#storeDescription').text(marker.properties.description);
                $('#storeHours').text(`営業時間 ${marker.properties.openingTime}～${marker.properties.closingTime}`);
                $('#storeAddress').text(`住所 〒${marker.properties.postalCode.slice(0, 3)}-${marker.properties.postalCode.slice(3)} ${marker.properties.address}`);
                $('#storePhone').text(`電話番号 ${marker.properties.phoneNumber}`);
                $('#storeHolidays').text(`定休日 ${marker.properties.holidays}`);
                $('#storeHomepage').html(`ホームページ <a href="${marker.properties.homepage}" target="_blank">${marker.properties.homepage}</a>`);
                $('#postId').val(marker.properties.id);

                var sortedPosts = marker.properties.posts.slice().sort((a, b) => new Date(b.created_at) - new Date(a.created_at));

                var postsHtml = '';
                $.each(sortedPosts, function(index, post) {
                    var userName = post.is_anonymous !== 1 ? '匿名ユーザー' : post.user.name;
                    var soldOut = post.is_soldout === 1 ? '売り切れです！' : '';

                    const date = new Date(post.created_at);

                    const y = date.getFullYear();
                    const m = date.getMonth() + 1;
                    const d = date.getDate();
                    const h = date.getHours().toString().padStart(2, '0');
                    const i = date.getMinutes().toString().padStart(2, '0');
                    const dateString = y + '/' + m + '/' + d + ' ' + h + ':' + i;

                    postsHtml += `
                        <div class="card mb-3 p-2">
                            <p class="soldout">${soldOut}</p>
                            <p id="postPrice">${post.price}円</p>
                            <p id="postDescription">${post.description}</p>
                            ${post.image ? `<img id="postImage" src="../../../laravel-map/public/storage/post_images/${post.image}" alt="投稿された画像">` : ''}
                            <p id="postCreatedAt">${dateString}</p>
                            <p id="postUser">by ${userName}</p>
                        </div>
                    `;
                });

                $('#posts').html(postsHtml);

                 // グラフ用
                var prices = marker.properties.prices;  // グラフ用の価格データ
                var days = marker.properties.days;
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
                                    suggestedMax: 400,
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

                // モーダルを表示
                $('#storeModal').modal('show');
            });

            // Add markers to the map.
            new mapboxgl.Marker(el)
                .setLngLat(marker.geometry.coordinates)
                .addTo(map);
        };
    </script>

    <!-- modal -->
    <div class="modal fade" id="storeModal" tabindex="-1" aria-labelledby="storeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-fluid">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="storeName"></h5>
                </div>
                <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <a href="#post" class="nav-link active text-secondary" id="detail-tab" data-bs-toggle="tab" role="tab" aria-controls="post" aria-selected="true">
                        口コミ投稿
                      </a>
                    </li>
                    <li class="nav-item" role="presentation">
                      <a href="#posts" class="nav-link text-secondary" id="menu-tab" data-bs-toggle="tab" role="tab" aria-controls="posts" aria-selected="false">
                       口コミ一覧
                      </a>
                    </li>

                    <li class="nav-item" role="presentation">
                      <a href="#store" class="nav-link text-secondary" id="campaign-tab" data-bs-toggle="tab" role="tab" aria-controls="store" aria-selected="false">
                        店舗情報
                      </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="#chart" class="nav-link text-secondary" id="campaign-tab" data-bs-toggle="tab" role="tab" aria-controls="chart" aria-selected="false">
                          価格推移
                        </a>
                      </li>
                </ul>
                <div class="tab-content px-3" id="myTabContent">
                    <div class="tab-pane fade show active" id="post" role="tabpanel" aria-labelledby="detail-tab">
                        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input id="storeId" type="hidden" name="store_id" value="">
                            <input type="hidden" name="item_id" value="<?php echo $item->id ?>">
                            <div class="py-1 postform">
                                <label for="price">価格</label>
                                <input class="form-control" id="price" name="price" type="price">
                            </div>
                            <div class="py-2">
                                <input id="is_soldout" name="is_soldout" type="checkbox" value=1>
                                <label for="is_soldout">売り切れてました</label>
                            </div>
                            <div class="py-1 postform">
                                <label for="description">コメント</label>
                                <textarea class="form-control" id="description" name="description"></textarea>
                            </div>
                            <div class="py-1">
                                <label for="image">画像</label>
                                <input name="image" type="file">
                            </div>
                            <div class="py-2">
                                <input id="is_anonymous" name="is_anonymous" type="checkbox" value=1>
                                <label for="is_anonymous">匿名にしない</label>
                            </div>
                            <button class="btn green-btn" type="submit">投稿</button>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="posts" role="tabpanel" aria-labelledby="posts-tab">

                    </div>
                    <div class="tab-pane fade" id="store" role="tabpanel" aria-labelledby="store-tab">
                        <div>
                            <img id="storeImage" src="" alt="店舗の画像">
                            <p id="storeDescription"></p>
                            <p id="storeHours"></p>
                            <p id="storeAddress"></p>
                            <p id="storePhone"></p>
                            <p id="storeHolidays"></p>
                            <p id="storeHomepage"></p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="chart" role="tabpanel" aria-labelledby="chart-tab">
                        <canvas id="myLineChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection
