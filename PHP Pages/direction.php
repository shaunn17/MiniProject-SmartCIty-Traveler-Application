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

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script src='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js'></script>
  <link href='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.css' rel='stylesheet' />
  <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.js"></script>
  <link
    rel="stylesheet"
    href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.css"
    type="text/css"
  />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity=”sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I” crossorigin="anonymous">
  <script src=”https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity=”sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/” crossorigin=”anonymous”></script>
  <title>Smart city</title>
  <style>
    body {
      background-color: #B5D5FA;
      margin-left: 50px;
    }

    #map {
      margin-top: 25px;
      height: 500px;
      width: 900px;
    }

    button{
      margin-top: 30px;
    }

    a{
      text-decoration: none;
      color: white;
    }

    a:hover{
      color: wheat;
    }
  </style>
  <script src="js/direction.js" defer></script>
</head>
<body>
  <div id='map'></div>
  <label>Destination: <?php echo $lng1,$lat1 ?></label><br>

  <button class="btn btn-success"><a href="review.html">End Trip</a></button>
</body>
</html>