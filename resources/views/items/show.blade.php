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
          top: 60px;
          bottom: 0;
          width: 100%;
          height: 100%;
        }

        .marker {
          background-image: url('../../../laravel-map/public/storage/mapbox-icon.png');
          background-size: cover;
          width: 50px;
          height: 50px;
          border-radius: 50%;
          cursor: pointer;
       }
      </style>
</head>
<body>
    <div id="map"></div>
    @php
    $store_json = json_encode($stores);
    //echo $store_json;
    @endphp

    <script>
        mapboxgl.accessToken = 'pk.eyJ1IjoiYXlhODIxIiwiYSI6ImNsd2lvaGJrOTAwOTYybXJ5cm03YWp2b2MifQ.FZRb0fWgupxl2fsvEPn_pA';
        const stores = JSON.parse('<?php echo $store_json; ?>');

        const map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/aya821/clwt63wof011v01pp4xq8dixe',
            center: [135.487196, 34.673307],
            zoom: 15
        });

        const features = [];
        for(let i = 0; i < stores.length; i++) {
            const store = stores[i];
            const feature = {
                type: 'Feature',
                geometry: {
                    type: 'Point',
                    coordinates: [store.longitude, store.latitude]
                },
                properties: {
                    title: 'Mapbox',
                    description: store.name
                }
            };
            features.push(feature);
        }

        const geojson = {
            type: 'FeatureCollection',
            features: features
        }

        for (const feature of geojson.features) {
            const el = document.createElement('div');
            el.className = 'marker';
            new mapboxgl.Marker(el).setLngLat(feature.geometry.coordinates).addTo(map);
        };
    </script>
</body>
</html>


{{--

    @foreach($stores as $store)
        <div>
            <a href="{{ route('stores.show', $store) }}"><h2>{{$store->name}}</h2></a>
        </div>
        <div>
            @foreach($posts as $post)
                @if  ($post->item_store_id == $store->id)
                    <div style="background: lightgrey;">
                    @if ($post->is_soldout == 1)
                        <p style="color: red;">売り切れです！</p>
                    @endif

                    <h2>{{ $post->price }}円</h2>


                    @if ($post->image !== "")
                        <img src="{{ asset('/storage/post_images/'. $post->image) }}" id="image">
                    @endif


                    <p>{{ $post->description }}</p>

                    <p>{{ $post->created_at}}</p>

                    @if ($post->is_anonymous !== 1)
                        <p>by 匿名ユーザー</p>
                    @else
                        <p>by {{ $post->user->name }}</p>
                    @endif
                    </div>
                @endif
            @endforeach
            <hr>
        </div>
    @endforeach
    --}}
@endsection
