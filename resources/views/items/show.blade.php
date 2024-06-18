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
    </style>
</head>
<body>
    <style>
        .marker {
            display: block;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            padding: 0;
        }
    </style>

    <div id="map"></div>
    @php
        $store_json = json_encode($stores);
    @endphp

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        mapboxgl.accessToken = 'pk.eyJ1IjoiYXlhODIxIiwiYSI6ImNsd2lvaGJrOTAwOTYybXJ5cm03YWp2b2MifQ.FZRb0fWgupxl2fsvEPn_pA';
        const stores = JSON.parse('<?php echo $store_json; ?>');

        const features = [];
        for(let i = 0; i < stores.length; i++) {
            const store = stores[i];
            const feature = {
                type: 'Feature',
                properties: {
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
                        iconSize: [60, 60]
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
            el.style.backgroundImage = 'url(../../../laravel-map/public/storage/store_images/${marker.properties.imageId}/${width}/${height})`;)';
            el.style.width = `${width}px`;
            el.style.height = `${height}px`;
            el.style.backgroundSize = '100%';

            el.addEventListener('click', () => {
                // モーダルにお店の情報をセットjQuery
                $('#storeName').text(marker.properties.name);
                $('#storeImage').attr('src', `../../../laravel-map/public/storage/store_images/${marker.properties.imageId}`);
                $('#storeDescription').text(marker.properties.description);
                $('#storeHours').text(`営業時間 ${marker.properties.openingTime}～${marker.properties.closingTime}`);
                $('#storeAddress').text(`住所 〒${marker.properties.postalCode.slice(0, 3)}-${marker.properties.postalCode.slice(3)} ${marker.properties.address}`);
                $('#storePhone').text(`電話番号 ${marker.properties.phoneNumber}`);
                $('#storeHolidays').text(`定休日 ${marker.properties.holidays}`);
                $('#storeHomepage').html(`ホームページ <a href="${marker.properties.homepage}" target="_blank">${marker.properties.homepage}</a>`);
                // モーダルを表示
                $('#storeModal').modal('show');
            });





            // Add markers to the map.
            new mapboxgl.Marker(el)
                .setLngLat(marker.geometry.coordinates)
                .addTo(map);
        }
    </script>

    <!-- modal -->
    <div class="modal fade" id="storeModal" tabindex="-1" aria-labelledby="storeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="storeName"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img id="storeImage" src="" alt="店舗の画像">
                    <p id="storeDescription"></p>
                    <p id="storeHours"></p>
                    <p id="storeAddress"></p>
                    <p id="storePhone"></p>
                    <p id="storeHolidays"></p>
                    <p id="storeHomepage"></p>

                </div>
            </div>
        </div>
    </div>
</body>
@endsection
