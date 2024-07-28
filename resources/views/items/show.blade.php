@extends('layouts.app')

@section('content')
<body>
    <h1>{{ $item->name }}の価格マップ
        <a class="graph-icon" href="{{ route('items.batch', $item) }}">
            <i class="fas fa-chart-line"></i>
        </a>
        {{-- <a class="text-light text-decoration-none graph-icon" href="{{ route('items.chart', $item) }}">
            <i class="fas fa-chart-line"></i>
        </a> --}}
    </h1>
    <div class="col-sm-10">
        <div id="map"></div>
        @php
            $store_json = json_encode($stores);
            $post_json = json_encode($posts);
            $price_data_json = json_encode($price_data);
        @endphp

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            mapboxgl.accessToken = 'pk.eyJ1IjoiYXlhODIxIiwiYSI6ImNsd2lvaGJrOTAwOTYybXJ5cm03YWp2b2MifQ.FZRb0fWgupxl2fsvEPn_pA';
            const stores = JSON.parse('<?php echo $store_json; ?>');
            const posts = JSON.parse('<?php echo $post_json; ?>');
            const price_data = JSON.parse('<?php echo $price_data_json; ?>');

            const features = [];
            for(let i = 0; i < stores.length; i++) {
                const store = stores[i];

                const allPosts = Object.values(posts);
                const storePosts = allPosts.filter(post => post.store_id === store.id);
                const latestPost = storePosts.length > 0
                    ? storePosts.slice().sort((a, b) => new Date(b.created_at) - new Date(a.created_at))[0]
                    : null;
                // グラフ用
                const allPrice = Object.values(price_data);
                const storePrice = allPrice.filter(allPrice => allPrice.store_id === store.id);
                const averagePrices = storePrice.map(price => price.average_price);
                const highPrices = storePrice.map(price => price.high_price);
                const lowPrices = storePrice.map(price => price.low_price);
                const days = storePrice.map(price => price.date);

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
                            averagePrices: averagePrices,
                            highPrices: highPrices,
                            lowPrices: lowPrices,
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
                    $('#storeHolidays').text(`定休日: ${marker.properties.holidays || 'なし'}`);
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
                    var averagePrices = marker.properties.averagePrices;
                    var highPrices = marker.properties.averagePrices;
                    var lowPrices = marker.properties.averagePrices;
                    var days = marker.properties.days;
                    var ctx = document.getElementById("myLineChart");
                    var myLineChart = new Chart(ctx, {
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
                                text: marker.properties.name + 'の{{ $item->name }}の価格推移'
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
    </div>
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
    <div class="col-sm-2 text-center">
        @if(isset($weatherData->Feature))
        <?php
        // 開始時間をCarbonオブジェクトに変換
        $startDateTime = \Carbon\Carbon::createFromFormat('YmdHi', $weatherData->Feature->Property->WeatherList->Weather[0]->Date);
        // 終了時間を計算してCarbonオブジェクトに変換
        $endDateTime = $startDateTime->copy()->addMinutes(60);
        ?>

        <p>{{ $startDateTime->format('n/j G:i') }}から<br>60分間の降水量予報</p>
        <table class="table table-bordered">
            @foreach($weatherData->Feature->Property->WeatherList->Weather as $weather)
                    <?php
                        // 日付をCarbonオブジェクトにパースする
                        $dateTime = \Carbon\Carbon::createFromFormat('YmdHi', $weather->Date);
                    ?>

                    <tr>
                        <td>{{ $dateTime->format('H:i') }}</td>
                        <td>{{ $weather->Rainfall }} mm　
                            <span>
                                @if ($weather->Rainfall > 0)
                                    <i class="fas fa-umbrella" style="color: blue;"></i>
                                @else
                                    <i class="far fa-smile" style="color: rgb(239, 112, 21);"></i>
                                @endif
                            </span>
                        </td>
                    </tr>
            @endforeach
        </table>
        @else
            <p>気象情報を取得できませんでした。</p>
        @endif
    </div>
</body>
@endsection
