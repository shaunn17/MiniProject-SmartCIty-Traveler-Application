<?php
session_start();
include('connection.php');
$email = $_SESSION['email'];
$_SESSION['email'] = $email;
$name1 = $_GET['name1'];
$lat1 = $_GET['lat1'];
$lng1 = $_GET['lng1'];
$random = $_GET['random'];
$date = $_GET['date'];
$city = $_GET['city'];

$sql = "INSERT INTO trips(email,name1,random,date,city) 
	VALUES('$email','$name1','$random','$date','$city')";  

if(! $conn->query( $sql)) {
  echo 'Could not enter data: ' . $conn->error;
}

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Demo: Local search with the Geocoding API</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="https://api.tiles.mapbox.com/mapbox-gl-js/v2.2.0/mapbox-gl.js"></script>
    <link
      href="https://api.tiles.mapbox.com/mapbox-gl-js/v2.2.0/mapbox-gl.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/location.css">
    
    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.min.js"></script>
    <link
      rel="stylesheet"
      href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.css"
      type="text/css"
    />
  </head>
  <body >
  
  <header>
    <h1 style="margin-left: 200px">LOCATION</h1>
  </header>
    <div id="map"></div>

    <script>

var name1 = '<?php echo $name1 ;?>';
var lat1 = '<?php echo $lat1 ;?>';
var lng1 = '<?php echo $lng1 ;?>';

      mapboxgl.accessToken = 'pk.eyJ1IjoicmViZWNjYTA0IiwiYSI6ImNrbnpqNGc1czA2NWoydWs0OHl1ZnF3azcifQ.JFJUBVq4aoG_WyD7nGw_EQ';
      var map = new mapboxgl.Map({
        container: 'map', // Container ID
        style: 'mapbox://styles/mapbox/streets-v11', // Map style to use
        center: [lng1, lat1], // Starting position [lng, lat]
        zoom: 12 // Starting zoom level
      });

      var marker = new mapboxgl.Marker() // Initialize a new marker
        .setLngLat([lng1, lat1]) // Marker [lng, lat] coordinates
        .addTo(map); // Add the marker to the map

      var geocoder = new MapboxGeocoder({
        // Initialize the geocoder
        accessToken: mapboxgl.accessToken, // Set the access token
        mapboxgl: mapboxgl, // Set the mapbox-gl instance
        marker: false, // Do not use the default marker style
        placeholder: 'Search for places', // Placeholder text for the search bar
       // bbox: [-122.30937, 37.84214, -122.23715, 37.89838], // Boundary for Berkeley
        proximity: {
          longitude: lng1,
          latitude: lat1
        } // Coordinates of UC Berkeley
      });

      // Add the geocoder to the map
      map.addControl(geocoder);

      // After the map style has loaded on the page,
      // add a source layer and default styling for a single point
      map.on('load', function () {
        map.addSource('single-point', {
          'type': 'geojson',
          'data': {
            'type': 'FeatureCollection',
            'features': []
          }
        });

        map.addLayer({
          'id': 'point',
          'source': 'single-point',
          'type': 'circle',
          'paint': {
            'circle-radius': 10,
            'circle-color': '#448ee4'
          }
        });

        // Listen for the `result` event from the Geocoder // `result` event is triggered when a user makes a selection
        //  Add a marker at the result's coordinates
        geocoder.on('result', function (e) {
          map.getSource('single-point').setData(e.result.geometry);
        });
      });

      
    </script>


<div class="temp" style="margin-left: 950px; margin-top: 200px; margin-right: 20px; ">
    <div class="panel-body">
        <label>NAME: <?php echo $name1 ?></label><br>
        <label>LATITUDE: <?php echo $lat1 ?></label><br>
        <label>LONGITUDE: <?php echo $lng1 ?></label><br>
        <label>RATING: <?php echo $random ?></label><br>
      </div>
    </div>
  </div>
    
<div class="btnss">
    <br><button class="btn btn-primary"><a href='direction.php?name1="+name1+"&lat1="+<?php echo $lat1 ?>+"&lng1="+<?php echo $lat1 ?>+"&random="+random+"&date="+date1+"&city="+city"'>Get Directions</a></button>
    <button class="btn btn-success"><a href="search.php">View Reviews</a></button>
</div>
    
  </body>
</html>
