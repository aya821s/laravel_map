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
          top: 200px;
          bottom: 0;
          width: 50%;
          height: 50%;
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
                        message: store.name,
                        imageId: store.image,
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
            zoom: 15
        });

        // Add markers to the map.
        for (const marker of geojson.features) {
            // Create a DOM element for each marker.
            const el = document.createElement('div');
            const width = marker.properties.iconSize[0];
            const height = marker.properties.iconSize[1];
            el.className = 'marker';
            //el.style.backgroundImage = `url(https://picsum.photos/id/${marker.properties.imageId}/${width}/${height})`;//
            el.style.backgroundImage = 'url(../../../laravel-map/public/storage/mapbox-icon.png/${width}/${height})`;)';
            el.style.width = `${width}px`;
            el.style.height = `${height}px`;
            el.style.backgroundSize = '100%';

            el.addEventListener('click', () => {
                // モーダルにお店の情報をセット
                $('#storeName').text(marker.properties.message);
                $('#storeImage').attr('src', `../../../laravel-map/public/storage/mapbox-icon.png/${width}/${height}`);
                $('#storeDescription').text(marker.properties.description);
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
                    <h5 class="modal-title" id="storeModalLabel">店舗情報</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="storeName"></p>
                    <p id="storeDescription"></p>
                    <img id="storeImage" src="" alt="店舗の画像" style="width: 100%;">
                </div>
            </div>
        </div>
    </div>
</body>
@endsection
